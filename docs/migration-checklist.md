# WCCMS Migration Checklist (Reusable)

## 1. Pre-flight
1. Confirm runtime versions (`PHP`, `MySQL`, `Apache/Nginx`, `Bootstrap target`).
2. Confirm DB credentials and grants (app user exists and has DB privileges).
3. Snapshot/backup: code + DB.
4. Confirm staging URL/host strategy (`www` vs non-`www`, http vs https).

## 2. Routing + Entrypoint
1. Apply `.htaccess`/rewrite rules.
2. Confirm `/` routes to app entrypoint.
3. Confirm friendly URLs route to `inside.php?url=...`.
4. Confirm static files (`/css/*`, `/js/*`, `/filestore/*`) bypass rewrite.

## 3. DB Strategy
1. Introduce PDO connection (new standard).
2. Add temporary mysqli bridge only if needed.
3. Add local override files for safe per-server credentials.
4. Add clear DB error output for staging (remove/lock down for production).

## 4. Frontend Compatibility
1. If templates are Bootstrap 3, keep temporary BS3 compatibility mode.
2. Upgrade templates in batches to Bootstrap 5.3.
3. Verify nav, dropdowns, collapse, modal, carousel behavior per batch.

## 5. PHP 8.x Hardening
1. Remove deprecated/removed APIs (`mysql_*`, `ereg`, etc.).
2. Fix undefined variable/array key warnings.
3. Replace risky dynamic includes with allowlisted include map.

## 6. Data + Schema
1. Track every DB schema change in migration SQL files.
2. Apply schema migrations to staging first.
3. Verify dependent templates/pages after each schema change.

## 7. Verification
1. Smoke test key URLs: `/`, homepage slug, product page, contact page.
2. Confirm CSS/JS requests are `200`.
3. Check logs (`error.log`, access log) for fatal/errors after each release.
4. Validate forms and email workflows.

## 8. Handover
1. Update `web/docs/migration-log.md` with final changes.
2. Record unresolved items and owner.
3. Capture rollback steps and known safe release point.
