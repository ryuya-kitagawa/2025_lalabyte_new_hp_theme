<section class="l-lower-mv">
    <?php
    global $post;

    // ==============================
    // MV用のスラッグを決める
    // ==============================
    $mv_slug = '';

    if (is_singular() && $post && is_object($post)) {
        // 投稿 / 固定ページ / カスタム投稿（single-xxx.php）
        $mv_slug = $post->post_name;
    } elseif (is_post_type_archive()) {
        // カスタム投稿タイプのアーカイブ（archive-xxx.php）
        $mv_slug = get_post_type(); // 例：work → work_mv.png
    } elseif (is_tax() || is_category() || is_tag()) {
        // タクソノミーアーカイブ（必要なら）
        $term = get_queried_object();
        if ($term && ! is_wp_error($term)) {
            $mv_slug = $term->slug;
        }
    }

    // 念のためエスケープ
    $mv_slug = esc_attr($mv_slug);
    ?>

    <?php if ($mv_slug) : ?>
        <picture>
            <source media="(min-width: 768px)" srcset="<?php webp_dir(); ?>/<?= $mv_slug; ?>_mv.png.webp" type="image/webp">
            <source media="(min-width: 768px)" srcset="<?php img_dir(); ?>/<?= $mv_slug; ?>_mv.png">
            <source media="(max-width: 767px)" srcset="<?php webp_dir(); ?>/<?= $mv_slug; ?>_mv.png.webp" type="image/webp">
            <source media="(max-width: 767px)" srcset="<?php img_dir(); ?>/<?= $mv_slug; ?>_mv.png">
            <source srcset="<?php webp_dir(); ?>/<?= $mv_slug; ?>_mv.png.webp" type="image/webp">
            <img src="<?php img_dir(); ?>/<?= $mv_slug; ?>_mv.png" alt="<?= $mv_slug; ?>メインビジュアル">
        </picture>
    <?php endif; ?>

    <h1 class="u_head_ttl_01">
        <span class="en"><?php the_title(); ?></span>

        <?php if (!is_page('author-box-install-manual')) : ?>
            <br>
            <span class="ja">
                <?php
                $mv_subtitle = get_post_meta(get_the_ID(), 'mv_subtitle', true);
                if (! $mv_subtitle) {
                    $mv_subtitle = get_the_excerpt();
                }
                echo esc_html($mv_subtitle);
                ?>
            </span>
        <?php endif; ?>
    </h1>

</section>