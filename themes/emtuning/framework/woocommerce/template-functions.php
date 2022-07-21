<?php
/**
 * WooCommerce Template
 *
 * Functions for the templating system.
 *
 * @author   Fami Themes
 * @category Core
 * @package  Azirspares_Woo_Functions
 * @version  1.0.0
 */
?>
<?php if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
if ( ! function_exists( 'azirspares_action_wp_loaded' ) ) {
	function azirspares_action_wp_loaded() {
		/* QUICK VIEW */
		if ( class_exists( 'YITH_WCQV_Frontend' ) ) {
			// Class frontend
			$enable           = get_option( 'yith-wcqv-enable' ) == 'yes' ? true : false;
			$enable_on_mobile = get_option( 'yith-wcqv-enable-mobile' ) == 'yes' ? true : false;
			// Class frontend
			if ( ( ! wp_is_mobile() && $enable ) || ( wp_is_mobile() && $enable_on_mobile && $enable ) ) {
				remove_action( 'woocommerce_after_shop_loop_item', array(
					YITH_WCQV_Frontend::get_instance(),
					'yith_add_quick_view_button'
				), 15 );
				add_action( 'azirspares_function_shop_loop_item_quickview', array(
					YITH_WCQV_Frontend::get_instance(),
					'yith_add_quick_view_button'
				), 5 );
			}
		}
		/* WISH LIST */
		if ( defined( 'YITH_WCWL' ) ) {
			add_action( 'azirspares_function_shop_loop_item_wishlist', function() {
				echo do_shortcode( "[yith_wcwl_add_to_wishlist]" );
			}, 1 );
		}
		/* COMPARE */
		if ( class_exists( 'YITH_Woocompare' ) && get_option( 'yith_woocompare_compare_button_in_products_list' ) == 'yes' ) {
			global $yith_woocompare;
			$is_ajax = ( defined( 'DOING_AJAX' ) && DOING_AJAX );
			if ( $yith_woocompare->is_frontend() || $is_ajax ) {
				if ( $is_ajax ) {
					if ( ! class_exists( 'YITH_Woocompare_Frontend' ) && file_exists( YITH_WOOCOMPARE_DIR . 'includes/class.yith-woocompare-frontend.php' ) ) {
						require_once YITH_WOOCOMPARE_DIR . 'includes/class.yith-woocompare-frontend.php';
					}
					$yith_woocompare->obj = new YITH_Woocompare_Frontend();
				}
				/* Remove button */
				remove_action( 'woocommerce_after_shop_loop_item', array(
					$yith_woocompare->obj,
					'add_compare_link'
				), 20 );
				/* Add compare button */
				if ( ! function_exists( 'azirspares_wc_loop_product_compare_btn' ) ) {
					function azirspares_wc_loop_product_compare_btn() {
						if ( shortcode_exists( 'yith_compare_button' ) ) {
							echo do_shortcode( '[yith_compare_button product_id="' . get_the_ID() . '"]' );
						} else {
							if ( class_exists( 'YITH_Woocompare_Frontend' ) ) {
								echo do_shortcode( '[yith_compare_button product_id="' . get_the_ID() . '"]' );
							}
						}
					}
				}
				add_action( 'azirspares_function_shop_loop_item_compare', 'azirspares_wc_loop_product_compare_btn', 1 );
			}
		}
	}
}
/* SINGLE PRODUCT */
if ( ! function_exists( 'azirspares_before_main_content_left' ) ) {
	function azirspares_before_main_content_left() {
		global $product;
		$class          = 'no-gallery';
		$attachment_ids = $product->get_gallery_image_ids();
		if ( $attachment_ids && has_post_thumbnail() ) {
			$class = 'has-gallery';
		}
		echo '<div class="main-contain-summary"><div class="contain-left ' . esc_attr( $class ) . '"><div class="single-left">';
	}
}
if ( ! function_exists( 'azirspares_after_main_content_left' ) ) {
	function azirspares_after_main_content_left() {
		echo '</div>';
	}
}
if ( ! function_exists( 'azirspares_woocommerce_after_single_product_summary_1' ) ) {
	function azirspares_woocommerce_after_single_product_summary_1() {
		echo '</div>';
	}
}
if ( ! function_exists( 'azirspares_woocommerce_before_single_product_summary_2' ) ) {
	function azirspares_woocommerce_before_single_product_summary_2() {
		echo '</div>';
	}
}
if ( ! function_exists( 'azirspares_woocommerce_before_shop_loop' ) ) {
	function azirspares_woocommerce_before_shop_loop() {
		echo '<div class="row auto-clear equal-container better-height azirspares-products">';
	}
}
if ( ! function_exists( 'azirspares_woocommerce_after_shop_loop' ) ) {
	function azirspares_woocommerce_after_shop_loop() {
		echo '</div>';
	}
}
/* GALLERY PRODUCT */
if ( ! function_exists( 'azirspares_gallery_product_thumbnail' ) ) {
	function azirspares_gallery_product_thumbnail( $args = array() ) {
		global $post, $product;
		// GET SIZE IMAGE SETTING
		$crop      = true;
		$size      = wc_get_image_size( 'shop_catalog' );
		$wc_width  = 320;
		$wc_height = 320;
		if ( $size ) {
			$wc_width  = $size['width'];
			$wc_height = $size['height'];
			if ( ! $size['crop'] ) {
				$crop = false;
			}
		}
		
		$width  = isset( $args['width'] ) ? intval( $args['width'] ) : $wc_width;
		$height = isset( $args['height'] ) ? intval( $args['height'] ) : $wc_height;
		
		$html           = '';
		$html_thumb     = '';
		$attachment_ids = $product->get_gallery_image_ids();
		$width          = apply_filters( 'azirspares_shop_pruduct_thumb_width', $width );
		$height         = apply_filters( 'azirspares_shop_pruduct_thumb_height', $height );
		/* primary image */
		$image_thumb       = apply_filters( 'azirspares_resize_image', get_post_thumbnail_id( $product->get_id() ), $width, $height, $crop, true );
		$thumbnail_primary = apply_filters( 'azirspares_resize_image', get_post_thumbnail_id( $product->get_id() ), 136, 130, $crop, true );
		$html              .= '<figure class="product-gallery-image">';
		$html              .= $image_thumb['img'];
		$html              .= '</figure>';
		$html_thumb        .= '<figure>' . $thumbnail_primary['img'] . '</figure>';
		/* thumbnail image */
		if ( $attachment_ids && has_post_thumbnail() ) {
			foreach ( $attachment_ids as $attachment_id ) {
				$gallery_thumb   = apply_filters( 'azirspares_resize_image', $attachment_id, $width, $height, $crop, true );
				$thumbnail_image = apply_filters( 'azirspares_resize_image', $attachment_id, 136, 130, $crop, true );
				$html            .= '<figure class="product-gallery-image">';
				$html            .= $gallery_thumb['img'];
				$html            .= '</figure>';
				$html_thumb      .= '<figure>' . $thumbnail_image['img'] . '</figure>';
			}
		}
		?>
        <div class="product-gallery">
            <div class="product-gallery-slick">
				<?php echo wp_specialchars_decode( $html ); ?>
            </div>
            <div class="gallery-dots">
				<?php echo wp_specialchars_decode( $html_thumb ); ?>
            </div>
        </div>
		<?php
	}
}
/* ADD CATEGORIES LIST IN PRODUCT */
if ( ! function_exists( 'azirspares_add_categories_product' ) ) {
	function azirspares_add_categories_product() {
		$html = '';
		$html .= '<div class="cat-list">';
		$html .= wc_get_product_category_list( get_the_ID() );
		$html .= '</div>';
		echo wp_specialchars_decode( $html );
	}
}
if ( ! function_exists( 'azirspares_custom_track_product_view' ) ) {
	/**
	 * Not used. Will be removed
	 */
	function azirspares_custom_track_product_view() {
		$azirspares_woo_recently_reviewed_enable = Azirspares_Functions::azirspares_get_option( 'azirspares_woo_recently_reviewed_enable', 'disable' );
		if ( $azirspares_woo_recently_reviewed_enable == 'enable' ) : ?>
			<?php if ( ! is_singular( 'product' ) || ! is_active_widget( false, false, 'woocommerce_recently_viewed_products', true ) ) {
				return;
			}
			global $post;
			if ( ! isset( $_COOKIE['woocommerce_recently_viewed'] ) ) {
				$_COOKIE['woocommerce_recently_viewed'] = '';
			}
			if ( empty( $_COOKIE['woocommerce_recently_viewed'] ) ) {
				$viewed_products = array();
			} else {
				$viewed_products = wp_parse_id_list( (array) explode( '|', wp_unslash( $_COOKIE['woocommerce_recently_viewed'] ) ) ); // @codingStandardsIgnoreLine.
				// $viewed_products = (array) explode( '|', $_COOKIE['woocommerce_recently_viewed'] );
			}
			if ( ! in_array( $post->ID, $viewed_products ) ) {
				$viewed_products[] = $post->ID;
			}
			if ( sizeof( $viewed_products ) > 15 ) {
				array_shift( $viewed_products );
			}
			// Store for session only
			wc_setcookie( 'woocommerce_recently_viewed', implode( '|', $viewed_products ) );
			?>
		<?php endif;
	}
}
if ( ! function_exists( 'azirspares_recently_viewed_product' ) ) {
	function azirspares_recently_viewed_product() {
		if ( is_product() ) {
			$azirspares_woo_recently_reviewed_enable = Azirspares_Functions::azirspares_get_option( 'azirspares_woo_recently_reviewed_enable', 'disable' );
			if ( $azirspares_woo_recently_reviewed_enable == 'disable' ) {
				return;
			}
			$title        = Azirspares_Functions::azirspares_get_option( 'azirspares_woo_recently_reviewed_products_title', 'Recently viewed' );
			$woo_ls_items = Azirspares_Functions::azirspares_get_option( 'azirspares_woo_recently_reviewed_ls_items', 6 );
			$woo_lg_items = Azirspares_Functions::azirspares_get_option( 'azirspares_woo_recently_reviewed_lg_items', 5 );
			$woo_md_items = Azirspares_Functions::azirspares_get_option( 'azirspares_woo_recently_reviewed_md_items', 4 );
			$woo_sm_items = Azirspares_Functions::azirspares_get_option( 'azirspares_woo_recently_reviewed_sm_items', 3 );
			$woo_xs_items = Azirspares_Functions::azirspares_get_option( 'azirspares_woo_recently_reviewed_xs_items', 2 );
			$woo_ts_items = Azirspares_Functions::azirspares_get_option( 'azirspares_woo_recently_reviewed_ts_items', 2 );
			$atts         = array(
				'owl_navigation'        => 'false',
				'owl_dots'              => 'false',
				'owl_loop'              => 'false',
				'owl_slide_margin'      => '40',
				'owl_ts_items'          => $woo_ts_items,
				'owl_xs_items'          => $woo_xs_items,
				'owl_sm_items'          => $woo_sm_items,
				'owl_md_items'          => $woo_md_items,
				'owl_lg_items'          => $woo_lg_items,
				'owl_ls_items'          => $woo_ls_items,
				'owl_responsive_margin' => 992,
			);
			$owl_settings = apply_filters( 'azirspares_carousel_data_attributes', 'owl_', $atts );
			
			global $woocommerce;
			// Get recently viewed product cookies data
			$viewed_products = ! empty( $_COOKIE['woocommerce_recently_viewed'] ) ? (array) explode( '|', $_COOKIE['woocommerce_recently_viewed'] ) : array();
			$viewed_products = array_filter( array_map( 'absint', $viewed_products ) );
			// Create query arguments array
			$query_args = array(
				'posts_per_page' => 10,
				'no_found_rows'  => 1,
				'post_status'    => 'publish',
				'post_type'      => 'product',
				'post__in'       => $viewed_products,
				'order'          => 'ASC'
			);
			// Add meta_query to query args
			$query_args['meta_query'] = array();
			// Check products stock status
			$query_args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
			// Create a new query
			$r = new WP_Query( $query_args );
			// ----
			if ( empty( $r ) ) {
				return;
			} ?>
            <div class="col-sm-12 col-xs-12 recently-reviewed-product">
                <div class="block-title">
                    <h2 class="product-grid-title">
                        <span><?php echo esc_html( $title ); ?></span>
                    </h2>
                </div>
                <div class="owl-slick owl-products equal-container better-height" <?php echo esc_attr( $owl_settings ); ?>>
					<?php while ( $r->have_posts() ) : $r->the_post(); ?>
                        <div <?php post_class() ?>>
                            <a class="product-thumb" href="<?php echo get_post_permalink(); ?>">
								<?php $thumb = apply_filters( 'azirspares_resize_image', get_post_thumbnail_id(), 198, 198, true, true );
								echo wp_specialchars_decode( $thumb['img'] ); ?>
                            </a>
                        </div>
					<?php endwhile; ?>
                </div>
            </div>
			<?php wp_reset_postdata();
		}
	}
}
if ( ! function_exists( 'azirspares_wc_get_template_part' ) ) {
	/**
	 * @param $template
	 * @param $slug
	 * @param $name
	 *
	 * @return mixed|void
	 */
	function azirspares_wc_get_template_part( $template, $slug, $name ) {
		if ( $slug == 'content' && $name == 'product' ) {
			$template = apply_filters( 'azirspares_woocommerce_content_product', plugin_dir_path( __FILE__ ) . 'content-product.php' );
		}
		
		return $template;
	}
}
if ( ! function_exists( 'azirspares_woocommerce_breadcrumb' ) ) {
	function azirspares_woocommerce_breadcrumb() {
		$args = array(
			'delimiter' => '<i class="fa fa-angle-right"></i>',
		);
		woocommerce_breadcrumb( $args );
	}
}
if ( ! function_exists( 'azirspares_woocommerce_before_loop_content' ) ) {
	function azirspares_woocommerce_before_loop_content() {
		$is_dokan_store = false;
		if ( function_exists( 'dokan_is_store_page' ) ) {
			$is_dokan_store = dokan_is_store_page();
		}
		$sidebar_isset = wp_get_sidebars_widgets();
		/*Shop layout*/
		$shop_layout  = Azirspares_Functions::azirspares_get_option( 'azirspares_sidebar_shop_layout', 'left' );
		$shop_sidebar = Azirspares_Functions::azirspares_get_option( 'azirspares_shop_used_sidebar', 'widget-shop' );
		if ( is_product() ) {
			$shop_layout  = Azirspares_Functions::azirspares_get_option( 'azirspares_sidebar_product_layout', 'left' );
			$shop_sidebar = Azirspares_Functions::azirspares_get_option( 'azirspares_single_product_used_sidebar', 'widget-product' );
		}
		if ( isset( $sidebar_isset[ $shop_sidebar ] ) && empty( $sidebar_isset[ $shop_sidebar ] ) ) {
			$shop_layout = 'full';
		}
		$main_content_class   = array();
		$main_content_class[] = 'main-content';
		if ( $is_dokan_store ) {
			$main_content_class[] = ' azirspares-dokan-store';
			$shop_layout          = 'full';
		}
		if ( $shop_layout == 'full' ) {
			$main_content_class[] = 'col-sm-12';
		} else {
			$main_content_class[] = 'col-lg-9 col-md-8 col-sm-8 col-xs-12 has-sidebar';
		}
		$main_content_class = apply_filters( 'azirspares_class_archive_content', $main_content_class, $shop_layout );
		echo '<div class="' . esc_attr( implode( ' ', $main_content_class ) ) . '">';
	}
}
if ( ! function_exists( 'azirspares_woocommerce_after_loop_content' ) ) {
	function azirspares_woocommerce_after_loop_content() {
		$is_dokan_store = false;
		if ( function_exists( 'dokan_is_store_page' ) ) {
			$is_dokan_store = dokan_is_store_page();
		}
		if ( $is_dokan_store ) {
			echo '</div></div></div>';
		}
		echo '</div>';
	}
}
if ( ! function_exists( 'azirspares_woocommerce_before_main_content' ) ) {
	function azirspares_woocommerce_before_main_content() {
		/*Main container class*/
		$main_container_class = array();
		$sidebar_isset        = wp_get_sidebars_widgets();
		$enable_shop_mobile   = Azirspares_Functions::azirspares_get_option( 'enable_shop_mobile' );
		$shop_layout          = Azirspares_Functions::azirspares_get_option( 'azirspares_sidebar_shop_layout', 'left' );
		$shop_sidebar         = Azirspares_Functions::azirspares_get_option( 'azirspares_shop_used_sidebar', 'widget-shop' );
		$shop_style           = Azirspares_Functions::azirspares_get_option( 'azirspares_shop_list_style', 'list' );
		$product_style        = Azirspares_Functions::azirspares_get_option( 'azirspares_shop_product_style', 'style-02' );
		if ( is_product() ) {
			$shop_layout            = Azirspares_Functions::azirspares_get_option( 'azirspares_sidebar_product_layout', 'left' );
			$shop_sidebar           = Azirspares_Functions::azirspares_get_option( 'azirspares_single_product_used_sidebar', 'widget-product' );
			$single_extended        = Azirspares_Functions::azirspares_get_option( 'azirspares_single_product_extended', 'type-1' );
			$thumbnail_layout       = 'vertical';
			$main_container_class[] = 'single-thumb-' . $thumbnail_layout;
			$main_container_class[] .= $single_extended;
		}
		if ( ( $enable_shop_mobile == 1 ) && ( azirspares_is_mobile() ) ) {
			$main_container_class[] = 'shop-mobile-real';
		}
		if ( ! is_product() && ( $shop_style == 'list' || $product_style == 'style-02' || $product_style == 'style-04' || $product_style == 'style-05' ) ) {
			$main_container_class[] = 'shop-bg';
		}
		if ( isset( $sidebar_isset[ $shop_sidebar ] ) && empty( $sidebar_isset[ $shop_sidebar ] ) ) {
			$shop_layout = 'full';
		}
		$main_container_class[] = 'main-container shop-page';
		if ( $shop_layout == 'full' ) {
			$main_container_class[] = 'no-sidebar';
		} else {
			$main_container_class[] = $shop_layout . '-sidebar';
		}
		$main_container_class = apply_filters( 'azirspares_class_before_main_content_product', $main_container_class, $shop_layout );
		echo '<div class="' . esc_attr( implode( ' ', $main_container_class ) ) . '">';
		echo '<div class="container">';
		echo '<div class="row">';
	}
}
if ( ! function_exists( 'azirspares_woocommerce_after_main_content' ) ) {
	function azirspares_woocommerce_after_main_content() {
		echo '</div></div></div>';
	}
}
if ( ! function_exists( 'azirspares_woocommerce_sidebar' ) ) {
	function azirspares_woocommerce_sidebar() {
		$shop_layout  = Azirspares_Functions::azirspares_get_option( 'azirspares_sidebar_shop_layout', 'left' );
		$shop_sidebar = Azirspares_Functions::azirspares_get_option( 'azirspares_shop_used_sidebar', 'widget-shop' );
		if ( is_product() ) {
			$shop_layout  = Azirspares_Functions::azirspares_get_option( 'azirspares_sidebar_product_layout', 'left' );
			$shop_sidebar = Azirspares_Functions::azirspares_get_option( 'azirspares_single_product_used_sidebar', 'widget-product' );
		}
		$sidebar_class = array();
		$sidebar_isset = wp_get_sidebars_widgets();
		if ( isset( $sidebar_isset[ $shop_sidebar ] ) && empty( $sidebar_isset[ $shop_sidebar ] ) ) {
			$shop_layout = 'full';
		}
		$sidebar_class[] = 'sidebar';
		if ( $shop_layout != 'full' ) {
			$sidebar_class[] = 'col-lg-3 col-md-4 col-sm-4 col-xs-12';
		}
		$sidebar_class = apply_filters( 'azirspares_class_sidebar_content_product', $sidebar_class, $shop_layout, $shop_sidebar );
		if ( $shop_layout != "full" ): ?>
            <div class="<?php echo esc_attr( implode( ' ', $sidebar_class ) ); ?>">
				<?php if ( is_active_sidebar( $shop_sidebar ) ) : ?>
                    <div id="widget-area" class="widget-area shop-sidebar">
						<?php dynamic_sidebar( $shop_sidebar ); ?>
                    </div><!-- .widget-area -->
				<?php endif; ?>
            </div>
		<?php endif;
	}
}
if ( ! function_exists( 'azirspares_single_product_policy' ) ) {
	function azirspares_single_product_policy() {
		$azirspares_single_product_policy = Azirspares_Functions::azirspares_get_option( 'azirspares_single_product_policy' );
		$enable_single_product_policy     = Azirspares_Functions::azirspares_get_option( 'enable_single_product_policy' );
		$single_policy                    = 'hide-on-mobile';
		if ( $enable_single_product_policy ) {
			$single_policy = '';
		}
		if ( is_product() && $azirspares_single_product_policy ) {
			$post_id = get_post( $azirspares_single_product_policy );
			$content = $post_id->post_content;
			$content = apply_filters( 'the_content', $content );
			$content = str_replace( ']]>', ']]>', $content );
			echo '<div class="single-product-policy ' . esc_attr( $single_policy ) . '">';
			echo wp_specialchars_decode( $content );
			echo '</div>';
		}
	}
}
if ( ! function_exists( 'azirspares_product_get_rating_html' ) ) {
	function azirspares_product_get_rating_html( $html, $rating, $count ) {
		global $product;
		$rating_count = $product->get_rating_count();
		$class_star   = 'rating-wapper ';
		if ( 0 >= $rating ) {
			$class_star .= 'nostar';
		}
		$html = '<div class="' . esc_attr( $class_star ) . '"><div class="star-rating">';
		$html .= wc_get_star_rating_html( $rating, $count );
		$html .= '</div>';
		if ( $rating_count == 1 ) {
			$html .= '<span class="review">( ' . $rating_count . ' ' . esc_html__( 'review', 'azirspares' ) . ' )</span>';
		} else {
			$html .= '<span class="review">( ' . $rating_count . ' ' . esc_html__( 'reviews', 'azirspares' ) . ' )</span>';
		}
		$html .= '</div>';
		
		return $html;
	}
}
if ( ! function_exists( 'azirspares_before_shop_control' ) ) {
	function azirspares_before_shop_control() {
		?>
        <div class="shop-control shop-before-control">
			<?php do_action( 'azirspares_control_before_content' ); ?>
        </div>
		<?php
	}
}
if ( ! function_exists( 'azirspares_after_shop_control' ) ) {
	function azirspares_after_shop_control() {
		?>
        <div class="shop-control shop-after-control">
			<?php do_action( 'azirspares_control_after_content' ); ?>
        </div>
		<?php
	}
}
if ( ! function_exists( 'product_display_mode_request' ) ) {
	function product_display_mode_request() {
		if ( isset( $_POST['display_mode_action'] ) ) {
			wp_redirect(
				add_query_arg(
					array(
						'azirspares_shop_list_style' => $_POST['display_mode_value'],
					), $_POST['display_mode_action']
				)
			);
			exit();
		}
	}
}
if ( ! function_exists( 'azirspares_shop_display_mode_tmp' ) ) {
	function azirspares_shop_display_mode_tmp() {
		$shop_display_mode = Azirspares_Functions::azirspares_get_option( 'azirspares_shop_list_style', 'grid' );
		$current_url       = home_url( add_query_arg( null, null ) );
		?>
        <div class="grid-view-mode">
            <form method="POST" action="#">
                <button type="submit"
                        data-toggle="tooltip"
                        data-placement="top"
                        title=""
                        class="modes-mode mode-grid display-mode <?php if ( $shop_display_mode == 'grid' ): ?>active<?php endif; ?>"
                        value="<?php echo esc_attr( $current_url ); ?>"
                        name="display_mode_action">
                        <span class="button-inner">
                            <?php echo esc_html__( 'Shop Grid', 'azirspares' ); ?>
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                </button>
                <input type="hidden" value="grid" name="display_mode_value">
            </form>
            <form method="POST" action="<?php echo esc_attr( $current_url ); ?>">
                <button type="submit"
                        data-toggle="tooltip"
                        data-placement="top"
                        title=""
                        class="modes-mode mode-list display-mode <?php if ( $shop_display_mode == 'list' ): ?>active<?php endif; ?>"
                        value="<?php echo esc_attr( $current_url ); ?>"
                        name="display_mode_action">
                        <span class="button-inner">
                            <?php echo esc_html__( 'Shop List', 'azirspares' ); ?>
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                </button>
                <input type="hidden" value="list" name="display_mode_value">
            </form>
        </div>
		<?php
	}
}
if ( ! function_exists( 'azirspares_loop_shop_per_page' ) ) {
	function azirspares_loop_shop_per_page() {
		$azirspares_woo_products_perpage = Azirspares_Functions::azirspares_get_option( 'azirspares_product_per_page', '12' );
		
		return $azirspares_woo_products_perpage;
	}
}
if ( ! function_exists( 'azirspares_woof_products_query' ) ) {
	function azirspares_woof_products_query( $wr ) {
		$azirspares_woo_products_perpage = Azirspares_Functions::azirspares_get_option( 'azirspares_product_per_page', '12' );
		$wr['posts_per_page']            = $azirspares_woo_products_perpage;
		
		return $wr;
	}
}
if ( ! function_exists( 'product_per_page_request' ) ) {
	function product_per_page_request() {
		if ( isset( $_POST['perpage_action_form'] ) ) {
			wp_redirect(
				add_query_arg(
					array(
						'azirspares_product_per_page' => $_POST['product_per_page_filter'],
					), $_POST['perpage_action_form']
				)
			);
			exit();
		}
	}
}
if ( ! function_exists( 'azirspares_product_per_page_tmp' ) ) {
	function azirspares_product_per_page_tmp() {
		$perpage        = Azirspares_Functions::azirspares_get_option( 'azirspares_product_per_page', '12' );
		$current_url    = home_url( add_query_arg( null, null ) );
		$total_products = wc_get_loop_prop( 'total' );
		?>
        <form class="per-page-form" method="POST" action="#">
            <label>
                <select name="product_per_page_filter" class="option-perpage" onchange="this.form.submit();">
                    <option value="<?php echo esc_attr( $perpage ); ?>" <?php echo esc_attr( 'selected' ); ?>>
						<?php echo esc_html__( 'Show ', 'azirspares' ) . zeroise( $perpage, 2 ); ?>
                    </option>
                    <option value="5">
						<?php echo esc_html__( 'Show ', 'azirspares' ) . esc_html__( '05', 'azirspares' ); ?>
                    </option>
                    <option value="10">
						<?php echo esc_html__( 'Show ', 'azirspares' ) . esc_html__( '10', 'azirspares' ); ?>
                    </option>
                    <option value="12">
						<?php echo esc_html__( 'Show ', 'azirspares' ) . esc_html__( '12', 'azirspares' ); ?>
                    </option>
                    <option value="15">
						<?php echo esc_html__( 'Show ', 'azirspares' ) . esc_html__( '15', 'azirspares' ); ?>
                    </option>
                    <option value="<?php echo esc_attr( $total_products ); ?>">
						<?php echo esc_html__( 'Show All', 'azirspares' ); ?>
                    </option>
                </select>
            </label>
            <label>
                <input type="hidden" name="perpage_action_form" value="<?php echo esc_attr( $current_url ); ?>">
            </label>
        </form>
		<?php
	}
}
if ( ! function_exists( 'azirspares_custom_pagination' ) ) {
	function azirspares_custom_pagination() {
		global $wp_query;
		if ( $wp_query->max_num_pages > 1 ) {
			?>
            <nav class="woocommerce-pagination">
				<?php
				echo paginate_links( apply_filters( 'woocommerce_pagination_args', array(
					'base'      => esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) ),
					'format'    => '',
					'add_args'  => false,
					'current'   => max( 1, get_query_var( 'paged' ) ),
					'total'     => $wp_query->max_num_pages,
					'prev_text' => esc_html__( 'Previous', 'azirspares' ),
					'next_text' => esc_html__( 'Next', 'azirspares' ),
					'type'      => 'plain',
					'end_size'  => 3,
					'mid_size'  => 3,
				) ) );
				?>
            </nav>
			<?php
		}
	}
}
if ( ! function_exists( 'azirspares_related_title_product' ) ) {
	add_action( 'azirspares_before_related_single_product', 'azirspares_related_title_product' );
	function azirspares_related_title_product( $prefix ) {
		if ( $prefix == 'azirspares_woo_crosssell' ) {
			$default_text = esc_html__( 'Cross Sell Products', 'azirspares' );
		} elseif ( $prefix == 'azirspares_woo_related' ) {
			$default_text = esc_html__( 'Related Products', 'azirspares' );
		} else {
			$default_text = esc_html__( 'Upsell Products', 'azirspares' );
		}
		$title = Azirspares_Functions::azirspares_get_option( $prefix . '_products_title', $default_text );
		?>
        <div class="block-title">
            <h2 class="product-grid-title">
                <span><?php echo esc_html( $title ); ?></span>
            </h2>
        </div>
		<?php
	}
}
if ( ! function_exists( 'azirspares_woocommerce_shop_banner' ) ) {
	function azirspares_woocommerce_shop_banner() {
		if ( is_shop() ) {
			$banner_shop = Azirspares_Functions::azirspares_get_option( 'azirspares_shop_banner' );
			$banner_url  = Azirspares_Functions::azirspares_get_option( 'azirspares_shop_banner_url', '#' );
			if ( $banner_shop ) {
				$banner_thumb = apply_filters( 'azirspares_resize_image', $banner_shop, false, false, true, true ); ?>
                <div class="shop-banner-woo">
                    <a href="<?php echo esc_url( $banner_url ) ?>"><?php echo wp_specialchars_decode( $banner_thumb['img'] ) ?></a>
                </div>
				<?php
			}
		}
	}
}
if ( ! function_exists( 'azirspares_woocommerce_category_description' ) ) {
	function azirspares_woocommerce_category_description() {
		$enable_cat = Azirspares_Functions::azirspares_get_option( 'azirspares_woo_cat_enable' );
		$banner_cat = Azirspares_Functions::azirspares_get_option( 'category_banner' );
		$banner_url = Azirspares_Functions::azirspares_get_option( 'category_banner_url', '#' );
		if ( is_product_category() && $enable_cat == 1 ) {
			$category_html = '';
			$prefix        = 'azirspares_woo_cat';
			$woo_ls_items  = Azirspares_Functions::azirspares_get_option( $prefix . '_ls_items', 4 );
			$woo_lg_items  = Azirspares_Functions::azirspares_get_option( $prefix . '_lg_items', 4 );
			$woo_md_items  = Azirspares_Functions::azirspares_get_option( $prefix . '_md_items', 3 );
			$woo_sm_items  = Azirspares_Functions::azirspares_get_option( $prefix . '_sm_items', 2 );
			$woo_xs_items  = Azirspares_Functions::azirspares_get_option( $prefix . '_xs_items', 2 );
			$woo_ts_items  = Azirspares_Functions::azirspares_get_option( $prefix . '_ts_items', 2 );
			$cat_class     = '';
			if ( azirspares_is_mobile() ) {
				$cat_class .= ' no-owl-slick cat_list_mobile';
			} else {
				$cat_class .= ' owl-slick';
			}
			$atts         = array(
				'owl_navigation'        => 'false',
				'owl_dots'              => 'false',
				'owl_loop'              => 'false',
				'owl_number_row'        => '2',
				'owl_ts_items'          => $woo_ts_items,
				'owl_xs_items'          => $woo_xs_items,
				'owl_sm_items'          => $woo_sm_items,
				'owl_md_items'          => $woo_md_items,
				'owl_lg_items'          => $woo_lg_items,
				'owl_ls_items'          => $woo_ls_items,
				'owl_responsive_margin' => 992,
			);
			$owl_settings = apply_filters( 'azirspares_carousel_data_attributes', 'owl_', $atts );
			// We can still render if display is forced.
			$cat_args           = array(
				'taxonomy'   => 'product_cat',
				'hide_empty' => false,
				'parent'     => get_queried_object_id(),
			);
			$product_categories = get_terms( $cat_args );
			if ( $banner_cat ) {
				$banner_thumb  = apply_filters( 'azirspares_resize_image', $banner_cat, false, false, true, true );
				$category_html .= '<div class="product-grid"><a href="' . esc_url( $banner_url ) . '"><figure class="banner-cat">' . wp_specialchars_decode( $banner_thumb['img'] ) . '</figure></a></div>';
			}
			if ( ! is_wp_error( $product_categories ) && ! empty( $product_categories ) ) {
				$category_html .= '<div class="product-grid cat_grid"><div class="' . esc_attr( $cat_class ) . '"  ' . esc_attr( $owl_settings ) . '>';
				foreach ( $product_categories as $category ) {
					$cat_link      = get_term_link( $category->term_id, 'product_cat' );
					$thumbnail_id  = get_term_meta( $category->term_id, 'thumbnail_id', true );
					$cat_thumb     = apply_filters( 'azirspares_resize_image', $thumbnail_id, 320, 320, true, true );
					$category_html .= '<div class="cat_lists"><a class="subcat" href="' . esc_url( $cat_link ) . '"><figure>' . wp_specialchars_decode( $cat_thumb['img'] ) . '</figure><span>' . esc_html( $category->name ) . '</span></a></div>';
				}
				$category_html .= '</div></div>';
			}
			?>
            <div class="categories-product-woo">
				<?php echo wp_specialchars_decode( $category_html ); ?>
            </div>
			<?php
		}
	}
}
if ( ! function_exists( 'azirspares_carousel_products' ) ) {
	function azirspares_carousel_products( $prefix, $data_args ) {
		$enable_product = Azirspares_Functions::azirspares_get_option( $prefix . '_enable', 'enable' );
		if ( $enable_product == 'disable' && empty( $data_args ) ) {
			return;
		}
		$enable_shop_mobile            = Azirspares_Functions::azirspares_get_option( 'enable_shop_mobile' );
		$azirspares_shop_product_style = Azirspares_Functions::azirspares_get_option( 'azirspares_shop_product_style', 'style-01' );
		$classes                       = array( 'product-item' );
		if ( ( $enable_shop_mobile == 1 ) && ( azirspares_is_mobile() ) ) {
			$classes[] = 'shop-mobile';
		}
		$classes[]    = $azirspares_shop_product_style;
		$woo_ls_items = Azirspares_Functions::azirspares_get_option( $prefix . '_ls_items', 4 );
		$woo_lg_items = Azirspares_Functions::azirspares_get_option( $prefix . '_lg_items', 3 );
		$woo_md_items = Azirspares_Functions::azirspares_get_option( $prefix . '_md_items', 3 );
		$woo_sm_items = Azirspares_Functions::azirspares_get_option( $prefix . '_sm_items', 2 );
		$woo_xs_items = Azirspares_Functions::azirspares_get_option( $prefix . '_xs_items', 2 );
		$woo_ts_items = Azirspares_Functions::azirspares_get_option( $prefix . '_ts_items', 2 );
		$atts         = array(
			'owl_navigation'        => 'false',
			'owl_dots'              => 'true',
			'owl_loop'              => 'false',
			'owl_slide_margin'      => '40',
			'owl_ts_items'          => $woo_ts_items,
			'owl_xs_items'          => $woo_xs_items,
			'owl_sm_items'          => $woo_sm_items,
			'owl_md_items'          => $woo_md_items,
			'owl_lg_items'          => $woo_lg_items,
			'owl_ls_items'          => $woo_ls_items,
			'owl_responsive_margin' => 992,
		);
		$owl_settings = apply_filters( 'azirspares_carousel_data_attributes', 'owl_', $atts );
		if ( $data_args ) : ?>
            <div class="<?php echo esc_attr( $azirspares_shop_product_style ); ?> col-sm-12 col-xs-12 single-product-bottom <?php echo esc_attr( $prefix ); ?>-product">
				<?php do_action( 'azirspares_before_related_single_product', $prefix ); ?>
                <div class="owl-slick owl-products equal-container better-height" <?php echo esc_attr( $owl_settings ); ?>>
					<?php foreach ( $data_args as $value ) : ?>
                        <div <?php post_class( $classes ) ?>>
							<?php
							$post_object = get_post( $value->get_id() );
							setup_postdata( $GLOBALS['post'] =& $post_object );
							if ( ( $enable_shop_mobile == 1 ) && ( azirspares_is_mobile() ) ) {
								wc_get_template_part( 'product-styles/content-product', 'style-01' );
							} else {
								wc_get_template_part( 'product-styles/content-product', $azirspares_shop_product_style );
							}
							?>
                        </div>
					<?php endforeach; ?>
                </div>
				<?php do_action( 'azirspares_after_related_single_product', $prefix ); ?>
            </div>
		<?php endif;
		wp_reset_postdata();
	}
}
if ( ! function_exists( 'azirspares_cross_sell_products' ) ) {
	function azirspares_cross_sell_products( $limit = 2, $columns = 2, $orderby = 'rand', $order = 'desc' ) {
		if ( is_checkout() ) {
			return;
		}
		$cross_sells                 = array_filter( array_map( 'wc_get_product', WC()->cart->get_cross_sells() ), 'wc_products_array_filter_visible' );
		$woocommerce_loop['name']    = 'cross-sells';
		$woocommerce_loop['columns'] = apply_filters( 'woocommerce_cross_sells_columns', $columns );
		// Handle orderby and limit results.
		$orderby     = apply_filters( 'woocommerce_cross_sells_orderby', $orderby );
		$cross_sells = wc_products_array_orderby( $cross_sells, $orderby, $order );
		$limit       = apply_filters( 'woocommerce_cross_sells_total', $limit );
		$cross_sells = $limit > 0 ? array_slice( $cross_sells, 0, $limit ) : $cross_sells;
		azirspares_carousel_products( 'azirspares_woo_crosssell', $cross_sells );
	}
}
if ( ! function_exists( 'azirspares_related_products' ) ) {
	function azirspares_related_products() {
		global $product;
		$related_products = array();
		if ( $product ) {
			$defaults                    = array(
				'posts_per_page' => 6,
				'columns'        => 6,
				'orderby'        => 'rand',
				'order'          => 'desc',
			);
			$args                        = wp_parse_args( $defaults );
			$args['related_products']    = array_filter( array_map( 'wc_get_product', wc_get_related_products( $product->get_id(), $args['posts_per_page'], $product->get_upsell_ids() ) ), 'wc_products_array_filter_visible' );
			$args['related_products']    = wc_products_array_orderby( $args['related_products'], $args['orderby'], $args['order'] );
			$woocommerce_loop['name']    = 'related';
			$woocommerce_loop['columns'] = apply_filters( 'woocommerce_related_products_columns', $args['columns'] );
			$related_products            = $args['related_products'];
		}
		
		if ( ! is_product() ) {
			$related_products = array();
		}
		azirspares_carousel_products( 'azirspares_woo_related', $related_products );
	}
}
if ( ! function_exists( 'azirspares_upsell_display' ) ) {
	function azirspares_upsell_display( $orderby = 'rand', $order = 'desc', $limit = '-1', $columns = 4 ) {
		global $product;
		$upsells = array();
		if ( $product ) {
			$args                        = array( 'posts_per_page' => 4, 'orderby' => 'rand', 'columns' => 4, );
			$woocommerce_loop['name']    = 'up-sells';
			$woocommerce_loop['columns'] = apply_filters( 'woocommerce_upsells_columns', isset( $args['columns'] ) ? $args['columns'] : $columns );
			$orderby                     = apply_filters( 'woocommerce_upsells_orderby', isset( $args['orderby'] ) ? $args['orderby'] : $orderby );
			$limit                       = apply_filters( 'woocommerce_upsells_total', isset( $args['posts_per_page'] ) ? $args['posts_per_page'] : $limit );
			// Get visible upsells then sort them at random, then limit result set.
			$upsells = wc_products_array_orderby( array_filter( array_map( 'wc_get_product', $product->get_upsell_ids() ), 'wc_products_array_filter_visible' ), $orderby, $order );
			$upsells = $limit > 0 ? array_slice( $upsells, 0, $limit ) : $upsells;
		}
		
		if ( ! is_product() ) {
			$upsells = array();
		}
		azirspares_carousel_products( 'azirspares_woo_upsell', $upsells );
	}
}
if ( ! function_exists( 'azirspares_single_thumbnail_addtocart' ) ) {
	function azirspares_single_thumbnail_addtocart() {
		global $product;
		// GET SIZE IMAGE SETTING
		$width  = 320;
		$height = 320;
		$crop   = true;
		$size   = wc_get_image_size( 'shop_catalog' );
		if ( $size ) {
			$width  = $size['width'];
			$height = $size['height'];
			if ( ! $size['crop'] ) {
				$crop = false;
			}
		}
		$data_src                = '';
		$attachment_ids          = $product->get_gallery_image_ids();
		$gallery_class_img       = $class_img = array( 'img-responsive' );
		$thumb_gallery_class_img = $thumb_class_img = array( 'thumb-link' );
		$width                   = apply_filters( 'azirspares_shop_pruduct_thumb_width', $width );
		$height                  = apply_filters( 'azirspares_shop_pruduct_thumb_height', $height );
		$image_thumb             = apply_filters( 'azirspares_resize_image', get_post_thumbnail_id( $product->get_id() ), $width, $height, $crop, true );
		$image_url               = $image_thumb['url'];
		$lazy_options            = Azirspares_Functions::azirspares_get_option( 'azirspares_theme_lazy_load' );
		$default_attributes      = $product->get_default_attributes();
		if ( $lazy_options == 1 && empty( $default_attributes ) ) {
			$class_img[] = 'lazy';
			$data_src    = 'data-src=' . esc_attr( $image_thumb['url'] );
			$image_url   = "data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%27http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%27%20viewBox%3D%270%200%20" . $width . "%20" . $height . "%27%2F%3E";
		}
		if ( $attachment_ids && has_post_thumbnail() ) {
			$gallery_class_img[]       = 'wp-post-image';
			$thumb_gallery_class_img[] = 'woocommerce-product-gallery__image';
		} else {
			$class_img[]       = 'wp-post-image';
			$thumb_class_img[] = 'woocommerce-product-gallery__image';
		}
		?>
        <img class="<?php echo implode( ' ', $class_img ); ?>" src="<?php echo esc_attr( $image_url ); ?>"
			<?php echo esc_attr( $data_src ); ?> <?php echo image_hwstring( $width, $height ); ?>
             alt="<?php echo esc_attr( the_title_attribute() ); ?>">
		<?php
	}
}
/* ADD TO CART STICKY PRODUCT */
if ( ! function_exists( 'azirspares_add_to_cart_sticky' ) ) {
	function azirspares_add_to_cart_sticky() {
		global $product;
		$enable_sticky_product_single = Azirspares_Functions::azirspares_get_option( 'enable_sticky_product_single', 0 );
		if ( $enable_sticky_product_single == 1 && is_product() ) : ?>
            <div class="sticky_info_single_product">
                <div class="container">
                    <div class="sticky-thumb-left">
						<?php
						do_action( 'single_product_addtocart_thumb' );
						?>
                    </div>
                    <div class="sticky-info-right">
                        <div class="sticky-title">
							<?php
							do_action( 'single_product_addtocart' );
							?>
                        </div>
						<?php if ( $product->is_purchasable() || $product->is_type( 'external' ) || $product->is_type( 'grouped' ) ) { ?>
							<?php if ( $product->is_in_stock() ) { ?>
                                <button type="button"
                                        class="azirspares-single-add-to-cart-fixed-top azirspares-single-add-to-cart-btn"><?php echo esc_html( $product->single_add_to_cart_text() ); ?>
                                </button>
							<?php } else { ?>
                                <button type="button"
                                        class="azirspares-single-add-to-cart-fixed-top azirspares-single-add-to-cart-btn add-to-cart-out-of-stock"><?php esc_html__( 'Out Of Stock', 'azirspares' ); ?>
                                </button>
							<?php } ?>
						<?php } ?>
                    </div>
                </div>
            </div>
		<?php endif;
		
	}
}
if ( ! function_exists( 'azirspares_template_loop_product_title' ) ) {
	function azirspares_template_loop_product_title() {
		$title_class = array( 'product-name product_title' );
		?>
        <h3 class="<?php echo esc_attr( implode( ' ', $title_class ) ); ?>">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>
		<?php
	}
}
if ( ! function_exists( 'azirspares_template_loop_product_thumbnail' ) ) {
	function azirspares_template_loop_product_thumbnail( $args = array() ) {
		global $product;
		// GET SIZE IMAGE SETTING
		$crop      = true;
		$size      = wc_get_image_size( 'shop_catalog' );
		$wc_width  = 320;
		$wc_height = 320;
		if ( $size ) {
			$wc_width = $size['width'];
			$wc_width = $size['height'];
			if ( ! $size['crop'] ) {
				$crop = false;
			}
		}
		
		$width  = isset( $args['width'] ) ? intval( $args['width'] ) : $wc_width;
		$height = isset( $args['height'] ) ? intval( $args['height'] ) : $wc_height;
		
		$data_src                = '';
		$attachment_ids          = $product->get_gallery_image_ids();
		$gallery_class_img       = $class_img = array( 'img-responsive' );
		$thumb_gallery_class_img = $thumb_class_img = array( 'thumb-link' );
		$width                   = apply_filters( 'azirspares_shop_pruduct_thumb_width', $width );
		$height                  = apply_filters( 'azirspares_shop_pruduct_thumb_height', $height );
		$image_thumb             = apply_filters( 'azirspares_resize_image', get_post_thumbnail_id( $product->get_id() ), $width, $height, $crop, true );
		$image_url               = $image_thumb['url'];
		$lazy_options            = Azirspares_Functions::azirspares_get_option( 'azirspares_theme_lazy_load' );
		$default_attributes      = $product->get_default_attributes();
		if ( $lazy_options == 1 && empty( $default_attributes ) ) {
			$class_img[] = 'lazy';
			$data_src    = 'data-src=' . esc_attr( $image_thumb['url'] );
			$image_url   = "data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%27http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%27%20viewBox%3D%270%200%20" . $width . "%20" . $height . "%27%2F%3E";
		}
		if ( $attachment_ids && has_post_thumbnail() ) {
			$gallery_class_img[]       = 'wp-post-image';
			$thumb_gallery_class_img[] = 'woocommerce-product-gallery__image';
		} else {
			$class_img[]       = 'wp-post-image';
			$thumb_class_img[] = 'woocommerce-product-gallery__image';
		}
		?>
        <a class="<?php echo implode( ' ', $thumb_class_img ); ?>" href="<?php the_permalink(); ?>">
            <img class="<?php echo implode( ' ', $class_img ); ?>" src="<?php echo esc_attr( $image_url ); ?>"
				<?php echo esc_attr( $data_src ); ?> <?php echo image_hwstring( $width, $height ); ?>
                 alt="<?php echo esc_attr( get_the_title() ); ?>">
        </a>
		<?php
		if ( $attachment_ids && has_post_thumbnail() ) :
			$gallery_data_src = '';
			$gallery_thumb       = apply_filters( 'azirspares_resize_image', $attachment_ids[0], $width, $height, $crop, true );
			$gallery_image_url   = $gallery_thumb['url'];
			if ( $lazy_options == 1 && empty( $default_attributes ) ) {
				$gallery_class_img[] = 'lazy';
				$gallery_data_src    = 'data-src=' . esc_attr( $gallery_thumb['url'] );
				$gallery_image_url   = "data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%27http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%27%20viewBox%3D%270%200%20" . $width . "%20" . $height . "%27%2F%3E";
			}
			?>
            <div class="second-image">
                <a href="<?php the_permalink(); ?>" class="<?php echo implode( ' ', $thumb_gallery_class_img ); ?>">
                    <img class="<?php echo implode( ' ', $gallery_class_img ); ?>"
                         src="<?php echo esc_attr( $gallery_image_url ); ?>"
						<?php echo esc_attr( $gallery_data_src ); ?> <?php echo image_hwstring( $width, $height ); ?>
                         alt="<?php echo esc_attr( get_the_title() ); ?>">
                </a>
            </div>
			<?php
		endif;
	}
}
if ( ! function_exists( 'azirspares_custom_new_flash' ) ) {
	function azirspares_custom_new_flash() {
		global $post, $product;
		$postdate      = get_the_time( 'Y-m-d' );
		$postdatestamp = strtotime( $postdate );
		$newness       = Azirspares_Functions::azirspares_get_option( 'azirspares_product_newness', 7 );
		if ( ( time() - ( 60 * 60 * 24 * $newness ) ) < $postdatestamp ) :
			echo apply_filters( 'woocommerce_new_flash', '<span class="onnew"><span class="text">' . esc_html__( 'New', 'azirspares' ) . '</span></span>', $post, $product );
		else:
			echo apply_filters( 'woocommerce_new_flash', '<span class="onnew hidden"></span>', $post, $product );
		endif;
	}
}
if ( ! function_exists( 'azirspares_woocommerce_group_flash' ) ) {
	function azirspares_woocommerce_group_flash() {
		?>
        <div class="flash">
			<?php do_action( 'azirspares_group_flash_content' ); ?>
        </div>
		<?php
	}
}
if ( ! function_exists( 'azirspares_custom_sale_flash' ) ) {
	function azirspares_custom_sale_flash() {
		$percent = azirspares_get_percent_discount();
		if ( $percent != '' ) {
			return '<span class="onsale"><span class="text">' . esc_html( 'save', 'azirspares' ) . str_replace( '-', '&nbsp;', $percent ) . '</span><span class="number">' . $percent . '</span></span>';
		}
		
		return '';
	}
}
if ( ! function_exists( 'azirspares_get_percent_discount' ) ) {
	function azirspares_get_percent_discount() {
		global $product;
		$percent = '';
		if ( $product->is_on_sale() ) {
			if ( $product->is_type( 'variable' ) ) {
				$available_variations = $product->get_available_variations();
				$maximumper           = 0;
				$minimumper           = 0;
				$percentage           = 0;
				for ( $i = 0; $i < count( $available_variations ); ++ $i ) {
					$variation_id      = $available_variations[ $i ]['variation_id'];
					$variable_product1 = new WC_Product_Variation( $variation_id );
					$regular_price     = $variable_product1->get_regular_price();
					$sales_price       = $variable_product1->get_sale_price();
					if ( $regular_price > 0 && $sales_price > 0 ) {
						$percentage = round( ( ( ( $regular_price - $sales_price ) / $regular_price ) * 100 ), 0 );
					}
					if ( $minimumper == 0 ) {
						$minimumper = $percentage;
					}
					if ( $percentage > $maximumper ) {
						$maximumper = $percentage;
					}
					if ( $percentage < $minimumper ) {
						$minimumper = $percentage;
					}
				}
				if ( $minimumper == $maximumper ) {
					$percent .= '-' . $minimumper . '%';
				} else {
					$percent .= '-(' . $minimumper . '-' . $maximumper . ')%';
				}
			} else {
				if ( $product->get_regular_price() > 0 && $product->get_sale_price() > 0 ) {
					$percentage = round( ( ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100 ), 0 );
					$percent    .= '-' . $percentage . '%';
				}
			}
		}
		
		return $percent;
	}
}
if ( ! function_exists( 'azirspares_function_shop_loop_item_countdown' ) ) {
	function azirspares_function_shop_loop_item_countdown() {
		global $product;
		$date = azirspares_get_max_date_sale( $product->get_id() );
		if ( $date > 0 ) {
			?>
            <div class="countdown-product">
                <div class="azirspares-countdown"
                     data-datetime="<?php echo date( 'm/j/Y g:i:s', $date ); ?>">
                </div>
            </div>
			<?php
		}
	}
}
if ( ! function_exists( 'azirspares_template_single_available' ) ) {
	function azirspares_template_single_available() {
		global $product;
		if ( $product->is_in_stock() ) {
			$class = 'in-stock available-product';
			$text  = $product->get_stock_quantity() . esc_html__('In Stock','azirspares');
		} else {
			$class = 'out-stock available-product';
			$text  = esc_html__('Out stock','azirspares');
		}
		?>
        <p class="stock <?php echo esc_attr( $class ); ?>">
            <span> <?php echo esc_html( $text ); ?></span>
        </p>
		<?php
	}
}
if ( ! function_exists( 'azirspares_function_shop_loop_process_variable' ) ) {
	function azirspares_function_shop_loop_process_variable() {
		global $product;
		$units_sold   = get_post_meta( $product->get_id(), 'total_sales', true );
		$availability = $product->get_stock_quantity();
		if ( $availability == '' ) {
			$percent = 0;
		} else {
			$total_percent = $availability + $units_sold;
			$percent       = round( ( ( $units_sold / $total_percent ) * 100 ), 0 );
		}
		?>
        <div class="process-valiable">
            <div class="valiable-text">
                <span class="text">
                    <?php
                    echo esc_attr( $percent ) . '%';
                    echo esc_html__( ' already claimed', 'azirspares' );
                    ?>
                </span>
                <span class="text">
                    <?php echo esc_html__( 'Available: ', 'azirspares' ) ?>
                    <span>
                        <?php
                        if ( $availability != '' ) {
	                        echo esc_html( $availability );
                        } else {
	                        echo esc_html__( 'Unlimit', 'azirspares' );
                        }
                        ?>
                    </span>
                </span>
            </div>
            <span class="valiable-total total">
                <span class="process"
                      style="width: <?php echo esc_attr( $percent ) . '%' ?>"></span>
            </span>
        </div>
		<?php
	}
}
if ( ! function_exists( 'azirspares_get_max_date_sale' ) ) {
	function azirspares_get_max_date_sale( $product_id ) {
		$date_now = current_time( 'timestamp', 0 );
		// Get variations
		$args          = array(
			'post_type'   => 'product_variation',
			'post_status' => array( 'private', 'publish' ),
			'numberposts' => - 1,
			'orderby'     => 'menu_order',
			'order'       => 'asc',
			'post_parent' => $product_id,
		);
		$variations    = get_posts( $args );
		$variation_ids = array();
		if ( $variations ) {
			foreach ( $variations as $variation ) {
				$variation_ids[] = $variation->ID;
			}
		}
		$sale_price_dates_to = false;
		if ( ! empty( $variation_ids ) ) {
			global $wpdb;
			$sale_price_dates_to = $wpdb->get_var( "SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = '_sale_price_dates_to' and post_id IN(" . join( ',', $variation_ids ) . ") ORDER BY meta_value DESC LIMIT 1" );
			if ( $sale_price_dates_to != '' ) {
				return $sale_price_dates_to;
			}
		}
		if ( ! $sale_price_dates_to ) {
			$sale_price_dates_to   = get_post_meta( $product_id, '_sale_price_dates_to', true );
			$sale_price_dates_from = get_post_meta( $product_id, '_sale_price_dates_from', true );
			if ( $sale_price_dates_to == '' || $date_now < $sale_price_dates_from ) {
				$sale_price_dates_to = '0';
			}
		}
		
		return $sale_price_dates_to;
	}
}
/* MINI CART */
if ( ! function_exists( 'azirspares_header_cart_link' ) ) {
	function azirspares_header_cart_link() {
		?>
        <div class="shopcart-dropdown block-cart-link" data-azirspares="azirspares-dropdown">
            <a class="block-link link-dropdown" href="<?php echo wc_get_cart_url(); ?>">
                <span class="flaticon-online-shopping-cart"></span>
                <span class="count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
            </a>
        </div>
		<?php
	}
}
if ( ! function_exists( 'azirspares_header_mini_cart' ) ) {
	function azirspares_header_mini_cart() {
		?>
        <div class="block-minicart block-woo azirspares-mini-cart azirspares-dropdown">
			<?php
			azirspares_header_cart_link();
			the_widget( 'WC_Widget_Cart', 'title=' );
			?>
        </div>
		<?php
	}
}
if ( ! function_exists( 'azirspares_cart_link_fragment' ) ) {
	function azirspares_cart_link_fragment( $fragments ) {
		global $product;
		ob_start();
		azirspares_header_cart_link();
		$fragments['div.block-cart-link'] = ob_get_clean();
		
		return $fragments;
	}
}
if ( ! function_exists( 'azirspares_header_wishlist' ) ) {
	function azirspares_header_wishlist() {
		if ( defined( 'YITH_WCWL' ) ) :
			$yith_wcwl_wishlist_page_id = get_option( 'yith_wcwl_wishlist_page_id' );
			$wishlist_url = get_page_link( $yith_wcwl_wishlist_page_id );
			if ( $wishlist_url != '' ) : ?>
                <div class="block-wishlist block-woo">
                    <a class="block-link" href="<?php echo esc_url( $wishlist_url ); ?>">
                        <span class="flaticon-heart-shape-outline"></span>
                    </a>
                </div>
			<?php endif;
		endif;
	}
}

if ( ! function_exists( 'azirspares_loop_add_to_cart_link' ) ) {
	function azirspares_loop_add_to_cart_link( $link, $product ) {
		$link = sprintf( '<div class="add-to-cart-wrap azirspares-add-to-cart-wrap" data-toggle="tooltip" data-placement="top">%s</div>', $link );
		
		return $link;
	}
}
if ( ! function_exists( 'azirspares_checkout_login_open' ) ) {
	function azirspares_checkout_login_open() {
		if ( ! is_user_logged_in() ) {
			echo '<div class="checkout-before-top"><div class="azirspares-checkout-login">';
		}
	}
}
if ( ! function_exists( 'azirspares_checkout_login_close' ) ) {
	function azirspares_checkout_login_close() {
		if ( ! is_user_logged_in() ) {
			echo '</div>';
		}
	}
}
if ( ! function_exists( 'azirspares_checkout_coupon_open' ) ) {
	function azirspares_checkout_coupon_open() {
		echo '<div class="azirspares-checkout-coupon">';
	}
}
if ( ! function_exists( 'azirspares_checkout_coupon_close' ) ) {
	function azirspares_checkout_coupon_close() {
		echo '</div>';
		if ( ! is_user_logged_in() ) {
			echo '</div>';
		}
	}
}
if ( ! function_exists( 'azirspares_title_cart' ) ) {
	function azirspares_title_cart() {
		echo '<h2 class="cart-title">' . esc_html__( 'Cart', 'azirspares' ) . '</h2>';
	}
}
if ( ! function_exists( 'azirspares_wisth_list_url' ) ) {
	function azirspares_wisth_list_url() {
		$url = '';
		if ( function_exists( 'yith_wcwl_object_id' ) ) {
			$wishlist_page_id = yith_wcwl_object_id( get_option( 'yith_wcwl_wishlist_page_id' ) );
			$url              = get_the_permalink( $wishlist_page_id );
		}
		
		return $url;
	}
}
// Share Single
if ( ! function_exists( 'azirspares_product_share' ) ) {
	function azirspares_product_share() {
		$enable_single_product_sharing = Azirspares_Functions::azirspares_get_option( 'enable_single_product_sharing' );
		if ( $enable_single_product_sharing ) {
			
			$facecbook_url  = add_query_arg( array( 'u' => rawurlencode( get_permalink() ) ), 'https://www.facebook.com/sharer/sharer.php' );
			$twitter_url    = add_query_arg( array(
				                                 'url'  => rawurlencode( get_permalink() ),
				                                 'text' => rawurlencode( get_the_title() ),
			                                 ), 'https://twitter.com/intent/tweet' );
			$pinterest_url  = add_query_arg( array(
				                                 'url'         => rawurlencode( get_permalink() ),
				                                 'media'       => get_the_post_thumbnail_url(),
				                                 'description' => rawurlencode( get_the_title() ),
			                                 ), 'http://pinterest.com/pin/create/button' );
			$googleplus_url = add_query_arg( array(
				                                 'url'  => rawurlencode( get_permalink() ),
				                                 'text' => rawurlencode( get_the_title() ),
			                                 ), 'https://plus.google.com/share' );
			
			$enable_fb_sharing    = Azirspares_Functions::azirspares_get_option( 'enable_single_product_sharing_fb' );
			$enable_tw_sharing    = Azirspares_Functions::azirspares_get_option( 'enable_single_product_sharing_tw' );
			$enable_pin_sharing   = Azirspares_Functions::azirspares_get_option( 'enable_single_product_sharing_pinterest' );
			$enable_gplus_sharing = Azirspares_Functions::azirspares_get_option( 'enable_single_product_sharing_gplus' );
			
			if ( $enable_fb_sharing || $enable_tw_sharing || $enable_pin_sharing || $enable_gplus_sharing ) {
				?>
                <div class="social-share-product">
                    <div class="button-share"><span
                                class="pe-7s-share"></span><?php echo esc_html__( 'Share', 'azirspares' ); ?></div>
                    <div class="share-overlay"></div>
                    <div class="social-share-product-inner">
                        <h3 class="title-share"><?php echo esc_html__( 'Share This', 'azirspares' ); ?></h3>
                        <div class="azirspares-social-product">
							<?php if ( $enable_tw_sharing ) { ?>
                                <a href="<?php echo esc_url( $twitter_url ); ?>" target="_blank"
                                   class="twitter-share-link"
                                   title="<?php echo esc_attr__( 'Twitter', 'azirspares' ); ?>">
                                    <i class="fa fa-twitter"></i>
                                </a>
							<?php } ?>
							<?php if ( $enable_fb_sharing ) { ?>
                                <a href="<?php echo esc_url( $facecbook_url ); ?>" target="_blank"
                                   class="facebook-share-link"
                                   title="<?php echo esc_attr__( 'Facebook', 'azirspares' ); ?>">
                                    <i class="fa fa-facebook"></i>
                                </a>
							<?php } ?>
							<?php if ( $enable_gplus_sharing ) { ?>
                                <a href="<?php echo esc_url( $googleplus_url ); ?>" target="_blank"
                                   class="google-share-link"
                                   title="<?php echo esc_attr__( 'Google Plus', 'azirspares' ); ?>">
                                    <i class="fa fa-google-plus"></i>
                                </a>
							<?php } ?>
							<?php if ( $enable_pin_sharing ) { ?>
                                <a href="<?php echo esc_url( $pinterest_url ); ?>" target="_blank"
                                   class="pinterest-share-link"
                                   title="<?php echo esc_attr__( 'Pinterest', 'azirspares' ); ?>">
                                    <i class="fa fa-pinterest-p"></i>
                                </a>
							<?php } ?>
                        </div>
                    </div>
                </div>
				<?php
			}
		}
		
	}
}

function azirspares_xoo_wc_template_loop_product_thumbnail() {
	$product_thumb_id = get_post_thumbnail_id();
	$thumb            = apply_filters( 'azirspares_resize_image', $product_thumb_id, 92, 92, true, true );
	echo apply_filters( 'azirspares_xoo_wc_template_loop_product_thumbnail', $thumb['img'], $thumb, $product_thumb_id );
}