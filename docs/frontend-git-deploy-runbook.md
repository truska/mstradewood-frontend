# Frontend-Only Git Deploy Runbook

Purpose: deploy only frontend code from this repo to live server, excluding CMS and system/content folders.

This runbook is intentionally separate from PHP/Bootstrap migration notes.

## Scope

Deploy from `web/` only.

Exclude:
- `web/filestore/`
- `web/wccms/`
- `web/stats/`
- `web/error/`
- root-level frontend entry/system files in `web/` (e.g. `.htaccess`, `inside.php`, `truska.php`)

Do not deploy anything outside `web/` (especially `private/`).

## Standard Workflow

1. Commit and push from dev.
2. Export DB from dev and import to live (manual).
3. Pull latest code on live.
4. Sync only allowed frontend files from `web/` to live document root with excludes.
5. Clear caches/restart PHP if needed.
6. Smoke test.

## 1) Dev: Commit and Push

```bash
git status
git add -A
git commit -m "Deploy: frontend update"
git push origin <branch>
```

## 2) Database: Export Dev and Import Live

### 2.1 Export dev DB

```bash
mysqldump --single-transaction --routines --triggers \
  -h <DEV_DB_HOST> -u <DEV_DB_USER> -p <DEV_DB_NAME> \
  > dev_export_$(date +%F_%H%M).sql
```

Optional compress:

```bash
gzip dev_export_*.sql
```

### 2.2 Backup live DB before import

```bash
mysqldump --single-transaction --routines --triggers \
  -h <LIVE_DB_HOST> -u <LIVE_DB_USER> -p <LIVE_DB_NAME> \
  > live_backup_before_import_$(date +%F_%H%M).sql
```

### 2.3 Import into live

If compressed:

```bash
gunzip -c dev_export_<timestamp>.sql.gz | \
mysql -h <LIVE_DB_HOST> -u <LIVE_DB_USER> -p <LIVE_DB_NAME>
```

If plain SQL:

```bash
mysql -h <LIVE_DB_HOST> -u <LIVE_DB_USER> -p <LIVE_DB_NAME> < dev_export_<timestamp>.sql
```

## 3) Live: Pull Latest Git

In your live repo clone:

```bash
git fetch --all
git checkout <branch>
git pull --ff-only origin <branch>
```

## 4) Live: Frontend-Only Sync (with excludes)

From live repo root, sync `web/` into live document root:

```bash
rsync -av \
  --exclude='filestore/' \
  --exclude='wccms/' \
  --exclude='stats/' \
  --exclude='error/' \
  --exclude='.htaccess' \
  --exclude='inside.php' \
  --exclude='truska.php' \
  ./web/ <LIVE_DOCROOT>/
```

Notes:
- This copies only frontend files allowed by scope.
- No files from `private/` are included.
- Add `--dry-run` first if you want a preview.

## 5) Post-Deploy

If OPcache is enabled, reload PHP-FPM/Apache or clear OPcache by your normal host procedure.

## 6) Smoke Test Checklist

- Home page loads.
- One content page loads.
- CSS/JS/assets load with 200 status.
- Navigation works on desktop/mobile.
- Forms/CMS links expected for this phase (CMS excluded).

## Quick Reuse Checklist

1. `git push`
2. `mysqldump` dev
3. backup live DB
4. import live DB
5. `git pull` on live
6. `rsync` frontend with excludes
7. smoke test
