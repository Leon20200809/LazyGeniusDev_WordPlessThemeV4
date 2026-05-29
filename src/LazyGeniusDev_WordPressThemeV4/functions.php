<?php
// functions.php

/**
 * ------------------------------------------------------------
 * LazyGeniusDev_WordPressThemeV4 : Functions
 * ------------------------------------------------------------
 * 目的：
 *   - テーマ全体で使う初期ファイルを読み込む
 *   - functions.php を「司令塔」として扱い、各処理の本体は inc 配下へ分離する
 *
 * 方針：
 *   - functions.php には重い処理を直接書かない
 *   - 機能ごとに inc 配下のファイルへ分ける
 *   - 必須ファイルは常時読み込み
 *   - 任意機能は必要に応じてコメントアウトを外す
 *
 * 読み込み対象：
 *   - setup.php             : テーマ基本設定
 *   - enqueue.php           : CSS / JavaScript の読み込み
 *   - custom-post-types.php : カスタム投稿・タクソノミー登録
 *   - security.php          : セキュリティ関連設定
 *
 * メモ：
 *   - get_theme_file_path() は現在のテーマ内ファイルの絶対パスを取得する関数
 *   - LG_THEME_INC_PATH に inc ディレクトリのパスをまとめておくことで、
 *     require_once の記述を短くし、読み込み元を一元管理する
 * ------------------------------------------------------------
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * inc ディレクトリまでの絶対パス
 *
 * 例：
 * /wp-content/themes/LazyGeniusDev_WordPressThemeV4/inc
 */
define('LG_THEME_INC_PATH', get_theme_file_path('inc'));

/**
 * テーマ基本設定を読み込む
 *
 * 役割：
 * - title-tag 対応
 * - アイキャッチ画像対応
 * - メニュー登録
 * - HTML5サポート
 * - その他、テーマ初期設定
 */
require_once LG_THEME_INC_PATH . '/setup.php';

/**
 * CSS / JavaScript の読み込み設定を読み込む
 *
 * 役割：
 * - wp_enqueue_style()
 * - wp_enqueue_script()
 * - フロント用CSS / JSの読み込み
 */
require_once LG_THEME_INC_PATH . '/enqueue.php';

/**
 * お問い合わせフォーム機能を読み込む
 *
 * 役割：
 * - Ajax送信処理
 * - バリデーション
 * - メール送信
 * - nonce / ajaxurl のフロント出力
 */
require_once LG_THEME_INC_PATH . '/contact/loader.php';

/**
 * カスタム投稿タイプ・タクソノミー登録を読み込む
 *
 * 役割：
 * - Web開発復習ノート review_lessons の登録
 * - 章 lesson_chapter の登録
 * - 技術タグ lesson_tag の登録
 */
require_once LG_THEME_INC_PATH . '/custom-post-types.php';

/**
 * 不要なWordPress標準出力の整理
 *
 * 役割：
 * - head内の不要タグ削除
 * - 絵文字スクリプト削除
 * - REST API / XML-RPC まわりの整理など
 *
 * 必要になったらコメントアウトを外す。
 */
// require_once LG_THEME_INC_PATH . '/cleanup.php';

/**
 * セキュリティ関連設定を読み込む
 *
 * 役割：
 * - セキュリティヘッダー
 * - 不要な情報露出の抑制
 * - 管理画面・ログイン周りの軽い防御
 */
require_once LG_THEME_INC_PATH . '/security.php';

/**
 * ブロックパターン登録を読み込む
 *
 * 役割：
 * - register_block_pattern()
 * - 再利用可能なセクションパターンの登録
 *
 * 必要になったらコメントアウトを外す。
 */
// require_once LG_THEME_INC_PATH . '/patterns.php';

/**
 * ショートコード登録を読み込む
 *
 * 役割：
 * - add_shortcode()
 * - 固定ページや投稿本文内で呼び出す小機能の登録
 *
 * 必要になったらコメントアウトを外す。
 */
require_once LG_THEME_INC_PATH . '/shortcodes.php';
