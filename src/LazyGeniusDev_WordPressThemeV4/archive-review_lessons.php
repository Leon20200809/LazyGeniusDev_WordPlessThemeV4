<?php
// archive-review_lessons.php

/**
 * Web開発復習ノート 一覧テンプレート
 *
 * 役割：
 * - カスタム投稿タイプ review_lessons の一覧を表示する
 * - 既存CSSの container / section-title / skills 系カードを流用する
 */

get_header();
?>

<main>
    <section class="review-lessons-archive">
        <div class="container">
            <h1 class="section-title">Web開発復習ノート</h1>

            <?php if (have_posts()) : ?>
                <div class="skills__grid">
                    <?php while (have_posts()) : the_post(); ?>
                        <article class="skills__card">
                            <h2 class="skills__name">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('thumbnail'); ?>
                                    <?php the_title(); ?>
                                </a>
                            </h2>

                            <?php if (has_excerpt()) : ?>
                                <p class="skills__text mb-2">
                                    <?php echo esc_html(get_the_excerpt()); ?>
                                </p>
                            <?php endif; ?>

                            <div class="skills__text mb-2">
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

                            <a href="<?php the_permalink(); ?>">
                                続きを読む
                            </a>
                        </article>
                    <?php endwhile; ?>
                </div>

                <div class="mb-4">
                    <?php the_posts_pagination(); ?>
                </div>
            <?php else : ?>
                <p class="skills__text">まだ復習ノートはありません。</p>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>