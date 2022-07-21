<?php
if (!defined('ABSPATH')) {
    die('-1');
}
/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this "Azirspares_Listing"
 */
if (!class_exists('Azirspares_Shortcode_Listing')) {
    class Azirspares_Shortcode_Listing extends Azirspares_Shortcode
    {
        /**
         * Shortcode name.
         *
         * @var  string
         */
        public $shortcode = 'listing';

        public function output_html($atts, $content = null)
        {
            $atts = function_exists('vc_map_get_attributes') ? vc_map_get_attributes('azirspares_listing', $atts) : $atts;
            extract($atts);
            $css_class = array('azirspares-listing');
            $css_class[] = $atts['style'];
            $css_class[] = $atts['type_color'];
            $css_class[] = $atts['type_border'];
            $css_class[] = $atts['el_class'];
            $class_editor = isset($atts['css']) ? vc_shortcode_custom_css_class($atts['css'], ' ') : '';
            $css_class[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_editor, 'azirspares_listing', $atts);
            $listing_link = vc_build_link($atts['link']);
            if ($listing_link['url']) {
                $link_url = $listing_link['url'];
            } else {
                $link_url = '#';
            }
            if ($listing_link['target']) {
                $link_target = $listing_link['target'];
            } else {
                $link_target = '_self';
            }
            $listing_item = (array)vc_param_group_parse_atts($atts['listing_item']);
            /* START */
            ob_start(); ?>
            <div class="<?php echo esc_attr(implode(' ', $css_class)); ?>">
                <div class="listing-inner">
                    <div class="listing-thumb">
                        <?php if ($atts['banner'] && ($atts['style'] == 'default' || $atts['style'] == 'style3')): ?>
                            <figure>
                                <?php
                                $image_gallery = apply_filters('azirspares_resize_image', $atts['banner'], 315, 168, true, true);
                                echo wp_specialchars_decode($image_gallery['img']);
                                ?>
                            </figure>
                        <?php endif; ?>
                        <?php if ($atts['title']): ?>
                            <?php if ($atts['style'] == 'default' || $atts['style'] == 'style3'): ?>
                                <h4 class="cat-name">
                                    <a target="<?php echo esc_attr($link_target); ?>"
                                       href="<?php echo esc_url($link_url); ?>">
                                        <?php echo esc_html($atts['title']); ?>
                                    </a>
                                </h4>
                            <?php elseif($atts['style'] == 'style1'): ?>
                                <h4 class="cat-name">
                                    <?php echo esc_html($atts['title']); ?>
                                </h4>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if ($listing_link['title'] && $atts['style'] == 'default'): ?>
                            <a class="button" target="<?php echo esc_attr($link_target); ?>"
                               href="<?php echo esc_url($link_url); ?>"><?php echo esc_html($listing_link['title']); ?></a>
                        <?php endif; ?>
                    </div>
                    <?php if (!empty($listing_item)):
                        $clear = '';
                        $classes = array();
                        if ($atts['style'] == 'style2'):
                            $clear = 'row auto-clear';
                            $classes[] = 'rows-space-30';
                            $classes[] = 'col-bg-15';
                            $classes[] = 'col-lg-15';
                            $classes[] = 'col-md-3';
                            $classes[] = 'col-sm-4';
                            $classes[] = 'col-xs-6';
                            $classes[] = 'col-ts-12';
                        endif; ?>
                        <ul class="listing-list equal-elem <?php echo esc_attr($clear); ?>">
                            <?php foreach ($listing_item as $item): ?>
                                <?php
                                $icon = $item['icon_' . $item['type']];
                                vc_icon_element_fonts_enqueue($item['type']);
                                ?>
                                <?php if ($item['title_item'] != ''): ?>
                                    <li class="<?php echo esc_attr(implode(' ', $classes)); ?>">
                                        <?php if (array_key_exists('link_item', $item)):
                                            $item_link = vc_build_link($item['link_item']);
                                            if ($item_link['target'] == '') {
                                                $item_link['target'] = '_self';
                                            }
                                            if ($item_link['url'] != ''): ?>
                                                <a href="<?php echo esc_url($item_link['url']) ?>"
                                                   target="<?php echo esc_attr($item_link['target']) ?>">
                                                    <?php if ($item['upload'] == 'icon'): ?>
                                                        <span class="icon"><span class="<?php echo esc_attr($icon) ?>"></span></span>
                                                    <?php elseif ($item['upload'] == 'image' && isset($item['image'])): ?>
                                                        <span class="image"><?php echo wp_get_attachment_image($item['image'], 'full'); ?></span>
                                                    <?php endif; ?>
                                                    <?php echo esc_html($item['title_item']); ?>
                                                </a>
                                            <?php else: ?>
                                                <?php echo esc_html($item['title_item']); ?>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <?php echo esc_html($item['title_item']); ?>
                                        <?php endif; ?>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                    <?php if ($listing_link['title'] && $atts['style'] == 'style2'): ?>
                        <a class="button" target="<?php echo esc_attr($link_target); ?>"
                           href="<?php echo esc_url($link_url); ?>"><?php echo esc_html($listing_link['title']); ?></a>
                    <?php endif; ?>
                </div>
            </div>
            <?php
            wp_reset_postdata();
            $html = ob_get_clean();

            return apply_filters('Azirspares_Shortcode_Listing', $html, $atts, $content);
        }
    }

    new Azirspares_Shortcode_Listing();
}