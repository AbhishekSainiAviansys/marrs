<?php
/**
 * env_loader.php - LOCAL DEVELOPMENT environment helper (kept at repo root)
 *
 * Loads local-only settings from .env.development (git-ignored, never uploaded)
 * ONLY when the site is served from this machine (localhost / 127.0.0.1).
 *
 * SAFE ON PRODUCTION: on any other host nothing is loaded and every helper
 * returns the built-in live default, so live behaviour is unchanged.
 *
 * Helpers:
 *   marrs_is_local()          - true only on localhost / 127.0.0.1
 *   marrs_env('KEY', 'default') - value from .env.development when local,
 *                                 otherwise the default (live value)
 *   marrs_site_url()          - 'http://localhost' locally, live site URL otherwise
 */

if (!function_exists('marrs_is_local'))
{
	function marrs_is_local()
	{
		static $is_local = NULL;
		if ($is_local !== NULL) {
			return $is_local;
		}

		$host = '';
		if (isset($_SERVER['HTTP_HOST'])) {
			$host = $_SERVER['HTTP_HOST'];
		} elseif (isset($_SERVER['SERVER_NAME'])) {
			$host = $_SERVER['SERVER_NAME'];
		}

		$host = strtolower(preg_replace('/:\d+$/', '', trim($host)));
		$is_local = in_array($host, array('localhost', '127.0.0.1', '::1', '[::1]'), TRUE);
		return $is_local;
	}
}

if (!function_exists('marrs_env'))
{
	function marrs_env($key, $default = '')
	{
		static $vars = NULL;
		if ($vars === NULL) {
			$vars = array();
			// Only read the local env file on localhost - never on live servers
			if (marrs_is_local()) {
				$file = __DIR__ . '/.env.development';
				if (is_readable($file)) {
					foreach (file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
						$line = trim($line);
						if ($line === '' || $line[0] === '#') {
							continue;
						}
						$pos = strpos($line, '=');
						if ($pos === FALSE) {
							continue;
						}
						$name = trim(substr($line, 0, $pos));
						$value = trim(substr($line, $pos + 1));
						// strip optional surrounding quotes
						if (strlen($value) > 1 && ($value[0] === '"' || $value[0] === "'") && substr($value, -1) === $value[0]) {
							$value = substr($value, 1, -1);
						}
						$vars[$name] = $value;
					}
				}
			}
		}

		// presence-based (an explicitly empty value, e.g. DB_PASSWORD=, must win)
		return array_key_exists($key, $vars) ? $vars[$key] : $default;
	}
}

if (!function_exists('marrs_site_url'))
{
	function marrs_site_url()
	{
		// On live keep exactly the URL the site has always used
		return marrs_is_local() ? 'http://localhost' : 'https://marrsdev.marrs.in';
	}
}
