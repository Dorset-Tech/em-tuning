<?php
if ( !defined( 'ABSPATH' ) ) {
	die( '-1' );
}
/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this "Azirspares_Tabs"
 */
if ( !class_exists( 'Azirspares_Shortcode_Tabs' ) ) {
	class Azirspares_Shortcode_Tabs extends Azirspares_Shortcode
	{
		/**
		 * Shortcode name.
		 *
		 * @var  string
		 */
		public $shortcode = 'tabs';

		public function output_html( $atts, $content = null )
		{
			$atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'azirspares_tabs', $atts ) : $atts;
			extract( $atts );
			$css_class    = array( 'azirspares-tabs' );
			$css_class[]  = $atts['style'];
			$css_class[]  = $atts['el_class'];
			$class_editor = isset( $atts['css'] ) ? vc_shortcode_custom_css_class( $atts['css'], ' ' ) : '';
			$css_class[]  = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_editor, 'azirspares_tabs', $atts );
			$sections     = self::get_all_attributes( 'vc_tta_section', $content );
			$rand         = uniqid();
            // Enqueue needed icon font.
            $icon = $atts['icon_' . $atts['type']];
            vc_icon_element_fonts_enqueue($atts['type']);
			ob_start(); ?>
            <div class="<?php echo implode( ' ', $css_class ); ?>">
				<?php if ( $sections && is_array( $sections ) && count( $sections ) > 0 ): ?>
                    <div class="tab-head">
						<?php if ( $atts['tab_title'] && ($atts['style'] == 'default' || $atts['style'] == 'style1' || $atts['style'] == 'style4' || $atts['style'] == 'style6') ): ?>
                            <h2 class="title">
                                <?php if ($icon && $atts['has_icon'] == 'has-icon'): ?>
                                    <span class="icon">
                                        <span class="<?php echo esc_attr($icon) ?>"></span>
                                    </span>
                                <?php endif; ?>
                                <span class="text"><?php echo esc_html( $atts['tab_title'] ); ?></span>
                            </h2>
						<?php endif; ?>
                        <?php
                        $using_loop = '0';
                        if ( $atts['using_loop'] == 1 ) {
                            $using_loop = '1';
                        }
                        $owl_slick = '';
                        $owl_settings = '';
                        if ( $atts['style'] == 'style2') {
                            $owl_slick = 'owl-slick';
                            $owl_atts = array(
                                'owl_navigation' => 'true',
                                'owl_dots' => 'false',
                                'owl_loop' => 'false',
                                'owl_vertical'            => true,
                                'owl_responsive_vertical' => 1200,
                                'owl_ts_items' => 2,
                                'owl_xs_items' => 2,
                                'owl_sm_items' => 3,
                                'owl_md_items' => 3,
                                'owl_lg_items' => 4,
                                'owl_ls_items' => 4,
                            );
                            $owl_settings = apply_filters('azirspares_carousel_data_attributes', 'owl_', $owl_atts);
                        }
                        if ($atts['style'] == 'style3') {
                            $owl_slick = 'owl-slick';
                            $owl_atts = array(
                                'owl_navigation' => 'false',
                                'owl_dots' => 'false',
                                'owl_loop' => 'false',
                                'owl_slide_margin' => '0',
                                'owl_ts_items' => 2,
                                'owl_xs_items' => 2,
                                'owl_sm_items' => 3,
                                'owl_md_items' => 4,
                                'owl_lg_items' => 5,
                                'owl_ls_items' => 5,
                            );
                            $owl_settings = apply_filters('azirspares_carousel_data_attributes', 'owl_', $owl_atts);
                        }
                        ?>
                        <ul class="tab-link equal-container <?php echo esc_attr($owl_slick); ?>" <?php echo esc_attr($owl_settings)?> data-loop="<?php echo esc_attr($using_loop); ?>">
							<?php foreach ( $sections as $key => $section ) : ?>
								<?php
								/* Get icon from section tabs */
								$section['i_type'] = isset( $section['i_type'] ) ? $section['i_type'] : 'fontawesome';
								$add_icon          = isset( $section['add_icon'] ) ? $section['add_icon'] : '';
								$position_icon     = isset( $section['i_position'] ) ? $section['i_position'] : '';
								$icon_html         = $this->constructIcon( $section );
								$class_load        = array();
								if ( $key == $atts['active_section'] ) {
                                    $class_load[] = 'loaded';
                                }
								?>
                                <li class="<?php if ( $key == $atts['active_section'] ): ?>active<?php endif; ?>">
                                    <a class="<?php echo esc_attr(implode(' ', $class_load)); ?>"
                                       data-ajax="<?php echo esc_attr( $atts['ajax_check'] ) ?>"
                                       data-animate="<?php echo esc_attr( $atts['css_animation'] ); ?>"
                                       data-section="<?php echo esc_attr( $section['tab_id'] ); ?>"
                                       data-id="<?php echo get_the_ID(); ?>"
                                       href="#<?php echo esc_attr( $section['tab_id'] ); ?>-<?php echo esc_attr( $rand ); ?>">
										<?php if ( isset( $section['title_image'] ) ) : ?>
                                            <figure>
												<?php
												$image_thumb = apply_filters( 'azirspares_resize_image', $section['title_image'], false, false, true, true );
												echo wp_specialchars_decode( $image_thumb['img'] );
												?>
                                            </figure>
										<?php endif; ?>
                                        <?php echo ( 'true' === $add_icon && 'right' !== $position_icon ) ? $icon_html : ''; ?>
                                        <?php if ( isset($section['title']) ): ?>
                                            <span><?php echo esc_html( $section['title'] ); ?></span>
                                        <?php endif; ?>
                                        <?php echo ( 'true' === $add_icon && 'right' === $position_icon ) ? $icon_html : ''; ?>

                                    </a>
                                </li>
							<?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="tab-container">
						<?php foreach ( $sections as $key => $section ): ?>
                            <div class="tab-panel <?php if ( $key == $atts['active_section'] ): ?>active<?php endif; ?>"
                                 id="<?php echo esc_attr( $section['tab_id'] ); ?>-<?php echo esc_attr( $rand ); ?>">
								<?php if ( $atts['ajax_check'] == '1' ) {
									if ( $key == $atts['active_section'] )
										echo do_shortcode( $section['content'] );
								} else {
									echo do_shortcode( $section['content'] );
								} ?>
                            </div>
						<?php endforeach; ?>
                    </div>
				<?php endif; ?>
            </div>
			<?php
			$html = ob_get_clean();

			return apply_filters( 'Azirspares_Shortcode_Tabs', $html, $atts, $content );
		}
	}

	new Azirspares_Shortcode_Tabs();
}