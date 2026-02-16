# Frontend-Only Git Deploy Runbook

Purpose: deploy frontend code only (no CMS) from GitHub to live.

This runbook is separate from migration work.

## Scope

Repository content deployed to live webroot, with these exclusions:
- `filestore/`
- `wccms/`
- `stats/`
- `error/`
- `deploy_scripts/`
- `.htaccess`
- `inside.php`
- `truska.php`
- `.git/`

Nothing outside webroot is deployed by this flow.

## Paths Used On This Site

- Dev repo: `/var/www/clients/client4/web8/web`
- Live clone: `/var/www/mstradewood.com/web/mstradewood-frontend`
- Live webroot: `/var/www/mstradewood.com/web`
- Live deploy script: `/var/www/mstradewood.com/web/deploy_scripts/deploy-frontend.sh`

## One-Time Setup

### A) Dev repo (done)
1. Initialize Git in dev web folder.
2. Add `.gitignore` exclusions for non-frontend content.
3. Set remote:
`git@github.com:truska/mstradewood-frontend.git`
4. Commit and push baseline.

### B) SSH authentication
Recommended: SSH deploy key (not HTTPS token prompts).

Per user account that runs Git:
1. Create key (`id_ed25519`)
2. Add public key to GitHub account
3. Add `~/.ssh/config`:

```sshconfig
Host github.com
  HostName github.com
  User git
  IdentityFile ~/.ssh/id_ed25519
  IdentitiesOnly yes
```

4. Test:
`ssh -T git@github.com`

Expected:
`Hi <github-user>! You've successfully authenticated...`

### C) Live deploy script
Create `/var/www/mstradewood.com/web/deploy_scripts/deploy-frontend.sh`:

```bash
#!/usr/bin/env bash
set -euo pipefail

REPO_DIR="/var/www/mstradewood.com/web/mstradewood-frontend"
LIVE_DIR="/var/www/mstradewood.com/web"

cd "$REPO_DIR"
git pull --ff-only origin main

rsync -av \
  --exclude='.git/' \
  --exclude='filestore/' \
  --exclude='wccms/' \
  --exclude='stats/' \
  --exclude='error/' \
  --exclude='deploy_scripts/' \
  --exclude='.htaccess' \
  --exclude='inside.php' \
  --exclude='truska.php' \
  ./ "$LIVE_DIR/"
```

Make executable:
`chmod 700 /var/www/mstradewood.com/web/deploy_scripts/deploy-frontend.sh`

## Regular Deploy Cycle

### 1) Dev (VSCode Source Control or terminal)
1. Make changes.
2. Commit.
3. Push `main`.

### 2) Live (MobaXterm terminal)
1. Confirm host/user first:
`hostname && whoami && pwd`
2. Run:
`/var/www/mstradewood.com/web/deploy_scripts/deploy-frontend.sh`

### 3) Verify
1. Hard refresh browser (`Ctrl+F5`).
2. Check home + one internal page.
3. Confirm expected change is live.

## Optional: Database Move

DB export/import is currently manual and separate from this frontend deploy flow.

## Troubleshooting

### Git unsafe repository / dubious ownership
Symptom: VSCode/Git says repo is unsafe.

Fix:
1. Ensure working as `web8` on dev.
2. Correct ownership if needed:
`chown -R web8:client4 /var/www/clients/client4/web8/web`
3. If still blocked:
`git config --global --add safe.directory /var/www/clients/client4/web8/web`

### Wrong SSH identity (tries `/root/.ssh/...`)
Symptom: Git error references `/root/.ssh/id_ed25519`.

Fix:
1. Use correct user shell (`web8` on dev).
2. Ensure no forced ssh command in git config:
`git config --show-origin -l | grep -i ssh`
3. Reconnect VSCode remote session as correct user.

### MobaXterm pasted control characters (`^[[200~`)
Symptom: command starts/ends with garbage and fails.

Fix:
1. Press `Ctrl+C`.
2. Paste short commands line-by-line.
3. Optional in shell:
`bind 'set enable-bracketed-paste off'`

## Quick Checklist

1. Dev: commit + push.
2. Live: run deploy script.
3. Hard refresh and smoke test.
