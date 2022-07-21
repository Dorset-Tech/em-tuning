<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
/**
 * Shortcode attributes
 *
 * @var $atts
 * Shortcode class
 * @var $this "Azirspares_Category"
 */
if ( ! class_exists( 'Azirspares_Shortcode_Category' ) ) {
	class Azirspares_Shortcode_Category extends Azirspares_Shortcode {
		/**
		 * Shortcode name.
		 *
		 * @var  string
		 */
		public $shortcode = 'category';
		
		
		public function output_html( $atts, $content = null ) {
			$atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'azirspares_category', $atts ) : $atts;
			extract( $atts );
			$css_class           = array( 'azirspares-category' );
			$css_class[]         = $atts['el_class'];
			$css_class[]         = $atts['style'];
			$class_editor        = isset( $atts['css'] ) ? vc_shortcode_custom_css_class( $atts['css'], ' ' ) : '';
			$css_class[]         = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_editor, 'azirspares_category', $atts );
			$owl_settings        = '';
			$category_list_class = array();
			$category_item_class = array( 'category-item' );
			if ( $atts['productsliststyle'] == 'grid' ) {
				$category_list_class[] = 'category-list-grid row auto-clear equal-container better-height ';
				$category_item_class[] = $atts['boostrap_rows_space'];
				$category_item_class[] = 'col-bg-' . $atts['boostrap_bg_items'];
				$category_item_class[] = 'col-lg-' . $atts['boostrap_lg_items'];
				$category_item_class[] = 'col-md-' . $atts['boostrap_md_items'];
				$category_item_class[] = 'col-sm-' . $atts['boostrap_sm_items'];
				$category_item_class[] = 'col-xs-' . $atts['boostrap_xs_items'];
				$category_item_class[] = 'col-ts-' . $atts['boostrap_ts_items'];
			}
			if ( $atts['productsliststyle'] == 'owl' ) {
				$atts['owl_responsive_margin'] = 992;
				$category_list_class[]         = 'category-list-owl owl-slick equal-container better-height';
				$category_list_class[]         = $atts['owl_navigation_style'];
				$category_list_class[]         = $atts['owl_navigation_type'];
				$category_item_class[]         = $atts['owl_rows_space'];
				$owl_settings                  .= apply_filters( 'azirspares_carousel_data_attributes', 'owl_', $atts );
			}
			/* START */
			ob_start(); ?>
			<?php if ( trim( $atts['taxonomy'] ) != '' ):
				$taxs = explode( ',', $atts['taxonomy'] ); ?>
                <div class="<?php echo esc_attr( implode( ' ', $css_class ) ); ?>">
                    <div class="<?php echo esc_attr( implode( ' ', $category_list_class ) ); ?>" <?php echo esc_attr( $owl_settings ); ?>>
						<?php foreach ( $taxs as $tax ): ?>
							<?php $term        = get_term_by( 'slug', $tax, 'product_cat' );
							if ( ! is_wp_error( $term ) && ! empty( $term ) ):
								$cat_thumb_id = get_term_meta( $term->term_id, 'thumbnail_id', true );
								$cat_thumb_url = wp_get_attachment_thumb_url( $cat_thumb_id );
								$url           = get_term_link( $term->term_id, 'product_cat' ); ?>
                                <div <?php post_class( $category_item_class ); ?>>
                                    <div class="category-inner equal-elem">
										<?php if ( $cat_thumb_url ): ?>
                                            <figure class="category-thumb">
                                                <a href="<?php echo esc_url( $url ); ?>">
                                                    <img src="<?php echo esc_url( $cat_thumb_url ) ?>"
                                                         alt="<?php echo esc_attr( $term->name ); ?>"/>
                                                </a>
                                            </figure>
										<?php endif; ?>
                                        <h3 class="title">
                                            <a href="<?php echo esc_url( $url ); ?>">
												<?php echo esc_html( $term->name ); ?>
                                            </a>
                                        </h3>
                                    </div>
                                </div>
							<?php endif; ?>
						<?php endforeach; ?>
                    </div>
                </div>
			<?php endif;
			$array_filter = array(
				'carousel' => $owl_settings,
			);
			wp_reset_postdata();
			$html = ob_get_clean();
			
			return apply_filters( 'Azirspares_Shortcode_Category', $html, $atts, $content, $array_filter );
		}
	}
	
	new Azirspares_Shortcode_Category();
}