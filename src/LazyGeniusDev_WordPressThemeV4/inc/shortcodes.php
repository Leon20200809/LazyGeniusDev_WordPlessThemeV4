<?php
// shortcodes.php

/**
 * ------------------------------------------------------------
 * LazyGeniusDev_WordPressThemeV4 : Shortcodes
 * ------------------------------------------------------------
 * 目的：
 *   - 固定ページや投稿本文内で使うショートコードを登録する
 *   - 今回は React 学習ビュー用の表示場所を出力する
 * ------------------------------------------------------------
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * React学習ビューのマウント先を出力する
 *
 * 役割：
 * - 固定ページ本文に [review_lessons_app] と書く
 * - React が描画するための div を出力する
 *
 * @return string React描画用のHTML
 */
function lg_render_review_lessons_app_shortcode()
{
    return '<div id="review-lessons-app"></div>';
}
add_shortcode('review_lessons_app', 'lg_render_review_lessons_app_shortcode');