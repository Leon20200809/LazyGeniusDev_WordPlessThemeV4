<?php
// single-review_lessons.php

/**
 * Web開発復習ノート 個別テンプレート
 *
 * 役割：
 * - カスタム投稿タイプ review_lessons の個別記事を表示する
 * - 章タクソノミー lesson_chapter と技術タグ lesson_tag を表示する
 * - Gutenberg本文を読みやすい幅で表示する
 * - 前後記事リンクと一覧ページへの導線を表示する
 */

get_header();
?>

<main>
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <article class="review-lesson-single">
                <div class="review-lesson-single__inner">
                    <header class="review-lesson-single__header">
                        <h1 class="review-lesson-single__title">
                            <?php the_title(); ?>
                        </h1>

                        <?php if (has_post_thumbnail()) : ?>
                            <div class="review-lesson-single__thumbnail-wrap">
                                <?php the_post_thumbnail('large', ['class' => 'review-lesson-single__thumbnail']); ?>
                            </div>
                        <?php endif; ?>

                        <div class="review-lesson-single__terms">
                            <?php
                            $chapters = get_the_terms(get_the_ID(), 'lesson_chapter');
                            if (!empty($chapters) && !is_wp_error($chapters)) :
                            ?>
                                <p class="review-lesson-single__term-row">
                                    <span class="review-lesson-single__term-label">章：</span>

                                    <?php foreach ($chapters as $chapter) : ?>
                                        <span class="review-lesson-single__term">
                                            <?php echo esc_html($chapter->name); ?>
                                        </span>
                                    <?php endforeach; ?>
                                </p>
                            <?php endif; ?>

                            <?php
                            $tags = get_the_terms(get_the_ID(), 'lesson_tag');
                            if (!empty($tags) && !is_wp_error($tags)) :
                            ?>
                                <p class="review-lesson-single__term-row">
                                    <span class="review-lesson-single__term-label">技術タグ：</span>

                                    <?php foreach ($tags as $tag) : ?>
                                        <span class="review-lesson-single__term">
                                            <?php echo esc_html($tag->name); ?>
                                        </span>
                                    <?php endforeach; ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </header>

                    <div class="review-lesson-single__content">
                        <?php the_content(); ?>
                    </div>

                    <nav class="review-lesson-single__nav" aria-label="前後の記事">
                        <div class="review-lesson-single__nav-prev">
                            <?php previous_post_link('%link', '← 前の記事'); ?>
                        </div>

                        <div class="review-lesson-single__nav-next">
                            <?php next_post_link('%link', '次の記事 →'); ?>
                        </div>
                    </nav>

                    <p class="review-lesson-single__archive-link-wrap">
                        <a class="review-lesson-single__archive-link" href="<?php echo esc_url(get_post_type_archive_link('review_lessons')); ?>">
                            Web開発復習ノート一覧へ戻る
                        </a>
                    </p>
                </div>
            </article>
        <?php endwhile; ?>
    <?php endif; ?>
</main>

<?php get_footer(); ?>