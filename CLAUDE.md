# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project

Maintainic is a WordPress maintenance-mode plugin. When the `main_switch` option is on, public requests are intercepted on `template_redirect` and replaced with the template at [templates/maintenance-page.php](templates/maintenance-page.php) (HTTP 503, no-cache). Logged-in users with `manage_options` bypass the page.

## Architecture

PSR-4 autoload: `Maintainic\` → [app/](app/) (see [composer.json](composer.json)).

Boot flow ([maintainic.php](maintainic.php)):
1. Defines `MAINTAINIC_VERSION`, `MAINTAINIC_DIR`, `MAINTAINIC_URL`, `MAINTAINIC_BASENAME`, `MAINTAINIC_BASE_FILENAME`.
2. Loads `vendor/autoload.php` **and explicitly requires** `vendor/ernilambar/optiz/init.php` — Optiz is not auto-bootstrapped by Composer, so this require is load-bearing.
3. Instantiates [Bootstrap](app/Core/Bootstrap.php), which news up [Options](app/Options/Options.php) and [Maintenance](app/Core/Maintenance.php).

Three concerns, three classes:
- [app/Options/Options.php](app/Options/Options.php) — registers the settings page (`Settings → Maintainic`) declaratively via `Nilambar\Optiz\Manager::register('maintainic', …)`. The instance ID `'maintainic'` and the option key `'maintainic_options'` must stay in sync with the lookup in [app/Setup/Option.php](app/Setup/Option.php).
- [app/Setup/Option.php](app/Setup/Option.php) — thin static facade: `Option::get($key)` → `Manager::instance('maintainic')->get($key)`. Always read options through this, not directly from the WP options API or Optiz, so the rest of the codebase doesn't depend on Optiz internals.
- [app/Core/Maintenance.php](app/Core/Maintenance.php) — request-time gate on `template_redirect`.

The Optiz framework ([vendor/ernilambar/optiz/](vendor/ernilambar/optiz/)) is the third-party options library backing all admin UI; field types used include `toggle`, `text`, `textarea`, `image`, `color`.

## Commands

PHP (Composer scripts):
- `composer lint` — runs `lint-php` then `phpcs`.
- `composer lint-php` — `parallel-lint` syntax check.
- `composer phpcs` — WordPress Coding Standards via [.phpcs.xml.dist](.phpcs.xml.dist).
- `composer format` — `phpcbf` autofix.

JS / packaging (pnpm; this repo uses pnpm, lockfile is `pnpm-lock.yaml`):
- `pnpm run vendor` — `composer install --no-dev --no-scripts -o` (production vendor only).
- `pnpm run predeploy` — wipes `build/`, `deploy/`, `vendor/` then re-runs `vendor`.
- `pnpm run deploy` — `packtor` builds the distributable zip per the `packtor.files` glob in [package.json](package.json).
- `pnpm run version` — `easy-replace-in-files` driven by [easy-replace.json](easy-replace.json); use this to bump the version in all the right places rather than editing by hand.

There is no test suite.

## Coding standards (enforced by phpcs)

[.phpcs.xml.dist](.phpcs.xml.dist) is strict; before adding/changing PHP, know:
- **WordPress + WordPress-Extra** rulesets, plus PHPCompatibility tested against `7.4-` (the plugin header advertises PHP 7.4, even though `composer.json` requires 8.0 for dev). Don't use 8.0-only syntax in plugin code.
- **Short arrays only** (`Generic.Arrays.DisallowLongArraySyntax`).
- **Slevomat namespace rules**: `use` statements must be alphabetically sorted; no grouped use; no leading backslash; unused uses flagged (annotations scanned too); functions/classes/constants must be imported via `use` rather than referenced fully-qualified (global functions/constants are allowed unprefixed as a fallback).
- **Text domain** is `maintainic` — enforced; the I18nTextDomainFixer will rewrite an empty domain to it.
- `declare(strict_types=1);` is used in every class file — keep it.
- Tabs for indentation (see [.editorconfig](.editorconfig)).

## Conventions worth knowing

- New admin settings: add a field entry to the `fields` array in [app/Options/Options.php](app/Options/Options.php), then read it via `Option::get('your_key')`. The default declared there is what `Option::get` returns when the user hasn't saved a value.
- New runtime behavior: prefer a new class under [app/](app/) wired in from [Bootstrap::__construct](app/Core/Bootstrap.php) rather than adding hooks inline in the plugin file.
- The maintenance page template is a plain PHP file with inline `<style>` — there are no compiled assets, no build step for CSS/JS.
