<?php
if ( !class_exists( 'Azirspares_Shortcode_Newsletter' ) ) {
	class Azirspares_Shortcode_Newsletter extends Azirspares_Shortcode
	{
		/**
		 * Shortcode name.
		 *
		 * @var  string
		 */
		public $shortcode = 'newsletter';

		public function output_html( $atts, $content = null )
		{
			$atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'azirspares_newsletter', $atts ) : $atts;
			// Extract shortcode parameters.
			extract( $atts );
			$css_class    = array( 'azirspares-newsletter' );
			$css_class[]  = $atts['style'];
			$css_class[]  = $atts['type_color'];
			$css_class[]  = $atts['el_class'];
			$class_editor = isset( $atts['css'] ) ? vc_shortcode_custom_css_class( $atts['css'], ' ' ) : '';
			$css_class[]  = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_editor, 'azirspares_newsletter', $atts );
            // Enqueue needed icon font.
			$icon = $atts['icon_' . $atts['type']];
            vc_icon_element_fonts_enqueue($atts['type']);
			ob_start();
			?>
            <div class="<?php echo esc_attr( implode( ' ', $css_class ) ); ?>">
                <div class="newsletter-inner">
                    <?php if ( $atts['title'] && $atts['style'] == 'style2' ) : ?>
                        <h3 class="widgettitle">
                            <span class="title"><?php echo esc_html( $atts['title'] ); ?></span>
                        </h3>
                    <?php endif; ?>
                    <?php if ( $atts['desc'] &&  ($atts['style'] == 'style1' ||  $atts['style'] == 'style2') ) : ?>
                        <p class="desc"><?php echo wp_specialchars_decode( $atts['desc'] ); ?></p>
                    <?php endif; ?>
                    <div class="newsletter-form-wrap">
                        <input class="email email-newsletter" type="email" name="email"
                               placeholder="<?php echo esc_attr( $atts['placeholder_text'] ); ?>">
                        <a href="#" class="button btn-submit submit-newsletter">
                            <?php if ( $atts['button_text'] && $atts['style_button'] == 'text') : ?>
                                <span class="text"><?php echo esc_attr( $atts['button_text'] ); ?></span>
                            <?php elseif ($icon && $atts['style_button'] == 'icon'): ?>
                                <span class="icon <?php echo esc_attr($icon) ?>"></span>
                            <?php else: ?>
                                <span class="icon fa fa-paper-plane-o" aria-hidden="true"></span>
                            <?php endif; ?>
                        </a>
                    </div>
                </div>
            </div>
			<?php
			$html = ob_get_clean();

			return apply_filters( 'Azirspares_Shortcode_Newsletter', $html, $atts, $content );
		}
	}

	new Azirspares_Shortcode_Newsletter();
}