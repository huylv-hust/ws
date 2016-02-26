<main id="printContents">
    <section class="readme">
        <h2 class="titleContent">作業確認書</h2>
        <div class="rightside printNone"><a href="javascript:print();" class="iconPrint">印刷</a><a
                href="javascript:window.close();" class="iconClose">閉じる</a></div>
    </section>
    <article class="container mb0">
        <section class="pContent">
            <fieldset class="fieldsetRegist">
                <table class="tablePrint boder-black">
                    <tr>
                        <td>
                            <label class="titleLabel">伝票No</label>
                        </td>
                        <td>
                            <label class="titleLabel">状況</label>
                        </td>
                        <td>
                            <label class="titleLabel">受付日</label>
                        </td>
                        <td>
                            <label class="titleLabel">受付担当者</label>
                        </td>
                        <td>
                            <label class="titleLabel">作業日</label>
                        </td>
                        <td>
                            <label class="titleLabel">お預かり時間</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="txtValue"><?php echo isset($detail['D03_DEN_NO']) ? $detail['D03_DEN_NO'] : ''; ?></p>
                        </td>
                        <td>
                            <p class="txtValue">
                                <?php
                                if ($detail['D03_STATUS'] == 1) {
                                    echo '作業確定';
                                }
                                if ($detail['D03_STATUS'] == 0) {
                                    echo '作業予約';
                                } ?>
                            </p>
                        </td>
                        <td>
                            <p class="txtValue"><?php echo isset($detail['D03_UPD_DATE']) ? Yii::$app->formatter->asDate($detail['D03_UPD_DATE'], 'yyyy/MM/dd') : date('Y/m/d'); ?></p>
                        </td>
                        <td>
                            <p class="txtValue"><?php echo isset($detail['D01_UKE_TAN_NAMEN']) ? $detail['D01_UKE_TAN_NAMEN'] : ''; ?></p>
                        </td>
                        <td>
                            <p class="txtValue"><?php echo $detail['D03_SEKOU_YMD'] != '' ? Yii::$app->formatter->asDate(date('d-M-y', strtotime($detail['D03_SEKOU_YMD'])), 'yyyy/MM/dd') : '' ?></p>
                        </td>
                        <td>
                            <p class="txtValue">
                                <?php echo isset($detail['D03_AZU_BEGIN_HH']) ? str_pad($detail['D03_AZU_BEGIN_HH'], 2, '0', STR_PAD_LEFT) : str_pad('00', 2, '0', STR_PAD_LEFT); ?>
                                ：
                                <?php echo isset($detail['D03_AZU_BEGIN_MI']) ? str_pad($detail['D03_AZU_BEGIN_MI'], 2, '0', STR_PAD_LEFT) : str_pad('00', 2, '0', STR_PAD_LEFT); ?>
                                ～
                                <?php echo isset($detail['D03_AZU_END_HH']) ? str_pad($detail['D03_AZU_END_HH'], 2, '0', STR_PAD_LEFT) : str_pad('00', 2, '0', STR_PAD_LEFT); ?>
                                ：
                                <?php echo isset($detail['D03_AZU_END_MI']) ? str_pad($detail['D03_AZU_END_MI'], 2, '0', STR_PAD_LEFT) : str_pad('00', 2, '0', STR_PAD_LEFT); ?>
                            </p>
                        </td>
                    </tr>
                </table>
            </fieldset>
        </section>
        <section class="pContent">
            <fieldset class="fieldsetRegist">
                <legend class="titleLegend">お客様情報</legend>
                <table class="tablePrint boder-black">
                    <tr>
                        <td>
                            <label class="titleLabel">お名前</label>
                        </td>
                        <td>
                            <label class="titleLabel">フリガナ</label>
                        </td>
                        <td>
                            <label class="titleLabel">備考</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="txtValue"><?php echo $detail['D01_CUST_NAMEN']; ?></p>
                        </td>
                        <td>
                            <p class="txtValue"><?php echo $detail['D01_CUST_NAMEK']; ?></p>
                        </td>
                        <td>
                            <p><?php echo nl2br($detail['D01_NOTE']); ?></p>
                        </td>
                    </tr>
                </table>
            </fieldset>
        </section>
        <section class="pContent">
            <fieldset class="fieldsetRegist">
                <div class="flexHead">
                    <legend class="titleLegend">車両情報</legend>
                </div>
                <table class="tablePrint boder-black">
                    <tr>
                        <td>
                            <label class="titleLabel">車名</label>
                        </td>
                        <td>
                            <label class="titleLabel">車検満了日</label>
                        </td>
                        <td>
                            <label class="titleLabel">車検サイクル</label>
                        </td>
                        <td>
                            <label class="titleLabel">走行距離</label>
                        </td>
                        <td>
                            <label class="titleLabel">運輸支局</label>
                        </td>
                        <td>
                            <label class="titleLabel">分類コード</label>
                        </td>
                        <td>
                            <label class="titleLabel">ひらがな</label>
                        </td>
                        <td>
                            <label class="titleLabel">登録番号</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="txtValue"><?php echo $detail['D03_CAR_NAMEN']; ?></p>
                        </td>
                        <td>
                            <p class="txtValue"><?php echo $detail['D03_JIKAI_SHAKEN_YM'] != '' ? Yii::$app->formatter->asDate(date('d-M-y', strtotime($detail['D03_JIKAI_SHAKEN_YM'])), 'yyyy年MM月dd日') : '' ?></p>
                        </td>
                        <td>
                            <p class="txtValue"><?php echo $detail['D02_SYAKEN_CYCLE']; ?>年</p>
                        </td>
                        <td>
                            <p class="txtValue"><?php echo $detail['D03_METER_KM']; ?>km</p>
                        </td>
                        <td>
                            <p class="txtValue"><?php echo $detail['D03_RIKUUN_NAMEN']; ?></p>
                        </td>
                        <td>
                            <p class="txtValue"><?php echo $detail['D03_CAR_ID']; ?></p>
                        </td>
                        <td>
                            <p class="txtValue"><?php echo $detail['D03_HIRA']; ?></p>
                        </td>
                        <td>
                            <p class="txtValue"><?php echo $detail['D03_CAR_NO']; ?></p>
                        </td>
                    </tr>
                </table>
            </fieldset>
        </section>
        <section class="pContent">
            <fieldset class="fieldsetRegist">
                <legend class="titleLegend">貴重品・精算情報</legend>
                <table class="tablePrint boder-black">
                    <tr>
                        <td>
                            <label class="titleLabel">貴重品</label>
                        </td>
                        <td>
                            <label class="titleLabel">お客様確認</label>
                        </td>
                        <td>
                            <label class="titleLabel">精算方法</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php if (isset($detail['D03_KITYOHIN']) && $detail['D03_KITYOHIN'] == 0) {
                                echo '<p class="txtValue">無し</p>';
                            } else {
                                echo '<p class="txtValue">有り</p>';
                            } ?>
                        </td>
                        <td>
                            <?php if (isset($detail['D03_KAKUNIN']) && $detail['D03_KAKUNIN']) {
                                echo '<p class="txtValue">了承済</p>';
                            } else {
                                echo '<p class="txtValue">未了承</p>';
                            } ?>
                        </td>
                        <td>
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
                        </td>
                    </tr>
                </table>
            </fieldset>
        </section>
        <section class="pContent">
            <fieldset class="fieldsetRegist">
                <legend class="titleLegend">作業内容</legend>
                <table class="tablePrint boder-black">
                    <tr>
                        <td rowspan="2">
                            <p class="txtValue">
                                <?php
                                $sagyo = '';
                                foreach ($detail['sagyo'] as $k => $v) {
                                    $sagyo .= $job[$v['D04_SAGYO_NO']] . '、';
                                }
                                echo preg_replace('/、$/', '', $sagyo);
                                ?>
                            </p>
                        </td>
                        <td>
                            <label class="titleLabel">作業者</label>
                        </td>
                        <td>
                            <label class="titleLabel">確認者</label>
                        </td>
                        <td>
                            <label class="titleLabel">その他作業内容</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="txtValue"><?php echo $detail['D03_TANTO_SEI'] .''. $detail['D03_TANTO_MEI']; ?></p>
                        </td>
                        <td>
                            <p class="txtValue"><?php echo $detail['D03_KAKUNIN_SEI'] .''. $detail['D03_KAKUNIN_MEI'] ; ?></p>
                        </td>
                        <td>
                            <p class="txtValue"><?php echo nl2br($detail['D03_SAGYO_OTHER']); ?></p>
                        </td>
                    </tr>
                </table>
            </fieldset>
        </section>
        <section class="pContent">
            <fieldset class="fieldsetRegist">
                <legend class="titleLegend">商品情報</legend>
                <table class="tablePrint custom-table">
                    <tr class="mini">
                        <th>商品コード</th>
                        <th>品名</th>
                        <th>数量</th>
                        <th>単価</th>
                        <th>金額</th>
                    </tr>
                    <?php
                    $count = count($detail['product']) > 5 ? count($detail['product']) : 5;
                    for ($k = 0; $k < $count; $k++) {
                        if (isset($detail['product'][$k])) {
                            ?>
                            <tr class="mini">
                                <td class="tdLeft" style="min-width: 15%"><?php echo $detail['product'][$k]['D05_COM_CD'].$detail['product'][$k]['D05_NST_CD']; ?></td>
                                <td class="tdLeft"><?php echo $detail['product'][$k]['M05_COM_NAMEN']; ?></td>
                                <td style="min-width: 8%"><?php echo $detail['product'][$k]['D05_SURYO']; ?></td>
                                <td style="min-width: 10%"><?php echo isset($detail['product'][$k]['D05_TANKA']) && $detail['product'][$k]['D05_TANKA'] != '' ? number_format($detail['product'][$k]['D05_TANKA']).'円' : ''; ?></td>
                                <td style="min-width: 15%"><?php echo isset($detail['product'][$k]['D05_KINGAKU']) && $detail['product'][$k]['D05_KINGAKU'] != '' ? number_format($detail['product'][$k]['D05_KINGAKU']).'円' : ''; ?></td>
                            </tr>
                        <?php } else { ?>
                            <tr class="mini">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        <?php    }} ?>
                    <tr class="mini">
                        <td colspan="3"></td>
                        <th>合計</th>
                        <td><?php echo isset($detail['D03_SUM_KINGAKU']) && $detail['D03_SUM_KINGAKU'] != '' ? number_format($detail['D03_SUM_KINGAKU']).'円' : ''; ?></td>
                    </tr>
                </table>
            </fieldset>
        </section>
        <section class="pContent">
            <fieldset class="fieldsetRegist">
                <legend class="titleLegend">作業点検</legend>
                <table class="tablePrint boder-black">
                    <tr>
                        <td>
                            <label class="titleLabel">オイル量</label>
                        </td>
                        <td>
                            <label class="titleLabel">キャップ・ゲージ</label>
                        </td>
                        <td>
                            <label class="titleLabel">タイヤ損傷・摩耗</label>
                        </td>
                        <td>
                            <label class="titleLabel">オイル漏れ</label>
                        </td>
                        <td>
                            <label class="titleLabel">ドレンボルト</label>
                        </td>
                        <td>
                            <label class="titleLabel">ボルト・ナット</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="txtValue">OK ・ NG</p>
                        </td>
                        <td>
                            <p class="txtValue">OK ・ NG</p>
                        </td>
                        <td>
                            <p class="txtValue">OK ・ NG</p>
                        </td>
                        <td>
                            <p class="txtValue">OK ・ NG</p>
                        </td>
                        <td>
                            <p class="txtValue">OK ・ NG</p>
                        </td>
                        <td>
                            <p class="txtValue">OK ・ NG</p>
                        </td>
                    </tr>
                </table>
            </fieldset>
        </section>
        <section class="pContent pageBreak">
            <fieldset class="fieldsetRegist">
                <legend class="titleLegend">作業終了確認　<span class="txtNormal">※確認項目はレ点チェック</span></legend>
                <table class="tablePrint">
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
                                        <input type="checkbox" <?php echo $confirm['tire_1'] ? 'checked' : '' ?> disabled name="tire_1">
                                    </label>
                                </div>
                                <div class="itemPrintCheck FL">
                                    <label class="labelPrintCheck">
                                        <input type="checkbox" <?php echo $confirm['tire_2'] ? 'checked' : '' ?> disabled name="tire_2">
                                    </label>
                                </div>
                                <div class="itemPrintCheck RR">
                                    <label class="labelPrintCheck">
                                        <input type="checkbox" <?php echo $confirm['tire_3'] ? 'checked' : '' ?> disabled name="tire_3">
                                    </label>
                                </div>
                                <div class="itemPrintCheck RL">
                                    <label class="labelPrintCheck">
                                        <input type="checkbox" <?php echo $confirm['tire_4'] ? 'checked' : '' ?> disabled name="tire_4">
                                    </label>
                                </div>
                            </div>
                            <p class="centering">点検レ　交換Ｘ　調整Ａ　締付Ｔ　該当／</p></td>
                        <td colspan="2"><p class="leftside">空気圧</p>
                            <div class="areaAirCheck">
                                <div class="itemPrintAir">
                                    <p class="txtValue"><span class="txtUnit">前</span><span class="spcValue"><input
                                                type="text" class="textFormConf" value="<?php echo isset($confirm['pressure_front']) ? $confirm['pressure_front'] : '' ?>" disabled name="pressure_front"></span><span
                                            class="txtUnit">kpa</span></p>
                                </div>
                                <div class="itemPrintAir">
                                    <p class="txtValue"><span class="txtUnit">後</span><span class="spcValue"><input
                                                type="text" class="textFormConf" value="<?php echo isset($confirm['pressure_behind']) ? $confirm['pressure_behind'] : '' ?>" disabled name="pressure_behind"></span><span
                                            class="txtUnit">kpa</span></p>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><p class="leftside">リムバルブ</p>
                            <div class="checkPrint">
                                <label class="labelPrintCheck">
                                    <input type="checkbox" <?php echo $confirm['rim'] ? 'checked' : '' ?> disabled name="rim">
                                    確認</label>
                            </div>
                        </td>
                        <td><p class="leftside">トルクレンチ</p>
                            <div class="checkPrint">
                                <label class="labelPrintCheck">
                                    <input type="checkbox" <?php echo $confirm['torque'] ? 'checked' : '' ?> disabled name="torque">
                                    締付</label>
                            </div>
                        </td>
                        <td><p class="leftside">ホイルキャップ</p>
                            <div class="checkPrint">
                                <label class="labelPrintCheck">
                                    <input type="checkbox" <?php echo $confirm['foil'] ? 'checked' : '' ?> disabled name="foil">
                                    取付</label>
                            </div>
                        </td>
                        <td><p class="leftside">持帰ナット</p>
                            <div class="checkPrint">
                                <label class="labelPrintCheck">
                                    <input type="checkbox" <?php echo $confirm['nut'] ? 'checked' : '' ?> disabled name="nut">
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
                                    <input type="checkbox" <?php echo $confirm['oil'] ? 'checked' : '' ?> disabled name="oil">
                                    確認</label>
                            </div>
                        </td>
                        <td><p class="leftside">オイルキャップ</p>
                            <div class="checkPrint">
                                <label class="labelPrintCheck">
                                    <input type="checkbox"<?php echo $confirm['oil_cap'] ? 'checked' : '' ?> disabled name="oil_cap">
                                    確認</label>
                            </div>
                        </td>
                        <td><p class="leftside">レベルゲージ</p>
                            <div class="checkPrint">
                                <label class="labelPrintCheck">
                                    <input type="checkbox" <?php echo $confirm['level'] ? 'checked' : '' ?> disabled name="level">
                                    確認</label>
                            </div>
                        </td>
                        <td><p class="leftside">ドレンボルト</p>
                            <div class="checkPrint">
                                <label class="labelPrintCheck">
                                    <input type="checkbox" <?php echo $confirm['drain_bolt'] ? 'checked' : '' ?> disabled name="drain_bolt">
                                    確認</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><p class="leftside">パッキン</p>
                            <div class="checkPrint">
                                <label class="labelPrintCheck">
                                    <input type="checkbox" <?php echo $confirm['packing'] ? 'checked' : '' ?> disabled name="packing">
                                    確認</label>
                            </div>
                        </td>
                        <td><p class="leftside">オイル漏れ</p>
                            <div class="checkPrint">
                                <label class="labelPrintCheck">
                                    <input type="checkbox" <?php echo $confirm['oil_leak'] ? 'checked' : '' ?> disabled name="oil_leak">
                                    確認</label>
                            </div>
                        </td>
                        <td colspan="2"><p class="leftside">次回交換目安</p>
                            <div class="checkPrint">
                                <p class="txtValue">
                                    <input type="text" class="textFormConf" value="<?php echo isset($confirm['date']) && (int)substr($confirm['date'],0,4) ? substr($confirm['date'],0,4) : '' ?>" disabled maxlength="4" style="width:4em;" name="date_1">
                                    <span class="txtUnit">年</span>
                                    <input type="text" class="textFormConf" value="<?php echo isset($confirm['date']) && (int)substr($confirm['date'],4,2) ? substr($confirm['date'],4,2) : '' ?>" disabled maxlength="2" style="width:2em;" name="date_2">
                                    <span class="txtUnit">月</span>
                                    <input type="text" class="textFormConf" value="<?php echo isset($confirm['date']) && (int)substr($confirm['date'],6,2) ? substr($confirm['date'],6,2) : '' ?>" disabled="" maxlength="2" style="width:2em;" name="date_3">
                                    <span class="txtUnit">日　または、</span>
                                    <input type="text" class="textFormConf" value="<?php echo isset($confirm['km']) ? $confirm['km'] : '' ?>" disabled name="km">
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
                                    <input type="checkbox" <?php echo $confirm['terminal'] ? 'checked' : '' ?> disabled name="terminal">
                                    確認</label>
                            </div>
                        </td>
                        <td><p class="leftside">ステー取付</p>
                            <div class="checkPrint">
                                <label class="labelPrintCheck">
                                    <input type="checkbox" <?php echo $confirm['stay'] ? 'checked' : '' ?> disabled name="stay">
                                    確認</label>
                            </div>
                        </td>
                        <td><p class="leftside">バックアップ</p>
                            <div class="checkPrint">
                                <label class="labelPrintCheck">
                                    <input type="checkbox" <?php echo $confirm['backup'] ? 'checked' : '' ?> disabled name="backup">
                                    確認</label>
                            </div>
                        </td>
                        <td><p class="leftside">スタートアップ</p>
                            <div class="checkPrint">
                                <label class="labelPrintCheck">
                                    <input type="checkbox" <?php echo $confirm['startup'] ? 'checked' : '' ?> disabled name="startup">
                                    確認</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                      <th colspan="4">備考</th>
                    </tr>
                    <tr>
                      <td colspan="4"><p class="txtValue"></p></td>
                    </tr>
                </table>
            </fieldset>
        </section>
        <section class="pContent">
            <fieldset class="fieldsetRegist">
                <legend class="titleLegend">セーフティー点検</legend>

                <table class="tablePrint">
                    <tr>
                        <th>項目</th>
                        <th colspan="2">チェック</th>
                        <th>項目</th>
                        <th colspan="2">チェック</th>
                    </tr>
                    <tr>
                        <td class="tdLeft">エンジンオイル</td>
                        <td><p class="txtValue">量　・　汚れ</p></td>
                        <td><p class="txtValue">OK ・ NG</p></td>
                        <td class="tdLeft">パワステオイル</td>
                        <td><p class="txtValue">量　・　汚れ</p></td>
                        <td><p class="txtValue">OK ・ NG</p></td>
                    </tr>
                    <tr>
                        <td class="tdLeft">ブレーキオイル</td>
                        <td><p class="txtValue">量　・　汚れ</p></td>
                        <td><p class="txtValue">OK ・ NG</p></td>
                        <td class="tdLeft">ラジエター液</td>
                        <td><p class="txtValue">量　・　汚れ</p></td>
                        <td><p class="txtValue">OK ・ NG</p></td>
                    </tr>
                    <tr>
                        <td class="tdLeft">WW液</td>
                        <td><p class="txtValue">量</p></td>
                        <td><p class="txtValue">OK ・ NG</p></td>
                        <td class="tdLeft">バッテリー</td>
                        <td><p class="txtValue">電圧　・　量</p></td>
                        <td><p class="txtValue">OK ・ NG</p></td>
                    </tr>
                    <tr>
                        <td class="tdLeft">タイヤ</td>
                        <td><p class="txtValue">摩耗　・　損傷</p></td>
                        <td><p class="txtValue">OK ・ NG</p></td>
                        <td class="tdLeft">ワイパー</td>
                        <td><p class="txtValue">損傷　・　劣化</p></td>
                        <td><p class="txtValue">OK ・ NG</p></td>
                    </tr>
                    <tr>
                        <th colspan="6">備考</th>
                    </tr>
                    <tr class="mini">
                        <td class="pNotesAlll" colspan="6"></td>
                    </tr>
                </table>

                <p class="txtSub mb5">※ドレーンボルト・ホイールナット等はトルクレンチ等を使用して確実な締付けを行っております。<br>
                    ※作業後の確認は作業者又、点検者が十分な確認を行い作業を終了いたしましたが、お客様にもご一緒にご確認いただくようご協力をお願い致します。<br>
                    ※本控えはお客様のお買い物記録として、車検証・保険証共に大切に保管してください。</p>
                <table class="tablePrint">
                    <tr class="mini">
                        <th class="vMiddle wd15">作業者</th>
                        <th class="vMiddle wd30" colspan="2">点検確認者</th>
                        <th class="vMiddle wd20">お客様サイン</th>
                        <td class="tdLeft wd35" rowspan="2"><p class="leftSide">店名</p>
                            <p><?php echo $ss; ?><br>
                                <?php echo $address ?><br>
                                <?php echo $tel ?></p></td>
                    </tr>
                    <tr>
                        <td class="vMiddle wd15"><p
                                class="txtValue"><?php echo $detail['D03_TANTO_SEI'] . '' . $detail['D03_TANTO_MEI']; ?></p>
                        </td>
                        <td class="vMiddle wd15"><p
                                class="txtValue"><?php echo $detail['D03_KAKUNIN_SEI'] . '' . $detail['D03_KAKUNIN_MEI']; ?></p>
                        </td>
                        <td class="vMiddle wd15"><p class="txtValue"></p></td>
                        <td class="vMiddle wd20"><p
                                class="txtValue"><?php echo ''; ?></p>
                        </td>
                    </tr>
                </table>
            </fieldset>
        </section>
    </article>
</main>
<footer id="printFooter">
    <p class="copyright">Copyright(C) Usami Koyu Corp. All Rights Reserved.</p>
</footer>