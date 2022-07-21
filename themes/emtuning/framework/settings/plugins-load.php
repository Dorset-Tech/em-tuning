<?php
if ( ! class_exists( 'Azirspares_PluginLoad' ) ) {
	class Azirspares_PluginLoad {
		public $plugins = array();
		public $config  = array();
		
		public function __construct() {
			$this->plugins();
			$this->config();
			if ( ! class_exists( 'TGM_Plugin_Activation' ) ) {
				return;
			}
			if ( function_exists( 'tgmpa' ) ) {
				tgmpa( $this->plugins, $this->config );
			}
		}
		
		public function plugins() {
			$this->plugins = array(
				array(
					'name'               => 'Azirspares Toolkit',
					'slug'               => 'azirspares-toolkit',
					'source'             => get_template_directory() . '/framework/plugins/azirspares-toolkit.zip',
					'version'            => '1.3.0',
					'required'           => true,
					'force_activation'   => false,
					'force_deactivation' => false,
					'external_url'       => '',
					'image'              => '',
				),
				array(
					'name'               => 'WPBakery Visual Composer',
					'slug'               => 'js_composer',
					'source'             => get_template_directory() . '/framework/plugins/js_composer.zip',
					'required'           => true,
					'version'            => '6.0.5',
					'force_activation'   => false,
					'force_deactivation' => false,
					'external_url'       => '',
					'image'              => '',
				),
				array(
					'name'     => 'WooCommerce',
					'slug'     => 'woocommerce',
					'required' => true,
					'image'    => '',
				),
				array(
					'name'               => 'WooCommerce Product Filter',
					'slug'               => 'prdctfltr',
					'source'             => get_template_directory() . '/framework/plugins/prdctfltr.zip',
					'required'           => false,
					'version'            => '6.6.3',
					'force_activation'   => false,
					'force_deactivation' => false,
					'external_url'       => '',
					'image'              => esc_url( '' ),
				),
				array(
					'name'               => 'Fami Automotive Listings',
					'slug'               => 'fami-automotive',
					'source'             => get_template_directory() . '/framework/plugins/fami-automotive.zip',
					'version'            => '1.2.3',
					'required'           => true,
					'force_activation'   => false,
					'force_deactivation' => false,
					'external_url'       => '',
					'image'              => '',
				),
				array(
					'name'               => 'Fami Buy Together',
					'slug'               => 'fami-buy-together',
					'source'             => get_template_directory() . '/framework/plugins/fami-buy-together.zip',
					'version'            => '1.0.2',
					'required'           => true,
					'force_activation'   => false,
					'force_deactivation' => false,
					'external_url'       => '',
					'image'              => '',
				),
				array(
					'name'               => 'Ziss - WooCommerce Product Pinner',
					'slug'               => 'ziss',
					'source'             => get_template_directory() . '/framework/plugins/ziss.zip',
					'version'            => '2.9',
					'required'           => true,
					'force_activation'   => false,
					'force_deactivation' => false,
					'external_url'       => '',
					'image'              => '',
				),
				array(
					'name'               => 'Revolution Slider',
					'slug'               => 'revslider',
					'source'             => get_template_directory() . '/framework/plugins/revslider.zip',
					'required'           => true,
					'version'            => '5.4.8.3',
					'force_activation'   => false,
					'force_deactivation' => false,
					'external_url'       => '',
					'image'              => '',
				),
				array(
					'name'     => 'Fami Sales Popup',
					'slug'     => 'fami-sales-popup',
					'required' => false,
					'image'    => esc_url( '' ),
				),
				array(
					'name'               => 'WooCommerce Cart popup premium',
					'slug'               => 'woocommerce-cart-popup-premium',
					'source'             => get_template_directory() . '/framework/plugins/woocommerce-cart-popup-premium.zip',
					'required'           => false,
					'version'            => '',
					'force_activation'   => false,
					'force_deactivation' => false,
					'external_url'       => '',
					'image'              => '',
				),
				array(
					'name'     => 'YITH WooCommerce Compare',
					'slug'     => 'yith-woocommerce-compare',
					'required' => false,
					'image'    => '',
				),
				array(
					'name'     => 'YITH WooCommerce Wishlist',
					'slug'     => 'yith-woocommerce-wishlist',
					'required' => false,
					'image'    => '',
				),
				array(
					'name'     => 'YITH WooCommerce Quick View',
					'slug'     => 'yith-woocommerce-quick-view',
					'required' => false,
					'image'    => '',
				),
				array(
					'name'     => 'Contact Form 7',
					'slug'     => 'contact-form-7',
					'required' => false,
					'image'    => '',
				),
			);
		}
		
		public function config() {
			$this->config = array(
				'id'           => 'azirspares',
				'default_path' => '',
				'menu'         => 'azirspares-install-plugins',
				'parent_slug'  => 'themes.php',
				'capability'   => 'edit_theme_options',
				'has_notices'  => true,
				'dismissable'  => true,
				'dismiss_msg'  => '',
				'is_automatic' => true,
				'message'      => '',
			);
		}
	}
}
if ( ! function_exists( 'Azirspares_PluginLoad' ) ) {
	function Azirspares_PluginLoad() {
		new  Azirspares_PluginLoad();
	}
}
add_action( 'tgmpa_register', 'Azirspares_PluginLoad' );