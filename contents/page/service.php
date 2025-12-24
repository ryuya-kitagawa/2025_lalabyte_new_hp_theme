<?php
// サービス情報
$services = [
	[
		'id' => 'homepage',
		'anchor' => 'service-homepage',
		'number' => '01',
		'title_en' => 'Web / Homepage',
		'title_ja' => 'ホームページ制作',
		'image' => 'service_homepage.png',
		'alt' => '複数デバイスに対応したホームページ制作',
		'description' => '見た目だけでなく、設計・導線・成果を重視したWeb制作。デザイン重視ではなく「成果が出る仕組み」を一緒に考えます。初めてホームページを作る方、作り直しを検討している方におすすめです。',
		'features' => [
			'成果を重視したサイト設計・導線設計',
			'レスポンシブデザイン対応',
			'SEO対策済みの構造設計',
			'コンテンツ管理システム（CMS）導入',
			'公開後の運用サポート',
			'デザイン重視ではなく成果重視の制作'
		],
		'url' => '/service/homepage/'
	],
	[
		'id' => 'marketing',
		'anchor' => 'service-marketing',
		'number' => '02',
		'title_en' => 'Marketing / 集客',
		'title_ja' => 'マーケティング支援',
		'image' => 'service_marketing.png',
		'alt' => 'データを見ながら改善方針を立てるマーケティング支援',
		'description' => 'SEO・MEO・集客設計まで一貫支援。デザインだけで終わらない、継続的に集客できる仕組みづくりを。サイトはあるけど見てもらえない、集客がうまくいかないという課題を解決します。',
		'features' => [
			'SEO対策（検索エンジン最適化）',
			'MEO対策（Googleマップ最適化）',
			'コンテンツマーケティング',
			'データ分析・改善提案',
			'リスティング広告運用サポート',
			'SNS運用戦略・支援',
			'継続的な集客設計'
		],
		'url' => '/service/marketing/'
	],
	[
		'id' => 'teaching',
		'anchor' => 'service-teaching',
		'number' => '03',
		'title_en' => 'Teaching / 学習・スクール',
		'title_ja' => 'プログラミング・学習支援',
		'image' => 'service_teaching.png',
		'alt' => '学びながら作れるプログラミング・Webスキル育成',
		'description' => '作れる人を増やすスクール・教育・思考整理。初学者にも分かる、でも玄人にも刺さる。一歩ずつ進める環境を。技術を学びたい、でも何から始めればいいか分からないという方におすすめです。',
		'features' => [
			'マンツーマン個別指導',
			'実務直結の学習内容',
			'ポートフォリオ制作支援',
			'案件対応・提案文作成サポート',
			'地域密着型子ども向けプログラミング教室',
			'デジタルリテラシー教育',
			'目標達成まで徹底サポート'
		],
		'url' => '/service/teaching/'
	],
	[
		'id' => 'consulting',
		'anchor' => 'service-consulting',
		'number' => '04',
		'title_en' => 'Consulting / 仕組み化・DX',
		'title_ja' => 'DX支援・コンサルティング',
		'image' => 'service_consulting.png',
		'alt' => '制作や業務改善を設計するDX支援・コンサルティング',
		'description' => 'DX・業務改善・コンサルティング。Webと思考の間に立つパートナーとして、ちょうどいい形を一緒に探します。何から手をつければいいか分からない、業務効率化したいという方におすすめです。',
		'features' => [
			'業務フローの可視化・課題抽出',
			'自動化・効率化の設計',
			'ツール導入・セットアップ支援',
			'マニュアル・運用ルールの整備',
			'既存システムとの連携・見直し',
			'担当者へのレクチャー・教育',
			'伴走型の継続サポート'
		],
		'url' => '/service/consulting/'
	]
];
?>

<!-- サービス目次セクション -->
<section class="l-sec l-service-nav">
	<div class="l-service-nav__inner">
		<p class="l-service-nav__lead">迷ったらここから選べます</p>
		<nav class="c-service-nav">
			<ul class="c-service-nav__list">
				<?php foreach ($services as $service) : ?>
					<li class="c-service-nav__item">
						<a href="#<?php echo esc_attr($service['anchor']); ?>" class="c-service-nav__link">
							<span class="c-service-nav__number"><?php echo esc_html($service['number']); ?></span>
							<span class="c-service-nav__title"><?php echo esc_html($service['title_ja']); ?></span>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</nav>
	</div>
</section>

<!-- サービス詳細セクション -->
<?php foreach ($services as $index => $service) : 
	$is_odd = ($index % 2 === 0);
	$layout_class = $is_odd ? 'c-service-section--image-left' : 'c-service-section--image-right';
?>
	<section id="<?php echo esc_attr($service['anchor']); ?>" class="l-sec c-service-section <?php echo esc_attr($layout_class); ?>">
		<div class="c-service-section__inner">
			<div class="c-service-section__image">
				<picture>
					<?php
					$image_path = $service['image'];
					$image_path_encoded = rawurlencode($image_path);
					?>
					<source media="(min-width: 768px)" srcset="<?php webp_dir(); ?>/<?php echo esc_attr($image_path_encoded); ?>.webp" type="image/webp">
					<source media="(min-width: 768px)" srcset="<?php img_dir(); ?>/<?php echo esc_attr($image_path_encoded); ?>">
					<source media="(max-width: 767px)" srcset="<?php webp_dir(); ?>/<?php echo esc_attr($image_path_encoded); ?>.webp" type="image/webp">
					<source media="(max-width: 767px)" srcset="<?php img_dir(); ?>/<?php echo esc_attr($image_path_encoded); ?>">
					<source srcset="<?php webp_dir(); ?>/<?php echo esc_attr($image_path_encoded); ?>.webp" type="image/webp">
					<img src="<?php img_dir(); ?>/<?php echo esc_attr($image_path_encoded); ?>" 
						 alt="<?php echo esc_attr($service['alt']); ?>"
						 width="800"
						 height="450"
						 loading="lazy"
						 decoding="async">
				</picture>
			</div>
			<div class="c-service-section__content">
				<div class="c-service-section__header">
					<span class="c-service-section__number">SERVICE <?php echo esc_html($service['number']); ?></span>
					<h2 class="c-service-section__title">
						<span class="c-service-section__title-en"><?php echo esc_html($service['title_en']); ?></span>
						<span class="c-service-section__title-ja"><?php echo esc_html($service['title_ja']); ?></span>
					</h2>
				</div>
				<p class="c-service-section__description"><?php echo esc_html($service['description']); ?></p>
				<div class="c-service-section__features">
					<h3 class="c-service-section__features-title">できること</h3>
					<ul class="c-service-section__features-list">
						<?php foreach ($service['features'] as $feature) : ?>
							<li class="c-service-section__features-item"><?php echo esc_html($feature); ?></li>
						<?php endforeach; ?>
					</ul>
				</div>
				<div class="c-service-section__cta">
					<a href="<?php echo esc_url($service['url']); ?>" class="c-btn c-btn--primary">
						詳細を見る
					</a>
					<a href="/contact/" class="c-btn c-btn--secondary">
						無料相談
					</a>
				</div>
			</div>
		</div>
	</section>
<?php endforeach; ?>
