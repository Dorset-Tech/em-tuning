<?php
if (!defined('ABSPATH')) {
    die('-1');
}
/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this "Azirspares_Products_Total"
 */
if (!class_exists('Azirspares_Shortcode_Products_Total')) {
    class Azirspares_Shortcode_Products_Total extends Azirspares_Shortcode
    {
        /**
         * Shortcode name.
         *
         * @var  string
         */
        public $shortcode = 'products_total';

        public function output_html($atts, $content = null)
        {
            $atts = function_exists('vc_map_get_attributes') ? vc_map_get_attributes('azirspares_products_total', $atts) : $atts;
            extract($atts);
            $css_class = array('azirspares-products-total');
            $css_class[] = $atts['el_class'];
            $class_editor = isset($atts['css']) ? vc_shortcode_custom_css_class($atts['css'], ' ') : '';
            $css_class[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_editor, 'azirspares_products_total', $atts);
            /* START */
            ob_start(); ?>
            <div class="<?php echo esc_attr(implode(' ', $css_class)); ?>">
                <div class="products-total-inner">
                    <ul>
                        <li><?php
                            $count_products = wp_count_posts($post_type = 'product');
                            $total_products = $count_products->publish;
                            echo sprintf(esc_html__('Shop By Products (%s)', 'azirspares'), $total_products);
                            ?>
                        </li>
                        <?php
                        if (!empty($atts['product_attribute'])) {
                            $attribute_list = explode(",", $atts['product_attribute']);
                            foreach ($attribute_list as $attribute_item) { ?>
                                <li>
                                    <?php
                                    $attribute_name = str_replace('-','&nbsp;',$attribute_item);
                                    $taxonomy = 'pa_'. $attribute_item;
                                    $terms = get_terms( array(
                                        'taxonomy' => $taxonomy,
                                        'hide_empty' => false,
                                    ) );
                                    $count = count($terms);
                                    echo sprintf(esc_html__('Shop By %s (%s)', 'azirspares'), $attribute_name, $count);
                                    ?>
                                </li>
                                <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <?php
            $html = ob_get_clean();
            return apply_filters('Azirspares_Shortcode_Products_Total', $html, $atts, $content);
        }
    }

    new Azirspares_Shortcode_Products_Total();
}