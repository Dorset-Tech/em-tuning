<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 *
 * HOOK TEMPLATE
 */
add_filter( 'wp_nav_menu_items', 'azirspares_menu_detailing', 10, 2 );
add_filter( 'wp_nav_menu_items', 'azirspares_top_right_menu', 10, 2 );
/**
 *
 * HOOK AJAX
 */
add_filter( 'wcml_multi_currency_ajax_actions', 'azirspares_add_action_to_multi_currency_ajax', 10, 1 );
add_action( 'wp_ajax_azirspares_ajax_tabs', 'azirspares_ajax_tabs' );
add_action( 'wp_ajax_nopriv_azirspares_ajax_tabs', 'azirspares_ajax_tabs' );
/**
 *
 * HOOK AJAX
 */
add_action( 'wp_ajax_azirspares_ajax_loadmore', 'azirspares_ajax_loadmore' );
add_action( 'wp_ajax_nopriv_azirspares_ajax_loadmore', 'azirspares_ajax_loadmore' );

?>
<?php
/**
 *
 * HOOK TEMPLATE FUNCTIONS
 */
if ( ! function_exists( 'azirspares_get_logo' ) ) {
	function azirspares_get_logo() {
		$id_page   = Azirspares_Functions::azirspares_get_id();
		$width     = Azirspares_Functions::azirspares_get_option( 'azirspares_width_logo', '228' );
		$width     .= 'px';
		$logo_url  = get_theme_file_uri( '/assets/images/logo.svg' );
		$data_meta = get_post_meta( $id_page, '_custom_metabox_theme_options', true );
		$logo      = Azirspares_Functions::azirspares_get_option( 'azirspares_logo' );
		if ( isset( $data_meta['azirspares_metabox_logo'] ) && $data_meta['azirspares_metabox_logo'] != '' ) {
			$logo = $data_meta['azirspares_metabox_logo'];
		}
		if ( $logo != '' ) {
			$logo_url = wp_get_attachment_image_url( $logo, 'full' );
		}
		
		$html = '<a href="' . esc_url( home_url( '/' ) ) . '"><img style="width:' . esc_attr( $width ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" src="' . esc_url( $logo_url ) . '" class="logo" /></a>';
		echo apply_filters( 'azirspares_site_logo', $html );
	}
}
/*Logo mobile*/
if ( ! function_exists( 'azirspares_get_logo_mobile' ) ) {
	function azirspares_get_logo_mobile() {
		$id_page  = Azirspares_Functions::azirspares_get_id();
		$width    = Azirspares_Functions::azirspares_get_option( 'azirspares_width_logo', '228' );
		$width    .= 'px';
		$logo_url = get_theme_file_uri( '/assets/images/logo.svg' );
		$logo     = Azirspares_Functions::azirspares_get_option( 'azirsparesr_mobile_logo' );
		if ( $logo != '' ) {
			$logo_url = wp_get_attachment_image_url( $logo, 'full' );
		}
		$html = '<a href="' . esc_url( home_url( '/' ) ) . '"><img style="width:' . esc_attr( $width ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" src="' . esc_url( $logo_url ) . '" class="logo" /></a>';
		echo apply_filters( 'azirspares_site_logo', $html );
	}
}
if ( ! function_exists( 'azirspares_detected_shortcode' ) ) {
	function azirspares_detected_shortcode( $id, $tab_id = null, $product_id = null ) {
		$post              = get_post( $id );
		$content           = preg_replace( '/\s+/', ' ', $post->post_content );
		$shortcode_section = '';
		if ( $tab_id == null ) {
			$out = array();
			preg_match_all( '/\[azirspares_products(.*?)\]/', $content, $matches );
			if ( $matches[0] && is_array( $matches[0] ) && count( $matches[0] ) > 0 ) {
				foreach ( $matches[0] as $key => $value ) {
					if ( shortcode_parse_atts( $matches[1][ $key ] )['products_custom_id'] == $product_id ) {
						$out['atts']    = shortcode_parse_atts( $matches[1][ $key ] );
						$out['content'] = $value;
					}
				}
			}
			$shortcode_section = $out;
		}
		if ( $product_id == null ) {
			preg_match_all( '/\[vc_tta_section(.*?)vc_tta_section\]/', $content, $matches );
			if ( $matches[0] && is_array( $matches[0] ) && count( $matches[0] ) > 0 ) {
				foreach ( $matches[0] as $key => $value ) {
					preg_match_all( '/tab_id="([^"]+)"/', $matches[0][ $key ], $matches_ids );
					foreach ( $matches_ids[1] as $matches_id ) {
						if ( $tab_id == $matches_id ) {
							$shortcode_section = $value;
						}
					}
				}
			}
		}
		
		return $shortcode_section;
	}
}
if ( ! function_exists( 'azirspares_blog_banner' ) ) {
	function azirspares_blog_banner() {
		$banner_blog = Azirspares_Functions::azirspares_get_option( 'blog_banner' );
		$banner_url  = Azirspares_Functions::azirspares_get_option( 'blog_banner_url', '#' );
		if ( $banner_blog ) {
			$banner_thumb = apply_filters( 'azirspares_resize_image', $banner_blog, false, false, true, true ); ?>
            <div class="blog-banner">
                <a href="<?php echo esc_url( $banner_url ) ?>"><?php echo wp_specialchars_decode( $banner_thumb['img'] ) ?></a>
            </div>
			<?php
		}
	}
}
if ( ! function_exists( 'azirspares_add_action_to_multi_currency_ajax' ) ) {
	function azirspares_add_action_to_multi_currency_ajax( $ajax_actions ) {
		$ajax_actions[] = 'azirspares_ajax_tabs'; // Add a AJAX action to the array
		
		return $ajax_actions;
	}
}
if ( ! function_exists( 'azirspares_ajax_tabs' ) ) {
	function azirspares_ajax_tabs() {
		$response   = array(
			'html'    => '',
			'message' => '',
			'success' => 'no',
		);
		$section_id = isset( $_POST['section_id'] ) ? $_POST['section_id'] : '';
		$id         = isset( $_POST['id'] ) ? $_POST['id'] : '';
		$shortcode  = azirspares_detected_shortcode( $id, $section_id, null );
		WPBMap::addAllMappedShortcodes();
		$response['html']    = wpb_js_remove_wpautop( $shortcode );
		$response['success'] = 'ok';
		wp_send_json( $response );
		die();
	}
}
if ( ! function_exists( 'azirspares_menu_detailing' ) ) {
	function azirspares_menu_detailing( $items, $args ) {
		if ( $args->theme_location == 'primary' ) {
			$azirspares_block_detailing = Azirspares_Functions::azirspares_get_option( 'azirspares_block_detailing', '' );
			$content                    = '';
			ob_start();
			$content .= $items;
			ob_start();
			if ( $azirspares_block_detailing != '' ) : ?>
                <li class="menu-item block-detailing">
                    <p><?php echo wp_specialchars_decode( $azirspares_block_detailing ); ?></p>
                </li>
			<?php endif;
			$content .= ob_get_clean();
			$items   = $content;
		}
		
		return $items;
	}
}
if ( ! function_exists( 'azirspares_header_language' ) ) {
	function azirspares_header_language() {
		$current_language = '';
		$list_language    = '';
		$languages        = apply_filters( 'wpml_active_languages', null, 'skip_missing=0' );
		if ( ! empty( $languages ) ) {
			foreach ( $languages as $l ) {
				if ( ! $l['active'] ) {
					$list_language .= '
						<li class="menu-item">
                            <a href="' . esc_url( $l['url'] ) . '">
                                <img src="' . esc_url( $l['country_flag_url'] ) . '" height="12"
                                     alt="' . esc_attr( $l['language_code'] ) . '" width="18"/>
								' . esc_html( $l['native_name'] ) . '
                            </a>
                        </li>';
				} else {
					$current_language = '
						<a href="' . esc_url( $l['url'] ) . '" data-azirspares="azirspares-dropdown">
                            <img src="' . esc_url( $l['country_flag_url'] ) . '" height="12"
                                 alt="' . esc_attr( $l['language_code'] ) . '" width="18"/>
							' . esc_html( $l['native_name'] ) . '
                        </a>
                        <span class="toggle-submenu"></span>';
				}
			}
			$menu_language = '
                 <li class="menu-item azirspares-dropdown block-language">
                    ' . $current_language . '
                    <ul class="sub-menu">
                        ' . $list_language . '
                    </ul>
                </li>';
			echo wp_specialchars_decode( $menu_language );
			
			$currency_switcher_dropdown_html = '';
			ob_start();
			do_action( 'wcml_currency_switcher', array( 'format' => '%code%', 'switcher_style' => 'wcml-dropdown' ) );
			$currency_switcher_dropdown_html .= ob_get_clean();
			
			if ( $currency_switcher_dropdown_html != '' ) {
				echo '<li class="menu-item">';
				echo apply_filters( 'famiau_wcml_currency_switcher', $currency_switcher_dropdown_html );
				echo '</li>';
			}
		}
	}
}

if ( ! function_exists( 'azirspares_top_right_menu' ) ) {
	function azirspares_top_right_menu( $items, $args ) {
		if ( $args->theme_location == 'top_right_menu' ) {
			$content = '';
			$content .= $items;
			ob_start();
			azirspares_header_language();
			$content .= ob_get_clean();
			$items   = $content;
		}
		
		return $items;
	}
}
if ( ! function_exists( 'azirspares_search_form' ) ) {
	function azirspares_search_form() {
		$key_words = Azirspares_Functions::azirspares_get_option( 'key_word' );
		$selected  = '';
		if ( isset( $_GET['product_cat'] ) && $_GET['product_cat'] ) {
			$selected = $_GET['product_cat'];
		}
		$args = array(
			'show_option_none'  => esc_html__( 'All Categories', 'azirspares' ),
			'taxonomy'          => 'product_cat',
			'class'             => 'category-search-option',
			'hide_empty'        => 1,
			'orderby'           => 'name',
			'order'             => 'ASC',
			'tab_index'         => true,
			'hierarchical'      => true,
			'id'                => rand(),
			'name'              => 'product_cat',
			'value_field'       => 'slug',
			'selected'          => $selected,
			'option_none_value' => '0',
		);
		?>
        <div class="block-search">
            <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ) ?>"
                  class="form-search block-search-form azirspares-live-search-form">
                <div class="form-content search-box results-search">
                    <div class="inner">
                        <input autocomplete="off" type="text" class="searchfield txt-livesearch input" name="s"
                               value="<?php echo esc_attr( get_search_query() ); ?>"
                               placeholder="<?php esc_attr_e( 'Search keyword, category, brand or part', 'azirspares' ); ?>">
                    </div>
                </div>
				<?php if ( class_exists( 'WooCommerce' ) ): ?>
                    <input type="hidden" name="post_type" value="product"/>
                    <input type="hidden" name="taxonomy" value="product_cat">
                    <div class="category">
						<?php wp_dropdown_categories( $args ); ?>
                    </div>
				<?php else: ?>
                    <input type="hidden" name="post_type" value="post"/>
				<?php endif; ?>
                <button type="submit" class="btn-submit">
                    <span class="flaticon-magnifying-glass-browser"></span>
                </button>
            </form><!-- block search -->
			<?php if ( ! empty( $key_words ) ): ?>
                <div class="key-word-search">
                    <span class="title-key"><?php echo esc_html__( 'Hot Keywords:', 'azirspares' ); ?></span>
                    <div class="listkey-word">
						<?php foreach ( $key_words as $key_word ): ?>
							<?php if ( ! empty( $key_word ) ): ?>
                                <a class="key-item" href="<?php echo esc_url( $key_word['key_word_link'] ); ?>">
									<?php echo esc_html( $key_word['key_word_item'] ); ?>
                                </a>
							<?php endif; ?>
						<?php endforeach; ?>
                    </div>
                </div>
			<?php endif; ?>
        </div>
		<?php
	}
}
if ( ! function_exists( 'azirspares_header_vertical' ) ) {
	function azirspares_header_vertical() {
		global $post;
		/* MAIN THEME OPTIONS */
		$azirspares_enable_vertical = Azirspares_Functions::azirspares_get_option( 'azirspares_enable_vertical_menu' );
		$azirspares_block_vertical  = Azirspares_Functions::azirspares_get_option( 'azirspares_block_vertical_menu' );
		$azirspares_item_visible    = Azirspares_Functions::azirspares_get_option( 'azirspares_vertical_item_visible', 10 );
		if ( $azirspares_enable_vertical == 1 ) :
			$locations = get_nav_menu_locations();
			$menu_id                = $locations['vertical_menu'];
			$menu_items             = wp_get_nav_menu_items( $menu_id );
			$count                  = 0;
			if ( $menu_items ) {
				foreach ( $menu_items as $menu_item ) {
					if ( $menu_item->menu_item_parent == 0 ) {
						$count ++;
					}
				}
			}
			
			/* MAIN THEME OPTIONS */
			$vertical_title         = Azirspares_Functions::azirspares_get_option( 'azirspares_vertical_menu_title', esc_html__( 'CATEGORIES', 'azirspares' ) );
			$vertical_button_all    = Azirspares_Functions::azirspares_get_option( 'azirspares_vertical_menu_button_all_text', esc_html__( 'All Categories', 'azirspares' ) );
			$vertical_button_close  = Azirspares_Functions::azirspares_get_option( 'azirspares_vertical_menu_button_close_text', esc_html__( 'Close', 'azirspares' ) );
			$azirspares_block_class = array( 'vertical-wrapper block-nav-category' );
			$id                     = '';
			$post_type              = '';
			if ( $azirspares_enable_vertical == 1 ) {
				$azirspares_block_class[] = 'has-vertical-menu';
			}
			if ( isset( $post->ID ) ) {
				$id = $post->ID;
			}
			if ( isset( $post->post_type ) ) {
				$post_type = $post->post_type;
			}
			if ( is_array( $azirspares_block_vertical ) && in_array( $id, $azirspares_block_vertical ) && $post_type == 'page' ) {
				$azirspares_block_class[] = 'always-open';
			}
			?>
            <!-- block category -->
            <div data-items="<?php echo esc_attr( $azirspares_item_visible ); ?>"
                 class="<?php echo implode( ' ', $azirspares_block_class ); ?>">
                <div class="block-title">
                    <span class="before">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                    <span class="text-title"><?php echo esc_html( $vertical_title ); ?></span>
                </div>
                <div class="block-content verticalmenu-content">
					<?php
					if ( has_nav_menu( 'vertical_menu' ) ) {
						wp_nav_menu( array(
							             'menu'            => 'vertical_menu',
							             'theme_location'  => 'vertical_menu',
							             'depth'           => 3,
							             'container'       => '',
							             'container_class' => '',
							             'container_id'    => '',
							             'menu_class'      => 'azirspares-nav vertical-menu default',
							             'fallback_cb'     => 'Azirspares_navwalker::fallback',
							             'walker'          => new Azirspares_navwalker(),
						             )
						);
					}
					if ( $count > $azirspares_item_visible ) : ?>
                        <div class="view-all-category">
                            <a href="#" data-closetext="<?php echo esc_attr( $vertical_button_close ); ?>"
                               data-alltext="<?php echo esc_attr( $vertical_button_all ) ?>"
                               class="btn-view-all open-cate"><?php echo esc_html( $vertical_button_all ) ?></a>
                        </div>
					<?php endif; ?>
                </div>
            </div><!-- block category -->
		<?php endif;
	}
}
if ( ! function_exists( 'azirspares_header_burger' ) ) {
	function azirspares_header_burger() {
		$azirspares_enable_burger = Azirspares_Functions::azirspares_get_option( 'azirspares_enable_burger_menu' );
		$azirspares_icon          = Azirspares_Functions::azirspares_get_option( 'header_icon' );
		$azirspares_phone         = Azirspares_Functions::azirspares_get_option( 'header_phone' );
		$azirspares_text          = Azirspares_Functions::azirspares_get_option( 'header_text' );
		$azirspares_burger_title  = Azirspares_Functions::azirspares_get_option( 'azirspares_burger_title' );
		$socials                  = Azirspares_Functions::azirspares_get_option( 'azirspares_header_social' );
		$socials_content          = Azirspares_Functions::azirspares_get_option( 'user_all_social' );
		if ( $azirspares_enable_burger == 1 ) :
			$azirspares_block_class = array( 'header-burger', 'azirspares-dropdown' ); ?>
            <div class="<?php echo implode( ' ', $azirspares_block_class ); ?>">
                <a class="burger-icon" href="#" data-azirspares="azirspares-dropdown">
                    <span></span>
                    <span></span>
                    <span></span>
                </a>
                <div class="burger-wrap">
                    <a class="burger-close" href="#" data-azirspares="azirspares-dropdown"></a>
                    <div class="burger-inner">
                        <div class="burger-top-menu">
							<?php if ( $azirspares_phone ) : ?>
                                <div class="burger-phone">
									<?php if ( $azirspares_icon ) : ?>
                                        <span class="phone-icon">
                                        <span class="<?php echo esc_attr( $azirspares_icon ); ?>"></span>
                                    </span>
									<?php endif; ?>
                                    <div class="phone-number">
                                        <p><?php echo esc_html( $azirspares_text ); ?></p>
                                        <p><?php echo esc_html( $azirspares_phone ); ?></p>
                                    </div>
                                </div>
							<?php endif; ?>
							<?php
							if ( has_nav_menu( 'burger_icon_menu' ) ) {
								wp_nav_menu( array(
									             'menu'            => 'burger_icon_menu',
									             'theme_location'  => 'burger_icon_menu',
									             'depth'           => 1,
									             'container'       => '',
									             'container_class' => '',
									             'container_id'    => '',
									             'menu_class'      => 'azirspares-nav burger-icon-menu',
									             'fallback_cb'     => 'Azirspares_navwalker::fallback',
									             'walker'          => new Azirspares_navwalker(),
								             )
								);
							} ?>
                        </div>
						<?php if ( has_nav_menu( 'burger_icon_menu' ) ): ?>
                            <div class="burger-mid-menu">
                                <h4 class="burger-title">
                                    <span>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </span>
									<?php echo esc_html( $azirspares_burger_title ); ?></h4>
								<?php wp_nav_menu( array(
									                   'menu'            => 'burger_list_menu',
									                   'theme_location'  => 'burger_list_menu',
									                   'depth'           => 3,
									                   'container'       => '',
									                   'container_class' => '',
									                   'container_id'    => '',
									                   'menu_class'      => 'azirspares-nav burger-list-menu vertical-menu',
									                   'fallback_cb'     => 'Azirspares_navwalker::fallback',
									                   'walker'          => new Azirspares_navwalker(),
								                   )
								);
								?>
                            </div>
						<?php endif; ?>
						<?php if ( ! empty( $socials ) ) : ?>
                            <div class="menu-social">
                                <h4><?php echo esc_html__( 'Follow us', 'azirspares' ) ?></h4>
								<?php foreach ( $socials as $social ) :
									if ( isset( $socials_content[ $social ] ) ):
										$content = $socials_content[ $social ]; ?>
                                        <a href="<?php echo esc_url( $content['link_social'] ); ?>">
                                            <span class="<?php echo esc_attr( $content['icon_social'] ); ?>"></span>
                                        </a>
										<?php
									endif;
								endforeach; ?>
                            </div>
						<?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="header-burger-overlay"></div>
		<?php endif;
	}
}
/**
 *
 * TEMPLATE HEADER
 */
if ( ! function_exists( 'azirspares_template_header' ) ) {
	function azirspares_template_header() {
		$data_meta      = get_post_meta( get_the_ID(), '_custom_metabox_theme_options', true );
		$header_options = Azirspares_Functions::azirspares_get_option( 'azirspares_used_header', 'style-01' );
		$header_options = isset( $data_meta['metabox_azirspares_used_header'] ) && $data_meta['metabox_azirspares_used_header'] != '' ? $data_meta['metabox_azirspares_used_header'] : $header_options;
		get_template_part( 'templates/header/header', $header_options );
	}
}
if ( ! function_exists( 'azirspares_template_header_listing' ) ) {
	function azirspares_template_header_listing() {
		$data_meta      = get_post_meta( get_the_ID(), '_custom_metabox_theme_options', true );
		$header_options = Azirspares_Functions::azirspares_get_option( 'azirspares_used_header_listing', 'style-07' );
		$header_options = isset( $data_meta['metabox_azirspares_used_header'] ) && $data_meta['metabox_azirspares_used_header'] != '' ? $data_meta['metabox_azirspares_used_header'] : $header_options;
		get_template_part( 'templates/header/header', $header_options );
	}
}
if ( ! function_exists( 'azirspares_header_background' ) ) {
	function azirspares_header_background() {
		$azirspares_header_background = Azirspares_Functions::azirspares_get_option( 'azirspares_header_background' );
		$azirspares_background_url    = Azirspares_Functions::azirspares_get_option( 'azirspares_background_url', '#' );
		$azirspares_background_text   = Azirspares_Functions::azirspares_get_option( 'azirspares_background_text', '' );
		if ( isset( $azirspares_header_background ) && $azirspares_header_background != '' ):
			?>
            <div id="banner-adv">
                <a class="banner-headertop" href="<?php echo esc_url( $azirspares_background_url ); ?>">
					<?php
					$image_gallery = apply_filters( 'azirspares_resize_image', $azirspares_header_background, false, false, true, true );
					echo wp_specialchars_decode( $image_gallery['img'] );
					?>
                    <span class="text"><?php echo wp_specialchars_decode( $azirspares_background_text ) ?></span>
                </a>
                <span class="close-banner"></span>
            </div>
			<?php
		endif;
	}
}
if ( ! function_exists( 'azirspares_header_language' ) ) {
	function azirspares_header_language() {
		$list_language = '';
		$menu_language = '';
		$languages     = apply_filters( 'wpml_active_languages', null, 'skip_missing=0' );
		if ( ! empty( $languages ) ) {
			foreach ( $languages as $l ) {
				if ( ! $l['active'] ) {
					$list_language .= '
						<li>
                            <a href="' . esc_url( $l['url'] ) . '">
                                <img src="' . esc_url( $l['country_flag_url'] ) . '" height="12"
                                     alt="' . esc_attr( $l['language_code'] ) . '" width="18"/>
								' . esc_html( $l['native_name'] ) . '
                            </a>
                        </li>';
				}
			}
			$menu_language = '<ul>' . $list_language . '</ul>';
		}
		echo wp_specialchars_decode( $menu_language );
	}
}
if ( ! function_exists( 'azirspares_user_link' ) ) {
	function azirspares_user_link() {
		$myaccount_link = wp_login_url();
		if ( class_exists( 'WooCommerce' ) ) {
			$myaccount_link = get_permalink( get_option( 'woocommerce_myaccount_page_id' ) );
		}
		?>
        <div class="menu-item block-user block-woo azirspares-dropdown">
			<?php if ( is_user_logged_in() ): ?>
                <a data-azirspares="azirspares-dropdown" class="block-link"
                   href="<?php echo esc_url( $myaccount_link ); ?>">
                    <span class="flaticon-user"></span>
                </a>
				<?php if ( function_exists( 'wc_get_account_menu_items' ) ): ?>
                    <ul class="sub-menu">
						<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
                            <li class="menu-item <?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
                                <a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
                            </li>
						<?php endforeach; ?>
                    </ul>
				<?php else: ?>
                    <ul class="sub-menu">
                        <li class="menu-item">
                            <a href="<?php echo wp_logout_url( get_permalink() ); ?>"><?php esc_html_e( 'Logout', 'azirspares' ); ?></a>
                        </li>
                    </ul>
				<?php endif;
			else: ?>
                <a class="block-link" href="<?php echo esc_url( $myaccount_link ); ?>">
                    <span class="flaticon-user"></span>
                </a>
			<?php endif; ?>
        </div>
		<?php
	}
}
if ( ! function_exists( 'azirspares_header_sticky' ) ) {
	function azirspares_header_sticky() {
		$enable_sticky_menu = Azirspares_Functions::azirspares_get_option( 'azirspares_sticky_menu' );
		if ( $enable_sticky_menu == 1 ): ?>
            <div class="header-sticky">
                <div class="container">
                    <div class="header-nav-inner">
						<?php azirspares_header_vertical(); ?>
                        <div class="box-header-nav main-menu-wapper">
							<?php
							wp_nav_menu( array(
								             'menu'            => 'primary',
								             'theme_location'  => 'Primary Menu',
								             'depth'           => 3,
								             'container'       => '',
								             'container_class' => '',
								             'container_id'    => '',
								             'menu_class'      => 'clone-main-menu azirspares-clone-mobile-menu azirspares-nav main-menu',
								             'fallback_cb'     => 'Azirspares_navwalker::fallback',
								             'walker'          => new Azirspares_navwalker(),
							             )
							);
							?>
                        </div>
                    </div>
                </div>
            </div>
		<?php endif;
	}
}
/**
 *
 * TEMPLATE LOAD MORE
 */
if ( ! function_exists( 'azirspares_ajax_loadmore' ) ) {
	function azirspares_ajax_loadmore() {
		$response             = array(
			'html'     => '',
			'loop_id'  => array(),
			'out_post' => 'no',
			'message'  => '',
			'success'  => 'no',
		);
		$out_post             = 'no';
		$args                 = isset( $_POST['loop_query'] ) ? $_POST['loop_query'] : array();
		$class                = isset( $_POST['loop_class'] ) ? $_POST['loop_class'] : array();
		$loop_id              = isset( $_POST['loop_id'] ) ? $_POST['loop_id'] : array();
		$loop_style           = isset( $_POST['loop_style'] ) ? $_POST['loop_style'] : '';
		$loop_thumb           = isset( $_POST['loop_thumb'] ) ? explode( 'x', $_POST['loop_thumb'] ) : '';
		$args['post__not_in'] = $loop_id;
		
		$product_size_args = array(
			'width'  => $loop_thumb[0],
			'height' => $loop_thumb[1]
		);
		
		$loop_posts = new WP_Query( $args );
		ob_start();
		if ( $loop_posts->have_posts() ) {
			while ( $loop_posts->have_posts() ) : $loop_posts->the_post(); ?>
				<?php $loop_id[] = get_the_ID(); ?>
                <div <?php post_class( $class ); ?>>
					<?php wc_get_template( 'product-styles/content-product-style-' . $loop_style . '.php', $product_size_args ); ?>
                </div>
				<?php
			endwhile;
		} else {
			$out_post = 'yes';
		}
		$response['html']     = ob_get_clean();
		$response['loop_id']  = $loop_id;
		$response['out_post'] = $out_post;
		$response['success']  = 'yes';
		wp_send_json( $response );
		die();
	}
}

//Check mobile
if ( ! function_exists( 'azirspares_is_mobile' ) ) {
	function azirspares_is_mobile() {
		$is_mobile = false;
		if ( function_exists( 'azirspares_toolkit_is_mobile' ) ) {
			$is_mobile = azirspares_toolkit_is_mobile();
		}
		
		$force_mobile = isset( $_REQUEST['force_mobile'] ) ? $_REQUEST['force_mobile'] == 'yes' || $_REQUEST['force_mobile'] == 'true' : false;
		if ( $force_mobile ) {
			$is_mobile = true;
		}
		
		$is_mobile = apply_filters( 'azirspares_is_mobile', $is_mobile );
		
		return $is_mobile;
	}
}
