<?php
if (!defined('ABSPATH')) {
    die('-1');
}
/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this "Azirspares_Banner"
 */
if (!class_exists('Azirspares_Shortcode_Banner')) {
    class Azirspares_Shortcode_Banner extends Azirspares_Shortcode
    {
        /**
         * Shortcode name.
         *
         * @var  string
         */
        public $shortcode = 'banner';

        public function output_html($atts, $content = null)
        {
            $atts = function_exists('vc_map_get_attributes') ? vc_map_get_attributes('azirspares_banner', $atts) : $atts;
            extract($atts);
            $css_class = array('azirspares-banner');
            $css_class[] = $atts['style'];
            $css_class[] = $atts['border'];
            $css_class[] = $atts['align'];
            $css_class[] = $atts['position'];
            $css_class[] = $atts['el_class'];
            $class_editor = isset($atts['css']) ? vc_shortcode_custom_css_class($atts['css'], ' ') : '';
            $css_class[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_editor, 'azirspares_banner', $atts);
            $banner_link = vc_build_link($atts['link']);
            if ($banner_link['url']) {
                $link_url = $banner_link['url'];
            } else {
                $link_url = '#';
            }
            if ($banner_link['target']) {
                $link_target = $banner_link['target'];
            } else {
                $link_target = '_self';
            }
            /* START */
            ob_start(); ?>
            <div class="<?php echo esc_attr(implode(' ', $css_class)); ?>">
                <div class="banner-inner">
                    <?php if ($atts['title']) : ?>
                        <div class="label-banner"><span><?php echo esc_html($atts['label_text']); ?></span></div>
                    <?php endif; ?>    
                    <?php if ($atts['banner']) : ?>
                        <figure class="banner-thumb">
                            <?php echo wp_get_attachment_image($atts['banner'], 'full'); ?>
                        </figure>
                    <?php endif; ?>
                    <div class="banner-info">
                        <div class="banner-content">
                            <?php if ($atts['category']) : ?>
                                <h6 class="banner-cat">
                                    <?php echo esc_html($atts['category']); ?>
                                </h6>
                            <?php endif; ?>
                            <?php if ($atts['title']) : ?>
                                <h3 class="title">
                                    <?php echo wp_specialchars_decode($atts['title']); ?>
                                </h3>
                            <?php endif; ?>
                            <?php if ($atts['title_hightlight'] && $atts['style'] != 'default' ) : ?>
                                <h4 class="title-hightlight">
                                    <?php echo esc_html($atts['title_hightlight']); ?>
                                </h4>
                            <?php endif; ?>
                            <?php if ($content) : ?>
                                <div class="desc">
                                    <?php echo wp_specialchars_decode($content); ?>
                                </div>
                            <?php endif; ?>
                            <?php if ($banner_link['title']) : ?>
                                <a class="button" target="<?php echo esc_attr($link_target); ?>"
                                   href="<?php echo esc_url($link_url); ?>"><?php echo esc_html($banner_link['title']); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            wp_reset_postdata();
            $html = ob_get_clean();

            return apply_filters('Azirspares_Shortcode_Banner', $html, $atts, $content);
        }
    }

    new Azirspares_Shortcode_Banner();
}