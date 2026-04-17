<?php
/**
 * handler.php
 *
 * Ajaxの入口。
 * contact-form.js から送られた FormData を受け取り、
 * validate.php と mailer.php を呼び出し、
 * 最後に JSON を返す。
 */
if (!defined('ABSPATH')) exit;

// wp_ajax_（アクション名）:ログインしているユーザー
add_action('wp_ajax_lg_contact_send', 'lg_contact_send');

// wp_ajax_nopriv_（アクション名）: 一般の閲覧者からの通信
add_action('wp_ajax_nopriv_lg_contact_send', 'lg_contact_send');

function lg_contact_send()
{
    // nonce確認（名前は実際のフォームに合わせて後で統一）
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'lg_contact_nonce')) {
        wp_send_json_error([
            'message' => '不正なリクエストです。',
        ]);
    }

    // 今のフォームで使う項目設定
    $field_rules = [
        'name' => [
            'enabled'  => true,
            'required' => true,
        ],
        'kana' => [
            'enabled'  => false,
            'required' => false,
        ],
        'email' => [
            'enabled'  => true,
            'required' => true,
        ],
        'tel' => [
            'enabled'  => false,
            'required' => false,
        ],
        'visit_date' => [
            'enabled'  => false,
            'required' => false,
        ],
        'message' => [
            'enabled'  => true,
            'required' => false,
        ],
        'privacy' => [
            'enabled'  => true,
            'required' => true,
        ],
    ];

    $form_data = wp_unslash($_POST);

    $errors = lg_contact_validate($form_data, $field_rules);

    if (!empty($errors)) {
        wp_send_json_error([
            'message' => '入力内容を確認してください。',
            'errors'  => $errors,
        ]);
    }

    wp_send_json_success([
        'message' => 'バリデーション通過',
        "data" => $form_data,
    ]);

    $mail_sent = lg_contact_send_admin_mail($form_data);

    if (!$mail_sent) {
        wp_send_json_error([
            'message' => 'メール送信に失敗しました。',
        ]);
    }

    wp_send_json_success([
        'message' => '送信が完了しました。',
    ]);
}

// ========================================
// WordPress関数メモ
// ========================================

/*
wp_ajax_アクション名
- ログイン中ユーザー向けのAjax処理を登録する

wp_ajax_nopriv_アクション名
- 未ログインユーザー向けのAjax処理を登録する
- お問い合わせフォームではこちらも必要

add_action()
- WordPressの決まったタイミングで自作関数を呼ぶ

wp_verify_nonce()
- nonceが正しいか確認する
- 自分の画面から送った通信かどうかを確認する役目

wp_send_json_error()
- Ajax通信で失敗時のJSONを返す
- 実行後はそこで処理終了

wp_send_json_success()
- Ajax通信で成功時のJSONを返す
- 実行後はそこで処理終了

wp_unslash()
- WordPressが自動で付けたエスケープを外す
- $_POST をそのまま使う前に通すことが多い

$_POST
- フロント側のFormDataから送られてきた値
- name属性と同じキー名で入る

lg_contact_validate()
- validate.php に置いた自作関数
- 入力値チェックを行い、エラー配列を返す
*/
