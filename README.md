# MaRRS web applications

This repository contains the MaRRS public PHP site and several legacy
CodeIgniter applications that share a database and public assets.

## Applications

| Folder | Purpose | Framework |
| --- | --- | --- |
| Repository root | Public site and shared PHP includes | Legacy PHP |
| `admin/` | Administration portal | CodeIgniter 2.1.3 |
| `franchiselogin/` | Franchise portal | CodeIgniter 2.1.3 |
| `lunar/` | Lunar assessments and registration | CodeIgniter 3.1.11 |
| `student_registration/` | Student registration and payments | CodeIgniter 3.1.11 |
| `zoomzoom/` | ZoomZoom portal | CodeIgniter 3.1.11 |
| `frontend_gallery/` | Static gallery images | Static assets |

Each application has a folder-level README with its entry points and notes.

## Local development

The applications target the existing PHP 7.4 server environment. Use Apache
with URL rewriting enabled and the PHP MySQLi extension. The CodeIgniter
applications are expected to remain under their matching repository
subdirectories.

1. Configure the web-server document root to this repository so the site is
   available at `http://localhost/` and the applications at `/admin`,
   `/franchiselogin`, `/lunar`, `/student_registration`, and `/zoomzoom`.
2. Copy `.env.example` to `.env.development` and set local database and
   integration credentials. Keep all `.env.*` files except `.env.example` out
   of Git.
3. Set `APP_BASE_URL=http://localhost`. The shared [env_loader.php](./env_loader.php)
   loads `.env.development` by default; an explicitly configured `APP_ENV`
   selects `.env.<APP_ENV>`.
4. Use a local database copy, not the production database. Each app reads
   `DB_HOST`, `DB_USERNAME`, `DB_PASSWORD`, and `DB_DATABASE`.
5. Set `RAZOR_KEY_ID`, `RAZOR_KEY_SECRET`, and `RAZOR_WEBHOOK_SECRET` to
   sandbox credentials and a test webhook endpoint for payment testing.

Do not rely on PHP 8.x CLI linting as proof that the legacy CodeIgniter 2
applications work on PHP 7.4. Validate changes on the target PHP runtime.

## Base URL and test-subdomain configuration

The five CodeIgniter applications derive their URLs from `APP_BASE_URL`. The
exact configuration files and subdomain assumptions are listed in
[BASE_URL_MIGRATION.md](./BASE_URL_MIGRATION.md). For one test subdomain whose
document root is this repository, set `APP_BASE_URL` to that subdomain's HTTPS
origin in the server environment (or its untracked `.env.staging` file).
Do not commit deployment credentials or production `.env` files.

Many PHP files also contain absolute `marrs.in` links. These include links to
production pages and assets; they are not all application base URLs and should
not be changed with a blind global replacement. Review those links when
testing each workflow on the chosen subdomain.

## Git and asset policy

- Source code and the website image/assets in `images/`, `newassets/`,
  `productlogo/`, and `frontend_gallery/` are intended to be available to Git.
- `newassets/**/*.mp4`, large study/mock-paper collections, runtime logs,
  generated files, and `.env.*` remain excluded.
- Evidence-photo directories and non-image document/archive files beneath
  `images/` directories remain excluded to avoid publishing submitted or
  operational records.
- The ignored study/mock-paper folders contain several gigabytes of PDFs and
  other learning materials. Keep those in their existing managed storage or
  transfer them separately; do not add them wholesale to Git.
- Review `git status` before staging. Unignored assets still need to be
  explicitly added when preparing a commit.

## Sensitive configuration: required before publishing

The repository history previously included a private key and hard-coded
database password fallbacks and Razorpay credentials. The current source no
longer contains those hard-coded values, and `keys/private.pem` is ignored and
untracked while remaining in the local working directory for development.
**This does not remove sensitive data from earlier Git commits.**

Before pushing this repository or its history to a remote:

1. Rotate the database credential, Razorpay credentials, and private key that
   were present in the old source/history.
2. Replace or clean the existing Git history so those old values cannot be
   recovered from the published repository.
3. Provision the replacement private key securely on the test host; the
   student-registration math configuration expects it at `keys/private.pem`.

Do not publish the current history until these steps are complete.

## Validation

There is no repository-wide test runner at the root. Use the relevant
application's tests and validate critical login, registration, payment,
webhook, and document-download flows against a non-production database.
