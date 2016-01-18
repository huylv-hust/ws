<main id="contents">
    <section class="readme">
        <p>宇佐美ＳＳをご利用いただき、ありがとうございます。</p>
    </section>
    <article class="container">
        <p class="centering">項目を選択してください。</p>
        <nav class="navBasic">
            <ul class="ulNavBasic">
                <li><a href="#" class="btnNavBasic iconCard" onclick="fncCard();">Usappy<br />カード番号変更</a></li>
                <li><a href="#" class="btnNavBasic iconRegistWork" onclick="fncType('regist');">作業伝票作成</a></li>
                <li><a href="<?php echo \yii\helpers\BaseUrl::base(true)?>/list-workslip.html" class="btnNavBasic iconSearchWork">情報検索</a></li>
                <li><a href="maintenance.html" class="btnNavBasic iconMainte">メンテナンス</a></li>
                <?php $login_info = Yii::$app->session->get('login_info');?>
                <li><a href="http://220.213.238.88/asbo/?sscode=<?php echo $login_info['M50_SS_CD']?>" class="btnNavOther iconReserve" target="_blank">作業予約管理へ</a></li>
                <li><a href="http://220.213.238.88/satei/?sscode=<?php echo $login_info['M50_SS_CD']?>" class="btnNavOther iconOldCar" target="_blank">中古車査定サイトへ</a></li>
            </ul>
        </nav>
    </article>
</main>
<footer id="footer">
    <p class="copyright">Copyright(C) Usami Koyu Corp. All Rights Reserved.</p>
</footer>

<!-- modal 会員選択 -->
<div class="modal fade" id="modalSelectMember">
    <div class="modal-dialog widthS">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">会員種別選択</h4>
            </div>
            <div class="modal-body">
                <p class="note">会員種別を選択してください。</p>
                <nav class="navAccountType">
                    <ul class="listNavAccountType">
                        <li><a href="#" class="btnMemberUsappy" onclick="fncAuth('usappy');">Usappy会員</a></li>
                        <li><a href="#" class="btnMemberReceivable" onclick="fncAuth('receivable');">掛カード顧客</a></li>
                        <li><a href="#" value="" class="btnMemberEtc" id="moveTypeEtc">その他</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- /modal 会員選択 -->
<!-- modal Usappy会員認証 -->
<?php
    echo \common\widgets\Cardmember::widget();
?>
<!-- /modal Usappy会員認証 -->
<!-- modal 掛会員認証 -->
<?php
    echo \common\widgets\Card::widget();
?>
<!-- /modal 掛会員認証 -->

<script type="text/javascript" src="js/module/top.js"></script>
