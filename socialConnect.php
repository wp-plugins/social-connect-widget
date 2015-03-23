<?php
/*
 * Plugin Name: Social Connect Widget
 * Version: 1.7.0
 * Plugin URI: http://www.newspress.io/
 * Description: A widget designed to easily add icons with links to your social pages on all the major networks.
 * Author: NewsPress
 * Author URI: http://www.newspress.io/
 */
?>
<?php
// Declare the version number
$sc_version = '1.7.0';

//Add necessary includes
require_once(dirname(__FILE__) . '/inc/output.php');
require_once(dirname(__FILE__) . '/inc/functions.php');
require_once(dirname(__FILE__) . '/inc/settings.php');
require_once(dirname(__FILE__) . '/inc/widget.php');

// Add the header code (css & javascript) to WordPress page
add_action('init', 'addHeaderCode');

// Runs when plugin is activated
register_activation_hook(__FILE__,'socialConnect_install'); 

// Runs on plugin deactivation
register_deactivation_hook( __FILE__, 'socialConnect_remove' );

//Determine if the plugin has been being updated from version 1.2 and remove depreciated table
global $wpdb;
if($wpdb->get_var("SHOW TABLES LIKE 'SCW_Stats';") == 'SCW_Stats') {
	$wpdb->query("DROP TABLE SCW_Stats");
}

//Display admin messages
add_action('admin_notices', 'socialConnect_adminNotice');
add_action('admin_init', 'socialConnect_adminNotice_ignore');

// Add the widget	
add_action('widgets_init', 'socialConnect_registerWidget');

//Register the shortcode
add_shortcode("social-connect", "socialConnect_shortcodeHandler");

// Run updates for existing users
add_action( 'plugins_loaded', 'socialconnect_update' );
?>