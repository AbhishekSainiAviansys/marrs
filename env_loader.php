<?php
/**
 * Minimal .env loader shared by all CodeIgniter 3 apps in this project.
 * No Composer dependency. PHP 7.4 compatible.
 *
 * Loads (only if the file exists):
 *   .env.{APP_ENV | CI_ENV | 'development'}   (looked up in this project root)
 *
 * Real environment variables always win over .env values.
 * If no env file is present (e.g. production server deployed via git),
 * nothing is loaded and config files keep their built-in defaults.
 *
 * Usage in config files:  getenv('DB_HOST') !== FALSE ? ... (or ?: defaults)
 */

if (defined('ENV_LOADER_LOADED'))
{
	return;
}

$envName = getenv('APP_ENV');
if ($envName === FALSE || $envName === '')
{
	$envName = (isset($_SERVER['CI_ENV']) && $_SERVER['CI_ENV'] !== '') ? $_SERVER['CI_ENV'] : 'development';
}

$envFile = __DIR__ . DIRECTORY_SEPARATOR . '.env.' . $envName;

if (is_file($envFile) && is_readable($envFile))
{
	$lines = file($envFile, FILE_IGNORE_NEW_LINES);

	foreach ($lines as $line)
	{
		$line = trim($line);

		// Skip blank lines and full-line comments
		if ($line === '' || $line[0] === '#')
		{
			continue;
		}

		$pos = strpos($line, '=');
		if ($pos === FALSE)
		{
			continue;
		}

		$key   = trim(substr($line, 0, $pos));
		$value = trim(substr($line, $pos + 1));

		if ($key === '')
		{
			continue;
		}

		// Strip one pair of surrounding quotes (single or double)
		if ($value !== '' && ($value[0] === '"' || $value[0] === "'") && substr($value, -1) === $value[0])
		{
			$value = substr($value, 1, -1);
		}

		// Never override a real environment variable
		if (getenv($key) !== FALSE)
		{
			continue;
		}

		putenv($key . '=' . $value);
		$_ENV[$key]    = $value;
		$_SERVER[$key] = $value;
	}
}

define('ENV_LOADER_LOADED', TRUE);
