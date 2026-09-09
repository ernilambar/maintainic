=== Maintainic ===
Contributors: nilambar
Tags: maintenance mode, coming soon, under maintenance
Requires at least: 6.6
Tested up to: 7.1
Requires PHP: 8.0
Stable tag: 1.0.1
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/old-licenses/gpl-2.0.txt

Simple maintenance mode plugin for WordPress.

== Description ==

Maintainic is a lightweight maintenance mode plugin. When enabled, visitors see a customizable maintenance page while administrators can still view and edit the site.

**Features:**

* Enable/disable maintenance mode with a single toggle
* Customize site title, headline, and description
* Set background image and colors
* Logged-in administrators bypass maintenance mode automatically
* Returns 503 Service Unavailable status code

== Installation ==

1. Upload the plugin folder to `/wp-content/plugins/`
2. Activate the plugin through the Plugins menu
3. Go to Settings > Maintainic to configure

== Frequently Asked Questions ==

= Who can see the site during maintenance? =

Only logged-in users with administrator capabilities (manage_options) can view the front end. All other visitors see the maintenance page.

= Can I customize the maintenance page? =

Yes. You can set the headline, description, background image, background color, and text color from the settings page.

== Changelog ==

= 1.0.1 - 09 Sep 2026 =
* Add Git updater

= 1.0.0 =
* Initial release
