# Admin portal

Legacy CodeIgniter **2.1.3** application for administration workflows.

## Local URL

When the repository root is the web-server document root, open
`http://localhost/admin/`. The application front controller is `index.php`;
Apache rewrite rules route clean URLs through it.

## Configuration

The root environment loader is included by this application's `index.php`.
Configure `APP_BASE_URL`, `DB_HOST`, `DB_USERNAME`, `DB_PASSWORD`, and
`DB_DATABASE` in the root `.env.development` file for local work. The admin
base URL is derived in `application/config/config.php` by appending `/admin/`
to `APP_BASE_URL`.

Use an isolated database and non-production credentials. The portal includes
administrative actions that can modify registration, school, and payment data.

## Compatibility and validation

The application targets the existing PHP 7.4 server. Its CodeIgniter 2.1.3
runtime is legacy; linting under a newer PHP CLI is not a substitute for
testing on PHP 7.4. No dedicated app-level test runner was found during
repository setup.
