<?php
// custom-post-types.php

/**
 * ------------------------------------------------------------
 * LazyGeniusDev_WordPressThemeV4 : Custom Post Types
 * ------------------------------------------------------------
 * 目的：
 *   - Web開発復習ノート用のカスタム投稿タイプを登録する
 *   - Web開発復習ノート用の「章」タクソノミーを登録する
 *   - Web開発復習ノート用の「技術タグ」タクソノミーを登録する
 *
 * メモ：
 *   - カスタム投稿タイプ = 通常投稿とは別の投稿の箱
 *   - タクソノミー = 投稿を分類するための仕組み
 *   - hierarchical true  = カテゴリー型
 *   - hierarchical false = タグ型
 * ------------------------------------------------------------
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Web開発復習ノート用のカスタム投稿タイプを登録する
 *
 * 役割：
 * - 通常投稿とは別に「Web開発復習ノート」という投稿の箱を作る
 * - /review-lessons/ で一覧ページを使えるようにする
 * - ブロックエディタ、アイキャッチ、抜粋を使えるようにする
 *
 * @return void
 */
function lg_register_review_lessons_post_type()
{
    /**
     * labels:
     * 管理画面に表示される文言をまとめた配列。
     * 投稿一覧、新規追加、編集画面、検索結果などの表示名に使われる。
     */
    $labels = [
        // 管理画面の一覧や見出しなどで使われる全体名
        'name' => 'Web開発復習ノート',

        // 1件だけを指すときの名前
        'singular_name' => 'Web開発復習ノート',

        // 左メニューに表示される名前
        'menu_name' => 'Web開発復習ノート',

        // 管理バー上部の「+ 新規」などで表示される名前
        'name_admin_bar' => '復習ノートを追加',

        // 「新規追加」ボタンの表示名
        'add_new' => '新規追加',

        // 新規追加画面のタイトル
        'add_new_item' => '復習ノートを追加',

        // 編集画面のタイトル
        'edit_item' => '復習ノートを編集',

        // 新規作成された投稿の表示名
        'new_item' => '新しい復習ノート',

        // 投稿を見るリンクの表示名
        'view_item' => '復習ノートを見る',

        // 一覧画面のタイトル
        'all_items' => '復習ノート一覧',

        // 検索ボックス周りで使われる文言
        'search_items' => '復習ノートを検索',

        // 投稿が見つからなかった時の文言
        'not_found' => '復習ノートが見つかりませんでした',

        // ゴミ箱内にも投稿がなかった時の文言
        'not_found_in_trash' => 'ゴミ箱に復習ノートはありません',
    ];

    /**
     * args:
     * カスタム投稿タイプそのものの設定。
     * 公開するか、アーカイブを持つか、URLをどうするか、
     * どの入力欄を使うかなどを決める。
     */
    $args = [
        // 上で定義した管理画面用ラベルを渡す
        'labels' => $labels,

        // trueにすると、管理画面に表示され、サイト上でもURLアクセスできる
        // falseにすると、基本的には管理画面や表側に出ない内部用になる
        'public' => true,

        // trueにすると、一覧ページを持てる
        // 今回は /review-lessons/ で一覧を作りたいので true
        'has_archive' => true,

        // URL構造の設定
        // slugを指定すると /review-lessons/ のようなURLにできる
        'rewrite' => [
            'slug' => 'review-lessons',
        ],

        // trueにすると、ブロックエディタ対応になる
        // REST APIにも出るので、将来的なヘッドレス化やJS連携にも使いやすい
        'show_in_rest' => true,

        // この投稿タイプで使える編集項目
        'supports' => [
            'title',     // タイトル
            'editor',    // 本文エディタ
            'thumbnail', // アイキャッチ画像
            'excerpt',   // 抜粋
        ],

        // 管理画面左メニューの表示位置
        // 5は通常投稿の近く
        'menu_position' => 5,

        // 管理画面左メニューのアイコン
        // dashicons-welcome-learn-more = 学習・本っぽいアイコン
        'menu_icon' => 'dashicons-welcome-learn-more',
    ];

    /**
     * register_post_type:
     * WordPressにカスタム投稿タイプを登録する関数。
     *
     * 第1引数：
     *   投稿タイプの内部名。
     *   英数字とアンダースコアで指定する。
     *
     * 第2引数：
     *   投稿タイプの設定配列。
     */
    register_post_type('review_lessons', $args);
}
add_action('init', 'lg_register_review_lessons_post_type');


/**
 * Web開発復習ノート用の「章」タクソノミーを登録する
 *
 * 役割：
 * - 第1章、第2章、第3章、DevTools補助編などで記事を分類する
 * - カテゴリー型として扱う
 *
 * @return void
 */
function lg_register_lesson_chapter_taxonomy()
{
    /**
     * labels:
     * タクソノミーの管理画面に表示される文言。
     * 「章を追加」「章を検索」などの表示をここで決める。
     */
    $labels = [
        // 管理画面で使われる全体名
        'name' => '章',

        // 1件だけを指すときの名前
        'singular_name' => '章',

        // 検索画面の文言
        'search_items' => '章を検索',

        // 一覧表示の文言
        'all_items' => 'すべての章',

        // 親タームを選ぶ時の文言
        // hierarchical が true の時に意味がある
        'parent_item' => '親の章',

        // 親ターム表示のラベル
        'parent_item_colon' => '親の章:',

        // 編集画面の文言
        'edit_item' => '章を編集',

        // 更新ボタン周りの文言
        'update_item' => '章を更新',

        // 新規追加画面の文言
        'add_new_item' => '新しい章を追加',

        // 新しい章名の入力欄周りの文言
        'new_item_name' => '新しい章名',

        // 左メニューやメタボックスに表示される名前
        'menu_name' => '章',
    ];

    /**
     * args:
     * タクソノミーの動作設定。
     * カテゴリー型かタグ型か、管理画面に出すか、URLを持つかなどを決める。
     */
    $args = [
        // 上で定義した表示文言を渡す
        'labels' => $labels,

        // true = カテゴリー型
        // 親子構造を持てる
        // 例：第1章の下に「おみくじ編」などを作れる
        'hierarchical' => true,

        // trueにすると、管理画面で編集できる
        'show_ui' => true,

        // trueにすると、投稿一覧画面に「章」カラムが表示される
        'show_admin_column' => true,

        // trueにすると、ブロックエディタのサイドバーに表示される
        // REST APIにも出る
        'show_in_rest' => true,

        // タクソノミーのURL設定
        // 例：/lesson-chapter/chapter-01/
        'rewrite' => [
            'slug' => 'lesson-chapter',
        ],
    ];

    /**
     * register_taxonomy:
     * WordPressにタクソノミーを登録する関数。
     *
     * 第1引数：
     *   タクソノミーの内部名。
     *
     * 第2引数：
     *   紐づける投稿タイプ。
     *   今回は review_lessons にだけ章を付ける。
     *
     * 第3引数：
     *   タクソノミーの設定配列。
     */
    register_taxonomy('lesson_chapter', ['review_lessons'], $args);
}
add_action('init', 'lg_register_lesson_chapter_taxonomy');


/**
 * Web開発復習ノート用の「技術タグ」タクソノミーを登録する
 *
 * 役割：
 * - JavaScript、PHP、MySQL、XSS、PRG、fetch などの技術要素を付ける
 * - タグ型として扱う
 *
 * @return void
 */
function lg_register_lesson_tag_taxonomy()
{
    /**
     * labels:
     * 技術タグの管理画面に表示される文言。
     * タグ型なので「カンマで区切る」「よく使われるタグ」系の文言も使う。
     */
    $labels = [
        // 管理画面で使われる全体名
        'name' => '技術タグ',

        // 1件だけを指すときの名前
        'singular_name' => '技術タグ',

        // 検索画面の文言
        'search_items' => '技術タグを検索',

        // よく使われるタグの表示文言
        'popular_items' => 'よく使われる技術タグ',

        // 一覧表示の文言
        'all_items' => 'すべての技術タグ',

        // 編集画面の文言
        'edit_item' => '技術タグを編集',

        // 更新ボタン周りの文言
        'update_item' => '技術タグを更新',

        // 新規追加画面の文言
        'add_new_item' => '新しい技術タグを追加',

        // 新しいタグ名の入力欄周りの文言
        'new_item_name' => '新しい技術タグ名',

        // タグ入力欄で、カンマ区切りを案内する文言
        'separate_items_with_commas' => '技術タグをカンマで区切る',

        // タグの追加・削除UIで使われる文言
        'add_or_remove_items' => '技術タグを追加または削除',

        // よく使うタグから選ぶ時の文言
        'choose_from_most_used' => 'よく使われる技術タグから選択',

        // タグが見つからなかった時の文言
        'not_found' => '技術タグが見つかりませんでした',

        // 左メニューやメタボックスに表示される名前
        'menu_name' => '技術タグ',
    ];

    /**
     * args:
     * 技術タグタクソノミーの動作設定。
     */
    $args = [
        // 上で定義した表示文言を渡す
        'labels' => $labels,

        // false = タグ型
        // 親子構造は持たない
        // 例：JavaScript / PHP / MySQL / XSS のように横並びで付ける
        'hierarchical' => false,

        // trueにすると、管理画面で編集できる
        'show_ui' => true,

        // trueにすると、投稿一覧画面に「技術タグ」カラムが表示される
        'show_admin_column' => true,

        // trueにすると、ブロックエディタのサイドバーに表示される
        // REST APIにも出る
        'show_in_rest' => true,

        // タクソノミーのURL設定
        // 例：/lesson-tag/javascript/
        'rewrite' => [
            'slug' => 'lesson-tag',
        ],
    ];

    /**
     * register_taxonomy:
     * WordPressにタクソノミーを登録する関数。
     *
     * 第1引数：
     *   タクソノミーの内部名。
     *
     * 第2引数：
     *   紐づける投稿タイプ。
     *   今回は review_lessons にだけ技術タグを付ける。
     *
     * 第3引数：
     *   タクソノミーの設定配列。
     */
    register_taxonomy('lesson_tag', ['review_lessons'], $args);
}
add_action('init', 'lg_register_lesson_tag_taxonomy');
