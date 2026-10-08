# Base URL and subdomain file map

## Central setting

Set `APP_BASE_URL` to the origin where the repository will be served. For
example, when the repository root maps to one test subdomain, use that
subdomain's HTTPS origin. Each CodeIgniter application appends its own path.
Do not include an app path in `APP_BASE_URL`.

| File | Role |
| --- | --- |
| `.env.example` | Safe template; documents the `APP_BASE_URL` variable |
| `.env.development` | Local-only setting; ignored by Git |
| `.env.<environment>` | Server-only environment file selected by `APP_ENV`; ignored by Git |
| `env_loader.php` | Loads the selected root environment file |
| `admin/application/config/config.php` | Appends `/admin/` |
| `franchiselogin/application/config/config.php` | Appends `/franchiselogin/` |
| `lunar/application/config/config.php` | Appends `/lunar` |
| `student_registration/application/config/config.php` | Appends `/student_registration` |
| `zoomzoom/application/config/config.php` | Appends `/zoomzoom/` |

The CodeIgniter config files retain the production URL as a fallback if
`APP_BASE_URL` is not set. Always set it explicitly in development and
deployment environments.

## Other production-domain references

The current PHP source scan found absolute `marrs.in` URLs in 367 PHP files,
including the app folders and public site. These URLs may point to internal
pages, intentionally public assets, or external-facing content. They are not
all base URL definitions. Audit the matched links for the particular
subdomain workflow instead of performing a global replacement.

To refresh the file list from the repository root:

```powershell
rg -l 'https?://(www\.)?marrs\.in' --glob '*.php'
```

If the test deployment uses separate document roots or separate subdomains
for each app, revisit the path-appending assumptions in the five
`application/config/config.php` files before deployment.
