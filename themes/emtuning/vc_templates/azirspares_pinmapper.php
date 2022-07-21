<?php
if ( !defined( 'ABSPATH' ) ) {
	die( '-1' );
}
/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this "Azirspares_Pinmapper"
 */
if ( !class_exists( 'Azirspares_Shortcode_Pinmapper' ) ) {
	class Azirspares_Shortcode_Pinmapper extends Azirspares_Shortcode
	{
		/**
		 * Shortcode name.
		 *
		 * @var  string
		 */
		public $shortcode = 'pinmapper';

		public function output_html( $atts, $content = null )
		{
			$atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'azirspares_pinmapper', $atts ) : $atts;
			extract( $atts );
			$css_class    = array( 'azirspares-pinmapper' );
			$css_class[]  = $atts['el_class'];
			$class_editor = isset( $atts['css'] ) ? vc_shortcode_custom_css_class( $atts['css'], ' ' ) : '';
			$css_class[]  = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_editor, 'azirspares_pinmapper', $atts );
			ob_start(); ?>
            <div class="<?php echo esc_attr( implode( ' ', $css_class ) ); ?>">
				<?php echo do_shortcode( '[azirspares_mapper id="' . $atts['pinmaper_style'] . '"]' ); ?>
            </div>
			<?php
			$html = ob_get_clean();

			return apply_filters( 'Azirspares_Shortcode_Pinmapper', $html, $atts, $content );
		}
	}

	new Azirspares_Shortcode_Pinmapper();
}