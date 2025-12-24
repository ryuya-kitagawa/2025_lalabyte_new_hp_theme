<?php

/**
 * シングルページのルーター
 */

$post_type = get_query_var('post_type');

// 人気記事用のカウントアップ
set_post_views(get_the_ID());

// 読み込むテンプレートファイル名
$template_slug = 'contents/single/' . $post_type;

if (locate_template($template_slug . '.php')) {
    get_template_part($template_slug);
} else {
    get_template_part('contents/single/common');
}
