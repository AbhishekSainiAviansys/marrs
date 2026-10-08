# Lunar portal

CodeIgniter **3.1.11** application for Lunar assessment registration,
student pages, and related payment workflows.

## Local URL

With the repository root as the web-server document root, open
`http://localhost/lunar/`. The app's `index.php` and rewrite rules provide its
front controller.

## Configuration

The application loads the shared root environment loader. Set
`APP_BASE_URL`, `DB_HOST`, `DB_USERNAME`, `DB_PASSWORD`, and `DB_DATABASE` in
the root `.env.development` file. `application/config/config.php` appends
`/lunar` to `APP_BASE_URL`.

Use a local database copy and Razorpay test credentials. Never test payment
or webhook changes against live payment credentials.

## Compatibility and validation

The application targets the existing PHP 7.4 environment. Composer manifests
and vendored libraries are present; check the app's own `composer.json` before
installing or changing dependencies. No root-level test runner is configured.
