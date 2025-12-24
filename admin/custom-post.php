<?php

/**
 * カスタム投稿タイプ
 * - news   : ニュース
 * - column : コラム
 * - work   : 事例
 * - voice  : お客様の声
 *
 * タクソノミー
 * - news_category / news_tag      : ニュース専用
 * - common_category / common_tag  : column / work / voice 共通
 */

add_action('init', 'register_custom_post_types_and_taxonomies');

function register_custom_post_types_and_taxonomies()
{

    // =========================
    // カスタム投稿タイプ
    // =========================

    // --- ニュース: news ---
    register_post_type('news', array(
        'label'               => 'ニュース',
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'query_var'           => true,
        'rewrite'             => array(
            'slug'       => 'news', // /news/xxx/
            'with_front' => false,
        ),
        'has_archive'         => 'news', // /news/
        'capability_type'     => 'post',
        'hierarchical'        => false,
        'menu_position'       => 5,
        'exclude_from_search' => false,
        'supports'            => array(
            'title',
            'editor',
            'thumbnail',
            'excerpt',
            'revisions',
            'author',
        ),
        'menu_icon'           => 'dashicons-megaphone',
        'show_in_rest'        => true,
    ));

    // --- コラム: column ---
    register_post_type('column', array(
        'label'               => 'コラム',
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'query_var'           => true,
        'rewrite'             => array(
            'slug'       => 'column', // /column/xxx/
            'with_front' => false,
        ),
        'has_archive'         => 'column', // /column/
        'capability_type'     => 'post',
        'hierarchical'        => false,
        'menu_position'       => 6,
        'exclude_from_search' => false,
        'supports'            => array(
            'title',
            'editor',
            'thumbnail',
            'excerpt',
            'revisions',
            'author',
        ),
        'menu_icon'           => 'dashicons-edit',
        'show_in_rest'        => true,
    ));

    // --- 事例: work ---
    register_post_type('work', array(
        'label'               => '事例',
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'query_var'           => true,
        'rewrite'             => array(
            'slug'       => 'work', // /work/xxx/
            'with_front' => false,
        ),
        'has_archive'         => 'work', // /work/
        'capability_type'     => 'post',
        'hierarchical'        => false,
        'menu_position'       => 7,
        'exclude_from_search' => false,
        'supports'            => array(
            'title',
            'editor',
            'thumbnail',
            'excerpt',
            'revisions',
            'author',
        ),
        'menu_icon'           => 'dashicons-portfolio',
        'show_in_rest'        => true,
    ));

    // --- お客様の声: voice ---
    register_post_type('voice', array(
        'label'               => 'お客様の声',
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'query_var'           => true,
        'rewrite'             => array(
            'slug'       => 'voice', // /voice/xxx/
            'with_front' => false,
        ),
        'has_archive'         => 'voice', // /voice/
        'capability_type'     => 'post',
        'hierarchical'        => false,
        'menu_position'       => 8,
        'exclude_from_search' => false,
        'supports'            => array(
            'title',
            'editor',
            'thumbnail',
            'excerpt',
            'revisions',
            'author',
        ),
        'menu_icon'           => 'dashicons-testimonial',
        'show_in_rest'        => true,
    ));

    // =========================
    // タクソノミー
    // =========================

    // -------------------------
    // ニュース専用タクソノミー
    // -------------------------

    // ニュースカテゴリー
    register_taxonomy(
        'news_category',
        array('news'),
        array(
            'label'        => 'ニュースカテゴリー',
            'public'       => true,
            'show_ui'      => true,
            'hierarchical' => true,
            'query_var'    => true,
            'rewrite'      => array(
                // /news/category/○○
                'slug'       => 'news/category',
                'with_front' => false,
            ),
            'show_in_rest' => true,
        )
    );

    // ニュースタグ
    register_taxonomy(
        'news_tag',
        array('news'),
        array(
            'label'        => 'ニュースタグ',
            'public'       => true,
            'show_ui'      => true,
            'hierarchical' => false,
            'query_var'    => true,
            'rewrite'      => array(
                // /news/tag/○○
                'slug'       => 'news/tag',
                'with_front' => false,
            ),
            'show_in_rest' => true,
        )
    );

    // -------------------------
    // 共通タクソノミー（column / work / voice）
    // -------------------------

    $common_post_types = array('column', 'work', 'voice');

    // 共通カテゴリー
    register_taxonomy(
        'common_category',
        $common_post_types,
        array(
            'label'        => 'カテゴリー',
            'public'       => true,
            'show_ui'      => true,
            'hierarchical' => true,
            'query_var'    => true,
            // ★ URL は自前で作るので false に
            'rewrite'      => false,
            'show_in_rest' => true,
        )
    );

    // 共通タグ
    register_taxonomy(
        'common_tag',
        $common_post_types,
        array(
            'label'        => 'タグ',
            'public'       => true,
            'show_ui'      => true,
            'hierarchical' => false,
            'query_var'    => true,
            'rewrite'      => false,
            'show_in_rest' => true,
        )
    );
}

function lalabyte_common_tax_rewrite()
{
    $post_types = array('column', 'work', 'voice');

    foreach ($post_types as $pt) {
        // カテゴリ
        add_rewrite_rule(
            '^' . $pt . '/category/([^/]+)/?$',
            'index.php?post_type=' . $pt . '&common_category=$matches[1]',
            'top'
        );

        // カテゴリ + ページング
        add_rewrite_rule(
            '^' . $pt . '/category/([^/]+)/page/([0-9]+)/?$',
            'index.php?post_type=' . $pt . '&common_category=$matches[1]&paged=$matches[2]',
            'top'
        );

        // タグ
        add_rewrite_rule(
            '^' . $pt . '/tag/([^/]+)/?$',
            'index.php?post_type=' . $pt . '&common_tag=$matches[1]',
            'top'
        );

        // タグ + ページング
        add_rewrite_rule(
            '^' . $pt . '/tag/([^/]+)/page/([0-9]+)/?$',
            'index.php?post_type=' . $pt . '&common_tag=$matches[1]&paged=$matches[2]',
            'top'
        );
    }
}
add_action('init', 'lalabyte_common_tax_rewrite');

function lalabyte_common_term_link($url, $term, $taxonomy)
{
    global $post;

    // 投稿タイプが分からない場合は何もしない（アーカイブ等の想定外対策）
    if (! $post) {
        return $url;
    }

    $pt = get_post_type($post);

    // 対象の投稿タイプだけ書き換え
    $targets = array('column', 'work', 'voice');

    if (! in_array($pt, $targets, true)) {
        return $url;
    }

    // カテゴリー
    if ($taxonomy === 'common_category') {
        $url = home_url('/' . $pt . '/category/' . $term->slug . '/');
    }

    // タグ
    if ($taxonomy === 'common_tag') {
        $url = home_url('/' . $pt . '/tag/' . $term->slug . '/');
    }

    return $url;
}
add_filter('term_link', 'lalabyte_common_term_link', 10, 3);
