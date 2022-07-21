<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Azirspares
 */
?>
<?php
get_header();
$term_id = get_queried_object_id();
$sidebar_isset = wp_get_sidebars_widgets();
/* Blog Layout */
$azirspares_blog_layout = Azirspares_Functions::azirspares_get_option('azirspares_sidebar_blog_layout', 'left');
$azirspares_blog_style = Azirspares_Functions::azirspares_get_option('azirspares_blog_style', 'standard');
$azirspares_blog_used_sidebar = Azirspares_Functions::azirspares_get_option('azirspares_blog_used_sidebar', 'widget-area');
$azirspares_container_class = array('main-container');
if (is_single()) {
    /*Single post layout*/
    $azirspares_blog_layout = Azirspares_Functions::azirspares_get_option('azirspares_sidebar_single_layout', 'left');
    $azirspares_blog_used_sidebar = Azirspares_Functions::azirspares_get_option('azirspares_single_used_sidebar', 'widget-area');
}
if (isset($sidebar_isset[$azirspares_blog_used_sidebar]) && empty($sidebar_isset[$azirspares_blog_used_sidebar])) {
    $azirspares_blog_layout = 'full';
}
if ($azirspares_blog_layout == 'full') {
    $azirspares_container_class[] = 'no-sidebar';
} else {
    $azirspares_container_class[] = $azirspares_blog_layout . '-sidebar has-sidebar';
}
$azirspares_content_class = array();
$azirspares_content_class[] = 'main-content azirspares_blog';
if ($azirspares_blog_layout == 'full') {
    $azirspares_content_class[] = 'col-sm-12 col-xs-12';
} else {
    $azirspares_content_class[] = 'col-lg-9 col-md-8 col-sm-12 col-xs-12';
}
$azirspares_sidebar_class = array();
$azirspares_sidebar_class[] = 'sidebar azirspares_sidebar';
if ($azirspares_blog_layout != 'full') {
    $azirspares_sidebar_class[] = 'col-lg-3 col-md-4 col-sm-12 col-xs-12';
}
?>
<div class="<?php echo esc_attr(implode(' ', $azirspares_container_class)); ?>">
    <!-- POST LAYOUT -->
    <div class="container">
        <?php
        if (!is_front_page()) {
            $args = array(
                'container' => 'div',
                'before' => '',
                'after' => '',
                'show_on_front' => true,
                'network' => false,
                'show_title' => true,
                'show_browse' => false,
                'post_taxonomy' => array(),
                'labels' => array(),
                'echo' => true,
            );
            do_action('azirspares_breadcrumb', $args);
        }
        ?>
        <?php
        $banner_bg = '';
        if (!is_archive()) {
            $banner_bg = Azirspares_Functions::azirspares_get_option('blog_banner');
        }
        ?>
        <?php if (!is_single()) : ?>
            <?php if (is_home()) : ?>
                <?php if (is_front_page()): ?>
                    <h1 class="page-title blog-title"><?php esc_html_e('Latest Posts', 'azirspares'); ?></h1>
                <?php else: ?>
                    <?php
                    if (function_exists('azirspares_blog_banner')) {
                        azirspares_blog_banner();
                    }
                    ?>
                    <h1 class="page-title blog-title"><?php single_post_title(); ?></h1>
                <?php endif; ?>
            <?php elseif (is_page()): ?>
                <h1 class="page-title blog-title"><?php single_post_title(); ?></h1>
            <?php elseif (is_search()): ?>
                <h1 class="page-title blog-title"><?php printf(esc_html__('Search Results for: %s', 'azirspares'), '<span>' . get_search_query() . '</span>'); ?></h1>
            <?php else: ?>
                <h1 class="page-title blog-title"><?php the_archive_title('', ''); ?></h1>
                <?php
                the_archive_description('<div class="taxonomy-description">', '</div>');
                ?>
            <?php endif; ?>
        <?php endif; ?>
        <div class="row">
            <div class="<?php echo esc_attr(implode(' ', $azirspares_content_class)); ?>">
                <?php
                if (is_single()) {
                    while (have_posts()): the_post();
                        get_template_part('templates/blog/blog', 'single');
                        /*If comments are open or we have at least one comment, load up the comment template.*/
                        if (comments_open() || get_comments_number()) :
                            comments_template();
                        endif;
                    endwhile;
                    wp_reset_postdata();
                } else {
                    get_template_part('templates/blog/blog', $azirspares_blog_style);
                } ?>
            </div>
            <?php if ($azirspares_blog_layout != 'full'): ?>
                <div class="<?php echo esc_attr(implode(' ', $azirspares_sidebar_class)); ?>">
                    <?php get_sidebar(); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>
