# Lalabyte WordPress テーマ

WordPressカスタムテーマの開発環境です。

## セットアップ

```bash
npm install
```

## 開発・ビルドコマンド

### 開発モード（watch）

```bash
npm run watch
```

SCSSとJavaScriptを監視し、変更時に自動コンパイルします。ソースマップが生成されます。

### 本番ビルド

```bash
npm run build
```

以下の処理を実行します：
1. SCSS/JSのコンパイル・最適化
2. 画像最適化（圧縮・WebP生成）

## 出力先

すべての成果物は `assets/dist/` 配下に出力されます：

```
assets/dist/
├── css/
│   └── style.css
├── js/
│   ├── common.js
│   ├── slider.js
│   └── hum.js
├── img/
├── webp/
└── fonts/
```

**注意：** 出力先やファイル名は変更禁止です。PHPテンプレート（`include/css.php`, `include/js.php`）がこのパスを参照しています。

## 画像処理

画像の物理解像度は変更しません。圧縮・WebP生成・SVG最適化のみを行います。

- **JPEG**: mozjpeg（quality: 80）
- **PNG**: pngquant（quality: [0.65, 0.8]）
- **GIF**: gifsicle最適化
- **SVG**: svgo最適化
- **WebP**: sharp（quality: 70, method: 6）

500KBを超える画像がある場合は警告が表示されます。

## ファイル構成

```
assets/
├── src/              # ソースファイル
│   ├── sass/         # SCSSファイル
│   ├── js/           # JavaScriptファイル
│   └── img/          # 元画像
└── dist/             # ビルド成果物（出力先）
    ├── css/
    ├── js/
    ├── img/
    ├── webp/
    └── fonts/
```

## トラブルシューティング

### ビルドエラーが発生する場合

```bash
rm -rf node_modules
npm install
```

### キャッシュをクリア

```bash
rm -rf assets/dist
npm run build
```

## パフォーマンス最適化（キャッシュ設定）

### 概要

PageSpeed Insightsの「静的アセットのキャッシュ設定」指摘を解消するため、以下の設定を実装しています：

- `/assets/dist/` 配下の静的ファイル（CSS/JS/画像/フォント）に長期キャッシュ（1年）を設定
- ファイル更新時は `filemtime()` ベースのバージョンクエリでキャッシュバスト

### Apache環境（.htaccess）

テーマルートの `.htaccess` に以下の設定が含まれています：

- `mod_expires` を使用した Expires ヘッダー設定
- `mod_headers` を使用した Cache-Control ヘッダー設定（`public, max-age=31536000, immutable`）

### Nginx環境

Nginxの場合は、サーバー設定ファイル（`nginx.conf` またはサイト設定ファイル）に以下を追記してください：

```nginx
# 静的アセットの長期キャッシュ設定
location ~* ^/wp-content/themes/lalabyte_hp_theme/assets/dist/.+\.(css|js|mjs|map|png|jpg|jpeg|gif|webp|avif|svg|ico|woff|woff2|ttf|otf|eot)$ {
    expires 1y;
    add_header Cache-Control "public, max-age=31536000, immutable";
    access_log off;
}
```

**注意：** 上記のパスは実際のWordPress設置パスに合わせて調整してください。

### キャッシュバスト

CSS/JSファイルには `filemtime()` ベースのバージョンクエリが自動で付与されます：

- `include/css.php`: `style.css?v=1234567890`
- `include/js.php`: `common.js?v=1234567890` など

ファイルが更新されると自動的に新しいバージョン番号が付与され、ブラウザに新しいファイルが読み込まれます。

### 検証手順

1. **Chrome DevTools での確認**
   - ページを開き、Chrome DevTools（F12）を開く
   - Network タブを開く
   - ページをリロード（Ctrl+R または Cmd+R）
   - CSS/JS/画像/フォントファイルを選択
   - Response Headers を確認
   - `Cache-Control: public, max-age=31536000, immutable` が表示されているか確認

2. **PageSpeed Insights での確認**
   - [PageSpeed Insights](https://pagespeed.web.dev/) にアクセス
   - 対象URLを入力してテスト実行
   - 「効率的なキャッシュポリシー」の指摘が減っているか確認

3. **バージョンクエリの確認**
   - ページのソースを表示（Ctrl+U または Cmd+U）
   - CSS/JSの読み込みタグを確認
   - URLに `?v=` パラメータが付いているか確認
   - ファイルを更新してビルド後、バージョン番号が変更されるか確認
