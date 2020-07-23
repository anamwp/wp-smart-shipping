<?php
/*
Plugin Name: WP Smart Shipping
Description: Smart Shipping plugin for WooCommerce
Plugin URI: https://themesgrove.com/
Version: 1.0.0
Author: Themesgrove
Author URI: https://themesgrove.com
@package  wp_spmart_shipping
Domain Path: /languages
WC requires at least: 3.0.0
WC tested up to: 3.8.0
License: GPL3
License URI: https://www.gnu.org/licenses/gpl-3.0.txt
Text Domain: wp-smart-shipping
*/

/**
 * Define absoulote path
 * No access of directly access
 */
if( !defined( 'ABSPATH' ) ) exit; 

/**
 * define constants
 */
define('WPSMARTSHIPPING_VERSION', '1.0.0');
define('WPSMARTSHIPPING_FILE', __FILE__); 
define('WPSMARTSHIPPING_URL', plugins_url('/', __FILE__ ) );
define('WPSMARTSHIPPING_PATH', plugin_dir_path( __FILE__ ) );

class WP_SMART_SHIPPING{
    public function __construct(){
        add_action( 'plugins_loaded', array( $this, 'plugin_setup' ) );
    }
    public function activate(){
        flush_rewrite_rules();
    }
    public function deactivate(){
        flush_rewrite_rules();
    }
    public function plugin_setup(){
        require_once(WPSMARTSHIPPING_PATH. 'inc/woo-shipping.php');
        WP_SMART_WOO_SHIPPING::init();

    }
}

/**
 * initiate class
 */
if (class_exists('WP_SMART_SHIPPING')) {
    $wp_smart_shipping = new WP_SMART_SHIPPING();
}
/**
 * active the plugin
 */
register_activation_hook( __FILE__, array($wp_smart_shipping, 'activate' ));
/**
 * deactive the plugin
 */
register_deactivation_hook( __FILE__, array($wp_smart_shipping, 'deactivate' ));