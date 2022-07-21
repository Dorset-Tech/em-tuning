<?php
$classes = array('post-item', 'post-grid');
$classes[] = 'col-bg-' . Azirspares_Functions::azirspares_get_option('azirspares_blog_bg_items', 4);
$classes[] = 'col-lg-' . Azirspares_Functions::azirspares_get_option('azirspares_blog_lg_items', 4);
$classes[] = 'col-md-' . Azirspares_Functions::azirspares_get_option('azirspares_blog_md_items', 4);
$classes[] = 'col-sm-' . Azirspares_Functions::azirspares_get_option('azirspares_blog_sm_items', 6);
$classes[] = 'col-xs-' . Azirspares_Functions::azirspares_get_option('azirspares_blog_xs_items', 12);
$classes[] = 'col-ts-' . Azirspares_Functions::azirspares_get_option('azirspares_blog_ts_items', 12);
if (have_posts()) : ?>
    <div class="blog-grid auto-clear content-post row">
        <?php while (have_posts()) : the_post(); ?>
            <article <?php post_class($classes); ?>>
                <div class="post-inner">
                    <div class="post-thumb">
                        <figure>
                            <?php $thumb = apply_filters('azirspares_resize_image', get_post_thumbnail_id(), 440, 393, true, true);
                            echo wp_specialchars_decode($thumb['img']); ?>
                        </figure>
                        <?php azirspares_post_datebox(); ?>
                    </div>
                    <div class="post-content">
                        <div class="post-meta">
                            <?php
                            azirspares_post_author();
                            azirspares_post_comment_icon();
                            ?>
                        </div>
                        <div class="post-info equal-elem">
                            <?php
                            azirspares_post_title();
                            echo wp_trim_words(apply_filters('the_excerpt', get_the_excerpt()), 15, '');
                            ?>
                        </div>
                    </div>
                </div>
            </article>
        <?php endwhile;
        wp_reset_postdata(); ?>
    </div>
    <?php
    /**
     * Functions hooked into azirspares_after_blog_content action
     *
     * @hooked azirspares_paging_nav               - 10
     */
    do_action('azirspares_after_blog_content'); ?>
<?php else :
    get_template_part('content', 'none');
endif;