<?php
/**
 * setup.php
 * ------------------------------------------------------------
 * LazyGeniusDev_WordPressThemeV4 : Theme Setup
 * ------------------------------------------------------------
 * テーマの初期設定。
 * 目的：
 *   - WordPressの機能サポートを宣言
 *   - ナビゲーションメニューを登録
 *   - エディタ用スタイルを適用
 * 思想：
 *   “コードは未来の開発者へのメッセージ”
 * ------------------------------------------------------------
 */
if (!defined('ABSPATH')) exit;

if (! function_exists('lg_theme_setup')) :
    function lg_theme_setup()
    {

        // --- <title> を WordPress に管理させる
        add_theme_support('title-tag');

        // --- 投稿のアイキャッチ画像を有効化
        add_theme_support('post-thumbnails');

        // --- ブロックエディタ用のスタイルを適用
        add_theme_support('editor-styles');
        add_editor_style('assets/css/editor.css');

        // --- ナビゲーションメニュー登録
        register_nav_menus([
            'primary' => __('Primary Navigation', 'lg-theme'),
        ]);
    }
endif;

// テーマ読み込み完了後に実行
add_action('after_setup_theme', 'lg_theme_setup');

// 画像URL取得関数
function lg_get_img_uri($path = ''){
    return get_theme_file_uri('/assets/images' . $path);
}

// リンクURL生成関数
function lg_get_nav_href($section_id = '')
{
    if (is_front_page()) {
        return $section_id === '' ? '#' : '#' . $section_id;
    }

    return $section_id === '' ? home_url('/') : home_url('/#' . $section_id);
}


