<?php
class WOO_SHIPPING_METHOD extends WC_Shipping_Method {
    /**
     * Constructor for your shipping class
     *
     * @access public
     * @return void
     */
    public function __construct($instance_id = 0) {
        
        $this->id                 = 'wp_smart_shipping'; // Id for your shipping method. Should be uunique.
        $this->instance_id  = absint( $instance_id );
        $this->method_title       = __( 'WP Smart Shipping' );  // Title shown in admin
        $this->method_description = __( 'Smart Shipping for any of complex shipping' ); // Description shown in admin

        $this->enabled            = "yes"; // This can be added as an setting but for this example its forced enabled
        $this->title              = "WP Smart Shipping Method"; // This can be added as an setting but for this example its forced.
        // $this->supports = array(
        //     'shipping-zones',
        //     'instance-settings',
        //     'instance-settings-modal',
        // );

        $this->init();
        
    }

    /**
     * Init your settings
     *
     * @access public
     * @return void
     */
    function init() {
        // Load the settings API
        $this->init_form_fields(); // This is part of the settings API. Override the method to add your own settings
        $this->init_settings(); // This is part of the settings API. Loads settings you previously init.

        // Save settings in admin if you have any defined
        add_action( 'woocommerce_update_options_shipping_' . $this->id, array( $this, 'process_admin_options' ) );
    }

    /**
     * Initialise Gateway Settings Form Fields
     */
    public function init_form_fields() {
        $this->form_fields = array(

            'enabled' => array(
                'title' => __( 'Enable', 'wp-smartshipping' ),
                'type' => 'checkbox',
                'description' => __( 'Enable this shipping.', 'wp-smartshipping' ),
                'default' => 'yes'
            ),

           'title' => array(
                'title' => __( 'Title', 'wp-smartshipping' ),
                'type' => 'text',
                'description' => __( 'Title to be display on site', 'wp-smartshipping' ),
                'default' => __( 'TutsPlus Shipping', 'wp-smartshipping' )
            ),

           'quantity' => array(
                'title' => __( 'Quantity', 'wp-smartshipping' ),
                'type' => 'number',
                'description' => __( 'Maximum allowed weight', 'wp-smartshipping' ),
                'default' => 100
            ),

        );

            
    } // End init_form_fields()

    /**
     * calculate_shipping function.
     *
     * @access public
     * @param mixed $package
     * @return void
     */
    public function calculate_shipping( $package = array() ) {
        // echo '<pre>';
        // var_dump ('hello', $package);
        // echo '</pre>';
        // die();
        $rate = array(
            'id' => $this->id,
            'label' => $this->title,
            'cost' => '10.99',
            'taxes' => '',   // Pass an array of taxes, or pass nothing to have it calculated for you, or pass 'false' to calculate no tax for this method
            'calc_tax' => 'per_item'
        );
        
        // Register the rate
        $this->add_rate( $rate );
    }
}

?>