<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- favicon -->
    <link rel="icon" href="<?= esc_url(lg_get_img_uri("/favicon.ico")); ?>" sizes="any">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <header class="site-header">
        <div class="site-header__inner container">

            <a class="site-header__logo" href="<?= esc_url(home_url('/')); ?>" aria-label="<?php bloginfo('name'); ?> ホームへ">
                <img
                    src="<?= esc_url(lg_get_img_uri("/sitelogo-header.png")); ?>"
                    alt="<?= esc_attr(get_bloginfo('name')); ?>">
            </a>

            <button
                class="lg-nav-toggle"
                type="button"
                data-lg-hamburger
                aria-label="メニューを開閉"
                aria-controls="primary-nav"
                aria-expanded="false">
                <span class="sr-only">メニュー</span>
                <span aria-hidden="true"></span>
            </button>

            <?php get_template_part("/template-parts/navigation") ?>

        </div>
    </header>