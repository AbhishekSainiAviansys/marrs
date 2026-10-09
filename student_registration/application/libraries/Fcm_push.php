<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Fcm_push - Firebase Cloud Messaging helper (CI3 library)
 *
 * Reads Firebase credentials from the `credentials` table
 * (row with title = 'firebase notification'):
 *
 *   - `public`    : VAPID public key (browser side - reference only)
 *   - `private`   : FCM server key, used for the legacy HTTP API
 *   - `sdkapijson`: service account JSON, used for FCM HTTP v1
 *                   (automatic fallback when the legacy API is refused)
 *
 * Usage:
 *   $this->load->library('fcm_push');
 *   $result = $this->fcm_push->send_to_token($token, $title, $body, $data);
 *   $result = $this->fcm_push->send_to_cin($cin, $title, $body, $data);
 *
 * $result = array('success'=>bool, 'method'=>'legacy|v1', 'status'=>int, 'response'=>string)
 */
class Fcm_push {

	protected $CI;
	protected $credentials = NULL;
	protected $last_error = '';
	protected $last_method = '';

	public function __construct()
	{
		$this->CI =& get_instance();
	}

	/** Last error message (empty string when the last send succeeded). */
	public function get_last_error()
	{
		return $this->last_error;
	}

	/** Firebase row from the `credentials` table (cached). */
	public function get_credentials()
	{
		if ($this->credentials !== NULL) {
			return $this->credentials;
		}

		$row = $this->CI->db->where('title', 'firebase notification')->limit(1)->get('credentials')->row_array();
		if (empty($row)) {
			$row = $this->CI->db->where('status', 1)->order_by('id', 'ASC')->limit(1)->get('credentials')->row_array();
		}

		$this->credentials = $row ? $row : array();
		return $this->credentials;
	}

	/** Send a notification to the fcm_token stored for a CIN in `cin_list`. */
	public function send_to_cin($cin, $title, $body, $data = array())
	{
		$this->last_error = '';

		$row = $this->CI->db->where('cin', $cin)->limit(1)->get('cin_list')->row_array();
		if (empty($row)) {
			$this->last_error = 'CIN not found: ' . $cin;
			return $this->_result(FALSE, 'none', 0, $this->last_error);
		}

		$token = isset($row['fcm_token']) ? trim((string) $row['fcm_token']) : '';
		if ($token === '') {
			$this->last_error = 'No fcm_token stored for CIN ' . $cin;
			return $this->_result(FALSE, 'none', 0, $this->last_error);
		}

		return $this->send_to_token($token, $title, $body, $data);
	}

	/** Send a notification to one FCM device token. */
	public function send_to_token($token, $title, $body, $data = array())
	{
		$this->last_error = '';
		$this->last_method = '';

		$token = trim((string) $token);
		if ($token === '') {
			$this->last_error = 'Empty FCM token';
			return $this->_result(FALSE, 'none', 0, $this->last_error);
		}

		$creds = $this->get_credentials();
		if (empty($creds)) {
			$this->last_error = 'No row found in `credentials` table';
			return $this->_result(FALSE, 'none', 0, $this->last_error);
		}

		$notification = array(
			'title' => (string) $title,
			'body'  => (string) $body,
			'sound' => 'default',
		);

		$payload_data = array();
		foreach ((array) $data as $k => $v) {
			$payload_data[(string) $k] = (string) $v;
		}

		// ---- 1) Legacy HTTP API using the `private` server key ----
		if (!empty($creds['private'])) {
			$result = $this->_send_legacy($creds['private'], $token, $notification, $payload_data);
			if ($result['success']) {
				return $result;
			}
			// keep the legacy failure as the reported error unless v1 also fails
			$this->last_error = $result['response'];
			$this->last_method = 'legacy';
		}

		// ---- 2) FCM HTTP v1 using the service account JSON (`sdkapijson`) ----
		if (!empty($creds['sdkapijson'])) {
			return $this->_send_v1($creds['sdkapijson'], $token, $notification, $payload_data);
		}

		if ($this->last_error === '') {
			$this->last_error = 'No FCM credentials configured (`private` / `sdkapijson` empty)';
		}

		return $this->_result(FALSE, $this->last_method, 0, $this->last_error);
	}

	// ------------------------------------------------------------------
	// Legacy FCM HTTP API  (POST https://fcm.googleapis.com/fcm/send)
	// ------------------------------------------------------------------
	protected function _send_legacy($server_key, $token, $notification, $data)
	{
		$body = array(
			'to'           => $token,
			'notification' => $notification,
			'priority'     => 'high',
		);
		if (!empty($data)) {
			$body['data'] = $data;
		}

		$ch = curl_init('https://fcm.googleapis.com/fcm/send');
		curl_setopt_array($ch, array(
			CURLOPT_RETURNTRANSFER => TRUE,
			CURLOPT_POST            => TRUE,
			CURLOPT_TIMEOUT         => 30,
			CURLOPT_HTTPHEADER      => array(
				'Content-Type: application/json',
				'Authorization: key=' . $server_key,
			),
			CURLOPT_POSTFIELDS      => json_encode($body),
		));
		$response = curl_exec($ch);
		$http = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$curl_error = curl_error($ch);
		curl_close($ch);

		if ($response === FALSE) {
			$this->last_error = 'cURL error (legacy FCM): ' . $curl_error;
			return $this->_result(FALSE, 'legacy', $http, $this->last_error);
		}

		$json = json_decode($response, TRUE);
		$failure = (is_array($json) && isset($json['failure'])) ? (int) $json['failure'] : -1;
		$success = ($http === 200 && $failure === 0);

		if (!$success) {
			$this->last_error = 'Legacy FCM failed (HTTP ' . $http . '): ' . $response;
		}

		return $this->_result($success, 'legacy', $http, ($response === '' || $response === FALSE) ? $this->last_error : $response);
	}

	// ------------------------------------------------------------------
	// FCM HTTP v1  (POST https://fcm.googleapis.com/v1/projects/.../messages:send)
	// OAuth2 access token is built locally from the service account JSON.
	// ------------------------------------------------------------------
	protected function _send_v1($service_account_json, $token, $notification, $data)
	{
		$sa = json_decode($service_account_json, TRUE);
		if (!is_array($sa) || empty($sa['client_email']) || empty($sa['private_key']) || empty($sa['project_id'])) {
			$this->last_error = 'Invalid `sdkapijson` (service account JSON) in credentials table';
			return $this->_result(FALSE, 'v1', 0, $this->last_error);
		}

		$access_token = $this->_access_token($sa);
		if ($access_token === '') {
			return $this->_result(FALSE, 'v1', 0, $this->last_error);
		}

		$message = array(
			'token'        => $token,
			'notification' => $notification,
		);
		if (!empty($data)) {
			$message['data'] = $data;
		}
		// Web push extras (used for browser tokens, harmless for app tokens)
		$message['webpush'] = array(
			'headers'     => array('Urgency' => 'high'),
			'fcm_options' => array('link' => 'https://marrs.in/'),
		);

		$url = 'https://fcm.googleapis.com/v1/projects/' . rawurlencode($sa['project_id']) . '/messages:send';

		$ch = curl_init($url);
		curl_setopt_array($ch, array(
			CURLOPT_RETURNTRANSFER => TRUE,
			CURLOPT_POST            => TRUE,
			CURLOPT_TIMEOUT         => 30,
			CURLOPT_HTTPHEADER      => array(
				'Content-Type: application/json',
				'Authorization: Bearer ' . $access_token,
			),
			CURLOPT_POSTFIELDS      => json_encode(array('message' => $message)),
		));
		$response = curl_exec($ch);
		$http = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$curl_error = curl_error($ch);
		curl_close($ch);

		if ($response === FALSE) {
			$this->last_error = 'cURL error (FCM v1): ' . $curl_error;
			return $this->_result(FALSE, 'v1', $http, $this->last_error);
		}

		$success = ($http === 200);
		if (!$success) {
			$this->last_error = 'FCM v1 failed (HTTP ' . $http . '): ' . $response;
		}

		return $this->_result($success, 'v1', $http, $success ? $response : $this->last_error);
	}

	// ------------------------------------------------------------------
	// service account JWT (RS256) -> OAuth2 access token
	// ------------------------------------------------------------------
	protected function _access_token($sa)
	{
		if (!class_exists('JWT', FALSE)) {
			require_once APPPATH . 'libraries/JWT.php';
		}

		$now = time();
		$claims = array(
			'iss'   => $sa['client_email'],
			'scope' => 'https://www.googleapis.com/auth/firebase.messaging',
			'aud'   => 'https://oauth2.googleapis.com/token',
			'iat'   => $now,
			'exp'   => $now + 3600,
		);

		try {
			$jwt = JWT::encode($claims, $sa['private_key'], 'RS256');
		} catch (Exception $e) {
			$this->last_error = 'Service account JWT sign failed: ' . $e->getMessage();
			return '';
		} catch (Throwable $e) {
			$this->last_error = 'Service account JWT sign failed: ' . $e->getMessage();
			return '';
		}

		$ch = curl_init('https://oauth2.googleapis.com/token');
		curl_setopt_array($ch, array(
			CURLOPT_RETURNTRANSFER => TRUE,
			CURLOPT_POST            => TRUE,
			CURLOPT_TIMEOUT         => 30,
			CURLOPT_HTTPHEADER      => array('Content-Type: application/x-www-form-urlencoded'),
			CURLOPT_POSTFIELDS      => http_build_query(array(
				'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
				'assertion'  => $jwt,
			)),
		));
		$response = curl_exec($ch);
		$http = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$curl_error = curl_error($ch);
		curl_close($ch);

		if ($response === FALSE) {
			$this->last_error = 'cURL error (Google OAuth): ' . $curl_error;
			return '';
		}

		$json = json_decode($response, TRUE);
		if (empty($json['access_token'])) {
			$this->last_error = 'Google OAuth token failed (HTTP ' . $http . '): ' . $response;
			return '';
		}

		return $json['access_token'];
	}

	protected function _result($success, $method, $status, $response)
	{
		return array(
			'success'  => (bool) $success,
			'method'   => $method,
			'status'   => (int) $status,
			'response' => (string) $response,
		);
	}
}
