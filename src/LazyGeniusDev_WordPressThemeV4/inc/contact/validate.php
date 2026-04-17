<?php
/**
 * validate.php
 *
 * フォーム入力値の検証を行う。
 * handler.php から呼ばれる前提。
 * 役割は「エラー配列を返すだけ」。
 */

if (!defined('ABSPATH')) exit;

/**
 * お問い合わせフォームの入力値を検証する
 *
 * @param array $form_data    フォーム入力値
 * @param array $field_rules  項目ごとの使用設定
 * @return array<string, string>
 */
function lg_contact_validate(array $form_data, array $field_rules = []): array
{
    $errors = [];

    // 値を受け取る
    $name       = trim((string) ($form_data['name'] ?? ''));
    $kana       = trim((string) ($form_data['kana'] ?? ''));
    $email      = trim((string) ($form_data['email'] ?? ''));
    $tel        = trim((string) ($form_data['tel'] ?? ''));
    $visit_date = trim((string) ($form_data['visit_date'] ?? ''));
    $privacy    = (string) ($form_data['privacy'] ?? '');
    $message = trim((string) ($form_data['message'] ?? ''));

    // 項目が有効かどうか
    $is_enabled = function (string $field_name) use ($field_rules): bool {
        return !empty($field_rules[$field_name]['enabled']);
    };

    // 項目が必須かどうか
    $is_required = function (string $field_name) use ($field_rules): bool {
        return !empty($field_rules[$field_name]['required']);
    };

    // 名前
    if ($is_enabled('name')) {
        if ($is_required('name') && $name === '') {
            $errors['name'] = 'お名前を入力してください。';
        }
    }

    // フリガナ
    if ($is_enabled('kana')) {
        if ($is_required('kana') && $kana === '') {
            $errors['kana'] = 'フリガナを入力してください。';
        }
    }

    // メールアドレス
    if ($is_enabled('email')) {
        if ($is_required('email') && $email === '') {
            $errors['email'] = 'メールアドレスを入力してください。';
        } elseif ($email !== '' && !is_email($email)) {
            $errors['email'] = '正しいメールアドレスを入力してください。';
        }
    }

    // 電話番号
    if ($is_enabled('tel')) {
        if ($is_required('tel') && $tel === '') {
            $errors['tel'] = '電話番号を入力してください。';
        } elseif ($tel !== '') {
            $normalized_tel = preg_replace('/[^0-9]/', '', $tel);

            if ($normalized_tel === '') {
                $errors['tel'] = '正しい電話番号を入力してください。';
            } elseif (strlen($normalized_tel) < 10 || strlen($normalized_tel) > 11) {
                $errors['tel'] = '電話番号は10桁または11桁で入力してください。';
            }
        }
    }

    // 来店日時
    if ($is_enabled('visit_date')) {
        if ($is_required('visit_date') && $visit_date === '') {
            $errors['visit_date'] = '来店日時を入力してください。';
        }
    }

    // メッセージ（テキストエリア）
    if ($is_enabled('message')) {
    if ($message !== '' && mb_strlen($message) > 400) {
        $errors['message'] = 'お問い合わせ内容は400文字以内で入力してください。';
    }
}

    // プライバシーポリシー同意
    if ($is_enabled('privacy')) {
        if ($is_required('privacy') && $privacy !== '1') {
            $errors['privacy'] = 'プライバシーポリシーへの同意が必要です。';
        }
    }

    return $errors;
}