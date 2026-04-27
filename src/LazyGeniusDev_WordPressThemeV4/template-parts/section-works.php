<?php
$git_hub_url = 'https://github.com/Leon20200809';

$works_tabs = [
    'wordpress' => [
        'label' => 'WordPress',
    ],
    'laravel' => [
        'label' => 'PHP / Laravel',
    ],
    'react' => [
        'label' => 'React / JavaScript',
    ],
];

$works_items = [
    [
        'title' => 'WordPress オリジナルテーマ制作',
        'text' => 'オリジナルデザインをもとに構築した企業サイトです。',
        'tech' => 'WordPress / PHP / JavaScript / CSS',
        'point' => 'テンプレートパーツ化、CSS設計、フォーム実装など、再利用しやすく保守しやすい構成を意識して制作。',
        'image' => 'works-sample.jpg',
        'category' => 'wordpress',
        'url' => $git_hub_url,
    ],
    [
        'title' => 'Laravel 組織図表示アプリ',
        'text' => 'ログイン認証機能を備え、誰が誰の部下かを視覚的に表示するアプリです。',
        'tech' => 'Laravel / PHP / Blade / Tailwind CSS / MySQL',
        'point' => 'CSVインポート、ログイン認証、階層データの表示など、業務データを扱う実用性を意識して制作。',
        'image' => 'works-sample.jpg',
        'category' => 'laravel',
        'url' => $git_hub_url,
    ],
    [
        'title' => 'Next.js レジュメ管理アプリ',
        'text' => 'Google SheetsのCSVデータをもとに、Web履歴書と印刷用ページを表示するアプリです。',
        'tech' => 'Next.js / React / TypeScript / Tailwind CSS / Google Sheets',
        'point' => '情報を一元管理し、Web表示とPDF印刷に再利用できる構成を意識して制作。',
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

        <!-- タブパネル -->
        <div class="works__tabs" data-lg-tabs>
            <!-- タブリスト生成 -->
            <div role="tablist" aria-label="制作実績カテゴリ" class="works__tab-list">
                <?php $is_first_tab = true; ?>

                <?php foreach ($works_tabs as $category_key => $tab) : ?>
                    <button
                        role="tab"
                        aria-selected="<?= $is_first_tab ? 'true' : 'false'; ?>"
                        aria-controls="works-panel-<?= esc_attr($category_key); ?>"
                        id="works-tab-<?= esc_attr($category_key); ?>"
                        tabindex="<?= $is_first_tab ? '0' : '-1'; ?>"
                        class="works__tab-button">
                        <?= esc_html($tab['label']); ?>
                    </button>

                    <?php $is_first_tab = false; ?>
                <?php endforeach; ?>
            </div>

            <?php $is_first_panel = true; ?>

            <?php foreach ($works_tabs as $category_key => $tab) : ?>
                <div
                    id="works-panel-<?= esc_attr($category_key); ?>"
                    role="tabpanel"
                    aria-labelledby="works-tab-<?= esc_attr($category_key); ?>"
                    class="works__panel"
                    <?= $is_first_panel ? '' : 'hidden'; ?>>

                    <div class="works__grid">
                        <?php foreach ($works_items as $work_item) : ?>
                            <?php if ($work_item['category'] !== $category_key) continue; ?>

                            <article class="works__card">
                                <a
                                    href="<?= esc_url($work_item['url']); ?>"
                                    class="works__link"
                                    target="_blank"
                                    rel="noopener noreferrer">

                                    <div class="works__image">
                                        <img
                                            src="<?= esc_url(lg_get_img_uri('/' . $work_item['image'])); ?>"
                                            alt="<?= esc_attr($work_item['title']); ?>">
                                    </div>
                                </a>

                                <div class="works__body">
                                    <h3 class="works__name">
                                        <?= esc_html($work_item['title']); ?>
                                    </h3>

                                    <p class="works__text">
                                        <?= esc_html($work_item['text']); ?>
                                    </p>

                                    <dl class="works__meta">
                                        <div class="works__meta-item">
                                            <dt>使用技術</dt>
                                            <dd><?= esc_html($work_item['tech']); ?></dd>
                                        </div>

                                        <div class="works__meta-item">
                                            <dt>意識したこと</dt>
                                            <dd><?= esc_html($work_item['point']); ?></dd>
                                        </div>
                                    </dl>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                </div>

                <?php $is_first_panel = false; ?>
            <?php endforeach; ?>
        </div>

        <!-- 実績一覧 -->
        <div class="works__support">
            <h3 class="works__support-title">Client Work / Support</h3>

            <p class="works__support-lead">
                デザイナーからの依頼をもとに、既存サイトの修正、LP制作、フォーム改修、CSS調整、公開対応などを行っています。
            </p>

            <div class="works__support-grid">
                <div class="works__support-item">
                    <h4>WordPressカスタマイズ</h4>
                    <p>既存テーマやサイトの修正、表示調整、機能追加に対応。</p>
                </div>

                <div class="works__support-item">
                    <h4>LP制作</h4>
                    <p>HTML / CSS / JavaScript を用いたランディングページ制作。</p>
                </div>

                <div class="works__support-item">
                    <h4>フォーム改修</h4>
                    <p>問い合わせフォームの調査、エラー対応、送信改善。</p>
                </div>

                <div class="works__support-item">
                    <h4>技術相談</h4>
                    <p>デザイナーからの実装相談、仕様整理、対応方針の提案。</p>
                </div>

                <div class="works__support-item">
                    <h4>CSS調整</h4>
                    <p>レイアウト崩れ、余白、レスポンシブ、デザイン再現の調整。</p>
                </div>

                <div class="works__support-item">
                    <h4>画像・動画配置</h4>
                    <p>サイト内コンテンツとしての画像・動画の配置、表示調整。</p>
                </div>

                <div class="works__support-item">
                    <h4>公開対応</h4>
                    <p>サーバー上で実際にWebサイトを見られる状態まで対応。</p>
                </div>
            </div>
        </div>
    </div>
</section>