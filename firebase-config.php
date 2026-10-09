<?php
require_once __DIR__ . '/env_loader.php';

header('Content-Type: application/javascript; charset=utf-8');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');

try {
	$conn = new mysqli(
		marrs_env('DB_HOST', 'localhost'),
		marrs_env('DB_USERNAME', 'marrscor_marrs'),
		marrs_env('DB_PASSWORD', '8jN}g7XGRczj'),
		marrs_env('DB_DATABASE', 'marrscor_marrs')
	);
	$conn->set_charset('utf8mb4');

	$query = $conn->prepare(
		'SELECT sdkapijson, ad_info, public
		 FROM credentials
		 WHERE title = ? AND status = 1
		 ORDER BY id ASC
		 LIMIT 1'
	);
	$title = 'firebase notification';
	$query->bind_param('s', $title);
	$query->execute();
	$query->bind_result($sdkConfig, $senderId, $vapidKey);
	$rowFound = $query->fetch();
	$query->close();
	$conn->close();

	if (!$rowFound) {
		throw new RuntimeException('Active Firebase credentials row was not found.');
	}

	$settings = json_decode((string) $sdkConfig, TRUE);
	if (!is_array($settings)) {
		$objectStart = strpos((string) $sdkConfig, '{');
		$objectEnd = strrpos((string) $sdkConfig, '}');
		if ($objectStart !== FALSE && $objectEnd !== FALSE && $objectEnd > $objectStart) {
			$settings = json_decode(substr((string) $sdkConfig, $objectStart, $objectEnd - $objectStart + 1), TRUE);
		}
	}
	if (!is_array($settings)) {
		// The field may hold the raw Firebase console JavaScript snippet
		// (unquoted keys, e.g. `apiKey: "..."`), which is not valid JSON.
		// Parse the key/value pairs directly in that case.
		$objectStart = strpos((string) $sdkConfig, '{');
		$objectEnd = strrpos((string) $sdkConfig, '}');
		$object = ($objectStart !== FALSE && $objectEnd !== FALSE && $objectEnd > $objectStart)
			? substr((string) $sdkConfig, $objectStart, $objectEnd - $objectStart + 1)
			: (string) $sdkConfig;

		$settings = array();
		$pattern = '~[\'"]?([A-Za-z_][A-Za-z0-9_]*)[\'"]?\s*:\s*[\'"]([^\'"]*)[\'"]~';
		if (preg_match_all($pattern, $object, $matches, PREG_SET_ORDER)) {
			foreach ($matches as $match) {
				$settings[$match[1]] = $match[2];
			}
		}
	}
	if (!is_array($settings) || empty($settings)) {
		throw new RuntimeException('The sdkapijson field must contain a Firebase Web App config object.');
	}

	$config = array(
		'firebase' => array(
			'apiKey' => isset($settings['apiKey']) ? trim((string) $settings['apiKey']) : '',
			'authDomain' => isset($settings['authDomain']) ? trim((string) $settings['authDomain']) : '',
			'projectId' => isset($settings['projectId']) ? trim((string) $settings['projectId']) : '',
			'appId' => isset($settings['appId']) ? trim((string) $settings['appId']) : '',
			'messagingSenderId' => isset($settings['messagingSenderId'])
				? trim((string) $settings['messagingSenderId'])
				: trim((string) $senderId)
		),
		'vapidKey' => trim((string) $vapidKey)
	);

	foreach ($config['firebase'] as $value) {
		if ($value === '') {
			throw new RuntimeException('Firebase web settings are incomplete in the credentials table.');
		}
	}
	if ($config['vapidKey'] === '') {
		throw new RuntimeException('Firebase VAPID public key is missing from the credentials table.');
	}
} catch (Throwable $error) {
	error_log('[MaRRS notifications] Firebase config lookup failed: ' . $error->getMessage());
	http_response_code(503);
	echo 'throw new Error("Firebase notifications are not configured. Check the active credentials table row and server error log.");';
	exit;
}

$json = json_encode($config, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);

if ($json === FALSE) {
	http_response_code(500);
	echo 'throw new Error("Unable to encode Firebase configuration");';
	exit;
}

echo 'self.MARRS_FIREBASE_CONFIG = ' . $json . ';';
