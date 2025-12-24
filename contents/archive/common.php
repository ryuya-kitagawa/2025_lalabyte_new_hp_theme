<?php

/**
 * 共通アーカイブテンプレート
 * page.phpの構造に合わせて修正
 */
global $post;
get_header();

/**
 * post_type 判定
 * - 共通タクソノミー（common_category / common_tag）のときは
 *   rewrite で付与した post_type をクエリから取得
 * - それ以外はアーカイブ／シングルに応じて取得
 */
if (is_tax('common_category') || is_tax('common_tag')) {
    $post_type = get_query_var('post_type');

    if (is_array($post_type)) {
        $post_type = reset($post_type);
    }
} elseif (is_post_type_archive()) {
    $post_type = get_query_var('post_type');
} elseif (is_singular()) {
    $post_type = get_post_type();
} else {
    // 最後の保険として独自ヘルパー or get_post_type()
    $post_type = function_exists('get_current_post_type')
        ? get_current_post_type()
        : get_post_type();
}

$post_type = (string) $post_type;

/**
 * 表示用ラベル
 * - 必要に応じてマップを調整
 */
$labels_map = array(
    'column' => 'コラム',
    'work'   => '制作実績',
    'voice'  => 'お客様の声',
    'news'   => 'お知らせ',
);

if (isset($labels_map[$post_type])) {
    $post_type_label = $labels_map[$post_type];
} else {
    $obj = get_post_type_object($post_type);
    $post_type_label = $obj ? $obj->labels->singular_name : '';
}

// ページ独自のクラス（page.phpの仕様に合わせる）
$page_slug = 'archive-' . $post_type;
?>

<div class="p-<?php echo esc_attr($page_slug); ?>">

    <?php get_template_part('include/l_header'); ?>
    <!-- l_header -->

    <div class="l-wrapper">
        <main class="l-main">
            <div class="l-contents">

                <?php
                /* --- メインビジュアル --- */
                ?>
                <section class="l-lower-mv">
                    <picture>
                        <!-- 画像ファイル名は posttype_mv.png を想定 -->
                        <source media="(min-width: 768px)" srcset="<?php webp_dir() ?>/<?= $post_type ?>_mv.png.webp" type="image/webp">
                        <source media="(min-width: 768px)" srcset="<?php img_dir() ?>/<?= $post_type ?>_mv.png">
                        <source media="(max-width: 767px)" srcset="<?php webp_dir() ?>/<?= $post_type ?>_mv.png.webp" type="image/webp">
                        <source media="(max-width: 767px)" srcset="<?php img_dir() ?>/<?= $post_type ?>_mv.png">
                        <source srcset="<?php webp_dir() ?>/<?= $post_type ?>_mv.png.webp" type="image/webp">
                        <img src="<?php img_dir() ?>/<?= $post_type ?>_mv.png" alt="<?php echo esc_attr($post_type_label); ?>メインビジュアル">
                    </picture>
                    <h1 class="u_head_ttl_01">
                        <span class="en"><?php echo strtoupper($post_type); ?></span><br>
                        <?php if (is_tax()): ?>
                            <span class="ja"><?php single_term_title(); ?></span>
                        <?php else: ?>
                            <span class="ja"><?php echo esc_html($post_type_label); ?>一覧</span>
                        <?php endif; ?>
                    </h1>
                </section>

                <?php get_template_part('include/breadcrumb'); ?>

                <div class="l-two-column">
                    <!-- メインカラム -->
                    <div class="l-two-column__main">

                        <?php if (have_posts()) : ?>
                            <div class="c-post-list c-post-list--grid  c-post-list--<?php echo esc_attr($post_type); ?>">
                                <?php while (have_posts()) : the_post(); ?>

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
                                                <div class="c-post-card__meta">
                                                    <time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y.m.d'); ?></time>
                                                    <?php
                                                    $tax_name = ($post_type === 'news') ? 'news_category' : 'common_category';
                                                    $terms = get_the_terms(get_the_ID(), $tax_name);
                                                    if ($terms && !is_wp_error($terms)):
                                                        foreach ($terms as $term):
                                                    ?>
                                                            <span class="c-label"><?php echo esc_html($term->name); ?></span>
                                                    <?php
                                                        endforeach;
                                                    endif;
                                                    ?>
                                                </div>
                                                <h2 class="c-post-card__title"><?php the_title(); ?></h2>
                                            </div>
                                        </a>
                                    </article>

                                <?php endwhile; ?>
                            </div>

                            <?php render_pagination(); ?>
                        <?php else : ?>
                            <p>記事が見つかりませんでした。</p>
                        <?php endif; ?>
                    </div>

                    <!-- サイドバー -->
                    <aside class="l-two-column__side">
                        <?php get_template_part('include/l_sidebar'); ?>
                    </aside>
                </div><!-- /.l-two-column -->

            </div><!-- /.l-contents -->
        </main><!-- /.l-main -->
    </div><!-- /.l-wrapper -->

    <?php get_template_part('include/l_footer'); ?>
    <!-- l_footer -->

</div>
<!-- l_container -->

<?php get_footer(); ?>