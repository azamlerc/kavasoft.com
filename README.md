# kavasoft.com

A read-only archive of the original website. The PHP data files and historical content remain in their original format.

## Runtime

The Dockerfile uses `php:8.5.12-apache` (the patched stable release available on October 22, 2026). Update the patch tag and rebuild when PHP publishes security updates; changing source files does not update an already-running Fly machine.

Apache listens on port 80. Extensionless historical links are supported using Apache rewrite rules. PHP reports all errors to server logs without exposing them to visitors.

## Local verification

```sh
docker build --pull -t kavasoft.com:archive .
docker run --rm --name kavasoft-archive -p 127.0.0.1:8080:80 kavasoft.com:archive
# From another terminal:
python3 tests/smoke.py http://127.0.0.1:8080
docker logs kavasoft-archive
```

Check the logs for PHP warnings, deprecations, and fatal errors as well as the HTTP results. The image intentionally excludes tests and Git metadata.

## Fly.io

Use the existing Fly application's configuration with its internal HTTP port set to **80**, and deploy this Dockerfile with a fresh build. This checkout does not contain `fly.toml`; retain or retrieve the existing application's settings rather than creating another app. For example, from this directory, use `fly deploy --app <existing-app-name>` with your existing Fly configuration. Verify the deployed runtime is PHP 8.5.12 and rerun the smoke checks against the HTTPS domain after deployment.

## Retired services

Store, ordering, licensing, version statistics, and review-request endpoints return an archive notice with HTTP 410. Store and license code are excluded from the image. Contact and affiliate forms are inactive, and their server-side mail handlers have been removed. Public version plists still work from products.php, with database logging removed.

The incomplete `/kavafoto/` copy redirects to the maintained KavaFoto site. The iConquer map gallery displays original PNG images without the obsolete server-side reflection generators. Historical Shoebox download pages use the current shared layout because their original layout include is missing from this checkout.
