<?php get_header(); ?>

<div class="p-top">

  <?php get_template_part('include/l_header'); ?>
  <!-- l_header -->

  <div class="l-wrapper">

    <main class="l-main">

      <div class="l-contents">
        <section class="l-mv">
          <picture>
            <source media="(min-width: 768px)" srcset="<?php webp_dir() ?>/logobig.png.webp" type="image/webp">
            <source media="(min-width: 768px)" srcset="<?php img_dir() ?>/logobig.png">
            <source media="(max-width: 767px)" srcset="<?php webp_dir() ?>/logobig.png.webp" type="image/webp">
            <source media="(max-width: 767px)" srcset="<?php img_dir() ?>/logobig.png">
            <source srcset="<?php webp_dir() ?>/logobig.png.webp" type="image/webp">
            <img src="<?php img_dir() ?>/logobig.png" alt="会社ロゴ">
          </picture>
          <p class="mv-strong-txt">伝わらないを整える<br class="u-sp">はじめてでもやさしいIT</p>
          <p class="mv-strong-txt2">WEB × MARKTING × SCHOOL</p>
        </section>

        <?php get_template_part('include/news'); ?>

        <section class="l-sec l-about">
          <a class="link_box" href="/about/">
            <picture>
              <source media="(min-width: 768px)" srcset="<?php webp_dir() ?>/top_about_img.png.webp" type="image/webp">
              <source media="(min-width: 768px)" srcset="<?php img_dir() ?>/top_about_img.png">
              <source media="(max-width: 767px)" srcset="<?php webp_dir() ?>/top_about_img.png.webp" type="image/webp">
              <source media="(max-width: 767px)" srcset="<?php img_dir() ?>/top_about_img.png">
              <source srcset="<?php webp_dir() ?>/top_about_img.png.webp" type="image/webp">
              <img src="<?php img_dir() ?>/top_about_img.png" alt="aboutusイメージ画像">
            </picture>
            <h2 class="_abs_txt">
              <span class="en">ABOUT US</span><br>
              <span class="ja">Lalabyteについて</span>
            </h2>
          </a>
        </section>

        <section class="l-sec l-service">
          <h2 class="u_head_ttl_02">
            <span class="en">SERVICE</span><br>
            <span class="ja">サービス一覧</span>
          </h2>
          <div class="service_list">
            <a href="/service/homepage/" class="service __service01">
              <picture>
                <source media="(min-width: 768px)" srcset="<?php webp_dir() ?>/service01.png.webp" type="image/webp">
                <source media="(min-width: 768px)" srcset="<?php img_dir() ?>/service01.png">
                <source media="(max-width: 767px)" srcset="<?php webp_dir() ?>/service01.png.webp" type="image/webp">
                <source media="(max-width: 767px)" srcset="<?php img_dir() ?>/service01.png">
                <source srcset="<?php webp_dir() ?>/service01.png.webp" type="image/webp">
                <img src="<?php img_dir() ?>/service01.png" alt="サービスバナー ホームページ制作 ブランド設計">
              </picture>
            </a>
            <a href="/service/marketing/" class="service __service02">
              <picture>
                <source media="(min-width: 768px)" srcset="<?php webp_dir() ?>/service02.png.webp" type="image/webp">
                <source media="(min-width: 768px)" srcset="<?php img_dir() ?>/service02.png">
                <source media="(max-width: 767px)" srcset="<?php webp_dir() ?>/service02.png.webp" type="image/webp">
                <source media="(max-width: 767px)" srcset="<?php img_dir() ?>/service02.png">
                <source srcset="<?php webp_dir() ?>/service02.png.webp" type="image/webp">
                <img src="<?php img_dir() ?>/service02.png" alt="サービスバナー マーケティング支援 SEO・MEO・AIO">
              </picture>
            </a>
            <a href="/service/teaching/" class="service __service03">
              <picture>
                <source media="(min-width: 768px)" srcset="<?php webp_dir() ?>/service03.png.webp" type="image/webp">
                <source media="(min-width: 768px)" srcset="<?php img_dir() ?>/service03.png">
                <source media="(max-width: 767px)" srcset="<?php webp_dir() ?>/service03.png.webp" type="image/webp">
                <source media="(max-width: 767px)" srcset="<?php img_dir() ?>/service03.png">
                <source srcset="<?php webp_dir() ?>/service03.png.webp" type="image/webp">
                <img src="<?php img_dir() ?>/service03.png" alt="サービスバナー プログラミング教室 スキル育成">
              </picture>
            </a>
            <a href="/service/consulting/" class="service __service04">
              <picture>
                <source media="(min-width: 768px)" srcset="<?php webp_dir() ?>/service04.png.webp" type="image/webp">
                <source media="(min-width: 768px)" srcset="<?php img_dir() ?>/service04.png">
                <source media="(max-width: 767px)" srcset="<?php webp_dir() ?>/service04.png.webp" type="image/webp">
                <source media="(max-width: 767px)" srcset="<?php img_dir() ?>/service04.png">
                <source srcset="<?php webp_dir() ?>/service04.png.webp" type="image/webp">
                <img src="<?php img_dir() ?>/service04.png" alt="サービスバナー DX支援 業務改善サポート">
              </picture>
            </a>
          </div>
        </section>

        <?php get_template_part('include/work'); ?>
        <?php get_template_part('include/column'); ?>

      </div>
    </main>
    <!-- l_main -->

  </div>
  <!-- l_wrapper -->

  <?php get_template_part('include/l_footer'); ?>
  <!-- l_footer -->

</div>
<!-- l_container -->

<?php get_footer(); ?>