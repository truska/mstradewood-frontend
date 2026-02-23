# Contact Flow Standard (Bootstrap 5)

Use this as the canonical contact implementation for migrated/new sites.

## Canonical files
- `includes/contact-form.php` (form UI + submit handling + captcha + spam + DB write)
- `includes/lib/forms.php` (form, spam-rule, and metadata helpers)
- `includes/lib/spam_rules.php` (rule catalog/scoring helpers)
- `wccms/includes/email.php` (mail delivery helper already shared)

## Page integration points
- `includes/page-contact.php`
- `includes/content-contact.php`

Both should include `includes/contact-form.php` and avoid `includes/contacthandler.php`.

## Captcha standard
- Uses CMS prefs: `prefCaptchaEnabled`, `prefCaptchaVer`, `prefCaptchaSiteKey`, `prefCaptchaSecret`, `prefCaptchaMinScore`.
- Supports v2 checkbox and v3 token mode.
- v3 action is fixed to `contact_form` and score is validated against `prefCaptchaMinScore`.

## Spam/data standard
- Honeypot fields + score weighting.
- Dynamic spam rules from `cms_form_spam_rules`.
- Country score enrichment when available.
- Writes submissions to `contact_forms` when table exists.
- Sends admin and user email according to spam thresholds.

## Legacy note
- `includes/contacthandler.php` is legacy and should not be used by new Bootstrap 5 contact pages.
