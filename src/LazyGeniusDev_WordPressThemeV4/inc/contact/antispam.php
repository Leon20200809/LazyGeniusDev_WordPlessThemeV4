<?php

/**
 * antispam.php
 *
 * 問い合わせフォームのスパム・連投対策担当。
 */

if (!defined('ABSPATH')) exit;

/**
 * 短時間の連続送信をチェックする
 *
 * 同じメールアドレス、またはメール未入力時は同じIPアドレスからの
 * 短時間の再送信を防ぐ。
 *
 * @param array $form_data フォーム入力値
 * @return true|WP_Error 問題なければ true。連投なら WP_Error。
 */
function lg_contact_check_rate_limit(array $form_data)
{
    $email = sanitize_email($form_data['email'] ?? '');
    $remote_addr = $_SERVER['REMOTE_ADDR'] ?? 'unknown';

    // メールアドレスがあればメール基準、なければIP基準で判定する
    $key_source = $email !== '' ? $email : $remote_addr;

    // transient のキーにそのままメールやIPを出さないため md5 化する
    $transient_key = 'lg_contact_rate_limit_' . md5($key_source);

    if (get_transient($transient_key)) {
        return new WP_Error(
            'lg_contact_rate_limited',
            '短時間に複数回送信されています。しばらく待ってから再度お試しください。'
        );
    }

    // 60秒間だけ送信済みフラグを保存する
    set_transient($transient_key, true, 60);

    return true;
}
