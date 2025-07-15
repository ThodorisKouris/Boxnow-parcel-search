<?php
/**
 * Plugin Name: BoxNow Parcel Search
 * Description: Αναζήτηση παραγγελιών WooCommerce με βάση το BoxNow Parcel ID.
 * Version: 1.0.0
 * Author: Thodoris Kouris
 * Text Domain: https://fds.gr/
 * Requires at least: 5.0
 * Requires PHP: 7.4
 * Author URI: https://fds.gr/
 * License: GPL2
 */

 add_action('admin_menu', function() {
     add_menu_page(
         'BoxNow Search',
         'BoxNow Search',
         'manage_woocommerce',
         'boxnow-search',
         'boxnow_search_page'
     );
 });
 
 function boxnow_search_page() {
     ?>
     <div class="wrap">
         <h1>Αναζήτηση BoxNow Parcel ID</h1>
         <form method="get">
             <input type="hidden" name="page" value="boxnow-search">
             <input type="text" name="parcel_id" placeholder="Εισάγετε Parcel ID" style="width:300px;" value="<?php echo esc_attr($_GET['parcel_id'] ?? ''); ?>">
             <button type="submit" class="button button-primary">Αναζήτηση</button>
         </form>
 
         <?php
         if (!empty($_GET['parcel_id'])) {
             global $wpdb;
             $parcel_id = sanitize_text_field($_GET['parcel_id']);
 
             $results = $wpdb->get_results($wpdb->prepare("
                 SELECT post_id, MAX(meta_value) as meta_value
                 FROM {$wpdb->prefix}postmeta
                 WHERE meta_key = '_boxnow_parcel_ids'
                   AND meta_value LIKE %s
                 GROUP BY post_id
             ", '%' . $wpdb->esc_like($parcel_id) . '%'));
 
             if ($results) {
                 echo '<h2>Αποτελέσματα:</h2>';
                 echo '<table class="widefat fixed striped">';
                 echo '<thead><tr>
                         <th>Order ID</th>
                         <th>Parcel ID</th>
                         <th>Customer</th>
                         <th>Email</th>
                         <th>Phone</th>
                     </tr></thead><tbody>';
 foreach ($results as $row) {
     $order = wc_get_order($row->post_id);
     if (!$order) continue;
 
     // === Αποκωδικοποίηση serialized value ===
     $parcel_data = maybe_unserialize($row->meta_value);
     if (is_array($parcel_data)) {
         $parcel_id_clean = implode(', ', $parcel_data); // Αν υπάρχουν πολλά, τα ενώνει
     } else {
         $parcel_id_clean = $row->meta_value; // fallback
     }
 
     echo '<tr>';
     echo '<td><a href="' . admin_url('post.php?post=' . $row->post_id . '&action=edit') . '">' . $row->post_id . '</a></td>';
     echo '<td>' . esc_html($parcel_id_clean) . '</td>';
     echo '<td>' . esc_html($order->get_billing_first_name() . ' ' . $order->get_billing_last_name()) . '</td>';
     echo '<td>' . esc_html($order->get_billing_email()) . '</td>';
     echo '<td>' . esc_html($order->get_billing_phone()) . '</td>';
     echo '</tr>';
 }
 
                 echo '</tbody></table>';
             } else {
                 echo '<p>❌ Δεν βρέθηκε καμία παραγγελία που να περιέχει αυτό το Parcel ID.</p>';
             }
         }
         ?>
     </div>
     <?php
 }