# AGENTS

## Overview

Maintainic is a WordPress maintenance-mode plugin. Public requests are intercepted on `template_redirect` and served a 503 maintenance page; logged-in users with `manage_options` bypass it. Core stack: PHP (WordPress, PSR-4), pnpm for packaging.

## Setup

```bash
pnpm install        # JS tooling (packtor, easy-replace-in-files)
composer install    # PHP dependencies + Composer scripts
```

Requires PHP >= 8.0 for dev; plugin code must remain compatible with PHP 7.4.

## Commands

```bash
composer lint        # parallel-lint + phpcs (full code check)
composer lint-php    # PHP syntax check only
composer phpcs       # WordPress Coding Standards
composer format      # phpcbf autofix
pnpm run vendor      # composer install --no-dev --no-scripts -o
pnpm run predeploy   # clean build/deploy/vendor, then vendor
pnpm run deploy      # build distributable zip via packtor
pnpm run version     # bump version via easy-replace-in-files
```

## Conventions

- **PSR-4 autoload**: `Maintainic\` maps to `app/`. Place new classes there and wire them from `Bootstrap::__construct()`.
- **Read options only through `Option::get($key)`** (`app/Setup/Option.php`) — never call `Manager` or the WP options API directly outside that facade. The Optiz instance ID is `'maintainic'`; the option key is `'maintainic_options'`.
- **`declare(strict_types=1);` is required** in every PHP class file.
- **Short arrays only** — `[]`, not `array()`.
- **Use statements must be alphabetically sorted**, no grouped use, no leading backslash; import functions/classes/constants via `use` rather than fully-qualifying them.
- **Text domain is `maintainic`** for all `__()` / `_e()` / `esc_html__()` calls.
- **Tabs for indentation** in PHP; see `.editorconfig`.
- **No build step for CSS/JS** — the maintenance template is plain PHP with inline `<style>`.

## Quality Gate

Before declaring any task complete, run and verify exit code 0:

```bash
composer lint
```
