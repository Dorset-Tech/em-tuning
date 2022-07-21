<?php
if (!class_exists('Azirspares_Shortcode_Popupvideo')) {
    class Azirspares_Shortcode_Popupvideo extends Azirspares_Shortcode
    {
        /**
         * Shortcode name.
         *
         * @var  string
         */
        public $shortcode = 'popupvideo';
        /**
         * Default $atts .
         *
         * @var  array
         */
        public $default_atts = array();

        public function output_html($atts, $content = null)
        {
            $atts = function_exists('vc_map_get_attributes') ? vc_map_get_attributes('azirspares_popupvideo', $atts) : $atts;
            // Extract shortcode parameters.
            extract($atts);
            $css_class = array('azirspares-popupvideo');
            $css_class[] = $atts['style'];
            $css_class[] = $atts['el_class'];
            $class_editor = isset($atts['css']) ? vc_shortcode_custom_css_class($atts['css'], ' ') : '';
            $css_class[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_editor, 'azirspares_popupvideo', $atts);
            /* LINK */
            $popupvideo_link = vc_build_link($atts['link']);
            if ($popupvideo_link['url']) {
                $link_url = $popupvideo_link['url'];
            } else {
                $link_url = '#';
            }
            if ($popupvideo_link['target']) {
                $link_target = $popupvideo_link['target'];
            } else {
                $link_target = '_self';
            }
            ob_start();
            ?>
            <div class="<?php echo esc_attr(implode(' ', $css_class)); ?>">
                <div class="popupvideo-inner">
                    <?php if ($atts['image']): ?>
                        <div class="icon">
                            <?php echo wp_get_attachment_image($atts['image'], 'full'); ?>
                            <div class="product-video-button">
                                <a target="<?php echo esc_attr($link_target); ?>"
                                   href="<?php echo esc_url($link_url); ?>"></a>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="popupvideo-wrap">
                        <?php if ($atts['title']) : ?>
                            <h4 class="title">
                                <?php echo esc_html($atts['title']); ?>
                            </h4>
                        <?php endif; ?>
                        <?php if ($atts['desc']): ?>
                            <p class="desc"><?php echo wp_specialchars_decode($atts['desc']); ?></p>
                        <?php endif; ?>
                        <?php if ($popupvideo_link['title']) : ?>
                            <a class="button product-video-button"
                               target="<?php echo esc_attr($link_target); ?>"
                               href="<?php echo esc_url($link_url); ?>"><?php echo esc_html($popupvideo_link['title']); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php
            $html = ob_get_clean();

            return apply_filters('Azirspares_Shortcode_Popupvideo', $html, $atts, $content);
        }
    }

    new Azirspares_Shortcode_Popupvideo();
}