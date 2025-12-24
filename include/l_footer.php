<!-- <div class="contact">
  <picture>
    <source media="(min-width: 768px)" srcset="<?php webp_dir() ?>/contact.png.webp" type="image/webp">
    <source media="(min-width: 768px)" srcset="<?php img_dir() ?>/contact.png">
    <source media="(max-width: 767px)" srcset="<?php webp_dir() ?>/contact.png.webp" type="image/webp">
    <source media="(max-width: 767px)" srcset="<?php img_dir() ?>/contact.png">
    <source srcset="<?php webp_dir() ?>/contact.png.webp" type="image/webp">
    <img src="<?php img_dir() ?>/contact.png" alt="問い合わせ背景">
  </picture>
</div> -->
<footer class="l-footer p-footer" data-footer>
  <div class="inner">
    <div class="logo">
      <picture>
        <source media="(min-width: 768px)" srcset="<?php webp_dir() ?>/footer_logo.png.webp" type="image/webp">
        <source media="(min-width: 768px)" srcset="<?php img_dir() ?>/footer_logo.png">
        <source media="(max-width: 767px)" srcset="<?php webp_dir() ?>/footer_logo.png.webp" type="image/webp">
        <source media="(max-width: 767px)" srcset="<?php img_dir() ?>/footer_logo.png">
        <source srcset="<?php webp_dir() ?>/footer_logo.png.webp" type="image/webp">
        <img src="<?php img_dir() ?>/footer_logo.png" alt="会社ロゴ">
      </picture>
    </div>
    <?php get_template_part('include/l_nav_fot'); ?>
  </div>


  <div class="copy_box">
    <div class="link_box">
      <a href="/privacy/" class="botlink">プライバシーポリシー</a>
      <a href="/sitemap/" class="botlink">サイトマップ</a>
    </div>
    <p class="_copy">&copy;Lalabyte</p>
  </div>
</footer>