<!-- section-contact.php -->
<section id="contact" class="contact-section">
    <div class="container">
        <h2 class="section-title">Contact</h2>

        <!-- 入力ブロック -->
        <?php get_template_part('template-parts/form/form-input'); ?>
        <!-- 確認ブロック -->
        <?php get_template_part('template-parts/form/form-confirm'); ?>
        <!-- サンクスブロック -->
        <?php get_template_part('template-parts/form/form-thanks'); ?>

        <!-- 特定商取引法表記 -->
        <a class="tokushoho" href="<?= esc_url(home_url('/tokushoho')) ?>">
            特定商取引法に基づく表記
        </a>
    </div>
</section>