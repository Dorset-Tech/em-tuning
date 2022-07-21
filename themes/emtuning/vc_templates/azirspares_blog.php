<?php
if (!defined('ABSPATH')) {
    die('-1');
}
/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this "Azirspares_Blog"
 */
if (!class_exists('Azirspares_Shortcode_Blog')) {
    class Azirspares_Shortcode_Blog extends Azirspares_Shortcode
    {
        /**
         * Shortcode name.
         *
         * @var  string
         */
        public $shortcode = 'blog';

        static public function add_css_generate($atts)
        {
            $atts = function_exists('vc_map_get_attributes') ? vc_map_get_attributes('azirspares_blog', $atts) : $atts;
            // Extract shortcode parameters.
            extract($atts);
            $css = '';
            $shortcode_id = '.' . $atts['azirspares_custom_id'];
            if ($atts['productsliststyle'] == 'grid') {
                $padding = ($atts['boostrap_margin_space']) ? intval($atts['boostrap_margin_space']) / 2 : 30;
                $css .= "{$shortcode_id}.azirspares-blog .post-item{padding: 0 {$padding}px}";
                $css .= "{$shortcode_id}.azirspares-blog .blog-list-grid{margin: 0 -{$padding}px}";
            }

            return apply_filters('Azirspares_Shortcode_Blog_css', $css, $atts);
        }

        public function output_html($atts, $content = null)
        {
            $atts = function_exists('vc_map_get_attributes') ? vc_map_get_attributes('azirspares_blog', $atts) : $atts;
            extract($atts);
            $css_class = array('azirspares-blog');
            $css_class[] = $atts['style'];
            $css_class[] = $atts['el_class'];
            $class_editor = isset($atts['css']) ? vc_shortcode_custom_css_class($atts['css'], ' ') : '';
            $css_class[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_editor, 'azirspares_blog', $atts);
            // Enqueue needed icon font.
            $icon = $atts['icon_' . $atts['type']];
            vc_icon_element_fonts_enqueue($atts['type']);
            $owl_settings = '';
            $blog_list_class = array();
            $blog_item_class = array('post-item', 'post-grid');
            if ($atts['productsliststyle'] == 'grid') {
                $blog_list_class[] = 'blog-list-grid row auto-clear equal-container better-height ';
                $blog_item_class[] = $atts['boostrap_rows_space'];
                $blog_item_class[] = 'col-bg-' . $atts['boostrap_bg_items'];
                $blog_item_class[] = 'col-lg-' . $atts['boostrap_lg_items'];
                $blog_item_class[] = 'col-md-' . $atts['boostrap_md_items'];
                $blog_item_class[] = 'col-sm-' . $atts['boostrap_sm_items'];
                $blog_item_class[] = 'col-xs-' . $atts['boostrap_xs_items'];
                $blog_item_class[] = 'col-ts-' . $atts['boostrap_ts_items'];
            }
            if ($atts['productsliststyle'] == 'owl') {
                $atts['owl_responsive_margin'] = 992;
                $blog_list_class[] = 'blog-list-owl owl-slick equal-container better-height';
                $blog_list_class[] = $atts['owl_navigation_style'];
                $blog_list_class[] = $atts['owl_navigation_type'];
                $blog_item_class[] = $atts['owl_rows_space'];
                $owl_settings .= apply_filters('azirspares_carousel_data_attributes', 'owl_', $atts);
            }
            /* START */
            $data_loop = vc_build_loop_query($atts['loop'])[1];
            ob_start(); ?>
            <div class="<?php echo esc_attr(implode(' ', $css_class)); ?>">
                <?php if ( $atts['title'] ) : ?>
                    <h3 class="title">
                        <?php if ($icon && $atts['has_icon'] == 'has-icon'): ?>
                            <span class="icon">
                                <span class="<?php echo esc_attr($icon) ?>"></span>
                            </span>
                        <?php endif; ?>
                        <span><?php echo esc_html( $atts['title'] ); ?></span>
                    </h3>
                <?php endif; ?>
                <?php if ($data_loop->have_posts()) : ?>
                    <div class="<?php echo esc_attr(implode(' ', $blog_list_class)); ?>" <?php echo esc_attr($owl_settings); ?>>
                        <?php while ($data_loop->have_posts()) : $data_loop->the_post(); ?>
                            <article <?php post_class($blog_item_class); ?>>
                                <?php
                                get_template_part('/templates/blog/blog-style/content-blog', $atts['style']);
                                ?>
                            </article>
                        <?php endwhile; ?>
                    </div>
                <?php else :
                    get_template_part('content', 'none');
                endif; ?>
            </div>
            <?php
            $array_filter = array(
                'carousel' => $owl_settings,
                'query' => $data_loop,
            );
            wp_reset_postdata();
            $html = ob_get_clean();

            return apply_filters('Azirspares_Shortcode_Blog', $html, $atts, $content, $array_filter);
        }
    }

    new Azirspares_Shortcode_Blog();
}