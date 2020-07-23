<?php

class WP_SMART_WOO_SHIPPING{
    private static $instance = null;
    /**
     * call init when you require this file
     */
    public static function init(){
        if(null === self::$instance ){
            self::$instance = new self;
        }
        return self::$instance;
    }
    public function __construct(){
        add_action( 'woocommerce_shipping_init', [$this, 'woocommerce_shipping_init'] );
        
        add_filter( 'woocommerce_shipping_methods', [$this, 'custom_shipping_method'] );
    }

    public function woocommerce_shipping_init() {
        if ( ! class_exists( 'WOO_SHIPPING_METHOD' ) ) {
            require_once(WPSMARTSHIPPING_PATH. 'inc/woo-shipping-method.php');
		}
    }

    public function custom_shipping_method( $methods ) {
        $methods['wp_smart_shipping'] = 'WOO_SHIPPING_METHOD';
		return $methods;
	}

    

}

?>