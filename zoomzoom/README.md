# ZoomZoom portal

CodeIgniter **3.1.11** application for ZoomZoom registration and student
workflows.

## Local URL

With the repository root configured as the web-server document root, open
`http://localhost/zoomzoom/`. Clean URLs are routed through `index.php`.

## Configuration

The application loads the shared root environment loader. Set
`APP_BASE_URL`, `DB_HOST`, `DB_USERNAME`, `DB_PASSWORD`, and `DB_DATABASE` in
the root `.env.development`; `application/config/config.php` appends
`/zoomzoom/`.

Use an isolated database and test-only payment credentials for development.

## Compatibility and validation

The application targets the existing PHP 7.4 environment. A Composer
manifest and vendored libraries are present; inspect the app's
`composer.json` before dependency changes. No dedicated app-level test runner
was found during repository setup.
