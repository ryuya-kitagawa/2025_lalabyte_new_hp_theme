<!DOCTYPE html>
<html lang="ja">

<head>
  <!-- Google Tag Manager（遅延読み込み） -->
  <script>
    // GTMを遅延読み込み（ページ読み込み後に実行）
    window.addEventListener('load', function() {
      (function(w, d, s, l, i) {
        w[l] = w[l] || [];
        w[l].push({
          'gtm.start': new Date().getTime(),
          event: 'gtm.js'
        });
        var f = d.getElementsByTagName(s)[0],
          j = d.createElement(s),
          dl = l != 'dataLayer' ? '&l=' + l : '';
        j.async = true;
        j.src = 'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
        f.parentNode.insertBefore(j, f);
      })(window, document, 'script', 'dataLayer', 'GTM-WH8ZHXQQ');
    });
  </script>
  <!-- End Google Tag Manager -->
  <meta charset="UTF-8">
  <title>title</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="format-detection" content="telephone=no">
  <link rel="icon" href="<?php img_dir() ?>/favicon.svg" type="image/svg+xml">
  <link rel="apple-touch-icon" href="<?php img_dir() ?>/favicon.svg">
  <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <?php get_template_part('include/css'); ?>
  <?php wp_head(); ?>
  
  <?php
  // LCP画像のpreload（homepageページの場合）
  if (is_page('homepage')) {
    $lcp_image = get_template_directory_uri() . '/assets/dist/webp/homepage_mv.png.webp';
    echo '<link rel="preload" as="image" href="' . esc_url($lcp_image) . '" fetchpriority="high">';
  }
  ?>

</head>

<body>
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WH8ZHXQQ"
      height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->