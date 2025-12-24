<?php

/**
 * レコメンド（同カテゴリー、同ポストタイプ）
 */
global $post;
$post_type = get_current_post_type();
$cat_tax = ($post_type === 'news') ? 'news_category' : 'common_category';
$terms = get_the_terms($post->ID, $cat_tax);
$term_ids = array();

if ($terms && !is_wp_error($terms)) {
    foreach ($terms as $term) {
        $term_ids[] = $term->term_id;
    }
}

if (!empty($term_ids)) :
    $args = array(
        'post_type' => $post_type,
        'posts_per_page' => 3,
        'post__not_in' => array($post->ID),
        'tax_query' => array(
            array(
                'taxonomy' => $cat_tax,
                'field' => 'term_id',
                'terms' => $term_ids,
            ),
        ),
        'orderby' => 'rand', // ランダム表示
    );

    $related_query = new WP_Query($args);

    if ($related_query->have_posts()) :
?>
        <section class="c-recommend">
            <h2 class="c-recommend__title">関連記事</h2>
            <div class="c-post-list c-post-list--grid">
                <?php while ($related_query->have_posts()) : $related_query->the_post(); ?>
                    <article class="c-post-card">
                        <a href="<?php the_permalink(); ?>" class="c-post-card__link">
                            <div class="c-post-card__thumb">
                                <?php if (has_post_thumbnail()): ?>
                                    <?php the_post_thumbnail('medium'); ?>
                                <?php else: ?>
                                    <span class="no-image">No Image</span>
                                <?php endif; ?>
                            </div>
                            <div class="c-post-card__body">
                                <h3 class="c-post-card__title"><?php the_title(); ?></h3>
                            </div>
                        </a>
                    </article>
                <?php endwhile; ?>
            </div>
        </section>
<?php
    endif;
    wp_reset_postdata();
endif;
?>