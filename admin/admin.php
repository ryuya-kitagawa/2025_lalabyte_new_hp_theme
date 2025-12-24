<?php

// 投稿を削除（管理画面から）
function my_remove_menus()
{
  remove_menu_page('edit.php');
}
add_action('admin_menu', 'my_remove_menus');

// 固定ページ一覧にスラッグを表示
function add_page_columns_name($columns)
{
  $columns['slug'] = "スラッグ";
  return $columns;
}
function add_page_column($column_name, $post_id)
{
  if ($column_name == 'slug') {
    $post = get_post($post_id);
    echo esc_html($post->post_name);
  }
}
add_filter('manage_pages_columns', 'add_page_columns_name');
add_action('manage_pages_custom_column', 'add_page_column', 10, 2);


add_action('transition_post_status', 'myfunction', 10, 3);
function myfunction($new_status, $old_status, $post)
{
  $to = "送信先メールアドレス";
  $subject = "件名";
  $body = "本文";
  $headers[] = "Cc: cc@example.com";
  wp_mail($to, $subject, $body, $headers);
}
