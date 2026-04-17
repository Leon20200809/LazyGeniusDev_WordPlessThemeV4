<!-- form-input.php -->
<div class="contact-step contact-step--input">
    <form class="contact-form" action="" method="post">
        <div class="contact-row">
            <label class="contact-row__label" for="contact-name">お名前</label>
            <input
                class="contact-row__control"
                type="text"
                id="contact-name"
                name="name"
                placeholder="お名前"
                required>
        </div>

        <div class="contact-row">
            <label class="contact-row__label" for="contact-email">メールアドレス</label>
            <input
                class="contact-row__control"
                type="email"
                id="contact-email"
                name="email"
                placeholder="メールアドレス"
                required>
        </div>

        <div class="contact-row">
            <p class="contact-row__label">ご依頼・ご相談の種別</p>
            <div class="contact-row__control radio-group">
                <label class="radio-option">
                    <input type="radio" name="subject" value="WEBページの相談・依頼" required>
                    <span>WEB制作のご依頼・ご相談</span>
                </label>
                <label class="radio-option">
                    <input type="radio" name="subject" value="開発の相談">
                    <span>業務システム等開発のご相談</span>
                </label>
            </div>
        </div>

        <div class="contact-row">
            <label class="contact-row__label" for="contact-message">ご依頼・ご相談の詳細</label>
            <textarea
                class="contact-row__control"
                id="contact-message"
                name="message"
                placeholder="例）予算○○円で○○みたいなホームページできますか？"
                required></textarea>
        </div>

        <div class="contact-row contact-row--privacy">
            <p class="contact-row__label">個人情報の取り扱い</p>

            <div class="contact-row__control">
                <label class="contact-privacy">
                    <input type="checkbox" name="privacy" value="1" required>
                    <span>
                        <a href="<?= esc_url(home_url('/tokushoho')) ?>">プライバシーポリシー</a>
                        に同意する
                    </span>
                </label>
            </div>
        </div>

        <div class="contact-actions">
            <button type="button" class="js-confirm-btn">確認する</button>
        </div>
    </form>
</div>