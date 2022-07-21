<?php if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access pages directly.
if ( ! class_exists( 'Azirspares_ThemeOption' ) ) {
	class Azirspares_ThemeOption {
		public function __construct() {
			add_filter( 'cs_framework_settings', array( $this, 'framework_settings' ) );
			add_filter( 'cs_framework_options', array( $this, 'framework_options' ) );
			add_filter( 'cs_metabox_options', array( $this, 'metabox_options' ) );
		}
		
		public function get_header_preview() {
			$layoutDir      = get_template_directory() . '/templates/header/';
			$header_options = array();
			if ( is_dir( $layoutDir ) ) {
				$files = scandir( $layoutDir );
				if ( $files && is_array( $files ) ) {
					foreach ( $files as $file ) {
						if ( $file != '.' && $file != '..' ) {
							$fileInfo = pathinfo( $file );
							if ( $fileInfo['extension'] == 'php' && $fileInfo['basename'] != 'index.php' ) {
								$file_data                    = get_file_data( $layoutDir . $file, array( 'Name' => 'Name' ) );
								$file_name                    = str_replace( 'header-', '', $fileInfo['filename'] );
								$header_options[ $file_name ] = array(
									'title'   => $file_data['Name'],
									'preview' => get_theme_file_uri( '/templates/header/header-' . $file_name . '.jpg' ),
								);
							}
						}
					}
				}
			}
			
			return $header_options;
		}
		
		public function get_social_options() {
			$socials     = array();
			$all_socials = cs_get_option( 'user_all_social' );
			if ( $all_socials ) {
				foreach ( $all_socials as $key => $social ) {
					$socials[ $key ] = $social['title_social'];
				}
			}
			
			return $socials;
		}
		
		public function get_footer_preview() {
			$footer_preview = array();
			$args           = array(
				'post_type'      => 'footer',
				'posts_per_page' => - 1,
				'orderby'        => 'title',
				'order'          => 'ASC',
			);
			$loop           = get_posts( $args );
			foreach ( $loop as $value ) {
				setup_postdata( $value );
				$footer_preview[ $value->ID ] = array(
					'title'   => $value->post_title,
					'preview' => wp_get_attachment_image_url( get_post_thumbnail_id( $value->ID ), 'full' ),
				);
			}
			
			return $footer_preview;
		}
		
		public function get_sidebar_options() {
			$sidebars = array();
			global $wp_registered_sidebars;
			foreach ( $wp_registered_sidebars as $sidebar ) {
				$sidebars[ $sidebar['id'] ] = $sidebar['name'];
			}
			
			return $sidebars;
		}
		
		public function get_shop_product_preview() {
			$layoutDir            = get_template_directory() . '/woocommerce/product-styles/';
			$shop_product_options = array();
			if ( is_dir( $layoutDir ) ) {
				$files = scandir( $layoutDir );
				if ( $files && is_array( $files ) ) {
					foreach ( $files as $file ) {
						if ( $file != '.' && $file != '..' ) {
							$fileInfo = pathinfo( $file );
							if ( $fileInfo['extension'] == 'php' && $fileInfo['basename'] != 'index.php' && $fileInfo['filename'] != 'content-product-list' && $fileInfo['filename'] != 'content-product-style-06' && $fileInfo['filename'] != 'content-product-style-07' && $fileInfo['filename'] != 'content-product-style-08' && $fileInfo['filename'] != 'content-product-style-09' && $fileInfo['filename'] != 'content-product-style-10' && $fileInfo['filename'] != 'content-product-style-11' ) {
								$file_data                          = get_file_data( $layoutDir . $file, array( 'Name' => 'Name' ) );
								$file_name                          = str_replace( 'content-product-', '', $fileInfo['filename'] );
								$shop_product_options[ $file_name ] = array(
									'title'   => $file_data['Name'],
									'preview' => get_theme_file_uri( '/woocommerce/product-styles/content-product-' . $file_name . '.jpg' ),
								);
							}
						}
					}
				}
			}
			
			return $shop_product_options;
		}
		
		function framework_settings( $settings ) {
			// ===============================================================================================
			// -----------------------------------------------------------------------------------------------
			// FRAMEWORK SETTINGS
			// -----------------------------------------------------------------------------------------------
			// ===============================================================================================
			$settings = array(
				'menu_title'      => esc_html__( 'Theme Options', 'azirspares' ),
				'menu_type'       => 'submenu', // menu, submenu, options, theme, etc.
				'menu_slug'       => 'azirspares',
				'ajax_save'       => false,
				'menu_parent'     => 'azirspares_menu',
				'show_reset_all'  => true,
				'menu_position'   => 5,
				'framework_title' => '<a href="' . esc_url( 'https://azirspares.namcrafted.com/' ) . '" target="_blank"><img src="' . get_theme_file_uri( '/assets/images/logo-options.png' ) . '" alt="' . esc_attr( 'azirspares' ) . '"></a> <i>' . esc_html__( 'By ', 'azirspares' ) . '<a href="' . esc_url( 'https://themeforest.net/user/fami_themes/portfolio' ) . '" target="_blank">' . esc_html__( 'FamiThemes', 'azirspares' ) . '</a></i>',
			);
			
			return $settings;
		}
		
		function framework_options( $options ) {
			// ===============================================================================================
			// -----------------------------------------------------------------------------------------------
			// FRAMEWORK OPTIONS
			// -----------------------------------------------------------------------------------------------
			// ===============================================================================================
			$options = array();
			// ----------------------------------------
			// a option section for options overview  -
			// ----------------------------------------
			$options[] = array(
				'name'     => 'general',
				'title'    => esc_html__( 'General', 'azirspares' ),
				'icon'     => 'fa fa-wordpress',
				'sections' => array(
					array(
						'name'   => 'main_settings',
						'title'  => esc_html__( 'Main Settings', 'azirspares' ),
						'fields' => array(
							array(
								'id'    => 'azirspares_logo',
								'type'  => 'image',
								'title' => esc_html__( 'Logo', 'azirspares' ),
							),
							array(
								'id'      => 'azirspares_width_logo',
								'type'    => 'number',
								'default' => '215',
								'title'   => esc_html__( 'Width Logo', 'azirspares' ),
								'desc'    => esc_html__( 'Unit PX', 'azirspares' )
							),
							array(
								'id'      => 'azirspares_main_color',
								'type'    => 'color_picker',
								'title'   => esc_html__( 'Main Color', 'azirspares' ),
								'default' => '#eeab10',
								'rgba'    => true,
							),
							array(
								'id'    => 'gmap_api_key',
								'type'  => 'text',
								'title' => esc_html__( 'Google Map API Key', 'azirspares' ),
								'desc'  => esc_html__( 'Enter your Google Map API key. ', 'azirspares' ) . '<a href="' . esc_url( 'https://developers.google.com/maps/documentation/javascript/get-api-key' ) . '" target="_blank">' . esc_html__( 'How to get?', 'azirspares' ) . '</a>',
							),
							array(
								'id'    => 'azirspares_theme_lazy_load',
								'type'  => 'switcher',
								'title' => esc_html__( 'Use image Lazy Load', 'azirspares' ),
							),
						),
					),
					array(
						'name'   => 'popup_settings',
						'title'  => esc_html__( 'Newsletter Settings', 'azirspares' ),
						'fields' => array(
							array(
								'id'    => 'azirspares_enable_popup',
								'type'  => 'switcher',
								'title' => esc_html__( 'Enable Newsletter Popup', 'azirspares' ),
							),
							array(
								'id'         => 'azirspares_select_newsletter_page',
								'type'       => 'select',
								'title'      => esc_html__( 'Page Newsletter Popup', 'azirspares' ),
								'options'    => 'pages',
								'query_args' => array(
									'sort_order'  => 'ASC',
									'sort_column' => 'post_title',
								),
								'attributes' => array(
									'multiple' => 'multiple',
								),
								'class'      => 'chosen',
								'dependency' => array( 'azirspares_enable_popup', '==', '1' ),
							),
							array(
								'id'         => 'azirspares_popup_background',
								'type'       => 'image',
								'title'      => esc_html__( 'Popup Background', 'azirspares' ),
								'dependency' => array( 'azirspares_enable_popup', '==', '1' ),
							),
							array(
								'id'         => 'azirspares_popup_title',
								'type'       => 'text',
								'title'      => esc_html__( 'Title', 'azirspares' ),
								'dependency' => array( 'azirspares_enable_popup', '==', '1' ),
							),
							array(
								'id'         => 'azirspares_popup_highlight',
								'type'       => 'text',
								'title'      => esc_html__( 'Highlight', 'azirspares' ),
								'dependency' => array( 'azirspares_enable_popup', '==', '1' ),
							),
							array(
								'id'         => 'azirspares_popup_subtitle',
								'type'       => 'text',
								'title'      => esc_html__( 'Subtitle', 'azirspares' ),
								'dependency' => array( 'azirspares_enable_popup', '==', '1' ),
							),
							array(
								'id'         => 'azirspares_popup_desc',
								'type'       => 'textarea',
								'title'      => esc_html__( 'Description', 'azirspares' ),
								'dependency' => array( 'azirspares_enable_popup', '==', '1' ),
							),
							array(
								'id'         => 'azirspares_popup_input_placeholder',
								'type'       => 'text',
								'title'      => esc_html__( 'Placeholder Input', 'azirspares' ),
								'default'    => esc_html__( 'Email address here...', 'azirspares' ),
								'dependency' => array( 'azirspares_enable_popup', '==', '1' ),
							),
							array(
								'id'         => 'azirspares_popup_input_submit',
								'type'       => 'text',
								'title'      => esc_html__( 'Button', 'azirspares' ),
								'default'    => esc_html__( 'SUBSCRIBE', 'azirspares' ),
								'dependency' => array( 'azirspares_enable_popup', '==', '1' ),
							),
							array(
								'id'         => 'azirspares_popup_close',
								'type'       => 'text',
								'title'      => esc_html__( 'Close', 'azirspares' ),
								'dependency' => array( 'azirspares_enable_popup', '==', '1' ),
							),
							array(
								'id'         => 'azirspares_popup_delay_time',
								'type'       => 'number',
								'title'      => esc_html__( 'Delay Time', 'azirspares' ),
								'default'    => '0',
								'dependency' => array( 'azirspares_enable_popup', '==', '1' ),
							),
							array(
								'id'         => 'azirspares_enable_popup_mobile',
								'type'       => 'switcher',
								'title'      => esc_html__( 'Enable Poppup on Mobile', 'azirspares' ),
								'default'    => false,
								'dependency' => array( 'azirspares_enable_popup', '==', '1' ),
							),
						),
					),
					array(
						'name'   => 'widget_settings',
						'title'  => esc_html__( 'Widget Settings', 'azirspares' ),
						'fields' => array(
							array(
								'id'              => 'multi_widget',
								'type'            => 'group',
								'title'           => esc_html__( 'Multi Widget', 'azirspares' ),
								'button_title'    => esc_html__( 'Add Widget', 'azirspares' ),
								'accordion_title' => esc_html__( 'Add New Field', 'azirspares' ),
								'fields'          => array(
									array(
										'id'    => 'add_widget',
										'type'  => 'text',
										'title' => esc_html__( 'Name Widget', 'azirspares' ),
									),
								),
							),
						),
					),
					array(
						'name'   => 'theme_js_css',
						'title'  => esc_html__( 'Customs JS', 'azirspares' ),
						'fields' => array(
							array(
								'id'         => 'azirspares_custom_js',
								'type'       => 'ace_editor',
								'before'     => '<h1>' . esc_html__( 'Custom JS', 'azirspares' ) . '</h1>',
								'attributes' => array(
									'data-theme' => 'twilight',  // the theme for ACE Editor
									'data-mode'  => 'javascript',     // the language for ACE Editor
								),
							),
						),
					),
					array(
						'name'   => 'live_search_settings',
						'title'  => esc_html__( 'Live Search Settings', 'azirspares' ),
						'fields' => array(
							array(
								'id'         => 'enable_live_search',
								'type'       => 'switcher',
								'attributes' => array(
									'data-depend-id' => 'enable_live_search',
								),
								'title'      => esc_html__( 'Enable Live Search', 'azirspares' ),
								'default'    => false,
							),
							array(
								'id'         => 'show_suggestion',
								'type'       => 'switcher',
								'title'      => esc_html__( 'Display Suggestion', 'azirspares' ),
								'dependency' => array(
									'enable_live_search',
									'==',
									true,
								),
							),
							array(
								'id'         => 'min_characters',
								'type'       => 'number',
								'default'    => 3,
								'title'      => esc_html__( 'Min Search Characters', 'azirspares' ),
								'dependency' => array(
									'enable_live_search',
									'==',
									true,
								),
							),
							array(
								'id'         => 'max_results',
								'type'       => 'number',
								'default'    => 3,
								'title'      => esc_html__( 'Max Search Characters', 'azirspares' ),
								'dependency' => array(
									'enable_live_search',
									'==',
									true,
								),
							),
							array(
								'id'         => 'search_in',
								'type'       => 'checkbox',
								'title'      => esc_html__( 'Search In', 'azirspares' ),
								'options'    => array(
									'title'       => esc_html__( 'Title', 'azirspares' ),
									'description' => esc_html__( 'Description', 'azirspares' ),
									'content'     => esc_html__( 'Content', 'azirspares' ),
									'sku'         => esc_html__( 'SKU', 'azirspares' ),
								),
								'dependency' => array(
									'enable_live_search',
									'==',
									true,
								),
							),
						),
					),
				),
			);
			$options[] = array(
				'name'     => 'header',
				'title'    => esc_html__( 'Header Settings', 'azirspares' ),
				'icon'     => 'fa fa-header',
				'sections' => array(
					array(
						'name'   => 'main_header',
						'title'  => esc_html__( 'Header Settings', 'azirspares' ),
						'fields' => array(
							array(
								'id'         => 'azirspares_used_header',
								'type'       => 'select_preview',
								'title'      => esc_html__( 'Header Layout', 'azirspares' ),
								'desc'       => esc_html__( 'Select a header layout', 'azirspares' ),
								'options'    => self::get_header_preview(),
								'default'    => 'style-01',
								'attributes' => array(
									'data-depend-id' => 'azirspares_used_header',
								),
							),
							array(
								'id'         => 'azirspares_used_header_listing',
								'type'       => 'select_preview',
								'title'      => esc_html__( 'Header Listing Layout', 'azirspares' ),
								'desc'       => esc_html__( 'Select a header listing layout', 'azirspares' ),
								'options'    => self::get_header_preview(),
								'default'    => 'style-07',
								'attributes' => array(
									'data-depend-id' => 'azirspares_used_header_listing',
								),
							),
							array(
								'id'    => 'azirspares_header_background',
								'type'  => 'image',
								'title' => esc_html__( 'Promo Background', 'azirspares' ),
							),
							array(
								'id'         => 'azirspares_background_url',
								'type'       => 'text',
								'default'    => '#',
								'title'      => esc_html__( 'Promo Background Url', 'azirspares' ),
								'dependency' => array( 'azirspares_header_background', '!=', '' ),
							),
							array(
								'id'         => 'azirspares_background_text',
								'type'       => 'wysiwyg',
								'default'    => '',
								'title'      => esc_html__( 'Promo Background Text', 'azirspares' ),
								'dependency' => array( 'azirspares_header_background', '!=', '' ),
							),
							array(
								'id'    => 'azirspares_enable_sticky_menu',
								'type'  => 'switcher',
								'title' => esc_html__( 'Main Menu Sticky', 'azirspares' ),
							),
							array(
								'id'      => 'header_icon',
								'type'    => 'icon',
								'title'   => esc_html__( 'Header Icon', 'azirspares' ),
								'default' => 'flaticon-people',
							),
							array(
								'id'    => 'header_text',
								'type'  => 'text',
								'title' => esc_html__( 'Phone Title', 'azirspares' ),
							),
							array(
								'id'    => 'header_phone',
								'type'  => 'text',
								'title' => esc_html__( 'Header Phone Number', 'azirspares' ),
							),
							array(
								'id'      => 'header_phone_bg',
								'type'    => 'color_picker',
								'title'   => esc_html__( 'Phone Background Color', 'azirspares' ),
								'default' => '',
								'rgba'    => true,
							),
							array(
								'id'         => 'header_listing_link',
								'type'       => 'text',
								'title'      => esc_html__( 'Header Listing Link', 'azirspares' ),
								'dependency' => array( 'azirspares_used_header_listing', '==', 'style-07' ),
							),
							array(
								'id'         => 'header_listing_text',
								'type'       => 'text',
								'title'      => esc_html__( 'Header Listing Text', 'azirspares' ),
								'dependency' => array( 'azirspares_used_header_listing', '==', 'style-07' ),
							),
							array(
								'id'              => 'key_word',
								'title'           => esc_html__( 'Keyword', 'azirspares' ),
								'type'            => 'group',
								'button_title'    => esc_html__( 'Add New Key', 'azirspares' ),
								'accordion_title' => esc_html__( 'Key Item', 'azirspares' ),
								'fields'          => array(
									array(
										'id'    => 'key_word_item',
										'type'  => 'text',
										'title' => esc_html__( 'Keyword', 'azirspares' ),
									),
									array(
										'id'    => 'key_word_link',
										'type'  => 'text',
										'title' => esc_html__( 'Key Link', 'azirspares' ),
									),
								),
							),
						),
					),
					array(
						'name'   => 'vertical',
						'title'  => esc_html__( 'Vertical Settings', 'azirspares' ),
						'fields' => array(
							array(
								'id'         => 'azirspares_enable_vertical_menu',
								'type'       => 'switcher',
								'attributes' => array(
									'data-depend-id' => 'enable_vertical_menu',
								),
								'title'      => esc_html__( 'Enable Vertical Menu', 'azirspares' ),
							),
							array(
								'id'         => 'azirspares_block_vertical_menu',
								'type'       => 'select',
								'title'      => esc_html__( 'Vertical Menu Always Open', 'azirspares' ),
								'options'    => 'page',
								'class'      => 'chosen',
								'attributes' => array(
									'placeholder' => 'Select a page',
									'multiple'    => 'multiple',
								),
								'dependency' => array(
									'enable_vertical_menu',
									'==',
									true,
								),
								'after'      => '<i class="azirspares-text-desc">' . esc_html__( '-- Vertical menu will be always open --', 'azirspares' ) . '</i>',
							),
							array(
								'id'         => 'azirspares_vertical_menu_title',
								'type'       => 'text',
								'title'      => esc_html__( 'Vertical Menu Title', 'azirspares' ),
								'dependency' => array(
									'enable_vertical_menu', '==', true,
								),
								'default'    => esc_html__( 'CATEGORIES', 'azirspares' ),
							),
							array(
								'id'         => 'azirspares_vertical_menu_button_all_text',
								'type'       => 'text',
								'title'      => esc_html__( 'Vertical Menu Button Show All Text', 'azirspares' ),
								'dependency' => array(
									'enable_vertical_menu',
									'==',
									true,
								),
								'default'    => esc_html__( 'All Categories', 'azirspares' ),
							),
							array(
								'id'         => 'azirspares_vertical_menu_button_close_text',
								'type'       => 'text',
								'title'      => esc_html__( 'Vertical Menu Button Close Text', 'azirspares' ),
								'dependency' => array(
									'enable_vertical_menu',
									'==',
									true,
								),
								'default'    => esc_html__( 'Close', 'azirspares' ),
							),
							array(
								'id'         => 'azirspares_vertical_item_visible',
								'type'       => 'number',
								'title'      => esc_html__( 'The Number of Visible Vertical Menu Items', 'azirspares' ),
								'desc'       => esc_html__( 'The Number of Visible Vertical Menu Items', 'azirspares' ),
								'dependency' => array(
									'enable_vertical_menu',
									'==',
									true,
								),
								'default'    => 10,
							),
						),
					),
					array(
						'name'   => 'burger',
						'title'  => esc_html__( 'Burger Settings', 'azirspares' ),
						'fields' => array(
							array(
								'id'         => 'azirspares_enable_burger_menu',
								'type'       => 'switcher',
								'attributes' => array(
									'data-depend-id' => 'enable_burger_menu',
								),
								'title'      => esc_html__( 'Enable Burger Menu', 'azirspares' ),
							),
							array(
								'id'         => 'azirspares_burger_title',
								'type'       => 'text',
								'title'      => esc_html__( 'Burger Menu Title', 'azirspares' ),
								'dependency' => array(
									'enable_burger_menu',
									'==',
									true,
								),
								'default'    => esc_html__( 'Departments', 'azirspares' ),
							),
							array(
								'id'         => 'azirspares_header_social',
								'title'      => esc_html__( 'Header Social', 'azirspares' ),
								'type'       => 'select',
								'options'    => $this->get_social_options(),
								'attributes' => array(
									'multiple' => 'multiple',
								),
								'dependency' => array(
									'enable_burger_menu',
									'==',
									true,
								),
								'class'      => 'chosen',
							),
						),
					),
					array(
						'name'   => 'header_mobile',
						'title'  => esc_html__( 'Header Mobile', 'azirspares' ),
						'fields' => array(
							array(
								'id'      => 'enable_header_mobile',
								'type'    => 'switcher',
								'title'   => esc_html__( 'Enable Header Mobile', 'azirspares' ),
								'default' => false,
							),
							array(
								'id'         => 'azirsparesr_mobile_logo',
								'type'       => 'image',
								'title'      => esc_html__( 'Mobile Logo', 'azirspares' ),
								'add_title'  => esc_html__( 'Add Mobile Logo', 'azirspares' ),
								'desc'       => esc_html__( 'Add custom logo for mobile. If no mobile logo is selected, the default logo will be used or custom logo if placed in the page', 'azirspares' ),
								'dependency' => array( 'enable_header_mobile', '==', true )
							),
							array(
								'id'         => 'enable_header_mini_cart_mobile',
								'type'       => 'switcher',
								'title'      => esc_html__( 'Show Mini Cart Icon', 'azirspares' ),
								'desc'       => esc_html__( 'Show/Hide header mini cart icon on mobile', 'azirspares' ),
								'default'    => true,
								'on'         => esc_html__( 'On', 'azirspares' ),
								'off'        => esc_html__( 'Off', 'azirspares' ),
								'dependency' => array( 'enable_header_mobile', '==', true )
							),
							array(
								'id'         => 'enable_wishlist_mobile',
								'type'       => 'switcher',
								'title'      => esc_html__( 'Show Wish List Icon', 'azirspares' ),
								'desc'       => esc_html__( 'Show/Hide wish list icon on siding menu mobile', 'azirspares' ),
								'default'    => false,
								'on'         => esc_html__( 'Show', 'azirspares' ),
								'off'        => esc_html__( 'Hide', 'azirspares' ),
								'dependency' => array( 'enable_header_mobile', '==', true )
							),
							array(
								'id'         => 'enable_header_product_search_mobile',
								'type'       => 'switcher',
								'title'      => esc_html__( 'Show Products Search', 'azirspares' ),
								'desc'       => esc_html__( 'Show/Hide header product search icon on mobile', 'azirspares' ),
								'default'    => true,
								'on'         => esc_html__( 'On', 'azirspares' ),
								'off'        => esc_html__( 'Off', 'azirspares' ),
								'dependency' => array( 'enable_header_mobile', '==', true )
							),
						),
					),
				),
			);
			$options[] = array(
				'name'   => 'footer',
				'title'  => esc_html__( 'Footer Settings', 'azirspares' ),
				'icon'   => 'fa fa-underline',
				'fields' => array(
					array(
						'id'      => 'azirspares_footer_options',
						'type'    => 'select_preview',
						'title'   => esc_html__( 'Select Footer Builder', 'azirspares' ),
						'options' => self::get_footer_preview(),
						'default' => 'default',
					),
				),
			);
			$options[] = array(
				'name'     => 'blog_main',
				'title'    => esc_html__( 'Blog', 'azirspares' ),
				'icon'     => 'fa fa-rss',
				'sections' => array(
					array(
						'name'   => 'blog',
						'title'  => esc_html__( 'Blog', 'azirspares' ),
						'fields' => array(
							array(
								'id'      => 'azirspares_blog_style',
								'type'    => 'select',
								'default' => 'standard',
								'title'   => esc_html__( 'Blog Style', 'azirspares' ),
								'options' => array(
									'standard' => esc_html__( 'Standard', 'azirspares' ),
									'grid'     => esc_html__( 'Grid', 'azirspares' ),
								),
							),
							array(
								'id'    => 'blog_banner',
								'type'  => 'image',
								'title' => esc_html__( 'Blog Banner', 'azirspares' ),
							),
							array(
								'id'      => 'blog_banner_url',
								'type'    => 'text',
								'default' => '#',
								'title'   => esc_html__( 'Blog Banner Url', 'azirspares' ),
							),
							array(
								'id'         => 'enable_except_post',
								'type'       => 'switcher',
								'title'      => esc_html__( 'Enable Except Post', 'azirspares' ),
								'dependency' => array( 'azirspares_blog_style', '==', 'standard' ),
							),
							array(
								'id'      => 'azirspares_sidebar_blog_layout',
								'type'    => 'image_select',
								'title'   => esc_html__( 'Blog Sidebar Layout', 'azirspares' ),
								'desc'    => esc_html__( 'Select sidebar position on Blog.', 'azirspares' ),
								'options' => array(
									'left'  => esc_attr( ' data:image/png;base64,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' ),
									'right' => esc_attr( ' data:image/png;base64,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' ),
									'full'  => esc_attr( ' data:image/png;base64,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' ),
								),
								'default' => 'left',
							),
							array(
								'id'         => 'azirspares_blog_used_sidebar',
								'type'       => 'select',
								'default'    => 'widget-area',
								'title'      => esc_html__( 'Blog Sidebar', 'azirspares' ),
								'options'    => $this->get_sidebar_options(),
								'dependency' => array( 'azirspares_sidebar_blog_layout_full', '==', false ),
							),
							array(
								'id'         => 'azirspares_blog_bg_items',
								'type'       => 'select',
								'title'      => esc_html__( 'Items per row on Desktop( For grid mode )', 'azirspares' ),
								'desc'       => esc_html__( '(Screen resolution of device >= 1500px )', 'azirspares' ),
								'options'    => array(
									'12' => esc_html__( '1 item', 'azirspares' ),
									'6'  => esc_html__( '2 items', 'azirspares' ),
									'4'  => esc_html__( '3 items', 'azirspares' ),
									'3'  => esc_html__( '4 items', 'azirspares' ),
									'15' => esc_html__( '5 items', 'azirspares' ),
									'2'  => esc_html__( '6 items', 'azirspares' ),
								),
								'default'    => '4',
								'dependency' => array( 'azirspares_blog_style', '==', 'grid' ),
							),
							array(
								'id'         => 'azirspares_blog_lg_items',
								'default'    => '4',
								'type'       => 'select',
								'title'      => esc_html__( 'Items per row on Desktop( For grid mode )', 'azirspares' ),
								'desc'       => esc_html__( '(Screen resolution of device >= 1200px < 1500px )', 'azirspares' ),
								'options'    => array(
									'12' => esc_html__( '1 item', 'azirspares' ),
									'6'  => esc_html__( '2 items', 'azirspares' ),
									'4'  => esc_html__( '3 items', 'azirspares' ),
									'3'  => esc_html__( '4 items', 'azirspares' ),
									'15' => esc_html__( '5 items', 'azirspares' ),
									'2'  => esc_html__( '6 items', 'azirspares' ),
								),
								'dependency' => array( 'azirspares_blog_style', '==', 'grid' ),
							),
							array(
								'id'         => 'azirspares_blog_md_items',
								'default'    => '4',
								'type'       => 'select',
								'title'      => esc_html__( 'Items per row on Desktop( For grid mode )', 'azirspares' ),
								'desc'       => esc_html__( '(Screen resolution of device >=992px and < 1200px )', 'azirspares' ),
								'options'    => array(
									'12' => esc_html__( '1 item', 'azirspares' ),
									'6'  => esc_html__( '2 items', 'azirspares' ),
									'4'  => esc_html__( '3 items', 'azirspares' ),
									'3'  => esc_html__( '4 items', 'azirspares' ),
									'15' => esc_html__( '5 items', 'azirspares' ),
									'2'  => esc_html__( '6 items', 'azirspares' ),
								),
								'dependency' => array( 'azirspares_blog_style', '==', 'grid' ),
							),
							array(
								'id'         => 'azirspares_blog_sm_items',
								'default'    => '4',
								'type'       => 'select',
								'title'      => esc_html__( 'Items per row on Desktop( For grid mode )', 'azirspares' ),
								'desc'       => esc_html__( '(Screen resolution of device >=768px and < 992px )', 'azirspares' ),
								'options'    => array(
									'12' => esc_html__( '1 item', 'azirspares' ),
									'6'  => esc_html__( '2 items', 'azirspares' ),
									'4'  => esc_html__( '3 items', 'azirspares' ),
									'3'  => esc_html__( '4 items', 'azirspares' ),
									'15' => esc_html__( '5 items', 'azirspares' ),
									'2'  => esc_html__( '6 items', 'azirspares' ),
								),
								'dependency' => array( 'azirspares_blog_style', '==', 'grid' ),
							),
							array(
								'id'         => 'azirspares_blog_xs_items',
								'default'    => '6',
								'type'       => 'select',
								'title'      => esc_html__( 'Items per row on Desktop( For grid mode )', 'azirspares' ),
								'desc'       => esc_html__( '(Screen resolution of device >=480  add < 768px)', 'azirspares' ),
								'options'    => array(
									'12' => esc_html__( '1 item', 'azirspares' ),
									'6'  => esc_html__( '2 items', 'azirspares' ),
									'4'  => esc_html__( '3 items', 'azirspares' ),
									'3'  => esc_html__( '4 items', 'azirspares' ),
									'15' => esc_html__( '5 items', 'azirspares' ),
									'2'  => esc_html__( '6 items', 'azirspares' ),
								),
								'dependency' => array( 'azirspares_blog_style', '==', 'grid' ),
							),
							array(
								'id'         => 'azirspares_blog_ts_items',
								'default'    => '12',
								'type'       => 'select',
								'title'      => esc_html__( 'Items per row on Desktop( For grid mode )', 'azirspares' ),
								'desc'       => esc_html__( '(Screen resolution of device < 480px)', 'azirspares' ),
								'options'    => array(
									'12' => esc_html__( '1 item', 'azirspares' ),
									'6'  => esc_html__( '2 items', 'azirspares' ),
									'4'  => esc_html__( '3 items', 'azirspares' ),
									'3'  => esc_html__( '4 items', 'azirspares' ),
									'15' => esc_html__( '5 items', 'azirspares' ),
									'2'  => esc_html__( '6 items', 'azirspares' ),
								),
								'dependency' => array( 'azirspares_blog_style', '==', 'grid' ),
							),
						),
					),
					array(
						'name'   => 'blog_single',
						'title'  => esc_html__( 'Blog Single', 'azirspares' ),
						'fields' => array(
							array(
								'id'    => 'enable_share_post',
								'type'  => 'switcher',
								'title' => esc_html__( 'Enable Share Button', 'azirspares' ),
							),
							array(
								'id'      => 'azirspares_sidebar_single_layout',
								'type'    => 'image_select',
								'default' => 'left',
								'title'   => esc_html__( 'Single Post Sidebar Layout', 'azirspares' ),
								'desc'    => esc_html__( 'Select sidebar position on Blog.', 'azirspares' ),
								'options' => array(
									'left'  => esc_attr( ' data:image/png;base64,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' ),
									'right' => esc_attr( ' data:image/png;base64,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' ),
									'full'  => esc_attr( ' data:image/png;base64,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' ),
								),
							),
							array(
								'id'         => 'azirspares_single_used_sidebar',
								'type'       => 'select',
								'default'    => 'widget-area',
								'title'      => esc_html__( 'Single Blog Sidebar', 'azirspares' ),
								'options'    => $this->get_sidebar_options(),
								'dependency' => array( 'azirspares_sidebar_single_layout_full', '==', false ),
							),
						),
					),
				),
			);
			if ( class_exists( 'WooCommerce' ) ) {
				$options[] = array(
					'name'     => 'woocommerce_main',
					'title'    => esc_html__( 'WooCommerce', 'azirspares' ),
					'icon'     => 'fa fa-wordpress',
					'sections' => array(
						array(
							'name'   => 'woocommerce',
							'title'  => esc_html__( 'WooCommerce', 'azirspares' ),
							'fields' => array(
								array(
									'id'    => 'azirspares_shop_banner',
									'type'  => 'image',
									'title' => esc_html__( 'Shop banner', 'azirspares' ),
									'desc'  => esc_html__( 'Banner in shop page WooCommerce.', 'azirspares' ),
								),
								array(
									'id'      => 'azirspares_shop_banner_url',
									'type'    => 'text',
									'default' => '#',
									'title'   => esc_html__( 'Shop Banner Url', 'azirspares' ),
								),
								array(
									'id'      => 'azirspares_product_newness',
									'default' => '10',
									'type'    => 'number',
									'title'   => esc_html__( 'Products Newness', 'azirspares' ),
								),
								array(
									'id'      => 'azirspares_sidebar_shop_layout',
									'type'    => 'image_select',
									'default' => 'left',
									'title'   => esc_html__( 'Shop Page Sidebar Layout', 'azirspares' ),
									'desc'    => esc_html__( 'Select sidebar position on Shop Page.', 'azirspares' ),
									'options' => array(
										'left'  => esc_attr( ' data:image/png;base64,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' ),
										'right' => esc_attr( ' data:image/png;base64,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' ),
										'full'  => esc_attr( ' data:image/png;base64,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' ),
									),
								),
								
								array(
									'id'         => 'azirspares_shop_used_sidebar',
									'type'       => 'select',
									'title'      => esc_html__( 'Sidebar Used For Shop', 'azirspares' ),
									'options'    => $this->get_sidebar_options(),
									'dependency' => array( 'azirspares_sidebar_shop_layout_full', '==', false ),
								),
								array(
									'id'      => 'azirspares_shop_list_style',
									'type'    => 'image_select',
									'default' => 'grid',
									'title'   => esc_html__( 'Shop Default Layout', 'azirspares' ),
									'desc'    => esc_html__( 'Select default layout for shop, product category archive.', 'azirspares' ),
									'options' => array(
										'grid' => get_theme_file_uri( 'assets/images/grid-display.png' ),
										'list' => get_theme_file_uri( 'assets/images/list-display.png' ),
									),
								),
								array(
									'id'         => 'azirspares_shop_product_style',
									'type'       => 'select_preview',
									'title'      => esc_html__( 'Product Shop Layout', 'azirspares' ),
									'desc'       => esc_html__( 'Select a Product layout in shop page', 'azirspares' ),
									'options'    => self::get_shop_product_preview(),
									'default'    => 'style-01',
									'dependency' => array( 'azirspares_shop_list_style_grid', '==', true ),
								),
								array(
									'id'      => 'azirspares_product_per_page',
									'type'    => 'number',
									'default' => '10',
									'title'   => esc_html__( 'Products perpage', 'azirspares' ),
									'desc'    => esc_html__( 'Number of products on shop page.', 'azirspares' ),
								),
								array(
									'id'      => 'enable_shop_mobile',
									'type'    => 'switcher',
									'title'   => esc_html__( 'Shop Mobile Layout', 'azirspares' ),
									'default' => true,
									'desc'    => esc_html__( 'Use the dedicated mobile interface on a real device instead of responsive. Note, this option is not available for desktop browsing and uses resize the screen.', 'azirspares' ),
								),
								array(
									'id'      => 'product_carousel',
									'type'    => 'heading',
									'content' => esc_html__( 'Grid Settings', 'azirspares' ),
								),
								array(
									'id'      => 'azirspares_woo_bg_items',
									'type'    => 'select',
									'title'   => esc_html__( 'Items per row on Desktop( For grid mode )', 'azirspares' ),
									'desc'    => esc_html__( '(Screen resolution of device >= 1500px )', 'azirspares' ),
									'options' => array(
										'12' => esc_html__( '1 item', 'azirspares' ),
										'6'  => esc_html__( '2 items', 'azirspares' ),
										'4'  => esc_html__( '3 items', 'azirspares' ),
										'3'  => esc_html__( '4 items', 'azirspares' ),
										'15' => esc_html__( '5 items', 'azirspares' ),
										'2'  => esc_html__( '6 items', 'azirspares' ),
									),
									'default' => '4',
								),
								array(
									'id'      => 'azirspares_woo_lg_items',
									'type'    => 'select',
									'title'   => esc_html__( 'Items per row on Desktop( For grid mode )', 'azirspares' ),
									'desc'    => esc_html__( '(Screen resolution of device >= 1200px < 1500px )', 'azirspares' ),
									'options' => array(
										'12' => esc_html__( '1 item', 'azirspares' ),
										'6'  => esc_html__( '2 items', 'azirspares' ),
										'4'  => esc_html__( '3 items', 'azirspares' ),
										'3'  => esc_html__( '4 items', 'azirspares' ),
										'15' => esc_html__( '5 items', 'azirspares' ),
										'2'  => esc_html__( '6 items', 'azirspares' ),
									),
									'default' => '4',
								),
								array(
									'id'      => 'azirspares_woo_md_items',
									'type'    => 'select',
									'title'   => esc_html__( 'Items per row on landscape tablet( For grid mode )', 'azirspares' ),
									'desc'    => esc_html__( '(Screen resolution of device >=992px and < 1200px )', 'azirspares' ),
									'options' => array(
										'12' => esc_html__( '1 item', 'azirspares' ),
										'6'  => esc_html__( '2 items', 'azirspares' ),
										'4'  => esc_html__( '3 items', 'azirspares' ),
										'3'  => esc_html__( '4 items', 'azirspares' ),
										'15' => esc_html__( '5 items', 'azirspares' ),
										'2'  => esc_html__( '6 items', 'azirspares' ),
									),
									'default' => '6',
								),
								array(
									'id'      => 'azirspares_woo_sm_items',
									'type'    => 'select',
									'title'   => esc_html__( 'Items per row on portrait tablet( For grid mode )', 'azirspares' ),
									'desc'    => esc_html__( '(Screen resolution of device >=768px and < 992px )', 'azirspares' ),
									'options' => array(
										'12' => esc_html__( '1 item', 'azirspares' ),
										'6'  => esc_html__( '2 items', 'azirspares' ),
										'4'  => esc_html__( '3 items', 'azirspares' ),
										'3'  => esc_html__( '4 items', 'azirspares' ),
										'15' => esc_html__( '5 items', 'azirspares' ),
										'2'  => esc_html__( '6 items', 'azirspares' ),
									),
									'default' => '6',
								),
								array(
									'id'      => 'azirspares_woo_xs_items',
									'type'    => 'select',
									'title'   => esc_html__( 'Items per row on Mobile( For grid mode )', 'azirspares' ),
									'desc'    => esc_html__( '(Screen resolution of device >=480  add < 768px)', 'azirspares' ),
									'options' => array(
										'12' => esc_html__( '1 item', 'azirspares' ),
										'6'  => esc_html__( '2 items', 'azirspares' ),
										'4'  => esc_html__( '3 items', 'azirspares' ),
										'3'  => esc_html__( '4 items', 'azirspares' ),
										'15' => esc_html__( '5 items', 'azirspares' ),
										'2'  => esc_html__( '6 items', 'azirspares' ),
									),
									'default' => '6',
								),
								array(
									'id'      => 'azirspares_woo_ts_items',
									'type'    => 'select',
									'title'   => esc_html__( 'Items per row on Mobile( For grid mode )', 'azirspares' ),
									'desc'    => esc_html__( '(Screen resolution of device < 480px)', 'azirspares' ),
									'options' => array(
										'12' => esc_html__( '1 item', 'azirspares' ),
										'6'  => esc_html__( '2 items', 'azirspares' ),
										'4'  => esc_html__( '3 items', 'azirspares' ),
										'3'  => esc_html__( '4 items', 'azirspares' ),
										'15' => esc_html__( '5 items', 'azirspares' ),
										'2'  => esc_html__( '6 items', 'azirspares' ),
									),
									'default' => '12',
								),
							),
						),
						array(
							'name'   => 'categories',
							'title'  => esc_html__( 'Categories', 'azirspares' ),
							'fields' => array(
								array(
									'id'    => 'azirspares_woo_cat_enable',
									'type'  => 'switcher',
									'title' => esc_html__( 'Enable Category Products', 'azirspares' ),
								),
								array(
									'id'         => 'category_banner',
									'type'       => 'image',
									'title'      => esc_html__( 'Categories banner', 'azirspares' ),
									'desc'       => esc_html__( 'Banner in category page WooCommerce.', 'azirspares' ),
									'dependency' => array( 'azirspares_woo_cat_enable', '==', true ),
								),
								array(
									'id'         => 'category_banner_url',
									'type'       => 'text',
									'default'    => '#',
									'title'      => esc_html__( 'Banner Url', 'azirspares' ),
									'dependency' => array( 'category_banner', '!=', '' ),
								),
								array(
									'id'         => 'azirspares_woo_cat_ls_items',
									'type'       => 'select',
									'title'      => esc_html__( 'Category products items per row on Desktop', 'azirspares' ),
									'desc'       => esc_html__( '(Screen resolution of device >= 1500px )', 'azirspares' ),
									'options'    => array(
										'1' => esc_html__( '1 item', 'azirspares' ),
										'2' => esc_html__( '2 items', 'azirspares' ),
										'3' => esc_html__( '3 items', 'azirspares' ),
										'4' => esc_html__( '4 items', 'azirspares' ),
										'5' => esc_html__( '5 items', 'azirspares' ),
										'6' => esc_html__( '6 items', 'azirspares' ),
									),
									'default'    => '3',
									'dependency' => array( 'azirspares_woo_cat_enable', '==', true ),
								),
								array(
									'id'         => 'azirspares_woo_cat_lg_items',
									'type'       => 'select',
									'title'      => esc_html__( 'Category products items per row on Desktop', 'azirspares' ),
									'desc'       => esc_html__( '(Screen resolution of device >= 1200px < 1500px )', 'azirspares' ),
									'options'    => array(
										'1' => esc_html__( '1 item', 'azirspares' ),
										'2' => esc_html__( '2 items', 'azirspares' ),
										'3' => esc_html__( '3 items', 'azirspares' ),
										'4' => esc_html__( '4 items', 'azirspares' ),
										'5' => esc_html__( '5 items', 'azirspares' ),
										'6' => esc_html__( '6 items', 'azirspares' ),
									),
									'default'    => '3',
									'dependency' => array( 'azirspares_woo_cat_enable', '==', true ),
								),
								array(
									'id'         => 'azirspares_woo_cat_md_items',
									'type'       => 'select',
									'title'      => esc_html__( 'Category products items per row on landscape tablet', 'azirspares' ),
									'desc'       => esc_html__( '(Screen resolution of device >=992px and < 1200px )', 'azirspares' ),
									'options'    => array(
										'1' => esc_html__( '1 item', 'azirspares' ),
										'2' => esc_html__( '2 items', 'azirspares' ),
										'3' => esc_html__( '3 items', 'azirspares' ),
										'4' => esc_html__( '4 items', 'azirspares' ),
										'5' => esc_html__( '5 items', 'azirspares' ),
										'6' => esc_html__( '6 items', 'azirspares' ),
									),
									'default'    => '3',
									'dependency' => array( 'azirspares_woo_cat_enable', '==', true ),
								),
								array(
									'id'         => 'azirspares_woo_cat_sm_items',
									'type'       => 'select',
									'title'      => esc_html__( 'Category product items per row on portrait tablet', 'azirspares' ),
									'desc'       => esc_html__( '(Screen resolution of device >=768px and < 992px )', 'azirspares' ),
									'options'    => array(
										'1' => esc_html__( '1 item', 'azirspares' ),
										'2' => esc_html__( '2 items', 'azirspares' ),
										'3' => esc_html__( '3 items', 'azirspares' ),
										'4' => esc_html__( '4 items', 'azirspares' ),
										'5' => esc_html__( '5 items', 'azirspares' ),
										'6' => esc_html__( '6 items', 'azirspares' ),
									),
									'default'    => '2',
									'dependency' => array( 'azirspares_woo_cat_enable', '==', true ),
								),
								array(
									'id'         => 'azirspares_woo_cat_xs_items',
									'type'       => 'select',
									'title'      => esc_html__( 'Category products items per row on Mobile', 'azirspares' ),
									'desc'       => esc_html__( '(Screen resolution of device >=480  add < 768px)', 'azirspares' ),
									'options'    => array(
										'1' => esc_html__( '1 item', 'azirspares' ),
										'2' => esc_html__( '2 items', 'azirspares' ),
										'3' => esc_html__( '3 items', 'azirspares' ),
										'4' => esc_html__( '4 items', 'azirspares' ),
										'5' => esc_html__( '5 items', 'azirspares' ),
										'6' => esc_html__( '6 items', 'azirspares' ),
									),
									'default'    => '1',
									'dependency' => array( 'azirspares_woo_cat_enable', '==', true ),
								),
								array(
									'id'         => 'azirspares_woo_cat_ts_items',
									'type'       => 'select',
									'title'      => esc_html__( 'Category products items per row on Mobile', 'azirspares' ),
									'desc'       => esc_html__( '(Screen resolution of device < 480px)', 'azirspares' ),
									'options'    => array(
										'1' => esc_html__( '1 item', 'azirspares' ),
										'2' => esc_html__( '2 items', 'azirspares' ),
										'3' => esc_html__( '3 items', 'azirspares' ),
										'4' => esc_html__( '4 items', 'azirspares' ),
										'5' => esc_html__( '5 items', 'azirspares' ),
										'6' => esc_html__( '6 items', 'azirspares' ),
									),
									'default'    => '1',
									'dependency' => array( 'azirspares_woo_cat_enable', '==', true ),
								),
							),
						),
						array(
							'name'   => 'single_product',
							'title'  => esc_html__( 'Single Products', 'azirspares' ),
							'fields' => array(
								array(
									'id'      => 'azirspares_single_product_extended',
									'type'    => 'select',
									'title'   => esc_html__( 'Single Product Extended', 'azirspares' ),
									'options' => array(
										'type-1' => esc_html__( 'Type 1', 'azirspares' ),
										'type-2' => esc_html__( 'Type 2', 'azirspares' ),
									),
									'default' => 'type-1',
								),
								array(
									'id'             => 'azirspares_single_product_policy',
									'type'           => 'select',
									'title'          => esc_html__( 'Single Product Policy', 'azirspares' ),
									'options'        => 'pages',
									'default_option' => esc_html__( 'Select a page', 'azirspares' ),
								),
								array(
									'id'    => 'enable_single_product_policy',
									'type'  => 'switcher',
									'title' => esc_html__( 'Single Product Policy On Mobile', 'azirspares' ),
								),
								array(
									'id'    => 'enable_sticky_product_single',
									'type'  => 'switcher',
									'title' => esc_html__( 'Enable Sticky Product Single', 'azirspares' ),
								),
								array(
									'id'      => 'enable_single_product_sharing',
									'type'    => 'switcher',
									'title'   => esc_html__( 'Enable Product Sharing', 'azirspares' ),
									'default' => false,
								),
								array(
									'id'         => 'enable_single_product_sharing_fb',
									'type'       => 'switcher',
									'title'      => esc_html__( 'Facebook Sharing', 'azirspares' ),
									'default'    => true,
									'dependency' => array( 'enable_single_product_sharing', '==', true ),
									'desc'       => esc_html__( 'On or Off Facebook Share When On Product Sharing', 'azirspares' )
								),
								array(
									'id'         => 'enable_single_product_sharing_tw',
									'type'       => 'switcher',
									'title'      => esc_html__( 'Twitter Sharing', 'azirspares' ),
									'default'    => true,
									'dependency' => array( 'enable_single_product_sharing', '==', true ),
									'desc'       => esc_html__( 'On or Off Twitter Share When On Product Sharing', 'azirspares' )
								),
								array(
									'id'         => 'enable_single_product_sharing_pinterest',
									'type'       => 'switcher',
									'title'      => esc_html__( 'Pinterest Sharing', 'azirspares' ),
									'default'    => true,
									'dependency' => array( 'enable_single_product_sharing', '==', true ),
									'desc'       => esc_html__( 'On or Off Pinterest Share When On Product Sharing', 'azirspares' )
								),
								array(
									'id'         => 'enable_single_product_sharing_gplus',
									'type'       => 'switcher',
									'title'      => esc_html__( 'Google Plus Sharing', 'azirspares' ),
									'default'    => true,
									'dependency' => array( 'enable_single_product_sharing', '==', true ),
									'desc'       => esc_html__( 'On or Off Google Share When On Product Sharing', 'azirspares' )
								),
								array(
									'id'      => 'azirspares_sidebar_product_layout',
									'type'    => 'image_select',
									'default' => 'left',
									'title'   => esc_html__( 'Product Page Sidebar Layout', 'azirspares' ),
									'desc'    => esc_html__( 'Select sidebar position on Product Page.', 'azirspares' ),
									'options' => array(
										'left'  => esc_attr( ' data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAC0AAAAkCAYAAAAdFbNSAAAACXBIWXMAAAsTAAALEwEAmpwYAAAKT2lDQ1BQaG90b3Nob3AgSUNDIHByb2ZpbGUAAHjanVNnVFPpFj333vRCS4iAlEtvUhUIIFJCi4AUkSYqIQkQSoghodkVUcERRUUEG8igiAOOjoCMFVEsDIoK2AfkIaKOg6OIisr74Xuja9a89+bN/rXXPues852zzwfACAyWSDNRNYAMqUIeEeCDx8TG4eQuQIEKJHAAEAizZCFz/SMBAPh+PDwrIsAHvgABeNMLCADATZvAMByH/w/qQplcAYCEAcB0kThLCIAUAEB6jkKmAEBGAYCdmCZTAKAEAGDLY2LjAFAtAGAnf+bTAICd+Jl7AQBblCEVAaCRACATZYhEAGg7AKzPVopFAFgwABRmS8Q5ANgtADBJV2ZIALC3AMDOEAuyAAgMADBRiIUpAAR7AGDIIyN4AISZABRG8lc88SuuEOcqAAB4mbI8uSQ5RYFbCC1xB1dXLh4ozkkXKxQ2YQJhmkAuwnmZGTKBNA/g88wAAKCRFRHgg/P9eM4Ors7ONo62Dl8t6r8G/yJiYuP+5c+rcEAAAOF0ftH+LC+zGoA7BoBt/qIl7gRoXgugdfeLZrIPQLUAoOnaV/Nw+H48PEWhkLnZ2eXk5NhKxEJbYcpXff5nwl/AV/1s+X48/Pf14L7iJIEyXYFHBPjgwsz0TKUcz5IJhGLc5o9H/LcL//wd0yLESWK5WCoU41EScY5EmozzMqUiiUKSKcUl0v9k4t8s+wM+3zUAsGo+AXuRLahdYwP2SycQWHTA4vcAAPK7b8HUKAgDgGiD4c93/+8//UegJQCAZkmScQAAXkQkLlTKsz/HCAAARKCBKrBBG/TBGCzABhzBBdzBC/xgNoRCJMTCQhBCCmSAHHJgKayCQiiGzbAdKmAv1EAdNMBRaIaTcA4uwlW4Dj1wD/phCJ7BKLyBCQRByAgTYSHaiAFiilgjjggXmYX4IcFIBBKLJCDJiBRRIkuRNUgxUopUIFVIHfI9cgI5h1xGupE7yAAygvyGvEcxlIGyUT3UDLVDuag3GoRGogvQZHQxmo8WoJvQcrQaPYw2oefQq2gP2o8+Q8cwwOgYBzPEbDAuxsNCsTgsCZNjy7EirAyrxhqwVqwDu4n1Y8+xdwQSgUXACTYEd0IgYR5BSFhMWE7YSKggHCQ0EdoJNwkDhFHCJyKTqEu0JroR+cQYYjIxh1hILCPWEo8TLxB7iEPENyQSiUMyJ7mQAkmxpFTSEtJG0m5SI+ksqZs0SBojk8naZGuyBzmULCAryIXkneTD5DPkG+Qh8lsKnWJAcaT4U+IoUspqShnlEOU05QZlmDJBVaOaUt2ooVQRNY9aQq2htlKvUYeoEzR1mjnNgxZJS6WtopXTGmgXaPdpr+h0uhHdlR5Ol9BX0svpR+iX6AP0dwwNhhWDx4hnKBmbGAcYZxl3GK+YTKYZ04sZx1QwNzHrmOeZD5lvVVgqtip8FZHKCpVKlSaVGyovVKmqpqreqgtV81XLVI+pXlN9rkZVM1PjqQnUlqtVqp1Q61MbU2epO6iHqmeob1Q/pH5Z/YkGWcNMw09DpFGgsV/jvMYgC2MZs3gsIWsNq4Z1gTXEJrHN2Xx2KruY/R27iz2qqaE5QzNKM1ezUvOUZj8H45hx+Jx0TgnnKKeX836K3hTvKeIpG6Y0TLkxZVxrqpaXllirSKtRq0frvTau7aedpr1Fu1n7gQ5Bx0onXCdHZ4/OBZ3nU9lT3acKpxZNPTr1ri6qa6UbobtEd79up+6Ynr5egJ5Mb6feeb3n+hx9L/1U/W36p/VHDFgGswwkBtsMzhg8xTVxbzwdL8fb8VFDXcNAQ6VhlWGX4YSRudE8o9VGjUYPjGnGXOMk423GbcajJgYmISZLTepN7ppSTbmmKaY7TDtMx83MzaLN1pk1mz0x1zLnm+eb15vft2BaeFostqi2uGVJsuRaplnutrxuhVo5WaVYVVpds0atna0l1rutu6cRp7lOk06rntZnw7Dxtsm2qbcZsOXYBtuutm22fWFnYhdnt8Wuw+6TvZN9un2N/T0HDYfZDqsdWh1+c7RyFDpWOt6azpzuP33F9JbpL2dYzxDP2DPjthPLKcRpnVOb00dnF2e5c4PziIuJS4LLLpc+Lpsbxt3IveRKdPVxXeF60vWdm7Obwu2o26/uNu5p7ofcn8w0nymeWTNz0MPIQ+BR5dE/C5+VMGvfrH5PQ0+BZ7XnIy9jL5FXrdewt6V3qvdh7xc+9j5yn+M+4zw33jLeWV/MN8C3yLfLT8Nvnl+F30N/I/9k/3r/0QCngCUBZwOJgUGBWwL7+Hp8Ib+OPzrbZfay2e1BjKC5QRVBj4KtguXBrSFoyOyQrSH355jOkc5pDoVQfujW0Adh5mGLw34MJ4WHhVeGP45wiFga0TGXNXfR3ENz30T6RJZE3ptnMU85ry1KNSo+qi5qPNo3ujS6P8YuZlnM1VidWElsSxw5LiquNm5svt/87fOH4p3iC+N7F5gvyF1weaHOwvSFpxapLhIsOpZATIhOOJTwQRAqqBaMJfITdyWOCnnCHcJnIi/RNtGI2ENcKh5O8kgqTXqS7JG8NXkkxTOlLOW5hCepkLxMDUzdmzqeFpp2IG0yPTq9MYOSkZBxQqohTZO2Z+pn5mZ2y6xlhbL+xW6Lty8elQfJa7OQrAVZLQq2QqboVFoo1yoHsmdlV2a/zYnKOZarnivN7cyzytuQN5zvn//tEsIS4ZK2pYZLVy0dWOa9rGo5sjxxedsK4xUFK4ZWBqw8uIq2Km3VT6vtV5eufr0mek1rgV7ByoLBtQFr6wtVCuWFfevc1+1dT1gvWd+1YfqGnRs+FYmKrhTbF5cVf9go3HjlG4dvyr+Z3JS0qavEuWTPZtJm6ebeLZ5bDpaql+aXDm4N2dq0Dd9WtO319kXbL5fNKNu7g7ZDuaO/PLi8ZafJzs07P1SkVPRU+lQ27tLdtWHX+G7R7ht7vPY07NXbW7z3/T7JvttVAVVN1WbVZftJ+7P3P66Jqun4lvttXa1ObXHtxwPSA/0HIw6217nU1R3SPVRSj9Yr60cOxx++/p3vdy0NNg1VjZzG4iNwRHnk6fcJ3/ceDTradox7rOEH0x92HWcdL2pCmvKaRptTmvtbYlu6T8w+0dbq3nr8R9sfD5w0PFl5SvNUyWna6YLTk2fyz4ydlZ19fi753GDborZ752PO32oPb++6EHTh0kX/i+c7vDvOXPK4dPKy2+UTV7hXmq86X23qdOo8/pPTT8e7nLuarrlca7nuer21e2b36RueN87d9L158Rb/1tWeOT3dvfN6b/fF9/XfFt1+cif9zsu72Xcn7q28T7xf9EDtQdlD3YfVP1v+3Njv3H9qwHeg89HcR/cGhYPP/pH1jw9DBY+Zj8uGDYbrnjg+OTniP3L96fynQ89kzyaeF/6i/suuFxYvfvjV69fO0ZjRoZfyl5O/bXyl/erA6xmv28bCxh6+yXgzMV70VvvtwXfcdx3vo98PT+R8IH8o/2j5sfVT0Kf7kxmTk/8EA5jz/GMzLdsAAAAgY0hSTQAAeiUAAICDAAD5/wAAgOkAAHUwAADqYAAAOpgAABdvkl/FRgAAANNJREFUeNrs2b0KwjAUhuG3NkUsYicHB117J16Pl9Rr00H8QaxItQjGwQilTo0QKXzfcshwDg8h00lkraVvMQC703kNTLo0xiYpyuN+Vd+rZRybAkgDeC95ni+MO8w9BkyBCBgDs0CXnAEM3KH0GHBz9QlUgdBlE+2TB2CB2tVg+QUdtWov0H+L0EILLbTQQgsttNBCCy200EILLbTQ37Gt2gt0wnslNiTwauyDzjx6R40ZaSBvBm6pDmzouFQHDu5pXIFtIPgFIOrj98ULAAD//wMA7UQkYA5MJngAAAAASUVORK5CYII=' ),
										'right' => esc_attr( ' data:image/png;base64,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' ),
										'full'  => esc_attr( ' data:image/png;base64,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' ),
									),
								),
								array(
									'id'         => 'azirspares_single_product_used_sidebar',
									'type'       => 'select',
									'title'      => esc_html__( 'Sidebar Used For Single Product', 'azirspares' ),
									'options'    => $this->get_sidebar_options(),
									'dependency' => array( 'azirspares_sidebar_product_layout_full', '==', false ),
								),
								array(
									'id'      => 'azirspares_product_thumbnail_ls_items',
									'type'    => 'select',
									'title'   => esc_html__( 'Thumbnail items per row on Desktop', 'azirspares' ),
									'desc'    => esc_html__( '(Screen resolution of device >= 1500px )', 'azirspares' ),
									'options' => array(
										'1' => esc_html__( '1 item', 'azirspares' ),
										'2' => esc_html__( '2 items', 'azirspares' ),
										'3' => esc_html__( '3 items', 'azirspares' ),
										'4' => esc_html__( '4 items', 'azirspares' ),
										'5' => esc_html__( '5 items', 'azirspares' ),
										'6' => esc_html__( '6 items', 'azirspares' ),
									),
									'default' => '4',
								),
								array(
									'id'      => 'azirspares_product_thumbnail_lg_items',
									'type'    => 'select',
									'title'   => esc_html__( 'Thumbnail items per row on Desktop', 'azirspares' ),
									'desc'    => esc_html__( '(Screen resolution of device >= 1200px < 1500px )', 'azirspares' ),
									'options' => array(
										'1' => esc_html__( '1 item', 'azirspares' ),
										'2' => esc_html__( '2 items', 'azirspares' ),
										'3' => esc_html__( '3 items', 'azirspares' ),
										'4' => esc_html__( '4 items', 'azirspares' ),
										'5' => esc_html__( '5 items', 'azirspares' ),
										'6' => esc_html__( '6 items', 'azirspares' ),
									),
									'default' => '4',
								),
								array(
									'id'      => 'azirspares_product_thumbnail_md_items',
									'type'    => 'select',
									'title'   => esc_html__( 'Thumbnail items per row on landscape tablet', 'azirspares' ),
									'desc'    => esc_html__( '(Screen resolution of device >=992px and < 1200px )', 'azirspares' ),
									'options' => array(
										'1' => esc_html__( '1 item', 'azirspares' ),
										'2' => esc_html__( '2 items', 'azirspares' ),
										'3' => esc_html__( '3 items', 'azirspares' ),
										'4' => esc_html__( '4 items', 'azirspares' ),
										'5' => esc_html__( '5 items', 'azirspares' ),
										'6' => esc_html__( '6 items', 'azirspares' ),
									),
									'default' => '4',
								),
								array(
									'id'      => 'azirspares_product_thumbnail_sm_items',
									'type'    => 'select',
									'title'   => esc_html__( 'Thumbnail items per row on portrait tablet', 'azirspares' ),
									'desc'    => esc_html__( '(Screen resolution of device >=768px and < 992px )', 'azirspares' ),
									'options' => array(
										'1' => esc_html__( '1 item', 'azirspares' ),
										'2' => esc_html__( '2 items', 'azirspares' ),
										'3' => esc_html__( '3 items', 'azirspares' ),
										'4' => esc_html__( '4 items', 'azirspares' ),
										'5' => esc_html__( '5 items', 'azirspares' ),
										'6' => esc_html__( '6 items', 'azirspares' ),
									),
									'default' => '4',
								),
								array(
									'id'      => 'azirspares_product_thumbnail_xs_items',
									'type'    => 'select',
									'title'   => esc_html__( 'Thumbnail items per row on Mobile', 'azirspares' ),
									'desc'    => esc_html__( '(Screen resolution of device >=480  add < 768px)', 'azirspares' ),
									'options' => array(
										'1' => esc_html__( '1 item', 'azirspares' ),
										'2' => esc_html__( '2 items', 'azirspares' ),
										'3' => esc_html__( '3 items', 'azirspares' ),
										'4' => esc_html__( '4 items', 'azirspares' ),
										'5' => esc_html__( '5 items', 'azirspares' ),
										'6' => esc_html__( '6 items', 'azirspares' ),
									),
									'default' => '4',
								),
								array(
									'id'      => 'azirspares_product_thumbnail_ts_items',
									'type'    => 'select',
									'title'   => esc_html__( 'Thumbnail items per row on Mobile', 'azirspares' ),
									'desc'    => esc_html__( '(Screen resolution of device < 480px)', 'azirspares' ),
									'options' => array(
										'1' => esc_html__( '1 item', 'azirspares' ),
										'2' => esc_html__( '2 items', 'azirspares' ),
										'3' => esc_html__( '3 items', 'azirspares' ),
										'4' => esc_html__( '4 items', 'azirspares' ),
										'5' => esc_html__( '5 items', 'azirspares' ),
										'6' => esc_html__( '6 items', 'azirspares' ),
									),
									'default' => '4',
								),
							),
						),
						array(
							'name'   => 'azirspares_recently_reviewed_product',
							'title'  => esc_html__( 'Recently Reviewed Products', 'azirspares' ),
							'fields' => array(
								array(
									'id'      => 'azirspares_woo_recently_reviewed_enable',
									'type'    => 'select',
									'default' => 'disable',
									'options' => array(
										'enable'  => esc_html__( 'Enable', 'azirspares' ),
										'disable' => esc_html__( 'Disable', 'azirspares' ),
									),
									'title'   => esc_html__( 'Enable Recently Reviewed Products', 'azirspares' ),
								),
								array(
									'id'         => 'azirspares_woo_recently_reviewed_products_title',
									'type'       => 'text',
									'title'      => esc_html__( 'Recently viewed products title', 'azirspares' ),
									'desc'       => esc_html__( 'Recently viewed products title', 'azirspares' ),
									'default'    => esc_html__( 'Recently viewed', 'azirspares' ),
									'dependency' => array( 'azirspares_woo_recently_reviewed_enable', '==', 'enable' ),
								),
								array(
									'id'         => 'azirspares_woo_recently_reviewed_ls_items',
									'type'       => 'select',
									'title'      => esc_html__( 'Recently viewed products items per row on Desktop', 'azirspares' ),
									'desc'       => esc_html__( '(Screen resolution of device >= 1500px )', 'azirspares' ),
									'options'    => array(
										'1' => esc_html__( '1 item', 'azirspares' ),
										'2' => esc_html__( '2 items', 'azirspares' ),
										'3' => esc_html__( '3 items', 'azirspares' ),
										'4' => esc_html__( '4 items', 'azirspares' ),
										'5' => esc_html__( '5 items', 'azirspares' ),
										'6' => esc_html__( '6 items', 'azirspares' ),
									),
									'default'    => '6',
									'dependency' => array( 'azirspares_woo_recently_reviewed_enable', '==', 'enable' ),
								),
								array(
									'id'         => 'azirspares_woo_recently_reviewed_lg_items',
									'type'       => 'select',
									'title'      => esc_html__( 'Recently viewed products items per row on Desktop', 'azirspares' ),
									'desc'       => esc_html__( '(Screen resolution of device >= 1200px < 1500px )', 'azirspares' ),
									'options'    => array(
										'1' => esc_html__( '1 item', 'azirspares' ),
										'2' => esc_html__( '2 items', 'azirspares' ),
										'3' => esc_html__( '3 items', 'azirspares' ),
										'4' => esc_html__( '4 items', 'azirspares' ),
										'5' => esc_html__( '5 items', 'azirspares' ),
										'6' => esc_html__( '6 items', 'azirspares' ),
									),
									'default'    => '5',
									'dependency' => array( 'azirspares_woo_recently_reviewed_enable', '==', 'enable' ),
								),
								array(
									'id'         => 'azirspares_woo_recently_reviewed_md_items',
									'type'       => 'select',
									'title'      => esc_html__( 'Recently viewed products items per row on landscape tablet', 'azirspares' ),
									'desc'       => esc_html__( '(Screen resolution of device >=992px and < 1200px )', 'azirspares' ),
									'options'    => array(
										'1' => esc_html__( '1 item', 'azirspares' ),
										'2' => esc_html__( '2 items', 'azirspares' ),
										'3' => esc_html__( '3 items', 'azirspares' ),
										'4' => esc_html__( '4 items', 'azirspares' ),
										'5' => esc_html__( '5 items', 'azirspares' ),
										'6' => esc_html__( '6 items', 'azirspares' ),
									),
									'default'    => '4',
									'dependency' => array( 'azirspares_woo_recently_reviewed_enable', '==', 'enable' ),
								),
								array(
									'id'         => 'azirspares_woo_recently_reviewed_sm_items',
									'type'       => 'select',
									'title'      => esc_html__( 'Recently viewed product items per row on portrait tablet', 'azirspares' ),
									'desc'       => esc_html__( '(Screen resolution of device >=768px and < 992px )', 'azirspares' ),
									'options'    => array(
										'1' => esc_html__( '1 item', 'azirspares' ),
										'2' => esc_html__( '2 items', 'azirspares' ),
										'3' => esc_html__( '3 items', 'azirspares' ),
										'4' => esc_html__( '4 items', 'azirspares' ),
										'5' => esc_html__( '5 items', 'azirspares' ),
										'6' => esc_html__( '6 items', 'azirspares' ),
									),
									'default'    => '3',
									'dependency' => array( 'azirspares_woo_recently_reviewed_enable', '==', 'enable' ),
								),
								array(
									'id'         => 'azirspares_woo_recently_reviewed_xs_items',
									'type'       => 'select',
									'title'      => esc_html__( 'Recently viewed products items per row on Mobile', 'azirspares' ),
									'desc'       => esc_html__( '(Screen resolution of device >=480  add < 768px)', 'azirspares' ),
									'options'    => array(
										'1' => esc_html__( '1 item', 'azirspares' ),
										'2' => esc_html__( '2 items', 'azirspares' ),
										'3' => esc_html__( '3 items', 'azirspares' ),
										'4' => esc_html__( '4 items', 'azirspares' ),
										'5' => esc_html__( '5 items', 'azirspares' ),
										'6' => esc_html__( '6 items', 'azirspares' ),
									),
									'default'    => '2',
									'dependency' => array( 'azirspares_woo_recently_reviewed_enable', '==', 'enable' ),
								),
								array(
									'id'         => 'azirspares_woo_recently_reviewed_ts_items',
									'type'       => 'select',
									'title'      => esc_html__( 'Recently viewed products items per row on Mobile', 'azirspares' ),
									'desc'       => esc_html__( '(Screen resolution of device < 480px)', 'azirspares' ),
									'options'    => array(
										'1' => esc_html__( '1 item', 'azirspares' ),
										'2' => esc_html__( '2 items', 'azirspares' ),
										'3' => esc_html__( '3 items', 'azirspares' ),
										'4' => esc_html__( '4 items', 'azirspares' ),
										'5' => esc_html__( '5 items', 'azirspares' ),
										'6' => esc_html__( '6 items', 'azirspares' ),
									),
									'default'    => '2',
									'dependency' => array( 'azirspares_woo_recently_reviewed_enable', '==', 'enable' ),
								),
							),
						),
						array(
							'name'   => 'azirspares_related_product',
							'title'  => esc_html__( 'Related Products', 'azirspares' ),
							'fields' => array(
								array(
									'id'      => 'azirspares_woo_related_enable',
									'type'    => 'select',
									'default' => 'enable',
									'options' => array(
										'enable'  => esc_html__( 'Enable', 'azirspares' ),
										'disable' => esc_html__( 'Disable', 'azirspares' ),
									),
									'title'   => esc_html__( 'Enable Related Products', 'azirspares' ),
								),
								array(
									'id'         => 'azirspares_woo_related_products_title',
									'type'       => 'text',
									'title'      => esc_html__( 'Related products title', 'azirspares' ),
									'desc'       => esc_html__( 'Related products title', 'azirspares' ),
									'dependency' => array( 'azirspares_woo_related_enable', '==', 'enable' ),
									'default'    => esc_html__( 'Related Products', 'azirspares' ),
								),
								array(
									'id'         => 'azirspares_woo_related_ls_items',
									'type'       => 'select',
									'title'      => esc_html__( 'Related products items per row on Desktop', 'azirspares' ),
									'desc'       => esc_html__( '(Screen resolution of device >= 1500px )', 'azirspares' ),
									'options'    => array(
										'1' => esc_html__( '1 item', 'azirspares' ),
										'2' => esc_html__( '2 items', 'azirspares' ),
										'3' => esc_html__( '3 items', 'azirspares' ),
										'4' => esc_html__( '4 items', 'azirspares' ),
										'5' => esc_html__( '5 items', 'azirspares' ),
										'6' => esc_html__( '6 items', 'azirspares' ),
									),
									'default'    => '4',
									'dependency' => array( 'azirspares_woo_related_enable', '==', 'enable' ),
								),
								array(
									'id'         => 'azirspares_woo_related_lg_items',
									'type'       => 'select',
									'title'      => esc_html__( 'Related products items per row on Desktop', 'azirspares' ),
									'desc'       => esc_html__( '(Screen resolution of device >= 1200px < 1500px )', 'azirspares' ),
									'options'    => array(
										'1' => esc_html__( '1 item', 'azirspares' ),
										'2' => esc_html__( '2 items', 'azirspares' ),
										'3' => esc_html__( '3 items', 'azirspares' ),
										'4' => esc_html__( '4 items', 'azirspares' ),
										'5' => esc_html__( '5 items', 'azirspares' ),
										'6' => esc_html__( '6 items', 'azirspares' ),
									),
									'default'    => '3',
									'dependency' => array( 'azirspares_woo_related_enable', '==', 'enable' ),
								),
								array(
									'id'         => 'azirspares_woo_related_md_items',
									'type'       => 'select',
									'title'      => esc_html__( 'Related products items per row on landscape tablet', 'azirspares' ),
									'desc'       => esc_html__( '(Screen resolution of device >=992px and < 1200px )', 'azirspares' ),
									'options'    => array(
										'1' => esc_html__( '1 item', 'azirspares' ),
										'2' => esc_html__( '2 items', 'azirspares' ),
										'3' => esc_html__( '3 items', 'azirspares' ),
										'4' => esc_html__( '4 items', 'azirspares' ),
										'5' => esc_html__( '5 items', 'azirspares' ),
										'6' => esc_html__( '6 items', 'azirspares' ),
									),
									'default'    => '3',
									'dependency' => array( 'azirspares_woo_related_enable', '==', 'enable' ),
								),
								array(
									'id'         => 'azirspares_woo_related_sm_items',
									'type'       => 'select',
									'title'      => esc_html__( 'Related product items per row on portrait tablet', 'azirspares' ),
									'desc'       => esc_html__( '(Screen resolution of device >=768px and < 992px )', 'azirspares' ),
									'options'    => array(
										'1' => esc_html__( '1 item', 'azirspares' ),
										'2' => esc_html__( '2 items', 'azirspares' ),
										'3' => esc_html__( '3 items', 'azirspares' ),
										'4' => esc_html__( '4 items', 'azirspares' ),
										'5' => esc_html__( '5 items', 'azirspares' ),
										'6' => esc_html__( '6 items', 'azirspares' ),
									),
									'default'    => '2',
									'dependency' => array( 'azirspares_woo_related_enable', '==', 'enable' ),
								),
								array(
									'id'         => 'azirspares_woo_related_xs_items',
									'type'       => 'select',
									'title'      => esc_html__( 'Related products items per row on Mobile', 'azirspares' ),
									'desc'       => esc_html__( '(Screen resolution of device >=480  add < 768px)', 'azirspares' ),
									'options'    => array(
										'1' => esc_html__( '1 item', 'azirspares' ),
										'2' => esc_html__( '2 items', 'azirspares' ),
										'3' => esc_html__( '3 items', 'azirspares' ),
										'4' => esc_html__( '4 items', 'azirspares' ),
										'5' => esc_html__( '5 items', 'azirspares' ),
										'6' => esc_html__( '6 items', 'azirspares' ),
									),
									'default'    => '2',
									'dependency' => array( 'azirspares_woo_related_enable', '==', 'enable' ),
								),
								array(
									'id'         => 'azirspares_woo_related_ts_items',
									'type'       => 'select',
									'title'      => esc_html__( 'Related products items per row on Mobile', 'azirspares' ),
									'desc'       => esc_html__( '(Screen resolution of device < 480px)', 'azirspares' ),
									'options'    => array(
										'1' => esc_html__( '1 item', 'azirspares' ),
										'2' => esc_html__( '2 items', 'azirspares' ),
										'3' => esc_html__( '3 items', 'azirspares' ),
										'4' => esc_html__( '4 items', 'azirspares' ),
										'5' => esc_html__( '5 items', 'azirspares' ),
										'6' => esc_html__( '6 items', 'azirspares' ),
									),
									'default'    => '2',
									'dependency' => array( 'azirspares_woo_related_enable', '==', 'enable' ),
								),
							),
						),
						array(
							'name'   => 'crosssell_product',
							'title'  => esc_html__( 'Cross Sell Products', 'azirspares' ),
							'fields' => array(
								array(
									'id'      => 'azirspares_woo_crosssell_enable',
									'type'    => 'select',
									'default' => 'enable',
									'options' => array(
										'enable'  => esc_html__( 'Enable', 'azirspares' ),
										'disable' => esc_html__( 'Disable', 'azirspares' ),
									),
									'title'   => esc_html__( 'Enable Cross Sell Products', 'azirspares' ),
								),
								array(
									'id'         => 'azirspares_woo_crosssell_products_title',
									'type'       => 'text',
									'title'      => esc_html__( 'Cross Sell products title', 'azirspares' ),
									'desc'       => esc_html__( 'Cross Sell products title', 'azirspares' ),
									'dependency' => array( 'azirspares_woo_crosssell_enable', '==', 'enable' ),
									'default'    => esc_html__( 'Cross Sell Products', 'azirspares' ),
								),
								array(
									'id'         => 'azirspares_woo_crosssell_ls_items',
									'type'       => 'select',
									'title'      => esc_html__( 'Cross Sell products items per row on Desktop', 'azirspares' ),
									'desc'       => esc_html__( '(Screen resolution of device >= 1500px )', 'azirspares' ),
									'options'    => array(
										'1' => esc_html__( '1 item', 'azirspares' ),
										'2' => esc_html__( '2 items', 'azirspares' ),
										'3' => esc_html__( '3 items', 'azirspares' ),
										'4' => esc_html__( '4 items', 'azirspares' ),
										'5' => esc_html__( '5 items', 'azirspares' ),
										'6' => esc_html__( '6 items', 'azirspares' ),
									),
									'default'    => '4',
									'dependency' => array( 'azirspares_woo_crosssell_enable', '==', 'enable' ),
								),
								array(
									'id'         => 'azirspares_woo_crosssell_lg_items',
									'type'       => 'select',
									'title'      => esc_html__( 'Cross Sell products items per row on Desktop', 'azirspares' ),
									'desc'       => esc_html__( '(Screen resolution of device >= 1200px < 1500px )', 'azirspares' ),
									'options'    => array(
										'1' => esc_html__( '1 item', 'azirspares' ),
										'2' => esc_html__( '2 items', 'azirspares' ),
										'3' => esc_html__( '3 items', 'azirspares' ),
										'4' => esc_html__( '4 items', 'azirspares' ),
										'5' => esc_html__( '5 items', 'azirspares' ),
										'6' => esc_html__( '6 items', 'azirspares' ),
									),
									'default'    => '3',
									'dependency' => array( 'azirspares_woo_crosssell_enable', '==', 'enable' ),
								),
								array(
									'id'         => 'azirspares_woo_crosssell_md_items',
									'type'       => 'select',
									'title'      => esc_html__( 'Cross Sell products items per row on landscape tablet', 'azirspares' ),
									'desc'       => esc_html__( '(Screen resolution of device >=992px and < 1200px )', 'azirspares' ),
									'options'    => array(
										'1' => esc_html__( '1 item', 'azirspares' ),
										'2' => esc_html__( '2 items', 'azirspares' ),
										'3' => esc_html__( '3 items', 'azirspares' ),
										'4' => esc_html__( '4 items', 'azirspares' ),
										'5' => esc_html__( '5 items', 'azirspares' ),
										'6' => esc_html__( '6 items', 'azirspares' ),
									),
									'default'    => '3',
									'dependency' => array( 'azirspares_woo_crosssell_enable', '==', 'enable' ),
								),
								array(
									'id'         => 'azirspares_woo_crosssell_sm_items',
									'type'       => 'select',
									'title'      => esc_html__( 'Cross Sell product items per row on portrait tablet', 'azirspares' ),
									'desc'       => esc_html__( '(Screen resolution of device >=768px and < 992px )', 'azirspares' ),
									'options'    => array(
										'1' => esc_html__( '1 item', 'azirspares' ),
										'2' => esc_html__( '2 items', 'azirspares' ),
										'3' => esc_html__( '3 items', 'azirspares' ),
										'4' => esc_html__( '4 items', 'azirspares' ),
										'5' => esc_html__( '5 items', 'azirspares' ),
										'6' => esc_html__( '6 items', 'azirspares' ),
									),
									'default'    => '2',
									'dependency' => array( 'azirspares_woo_crosssell_enable', '==', 'enable' ),
								),
								array(
									'id'         => 'azirspares_woo_crosssell_xs_items',
									'type'       => 'select',
									'title'      => esc_html__( 'Cross Sell products items per row on Mobile', 'azirspares' ),
									'desc'       => esc_html__( '(Screen resolution of device >=480  add < 768px)', 'azirspares' ),
									'options'    => array(
										'1' => esc_html__( '1 item', 'azirspares' ),
										'2' => esc_html__( '2 items', 'azirspares' ),
										'3' => esc_html__( '3 items', 'azirspares' ),
										'4' => esc_html__( '4 items', 'azirspares' ),
										'5' => esc_html__( '5 items', 'azirspares' ),
										'6' => esc_html__( '6 items', 'azirspares' ),
									),
									'default'    => '2',
									'dependency' => array( 'azirspares_woo_crosssell_enable', '==', 'enable' ),
								),
								array(
									'id'         => 'azirspares_woo_crosssell_ts_items',
									'type'       => 'select',
									'title'      => esc_html__( 'Cross Sell products items per row on Mobile', 'azirspares' ),
									'desc'       => esc_html__( '(Screen resolution of device < 480px)', 'azirspares' ),
									'options'    => array(
										'1' => esc_html__( '1 item', 'azirspares' ),
										'2' => esc_html__( '2 items', 'azirspares' ),
										'3' => esc_html__( '3 items', 'azirspares' ),
										'4' => esc_html__( '4 items', 'azirspares' ),
										'5' => esc_html__( '5 items', 'azirspares' ),
										'6' => esc_html__( '6 items', 'azirspares' ),
									),
									'default'    => '2',
									'dependency' => array( 'azirspares_woo_crosssell_enable', '==', 'enable' ),
								),
							),
						),
						array(
							'name'   => 'upsell_product',
							'title'  => esc_html__( 'Upsell Products', 'azirspares' ),
							'fields' => array(
								array(
									'id'      => 'azirspares_woo_upsell_enable',
									'type'    => 'select',
									'default' => 'enable',
									'options' => array(
										'enable'  => esc_html__( 'Enable', 'azirspares' ),
										'disable' => esc_html__( 'Disable', 'azirspares' ),
									),
									'title'   => esc_html__( 'Enable Upsell Products', 'azirspares' ),
								),
								array(
									'id'         => 'azirspares_woo_upsell_products_title',
									'type'       => 'text',
									'title'      => esc_html__( 'Upsell products title', 'azirspares' ),
									'desc'       => esc_html__( 'Upsell products title', 'azirspares' ),
									'dependency' => array( 'azirspares_woo_upsell_enable', '==', 'enable' ),
									'default'    => esc_html__( 'Upsell Products', 'azirspares' ),
								),
								array(
									'id'         => 'azirspares_woo_upsell_ls_items',
									'type'       => 'select',
									'title'      => esc_html__( 'Upsell products items per row on Desktop', 'azirspares' ),
									'desc'       => esc_html__( '(Screen resolution of device >= 1500px )', 'azirspares' ),
									'options'    => array(
										'1' => esc_html__( '1 item', 'azirspares' ),
										'2' => esc_html__( '2 items', 'azirspares' ),
										'3' => esc_html__( '3 items', 'azirspares' ),
										'4' => esc_html__( '4 items', 'azirspares' ),
										'5' => esc_html__( '5 items', 'azirspares' ),
										'6' => esc_html__( '6 items', 'azirspares' ),
									),
									'default'    => '4',
									'dependency' => array( 'azirspares_woo_upsell_enable', '==', 'enable' ),
								),
								array(
									'id'         => 'azirspares_woo_upsell_lg_items',
									'type'       => 'select',
									'title'      => esc_html__( 'Upsell products items per row on Desktop', 'azirspares' ),
									'desc'       => esc_html__( '(Screen resolution of device >= 1200px < 1500px )', 'azirspares' ),
									'options'    => array(
										'1' => esc_html__( '1 item', 'azirspares' ),
										'2' => esc_html__( '2 items', 'azirspares' ),
										'3' => esc_html__( '3 items', 'azirspares' ),
										'4' => esc_html__( '4 items', 'azirspares' ),
										'5' => esc_html__( '5 items', 'azirspares' ),
										'6' => esc_html__( '6 items', 'azirspares' ),
									),
									'default'    => '3',
									'dependency' => array( 'azirspares_woo_upsell_enable', '==', 'enable' ),
								),
								array(
									'id'         => 'azirspares_woo_upsell_md_items',
									'type'       => 'select',
									'title'      => esc_html__( 'Upsell products items per row on landscape tablet', 'azirspares' ),
									'desc'       => esc_html__( '(Screen resolution of device >=992px and < 1200px )', 'azirspares' ),
									'options'    => array(
										'1' => esc_html__( '1 item', 'azirspares' ),
										'2' => esc_html__( '2 items', 'azirspares' ),
										'3' => esc_html__( '3 items', 'azirspares' ),
										'4' => esc_html__( '4 items', 'azirspares' ),
										'5' => esc_html__( '5 items', 'azirspares' ),
										'6' => esc_html__( '6 items', 'azirspares' ),
									),
									'default'    => '3',
									'dependency' => array( 'azirspares_woo_upsell_enable', '==', 'enable' ),
								),
								array(
									'id'         => 'azirspares_woo_upsell_sm_items',
									'type'       => 'select',
									'title'      => esc_html__( 'Upsell product items per row on portrait tablet', 'azirspares' ),
									'desc'       => esc_html__( '(Screen resolution of device >=768px and < 992px )', 'azirspares' ),
									'options'    => array(
										'1' => esc_html__( '1 item', 'azirspares' ),
										'2' => esc_html__( '2 items', 'azirspares' ),
										'3' => esc_html__( '3 items', 'azirspares' ),
										'4' => esc_html__( '4 items', 'azirspares' ),
										'5' => esc_html__( '5 items', 'azirspares' ),
										'6' => esc_html__( '6 items', 'azirspares' ),
									),
									'default'    => '2',
									'dependency' => array( 'azirspares_woo_upsell_enable', '==', 'enable' ),
								),
								array(
									'id'         => 'azirspares_woo_upsell_xs_items',
									'type'       => 'select',
									'title'      => esc_html__( 'Upsell products items per row on Mobile', 'azirspares' ),
									'desc'       => esc_html__( '(Screen resolution of device >=480  add < 768px)', 'azirspares' ),
									'options'    => array(
										'1' => esc_html__( '1 item', 'azirspares' ),
										'2' => esc_html__( '2 items', 'azirspares' ),
										'3' => esc_html__( '3 items', 'azirspares' ),
										'4' => esc_html__( '4 items', 'azirspares' ),
										'5' => esc_html__( '5 items', 'azirspares' ),
										'6' => esc_html__( '6 items', 'azirspares' ),
									),
									'default'    => '2',
									'dependency' => array( 'azirspares_woo_upsell_enable', '==', 'enable' ),
								),
								array(
									'id'         => 'azirspares_woo_upsell_ts_items',
									'type'       => 'select',
									'title'      => esc_html__( 'Upsell products items per row on Mobile', 'azirspares' ),
									'desc'       => esc_html__( '(Screen resolution of device < 480px)', 'azirspares' ),
									'options'    => array(
										'1' => esc_html__( '1 item', 'azirspares' ),
										'2' => esc_html__( '2 items', 'azirspares' ),
										'3' => esc_html__( '3 items', 'azirspares' ),
										'4' => esc_html__( '4 items', 'azirspares' ),
										'5' => esc_html__( '5 items', 'azirspares' ),
										'6' => esc_html__( '6 items', 'azirspares' ),
									),
									'default'    => '2',
									'dependency' => array( 'azirspares_woo_upsell_enable', '==', 'enable' ),
								),
							),
						),
					),
				);
			}
			$options[] = array(
				'name'   => 'social_settings',
				'title'  => esc_html__( 'Social Settings', 'azirspares' ),
				'icon'   => 'fa fa-users',
				'fields' => array(
					array(
						'type'    => 'subheading',
						'content' => esc_html__( 'Social User', 'azirspares' ),
					),
					array(
						'id'              => 'user_all_social',
						'type'            => 'group',
						'title'           => esc_html__( 'Social', 'azirspares' ),
						'button_title'    => esc_html__( 'Add New Social', 'azirspares' ),
						'accordion_title' => esc_html__( 'Social Settings', 'azirspares' ),
						'fields'          => array(
							array(
								'id'      => 'title_social',
								'type'    => 'text',
								'title'   => esc_html__( 'Title Social', 'azirspares' ),
								'default' => 'Facebook',
							),
							array(
								'id'      => 'link_social',
								'type'    => 'text',
								'title'   => esc_html__( 'Link Social', 'azirspares' ),
								'default' => 'https://facebook.com',
							),
							array(
								'id'      => 'icon_social',
								'type'    => 'icon',
								'title'   => esc_html__( 'Icon Social', 'azirspares' ),
								'default' => 'fa fa-facebook',
							),
						),
					),
				),
			);
			$options[] = array(
				'name'   => 'typography',
				'title'  => esc_html__( 'Typography Options', 'azirspares' ),
				'icon'   => 'fa fa-font',
				'fields' => array(
					array(
						'id'    => 'azirspares_enable_typography',
						'type'  => 'switcher',
						'title' => esc_html__( 'Enable Typography', 'azirspares' ),
					),
					array(
						'id'              => 'typography_group',
						'type'            => 'group',
						'title'           => esc_html__( 'Typography Options', 'azirspares' ),
						'button_title'    => esc_html__( 'Add New Typography', 'azirspares' ),
						'accordion_title' => esc_html__( 'Typography Item', 'azirspares' ),
						'dependency'      => array(
							'azirspares_enable_typography',
							'==',
							true,
						),
						'fields'          => array(
							'azirspares_element_tag'            => array(
								'id'      => 'azirspares_element_tag',
								'type'    => 'select',
								'options' => array(
									'body' => esc_html__( 'Body', 'azirspares' ),
									'h1'   => esc_html__( 'H1', 'azirspares' ),
									'h2'   => esc_html__( 'H2', 'azirspares' ),
									'h3'   => esc_html__( 'H3', 'azirspares' ),
									'h4'   => esc_html__( 'H4', 'azirspares' ),
									'h5'   => esc_html__( 'H5', 'azirspares' ),
									'h6'   => esc_html__( 'H6', 'azirspares' ),
									'p'    => esc_html__( 'P', 'azirspares' ),
								),
								'title'   => esc_html__( 'Element Tag', 'azirspares' ),
								'desc'    => esc_html__( 'Select a Element Tag HTML', 'azirspares' ),
							),
							'azirspares_typography_font_family' => array(
								'id'     => 'azirspares_typography_font_family',
								'type'   => 'typography',
								'title'  => esc_html__( 'Font Family', 'azirspares' ),
								'desc'   => esc_html__( 'Select a Font Family', 'azirspares' ),
								'chosen' => false,
							),
							'azirspares_body_text_color'        => array(
								'id'    => 'azirspares_body_text_color',
								'type'  => 'color_picker',
								'title' => esc_html__( 'Body Text Color', 'azirspares' ),
							),
							'azirspares_typography_font_size'   => array(
								'id'      => 'azirspares_typography_font_size',
								'type'    => 'number',
								'default' => 16,
								'title'   => esc_html__( 'Font Size', 'azirspares' ),
								'desc'    => esc_html__( 'Unit PX', 'azirspares' ),
							),
							'azirspares_typography_line_height' => array(
								'id'      => 'azirspares_typography_line_height',
								'type'    => 'number',
								'default' => 24,
								'title'   => esc_html__( 'Line Height', 'azirspares' ),
								'desc'    => esc_html__( 'Unit PX', 'azirspares' ),
							),
						),
						'default'         => array(
							array(
								'azirspares_element_tag'            => 'body',
								'azirspares_typography_font_family' => 'Arial',
								'azirspares_body_text_color'        => '#81d742',
								'azirspares_typography_font_size'   => 16,
								'azirspares_typography_line_height' => 24,
							),
						),
					),
				),
			);
			$options[] = array(
				'name'   => 'backup_option',
				'title'  => esc_html__( 'Backup Options', 'azirspares' ),
				'icon'   => 'fa fa-bold',
				'fields' => array(
					array(
						'type'  => 'backup',
						'title' => esc_html__( 'Backup Field', 'azirspares' ),
					),
				),
			);
			
			return $options;
		}
		
		function metabox_options( $options ) {
			// $options = array();
			if ( ! $options ) {
				$options = array();
			}
			// -----------------------------------------
			// Page Meta box Options                   -
			// -----------------------------------------
			$options[] = array(
				'id'        => '_custom_metabox_theme_options',
				'title'     => esc_html__( 'Custom Theme Options', 'azirspares' ),
				'post_type' => 'page',
				'context'   => 'normal',
				'priority'  => 'high',
				'sections'  => array(
					'general' => array(
						'name'   => 'page_general_settings',
						'title'  => esc_html__( 'General Settings', 'azirspares' ),
						'icon'   => 'fa fa-wordpress',
						'fields' => array(
							array(
								'id'    => 'azirspares_metabox_logo',
								'type'  => 'image',
								'title' => esc_html__( 'Main Logo', 'azirspares' ),
							),
							array(
								'id'    => 'bg_banner_page',
								'type'  => 'image',
								'title' => esc_html__( 'Banner Page', 'azirspares' ),
							),
							array(
								'id'    => 'bg_color_page',
								'type'  => 'color_picker',
								'title' => esc_html__( 'Background Color Page', 'azirspares' ),
							),
						),
					),
					'header'  => array(
						'name'   => 'header',
						'title'  => esc_html__( 'Header Settings', 'azirspares' ),
						'icon'   => 'fa fa-header',
						'fields' => array(
							array(
								'id'    => 'azirspares_header_enable',
								'type'  => 'switcher',
								'title' => esc_html__( 'Enable Custom header', 'azirspares' ),
							),
							array(
								'id'         => 'metabox_azirspares_used_header',
								'type'       => 'select_preview',
								'title'      => esc_html__( 'Header Layout', 'azirspares' ),
								'desc'       => esc_html__( 'Select a header layout', 'azirspares' ),
								'options'    => self::get_header_preview(),
								'default'    => 'style-01',
								'dependency' => array( 'azirspares_header_enable', '==', true ),
							),
						),
					),
					'footer'  => array(
						'name'   => 'footer',
						'title'  => esc_html__( 'Footer Settings', 'azirspares' ),
						'icon'   => 'fa fa-underline',
						'fields' => array(
							array(
								'id'    => 'azirspares_footer_enable',
								'type'  => 'switcher',
								'title' => esc_html__( 'Enable Custom Footer', 'azirspares' ),
							),
							array(
								'id'         => 'metabox_azirspares_footer_options',
								'type'       => 'select_preview',
								'title'      => esc_html__( 'Select Footer Builder', 'azirspares' ),
								'options'    => self::get_footer_preview(),
								'default'    => 'default',
								'dependency' => array( 'azirspares_footer_enable', '==', true ),
							),
						),
					),
				),
			);
			// -----------------------------------------
			// Post Meta box Options                   -
			// -----------------------------------------
			$options[] = array(
				'id'        => '_custom_metabox_post_options',
				'title'     => esc_html__( 'Custom Post Options', 'azirspares' ),
				'post_type' => 'post',
				'context'   => 'normal',
				'priority'  => 'high',
				'sections'  => array(
					array(
						'name'   => 'gallery_settings',
						'title'  => esc_html__( 'Gallery Settings', 'azirspares' ),
						'fields' => array(
							array(
								'id'    => 'gallery_post',
								'type'  => 'gallery',
								'title' => esc_html__( 'Gallery', 'azirspares' ),
							),
						),
					),
					array(
						'name'   => 'video_settings',
						'title'  => esc_html__( 'Video Settings', 'azirspares' ),
						'fields' => array(
							array(
								'id'       => 'video_post',
								'type'     => 'upload',
								'title'    => esc_html__( 'Video Url', 'azirspares' ),
								'settings' => array(
									'upload_type'  => 'video',
									'button_title' => esc_html__( 'Video', 'azirspares' ),
									'frame_title'  => esc_html__( 'Select a video', 'azirspares' ),
									'insert_title' => esc_html__( 'Use this video', 'azirspares' ),
								),
								'desc'     => esc_html__( 'Supports video Url Youtube and upload.', 'azirspares' ),
							),
						),
					),
					array(
						'name'   => 'quote_settings',
						'title'  => esc_html__( 'Quote Settings', 'azirspares' ),
						'fields' => array(
							array(
								'id'    => 'quote_post',
								'type'  => 'wysiwyg',
								'title' => esc_html__( 'Quote Text', 'azirspares' ),
							),
						),
					),
				),
			);
			// -----------------------------------------
			// Page Side Meta box Options              -
			// -----------------------------------------
			$options[] = array(
				'id'        => '_custom_page_side_options',
				'title'     => esc_html__( 'Custom Page Side Options', 'azirspares' ),
				'post_type' => 'page',
				'context'   => 'side',
				'priority'  => 'default',
				'sections'  => array(
					array(
						'name'   => 'page_option',
						'fields' => array(
							array(
								'id'      => 'sidebar_page_layout',
								'type'    => 'image_select',
								'title'   => esc_html__( 'Single Post Sidebar Position', 'azirspares' ),
								'desc'    => esc_html__( 'Select sidebar position on Page.', 'azirspares' ),
								'options' => array(
									'left'  => esc_attr( ' data:image/png;base64,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' ),
									'right' => esc_attr( ' data:image/png;base64,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' ),
									'full'  => esc_attr( ' data:image/png;base64,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' ),
								),
								'default' => 'left',
							),
							array(
								'id'         => 'page_sidebar',
								'type'       => 'select',
								'title'      => esc_html__( 'Page Sidebar', 'azirspares' ),
								'options'    => self::get_sidebar_options(),
								'default'    => 'blue',
								'dependency' => array( 'sidebar_page_layout_full', '==', false ),
							),
							array(
								'id'    => 'page_extra_class',
								'type'  => 'text',
								'title' => esc_html__( 'Extra Class', 'azirspares' ),
							),
						),
					),
				),
			);
			// -----------------------------------------
			// Page Product Meta box Options      	   -
			// -----------------------------------------
			$options[] = array(
				'id'        => '_custom_product_woo_options',
				'title'     => esc_html__( 'Custom Product Options', 'azirspares' ),
				'post_type' => 'product',
				'context'   => 'side',
				'priority'  => 'high',
				'sections'  => array(
					array(
						'name'   => 'product_detail',
						'fields' => array(
							array(
								'id'      => 'product_options',
								'type'    => 'select',
								'title'   => esc_html__( 'Format Product', 'azirspares' ),
								'options' => array(
									'video'  => esc_html__( 'Video', 'azirspares' ),
									'360deg' => esc_html__( '360 Degree', 'azirspares' ),
								),
							),
							array(
								'id'         => 'degree_product_gallery',
								'type'       => 'gallery',
								'title'      => esc_html__( '360 Degree Product', 'azirspares' ),
								'dependency' => array( 'product_options', '==', '360deg' ),
							),
							array(
								'id'         => 'video_product_url',
								'type'       => 'upload',
								'title'      => esc_html__( 'Video Url', 'azirspares' ),
								'dependency' => array( 'product_options', '==', 'video' ),
							),
						),
					),
				),
			);
			
			return $options;
		}
		
		function taxonomy_options( $options ) {
			$options = array();
			// -----------------------------------------
			// Taxonomy Options                        -
			// -----------------------------------------
			$options[] = array(
				'id'       => '_custom_taxonomy_options',
				'taxonomy' => 'product_cat', // category, post_tag or your custom taxonomy name
				'fields'   => array(
					array(
						'id'      => 'icon_taxonomy',
						'type'    => 'icon',
						'title'   => esc_html__( 'Icon Taxonomy', 'azirspares' ),
						'default' => '',
					),
				),
			);
			
			return $options;
		}
	}
	
	new Azirspares_ThemeOption();
}