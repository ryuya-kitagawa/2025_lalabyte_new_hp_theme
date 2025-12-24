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
            <span class="ja">サービス</span>
          </h2>
          <div class="l-service__intro">
            <p class="l-service__intro-question">こんなことで困っていませんか？</p>
            <p class="l-service__intro-sub">あなたの課題に寄り添う、4つのアプローチ</p>
          </div>
          <div class="c-service-grid">
            <article class="c-service-card c-service-card--01">
              <a href="/service/homepage/" class="c-service-card__link">
                <div class="c-service-card__image">
                  <picture>
                    <source srcset="<?php webp_dir() ?>/service_homepage.png.webp" type="image/webp">
                    <img src="<?php img_dir() ?>/service_homepage.png" 
                         alt="Web制作サービス"
                         width="800"
                         height="480"
                         loading="lazy"
                         decoding="async"
                         fetchpriority="high">
                  </picture>
                </div>
                <div class="c-service-card__number">01</div>
                <div class="c-service-card__content">
                  <div class="c-service-card__header">
                    <span class="c-service-card__category">Web / Homepage</span>
                    <h3 class="c-service-card__question">
                      <span class="c-service-card__quote">「</span>
                      作ったけど、思うように届かない
                      <span class="c-service-card__quote">」</span>
                    </h3>
                  </div>
                  <div class="c-service-card__divider"></div>
                  <p class="c-service-card__desc">
                    見た目だけでなく、設計・導線・成果を重視したWeb制作。デザイン重視ではなく「成果が出る仕組み」を一緒に考えます。
                  </p>
                  <div class="c-service-card__footer">
                    <span class="c-service-card__more">続きを読む</span>
                  </div>
                </div>
              </a>
            </article>

            <article class="c-service-card c-service-card--02">
              <a href="/service/marketing/" class="c-service-card__link">
                <div class="c-service-card__image">
                  <picture>
                    <source srcset="<?php webp_dir() ?>/service_marketing.png.webp" type="image/webp">
                    <img src="<?php img_dir() ?>/service_marketing.png" 
                         alt="マーケティングサービス"
                         width="800"
                         height="480"
                         loading="lazy"
                         decoding="async"
                         fetchpriority="high">
                  </picture>
                </div>
                <div class="c-service-card__number">02</div>
                <div class="c-service-card__content">
                  <div class="c-service-card__header">
                    <span class="c-service-card__category">Marketing / 集客</span>
                    <h3 class="c-service-card__question">
                      <span class="c-service-card__quote">「</span>
                      サイトはあるけど、見てもらえない
                      <span class="c-service-card__quote">」</span>
                    </h3>
                  </div>
                  <div class="c-service-card__divider"></div>
                  <p class="c-service-card__desc">
                    SEO・MEO・集客設計まで一貫支援。デザインだけで終わらない、継続的に集客できる仕組みづくりを。
                  </p>
                  <div class="c-service-card__footer">
                    <span class="c-service-card__more">続きを読む</span>
                  </div>
                </div>
              </a>
            </article>

            <article class="c-service-card c-service-card--03">
              <a href="/service/teaching/" class="c-service-card__link">
                <div class="c-service-card__image">
                  <picture>
                    <source srcset="<?php webp_dir() ?>/service_teaching.png.webp" type="image/webp">
                    <img src="<?php img_dir() ?>/service_teaching.png" 
                         alt="学習・スクールサービス"
                         width="800"
                         height="480"
                         loading="lazy"
                         decoding="async">
                  </picture>
                </div>
                <div class="c-service-card__number">03</div>
                <div class="c-service-card__content">
                  <div class="c-service-card__header">
                    <span class="c-service-card__category">Teaching / 学習・スクール</span>
                    <h3 class="c-service-card__question">
                      <span class="c-service-card__quote">「</span>
                      技術を学びたい、でも何から始めれば？
                      <span class="c-service-card__quote">」</span>
                    </h3>
                  </div>
                  <div class="c-service-card__divider"></div>
                  <p class="c-service-card__desc">
                    作れる人を増やすスクール・教育・思考整理。初学者にも分かる、でも玄人にも刺さる。一歩ずつ進める環境を。
                  </p>
                  <div class="c-service-card__footer">
                    <span class="c-service-card__more">続きを読む</span>
                  </div>
                </div>
              </a>
            </article>

            <article class="c-service-card c-service-card--04">
              <a href="/service/consulting/" class="c-service-card__link">
                <div class="c-service-card__image">
                  <picture>
                    <source srcset="<?php webp_dir() ?>/service_consulting.png.webp" type="image/webp">
                    <img src="<?php img_dir() ?>/service_consulting.png" 
                         alt="コンサルティングサービス"
                         width="800"
                         height="480"
                         loading="lazy"
                         decoding="async">
                  </picture>
                </div>
                <div class="c-service-card__number">04</div>
                <div class="c-service-card__content">
                  <div class="c-service-card__header">
                    <span class="c-service-card__category">Consulting / 仕組み化・DX</span>
                    <h3 class="c-service-card__question">
                      <span class="c-service-card__quote">「</span>
                      何から手をつければいいか、分からない
                      <span class="c-service-card__quote">」</span>
                    </h3>
                  </div>
                  <div class="c-service-card__divider"></div>
                  <p class="c-service-card__desc">
                    DX・業務改善・コンサルティング。Webと思考の間に立つパートナーとして、ちょうどいい形を一緒に探します。
                  </p>
                  <div class="c-service-card__footer">
                    <span class="c-service-card__more">続きを読む</span>
                  </div>
                </div>
              </a>
            </article>
          </div>
          <div class="p-top-service__more">
            <a href="/service/" class="c-btn c-btn--more">
              サービス一覧を見る
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