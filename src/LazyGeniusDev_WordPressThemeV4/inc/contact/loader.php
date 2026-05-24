<?php
// <!-- loader.php -->
if (!defined('ABSPATH')) exit;

require_once __DIR__ . '/validate.php';
require_once __DIR__ . '/antispam.php';
require_once __DIR__ . '/mailer.php';
require_once __DIR__ . '/handler.php';

// ajaxurl nonce をheadに登録
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
