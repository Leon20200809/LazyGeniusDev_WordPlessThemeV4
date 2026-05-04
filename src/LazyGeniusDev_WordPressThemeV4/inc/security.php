<?php

/**
 * security.php
 *
 * セキュリティ関連の処理をまとめるファイル。
 *
 * 今回のMVPでは、サイト全体に最低限のセキュリティヘッダーを追加する。
 * CSP や HSTS は影響範囲が大きいため、まずは壊れにくいものだけ入れる。
 */

/**
 * セキュリティヘッダーを追加する。
 *
 * send_headers は、WordPress がHTTPヘッダーを送信する直前に実行されるフック。
 * header() を直接 functions.php に書くより、WordPressらしく安全に管理できる。
 */
function lg_add_security_headers()
{
    /**
     * X-Frame-Options
     *
     * クリックジャッキング対策。
     * 他サイトの iframe 内にこのサイトを埋め込まれにくくする。
     *
     * SAMEORIGIN:
     * 同じドメイン内からの iframe 表示は許可する。
     */
    header('X-Frame-Options: SAMEORIGIN');

    /**
     * X-Content-Type-Options
     *
     * MIMEタイプの推測を防ぐ。
     * ブラウザに「Content-Type を勝手に解釈するな」と命令する。
     *
     * nosniff:
     * ファイルの種類をブラウザが勝手に推測しないようにする。
     */
    header('X-Content-Type-Options: nosniff');

    /**
     * Referrer-Policy
     *
     * 外部サイトへ移動したときに、
     * どこまで参照元URLを渡すかを制御する。
     *
     * strict-origin-when-cross-origin:
     * 同じサイト内ではフルURLを送る。
     * 別サイトへはドメイン情報だけ送る。
     * HTTPS → HTTP のような安全でない移動では送らない。
     */
    header('Referrer-Policy: strict-origin-when-cross-origin');

    /**
     * Permissions-Policy
     *
     * ブラウザ機能の使用を制限する。
     * 今回は、普通のポートフォリオサイトで不要になりやすい機能を無効化する。
     *
     * geolocation=():
     * 位置情報を使わせない。
     *
     * microphone=():
     * マイクを使わせない。
     *
     * camera=():
     * カメラを使わせない。
     */
    header('Permissions-Policy: geolocation=(), microphone=(), camera=()');
}
add_action('send_headers', 'lg_add_security_headers');
