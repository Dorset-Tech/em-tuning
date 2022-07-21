<?php
if (!defined('ABSPATH')) {
    die('-1');
}
if (!class_exists('Azirspares_Shortcode_Pricing')) {
    class Azirspares_Shortcode_Pricing extends Azirspares_Shortcode
    {
        /**
         * Shortcode name.
         *
         * @var  string
         */
        public $shortcode = 'pricing';

        static public function add_css_generate($atts)
        {
            $atts = function_exists('vc_map_get_attributes') ? vc_map_get_attributes('azirspares_pricing', $atts) : $atts;
            // Extract shortcode parameters.
            extract($atts);
            $css = '';

            return apply_filters('Azirspares_Shortcode_Pricing_css', $css, $atts);
        }

        public function output_html($atts, $content = null)
        {
            $atts = function_exists('vc_map_get_attributes') ? vc_map_get_attributes('azirspares_pricing', $atts) : $atts;
            // Extract shortcode parameters.
            extract($atts);
            $css_class = array('azirspares-pricing');
            $css_class[] = $atts['style'];
            $css_class[] = $atts['featured'];
            $css_class[] = $atts['el_class'];
            $class_editor = isset($atts['css']) ? vc_shortcode_custom_css_class($atts['css'], ' ') : '';
            $css_class[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_editor, 'azirspares_pricing', $atts);
            $pricing_link = vc_build_link($atts['link']);
            if ($pricing_link['url']) {
                $link_url = $pricing_link['url'];
            } else {
                $link_url = '#';
            }
            if ($pricing_link['target']) {
                $link_target = $pricing_link['target'];
            } else {
                $link_target = '_self';
            }
            $pricing_item = (array)vc_param_group_parse_atts($atts['pricing_item']);
            ob_start();
            ?>
            <div class="<?php echo esc_attr(implode(' ', $css_class)); ?>">
                <div class="pricing-inner">
                    <?php if ($atts['title']): ?>
                        <h4 class="title">
                            <span><?php echo esc_html($atts['title']); ?></span>
                        </h4>
                    <?php endif; ?>
                    <?php if ($atts['currency']): ?>
                        <div class="currency"><?php echo esc_html($atts['currency']); ?></div>
                    <?php endif; ?>
                    <?php if (!empty($pricing_item)): ?>
                        <ul class="pricing-list">
                            <?php foreach ($pricing_item as $item): ?>
                                <li><?php echo esc_html($item['title_item']); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                    <?php if ($pricing_link['title']) : ?>
                        <a class="button" target="<?php echo esc_attr($link_target); ?>"
                           href="<?php echo esc_url($link_url); ?>"><?php echo esc_html($pricing_link['title']); ?></a>
                    <?php endif; ?>
                </div>
            </div>
            <?php
            $html = ob_get_clean();

            return apply_filters('Azirspares_Shortcode_Pricing', $html, $atts, $content);
        }
    }

    new Azirspares_Shortcode_Pricing();
}