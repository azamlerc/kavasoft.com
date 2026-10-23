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

`fly.toml` targets the existing **kavasoft-com** app, builds the repository's Dockerfile, and routes HTTP traffic to Apache on port **80**. The EWR region and shared CPU with 256 MB RAM match the existing app's dashboard. Automatic start/stop and zero minimum running machines follow KavaFoto's configuration; these settings were not retrieved from the live KavaSoft app.

### Deploy from the dashboard

1. Commit and push `fly.toml` to the repository's `main` branch.
2. Open the existing **kavasoft-com** app in Fly's dashboard and connect **azamlerc/kavasoft.com**, using the root `fly.toml`.
3. Review the configuration against the app's current settings, then click **Deploy app**. Connecting the repository alone does not deploy a release.
4. Check the new release in Activity, browse the site, and run `python3 tests/smoke.py https://kavasoft.com`.

You can also deploy from this directory with `fly deploy`. Neither a Git push alone nor a restart updates a running machine unless an automatic deployment integration is configured. The configuration file does not create a new app or change domain certificates.

## Retired services

Store, ordering, licensing, version statistics, and review-request endpoints return an archive notice with HTTP 410. Store and license code are excluded from the image. Contact and affiliate forms are inactive, and their server-side mail handlers have been removed. Public version plists still work from products.php, with database logging removed.

The incomplete `/kavafoto/` copy redirects to the maintained KavaFoto site. The iConquer map gallery displays original PNG images without the obsolete server-side reflection generators. Historical Shoebox download pages use the current shared layout because their original layout include is missing from this checkout.
