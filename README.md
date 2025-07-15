=== BoxNow Parcel Search ===
Contributors: thodoriskouris
Tags: woocommerce, boxnow, tracking, parcel, order search
Requires at least: 5.0
Tested up to: 6.5
Requires PHP: 7.4
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Search WooCommerce orders using BoxNow Parcel ID directly from the WordPress admin.

== Description ==

This plugin allows WooCommerce store administrators to easily search orders using the BoxNow parcel ID (stored in `_boxnow_parcel_ids` meta field). Useful for customer support and order tracking.

**Features:**
* Adds a menu page under WooCommerce for searching BoxNow parcel IDs.
* Displays results with order link, parcel ID, customer name, email, and phone.
* Compatible with WooCommerce.

== Installation ==

1. Upload the plugin folder to `/wp-content/plugins/` or install the ZIP from the admin panel.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. Go to `WooCommerce > BoxNow Search` to use it.

== Frequently Asked Questions ==

= Where is the data stored? =
The plugin searches in the `_boxnow_parcel_ids` post meta field in WooCommerce orders.

= Does it support multiple parcel IDs? =
Yes. It unserializes the meta and displays all parcel IDs linked to the order.

== Screenshots ==

1. Admin screen to search for BoxNow parcel ID.
2. Search results with customer details.

== Changelog ==

= 1.0.0 =
* Initial release.

== Upgrade Notice ==

= 1.0.0 =
Initial version.

== License ==

This plugin is licensed under the GPLv2 or later.
