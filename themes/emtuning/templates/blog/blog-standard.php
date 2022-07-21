<?php
if (have_posts()) : ?>
    <?php do_action('azirspares_before_blog_content'); ?>
    <div class="blog-standard content-post">
        <?php while (have_posts()) : the_post(); ?>
            <article <?php post_class('post-item post-standard'); ?>>
                <?php azirspares_post_format(); ?>
                <div class="post-info">
                    <?php
                    azirspares_post_title();
                    ?>
                    <div class="post-meta">
                        <?php
                        azirspares_post_date();
                        azirspares_post_author();
                        ?>
                    </div>
                </div>
                <?php
                $enable_except_post = Azirspares_Functions::azirspares_get_option('enable_except_post', '');
                if ($enable_except_post == 1) {
                    azirspares_post_excerpt();
                } else {
                    azirspares_post_full_content();
                }
                ?>
                <?php
                if ($enable_except_post == 1) {
                    azirspares_post_readmore();
                } else {
                    azirspares_post_tags();
                }
                ?>
                <div class="post-foot">
                    <?php
                    azirspares_post_category();
                    azirspares_post_comment();
                    ?>
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
endif; ?>