<?php

/**
 * サイドバーパーツ
 * post_typeごとに内容を切り替える
 */

// --- post_type の判定ロジック ---
if (is_tax('common_category') || is_tax('common_tag')) {
    // 共通タクソノミーのアーカイブ時は、
    // リライトルールで付与した post_type をクエリから取得
    $post_type = get_query_var('post_type');

    // 配列で来る可能性もあるのでケア
    if (is_array($post_type)) {
        $post_type = reset($post_type);
    }
} elseif (function_exists('get_current_post_type')) {
    // それ以外の画面では独自ヘルパーを利用
    $post_type = get_current_post_type();
} else {
    // 最後の保険
    $post_type = get_post_type();
}

// 念のため文字列化
$post_type = (string) $post_type;

$cat_tax = ($post_type === 'news') ? 'news_category' : 'common_category';
?>

<div class="c-sidebar">

    <!-- 1. ページ内検索 -->
    <div class="c-widget c-widget--search">
        <h3 class="c-widget__title">検索</h3>
        <form role="search" method="get" class="c-search-form" action="<?php echo esc_url(home_url('/')); ?>">
            <input type="text" name="s" class="c-search-form__input" placeholder="キーワードを入力">
            <?php if ($post_type) : ?>
                <input type="hidden" name="post_type" value="<?php echo esc_attr($post_type); ?>">
            <?php endif; ?>
            <button type="submit" class="c-search-form__submit">検索</button>
        </form>
    </div>

    <!-- 2. カテゴリー一覧 -->
    <div class="c-widget c-widget--category">
        <h3 class="c-widget__title">カテゴリー</h3>
        <ul class="c-widget__list">
            <?php
            if ($post_type && $cat_tax) {

                // 投稿IDを取得
                $post_ids = get_posts(array(
                    'post_type'      => $post_type,
                    'posts_per_page' => -1,
                    'fields'         => 'ids',
                    'post_status'    => 'publish',
                ));

                if (!empty($post_ids)) {

                    // ターム一覧（親子構造用）
                    $terms = get_terms(array(
                        'taxonomy'   => $cat_tax,
                        'hide_empty' => true,
                        'object_ids' => $post_ids,
                    ));

                    if (!is_wp_error($terms) && !empty($terms)) {

                        // 親 → 子 に振り分け
                        $term_tree = array();
                        foreach ($terms as $term) {
                            if ($term->parent == 0) {
                                $term_tree[$term->term_id] = array(
                                    'term' => $term,
                                    'children' => array(),
                                );
                            }
                        }
                        foreach ($terms as $term) {
                            if ($term->parent != 0 && isset($term_tree[$term->parent])) {
                                $term_tree[$term->parent]['children'][] = $term;
                            }
                        }

                        // ================================
                        // 親子表示関数
                        // ================================
                        function _lalabyte_render_term_item($term, $post_type, $cat_tax, $is_child = false)
                        {
                            // URL構築
                            if ($cat_tax === 'common_category') {
                                $term_link = home_url(
                                    '/' . $post_type . '/category/' . $term->slug . '/'
                                );
                            } else {
                                $term_link = get_term_link($term, $cat_tax);
                                if (is_wp_error($term_link)) return;
                            }

                            // 件数取得（post_type + term）
                            if ($cat_tax === 'common_category') {
                                $term_posts = get_posts(array(
                                    'post_type'      => $post_type,
                                    'posts_per_page' => -1,
                                    'fields'         => 'ids',
                                    'post_status'    => 'publish',
                                    'tax_query'      => array(
                                        array(
                                            'taxonomy' => $cat_tax,
                                            'field'    => 'term_id',
                                            'terms'    => $term->term_id,
                                        ),
                                    ),
                                ));
                                $term_count = count($term_posts);
                            } else {
                                $term_count = (int) $term->count;
                            }

                            // インデントクラス
                            $indent_class = $is_child ? 'c-widget__item--child' : '';

            ?>
                            <li class="c-widget__item <?php echo $indent_class; ?>">
                                <a href="<?php echo esc_url($term_link); ?>" class="c-widget__link">
                                    <?php echo esc_html($term->name); ?>
                                    <span class="c-widget__count">(<?php echo $term_count; ?>)</span>
                                </a>
                            </li>
            <?php
                        }

                        // ================================
                        // 親子ループで出力
                        // ================================
                        foreach ($term_tree as $node) {
                            $parent = $node['term'];
                            _lalabyte_render_term_item($parent, $post_type, $cat_tax, false);

                            if (!empty($node['children'])) {
                                echo '<ul class="c-widget__list c-widget__list--child">';
                                foreach ($node['children'] as $child) {
                                    _lalabyte_render_term_item($child, $post_type, $cat_tax, true);
                                }
                                echo '</ul>';
                            }
                        }
                    }
                }
            }
            ?>
        </ul>
    </div>

    <div class="c-widget c-widget--tag">
        <h3 class="c-widget__title">タグ</h3>
        <ul class="c-widget__list">
            <?php
            if ($post_type) {

                // タグ用タクソノミー
                $tag_tax = ($post_type === 'news') ? 'news_tag' : 'common_tag';

                // 投稿IDが無ければ念のため再取得（上のカテゴリーで取れていればそのまま使われます）
                if (empty($post_ids)) {
                    $post_ids = get_posts(array(
                        'post_type'      => $post_type,
                        'posts_per_page' => -1,
                        'fields'         => 'ids',
                        'post_status'    => 'publish',
                    ));
                }

                if (!empty($post_ids)) {

                    // この投稿タイプで使われているタグだけ取得
                    $tag_terms = get_terms(array(
                        'taxonomy'   => $tag_tax,
                        'hide_empty' => true,
                        'object_ids' => $post_ids,
                    ));

                    if (!is_wp_error($tag_terms) && !empty($tag_terms)) {
                        foreach ($tag_terms as $term) {

                            // --- リンクURL ---
                            if ($tag_tax === 'common_tag') {
                                // column / work / voice 用: /{post_type}/tag/{term_slug}/
                                $term_link = home_url(
                                    '/' . $post_type . '/tag/' . $term->slug . '/'
                                );
                            } else {
                                // news_tag は通常のタームリンク
                                $term_link = get_term_link($term, $tag_tax);
                                if (is_wp_error($term_link)) {
                                    continue;
                                }
                            }

                            // --- 件数：この post_type × このタグ のみ数える ---
                            if ($tag_tax === 'common_tag') {
                                $term_posts = get_posts(array(
                                    'post_type'      => $post_type,
                                    'posts_per_page' => -1,
                                    'fields'         => 'ids',
                                    'post_status'    => 'publish',
                                    'tax_query'      => array(
                                        array(
                                            'taxonomy' => $tag_tax,
                                            'field'    => 'term_id',
                                            'terms'    => $term->term_id,
                                        ),
                                    ),
                                ));
                                $term_count = is_array($term_posts) ? count($term_posts) : 0;
                            } else {
                                $term_count = (int) $term->count;
                            }
            ?>
                            <li class="c-widget__item">
                                <a href="<?php echo esc_url($term_link); ?>" class="c-widget__link">
                                    <?php echo esc_html($term->name); ?>
                                    <span class="c-widget__count">(<?php echo $term_count; ?>)</span>
                                </a>
                            </li>
            <?php
                        }
                    }
                }
            }
            ?>
        </ul>
    </div>

    <!-- 3. 人気記事 (PV数順) -->
    <div class="c-widget c-widget--popular">
        <h3 class="c-widget__title">人気記事</h3>
        <?php
        if ($post_type) :
            $popular_query = new WP_Query(array(
                'post_type'           => $post_type,
                'posts_per_page'      => 3,
                'meta_key'            => 'post_views_count',
                'orderby'             => 'meta_value_num',
                'order'               => 'DESC',
                'ignore_sticky_posts' => 1,
            ));

            if ($popular_query->have_posts()) :
                echo '<ul class="c-widget__list-posts">';
                while ($popular_query->have_posts()) :
                    $popular_query->the_post(); ?>
                    <li>
                        <a href="<?php the_permalink(); ?>">
                            <div class="c-widget__thumb">
                                <?php if (has_post_thumbnail()) the_post_thumbnail('thumbnail'); ?>
                            </div>
                            <div class="c-widget__text"><?php the_title(); ?></div>
                        </a>
                    </li>
        <?php
                endwhile;
                echo '</ul>';
            else :
                echo '<p>まだランキングはありません。</p>';
            endif;
            wp_reset_postdata();
        endif;
        ?>
    </div>

    <!-- 4. 新着記事 -->
    <div class="c-widget c-widget--new">
        <h3 class="c-widget__title">新着記事</h3>
        <?php
        if ($post_type) :
            $new_query = new WP_Query(array(
                'post_type'           => $post_type,
                'posts_per_page'      => 3,
                'ignore_sticky_posts' => 1,
            ));

            if ($new_query->have_posts()) :
                echo '<ul class="c-widget__list-posts">';
                while ($new_query->have_posts()) :
                    $new_query->the_post(); ?>
                    <li>
                        <a href="<?php the_permalink(); ?>">
                            <div class="c-widget__text"><?php the_title(); ?></div>
                            <time><?php the_time('Y.m.d'); ?></time>
                        </a>
                    </li>
        <?php
                endwhile;
                echo '</ul>';
            endif;
            wp_reset_postdata();
        endif;
        ?>
    </div>

</div>