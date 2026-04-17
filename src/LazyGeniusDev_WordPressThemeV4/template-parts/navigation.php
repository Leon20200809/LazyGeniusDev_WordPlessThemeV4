<?php
// navigation.php

// テーマのデータ（グローバルナビゲーションメニューの登録）
function lg_get_nav_items()
{
    return [
        ['label' => 'Home', 'id' => ''],
        ['label' => 'About', 'id' => 'about'],
        ['label' => 'Skills', 'id' => 'skills'],
        ['label' => 'Works', 'id' => 'works'],
        ['label' => 'Flow', 'id' => 'flow'],
        ['label' => 'Contact', 'id' => 'contact'],
    ];
}

$nav_items = lg_get_nav_items();
?>

<nav
    id="primary-nav"
    class="primary-nav"
    data-lg-nav
    data-state="closed"
    aria-label="グローバルメニュー"
    >

    <ul class="primary-nav__list">
        <?php foreach ($nav_items as $nav_item): ?>
            <li class="primary-nav__item">
                <a class="primary-nav__link" href="<?= esc_url(lg_get_nav_href($nav_item['id'])); ?>">
                    <?= esc_html($nav_item['label']); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>