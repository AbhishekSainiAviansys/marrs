<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Fcm_push - Firebase Cloud Messaging helper (CI3 library)
 *
 * Reads Firebase credentials from the `credentials` table
 * (row with title = 'firebase notification'):
 *
 *   - `public`    : VAPID public key (browser side)
 *   - `sdkapijson`: Firebase Web App config or service-account JSON
 *   - firebasekey/: protected service-account JSON file for FCM HTTP v1
 *
 * Usage:
 *   $this->load->library('fcm_push');
 *   $result = $this->fcm_push->send_to_token($token, $title, $body, $data);
 *   $result = $this->fcm_push->send_to_cin($cin, $title, $body, $data);
 *
 * $result = array('success'=>bool, 'method'=>'v1|none', 'status'=>int, 'response'=>string)
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
			// NOTE: FCM HTTP v1 message.notification only allows title/body/image.
			// (legacy fields like `sound` cause HTTP 400 INVALID_ARGUMENT)
		);

		$payload_data = array();
		foreach ((array) $data as $k => $v) {
			$payload_data[(string) $k] = (string) $v;
		}

		// The credentials table may store the public Web App config in sdkapijson.
		// Use service-account JSON there when present; otherwise use the protected key file.
		$service_account_json = $this->_get_service_account_json($creds);
		if ($service_account_json !== '') {
			return $this->_send_v1($service_account_json, $token, $notification, $payload_data);
		}

		if ($this->last_error === '') {
			$this->last_error = 'No valid Firebase service account JSON is configured.';
		}

		return $this->_result(FALSE, $this->last_method, 0, $this->last_error);
	}

	/** Return service-account JSON from the table or the protected project key file. */
	protected function _get_service_account_json($creds)
	{
		$stored_json = isset($creds['sdkapijson']) ? (string) $creds['sdkapijson'] : '';
		$stored_account = json_decode($stored_json, TRUE);
		if (is_array($stored_account) && !empty($stored_account['client_email'])
			&& !empty($stored_account['private_key']) && !empty($stored_account['project_id'])) {
			return $stored_json;
		}

		$web_config = $stored_account;
		if (!is_array($web_config)) {
			$objectStart = strpos($stored_json, '{');
			$objectEnd = strrpos($stored_json, '}');
			if ($objectStart !== FALSE && $objectEnd !== FALSE && $objectEnd > $objectStart) {
				$web_config = json_decode(substr($stored_json, $objectStart, $objectEnd - $objectStart + 1), TRUE);
			}
		}
		$expected_project_id = (is_array($web_config) && !empty($web_config['projectId']))
			? trim((string) $web_config['projectId'])
			: '';

		$path = getenv('FIREBASE_SERVICE_ACCOUNT_FILE');
		if ($path === FALSE || trim($path) === '') {
			$path = FCPATH . 'firebasekey/marrs-51377-76aa3cb155f6.json';
		}
		if (!is_file($path) || !is_readable($path)) {
			$this->last_error = 'Firebase service account file is missing or unreadable.';
			return '';
		}

		$file_json = file_get_contents($path);
		$file_account = is_string($file_json) ? json_decode($file_json, TRUE) : NULL;
		if (!is_array($file_account) || empty($file_account['client_email'])
			|| empty($file_account['private_key']) || empty($file_account['project_id'])) {
			$this->last_error = 'Firebase service account file is not valid service-account JSON.';
			return '';
		}
		if ($expected_project_id !== '' && $file_account['project_id'] !== $expected_project_id) {
			$this->last_error = 'Firebase service account project does not match the Web App config.';
			return '';
		}

		return $file_json;
	}

	// ------------------------------------------------------------------
	// FCM HTTP v1  (POST https://fcm.googleapis.com/v1/projects/.../messages:send)
	// OAuth2 access token is built locally from the service account JSON.
	// ------------------------------------------------------------------
	protected function _send_v1($service_account_json, $token, $notification, $data)
	{
		$sa = json_decode($service_account_json, TRUE);
		if (!is_array($sa) || empty($sa['client_email']) || empty($sa['private_key']) || empty($sa['project_id'])) {
			$this->last_error = 'Invalid Firebase service-account JSON';
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
		$message['webpush'] = array('headers' => array('Urgency' => 'high'));

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
