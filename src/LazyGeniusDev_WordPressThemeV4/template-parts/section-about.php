<!-- section-about.php -->
<section class="about" id="about">
    <div class="container">
        <h2 class="section-title">About</h2>

        <div class="about__body">
            <div class="about__text">
                <p class="about__lead">
                    Web開発を通じて、手作業や非効率を減らし、長く使える仕組みを作ることを重視しています。
                </p>

                <p class="about__description">
                    デザインだけではなく、フォーム、管理画面、CSV連携、
                    カスタム投稿、簡単な業務効率化ツールまで、
                    「使える仕組み」を作ることが得意です。
                </p>

                <p class="about__description">
                    Laravel・React・TypeScript・Next.jsを用いた開発にも取り組み、
                    業務改善につながるWebアプリ開発へ領域を広げています。
                </p>
            </div>

            <div class="about__profile">
                <figure class="about__visual">
                    <img
                        src="<?= esc_url(lg_get_img_uri('/profile-leonc.webp')); ?>"
                        alt="Leon.Cのキャラクター風プロフィールイラスト"
                        class="about__image">
                </figure>

                <div class="about__info">
                    <dl class="about__list">
                        <div class="about__item">
                            <dt>得意分野</dt>
                            <dd>PHP / JavaScript / WordPress / Laravel</dd>
                        </div>

                        <div class="about__item">
                            <dt>制作できるもの</dt>
                            <dd>企業サイト / LP / フォーム / 管理画面 / 小規模Webアプリ</dd>
                        </div>

                        <div class="about__item">
                            <dt>開発思想</dt>
                            <dd>非エンジニアにも伝わるよう、例えを用いて仕組みを分かりやすく説明し、認識のズレを防ぐことを重視しています。</dd>
                            <dd>保守しやすさ、責務分離、再利用性を重視し、後から直しやすい構成で実装します。</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</section>