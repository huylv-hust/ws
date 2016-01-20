<main id="contents" xmlns="http://www.w3.org/1999/html">
    <section class="readme">
        <h2 class="titleContent">作業伝票詳細</h2>
    </section>
    <article class="container">
        <?php
        if (Yii::$app->session->hasFlash('error')) {
            ?>
            <div class="alert alert-danger"><?php echo Yii::$app->session->getFlash('error') ?>
                <button class="close" data-dismiss="alert">&times;</button>
            </div>
            <?php
        }
        ?>
        <section class="bgContent">
            <fieldset class="fieldsetRegist">
                <div class="formGroup">
                    <div class="formItem">
                        <label class="titleLabel">伝票No</label>
                        <p class="txtValue"><?php echo $detail['D03_DEN_NO']; ?></p>
                    </div>
                    <div class="formItem">
                        <label class="titleLabel">受付日</label>
                        <p class="txtValue"><?php echo Yii::$app->formatter->asDate($detail['D03_INP_DATE'], 'yyyy/MM/dd'); ?></p>
                    </div>
                    <div class="formItem">
                        <label class="titleLabel">状況</label>
                        <p class="txtValue">
                            <?php
                            if ($detail['D03_STATUS'] == 1) {
                                echo $status[2];
                            }
                            if ($detail['D03_STATUS'] == 0 && $detail['D03_SEKOU_YMD'] <= date('Ydm')) {
                                echo $status[0];
                            }
                            if ($detail['D03_STATUS'] == 0 && $detail['D03_SEKOU_YMD'] > date('Ydm')) {
                                echo $status[1];
                            } ?>
                        </p>
                    </div>
                </div>
            </fieldset>
        </section>
        <section class="bgContent">
            <fieldset class="fieldsetRegist">
                <div class="flexHead">
                    <legend class="titleLegend">お客様情報</legend>
                </div>
                <div class="formGroup">
                    <div class="formItem">
                        <label class="titleLabel">お名前</label>
                        <p class="txtValue"><?php echo $detail['D01_CUST_NAMEN']; ?></p>
                    </div>
                    <div class="formItem">
                        <label class="titleLabel">フリガナ</label>
                        <p class="txtValue"><?php echo $detail['D01_CUST_NAMEK']; ?></p>
                    </div>
                </div>
                <div class="formGroup">
                    <div class="formItem">
                        <label class="titleLabel">備考</label>
                        <p><?php echo $detail['D01_NOTE']; ?></p>
                    </div>
                </div>
            </fieldset>
        </section>
        <section class="bgContent">
            <fieldset class="fieldsetRegist">
                <div class="flexHead">
                    <legend class="titleLegend">車両情報</legend>
                </div>
                <div class="formGroup">
                    <div class="formItem">
                        <label class="titleLabel">車名</label>
                        <p class="txtValue"><?php echo $detail['D03_CAR_NAMEN']; ?></p>
                    </div>
                    <div class="formItem">
                        <label class="titleLabel">車検満了日</label>
                        <p class="txtValue"><?php echo $detail['D03_JIKAI_SHAKEN_YM'] != '' ? substr($detail['D03_JIKAI_SHAKEN_YM'],0,4).'年'.substr($detail['D03_JIKAI_SHAKEN_YM'],4,2).'月'.substr($detail['D03_JIKAI_SHAKEN_YM'],6,2).'日' : ''; ?> </p>
                    </div>
                    <div class="formItem">
                        <label class="titleLabel">車検サイクル</label>
                        <p class="txtValue"><?php echo $detail['D02_SYAKEN_CYCLE']; ?>年</p>
                    </div>
                    <div class="formItem">
                        <label class="titleLabel">走行距離</label>
                        <p class="txtValue"><?php echo $detail['D03_METER_KM']; ?>km</p>
                    </div>
                </div>
                <div class="formGroup">
                    <div class="formItem">
                        <label class="titleLabel">運輸支局</label>
                        <p class="txtValue"><?php echo $detail['D03_RIKUUN_NAMEN']; ?></p>
                    </div>
                    <div class="formItem">
                        <label class="titleLabel">分類コード</label>
                        <p class="txtValue"><?php echo $detail['D03_CAR_ID']; ?></p>
                    </div>
                    <div class="formItem">
                        <label class="titleLabel">ひらがな</label>
                        <p class="txtValue"><?php echo $detail['D03_HIRA']; ?></p>
                    </div>
                    <div class="formItem">
                        <label class="titleLabel">登録番号</label>
                        <p class="txtValue"><?php echo $detail['D03_CAR_NO']; ?></p>
                    </div>
                </div>
            </fieldset>
        </section>
        <section class="bgContent">
            <fieldset class="fieldsetRegist">
                <legend class="titleLegend">貴重品・精算情報</legend>
                <div class="formGroup">
                    <div class="formItem">
                        <label class="titleLabel">貴重品</label>
                        <?php if (isset($detail['D03_KITYOHIN']) && $detail['D03_KITYOHIN'] == 0) {
                            echo '<p class="txtValue">無し</p>';
                        } else {
                            echo '<p class="txtValue">有り</p>';
                        } ?>
                    </div>
                    <div class="formItem">
                        <label class="titleLabel">お客様確認</label>
                        <?php if (isset($detail['D03_KAKUNIN']) && $detail['D03_KAKUNIN'] == 0) {
                            echo '<p class="txtValue">未了承</p>';
                        } else {
                            echo '<p class="txtValue">了承済</p>';
                        } ?>
                    </div>
                    <div class="formItem">
                        <label class="titleLabel">精算方法</label>
                        <?php if (isset($detail['D03_SEISAN']) && $detail['D03_SEISAN'] == 0) {
                            echo '<p class="txtValue">現金</p>';
                        }
                        if (isset($detail['D03_SEISAN']) && $detail['D03_SEISAN'] == 1) {
                            echo '<p class="txtValue">プリカ</p>';
                        }
                        if (isset($detail['D03_SEISAN']) && $detail['D03_SEISAN'] == 2) {
                            echo '<p class="txtValue">クレジット</p>';
                        }
                        if (isset($detail['D03_SEISAN']) && $detail['D03_SEISAN'] == 3) {
                            echo '<p class="txtValue">掛</p>';
                        } ?>
                    </div>
                </div>
            </fieldset>
        </section>
        <section class="bgContent">
            <fieldset class="fieldsetRegist">
                <legend class="titleLegend">作業日など</legend>
                <div class="formGroup">
                    <div class="formItem">
                        <label class="titleLabel">施行日（予約日）</label>
                        <p class="txtValue"><?php echo $detail['D03_SEKOU_YMD'] != '' ? substr($detail['D03_SEKOU_YMD'],0,4).'/'.substr($detail['D03_SEKOU_YMD'],4,2).'/'.substr($detail['D03_SEKOU_YMD'],6,2) : ''; ?> </p>
                    </div>
                    <div class="formItem">
                        <label class="titleLabel">お預かり時間</label>
                        <p class="txtValue"><?php if (isset($detail['D03_AZU_BEGIN_HH'])) {
                                echo $detail['D03_AZU_BEGIN_HH'];
                            }
                            if (isset($detail['D03_AZU_BEGIN_MI'])) {
                                echo ':' . $detail['D03_AZU_BEGIN_HH'];
                            }
                            if (isset($detail['D03_AZU_END_HH'])) {
                                echo '～' . $detail['D03_AZU_END_HH'];
                            }
                            if (isset($detail['D03_AZU_END_MI'])) {
                                echo ':' . $detail['D03_AZU_END_MI'];
                            } else {
                                echo '';
                            } ?></p>
                    </div>
                </div>
                <div class="formGroup">
                    <div class="formItem">
                        <label class="titleLabel">予約内容</label>
                        <p class="txtValue"><?php
                            if (isset($job[$detail['D03_YOYAKU_SAGYO_NO']])) {
                                echo $job[$detail['D03_YOYAKU_SAGYO_NO']];
                            } else {
                                echo '';
                            } ?></p>
                    </div>
                    <div class="formItem">
                        <label class="titleLabel">作業者</label>
                        <p class="txtValue"><?php echo $detail['D03_TANTO_SEI'] . '' . $detail['D03_TANTO_MEI']; ?></p>
                    </div>
                    <div class="formItem">
                        <label class="titleLabel">確認者</label>
                        <p class="txtValue"><?php echo $detail['D03_KAKUNIN_SEI'] . '' . $detail['D03_KAKUNIN_MEI']; ?></p>
                    </div>
                </div>
            </fieldset>
        </section>
        <section class="bgContent">
            <fieldset class="fieldsetRegist">
                <legend class="titleLegend">作業内容</legend>
                <div class="formGroup">
                    <div class="formItem">
                        <p class="txtValue">
                            <?php
                            $sagyo = '';
                            foreach ($detail['sagyo'] as $k => $v) {
                                $sagyo .= $job[$v['D04_SAGYO_NO']] . '、';
                            }
                            echo trim($sagyo, '、');
                            ?>
                        </p>
                    </div>
                </div>
                <div class="formGroup">
                    <div class="formItem">
                        <label class="titleLabel">その他作業内容</label>
                        <p class="txtValue"><?php echo $detail['D03_SAGYO_OTHER']; ?></p>

                    </div>
                </div>
            </fieldset>
        </section>
        <section class="bgContent">
            <fieldset class="fieldsetRegist">
                <legend class="titleLegend">作業終了確認</legend>
                <table class="tablePrint bgWhite">
                    <tbody>
                    <tr>
                        <th colspan="4">タイヤ</th>
                    </tr>
                    <tr>
                        <td colspan="2"><p class="leftside">タイヤ交換図</p>
                            <div class="areaPrintCheckImg"><img
                                    src="<?php echo \yii\helpers\BaseUrl::base(true) ?>/img/handwriting.png" alt=""
                                    class="itemPrintCheckImg">
                                <div class="itemPrintCheck FR">
                                    <label class="labelPrintCheck">
                                        <input type="checkbox" checked="" disabled="">
                                    </label>
                                </div>
                                <div class="itemPrintCheck FL">
                                    <label class="labelPrintCheck">
                                        <input type="checkbox" checked="" disabled="">
                                    </label>
                                </div>
                                <div class="itemPrintCheck RR">
                                    <label class="labelPrintCheck">
                                        <input type="checkbox" checked="" disabled="">
                                    </label>
                                </div>
                                <div class="itemPrintCheck RL">
                                    <label class="labelPrintCheck">
                                        <input type="checkbox" checked="" disabled="">
                                    </label>
                                </div>
                            </div>
                            <p class="centering">点検レ　交換Ｘ　調整Ａ　締付Ｔ　該当／</p></td>
                        <td colspan="2"><p class="leftside">空気圧</p>
                            <div class="areaAirCheck">
                                <div class="itemPrintAir">
                                    <p class="txtValue"><span class="txtUnit">前</span><span class="spcValue"><input
                                                type="number" class="textFormConf" value="1000" disabled=""></span><span
                                            class="txtUnit">kpa</span></p>
                                </div>
                                <div class="itemPrintAir">
                                    <p class="txtValue"><span class="txtUnit">後</span><span class="spcValue"><input
                                                type="number" class="textFormConf" value="1000" disabled=""></span><span
                                            class="txtUnit">kpa</span></p>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><p class="leftside">リムバルブ</p>
                            <div class="checkPrint">
                                <label class="labelPrintCheck">
                                    <input type="checkbox" checked="" disabled="">
                                    確認</label>
                            </div>
                        </td>
                        <td><p class="leftside">トルクレンチ</p>
                            <div class="checkPrint">
                                <label class="labelPrintCheck">
                                    <input type="checkbox" checked="" disabled="">
                                    締付</label>
                            </div>
                        </td>
                        <td><p class="leftside">ホイルキャップ</p>
                            <div class="checkPrint">
                                <label class="labelPrintCheck">
                                    <input type="checkbox" checked="" disabled="">
                                    取付</label>
                            </div>
                        </td>
                        <td><p class="leftside">持帰ナット</p>
                            <div class="checkPrint">
                                <label class="labelPrintCheck">
                                    <input type="checkbox" checked="" disabled="">
                                    確認</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th colspan="4">オイル</th>
                    </tr>
                    <tr>
                        <td><p class="leftside">オイル量</p>
                            <div class="checkPrint">
                                <label class="labelPrintCheck">
                                    <input type="checkbox" checked="" disabled="">
                                    確認</label>
                            </div>
                        </td>
                        <td><p class="leftside">オイルキャップ</p>
                            <div class="checkPrint">
                                <label class="labelPrintCheck">
                                    <input type="checkbox" checked="" disabled="">
                                    確認</label>
                            </div>
                        </td>
                        <td><p class="leftside">レベルゲージ</p>
                            <div class="checkPrint">
                                <label class="labelPrintCheck">
                                    <input type="checkbox" checked="" disabled="">
                                    確認</label>
                            </div>
                        </td>
                        <td><p class="leftside">ドレンボルト</p>
                            <div class="checkPrint">
                                <label class="labelPrintCheck">
                                    <input type="checkbox" checked="" disabled="">
                                    確認</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><p class="leftside">パッキン</p>
                            <div class="checkPrint">
                                <label class="labelPrintCheck">
                                    <input type="checkbox" checked="" disabled="">
                                    確認</label>
                            </div>
                        </td>
                        <td><p class="leftside">オイル漏れ</p>
                            <div class="checkPrint">
                                <label class="labelPrintCheck">
                                    <input type="checkbox" checked="" disabled="">
                                    確認</label>
                            </div>
                        </td>
                        <td colspan="2"><p class="leftside">次回交換目安</p>
                            <div class="checkPrint">
                                <p class="txtValue"><input type="number" class="textFormConf" value="2016" disabled=""
                                                           maxlength="4" style="width:4em;"><span
                                        class="txtUnit">年</span><input type="number" class="textFormConf" value="12"
                                                                       disabled="" maxlength="2"
                                                                       style="width:2em;"><span class="txtUnit">月</span><input
                                        type="number" class="textFormConf" value="31" disabled="" maxlength="2"
                                        style="width:2em;"><span class="txtUnit">日　または、</span><input type="number"
                                                                                                     class="textFormConf"
                                                                                                     value="100"
                                                                                                     disabled=""><span
                                        class="txtUnit">km</span></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th colspan="4">バッテリー</th>
                    </tr>
                    <tr>
                        <td><p class="leftside">ターミナル締付</p>
                            <div class="checkPrint">
                                <label class="labelPrintCheck">
                                    <input type="checkbox" checked="" disabled="">
                                    確認</label>
                            </div>
                        </td>
                        <td><p class="leftside">ステー取付</p>
                            <div class="checkPrint">
                                <label class="labelPrintCheck">
                                    <input type="checkbox" checked="" disabled="">
                                    確認</label>
                            </div>
                        </td>
                        <td><p class="leftside">バックアップ</p>
                            <div class="checkPrint">
                                <label class="labelPrintCheck">
                                    <input type="checkbox" checked="" disabled="">
                                    確認</label>
                            </div>
                        </td>
                        <td><p class="leftside">スタートアップ</p>
                            <div class="checkPrint">
                                <label class="labelPrintCheck">
                                    <input type="checkbox" checked="" disabled="">
                                    確認</label>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </fieldset>
        </section>
        <section class="bgContent">
            <fieldset class="fieldsetRegist">
                <legend class="titleLegend">商品情報</legend>
                <div class="commodityBox on" id="commodity1">
                    <?php
                    foreach ($detail['product'] as $k => $v) {
                        ?>
                        <div class="formGroup">
                            <div class="formItem">
                                <label class="titleLabel">商品・荷姿コード</label>
                                <p class="txtValue"><?php echo $v['D05_COM_CD'] . $v['D05_NST_CD']; ?></p>
                            </div>
                            <div class="formItem">
                                <label class="titleLabel">品名</label>
                                <p class="txtValue"><?php echo $v['M05_COM_NAMEN']; ?></p>
                            </div>
                            <div class="formItem">
                                <label class="titleLabel">参考価格</label>
                                <p class="txtValue"><?php echo $v['M05_LIST_PRICE']; ?></p>
                            </div>
                        </div>
                        <div class="formGroup">
                            <div class="formItem">
                                <label class="titleLabel">数量</label>
                                <p class="txtValue"><?php echo $v['D05_SURYO']; ?></p>
                            </div>
                            <div class="formItem">
                                <label class="titleLabel">単価</label>
                                <p class="txtValue"><?php echo $v['D05_TANKA']; ?><span class="txtUnit">円</span></p>
                            </div>
                            <div class="formItem">
                                <label class="titleLabel">金額</label>
                                <p class="txtValue"><?php echo $v['D05_KINGAKU']; ?><span class="txtUnit">円</span></p>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="formGroup lineTop">
                    <div class="flexRight">
                        <label class="titleLabelTotal">合計金額</label>
                        <p class="txtValue"><strong
                                class="totalPrice"><?php echo $detail['D03_SUM_KINGAKU']; ?></strong><span
                                class="txtUnit">円</span></p>
                    </div>
                </div>
            </fieldset>
        </section>
        <section class="bgContent">
            <fieldset class="fieldsetRegist">
                <legend class="titleLegend">その他</legend>
                <div class="formGroup">
                    <div class="formItem">
                        <label class="titleLabel">POS伝票番号</label>
                        <p class="txtValue"><?php echo $detail['D03_POS_DEN_NO']; ?></p>
                    </div>
                    <div class="formItem">
                        <label class="titleLabel">備考</label>
                        <p class="txtValue"><?php echo $detail['D03_NOTE']; ?></p>
                    </div>
                </div>
            </fieldset>
        </section>
        <section class="bgContent">
            <fieldset class="fieldsetRegist">
                <legend class="titleLegend">保証書情報</legend>
                <div class="formGroup">
                    <div class="formItem">
                        <label class="titleLabel">保証書番号</label>
                        <p class="txtValue"></p>
                    </div>
                    <div class="formItem">
                        <label class="titleLabel">購入日</label>
                        <p class="txtValue"></p>
                    </div>
                    <div class="formItem">
                        <label class="titleLabel">保証期間</label>
                        <p class="txtValue"></p>
                    </div>
                </div>
                <div class="formGroup lineBottom">
                    <div class="formItem">
                        <label class="titleLabel">取付位置</label>
                    </div>
                    <div class="formItem">
                        <label class="titleLabel">メーカー</label>
                    </div>
                    <div class="formItem">
                        <label class="titleLabel">商品名</label>
                    </div>
                    <div class="formItem">
                        <label class="titleLabel">サイズ</label>
                    </div>
                    <div class="formItem">
                        <label class="titleLabel">セリアル番号</label>
                    </div>
                    <div class="formItem">
                        <label class="titleLabel">数量</label>
                    </div>
                </div>
                <div class="formGroup lineBottom">
                    <div class="formItem">
                        <p class="txtValue">右前</p>
                    </div>
                    <div class="formItem">
                        <p class="txtValue"></p>
                    </div>
                    <div class="formItem">
                        <p class="txtValue"></p>
                    </div>
                    <div class="formItem">
                        <p class="txtValue"></p>
                    </div>
                    <div class="formItem">
                        <p class="txtValue"></p>
                    </div>
                    <div class="formItem">
                        <p class="txtValue"></p>
                    </div>
                </div>
                <div class="formGroup lineBottom">
                    <div class="formItem">
                        <p class="txtValue">左前</p>
                    </div>
                    <div class="formItem">
                        <p class="txtValue"></p>
                    </div>
                    <div class="formItem">
                        <p class="txtValue"></p>
                    </div>
                    <div class="formItem">
                        <p class="txtValue"></p>
                    </div>
                    <div class="formItem">
                        <p class="txtValue"></p>
                    </div>
                    <div class="formItem">
                        <p class="txtValue"></p>
                    </div>
                </div>
                <div class="formGroup lineBottom">
                    <div class="formItem">
                        <p class="txtValue">右後</p>
                    </div>
                    <div class="formItem">
                        <p class="txtValue"></p>
                    </div>
                    <div class="formItem">
                        <p class="txtValue"></p>
                    </div>
                    <div class="formItem">
                        <p class="txtValue"></p>
                    </div>
                    <div class="formItem">
                        <p class="txtValue"></p>
                    </div>
                    <div class="formItem">
                        <p class="txtValue"></p>
                    </div>
                </div>
                <div class="formGroup lineBottom">
                    <div class="formItem">
                        <p class="txtValue">左後</p>
                    </div>
                    <div class="formItem">
                        <p class="txtValue"></p>
                    </div>
                    <div class="formItem">
                        <p class="txtValue"></p>
                    </div>
                    <div class="formItem">
                        <p class="txtValue"></p>
                    </div>
                    <div class="formItem">
                        <p class="txtValue"></p>
                    </div>
                    <div class="formItem">
                        <p class="txtValue"></p>
                    </div>
                </div>
                <div class="formGroup lineBottom">
                    <div class="formItem">
                        <p class="txtValue">その他A</p>
                    </div>
                    <div class="formItem">
                        <p class="txtValue"></p>
                    </div>
                    <div class="formItem">
                        <p class="txtValue"></p>
                    </div>
                    <div class="formItem">
                        <p class="txtValue"></p>
                    </div>
                    <div class="formItem">
                        <p class="txtValue"></p>
                    </div>
                    <div class="formItem">
                        <p class="txtValue"></p>
                    </div>
                </div>
                <div class="formGroup">
                    <div class="formItem">
                        <p class="txtValue">その他B</p>
                    </div>
                    <div class="formItem">
                        <p class="txtValue"></p>
                    </div>
                    <div class="formItem">
                        <p class="txtValue"></p>
                    </div>
                    <div class="formItem">
                        <p class="txtValue"></p>
                    </div>
                    <div class="formItem">
                        <p class="txtValue"></p>
                    </div>
                    <div class="formItem">
                        <p class="txtValue"></p>
                    </div>
                </div>
            </fieldset>
        </section>
    </article>
</main>

<footer id="footer">
    <div class="toolbar"><a href="<?php echo \yii\helpers\BaseUrl::base(true) ?>/menu.html" class="btnBack">メニュー</a>
        <div class="btnSet">
            <?php
            $url = Yii::$app->session->has('url_list_workslip') ? Yii::$app->session->get('url_list_workslip') : \yii\helpers\BaseUrl::base(true) . '/list-workslip.html';
            ?>
            <a href="<?php echo $url; ?>" class="btnTool">情報検索</a>
            <a href="<?php echo \yii\helpers\BaseUrl::base(true) ?>/preview.html?den_no=<?php echo $detail['D03_DEN_NO']; ?>"
               class="btnTool" target="_blank">作業確認</a>

            <a href="<?php echo \yii\helpers\BaseUrl::base(true).'/data/pdf/'.$detail['D03_DEN_NO'].'.pdf' ?>"
               class="btnTool" target="_blank" style="<?php if ($check_file == 0) {echo 'pointer-events: none';} else { echo '';}?>" id="pdf">保証書を表示</a>'

            <a href="<?php echo \yii\helpers\BaseUrl::base(true).'/regist-workslip.html?denpyo_no='.$detail['D03_DEN_NO']?>" class="btnTool">編集</a>
            <a href="#modalRemoveConfirm" class="btnTool" data-toggle="modal">削除</a>
        </div>
        <?php if (!empty($detail['sagyo']) && !empty($detail['D03_TANTO_SEI'] && !empty($detail['D03_KAKUNIN_SEI']) && $detail['D03_STATUS'] == 0 && !empty($detail['product']))) {
            echo '<a href="#modalWorkSlipComp" class="btnSubmit" data-toggle="modal">作業確定</a>';
        } ?>
    </div>
    <p class="copyright">Copyright(C) Usami Koyu Corp. All Rights Reserved.</p>
</footer>
<!-- sidemenu -->
<div id="sidr" class="sidr">
    <div class="closeSideMenu"><a href="#" id="sidrClose">Close</a></div>
    <ul>
        <li><a href="<?php echo \yii\helpers\BaseUrl::base(true) ?>/menu.html">SSサポートサイトTOP</a></li>
    </ul>
</div>
<!-- /sidemenu -->
<!-- modal 削除確認 -->
<div class="modal fade" id="modalRemoveConfirm">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">作業伝票削除</h4>
            </div>
            <div class="modal-body">
                <p class="note">作業伝票を削除します。よろしいですか？</p>
            </div>
            <div class="modal-footer">
                <a href="#" class="btnCancel flLeft" data-dismiss="modal" aria-label="Close">いいえ</a>
                <form method="post" action="<?php echo \yii\helpers\BaseUrl::base(true) ?>/listworkslip/detail/remove">
                    <input type="hidden" name="den_no" value="<?php echo $detail['D03_DEN_NO']; ?>">
                    <button type="submit" class="btnSubmit flRight">はい</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /modal 削除確認 -->
<!-- modal 作業伝票確定 -->
<div class="modal fade" id="modalWorkSlipComp">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">作業伝票確定</h4>
            </div>
            <div class="modal-body">
                <p class="note">確定します。よろしいですか？</p>
            </div>
            <div class="modal-footer">
                <a href="#" class="btnCancel flLeft" data-dismiss="modal" aria-label="Close">いいえ</a>
                <form method="post" action="<?php echo \yii\helpers\BaseUrl::base(true) ?>/listworkslip/detail/status">
                    <input type="hidden" name="den_no" value="<?php echo $detail['D03_DEN_NO']; ?>">
                    <button type="submit" class="btnSubmit flRight">はい</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- /modal 作業伝票確定 -->
<!-- modal 保証書作成
<div class="modal fade" id="modalMakeWarranty">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">保証書作成</h4>
      </div>
      <div class="modal-body">
        <p class="note">保証書を作成しますか?<br>※対象タイヤは、国内4メーカーに限ります。保証書は、一度しか作成できません。</p>
      </div>
      <div class="modal-footer"> <a href="#" class="btnCancel flLeft" data-dismiss="modal" aria-label="Close">いいえ</a> <a href="regist-warranty.html" class="btnSubmit flRight">はい</a> </div>
    </div>
  </div>
</div>
/modal 保証書作成 -->