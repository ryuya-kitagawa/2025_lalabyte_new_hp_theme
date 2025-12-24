<?php

/**
 * アーカイブ・タクソノミー共通のルーター
 * page.phpの構造に準拠したテンプレートを呼び出します
 */

$post_type = get_current_post_type();

// 読み込むテンプレートファイル名
// 例: newsなら templates/archive/news.php
//     ファイルがない場合は templates/archive/common.php を使用
$template_slug = 'contents/archive/' . $post_type;

if (locate_template($template_slug . '.php')) {
  get_template_part($template_slug);
} else {
  get_template_part('contents/archive/common');
}
