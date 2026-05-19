<?php
// archive-review_lessons.php

/**
 * Web開発復習ノート 一覧テンプレート
 *
 * 役割：
 * - カスタム投稿タイプ review_lessons の一覧を表示する
 * - review_lessons 専用CSSのクラスでレイアウトを整える
 * - 章タクソノミー lesson_chapter と技術タグ lesson_tag を表示する
 */

get_header();
?>

<main>
    <section class="review-lessons-archive">
        <div class="review-lessons-archive__inner">
            <h1 class="review-lessons-archive__title">Web開発復習ノート</h1>

            <?php if (have_posts()) : ?>
                <div class="review-lessons-archive__list">
                    <?php while (have_posts()) : the_post(); ?>
                        <article class="review-lessons-archive__item">
                            <?php if (has_post_thumbnail()) : ?>
                                <a class="review-lessons-archive__thumbnail-link" href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('medium', ['class' => 'review-lessons-archive__thumbnail']); ?>
                                </a>
                            <?php endif; ?>

                            <h2 class="review-lessons-archive__item-title">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h2>

                            <?php if (has_excerpt()) : ?>
                                <p class="review-lessons-archive__excerpt">
                                    <?php echo esc_html(get_the_excerpt()); ?>
                                </p>
                            <?php endif; ?>

                            <div class="review-lessons-archive__terms">
                                <?php
                                $chapters = get_the_terms(get_the_ID(), 'lesson_chapter');
                                if (!empty($chapters) && !is_wp_error($chapters)) :
                                ?>
                                    <p class="review-lessons-archive__term-row">
                                        <span class="review-lessons-archive__term-label">章：</span>

                                        <?php foreach ($chapters as $chapter) : ?>
                                            <span class="review-lessons-archive__term">
                                                <?php echo esc_html($chapter->name); ?>
                                            </span>
                                        <?php endforeach; ?>
                                    </p>
                                <?php endif; ?>

                                <?php
                                $tags = get_the_terms(get_the_ID(), 'lesson_tag');
                                if (!empty($tags) && !is_wp_error($tags)) :
                                ?>
                                    <p class="review-lessons-archive__term-row">
                                        <span class="review-lessons-archive__term-label">技術タグ：</span>

                                        <?php foreach ($tags as $tag) : ?>
                                            <span class="review-lessons-archive__term">
                                                <?php echo esc_html($tag->name); ?>
                                            </span>
                                        <?php endforeach; ?>
                                    </p>
                                <?php endif; ?>
                            </div>

                            <a class="review-lessons-archive__link" href="<?php the_permalink(); ?>">
                                続きを読む
                            </a>
                        </article>
                    <?php endwhile; ?>
                </div>

                <div class="review-lessons-archive__pagination">
                    <?php the_posts_pagination(); ?>
                </div>
            <?php else : ?>
                <p class="review-lessons-archive__empty">まだ復習ノートはありません。</p>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>