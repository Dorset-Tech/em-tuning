<?php
if ( !defined( 'ABSPATH' ) ) {
	die( '-1' );
}
/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this "Azirspares_Slide"
 */
if ( !class_exists( 'Azirspares_Shortcode_Slide' ) ) {
	class Azirspares_Shortcode_Slide extends Azirspares_Shortcode
	{
		/**
		 * Shortcode name.
		 *
		 * @var  string
		 */
		public $shortcode = 'slide';

		public function output_html( $atts, $content = null )
		{
			$atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'azirspares_slide', $atts ) : $atts;
			extract( $atts );
			$css_class    = array( 'azirspares-slide' );
			$css_class[]  = $atts['el_class'];
			$css_class[]  = $atts['owl_rows_space'];
			$class_editor = isset( $atts['css'] ) ? vc_shortcode_custom_css_class( $atts['css'], ' ' ) : '';
			$css_class[]  = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_editor, 'azirspares_slide', $atts );
			$owl_settings = apply_filters( 'azirspares_carousel_data_attributes', 'owl_', $atts );
            $owl_class    = array();
            $owl_class[]  = $atts['owl_navigation_style'];
            $owl_class[]  = $atts['owl_navigation_type'];
			ob_start(); ?>
            <div class="<?php echo esc_attr( implode( ' ', $css_class ) ); ?>">
				<?php if ( $atts['slider_title'] ) : ?>
                    <h3 class="azirspares-title"><span><?php echo esc_html( $atts['slider_title'] ); ?></span></h3>
				<?php endif; ?>
                <div class="owl-slick equal-container better-height <?php echo esc_attr( implode( ' ', $owl_class ) ); ?>" <?php echo esc_attr( $owl_settings ); ?>>
					<?php echo wpb_js_remove_wpautop( $content ); ?>
                </div>
            </div>
			<?php
			$html = ob_get_clean();

			return apply_filters( 'Azirspares_Shortcode_Slide', $html, $atts, $content );
		}
	}

	new Azirspares_Shortcode_Slide();
}