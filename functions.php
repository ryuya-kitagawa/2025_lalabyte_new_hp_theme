<?php
$includes = [
  'admin/init.php',
  // 'admin/login.php',
  'admin/admin.php',
  'admin/custom-post.php',
  'admin/functions-util.php',
  'admin/performance.php',
];

foreach ($includes as $file) {
  if (file_exists(get_theme_file_path($file))) {
    require_once get_theme_file_path($file);
  }
}

// All-in-One WP Migration: node_modulesを除外
add_filter('ai1wm_exclude_content_from_export', function ($exclude_filters) {
  // テーマフォルダ内のnode_modulesを除外
  $exclude_filters[] = 'themes/' . get_template() . '/node_modules';
  return $exclude_filters;
});

// テーマ固有の除外設定（より確実な方法）
add_filter('ai1wm_exclude_themes_from_export', function ($exclude_filters) {
  $exclude_filters[] = 'node_modules';
  $exclude_filters[] = 'package.json';
  $exclude_filters[] = 'package-lock.json';
  $exclude_filters[] = 'vite.config.js';
  $exclude_filters[] = 'postcss.config.js';
  $exclude_filters[] = '.git';
  $exclude_filters[] = '.gitignore';
  return $exclude_filters;
});

// コラム・ニュースのアーカイブを最終更新日で並び替え
add_action('pre_get_posts', function ($query) {
  if (!is_admin() && $query->is_main_query()) {
    // アーカイブページ（カスタム投稿タイプのアーカイブ）
    if ($query->is_post_type_archive(array('column', 'news'))) {
      $query->set('orderby', 'modified');
      $query->set('order', 'DESC');
    }
    // タクソノミーページ（カテゴリー・タグ）
    if ($query->is_tax(array('common_category', 'common_tag', 'news_category', 'news_tag'))) {
      $query->set('orderby', 'modified');
      $query->set('order', 'DESC');
    }
  }
});
