<?php
if (!class_exists('Azirspares_Shortcode_Iconbox')) {
    class Azirspares_Shortcode_Iconbox extends Azirspares_Shortcode
    {
        /**
         * Shortcode name.
         *
         * @var  string
         */
        public $shortcode = 'iconbox';
        /**
         * Default $atts .
         *
         * @var  array
         */
        public $default_atts = array();

        public function output_html($atts, $content = null)
        {
            $atts = function_exists('vc_map_get_attributes') ? vc_map_get_attributes('azirspares_iconbox', $atts) : $atts;
            // Extract shortcode parameters.
            extract($atts);
            $css_class = array('azirspares-iconbox');
            $css_class[] = $atts['style'];
            $css_class[] = $atts['type_color'];
            $css_class[] = $atts['el_class'];
            $class_editor = isset($atts['css']) ? vc_shortcode_custom_css_class($atts['css'], ' ') : '';
            $css_class[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_editor, 'azirspares_iconbox', $atts);
            // Enqueue needed icon font.
            $icon = $atts['icon_' . $atts['type']];
            vc_icon_element_fonts_enqueue($atts['type']);
            /* LINK */
            $iconbox_link = vc_build_link($atts['link']);
            if ($iconbox_link['url']) {
                $link_url = $iconbox_link['url'];
            } else {
                $link_url = '#';
            }
            if ($iconbox_link['target']) {
                $link_target = $iconbox_link['target'];
            } else {
                $link_target = '_self';
            }
            ob_start();
            ?>
            <div class="<?php echo esc_attr(implode(' ', $css_class)); ?>">
                <div class="iconbox-inner">
                    <?php if ($atts['upload'] == 'icon'): ?>
                        <?php if ($icon): ?>
                            <span class="icon">
                                <span class="<?php echo esc_attr($icon) ?>"></span>
                            </span>
                        <?php endif; ?>
                    <?php elseif ($atts['upload'] == 'image'): ?>
                        <?php if ($atts['style'] == 'style17'): ?>
                            <a target="<?php echo esc_attr($link_target); ?>"
                               href="<?php echo esc_url($link_url); ?>">
                                <?php echo wp_get_attachment_image($atts['image'], 'full'); ?>
                            </a>
                        <?php else: ?>
                            <?php if ($atts['image']): ?>
                                <div class="icon">
                                    <?php echo wp_get_attachment_image($atts['image'], 'full'); ?>
                                    <?php if($atts['style'] == 'style15'):?>
                                        <div class="product-video-button">
                                            <a <?php if ($atts['color_btn']): ?>
                                                style="background-color: <?php echo esc_attr($atts['color_btn']); ?>"
                                            <?php endif; ?>
                                                    target="<?php echo esc_attr($link_target); ?>"
                                                    href="<?php echo esc_url($link_url); ?>"></a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                    <div class="iconbox-wrap">
                        <?php if ($atts['title'] && ($atts['style'] == 'default' || $atts['style'] == 'style3' || $atts['style'] == 'style4' || $atts['style'] == 'style5' || $atts['style'] == 'style6' || $atts['style'] == 'style7' || $atts['style'] == 'style8' || $atts['style'] == 'style9' || $atts['style'] == 'style12' || $atts['style'] == 'style13' || $atts['style'] == 'style14' || $atts['style'] == 'style15' || $atts['style'] == 'style16' || $atts['style'] == 'style18')) : ?>
                            <h4 class="title">
                                <?php echo esc_html($atts['title']); ?>
                            </h4>
                        <?php endif; ?>
                        <?php if ($atts['title'] &&  $atts['style'] == 'style17') : ?>
                            <h4 class="title">
                                <a target="<?php echo esc_attr($link_target); ?>"
                                   href="<?php echo esc_url($link_url); ?>">
                                    <?php echo esc_html($atts['title']); ?>
                                </a>
                            </h4>
                        <?php endif; ?>
                        <?php if ($atts['desc'] && ($atts['style'] == 'default' || $atts['style'] || 'style2' && $atts['style'] || 'style3' && $atts['style'] || 'style4' || $atts['style'] == 'style5' || $atts['style'] == 'style6' || $atts['style'] == 'style7' || $atts['style'] == 'style9' || $atts['style'] == 'style11' || $atts['style'] == 'style12' || $atts['style'] == 'style13' || $atts['style'] == 'style15') || $atts['style'] == 'style18'): ?>
                            <p class="desc"><?php echo wp_specialchars_decode($atts['desc']); ?></p>
                        <?php endif; ?>
                        <?php if ($iconbox_link['title']) : ?>
                            <?php if ($atts['style'] == 'style13') : ?>
                                <a class="button"
                                    <?php if ($atts['color_btn']): ?>
                                        style="background-color: <?php echo esc_attr($atts['color_btn']); ?>"
                                    <?php endif; ?>
                                   target="<?php echo esc_attr($link_target); ?>"
                                   href="<?php echo esc_url($link_url); ?>"><?php echo esc_html($iconbox_link['title']); ?></a>
                            <?php elseif($atts['style'] == 'style15') : ?>
                                <a class="button product-video-button"
                                   target="<?php echo esc_attr($link_target); ?>"
                                   href="<?php echo esc_url($link_url); ?>"><?php echo esc_html($iconbox_link['title']); ?></a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <?php if ($atts['style'] == 'style9'): ?>
                        <div class="iconbox-info">
                            <?php if ($atts['texticon']): ?>
                                <div class="texticon">
                                    <?php echo esc_html($atts['texticon']) ?>
                                </div>
                            <?php endif; ?>
                            <?php if ($content): ?>
                                <div class="content">
                                    <?php echo wp_specialchars_decode($content); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($iconbox_link['title'] && ($atts['style'] == 'style7' || $atts['style'] == 'style11' || $atts['style'] == 'style12')) : ?>
                        <a class="button"
                            <?php if ($atts['color_btn'] && $atts['style'] == 'style12'): ?>
                                style="background-color: <?php echo esc_attr($atts['color_btn']); ?>"
                            <?php endif; ?>
                           target="<?php echo esc_attr($link_target); ?>"
                           href="<?php echo esc_url($link_url); ?>"><?php echo esc_html($iconbox_link['title']); ?></a>
                    <?php endif; ?>
                </div>
            </div>
            <?php
            $html = ob_get_clean();

            return apply_filters('Azirspares_Shortcode_Iconbox', $html, $atts, $content);
        }
    }

    new Azirspares_Shortcode_Iconbox();
}