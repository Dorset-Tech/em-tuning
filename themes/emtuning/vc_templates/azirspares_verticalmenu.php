<?php
if (!defined('ABSPATH')) {
    die('-1');
}
/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this "Azirspares_Verticalmenu"
 */

if ( !class_exists( 'Azirspares_Shortcode_Verticalmenu' ) ) {
    class Azirspares_Shortcode_Verticalmenu extends Azirspares_Shortcode {
        /**
         * Shortcode name.
         *
         * @var  string
         */
        public $shortcode = 'verticalmenu';

        public function output_html( $atts, $content = null ) {
            $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'azirspares_verticalmenu', $atts ) : $atts;
            extract( $atts );
            $css_class   = array( 'azirspares-verticalmenu block-nav-category' );
            $css_class[] = $atts['style'];
            $css_class[] = $atts['el_class'];
            $class_editor = isset($atts['css']) ? vc_shortcode_custom_css_class($atts['css'], ' ') : '';
            $css_class[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_editor, 'azirspares_verticalmenu', $atts);
            if ( $atts['position_menu'] == 'yes' ) {
                $css_class[] = 'absolute-menu';
            }
            $nav_menu          = get_term_by( 'slug', $atts['menu'], 'nav_menu' );
            $button_close_text = $atts['button_close_text'];
            $button_all_text   = $atts['button_all_text'];
            $limit_items       = absint( $atts['limit_items'] );
            ob_start();
            ?>
            <div class="<?php echo esc_attr( implode( ' ', $css_class ) ); ?>"
                 data-items="<?php echo esc_attr( $limit_items ); ?>">
                <?php if ( $atts['title'] ): ?>
                    <div class="block-title">
                        <span class="text-title">
                            <?php echo esc_html( $atts['title'] ); ?>
                        </span>
                    </div>
                <?php endif; ?>
                <div class="block-content verticalmenu-content">
                    <?php if ( is_object( $nav_menu ) ): ?>
                        <?php
                        wp_nav_menu( array(
                                'menu'            => $nav_menu,
                                'depth'           => 3,
                                'container'       => '',
                                'container_class' => '',
                                'container_id'    => '',
                                'menu_class'      => 'azirspares-nav vertical-menu style1',
                                'fallback_cb'     => 'azirspares_navwalker::fallback',
                                'walker'          => new azirspares_navwalker(),
                            )
                        );
                        $menu_id           = $nav_menu->term_id;
                        $menu_items        = wp_get_nav_menu_items( $menu_id );
                        $count             = 0;
                        foreach ( $menu_items as $menu_item ) {
                            if ( $menu_item->menu_item_parent == 0 )
                                $count++;
                        }
                        if ( $count > $limit_items ) : ?>
                            <div class="view-all-category">
                                <a href="javascript:void(0);"
                                   data-closetext="<?php echo esc_attr( $button_close_text ); ?>"
                                   data-alltext="<?php echo esc_attr( $button_all_text ) ?>"
                                   class="btn-view-all open-cate"><?php echo esc_html( $button_all_text ) ?></a>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>

                </div>
            </div>
            <?php
            $html = ob_get_clean();
            return apply_filters('Azirspares_Shortcode_Verticalmenu', $html, $atts, $content);
        }
    }
    new Azirspares_Shortcode_Verticalmenu();
}