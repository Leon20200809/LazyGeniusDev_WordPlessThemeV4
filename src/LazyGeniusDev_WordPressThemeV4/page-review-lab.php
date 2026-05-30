<?php
// page-review-lab.php

/**
 * Template for the React Review Lab page.
 *
 * 対象：
 * - 固定ページ /review-lab/
 *
 * 役割：
 * - WordPress側では header / footer / Reactのマウント先だけを用意する
 * - 本文 the_content() は使わない
 * - React学習ビュー専用の空の土地として扱う
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<div class="review-lab-page">
    <div id="review-lessons-app"></div>
</div>

<?php
get_footer();