=== coreyhall93 Site Modes ===
Contributors: coreyhall93
Donate link: https://coreyhall93.com/buy-me-a-coffee/
Tags: maintenance mode, coming soon, under construction, white page, custom mode
Requires at least: 5.0
Tested up to: 6.8
Stable tag: 1.0.0
Requires PHP: 7.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Display maintenance, coming soon, white page, or custom mode pages with WordPress-styled UI.

== Description ==

coreyhall93 Site Modes allows you to quickly put your WordPress site into various modes that display a simple, WordPress-styled message page to all visitors. Perfect for maintenance windows, new site launches, or suspended accounts.

**Features:**

* **Maintenance Mode** - Display a maintenance message during scheduled updates
* **Coming Soon Mode** - Show a coming soon page for sites under development
* **White Page Mode** - Professional message for unpaid/suspended sites (e.g., "Contact your website host")
* **Custom Mode** - Create fully customized messages with the WordPress HTML editor
* **WordPress-styled UI** - Matches the native WordPress critical error page styling
* **Admin Bypass** - Administrators always see the site normally while logged in
* **SEO Friendly** - Returns proper HTTP 503 status code to inform search engines

**How It Works:**

When a mode is active, all visitors (except administrators) see only your message page, regardless of which URL they visit. The page styling matches WordPress's own critical error pages for a professional, familiar look.

== Installation ==

1. Upload the `site-modes-x-coreyhall93` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to Settings > Site Modes to configure your modes

== Frequently Asked Questions ==

= Will I be locked out of my site? =

No! Administrators (users with the `manage_options` capability) always see the site normally. You can access your admin dashboard and front-end without any restrictions.

= What HTTP status code does it return? =

The plugin returns a 503 (Service Unavailable) status code, which tells search engines the site is temporarily unavailable. This prevents negative SEO impact during maintenance.

= Can I use HTML in my messages? =

Yes! The Custom Mode includes a full WordPress editor where you can add HTML, links, formatting, and more. The other modes use plain text for simplicity.

= Does it work with caching plugins? =

You may need to clear your cache after changing modes. Some caching plugins may cache the maintenance page, so consider excluding your site from caching during mode changes.

= Can I customize the page styling? =

The current version uses WordPress's native styling for consistency. Future versions may include custom CSS options.

== Screenshots ==

1. Admin settings page with mode selection
2. Maintenance mode display
3. Coming soon mode display
4. White page mode for suspended sites
5. Custom mode with HTML editor

== Changelog ==

= 1.0.0 =
* Initial release
* Maintenance mode functionality
* Coming soon mode functionality
* White page mode for unpaid/suspended sites
* Custom mode with WordPress HTML editor
* WordPress-styled error page design
* Admin bypass feature
* 503 HTTP status code support

== Upgrade Notice ==

= 1.0.0 =
Initial release of Site Modes x CoreyHall93.
