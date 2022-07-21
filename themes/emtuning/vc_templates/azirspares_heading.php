<?php
if ( !defined( 'ABSPATH' ) ) {
	die( '-1' );
}
/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this "Azirspares_Heading"
 */
if ( !class_exists( 'Azirspares_Shortcode_Heading' ) ) {
	class Azirspares_Shortcode_Heading extends Azirspares_Shortcode
	{
		/**
		 * Shortcode name.
		 *
		 * @var  string
		 */
		public $shortcode = 'heading';

		public function output_html( $atts, $content = null )
		{
			$atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'azirspares_heading', $atts ) : $atts;
			extract( $atts );
			$css_class    = array( 'azirspares-heading' );
			$css_class[]  = $atts['style'];
			$css_class[]  = $atts['type_color'];
			$css_class[]  = $atts['el_class'];
			$class_editor = isset( $atts['css'] ) ? vc_shortcode_custom_css_class( $atts['css'], ' ' ) : '';
			$css_class[]  = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_editor, 'azirspares_heading', $atts );
            // Enqueue needed icon font.
            $icon = $atts['icon_' . $atts['type']];
            vc_icon_element_fonts_enqueue($atts['type']);
			/* LINK */
			$heading_link = vc_build_link($atts['link']);
            if ($heading_link['url']) {
                $link_url = $heading_link['url'];
            } else {
                $link_url = '#';
            }
            if ($heading_link['target']) {
                $link_target = $heading_link['target'];
            } else {
                $link_target = '_self';
            }
            /* START */
			ob_start(); ?>
            <div class="<?php echo esc_attr( implode( ' ', $css_class ) ); ?>">
                <div class="heading-inner">
                    <div class="header-wrap">
                        <?php if ( $atts['title'] ) : ?>
                            <h3 class="title">
                                <?php if ($icon &&  $atts['style'] == 'style5'): ?>
                                    <span class="icon">
                                        <span class="<?php echo esc_attr($icon) ?>"></span>
                                    </span>
                                <?php endif; ?>
                                <span><?php echo esc_html( $atts['title'] ); ?></span>
                            </h3>
                        <?php endif; ?>
                        <?php if ( $atts['desc'] && $atts['style'] == 'style1' ) : ?>
                            <p class="desc"><?php echo wp_specialchars_decode( $atts['desc'] ); ?></p>
                        <?php endif; ?>
                    </div>
                    <?php if($heading_link['title'] && $atts['style'] == 'style1') :?>
                        <div class="button-inner">
                            <a class="button" target="<?php echo esc_attr($link_target); ?>" href="<?php echo esc_url($link_url); ?>"><?php echo esc_html($heading_link['title']); ?></a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
			<?php
			$html = ob_get_clean();
			return apply_filters( 'Azirspares_Shortcode_Heading', $html, $atts, $content );
		}
	}

	new Azirspares_Shortcode_Heading();
}