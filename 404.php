<?php
global $post;
get_header(); ?>

<div class="p-404">

  <?php get_template_part('include/l_header'); ?>
  <!-- l_header -->

  <div class="l-wrapper">

    <main class="l-main">
      <div class="l-contents">
        <section class="l-lower-mv">
          <picture>
            <source media="(min-width: 768px)" srcset="<?php webp_dir() ?>/404_mv.png.webp" type="image/webp">
            <source media="(min-width: 768px)" srcset="<?php img_dir() ?>/404_mv.png">
            <source media="(max-width: 767px)" srcset="<?php webp_dir() ?>/404_mv.png.webp" type="image/webp">
            <source media="(max-width: 767px)" srcset="<?php img_dir() ?>/404_mv.png">
            <source srcset="<?php webp_dir() ?>/404_mv.png.webp" type="image/webp">
            <img src="<?php img_dir() ?>/404_mv.png" alt="404メインビジュアル">
          </picture>
          <h1 class="u_head_ttl_01">
            <span class="en">404 NOT FOUND</span><br>
            <span class="ja">お探しのページは削除された、<br class="u-sp">またはURLが誤っています。</span>
          </h1>
        </section>

        <?php get_template_part('include/breadcrumb'); ?>

        <section class="l-sec l-404">
          <h1 class="p404-title">ページが見つかりません</h1>
          <p class="p404-text">お探しのページは削除された、またはURLが誤っています。</p>
          <a href="<?php echo home_url(); ?>" class="p404-link">トップへ戻る</a>
        </section>
      </div>
    </main>
    <!-- l_main -->

  </div>
  <!-- l_wrapper -->

  <?php get_template_part('include/l_footer'); ?>
  <!-- l_footer -->

</div>
<!-- l_container -->

<script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "WebPage",
    "name": "ページが見つかりません",
    "description": "404 Not Found"
  }
</script>

<?php get_footer(); ?>