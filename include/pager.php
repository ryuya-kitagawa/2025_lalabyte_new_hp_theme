<?php
global $post;

$post_type   = get_post_type($post);
$archive_url = get_post_type_archive_link($post_type);

$prev_post = get_adjacent_post(false, '', true);  // 前の記事
$next_post = get_adjacent_post(false, '', false); // 次の記事
?>

<nav class="c-post-pager">
    <?php if ($prev_post) : ?>
        <a href="<?php echo get_permalink($prev_post->ID); ?>" class="c-post-pager__item c-post-pager__item--prev">
            <span class="c-post-pager__label">前の記事</span>
            <span class="c-post-pager__title"><?php echo esc_html(get_the_title($prev_post->ID)); ?></span>
        </a>
    <?php else : ?>
        <span class="c-post-pager__item c-post-pager__item--prev is-disabled">
            <span class="c-post-pager__label">前の記事</span>
            <span class="c-post-pager__title">これより前の記事はありません</span>
        </span>
    <?php endif; ?>

    <?php if ($archive_url) : ?>
        <a href="<?php echo esc_url($archive_url); ?>" class="c-post-pager__item c-post-pager__item--archive">
            <span class="c-post-pager__label">一覧</span>
            <span class="c-post-pager__title">
                <?php echo esc_html(get_post_type_object($post_type)->labels->name); ?>一覧
            </span>
        </a>
    <?php endif; ?>

    <?php if ($next_post) : ?>
        <a href="<?php echo get_permalink($next_post->ID); ?>" class="c-post-pager__item c-post-pager__item--next">
            <span class="c-post-pager__label">次の記事</span>
            <span class="c-post-pager__title"><?php echo esc_html(get_the_title($next_post->ID)); ?></span>
        </a>
    <?php else : ?>
        <span class="c-post-pager__item c-post-pager__item--next is-disabled">
            <span class="c-post-pager__label">次の記事</span>
            <span class="c-post-pager__title">これより新しい記事はありません</span>
        </span>
    <?php endif; ?>
</nav>