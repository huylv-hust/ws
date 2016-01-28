<script src="<?php echo yii\helpers\BaseUrl::base(true) . '/js/module/listworkslip.js' ?>"></script>
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
                        <p class="txtValue"><?php echo isset($detail['D03_UPD_DATE']) ? Yii::$app->formatter->asDate($detail['D03_UPD_DATE'], 'yyyy/MM/dd') : ''; ?></p>
                    </div>
                    <div class="formItem">
                        <label class="titleLabel">状況</label>
                        <p class="txtValue">
                            <?php
                            if ($detail['D03_STATUS'] == 1) {
                                echo '作業確定';
                            }
                            if ($detail['D03_STATUS'] == 0) {
                                echo '作業予約';
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
                        <p class="txtValue"><?php echo $detail['D03_JIKAI_SHAKEN_YM'] != '' ? Yii::$app->formatter->asDate(date('d-M-Y', strtotime($detail['D03_JIKAI_SHAKEN_YM'])), 'yyyy年MM月dd日') : '' ?></p>
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
                        <p class="txtValue"><?php echo $detail['D03_SEKOU_YMD'] != '' ? Yii::$app->formatter->asDate(date('d-M-Y', strtotime($detail['D03_SEKOU_YMD'])), 'yyyy/MM/dd') : '' ?></p>
                    </div>
                    <div class="formItem">
                        <label class="titleLabel">お預かり時間</label>
                        <p class="txtValue">
                            <?php echo isset($detail['D03_AZU_BEGIN_HH']) ? $detail['D03_AZU_BEGIN_HH'] : '00'; ?>
                            ：
                            <?php echo isset($detail['D03_AZU_BEGIN_MI']) ? $detail['D03_AZU_BEGIN_MI'] : '00'; ?>
                            ～
                            <?php echo isset($detail['D03_AZU_END_HH']) ? $detail['D03_AZU_END_HH'] : '00'; ?>
                            ：
                            <?php echo isset($detail['D03_AZU_END_MI']) ? $detail['D03_AZU_END_MI'] : '00'; ?>
                        </p>
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
        <!--confirm-->
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
                                        <input type="checkbox" <?php echo $confirm['tire_1']==1 ? 'checked' : '' ?> disabled name="tire_1">
                                    </label>
                                </div>
                                <div class="itemPrintCheck FL">
                                    <label class="labelPrintCheck">
                                        <input type="checkbox" <?php echo $confirm['tire_2']==1 ? 'checked' : '' ?> disabled name="tire_2">
                                    </label>
                                </div>
                                <div class="itemPrintCheck RR">
                                    <label class="labelPrintCheck">
                                        <input type="checkbox" <?php echo $confirm['tire_3']==1 ? 'checked' : '' ?> disabled name="tire_3">
                                    </label>
                                </div>
                                <div class="itemPrintCheck RL">
                                    <label class="labelPrintCheck">
                                        <input type="checkbox" <?php echo $confirm['tire_4']==1 ? 'checked' : '' ?> disabled name="tire_4">
                                    </label>
                                </div>
                            </div>
                            <p class="centering">点検レ　交換Ｘ　調整Ａ　締付Ｔ　該当／</p></td>
                        <td colspan="2"><p class="leftside">空気圧</p>
                            <div class="areaAirCheck">
                                <div class="itemPrintAir">
                                    <p class="txtValue"><span class="txtUnit">前</span><span class="spcValue"><input
                                                type="number" class="textFormConf" value="<?php echo isset($confirm['pressure_front']) ? $confirm['pressure_front'] : '' ?>" disabled name="pressure_front"></span><span
                                            class="txtUnit">kpa</span></p>
                                </div>
                                <div class="itemPrintAir">
                                    <p class="txtValue"><span class="txtUnit">後</span><span class="spcValue"><input
                                                type="number" class="textFormConf" value="<?php echo isset($confirm['pressure_behind']) ? $confirm['pressure_behind'] : '' ?>" disabled name="pressure_behind"></span><span
                                            class="txtUnit">kpa</span></p>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><p class="leftside">リムバルブ</p>
                            <div class="checkPrint">
                                <label class="labelPrintCheck">
                                    <input type="checkbox" <?php echo $confirm['rim']==1 ? 'checked' : '' ?> disabled name="rim">
                                    確認</label>
                            </div>
                        </td>
                        <td><p class="leftside">トルクレンチ</p>
                            <div class="checkPrint">
                                <label class="labelPrintCheck">
                                    <input type="checkbox" <?php echo $confirm['rim'] ? 'checked' : '' ?> disabled name="torque">
                                    締付</label>
                            </div>
                        </td>
                        <td><p class="leftside">ホイルキャップ</p>
                            <div class="checkPrint">
                                <label class="labelPrintCheck">
                                    <input type="checkbox" <?php echo $confirm['foil']==1 ? 'checked' : '' ?> disabled name="foil">
                                    取付</label>
                            </div>
                        </td>
                        <td><p class="leftside">持帰ナット</p>
                            <div class="checkPrint">
                                <label class="labelPrintCheck">
                                    <input type="checkbox" <?php echo $confirm['nut']==1 ? 'checked' : '' ?> disabled name="nut">
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
                                    <input type="checkbox" <?php echo $confirm['oil']==1 ? 'checked' : '' ?> disabled name="oil">
                                    確認</label>
                            </div>
                        </td>
                        <td><p class="leftside">オイルキャップ</p>
                            <div class="checkPrint">
                                <label class="labelPrintCheck">
                                    <input type="checkbox"<?php echo $confirm['oil_cap']==1 ? 'checked' : '' ?> disabled name="oil_cap">
                                    確認</label>
                            </div>
                        </td>
                        <td><p class="leftside">レベルゲージ</p>
                            <div class="checkPrint">
                                <label class="labelPrintCheck">
                                    <input type="checkbox" <?php echo $confirm['level']==1 ? 'checked' : '' ?> disabled name="level">
                                    確認</label>
                            </div>
                        </td>
                        <td><p class="leftside">ドレンボルト</p>
                            <div class="checkPrint">
                                <label class="labelPrintCheck">
                                    <input type="checkbox" <?php echo $confirm['drain_bolt']==1 ? 'checked' : '' ?> disabled name="drain_bolt">
                                    確認</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><p class="leftside">パッキン</p>
                            <div class="checkPrint">
                                <label class="labelPrintCheck">
                                    <input type="checkbox" <?php echo $confirm['packing']==1 ? 'checked' : '' ?> disabled name="packing">
                                    確認</label>
                            </div>
                        </td>
                        <td><p class="leftside">オイル漏れ</p>
                            <div class="checkPrint">
                                <label class="labelPrintCheck">
                                    <input type="checkbox" <?php echo $confirm['oil_leak']==1 ? 'checked' : '' ?> disabled name="oil_leak">
                                    確認</label>
                            </div>
                        </td>
                        <td colspan="2"><p class="leftside">次回交換目安</p>
                            <div class="checkPrint">
                                <p class="txtValue">
                                    <input type="number" class="textFormConf" value="<?php echo isset($confirm['date']) ? substr($confirm['date'],0,4) : '' ?>" disabled maxlength="4" style="width:4em;" name="date_1">
                                    <span class="txtUnit">年</span>
                                    <input type="number" class="textFormConf" value="<?php echo isset($confirm['date']) ? substr($confirm['date'],4,2) : '' ?>" disabled maxlength="2" style="width:2em;" name="date_2">
                                    <span class="txtUnit">月</span>
                                    <input type="number" class="textFormConf" value="<?php echo isset($confirm['date']) ? substr($confirm['date'],6,2) : '' ?>" disabled="" maxlength="2" style="width:2em;" name="date_3">
                                    <span class="txtUnit">日　または、</span>
                                    <input type="number" class="textFormConf" value="<?php echo isset($confirm['km']) ? $confirm['km'] : '' ?>" disabled name="km">
                                    <span class="txtUnit">km</span>
                                </p>
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
                                    <input type="checkbox" <?php echo $confirm['terminal']==1 ? 'checked' : '' ?> disabled name="terminal">
                                    確認</label>
                            </div>
                        </td>
                        <td><p class="leftside">ステー取付</p>
                            <div class="checkPrint">
                                <label class="labelPrintCheck">
                                    <input type="checkbox" <?php echo $confirm['stay']==1 ? 'checked' : '' ?> disabled name="stay">
                                    確認</label>
                            </div>
                        </td>
                        <td><p class="leftside">バックアップ</p>
                            <div class="checkPrint">
                                <label class="labelPrintCheck">
                                    <input type="checkbox" <?php echo $confirm['backup']==1 ? 'checked' : '' ?> disabled name="backup">
                                    確認</label>
                            </div>
                        </td>
                        <td><p class="leftside">スタートアップ</p>
                            <div class="checkPrint">
                                <label class="labelPrintCheck">
                                    <input type="checkbox" <?php echo $confirm['startup']==1 ? 'checked' : '' ?> disabled name="startup">
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
        <!--csv-->
        <section class="bgContent" <?php echo $check_csv==0 ? 'style="display: none"' : ''?>
            <fieldset class="fieldsetRegist">
                <legend class="titleLegend">保証書情報</legend>
                <div class="formGroup">
                    <div class="formItem">
                        <label class="titleLabel">保証書番号</label>
                        <p class="txtValue"><?php echo isset($csv['M09_WARRANTY_NO']) ? $csv['M09_WARRANTY_NO'] : '' ?></p>
                    </div>
                    <div class="formItem">
                        <label class="titleLabel">購入日</label>
                        <p class="txtValue">
                            <?php echo isset($csv['M09_INP_DATE']) ? Yii::$app->formatter->asDate(date('d-M-Y', strtotime($csv['M09_INP_DATE'])), 'yyyy年MM月dd日') : '' ;?>
                        </p>

                    </div>
                    <div class="formItem">
                        <label class="titleLabel">保証期間</label>
                        <p class="txtValue">
                            <?php echo isset($csv['warranty_period']) ? Yii::$app->formatter->asDate(date('d-M-Y', strtotime($csv['warranty_period'])), 'yyyy年MM月dd日') : '' ;?>
                        </p>
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
                        <p class="txtValue"><?php echo isset($csv['right_front_manu']) ? $csv['right_front_manu'] : '' ?></p>
                    </div>
                    <div class="formItem">
                        <p class="txtValue"><?php echo isset($csv['right_front_product']) ? $csv['right_front_product'] : '' ?></p>
                    </div>
                    <div class="formItem">
                        <p class="txtValue"><?php echo isset($csv['right_front_size']) ? $csv['right_front_size'] : '' ?></p>
                    </div>
                    <div class="formItem">
                        <p class="txtValue"><?php echo isset($csv['right_front_serial']) ? $csv['right_front_serial'] : '' ?></p>
                    </div>
                    <div class="formItem">
                        <p class="txtValue"><?php echo isset($csv['right_front_no']) ? $csv['right_front_no'] : '' ?></p>
                    </div>
                </div>
                <div class="formGroup lineBottom">
                    <div class="formItem">
                        <p class="txtValue">左前</p>
                    </div>
                    <div class="formItem">
                        <p class="txtValue"><?php echo isset($csv['left_front_manu']) ? $csv['left_front_manu'] : '' ?></p>
                    </div>
                    <div class="formItem">
                        <p class="txtValue"><?php echo isset($csv['left_front_product']) ? $csv['left_front_product'] : '' ?></p>
                    </div>
                    <div class="formItem">
                        <p class="txtValue"><?php echo isset($csv['left_front_size']) ? $csv['left_front_size'] : '' ?></p>
                    </div>
                    <div class="formItem">
                        <p class="txtValue"><?php echo isset($csv['left_front_serial']) ? $csv['left_front_serial'] : '' ?></p>
                    </div>
                    <div class="formItem">
                        <p class="txtValue"><?php echo isset($csv['left_front_no']) ? $csv['left_front_no'] : '' ?></p>
                    </div>
                </div>
                <div class="formGroup lineBottom">
                    <div class="formItem">
                        <p class="txtValue">右後</p>
                    </div>
                    <div class="formItem">
                        <p class="txtValue"><?php echo isset($csv['right_behind_manu']) ? $csv['right_behind_manu'] : '' ?></p>
                    </div>
                    <div class="formItem">
                        <p class="txtValue"><?php echo isset($csv['right_behind_product']) ? $csv['right_behind_product'] : '' ?></p>
                    </div>
                    <div class="formItem">
                        <p class="txtValue"><?php echo isset($csv['right_behind_size']) ? $csv['right_behind_size'] : '' ?></p>
                    </div>
                    <div class="formItem">
                        <p class="txtValue"><?php echo isset($csv['right_behind_serial']) ? $csv['right_behind_serial'] : '' ?></p>
                    </div>
                    <div class="formItem">
                        <p class="txtValue"><?php echo isset($csv['right_behind_no']) ? $csv['right_behind_no'] : '' ?></p>
                    </div>
                </div>
                <div class="formGroup lineBottom">
                    <div class="formItem">
                        <p class="txtValue">左後</p>
                    </div>
                    <div class="formItem">
                        <p class="txtValue"><?php echo isset($csv['left_behind_manu']) ? $csv['left_behind_manu'] : '' ?></p>
                    </div>
                    <div class="formItem">
                        <p class="txtValue"><?php echo isset($csv['left_behind_product']) ? $csv['left_behind_product'] : '' ?></p>
                    </div>
                    <div class="formItem">
                        <p class="txtValue"><?php echo isset($csv['left_behind_size']) ? $csv['left_behind_size'] : '' ?></p>
                    </div>
                    <div class="formItem">
                        <p class="txtValue"><?php echo isset($csv['left_behind_serial']) ? $csv['left_behind_serial'] : '' ?></p>
                    </div>
                    <div class="formItem">
                        <p class="txtValue"><?php echo isset($csv['left_behind_no']) ? $csv['left_behind_no'] : '' ?></p>
                    </div>
                </div>
                <div class="formGroup lineBottom">
                    <div class="formItem">
                        <p class="txtValue">その他A</p>
                    </div>
                    <div class="formItem">
                        <p class="txtValue"><?php echo isset($csv['other_a_manu']) ? $csv['other_a_manu'] : '' ?></p>
                    </div>
                    <div class="formItem">
                        <p class="txtValue"><?php echo isset($csv['other_a_product']) ? $csv['other_a_product'] : '' ?></p>
                    </div>
                    <div class="formItem">
                        <p class="txtValue"><?php echo isset($csv['other_a_size']) ? $csv['other_a_size'] : '' ?></p>
                    </div>
                    <div class="formItem">
                        <p class="txtValue"><?php echo isset($csv['other_a_serial']) ? $csv['other_a_serial'] : '' ?></p>
                    </div>
                    <div class="formItem">
                        <p class="txtValue"><?php echo isset($csv['other_a_no']) ? $csv['other_a_no'] : '' ?></p>
                    </div>
                </div>
                <div class="formGroup">
                    <div class="formItem">
                        <p class="txtValue">その他B</p>
                    </div>
                    <div class="formItem">
                        <p class="txtValue"><?php echo isset($csv['other_b_manu']) ? $csv['other_b_manu'] : '' ?></p>
                    </div>
                    <div class="formItem">
                        <p class="txtValue"><?php echo isset($csv['other_b_product']) ? $csv['other_b_product'] : '' ?></p>
                    </div>
                    <div class="formItem">
                        <p class="txtValue"><?php echo isset($csv['other_b_size']) ? $csv['other_b_size'] : '' ?></p>
                    </div>
                    <div class="formItem">
                        <p class="txtValue"><?php echo isset($csv['other_b_serial']) ? $csv['other_b_serial'] : '' ?></p>
                    </div>
                    <div class="formItem">
                        <p class="txtValue"><?php echo isset($csv['other_b_no']) ? $csv['other_b_no'] : '' ?></p>
                    </div>
                </div>
            </fieldset>
        </section>
    </article>
</main>

<footer id="footer">
    <div class="toolbar"><a href="<?php echo \yii\helpers\BaseUrl::base(true) ?>/menu" class="btnBack">メニュー</a>
        <div class="btnSet">
            <?php
            $url = Yii::$app->session->has('url_list_workslip') ? Yii::$app->session->get('url_list_workslip') : \yii\helpers\BaseUrl::base(true) . '/list-workslip';
            ?>
            <a href="<?php echo $url; ?>" class="btnTool">情報検索</a>

            <a href="<?php echo \yii\helpers\BaseUrl::base(true) ?>/preview?den_no=<?php echo $detail['D03_DEN_NO']; ?>"
               class="btnTool" target="_blank">作業確認</a>

            <span id="pdf" class="btnTool <?php if ($check_file == 0) {echo 'off';}?>" style="cursor: pointer; <?php if ($check_file == 0) {echo 'pointer-events: none';}?>">保証書を表示</span>

            <a href="<?php echo \yii\helpers\BaseUrl::base(true).'/regist-workslip?denpyo_no='.$detail['D03_DEN_NO']?>" class="btnTool">編集</a>

            <a href="#modalRemoveConfirm" class="btnTool" data-toggle="modal">削除</a>
        </div>
        <?php if (!empty($detail['sagyo']) && !empty($detail['D03_TANTO_SEI'] && !empty($detail['D03_KAKUNIN_SEI']) && $detail['D03_STATUS'] != '' && $detail['D03_STATUS'] == 0 && !empty($detail['product']))) {
            echo '<a href="#modalWorkSlipComp" class="btnSubmit" data-toggle="modal">作業確定</a>';
        } ?>
    </div>
    <p class="copyright">Copyright(C) Usami Koyu Corp. All Rights Reserved.</p>
</footer>
<!-- input den_no -->
<input id="den_no" hidden value="<?php echo $detail['D03_DEN_NO']?>">
<!-- sidemenu -->
<div id="sidr" class="sidr">
    <div class="closeSideMenu"><a href="#" id="sidrClose">Close</a></div>
    <ul>
        <li><a href="<?php echo \yii\helpers\BaseUrl::base(true) ?>/menu">SSサポートサイトTOP</a></li>
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