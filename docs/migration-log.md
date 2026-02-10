# Migration Log (WCCMS v5 Alignment)

Project: `dev-mst.witecanvas.com`  
Date started: 2026-02-09

## Runbook Format (reuse for next sites)
For each change, capture:
1. Date
2. File(s)
3. Change summary
4. Reason
5. Rollback note
6. Verification result

---

## Entries

### 2026-02-09 - DB bridge + runtime stabilization
1. Files:
- `web/includes/dbcon.php`
- `web/includes/dbcon-legacy-mysqli.php`
- `private/dbcon-legacy-local.php`
- `web/includes/controller.php`
- `private/dbcon.php`
- `private/dbcon-local.php`
2. Change summary:
- Added migration DB bridge so both PDO (`$pdo`) and legacy mysqli (`$conn`) can run in parallel.
- Added optional legacy credential override file (`private/dbcon-legacy-local.php`).
- Added DB connection diagnostics in controller instead of blank page on failure.
- Added `localhost` then `127.0.0.1` host fallback for both PDO and mysqli connection attempts.
3. Reason:
- Existing templates still use `mysqli_*` heavily; migration needs staged approach.
- Initial runtime was failing with DB auth and blank output.
4. Rollback:
- Revert `web/includes/dbcon.php` and remove `web/includes/dbcon-legacy-mysqli.php`.
5. Verification:
- `php -l` syntax checks passed on updated DB files.
- Runtime progressed from 500 fatal DB error to rendered pages.

### 2026-02-09 - Routing + entrypoint update
1. Files:
- `web/.htaccess`
- `web/inside.php`
2. Change summary:
- Updated rewrite rules for `inside.php` routing.
- Added canonical non-`www` redirect.
- Added `DirectoryIndex inside.php`.
- Root route maps to `inside.php?url=welcome`.
- Updated `inside.php` flow with compatibility fallbacks for missing v5 include files.
3. Reason:
- Root requests were serving default page instead of app route.
- v5 structure files were partially present and needed safe fallback behavior.
4. Rollback:
- Restore previous `.htaccess` and `inside.php`.
5. Verification:
- Access log shows `200` for `/`, `/inside.php`, and routed pages after changes.

### 2026-02-09 - Header/footer asset strategy
1. Files:
- `web/includes/header-code.php`
- `web/includes/footer-code.php`
2. Change summary:
- Introduced v5-ready header/footer structure.
- Added compatibility mode: if legacy templates are active, load Bootstrap 3 + jQuery.
- Added fallback to `style.css` when `site.css` is absent.
- Initialized and loaded CMS skin prefs before `stylesheetcmscss.php`.
3. Reason:
- Legacy templates are Bootstrap 3 markup; pure Bootstrap 5 assets break layout.
- Missing skin-pref initialization caused warnings and unstable style output.
4. Rollback:
- Restore old `header-code.php` and `footer-code.php`.
5. Verification:
- CSS resumed rendering in browser after cache clear and compatibility mode.

### 2026-02-09 - Warning cleanup (non-fatal stabilizers)
1. Files:
- `web/includes/footer.php`
- `web/includes/functions.php`
- `web/includes/content-standard-sidebar.php`
- `web/includes/controller.php`
2. Change summary:
- Fixed typo `prefDublintDepotPostcode` -> `prefDublinDepotPostcode`.
- Initialized address builder vars to avoid undefined-variable warnings.
- Guarded sidebar manufacturer vars.
- Guarded missing image-folder prefs in controller.
- Fixed 404 fallback logic to load page row data instead of assigning integer.
3. Reason:
- Reduce warning noise that masks real migration issues.
- Prevent render interruptions in edge paths.
4. Rollback:
- Revert individual files if needed.
5. Verification:
- Syntax checks passed on all changed files.
- No new fatal errors in `log/error.log`.

### 2026-02-09 - Home banner and PHP 8.4 query guards
1. Files:
- `web/includes/banner-narrow.php`
- `web/includes/banner-large.php`
- `web/includes/header-code.php`
2. Change summary:
- Fixed PHP 8.4 fatal in `banner-narrow.php` by checking query results before `mysqli_fetch_assoc()`.
- Added home fallback in `banner-narrow.php` to include `banner-large.php` when no product id is present.
- Added query guards in `banner-large.php` to prevent TypeErrors when a query fails.
- Disabled CMS skin navbar background override in legacy mode so base legacy stylesheet controls menu background.
3. Reason:
- Logs showed fatal: `mysqli_fetch_assoc(): Argument #1 ($result) must be of type mysqli_result, false given`.
- Homepage banner was missing/interrupted when banner layout resolved to narrow template without product context.
- Menu background color did not match expected legacy design.
4. Rollback:
- Restore prior versions of `banner-narrow.php`, `banner-large.php`, and `header-code.php`.
5. Verification:
- `php -l` passed for all updated files.
- Fatal path in `banner-narrow.php` is now guarded.

### 2026-02-09 - Temporary home banner switch to Bootstrap carousel
1. Files:
- `web/includes/banner-large.php`
- `web/includes/header-code.php`
2. Change summary:
- Replaced desktop `MagicSlideshow` block with Bootstrap carousel markup (`.carousel`, `.item`, controls).
- Left mobile banner/panel logic unchanged.
- Disabled legacy CMS skin nav color overrides for top-level/drawer menu states so legacy `style.css` controls text and hover colors.
3. Reason:
- MagicToolbox assets are not currently loaded in this project, so slideshow images stacked vertically and did not animate.
- Top-level menu text/hover styles did not match legacy design due to skin CSS overrides.
4. Rollback:
- Restore previous `MagicSlideshow` markup in `banner-large.php`.
- Re-enable nav skin values in `header-code.php`.
5. Verification:
- `php -l web/includes/banner-large.php` passed.
- `php -l web/includes/header-code.php` passed.

### 2026-02-09 - Footer background class alignment
1. Files:
- `web/includes/footer.php`
2. Change summary:
- Updated footer element from `<footer>` to `<footer class="footer">` so CMS skin footer styles (`.footer`) apply.
3. Reason:
- Footer background color was missing because dynamic stylesheet targets `.footer` class, not bare `footer` tag.
4. Rollback:
- Revert footer tag change in `footer.php`.
5. Verification:
- `php -l web/includes/footer.php` passed.

### 2026-02-09 - Product page wrapper background fix
1. Files:
- `web/inside.php`
2. Change summary:
- Updated legacy wrapper-class selection so product detail routes are treated as inner pages (`accreditation-page innre-bg-img`) instead of homepage/listing wrapper (`contact-wrp`).
3. Reason:
- Product pages were missing expected rear/background image while homepage looked correct.
4. Rollback:
- Revert wrapper condition block in `inside.php`.
5. Verification:
- `php -l web/inside.php` passed.

### 2026-02-09 - Legacy `/images` path audit
1. Files:
- `web/css/style.css`
- `web/includes/nav.php`
- `web/includes/footer.php`
- `web/includes/page-content-product-doors.php`
2. Change summary:
- Audited code for image references still using legacy `/images/...` paths (instead of `/filestore/images/...`).
- Produced a migration list of missing files to copy from original source.
3. Reason:
- Some assets were not migrated when moving to filestore-based structure, causing missing visuals.
4. Rollback:
- N/A (audit only; no runtime behavior change).
5. Verification:
- `find` confirms these asset filenames are currently absent in both `web/filestore/images` and `web/`.

### 2026-02-09 - Restore inner page background image from legacy upload
1. Files:
- `web/filestore/images/backgrounds/inner-bg.png` (moved from `web/filestore/images/imagesold/inner-bg.png`)
- `web/css/style.css`
2. Change summary:
- Moved `inner-bg.png` from legacy holding folder into active backgrounds folder.
- Updated `.innre-bg-img` background URL to `../filestore/images/backgrounds/inner-bg.png`.
3. Reason:
- Product/inner pages referenced a background image that was missing after migration.
4. Rollback:
- Move file back to `imagesold` and restore previous CSS URL.
5. Verification:
- File exists in `web/filestore/images/backgrounds/inner-bg.png`.

### 2026-02-09 - Sidebar links normalized to current host
1. Files:
- `web/includes/content-standard-sidebar.php`
- `web/includes/content-right-side-section.php`
2. Change summary:
- Added `cms_localize_internal_link()` helper (guarded with `function_exists`).
- Updated sidebar link rendering (`Image`, `Link`, and non-YouTube `Video` fallback) to rewrite absolute internal links from `mstimber.com`/`www.mstimber.com` onto current `$baseURL`.
3. Reason:
- Some sidebar links in DB are absolute live URLs, causing navigation/downloads to jump to production from local/staging.
4. Rollback:
- Revert helper and restore direct usage of `$rowsidebar["link"]`.
5. Verification:
- `php -l` passed for both updated include files.

### 2026-02-09 - Doors/product sidebar duplicate and video ratio fix
1. Files:
- `web/includes/content-right-side-section.php`
2. Change summary:
- Added sidebar de-duplication during render using a stable signature of key row fields (item/heading/source/link/caption/youtubeid).
- Updated YouTube embed output to a responsive 16:9 container instead of `height='100%'`, preventing distorted video frame ratio.
3. Reason:
- `doors` page sidebar was rendering repeated elements and video block sizing was incorrect.
4. Rollback:
- Revert de-dup block and restore previous iframe output.
5. Verification:
- `php -l web/includes/content-right-side-section.php` passed.

### 2026-02-09 - Bootstrap 5 baseline switch with legacy compatibility shim
1. Files:
- `web/includes/header-code.php`
- `web/includes/footer-code.php`
- `web/css/bootstrap5-legacy-compat.css` (new)
- `web/js/bootstrap5-legacy-compat.js` (new)
2. Change summary:
- Switched core Bootstrap assets to v5.3.3 globally (CSS + JS bundle).
- Added legacy compatibility CSS for common BS3-only classes used across templates (`col-xs-*`, offsets, `pull-*`, `.sr-only`, `.navbar-toggle`, `.icon-bar`, `.carousel .item` alias behavior).
- Added legacy compatibility JS that maps BS3 data attributes to BS5 (`data-toggle`, `data-target`, `data-parent`, `data-slide*`, `data-ride`) and initializes carousels.
3. Reason:
- Requested move to Bootstrap 5 while preserving current rendering/behavior during phased template conversion.
4. Rollback:
- Restore conditional BS3 asset loading in header/footer.
- Remove `bootstrap5-legacy-compat.css` and `bootstrap5-legacy-compat.js` references.
5. Verification:
- `php -l web/includes/header-code.php` passed.
- `php -l web/includes/footer-code.php` passed.

### 2026-02-09 - Bootstrap 5 shim corrections (grid + mobile nav)
1. Files:
- `web/css/bootstrap5-legacy-compat.css`
- `web/js/bootstrap5-legacy-compat.js`
2. Change summary:
- Scoped `col-xs-*` compatibility rules to xs viewport only (`max-width: 767.98px`) so they do not override desktop `col-sm/col-md` layout.
- Added legacy navbar collapse display handling for mobile and desktop breakpoints.
- Added `.clearfix` utility compatibility.
- Added dropdown state sync in JS (`.show` -> `.open`) for legacy CSS selectors.
3. Reason:
- Initial BS5 shim caused desktop columns to stack (`col-xs-12` overriding `col-sm/col-md`) and mobile burger menu rendering to degrade.
4. Rollback:
- Restore previous versions of compatibility CSS/JS.
5. Verification:
- Syntax checks for PHP entry files still pass after shim adjustments.

### 2026-02-09 - Bootstrap 5 nav dropdown/caret compatibility fix
1. Files:
- `web/css/bootstrap5-legacy-compat.css`
2. Change summary:
- Disabled BS5-generated `dropdown-toggle::after` for legacy nav to avoid duplicate/misaligned expand icons.
- Forced desktop top-level dropdown menus to absolute positioning (`top:100%`, `left:0`) so dropdowns overlay correctly and do not reflow the rest of the menu line.
- Added small top-level caret alignment adjustment.
3. Reason:
- In BS5, default navbar dropdown behavior conflicted with legacy nav markup/CSS and caused misplaced icons and menu items shifting into the dropdown flow.
4. Rollback:
- Remove the added desktop dropdown/caret compatibility block from `bootstrap5-legacy-compat.css`.
5. Verification:
- Visual check on home menu closed/open/hover states.

### 2026-02-09 - Desktop nav dropdown vertical offset adjustment
1. Files:
- `web/css/bootstrap5-legacy-compat.css`
2. Change summary:
- Added a small desktop-only dropdown top offset (`top: calc(100% + 6px)`) and explicit `[data-bs-popper]` override so submenu panel aligns below the top menu row consistently.
3. Reason:
- Remaining visual misalignment after initial BS5 dropdown compatibility fix.
4. Rollback:
- Restore previous dropdown `top: 100%` rules.
5. Verification:
- Visual check of top nav hover/open positioning.

### 2026-02-09 - Top nav link padding alignment tweak
1. Files:
- `web/css/style.css`
2. Change summary:
- Updated top nav link padding from `12px 10px` to `0px 10px 10px` for improved baseline alignment with dropdown panel.
3. Reason:
- Final visual alignment adjustment requested after BS5 compatibility nav updates.
4. Rollback:
- Restore `.bottom-header .navbar-nav li a` padding to `12px 10px`.
5. Verification:
- Visual check of top nav line height and dropdown alignment.

### 2026-02-09 - Top nav spacing fine-tune (restore space above label)
1. Files:
- `web/css/style.css`
2. Change summary:
- Adjusted `.bottom-header .navbar-nav li a` padding from `0px 10px 10px` to `6px 10px 10px` to reintroduce space above top-level menu text.
3. Reason:
- Prior value removed too much top spacing versus legacy visual baseline.
4. Rollback:
- Restore previous padding value.
5. Verification:
- Visual check against old menu spacing reference.

### 2026-02-09 - Mobile burger menu cleanup (legacy debug style removal)
1. Files:
- `web/includes/nav.php`
2. Change summary:
- Removed inline mobile-only debug style block in nav template that forced odd link colors (`orange` / `indigo`) and could override intended menu styling.
- Fixed mobile dropdown `aria-labelledby` reference from `drop3` to `drop1`.
3. Reason:
- Mobile burger menu appeared visually broken/inconsistent after BS5 transition.
4. Rollback:
- Restore removed inline style block and previous `aria-labelledby` value.
5. Verification:
- `php -l web/includes/nav.php` passed.

### 2026-02-09 - Mobile burger menu stabilization (CSS block + dropdown geometry)
1. Files:
- `web/css/style.css`
2. Change summary:
- Fixed malformed CSS/media-query structure by adding the missing closing brace for the `max-width: 992px` block.
- Replaced leftover mobile dropdown-link debug color (`orange`) with normal white styling.
- Added explicit mobile burger dropdown positioning rules (`right: 0`, `left: auto`, top alignment, width bounds, higher z-index) for `max-width: 767px`.
- Removed old `left: -60px` mobile offset at `max-width: 520px` and aligned to right edge.
3. Reason:
- Burger menu was visually broken/unusable on mobile due to invalid CSS cascade and conflicting absolute-position offsets.
4. Rollback:
- Revert recent mobile CSS edits in `style.css` around media-query blocks.
5. Verification:
- Visual check on mobile burger open state and panel-finder coexistence.

---

## Open Migration Items
1. Convert remaining legacy DB usage (`mysqli_*`) to PDO in phases (navigation, controller, content, contact flow).
2. Complete Bootstrap 5.3 migration of markup/classes/scripts (currently in compatibility mode).
3. Replace dynamic include patterns with allowlisted layouts/components.
4. Normalize missing preference defaults in templates.
5. Add SQL migration files for required new tables/fields during v5 rollout.

### 2026-02-10 - Bootstrap 5 menu rewrite (parallel include, legacy fallback preserved)
1. Files:
- `web/includes/menu-bs5.php`
- `web/css/menu-bs5.css`
- `web/js/menu-bs5.js`
- `web/inside.php`
- `web/includes/header-code.php`
- `web/includes/footer-code.php`
2. Change summary:
- Added a new Bootstrap 5-native navigation component in `menu-bs5.php` while keeping legacy `nav.php` unchanged.
- Kept existing DB logic and URL formats for top-level, second-level, and third-level menu links.
- Added scoped menu styles and submenu behavior for desktop and mobile in dedicated files.
- Wired safe loading path: `inside.php` now prefers `menu-bs5.php` if present, then existing `menu.php`/`nav.php` fallbacks.
- Added conditional asset includes for `menu-bs5.css` and `menu-bs5.js`.
3. Reason:
- Move shared site navigation toward stable BS5 structure without risking broader legacy-mode behavior or deleting fallback code.
4. Rollback:
- Remove `web/includes/menu-bs5.php`, `web/css/menu-bs5.css`, and `web/js/menu-bs5.js`.
- Revert menu include branch in `web/inside.php` and conditional includes in header/footer code.
5. Verification:
- `php -l web/includes/menu-bs5.php` passed.
- `php -l web/inside.php` passed.
- `php -l web/includes/header-code.php` passed.
- `php -l web/includes/footer-code.php` passed.

### 2026-02-10 - BS5 menu usability polish (desktop hover scope + mobile level differentiation)
1. Files:
- `web/css/menu-bs5.css`
2. Change summary:
- Added scoped desktop overrides so hovering a top-level dropdown no longer forces all nested dropdown panels open.
- Kept hover-open behavior only on the active branch (`top-level` and hovered `submenu`).
- Added clearer visual separation for mobile level-2 vs level-3 items using indent/border/color/font-size differences.
3. Reason:
- Desktop dropdown tree was over-expanded and difficult to use.
- Mobile nested levels needed stronger visual hierarchy.
4. Rollback:
- Remove the new desktop override and mobile level-differentiation rules from `menu-bs5.css`.
5. Verification:
- Manual visual verification required (desktop hover + mobile nested menu readability).

### 2026-02-10 - BS5 menu hover bridge fix + header test-class cleanup
1. Files:
- `web/css/menu-bs5.css`
- `web/includes/header.php`
2. Change summary:
- Removed top-level dropdown gap for BS5 menu by forcing desktop dropdown `top: 100%` and zero margin in scoped menu CSS.
- Removed `test` class from top header wrapper markup.
3. Reason:
- Dropdown collapsed while moving pointer from top-level item into submenu due to hover gap.
- Temporary test marker no longer needed.
4. Rollback:
- Revert the added desktop dropdown position override in `menu-bs5.css`.
- Re-add `test` class in `header.php` if needed.
5. Verification:
- `php -l web/includes/header.php` passed.

### 2026-02-10 - Desktop dropdown polish (choose-label, caret alignment, last-item style restore)
1. Files:
- `web/includes/menu-bs5.php`
- `web/css/menu-bs5.css`
2. Change summary:
- Added a consistent `CHOOSE FROM:` label row at the top of desktop dropdown panels with children.
- Tuned top-level link/caret vertical alignment and hover block sizing.
- Added scoped overrides to prevent legacy `last-child` transparent background rule from stripping final item styling in 2nd/3rd level dropdowns.
3. Reason:
- Improve visual alignment consistency and restore missing final-row styling in nested dropdowns.
4. Rollback:
- Remove `menu-bs5-choose-label` output in `menu-bs5.php`.
- Revert associated style rules in `menu-bs5.css`.
5. Verification:
- `php -l web/includes/menu-bs5.php` passed.

### 2026-02-10 - Panel Finder BS5 rewrite + home banner transition fix
1. Files:
- `web/includes/menu-bs5.php`
- `web/css/menu-bs5.css`
- `web/js/menu-bs5.js`
- `web/css/style.css`
2. Change summary:
- Replaced the panel-finder legacy nested hover markup in `menu-bs5.php` with a Bootstrap 5 dropdown/submenu tree based on existing `panelfinder` table logic.
- Added dedicated panel-finder BS5 styles to preserve current colors/visual direction while using BS5 behavior.
- Added panel-finder submenu cleanup handler in `menu-bs5.js` when dropdown closes.
- Fixed home banner slide white-gap issue by disabling legacy `.item` transition and relying on BS5 `.carousel-item` transition for `#home-banner-carousel`.
3. Reason:
- Complete BS5 migration path for both top navigation and panel-finder menus while keeping legacy `nav.php` fallback.
- Remove carousel transition conflict causing intermittent white flash between slides.
4. Rollback:
- Revert panel-finder section in `menu-bs5.php` to previous legacy block.
- Revert panel-finder style block in `menu-bs5.css`.
- Revert panel-finder dropdown cleanup in `menu-bs5.js`.
- Restore previous `.carousel-inner > .item` transition rules in `style.css`.
5. Verification:
- `php -l web/includes/menu-bs5.php` passed.

### 2026-02-10 - Panel finder 3rd-level alignment + banner full BS5 markup pass
1. Files:
- `web/css/menu-bs5.css`
- `web/includes/banner-large.php`
- `web/css/style.css`
2. Change summary:
- Added explicit `[data-bs-popper]` positioning override so panel-finder nested submenu popouts align flush with their parent row (no vertical offset drift).
- Updated home desktop banner carousel markup to Bootstrap 5-native structure:
  - `carousel-item` classes
  - `data-bs-ride`/`data-bs-interval`
  - BS5 prev/next controls
  - `carousel-fade` mode
- Added black background guard on home carousel track/items to avoid white flash during image transitions.
3. Reason:
- Fix remaining panel-finder submenu vertical alignment gap and remove legacy carousel transition conflicts causing white-screen delay.
4. Rollback:
- Revert the panel-finder `[data-bs-popper]` alignment block in `menu-bs5.css`.
- Restore previous home desktop carousel markup in `banner-large.php`.
- Revert home carousel background/transition rules in `style.css`.
5. Verification:
- `php -l web/includes/banner-large.php` passed.
- `php -l web/includes/menu-bs5.php` passed.
