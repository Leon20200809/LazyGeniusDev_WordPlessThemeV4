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
        ['label' => 'Review Lab', 'url' => home_url('/review-lab/')],
    ];
}

$nav_items = lg_get_nav_items();
?>

<nav
    id="primary-nav"
    class="primary-nav"
    data-lg-nav
    data-state="closed"
    aria-label="グローバルメニュー">

    <ul class="primary-nav__list">
        <?php foreach ($nav_items as $nav_item): ?>
            <?php
            $href = isset($nav_item['url']) ? $nav_item['url'] : lg_get_nav_href($nav_item['id']);
            ?>

            <li class="primary-nav__item">
                <a class="primary-nav__link" href="<?= esc_url($href); ?>">
                    <?= esc_html($nav_item['label']); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>