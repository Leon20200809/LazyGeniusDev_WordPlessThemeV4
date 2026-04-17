<?php
$git_hub_url = "https://github.com/Leon20200809";
$works_items = [
    [
        'title' => 'WordPress オリジナルテーマ制作',
        'text' => 'オリジナルデザインをもとに構築した企業サイトです。',
        'image' => 'works-sample.jpg',
        'category' => 'wordpress',
        'url' => 'https://github.com/Leon20200809',
    ],
    [
        'title' => 'Laravel タスク管理アプリ',
        'text' => '認証機能付きでCRUD処理を実装した学習兼制作アプリです。',
        'image' => 'works-sample.jpg',
        'category' => 'laravel',
        'url' => $git_hub_url,
    ],
    [
        'title' => 'React UI / ツール制作',
        'text' => 'CSV表示やUI練習を目的としたフロントエンド制作です。',
        'image' => 'works-sample.jpg',
        'category' => 'react',
        'url' => $git_hub_url,
    ],
];
?>

<section class="works" id="works">
    <div class="container">
        <h2 class="section-title">Works</h2>

        <p class="works__lead">
            これまでに制作したWebサイトやアプリの一部を掲載しています。
        </p>

        <!-- タブ -->
        <div class="works__tabs" data-lg-tabs>

            <!-- タブボタングループ -->
            <div role="tablist" aria-label="制作実績カテゴリ" class="works__tab-list">
                <button
                    role="tab"
                    aria-selected="true"
                    aria-controls="works-panel-wordpress"
                    id="works-tab-wordpress"
                    tabindex="0"
                    class="works__tab-button">
                    WordPress
                </button>

                <button
                    role="tab"
                    aria-selected="false"
                    aria-controls="works-panel-laravel"
                    id="works-tab-laravel"
                    tabindex="-1"
                    class="works__tab-button">
                    PHP / Laravel
                </button>

                <button
                    role="tab"
                    aria-selected="false"
                    aria-controls="works-panel-react"
                    id="works-tab-react"
                    tabindex="-1"
                    class="works__tab-button">
                    React / JavaScript
                </button>
            </div>

            <!-- WordPressタブ -->
            <div
                id="works-panel-wordpress"
                role="tabpanel"
                aria-labelledby="works-tab-wordpress"
                class="works__panel">
                <div class="works__grid">
                    <?php foreach ($works_items as $work_item) : ?>
                        <?php if ($work_item['category'] !== 'wordpress') continue; ?>

                        <article class="works__card">
                            <a href="<?php echo esc_url($work_item['url']); ?>">
                                <div class="works__image">
                                    <img
                                        src="<?= esc_url(lg_get_img_uri('/' . $work_item['image'])); ?>"
                                        alt="<?= esc_attr($work_item['title']); ?>">
                                </div>
                            </a>

                            <div class="works__body">
                                <h3 class="works__name">
                                    <?php echo esc_html($work_item['title']); ?>
                                </h3>

                                <p class="works__text">
                                    <?php echo esc_html($work_item['text']); ?>
                                </p>
                            </div>

                        </article>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Laravelタブ -->
            <div
                id="works-panel-laravel"
                role="tabpanel"
                aria-labelledby="works-tab-laravel"
                class="works__panel"
                hidden>
                <div class="works__grid">
                    <?php foreach ($works_items as $work_item) : ?>
                        <?php if ($work_item['category'] !== 'laravel') continue; ?>

                        <article class="works__card">
                            <a href="<?php echo esc_url($work_item['url']); ?>">
                                <div class="works__image">
                                    <img
                                        src="<?= esc_url(lg_get_img_uri('/' . $work_item['image'])); ?>"
                                        alt="<?= esc_attr($work_item['title']); ?>">
                                </div>
                            </a>

                            <div class="works__body">
                                <h3 class="works__name">
                                    <?php echo esc_html($work_item['title']); ?>
                                </h3>

                                <p class="works__text">
                                    <?php echo esc_html($work_item['text']); ?>
                                </p>
                            </div>

                        </article>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- reactタブ -->
            <div
                id="works-panel-react"
                role="tabpanel"
                aria-labelledby="works-tab-react"
                class="works__panel"
                hidden>
                <div class="works__grid">
                    <?php foreach ($works_items as $work_item) : ?>
                        <?php if ($work_item['category'] !== 'react') continue; ?>

                        <article class="works__card">
                            <a href="<?php echo esc_url($work_item['url']); ?>">
                                <div class="works__image">
                                    <img
                                        src="<?= esc_url(lg_get_img_uri('/' . $work_item['image'])); ?>"
                                        alt="<?= esc_attr($work_item['title']); ?>">
                                </div>
                            </a>

                            <div class="works__body">
                                <h3 class="works__name">
                                    <?php echo esc_html($work_item['title']); ?>
                                </h3>

                                <p class="works__text">
                                    <?php echo esc_html($work_item['text']); ?>
                                </p>
                            </div>

                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>