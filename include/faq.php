<?php

/**
 * FAQ セクション共通パーツ（JSON版）
 *
 * JSON ファイルの配置ルール：
 *  /wp-content/themes/your-theme/data/faq/{post_name}.json
 *
 * 例）homepage → data/faq/homepage.json
 */

global $post;

if (! $post) {
    return;
}

// 現在ページのスラッグ
$slug = $post->post_name;

// JSON ファイルのパス取得
// 子テーマ対応するなら get_stylesheet_directory() でもOK
$json_path = get_theme_file_path('data/faq/' . $slug . '.json');

// ファイルがなければ終了
if (! file_exists($json_path)) {
    return;
}

// JSON 読み込み
$json_string = file_get_contents($json_path);
if ($json_string === false) {
    return;
}

// 配列に変換
$rows = json_decode($json_string, true);

// JSON パースエラー or 想定外形式なら終了
if (json_last_error() !== JSON_ERROR_NONE || empty($rows) || ! is_array($rows)) {
    return;
}
?>

<section class="l-sec l-faq">
    <h2 class="u_head_ttl_02">
        <span class="en">FAQ</span><br>
        <span class="ja">よくあるご質問</span>
    </h2>

    <div class="c-faq">
        <?php foreach ($rows as $row) : ?>
            <?php
            $question = isset($row['question']) ? $row['question'] : '';
            $answer   = isset($row['answer'])   ? $row['answer']   : '';

            if (! $question || ! $answer) {
                continue;
            }
            ?>
            <div class="c-faq__item">
                <button class="c-faq__question" type="button">
                    <?php echo esc_html($question); ?>
                </button>
                <div class="c-faq__answer">
                    <p><?php echo nl2br(esc_html($answer)); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php
// -------------------------------
// JSON-LD（FAQ構造化データ）生成
// -------------------------------

$faq_entities = [];

foreach ($rows as $row) {
    if (empty($row['question']) || empty($row['answer'])) {
        continue;
    }

    $faq_entities[] = [
        '@type' => 'Question',
        'name'  => wp_strip_all_tags($row['question']),
        'acceptedAnswer' => [
            '@type' => 'Answer',
            'text'  => wp_strip_all_tags($row['answer']),
        ],
    ];
}

if (! empty($faq_entities)) :
    $json_ld = [
        '@context'    => 'https://schema.org',
        '@type'       => 'FAQPage',
        'mainEntity'  => $faq_entities,
    ];
?>
    <script type="application/ld+json">
        <?php echo wp_json_encode($json_ld, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?>
    </script>
<?php endif; ?>