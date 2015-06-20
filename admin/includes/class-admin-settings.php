<?php
/**
 * Admin Settings Class For WooCommerce Role Based Price
 *
 * @link       https://wordpress.org/plugins/woocommerce-role-based-price/
 * @since      0.3
 *
 * @package    WooCommerce_Role_Based_Price
 * @subpackage WooCommerce_Role_Based_Price/admin
 * 
 * @package    WooCommerce_Role_Based_Price
 * @subpackage WooCommerce_Role_Based_Price/admin
 * @author     Varun Sridharan <varunsridharan23@gmail.com>
 */

class WooCommerce_Role_Based_Price_Admin_Settings{
    
    private static $_instance = null;
    
    
    /**
	 * Initialize the class and set its properties.
	 * @since      0.1
	 */
	public function __construct() {
        $this->id    = 'wc_rbp';
        $this->menu_name = 'WC Role Based Price';
        
        add_filter( 'woocommerce_settings_tabs_array', array( $this, 'add_settings_tab' ), 50 );

        add_action( 'woocommerce_settings_' . $this->id, array( $this, 'output' ) );
        add_action( 'woocommerce_settings_save_' . $this->id, array( $this, 'save' ) );        
	}
    
    /**
     * Provides access to a single instances of the class using the singleton pattern
     * @return object
     */
    public static function get_instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    
    /**
     * Add plugin options tab
     * @return array
     */
    public function add_settings_tab( $settings_tabs ) {
        $settings_tabs[$this->id] = $this->menu_name;
        return $settings_tabs;
    }


    /**
     * Get sections
     * @return array
     */
    public function get_sections() {
        $sections = array(
            'general' => __( 'General Settings', $this->id ),
        );
        return apply_filters( 'woocommerce_get_sections_' . $this->id, $sections );
    }   
    
    
    /**
     * Output the settings
     */
    public function output() {
        global $current_section;
        $settings = $this->get_settings( $current_section );  
        WC_Admin_Settings::output_fields( $settings );
    }
    
    
    /**
     * Save settings
     */
    public function save() {
        global $current_section;
        $settings = $this->get_settings( $current_section );
        WC_Admin_Settings::save_fields( $settings );
    }   
   
    public function get_selectbox_user_role(){
        $user_roles = WC_RBP()->get_registered_roles();
        $list_roles = '';
        $roles = array_keys($user_roles);
        foreach($roles as $role){
            $list_roles[$role] = $user_roles[$role]['name'];
        }
        return $list_roles;
    }
    
    /**
     * Get sections
     * @return array
     */
    public function get_settings() {
        $width = "width:50% !important;";
        echo '<pre>';
       
        echo '</pre>';
        $settings = array(
            'section_title' => array(
                'name' => 'WooCommerce Role Based Price Settings',
                'type' => 'title',
                'desc' => '',
                'id' => rbp_key.'general_start'
            ), 			

            WC_DB_KEY.'allowed_role' => array(
                'name' => 'Allowed User Roles',
                'desc' => 'User Roles To List In Product Edit Page',
                'id' => WC_DB_KEY.'list_roles',
                'type' => 'multiselect', 
                'class' =>'chosen_select',
                'css'     => $width,
                'options' =>  $this->get_selectbox_user_role()
            ), 	

            WC_DB_KEY.'allowed_price' => array(
                'name' => 'Allowed Product Pricing',
                'desc' => 'Price Fields To List In Product Edit Page',
                'id' => WC_DB_KEY.'allowed_price',
                'type' => 'multiselect', 
                'class' =>'chosen_select',
                'css'     => $width,
                'options' =>  array('regular' => 'Regular Price','sale' => 'Sale Price')
            ),             
            'section_end' => array(
                'type' => 'sectionend',
                'id' => rbp_key.'general_end'
            )
        );
        return $settings;
    }
  
    
}
?>