<?php

/**
 * 共通シングルテンプレート
 * page.phpの構造に合わせて修正
 */
global $post;
get_header();

$post_type = get_current_post_type();

// ページ独自のクラス
$page_slug = 'single-' . $post_type;
?>

<div class="p-<?php echo esc_attr($page_slug); ?>">

	<?php get_template_part('include/l_header'); ?>
	<!-- l_header -->

	<div class="l-wrapper">
		<main class="l-main">
			<div class="l-contents">
				<?php get_template_part('include/breadcrumb'); ?>
				<div class="l-two-column">


					<!-- メインカラム -->
					<div class="l-two-column__main">

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
								<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

									<!-- 日付 -->
									<div class="p-entry-meta">
										<span class="p-entry-meta__date">公開日: <time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y.m.d'); ?></time></span>
										<?php if (get_the_modified_time('Y.m.d') != get_the_time('Y.m.d')): ?>
											<span class="p-entry-meta__update">更新日: <time datetime="<?php the_modified_time('Y-m-d'); ?>"><?php the_modified_time('Y.m.d'); ?></time></span>
										<?php endif; ?>
									</div>


									<div class="p-entry-header-area">
										<h1 class="head_ttl">
											<span class="ja"><?php the_title(); ?></span>
										</h1>
									</div>

									<!-- アイキャッチ -->
									<div class="p-entry-thumbnail">
										<?php if (has_post_thumbnail()): ?>
											<?php the_post_thumbnail('large'); ?>
										<?php endif; ?>
									</div>

									<?php
									// カテゴリー・タグ
									$cat_tax = ($post_type === 'news') ? 'news_category' : 'common_category';
									$cats    = get_the_terms(get_the_ID(), $cat_tax);
									$tags    = get_the_terms(get_the_ID(), 'common_tag');
									?>

									<?php if (($cats && ! is_wp_error($cats)) || ($tags && ! is_wp_error($tags))) : ?>
										<div class="p-entry-taxonomy">

											<?php if ($cats && ! is_wp_error($cats)) : ?>
												<div class="p-entry-taxonomy__row p-entry-taxonomy__row--cat">
													<span class="p-entry-taxonomy__label">カテゴリー</span>
													<div class="p-entry-taxonomy__items">
														<?php foreach ($cats as $term) : ?>
															<a href="<?php echo esc_url(get_term_link($term)); ?>" class="p-entry-taxonomy__item p-entry-taxonomy__item--cat">
																<?php echo esc_html($term->name); ?>
															</a>
														<?php endforeach; ?>
													</div>
												</div>
											<?php endif; ?>

											<?php if ($tags && ! is_wp_error($tags)) : ?>
												<div class="p-entry-taxonomy__row p-entry-taxonomy__row--tag">
													<span class="p-entry-taxonomy__label">タグ</span>
													<div class="p-entry-taxonomy__items">
														<?php foreach ($tags as $term) : ?>
															<a href="<?php echo esc_url(get_term_link($term)); ?>" class="p-entry-taxonomy__item p-entry-taxonomy__item--tag">
																<?php echo esc_html($term->name); ?>
															</a>
														<?php endforeach; ?>
													</div>
												</div>
											<?php endif; ?>

										</div>
									<?php endif; ?>


									<!-- 本文 -->
									<div class="p-entry-content">
										<?php the_content(); ?>
									</div>

									<!-- SNSシェア -->
									<?php get_template_part('include/sns-share'); ?>

									<!-- ページャー -->
									<?php get_template_part('include/pager'); ?>

								</article>
						<?php endwhile;
						endif; ?>

						<!-- レコメンド -->
						<?php get_template_part('include/recommend'); ?>

					</div>

					<!-- サイドバー -->
					<aside class="l-two-column__side">
						<?php get_template_part('include/l_sidebar'); ?>
					</aside>

				</div><!-- /.l-two-column -->

			</div><!-- /.l-contents -->
		</main><!-- /.l-main -->
	</div><!-- /.l-wrapper -->

	<?php get_template_part('include/l_footer'); ?>
	<!-- l_footer -->
</div>
<!-- l_container -->

<?php get_footer(); ?>