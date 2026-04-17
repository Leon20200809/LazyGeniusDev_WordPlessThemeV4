司令部（ルート直下）

style.css
テーマ識別子（テーマ名/作者/バージョン等）。最小のグローバル上書きだけ置く。

functions.php
司令塔。inc配線だけを行う。ここにはロジックを書かない。

theme.json
デザイン・トークン中枢（色/余白/フォント/ブロック設定）。ブロックエディタへの宣言もここで。

front-page.php / home.php / archive.php / page.php / single.php / 404.php
テンプレ階層の要。ページ構造の骨格を定義し、見た目は template-parts に委譲。

inc/（ロジック倉庫：フック・登録・処理）

inc/setup.php
テーマ機能宣言：add_theme_support、メニュー/サムネ登録、エディタ用CSS登録など。

inc/enqueue.php
CSS/JSの登録・読込制御。依存、バージョン付与、条件分岐（トップだけ読み込む等）。

inc/cleanup.php
head掃除（絵文字/余計なタグの除去）、不要機能OFF。軽量化・健全化。

inc/security.php
セキュリティ微調整（REST制限、ヘッダ調整、ログイン周りの小手当て）。

inc/patterns.php
ブロックパターン登録（ヒーロー/FAQ/料金/CTA）。パターンのHTML断片・メタ情報を登録する。

inc/shortcodes.php
ショートコード登録（例：[lg_hero_template]）。template-parts の呼び出し窓口。

inc/blocks/（任意）
独自ブロックを作る場合の登録入口。index.phpで一括登録、各ブロック毎にサブフォルダ。

inc/contact/（LG-Contact一式：お問い合わせの完全自作）

loader.php … admin_post 配線・初期化。フォーム提出→ハンドラへ。

handler.php … 本体。検証 → 送信 → リダイレクト。From固定+Reply-Toユーザー。

validate.php … 必須/型/長さ/メール形式/NG語など入力バリデーション。

antispam.php … honeypot / 送信最短時間 / IPレート制限などスパム抑止。

mailer.php … ヘッダ組立（Content-Type、From固定、Reply-To設定、Cc/Bcc対応）。

logger.php … 成否ログ（wp_mail_failedフック→debug.log or DB）。再送の基礎。

admin-page.php … 失敗一覧・再送ボタンなど運用UI（必要に応じて実装）。

template-parts/（見た目の断片：HTMLスニペット）

template-parts/hero/hero.php
ヒーローセクションのHTML構造。テキストや画像差し替えは引数・ショートコードで。

template-parts/contact/form.php
お問い合わせフォームのHTML（wp_nonce_field や honeypot を含む）。

（任意で）sections/
CTA・ニュース・料金表などページ断片。フロント/固定ページから組み合わせる。

ここにはロジックを書かない。装飾や構造に専念し、動きは assets のJSへ。

templates/（用途別テンプレ：ルーティングの顔）

templates/page-landing.php
LP用のレイアウト（ヘッダー最小化、CTA誘導など）。

templates/page-contact.php
お問い合わせ用のページ。template-parts/contact/form.php を読み込む。

front-page.php や archive.php などの「ルート直下テンプレ」と役割を分ける場所。

assets/（素材庫：CSS/JS/画像）

assets/css/base.css
リセット/タイポ/ユーティリティ。theme.jsonのトークンに従った基礎スタイル。

assets/css/hero.css / contact.css / editor.css
コンポーネント別・画面別のスタイル。必要な時だけ enqueue。

assets/js/hero.js / contact.js
軽アニメ、二重送信防止、UX補助など。

assets/images/
画像置き場。hero/ や brand/ に小分けして管理。

parts/（生HTML断片：パターン素材庫）

hero-basic.html / pricing-table.html / faq-accordion.html / cta-basic.html
ブロックパターンの素体としての生HTML。
編集者が理解しやすい形で置き、inc/patterns.php から登録。

languages/

lg-theme.pot
翻訳テンプレ。テーマ配布・国際化の布石。

運用原則（LG流・最小教義）

functions.php は司令塔。incに責務を分割して呼ぶだけ。

template-parts/ は“見た目のみ”。ロジックは inc/、動きは assets/。

theme.json はトークンの単一情報源。CSSはこれを参照して“矛盾しない設計”。

contact は安全→確実→拡張可能の順で。From固定/Reply-Toユーザー/SMTP確立。