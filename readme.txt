=== Ailaan ===
Contributors: inderpreet99
Donate link: https://inderpreetsingh.com/
Tags: announcements
Requires at least: 6.0
Tested up to: 6.4.2
Stable tag: 0.1
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Save announcements in the Options to allow REST API retrieval

== Description ==

Ailaan stands for Declaration in Indic languages like Hindi and Punjabi.

This pluging can be used to save announcements into WordPress and then pulling announcements via REST API to show on digital signage.

Use the REST API at https://WORDPRESS-URL/wp-json/ailaan/v1/get to retrieve the current ailaan.

= Permissions =

A sevadar user role (which means volunteer in Punjabi) is created. Typically, this role will be assigned to a user account given to the local manager, who can set the announcements through the WP Admin console. This allows us to limit the account of the user setting the announcements.

"Ailaan" capability is created for easy permissions. It is default assigned to sevadar, administrator, author and editor.

= Usage =

Use it as a way to save annnouncements to DB that can be retrieved via REST API.

= Tips =

* On digital signage solution, install a Chrome extension to pull from the REST API by polling for this announcement, so it can be shown on the digital signage.

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/ailaan` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress
1. Use the `WP Admin > Ailaan > Settings` screen to configure.
1. Set the announcement in the `WP Admin > Ailaan` screen.

== Frequently Asked Questions ==

= Can I contribute to this plugin? =

Submit a pull request at the [inderpreet99/ailaan repo](https://github.com/inderpreet99/ailaan).

= Problems? =

Report in Support ASAP.

== Upgrade Notice ==

= 0.1 =
* Release plugin on WordPress.org.

== Changelog ==

= 0.1 =
* Release plugin on WordPress.org.
