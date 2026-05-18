<?php
// single-review_lessons.php

/**
 * Web開発復習ノート 個別テンプレート
 *
 * 役割：
 * - カスタム投稿タイプ review_lessons の個別記事を表示する
 * - 章 / 技術タグ / 本文を最小構成で表示する
 */

get_header();
?>

<main>
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <article class="review-lessons-single">
                <section>
                    <div class="container">
                        <h1 class="section-title"><?php the_title(); ?></h1>

                        <?php if (has_post_thumbnail()) : ?>
                            <div class="mb-4">
                                <?php the_post_thumbnail('large'); ?>
                            </div>
                        <?php endif; ?>

                        <div class="skills__text mb-4">
                            <?php
                            $chapters = get_the_terms(get_the_ID(), 'lesson_chapter');
                            if (!empty($chapters) && !is_wp_error($chapters)) :
                            ?>
                                <p class="mb-1">
                                    章：
                                    <?php foreach ($chapters as $chapter) : ?>
                                        <span><?php echo esc_html($chapter->name); ?></span>
                                    <?php endforeach; ?>
                                </p>
                            <?php endif; ?>

                            <?php
                            $tags = get_the_terms(get_the_ID(), 'lesson_tag');
                            if (!empty($tags) && !is_wp_error($tags)) :
                            ?>
                                <p class="mb-1">
                                    技術タグ：
                                    <?php foreach ($tags as $tag) : ?>
                                        <span><?php echo esc_html($tag->name); ?></span>
                                    <?php endforeach; ?>
                                </p>
                            <?php endif; ?>
                        </div>

                        <div class="prose">
                            <?php the_content(); ?>
                        </div>

                        <div class="flex justify-between gap-2 mb-4">
                            <div>
                                <?php previous_post_link('%link', '← 前の記事'); ?>
                            </div>

                            <div>
                                <?php next_post_link('%link', '次の記事 →'); ?>
                            </div>
                        </div>

                        <p>
                            <a href="<?php echo esc_url(get_post_type_archive_link('review_lessons')); ?>">
                                Web開発復習ノート一覧へ戻る
                            </a>
                        </p>
                    </div>
                </section>
            </article>
        <?php endwhile; ?>
    <?php endif; ?>
</main>

<?php get_footer(); ?>