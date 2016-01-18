<main id="contents">
    <section class="readme">
        <p>作業伝票システムのメンテナンスメニューです。</p>
    </section>
    <article class="container">
        <p class="mt50 centering">項目を選択してください。</p>
        <nav class="navBasic">
            <ul class="ulNavMainte">
                <li><a class="btnNavBasic iconList" href="<?php echo \yii\helpers\BaseUrl::base(true)?>/list-staff.html">作業者一覧</a></li>
                <li><a class="btnNavBasic iconXls" href="<?php echo \yii\helpers\BaseUrl::base(true)?>/update-commodity.html">商品情報更新</a></li>
            </ul>
        </nav>
    </article>
</main>
<footer id="footer">
    <div class="toolbar"><a class="btnBack" href="<?php echo \yii\helpers\BaseUrl::base(true)?>">戻る</a></div>
    <p class="copyright">Copyright(C) Usami Koyu Corp. All Rights Reserved.</p>
</footer>