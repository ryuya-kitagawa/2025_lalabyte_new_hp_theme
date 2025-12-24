<?php

/**
 * アーカイブ・タクソノミー共通のルーター
 * page.phpの構造に準拠したテンプレートを呼び出します
 */

// タクソノミーアーカイブ時の post_type をクエリから取得
$post_type = get_query_var('post_type');

// 万が一配列で来た場合（複数 post_type 指定など）は先頭を採用
if (is_array($post_type)) {
    $post_type = reset($post_type);
}


if (locate_template($template_slug . '.php')) {
    get_template_part($template_slug);
} else {
    get_template_part('contents/archive/common');
}
