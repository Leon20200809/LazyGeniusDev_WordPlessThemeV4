# LazyGeniusDev WordPress Theme V4

自作ポートフォリオサイト用に制作している WordPress オリジナルテーマです。
ポートフォリオサイトとしての運用だけでなく、今後の実案件や小規模サイト制作にも再利用できるテーマ構成を目指して開発しています。

![メイン画面のスクリーンショット](./screenshots/screenshot.png)

## 概要

このテーマは、WordPressオリジナルテーマ制作の実践として、以下のような構成や機能を自作で組み込みながら開発しています。

* オリジナルテーマ構築
* セクション分割によるトップページ設計
* ハンバーガーメニュー
* タブUI
* アコーディオンUI
* お問い合わせフォーム（Ajax）
* カスタム投稿タイプによる復習ブログ機能
* WordPress REST API と React を使った学習ビュー
* 固定ページ専用テンプレートによるSPA風ページ構成
* レスポンシブ対応
* 画像の最適化・表示切り替え
* セキュリティヘッダーの設定
* 保守しやすいファイル分割構成
* GitHub Actions による自動デプロイ
* Xserver 本番環境での公開運用
* Cloudflare DNS によるドメイン・DNS管理

## 目的

* WordPressオリジナルテーマ制作力の強化
* 実案件を意識した構成管理の練習
* 公開後の保守・改善を見据えたテーマ設計
* GitHubで継続的に管理できる開発資産として育てること
* サーバー・ドメイン・DNS・SSLなどを含めた公開対応の経験を積むこと
* WordPress と React を組み合わせた部分的なSPA化の実験
* REST API を使った記事データ取得・表示切り替えの実装経験を積むこと

## 開発環境・使用技術

* WordPress
* PHP
* JavaScript
* React
* TypeScript
* Vite
* Tailwind CSS
* WordPress REST API
* CSS
* Local / Laragon
* Git / GitHub
* GitHub Actions
* Xserver
* Cloudflare

## 現在対応していること

* WordPressオリジナルテーマの構築
* トップページのセクション分割
* JavaScriptによるUI実装
* お問い合わせフォーム機能の実装
* CSSファイル分割による保守性の向上
* カスタム投稿タイプ `review_lessons` による復習ブログ機能
* `archive-review_lessons.php` / `single-review_lessons.php` による通常記事表示
* React + Vite による復習ブログ用SPA風学習ビュー
* WordPress REST API から記事データを取得し、React側で一覧・本文を表示
* PCでは左ペインに記事一覧、右ペインに記事本文を表示
* スマホでは `details` タグを使った折りたたみ式の記事一覧を表示
* 固定ページ `/review-lab/` 専用テンプレート `page-review-lab.php` によるReact表示領域の提供
* GitHub ActionsによるXserverへの自動デプロイ
* Cloudflare DNSへの移行
* 本番環境での表示確認

## 復習ブログSPA化について

このテーマでは、WordPressのカスタム投稿タイプ `review_lessons` に保存した記事を、通常のアーカイブページ・個別ページとして表示するだけでなく、Reactを使ったSPA風の学習ビューとしても表示できるようにしています。

通常のWordPress表示では、SEOや検索流入を意識した記事ページとして公開し、React学習ビューでは、左側の記事一覧をクリックすると右側の記事本文だけが切り替わる構成にしています。

構成の役割は以下の通りです。

```text
WordPress
→ 記事データを管理する

WordPress REST API
→ review_lessons の記事データをJSONで返す

React
→ 記事一覧・選択中記事・本文表示を担当する

Vite
→ Reactアプリをビルドする

page-review-lab.php
→ Reactを描画するための専用ページテンプレート

assets/review-lab/
→ ViteでビルドしたJS/CSSを配置する
```

React側では、以下のように責務を分けています。

```text
api/
→ WordPress REST API から記事データを取得する

utils/
→ WordPressの生JSONをReact表示用に整形する

types/
→ 記事データの型定義を管理する

components/
→ 記事一覧・記事本文などの表示を担当する
```

この実装により、WordPressをCMSとして活かしつつ、一部ページだけReactでモダンな閲覧体験にする構成を試しています。

## 今後の予定

* お問い合わせフォーム機能の改善
* デザイン・レスポンシブ表示の調整
* セキュリティ設定の継続改善
* 表示速度改善
* Cloudflareのプロキシ・キャッシュ機能の検証
* 管理しやすいテーマ構成へのさらなる整理
* 実案件でも再利用しやすいテーマテンプレート化
* React学習ビューのUI改善
* コードハイライト用CSS / JS の読み込み調整
* Viteビルド成果物のmanifest管理
* 復習ブログ記事の検索・章フィルター・タグフィルター機能の検討

## 備考

このテーマは、自分のポートフォリオサイトとして運用しながら、WordPressテーマ制作・公開対応・保守運用の実践経験を積むための開発資産です。

サーバー・ドメイン・DNS・SSLなどの公開設定を含め、Webサイトを本番環境で閲覧できる状態まで対応することを意識して制作しています。

また、WordPressの通常テーマ機能だけでなく、React・Vite・Tailwind CSS・WordPress REST API を組み合わせた部分的なSPA化にも取り組んでいます。

単なる静的なポートフォリオではなく、WordPressをCMSとして活かしつつ、必要な部分だけReactで拡張する実験場としても育てています。
