# Franchise portal

Legacy CodeIgniter **2.1.3** application for franchise and school workflows.

## Local URL

With the repository root configured as the web-server document root, open
`http://localhost/franchiselogin/`. Requests are routed through `index.php`
using the application's Apache rewrite rules.

## Configuration

The application's `index.php` loads the shared root environment loader.
Configure `APP_BASE_URL`, `DB_HOST`, `DB_USERNAME`, `DB_PASSWORD`, and
`DB_DATABASE` in the root `.env.development`. Its
`application/config/config.php` appends `/franchiselogin/` to `APP_BASE_URL`.

Use a non-production database copy for testing. Franchise actions can update
schools, registrations, and related records.

## Compatibility and validation

The application targets the existing PHP 7.4 server. CodeIgniter 2.1.3 is
legacy, so validate on the target PHP version and exercise login, navigation,
school, and registration workflows before deployment.
