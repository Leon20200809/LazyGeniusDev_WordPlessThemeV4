/**
 * contact-form.js
 *
 * Contactフォーム全体のUI制御。
 * 入力 → 確認 → Ajax送信 → サンクス表示を担当する。
 */

/*=================================================
コンタクトフォーム用
===================================================*/
document.addEventListener("DOMContentLoaded", () => {
    // ===== 要素取得 =====
    const contactSection = document.getElementById('contact');
    if (!contactSection) return;

    const confirmBtn = contactSection.querySelector(".js-confirm-btn");
    const backBtn = contactSection.querySelector(".js-back-btn");

    const inputStep = contactSection.querySelector('.contact-step--input');
    const confirmStep = contactSection.querySelector('.contact-step--confirm');
    const thanksStep = contactSection.querySelector('.contact-step--thanks');

    const form = contactSection.querySelector('.contact-form');
    const submitBtn = contactSection.querySelector('.js-submit-btn');

    if (!form || !submitBtn || !confirmStep) return;

    // 確認表示先
    const outName = contactSection.querySelector(".js-confirm-name");
    const outEmail = contactSection.querySelector(".js-confirm-email");
    const outSubject = contactSection.querySelector(".js-confirm-subject");
    const outMessage = contactSection.querySelector(".js-confirm-message");
    const outPrivacy = contactSection.querySelector(".js-confirm-privacy");

    // ===== ユーティリティ =====
    // name の中から「チェックされている要素の値」だけを抜き出す
    const getCheckedValue = (name) => {
        const checked = form.querySelector(`input[name="${name}"]:checked`);
        return checked ? checked.value : "";
    };

    // フォームの値を取得
    const getFormValues = () => {
        return {
            name: form.querySelector('input[name="name"]')?.value ?? '',
            email: form.querySelector('input[name="email"]')?.value ?? '',
            subject: getCheckedValue('subject'),
            message: form.querySelector('textarea[name="message"]')?.value ?? '',
            privacy: form.querySelector('input[name="privacy"]')?.checked ? '1' : '',
        };
    };

    // エスケープ処理　XSS対策
    const escapeHtml = (str) =>
        String(str)
            .replaceAll("&", "&amp;")
            .replaceAll("<", "&lt;")
            .replaceAll(">", "&gt;")
            .replaceAll('"', "&quot;")
            .replaceAll("'", "&#039;");

    const nl2br = (str) => escapeHtml(str).replaceAll("\n", "<br>");

    // ===== 確認へボタン =====
    confirmBtn.addEventListener("click", () => {
        // HTMLのrequiredを活かす（未入力なら止まる）
        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }

        // ユーザー入力取得
        const formValues = getFormValues();

        // 確認欄へ反映（※XSS対策としてエスケープ必須）
        outName.innerHTML = escapeHtml(formValues.name);
        outEmail.innerHTML = escapeHtml(formValues.email);
        outSubject.innerHTML = escapeHtml(formValues.subject);
        outMessage.innerHTML = nl2br(formValues.message);
        outPrivacy.innerHTML = formValues.privacy === '1' ? '同意済み' : '未同意';

        // 表示切替
        inputStep.hidden = true;
        confirmStep.hidden = false;

        // 先頭へスクロール
        window.scrollTo({
            top: contactSection.offsetTop,
            behavior: "smooth",
        });
    });

    // ===== 入力へ戻るボタン =====
    backBtn.addEventListener("click", () => {
        confirmStep.hidden = true;
        inputStep.hidden = false;

        window.scrollTo({
            top: contactSection.offsetTop,
            behavior: "smooth",
        });
    });

    // ===== 送信ボタン押した =====
    submitBtn.addEventListener('click', async () => {
        // 送信中の連打防止
        if (submitBtn.disabled) return;

        // ユーザー入力取得
        const formValues = getFormValues();

        // 送信データ作成
        const formData = new FormData();
        // WordPress Ajax用
        formData.append('action', 'lg_contact_send');
        formData.append('nonce', window.lgContact?.nonce || '');

        // ユーザー入力詰め込み
        formData.append('name', formValues.name);
        formData.append('email', formValues.email);
        formData.append('subject', formValues.subject);
        formData.append('message', formValues.message);
        formData.append('privacy', formValues.privacy);

        const originalText = submitBtn.textContent;
        submitBtn.classList.add('is-loading');
        submitBtn.disabled = true;
        submitBtn.textContent = '送信中...';

        try {
            const response = await fetch(window.lgContact?.ajaxurl || '', {
                method: 'POST',
                body: formData,
            });

            if (!response.ok) {
                throw new Error('ネットワークエラーが発生しました。');
            }

            const result = await response.json();

            if (!result.success) {
                const message = result?.data?.message || '送信に失敗しました。';
                throw new Error(message);
            }

            // 成功時：確認を閉じて完了を表示
            confirmStep.hidden = true;

            if (thanksStep) {
                thanksStep.hidden = false;
            } else {
                alert('送信が完了しました。');
            }

            window.scrollTo({
                top: contactSection.offsetTop,
                behavior: 'smooth',
            });

        } catch (error) {
            alert(error.message || '送信中にエラーが発生しました。');
            submitBtn.disabled = false;
            submitBtn.textContent = originalText;
            submitBtn.classList.remove('is-loading');
            return;
        }

        // 成功後はボタンをそのまま無効化しておく
        submitBtn.classList.remove('is-loading');
        submitBtn.textContent = '送信完了';
    });
});