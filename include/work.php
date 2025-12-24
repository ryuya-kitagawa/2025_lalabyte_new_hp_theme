<?php
// TOP コラム一覧
$column_query = new WP_Query(array(
    'post_type'      => 'work',   // コラムの投稿タイプ
    'posts_per_page' => 3,          // 3〜4件とのことなので、とりあえず4件
    'ignore_sticky_posts' => 1,
));
?>

<?php if ($column_query->have_posts()) : ?>
    <section class="l-sec l-column">
        <h2 class="u_head_ttl_02">
            <span class="en">WORK</span><br>
            <span class="ja">制作実績</span>
        </h2>

        <div class="c-post-list c-post-list--grid">
            <?php while ($column_query->have_posts()) : $column_query->the_post(); ?>

                <?php
                // カードレイアウト（アーカイブと同じ形）
                $post_type = get_post_type();
                $tax_name  = ($post_type === 'news') ? 'news_category' : 'common_category';
                $terms     = get_the_terms(get_the_ID(), $tax_name);
                $primary_term = null;
                if ($terms && ! is_wp_error($terms)) {
                    $primary_term = array_shift($terms); // 先頭1件だけ
                }
                ?>
                <article class="c-post-card">
                    <a href="<?php the_permalink(); ?>" class="c-post-card__link">
                        <div class="c-post-card__thumb">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('full'); ?>
                            <?php else : ?>
                                <span class="no-image">No Image</span>
                            <?php endif; ?>
                        </div>

                        <div class="c-post-card__body">
                            <div class="c-post-card__meta">
                                <time datetime="<?php the_time('Y-m-d'); ?>">
                                    <?php the_time('Y.m.d'); ?>
                                </time>

                                <?php if ($primary_term) : ?>
                                    <span class="c-label c-label--<?php echo esc_attr($post_type); ?>">
                                        <?php echo esc_html($primary_term->name); ?>
                                    </span>
                                <?php endif; ?>
                            </div>

                            <h3 class="c-post-card__title"><?php the_title(); ?></h3>
                        </div>
                    </a>
                </article>

            <?php endwhile;
            wp_reset_postdata(); ?>
        </div><!-- /.c-post-list -->

        <div class="p-top-column__more">
            <a href="<?php echo esc_url(get_post_type_archive_link('work')); ?>" class="c-btn c-btn--more">
                制作実績一覧を見る
            </a>
        </div>
    </section>
<?php endif; ?>