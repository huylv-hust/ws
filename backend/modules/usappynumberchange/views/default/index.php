<main id="contents">
    <section class="readme">
        <h2 class="titleContent">新カード入力</h2>
    </section>
    <article class="container">
        <p class="note">新しいカード番号を入力して、「確認」ボタンを押してください。<span class="must">*</span>は必須入力項目です。<br>
            カード番号の変更をやめる場合は、「戻る」ボタンを押してください。</p>
        <div class="breadcrumb">
            <ul>
                <li class="active">新カード入力</li>
                <li>入力内容確認</li>
                <li>変更完了</li>
            </ul>
        </div>
        <section>
            <div id="frmCardNumber">
                <div class="frmContent">
                    <div class="row">
                        <div class="cell bgGray frmLabel">
                            <label>会員氏名</label>
                        </div>
                        <div class="cell bgGrayTrans">
                            <label>東京 太郎 様</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="cell bgGray frmLabel">
                            <label for="oldcardNumber">旧Usappyカード番号 <span class="must">*</span></label>
                        </div>
                        <div class="cell bgGrayTrans">
						<span class="toolTipMsg">
							<span class="tooltipArrow"></span>
							<span class="tooltipInner"></span>
						</span>
                            <input class="borderGreen borderRadius" value="<?php echo $member_kaiinCd; ?>" type="text" name="oldCardNumber" valid="true">
                        </div>
                    </div>

                    <div class="row">
                        <div class="cell bgGray frmLabel">
                            <label for="newCardNumber">新Usappyカード番号 <span class="must">*</span></label>
                        </div>
                        <div class="cell bgGrayTrans">
						<span class="toolTipMsg">
							<span class="tooltipArrow"></span>
							<span class="tooltipInner"></span>
						</span>
                            <input class="borderGreen borderRadius" type="text" name="newCardNumber" valid="true">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </article>
</main>
<footer id="footer">
    <div class="toolbar"><a href="menu.html" class="btnBack">戻る</a><a href="usappy-number-change-confirm.html" id="btnCardNumberVerify" class="btnNext">確認</a></div>
    <p class="copyright">Copyright(C) Usami Koyu Corp. All Rights Reserved.</p>
</footer>