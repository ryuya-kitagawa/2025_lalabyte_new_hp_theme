<?php
// TOP コラム一覧
$column_query = new WP_Query(array(
    'post_type'      => 'news',   // コラムの投稿タイプ
    'posts_per_page' => 3,          // 3〜4件とのことなので、とりあえず4件
    'ignore_sticky_posts' => 1,
    'orderby'        => 'modified',
    'order'          => 'DESC',
));
?>

<?php if ($column_query->have_posts()) : ?>
    <section class="l-sec l-column">
        <h2 class="u_head_ttl_02">
            <span class="en">NEWS</span><br>
            <span class="ja">ニュース</span>
        </h2>

        <div class="c-news-list">
            <?php while ($column_query->have_posts()) : $column_query->the_post(); ?>
                <article class="c-news-list__item">
                    <a href="<?php the_permalink(); ?>" class="c-news-list__link">
                        <div class="c-news-list__thumb">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('full'); ?>
                            <?php else : ?>
                                <span class="no-image">No Image</span>
                            <?php endif; ?>
                        </div>
                        <div class="c-news-list__content">
                            <time class="c-news-list__date" datetime="<?php the_time('Y-m-d'); ?>">
                                <?php the_time('Y.m.d'); ?>
                            </time>
                            <h3 class="c-news-list__title"><?php the_title(); ?></h3>
                        </div>
                    </a>
                </article>
            <?php endwhile;
            wp_reset_postdata(); ?>
        </div><!-- /.c-news-list -->

        <div class="p-top-column__more">
            <a href="<?php echo esc_url(get_post_type_archive_link('news')); ?>" class="c-btn c-btn--more">
                ニュース一覧を見る
            </a>
        </div>
    </section>
<?php endif; ?>