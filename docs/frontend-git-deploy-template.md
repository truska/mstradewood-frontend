# Frontend Git Deploy Template (New Site)

Use this for each new frontend-only site deployment.

## 1) Fill In Variables

- `SITE_NAME`: `your-site`
- `GITHUB_REPO_SSH`: `git@github.com:ORG/REPO.git`
- `DEV_REPO_DIR`: `/var/www/clients/clientX/webY/web`
- `LIVE_CLONE_DIR`: `/var/www/SITE/web/REPO`
- `LIVE_WEBROOT`: `/var/www/SITE/web`
- `LIVE_DEPLOY_SCRIPT`: `/var/www/SITE/web/deploy_scripts/deploy-frontend.sh`

## 2) Dev One-Time Setup

```bash
cd <DEV_REPO_DIR>
git init
git branch -M main
```

Create `.gitignore` (adjust as needed):

```gitignore
filestore/
wccms/
stats/
error/
.htaccess
inside.php
truska.php
deploy_scripts/
```

Initial push:

```bash
git add .gitignore
git commit -m "Initialize frontend repository with deploy exclusions"
git remote add origin <GITHUB_REPO_SSH>
git push -u origin main
```

## 3) SSH Setup (User Running Git)

```bash
mkdir -p ~/.ssh
chmod 700 ~/.ssh
ssh-keygen -t ed25519 -C "<SITE_NAME>-deploy" -f ~/.ssh/id_ed25519 -N ""
cat ~/.ssh/id_ed25519.pub
```

Add public key to GitHub, then:

```bash
cat > ~/.ssh/config << 'EOF'
Host github.com
  HostName github.com
  User git
  IdentityFile ~/.ssh/id_ed25519
  IdentitiesOnly yes
EOF
chmod 600 ~/.ssh/config
ssh -T git@github.com
```

## 4) Live One-Time Setup

```bash
cd <LIVE_WEBROOT>
git clone <GITHUB_REPO_SSH>
cd <LIVE_CLONE_DIR>
git checkout main
git pull --ff-only origin main
```

Create deploy script:

```bash
mkdir -p <LIVE_WEBROOT>/deploy_scripts
cat > <LIVE_DEPLOY_SCRIPT> << 'EOF'
#!/usr/bin/env bash
set -euo pipefail

REPO_DIR="<LIVE_CLONE_DIR>"
LIVE_DIR="<LIVE_WEBROOT>"

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
EOF
chmod 700 <LIVE_DEPLOY_SCRIPT>
```

## 5) Regular Deploy Cycle

Dev:
```bash
cd <DEV_REPO_DIR>
git add -A
git commit -m "Your change note"
git push origin main
```

Live:
```bash
hostname && whoami && pwd
<LIVE_DEPLOY_SCRIPT>
```

Verify:
1. Hard refresh (`Ctrl+F5`)
2. Check homepage + one internal page
3. Confirm expected change

## 6) Common Issues

- Git unsafe repo:
  - `chown -R <USER>:<GROUP> <DEV_REPO_DIR>`
  - `git config --global --add safe.directory <DEV_REPO_DIR>`
- Wrong SSH key path (`/root/.ssh/...`):
  - Use correct user (`whoami`)
  - `git config --show-origin -l | grep -i ssh`
- MobaXterm paste artifacts (`^[[200~`):
  - `Ctrl+C`
  - paste line-by-line
  - optional: `bind 'set enable-bracketed-paste off'`
