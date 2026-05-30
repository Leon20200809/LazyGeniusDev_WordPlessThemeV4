<?php
// <!-- enqueue.php -->

/**
 * ------------------------------------------------------------
 * LazyGeniusDev_WordPressThemeV4 : Enqueue
 * ------------------------------------------------------------
 * 目的：
 *   - テーマ共通のCSS / JS / Fontを読み込む
 *   - ページ専用CSSを必要な画面だけで読み込む
 *   - パスとバージョンを変数化して保守性を確保する
 * ------------------------------------------------------------
 */

if (!defined('ABSPATH')) exit;

/**
 * テーマ共通アセットを読み込む
 *
 * 対象：
 * - style.css
 * - init.js
 * - Google Fonts
 *
 * @return void
 */
if (!function_exists('lg_enqueue_theme_assets')) :
    function lg_enqueue_theme_assets()
    {
        $theme = wp_get_theme();
        $ver   = $theme->get('Version') ?: '1.0.0';
        $uri   = get_stylesheet_directory_uri();

        wp_enqueue_style(
            'lg-v4-style',
            $uri . '/assets/css/style.css',
            [],
            $ver
        );

        wp_enqueue_script_module(
            'lg-v4-init',
            $uri . '/assets/js/init.js',
            [],
            $ver
        );

        wp_enqueue_style(
            'lg-google-fonts',
            'https://fonts.googleapis.com/css2?family=Shippori+Mincho:wght@400;500;700&family=Noto+Sans+JP:wght@400;500;700&display=swap',
            [],
            null
        );
    }
endif;
add_action('wp_enqueue_scripts', 'lg_enqueue_theme_assets');

/**
 * Web開発復習ノート専用CSSを必要なページだけで読み込む
 *
 * 対象：
 * - review_lessons の個別ページ
 * - review_lessons のアーカイブページ
 * - lesson_chapter タクソノミーアーカイブ
 * - lesson_tag タクソノミーアーカイブ
 *
 * @return void
 */
if (!function_exists('lg_enqueue_review_lessons_style')) :
    function lg_enqueue_review_lessons_style()
    {
        if (
            !is_singular('review_lessons') &&
            !is_post_type_archive('review_lessons') &&
            !is_tax('lesson_chapter') &&
            !is_tax('lesson_tag')
        ) {
            return;
        }

        $css_path = get_theme_file_path('assets/css/review-lessons-style.css');
        $css_uri  = get_theme_file_uri('assets/css/review-lessons-style.css');

        if (!file_exists($css_path)) {
            return;
        }

        wp_enqueue_style(
            'lg-review-lessons-style',
            $css_uri,
            ['lg-v4-style'],
            filemtime($css_path)
        );
    }
endif;
add_action('wp_enqueue_scripts', 'lg_enqueue_review_lessons_style');

/**
 * React学習ビュー専用のCSS / JavaScriptを読み込む
 *
 * 対象：
 * - 固定ページ /review-lab/
 *
 * 役割：
 * - Viteのmanifest.jsonを読み取り、ハッシュ付きCSS/JSを自動で読み込む
 * - Highlighting Code Block / Prism のCSS・JSを読み込む
 *
 * @return void
 */
if (!function_exists('lg_enqueue_review_lab_assets')) :
    function lg_enqueue_review_lab_assets()
    {
        if (!is_page('review-lab')) {
            return;
        }

        $manifest_path = get_theme_file_path('assets/review-lab/.vite/manifest.json');

        if (!file_exists($manifest_path)) {
            return;
        }

        $manifest = json_decode(file_get_contents($manifest_path), true);

        if (!is_array($manifest)) {
            return;
        }

        $entry = null;

        foreach ($manifest as $manifest_item) {
            if (!empty($manifest_item['isEntry'])) {
                $entry = $manifest_item;
                break;
            }
        }

        if (!$entry) {
            return;
        }

        if (!empty($entry['css']) && is_array($entry['css'])) {
            foreach ($entry['css'] as $index => $css_file) {
                $css_path = get_theme_file_path('assets/review-lab/' . $css_file);

                if (!file_exists($css_path)) {
                    continue;
                }

                wp_enqueue_style(
                    'lg-review-lab-style-' . $index,
                    get_theme_file_uri('assets/review-lab/' . $css_file),
                    [],
                    filemtime($css_path)
                );
            }
        }

        // Highlighting Code Block 用CSS
        wp_enqueue_style(
            'lg-review-lab-hcb-style',
            content_url('plugins/highlighting-code-block/build/css/hcb--light.css'),
            [],
            '2.2.0'
        );

        // Prism本体
        wp_enqueue_script(
            'lg-review-lab-prism',
            content_url('plugins/highlighting-code-block/assets/js/prism.js'),
            [],
            '2.2.0',
            true
        );

        // Highlighting Code Block 用JS
        wp_enqueue_script(
            'lg-review-lab-hcb-script',
            content_url('plugins/highlighting-code-block/build/js/hcb_script.js'),
            ['lg-review-lab-prism'],
            '2.2.0',
            true
        );

        // ビルド済JSは最後に読み込み
        if (!empty($entry['file'])) {
            $js_path = get_theme_file_path('assets/review-lab/' . $entry['file']);

            if (file_exists($js_path)) {
                wp_enqueue_script_module(
                    'lg-review-lab-app',
                    get_theme_file_uri('assets/review-lab/' . $entry['file']),
                    [],
                    filemtime($js_path)
                );
            }
        }
    }
endif;
add_action('wp_enqueue_scripts', 'lg_enqueue_review_lab_assets', 5);
