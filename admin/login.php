<?php
// ログイン画面のロゴを変更（テーマ直下）
function custom_login_logo()
{
  echo '
  <style type="text/css">
      #login h1 a {
          background-image: url(' . get_template_directory_uri() . '/login/image.png);
          background-size: contain;
          width: 100%;
          height: 80px;
      }
  </style>
  ';
}
add_action('login_head', 'custom_login_logo');

// ロゴリンク先をトップへ
function custom_login_logo_url()
{
  return home_url();
}
add_filter('login_headerurl', 'custom_login_logo_url');

// ロゴの title 属性
function custom_login_logo_url_title()
{
  return get_bloginfo('name'); // "サイトタイトル" を動的に
}
add_filter('login_headertitle', 'custom_login_logo_url_title');

// ログイン画面の背景（テーマ直下）
function custom_login_background()
{
  echo '
  <style type="text/css">
      body.login {
          background-image: url(' . get_template_directory_uri() . '/images/login-background.jpg);
          background-size: cover;
          background-repeat: no-repeat;
          background-position: center center;
          background-color: #2c2c2c;
      }
      #login {
          width: 460px;
          background: rgba(255, 255, 255, 1);
          padding: 50px 100px;
          border-radius: 10px;
          margin: 150px auto 0;
      }
      #loginform {
          border: none;
          box-shadow: none;
      }
      #language-switcher {
          color: #fff;
      }
  </style>
  ';
}
add_action('login_head', 'custom_login_background');
