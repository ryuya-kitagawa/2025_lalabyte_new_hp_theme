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
  <!-- 相談誘導ブロック -->
  <section class="l-footer-cta">
    <div class="l-footer-cta__inner">
      <h2 class="l-footer-cta__title">迷ったら無料相談</h2>
      <p class="l-footer-cta__description">どのサービスがご自身の課題に最適か、まずはお気軽にご相談ください。一緒に最適な解決策を考えます。</p>
      <div class="l-footer-cta__buttons">
        <a href="/contact/" class="c-btn c-btn--large c-btn--primary">
          <i class="fa-solid fa-envelope"></i>
          お問い合わせ
        </a>
      </div>
    </div>
  </section>

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