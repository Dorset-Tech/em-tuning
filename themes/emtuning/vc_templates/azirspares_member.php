<?php
if (!defined('ABSPATH')) {
    die('-1');
}
/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this "Azirspares_Member"
 */
if (!class_exists('Azirspares_Shortcode_Member')) {
    class Azirspares_Shortcode_Member extends Azirspares_Shortcode
    {
        /**
         * Shortcode name.
         *
         * @var  string
         */
        public $shortcode = 'member';

        static public function add_css_generate($atts)
        {
            $atts = function_exists('vc_map_get_attributes') ? vc_map_get_attributes('azirspares_member', $atts) : $atts;
            // Extract shortcode parameters.
            extract($atts);
            $css = '';

            return apply_filters('Azirspares_Shortcode_Member_css', $css, $atts);
        }

        public function output_html($atts, $content = null)
        {
            $atts = function_exists('vc_map_get_attributes') ? vc_map_get_attributes('azirspares_member', $atts) : $atts;
            extract($atts);
            $css_class = array('azirspares-member');
            $css_class[] = $atts['style'];
            $css_class[] = $atts['el_class'];
            $class_editor = isset($atts['css']) ? vc_shortcode_custom_css_class($atts['css'], ' ') : '';
            $css_class[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_editor, 'azirspares_member', $atts);
            $member_link = vc_build_link($atts['link']);
            if ($member_link['url']) {
                $link_url = $member_link['url'];
                $link_target = $member_link['target'];
            } else {
                $link_target = '_self';
                $link_url = '#';
            }
            $social_members = (array)vc_param_group_parse_atts($atts['social_member']);
            ob_start();
            ?>
            <div class="<?php echo esc_attr(implode(' ', $css_class)); ?>">
                <div class="member-inner">
                    <?php if ($atts['avatar']) : ?>
                        <div class="thumb-avatar">
                            <a href="<?php echo esc_url($link_url); ?>"
                               target="<?php echo esc_attr($link_target); ?>">
                                <?php echo wp_get_attachment_image($atts['avatar'], 'full'); ?>
                            </a>
                            <?php if (!empty($social_members)) : ?>
                                <div class="list-social">
                                    <?php foreach ($social_members as $member): ?>
                                        <?php if ($member['link_social'] != ''): ?>
                                            <?php $icon_html = $this->constructIcon($member); ?>
                                            <a href="<?php echo esc_url($member['link_social']) ?>"><?php echo wp_specialchars_decode($icon_html) ?></a>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <div class="content-member">
                        <?php if ($atts['name']) : ?>
                            <h3 class="name">
                                <a href="<?php echo esc_url($link_url); ?>"
                                   target="<?php echo esc_attr($link_target); ?>">
                                    <?php echo esc_html($atts['name']); ?>
                                </a>
                            </h3>
                        <?php endif; ?>
                        <?php if ($atts['positions']) : ?>
                            <p class="positions"><?php echo wp_specialchars_decode($atts['positions']); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php
            $html = ob_get_clean();

            return apply_filters('Azirspares_Shortcode_Member', $html, $atts, $content);
        }
    }

    new Azirspares_Shortcode_Member();
}