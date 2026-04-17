<?php
/**
 * mailer.php
 *
 * メール送信担当。
 * 最初は管理者通知メールだけ送る。
 */

if (!defined('ABSPATH')) exit;

/**
 * 管理者通知メールを送信する
 *
 * @param array $form_data フォーム入力値
 * @return bool 送信成功なら true
 */
function lg_contact_send_admin_mail(array $form_data): bool
{
    $name       = sanitize_text_field($form_data['name'] ?? '');
    $kana       = sanitize_text_field($form_data['kana'] ?? '');
    $email      = sanitize_email($form_data['email'] ?? '');
    $tel        = sanitize_text_field($form_data['tel'] ?? '');
    $visit_date = sanitize_text_field($form_data['visit_date'] ?? '');
    $message    = trim(wp_unslash($form_data['message'] ?? ''));

    // 送信先
    $to = get_option('admin_email');

    // 件名
    $subject = '【お問い合わせ】' . ($name !== '' ? $name . '様より' : '新規送信');

    // 本文
    $body  = "お問い合わせがありました。\n\n";
    $body .= "【お名前】\n" . ($name !== '' ? $name : '未入力') . "\n\n";
    $body .= "【フリガナ】\n" . ($kana !== '' ? $kana : '未入力') . "\n\n";
    $body .= "【メールアドレス】\n" . ($email !== '' ? $email : '未入力') . "\n\n";
    $body .= "【電話番号】\n" . ($tel !== '' ? $tel : '未入力') . "\n\n";
    $body .= "【来店日時】\n" . ($visit_date !== '' ? $visit_date : '未入力') . "\n\n";
    $body .= "【お問い合わせ内容】\n" . ($message !== '' ? $message : '未入力') . "\n";

    // ヘッダー
    $headers = [];

    if ($email !== '') {
        $headers[] = 'Reply-To: ' . $email;
    }

    return wp_mail($to, $subject, $body, $headers);
}