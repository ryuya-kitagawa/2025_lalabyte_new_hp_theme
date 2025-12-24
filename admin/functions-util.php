<?php
function tempath()
{
  echo TEMP_DIR;
}
function home_path()
{
  echo HOME_PATH;
}

function img_dir()
{
  echo TEMP_DIR . '/assets/dist/img';
}
function webp_dir()
{
  echo TEMP_DIR . '/assets/dist/webp';
}
function img_dir_str()
{
  return TEMP_DIR . '/assets/dist/img';
}

function css_dir()
{
  echo TEMP_DIR . '/assets/dist/css';
}
function js_dir()
{
  echo TEMP_DIR . '/assets/dist/js';
}
function vendor_dir()
{
  echo TEMP_DIR . '/assets/dist/vendor';
}
function files_dir()
{
  echo TEMP_DIR . '/assets/dist/files';
}
function video_dir()
{
  echo TEMP_DIR . '/assets/dist/video';
}

function get_page_settings()
{
  return array(
    'user-voice' => ['slug' => 'user-voice', 'temp_dir' => 'contents/page/voice', 'name' => 'voice'],
    'about'      => ['slug' => 'about', 'temp_dir' => 'contents/page/about', 'name' => 'about'],
    'price'      => ['slug' => 'price', 'temp_dir' => 'contents/page/price', 'name' => 'price'],
    'flow'       => ['slug' => 'flow', 'temp_dir' => 'contents/page/flow', 'name' => 'flow'],
    'qa'         => ['slug' => 'qa', 'temp_dir' => 'contents/page/qa', 'name' => 'qa'],
    'sitemap'    => ['slug' => 'sitemap', 'temp_dir' => 'contents/page/sitemap', 'name' => 'sitemap'],
    'area'       => ['slug' => 'area', 'temp_dir' => 'contents/page/areaa', 'name' => 'area']
  );
}

function get_page_url_by_name($name)
{
  $settings = get_page_settings();
  foreach ($settings as $setting) {
    if ($setting['name'] === $name) {
      return home_url($setting['slug']);
    }
  }
  return home_url();
}

function get_template_dir_by_slug($slug)
{
  $settings = get_page_settings();
  return isset($settings[$slug]) ? $settings[$slug]['temp_dir'] : false;
}

function pagination($pages = '', $range = 5)
{
  $showitems = ($range * 1) + 1;
  global $paged;
  if (empty($paged)) $paged = 1;

  if ($pages == '') {
    global $wp_query;
    $pages = $wp_query->max_num_pages ?: 1;
  }

  // ★ ここを修正 → 1ページでも表示する
  if ($pages >= 1) {
    echo "<div class=\"c-pagination\">";

    // if ($paged != 1) {
    //   echo "<a href='" . esc_url(get_pagenum_link(1)) . "' class=\"most_left_arrow\" ></a>";
    // }

    // if ($paged > 1) {
    //   echo "<a href='" . esc_url(get_pagenum_link($paged - 1)) . "' class=\"left_arrow\" ></a>";
    // }

    echo "<ul class=\"nums\">\n";

    if ($pages >= 5) {
      $i_ini = max(1, $paged - 2);
      $cnt = 0;
      for ($i = $i_ini; $cnt < 5 && $i <= $pages; $i++) {
        $cnt++;
        if ($paged == $i) {
          echo "<li class=\"u_osw current\">$i</li>";
        } else {
          echo "<li class=\"u_osw\"><a href='" . esc_url(get_pagenum_link($i)) . "'>$i</a></li>";
        }
      }
    } else {
      for ($i = 1; $i <= $pages; $i++) {
        if ($paged == $i) {
          echo "<li class=\"u_osw current\">$i</li>";
        } else {
          echo "<li class=\"u_osw\"><a href='" . esc_url(get_pagenum_link($i)) . "'>$i</a></li>";
        }
      }
    }

    echo "</ul>\n";

    if ($paged < $pages) {
      // echo "<a href='" . esc_url(get_pagenum_link($paged + 1)) . "' class=\"right_arrow\"></a>";
      // echo "<a href='" . esc_url(get_pagenum_link($pages)) . "' class=\"most_right_arrow\" ></a>";
    }

    echo "</div>\n";
  }
}

function get_related_posts_by_category($post_id = null, $limit = -1, $post_type = null, $taxonomy = null)
{
  if (!$post_id) {
    $post_id = get_the_ID();
  }

  if (!$post_type) {
    $post_type = get_post_type($post_id);
  }

  if (!$taxonomy) {
    // 投稿タイプごとに使用するカテゴリーを設定
    $default_taxonomies = [
      'post'    => 'category',
      'column'  => 'column_category',
      'example' => 'custom_category',
    ];
    $taxonomy = $default_taxonomies[$post_type] ?? 'category';
  }

  $terms = get_the_terms($post_id, $taxonomy);
  if (!$terms || is_wp_error($terms)) return null;

  $term_ids = wp_list_pluck($terms, 'term_id');

  $args = [
    'post_type'      => $post_type,
    'posts_per_page' => $limit, // 無限取得（全件）
    'post__not_in'   => [$post_id],
    'orderby'        => 'rand',
    'tax_query'      => [[
      'taxonomy' => $taxonomy,
      'field'    => 'term_id',
      'terms'    => $term_ids,
    ]],
  ];

  return new WP_Query($args);
}

// 対象とする投稿タイプ
$custom_post_types = ['area', 'example', 'voice'];

// カラム追加
foreach ($custom_post_types as $post_type) {
  add_filter("manage_{$post_type}_posts_columns", function ($columns) {
    $columns['custom_category'] = 'エリア分類';
    return $columns;
  });
}

// カラム出力
foreach ($custom_post_types as $post_type) {
  add_action("manage_{$post_type}_posts_custom_column", function ($column_name, $post_id) {
    if ($column_name === 'custom_category') {
      $terms = get_the_terms($post_id, 'custom_category');
      if (!empty($terms) && !is_wp_error($terms)) {
        echo esc_html(implode(', ', wp_list_pluck($terms, 'name')));
      } else {
        echo '—';
      }
    }
  }, 10, 2);
}
/**
 * singular 'area' 投稿の本文出力前に自動 <p>（wpautop）を削除
 * ※Priority を 9 にして、wpautop(10) より先に実行します
 */
add_filter('the_content', 'disable_wpautop_for_area', 9);
function disable_wpautop_for_area($content)
{
  if (is_singular('area') && in_the_loop()) {
    remove_filter('the_content', 'wpautop');
  }
  return $content;
}
/**
 * Yoast SEO のデフォルトセパレーターを全角縦棒に変更
 */
add_filter('wpseo_separator_options', function ($options) {
  // $options は ['name' => '–', 'key' => 'dash', 'sep' => '–'] のような配列です
  $options['sep'] = '｜';  // 全角縦棒をセット
  return $options;
});
add_filter('wpseo_title', 'clean_wpseo_title_spacing');
function clean_wpseo_title_spacing($title)
{
  // 「で」の前のスペース（半角・全角）を削除
  $title = preg_replace('/[ 　]+(?=で)/u', '', $title);

  // 「｜」の後のスペース（半角・全角）を削除
  $title = preg_replace('/｜[ 　]+/u', '｜', $title);

  return trim($title);
}
/**
 * テーマ機能のセットアップ
 */

// 既存のカスタム投稿タイプ定義（custom-post.php）はここで読み込まれている前提、
// もしくはこのファイルに記述されているものとします。
// require_once get_template_directory() . '/custom-post.php';

/**
 * 記事のアクセス数を保存（人気記事用）
 * single.phpのループ内で呼び出します
 */
function set_post_views($postID)
{
  $count_key = 'post_views_count';
  $count = get_post_meta($postID, $count_key, true);
  if ($count == '') {
    $count = 0;
    delete_post_meta($postID, $count_key);
    add_post_meta($postID, $count_key, '0');
  } else {
    $count++;
    update_post_meta($postID, $count_key, $count);
  }
}

/**
 * 現在の投稿タイプを取得するヘルパー
 */
function get_current_post_type()
{
  $post_type = get_post_type();
  if (is_tax()) {
    $term = get_queried_object();
    // タクソノミーから投稿タイプを推測（共通タクソノミーの場合の対応）
    // ※厳密にはget_taxonomy($term->taxonomy)->object_type[0]などを参照
    $taxonomy = get_taxonomy($term->taxonomy);
    if (!empty($taxonomy->object_type)) {
      $post_type = $taxonomy->object_type[0];
    }
  }
  return $post_type;
}

/**
 * 投稿タイプごとのラベル名を取得
 */
function get_post_type_label_name()
{
  $pt = get_post_type_object(get_current_post_type());
  return $pt ? $pt->label : '';
}

/**
 * 画像ディレクトリパスのショートコード的関数（既存コード互換）
 * 既存環境での二重定義エラーを防ぐため function_exists でチェックします
 */
if (! function_exists('img_dir')) {
  function img_dir()
  {
    echo get_template_directory_uri() . '/assets/images';
  }
}

if (! function_exists('webp_dir')) {
  function webp_dir()
  {
    echo get_template_directory_uri() . '/assets/images/webp';
  }
}


add_filter('upload_mimes', function ($mimes) {
  $mimes['zip'] = 'application/zip';
  return $mimes;
});


/**
 * 共通ページネーション出力
 *
 * @param WP_Query|null $query 対象クエリ（未指定ならメインクエリ）
 */
function render_pagination($query = null)
{

  if (! $query) {
    global $wp_query;
    $query = $wp_query;
  }

  // ページが1ページしかない場合は表示しない
  if ($query->max_num_pages <= 1) {
    return;
  }

  $paged = max(1, get_query_var('paged'));

  echo '<div class="c-pagination">';
  echo paginate_links([
    'base'      => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
    'format'    => '?paged=%#%',
    'current'   => $paged,
    'total'     => $query->max_num_pages,
    'mid_size'  => 2,
    'prev_text' => '&lt;',
    'next_text' => '&gt;',
    'type'      => 'list',
  ]);
  echo '</div>';
}
