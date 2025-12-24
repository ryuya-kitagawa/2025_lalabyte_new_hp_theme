<?php
// アイキャッチ
add_theme_support('post-thumbnails');

// 定数定義
define('TEMP_DIR', esc_url(get_template_directory_uri()));
define('HOME_PATH', esc_url(get_home_url()));

// Gutenberg CSS除去（使用してない場合）
add_action('wp_enqueue_scripts', 'remove_block_library_style');
function remove_block_library_style()
{
  wp_dequeue_style('wp-block-library');
  wp_dequeue_style('wp-block-library-theme');
}

add_image_size('size_name', 500, 500);
