<?php
// <!-- enqueue.php -->
/**
 * ------------------------------------------------------------
 * LazyGeniusDev_WordPressThemeV4 : Enqueue (Minimal)
 * ------------------------------------------------------------
 * 目的：
 *   - 基本CSSと初期化JSを読み込む
 *   - パスとバージョンを変数化して保守性を確保
 * ------------------------------------------------------------
 */
if (!defined('ABSPATH')) exit;

// LGアセット読み込み
if (! function_exists('lg_enqueue_minimal_assets')) :
    function lg_enqueue_minimal_assets()
    {
        $theme     = wp_get_theme();
        $ver       = $theme->get('Version') ?: '1.0.0';
        $uri       = get_stylesheet_directory_uri();

        // CSS
        wp_enqueue_style('lg-v4-style', $uri . '/assets/css/style.css', [], $ver);

        // JS
        wp_enqueue_script_module('lg-v4-init', $uri . '/assets/js/init.js', [], $ver, ['in_footer' => true, 'type' => 'module', 'strategy' => 'defer']);

        // Google Fonts
        wp_enqueue_style(
            'lg-google-fonts',
            'https://fonts.googleapis.com/css2?family=Shippori+Mincho:wght@400;500;700&family=Noto+Sans+JP:wght@400;500;700&display=swap',
            [],
            null
        );
    }
endif;
add_action('wp_enqueue_scripts', 'lg_enqueue_minimal_assets');

// 
if (! function_exists('lg_print_contact_data')) :
    function lg_print_contact_data()
    {
        ?>
        <script>
            window.lgContact = {
                ajaxurl: '<?= esc_url(admin_url('admin-ajax.php')); ?>',
                nonce: '<?= esc_attr(wp_create_nonce('lg_contact_nonce')); ?>'
            };
        </script>
        <?php
    }
endif;
add_action('wp_head', 'lg_print_contact_data', 1);

require_once get_theme_file_path('/inc/contact/loader.php');
