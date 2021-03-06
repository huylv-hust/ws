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
                            <p class="txtValue"><?php echo isset($post['D03_DEN_NO']) ? $post['D03_DEN_NO'] : ''; ?></p>
                        </td>
                        <td>
                            <p class="txtValue">
                                <?php
                                if ($post['D03_STATUS'] == 1) {
                                    echo '作業確定';
                                }
                                if ($post['D03_STATUS'] == 0) {
                                    echo '作業予約';
                                } ?>
                            </p>
                        </td>
                        <td>
                            <p class="txtValue"><?php echo isset($post['D03_UPD_DATE']) ? Yii::$app->formatter->asDate($post['D03_UPD_DATE'], 'yyyy/MM/dd') : date('Y/m/d'); ?></p>
                        </td>
                        <td>
                            <p class="txtValue"><?php echo isset($ss_user) ? $ss_user : ''?></p>
                        </td>
                        <td>
                            <p class="txtValue"><?php echo $post['D03_SEKOU_YMD'] != '' ? Yii::$app->formatter->asDate(date('d-M-Y', strtotime($post['D03_SEKOU_YMD'])), 'yyyy/MM/dd') : '' ?></p>
                        </td>
                        <td>
                            <p class="txtValue">
                                <?php echo isset($post['D03_AZU_BEGIN_HH']) ? str_pad($post['D03_AZU_BEGIN_HH'], 2, '0', STR_PAD_LEFT) : str_pad('00', 2, '0', STR_PAD_LEFT) ?>
                                ：
                                <?php echo isset($post['D03_AZU_BEGIN_MI']) ? str_pad($post['D03_AZU_BEGIN_MI'], 2, '0', STR_PAD_LEFT) : str_pad('00', 2, '0', STR_PAD_LEFT); ?>
                                ～
                                <?php echo isset($post['D03_AZU_END_HH']) ? str_pad($post['D03_AZU_END_HH'], 2, '0', STR_PAD_LEFT) : str_pad('00', 2, '0', STR_PAD_LEFT); ?>
                                ：
                                <?php echo isset($post['D03_AZU_END_MI']) ? str_pad($post['D03_AZU_END_MI'], 2, '0', STR_PAD_LEFT) : str_pad('00', 2, '0', STR_PAD_LEFT); ?>
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
                        <td width="25%">
                            <label class="titleLabel">お名前</label>
                        </td>
                        <td width="25%">
                            <label class="titleLabel">フリガナ</label>
                        </td>
                        <td width="50%">
                            <label class="titleLabel">備考</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="txtValue"><?php echo $post['D01_CUST_NAMEN']; ?></p>
                        </td>
                        <td>
                            <p class="txtValue"><?php echo $post['D01_CUST_NAMEK']; ?></p>
                        </td>
                        <td>
                            <p><?php echo nl2br($post['D01_NOTE']); ?></p>
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
                <?php if (!isset($post['D02_CAR_SEQ_SELECT'])) {
                    $D02_CAR_NAMEN = '';
                    $D02_JIKAI_SHAKEN_YM = '';
                    $D02_SYAKEN_CYCLE = '';
                    $D02_METER_KM = '';
                    $D02_RIKUUN_NAMEN = '';
                    $D02_CAR_ID = '';
                    $D02_HIRA = '';
                    $D02_CAR_NO = '';

                } else {
                    $D02_CAR_NAMEN = $post['D02_CAR_NAMEN_' . $post['D02_CAR_SEQ_SELECT']];
                    $D02_JIKAI_SHAKEN_YM = $post['D02_JIKAI_SHAKEN_YM_' . $post['D02_CAR_SEQ_SELECT']];
                    $D02_SYAKEN_CYCLE = $post['D02_SYAKEN_CYCLE' . $post['D02_CAR_SEQ_SELECT']];
                    $D02_METER_KM = $post['D02_METER_KM_' . $post['D02_CAR_SEQ_SELECT']];
                    $D02_RIKUUN_NAMEN = $post['D02_RIKUUN_NAMEN_' . $post['D02_CAR_SEQ_SELECT']];
                    $D02_CAR_ID = $post['D02_CAR_ID_' . $post['D02_CAR_SEQ_SELECT']];
                    $D02_HIRA = $post['D02_HIRA_' . $post['D02_CAR_SEQ_SELECT']];
                    $D02_CAR_NO = $post['D02_CAR_NO_' . $post['D02_CAR_SEQ_SELECT']];
                } ?>
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
                            <p class="txtValue"><?php echo $D02_CAR_NAMEN; ?></p>
                        </td>
                        <td>
                            <p class="txtValue"><?php echo $D02_JIKAI_SHAKEN_YM != '' ? Yii::$app->formatter->asDate(date('d-M-Y', strtotime($D02_JIKAI_SHAKEN_YM)), 'yyyy年MM月dd日') : '' ?></p>
                        </td>
                        <td>
                            <p class="txtValue"><?php echo $D02_SYAKEN_CYCLE; ?>年</p>
                        </td>
                        <td>
                            <p class="txtValue"><?php echo $D02_METER_KM; ?>km</p>
                        </td>
                        <td>
                            <p class="txtValue"><?php echo $D02_RIKUUN_NAMEN; ?></p>
                        </td>
                        <td>
                            <p class="txtValue"><?php echo $D02_CAR_ID; ?></p>
                        </td>
                        <td>
                            <p class="txtValue"><?php echo $D02_HIRA; ?></p>
                        </td>
                        <td>
                            <p class="txtValue"><?php echo $D02_CAR_NO; ?></p>
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
                            <?php if (isset($post['D03_KITYOHIN']) && $post['D03_KITYOHIN'] == 0) {
                                echo '<p class="txtValue">無し</p>';
                            } else {
                                echo '<p class="txtValue">有り</p>';
                            } ?>
                        </td>
                        <td>
                            <?php if (isset($post['D03_KAKUNIN'])) {
                                echo '<p class="txtValue">了承済</p>';
                            } else {
                                echo '<p class="txtValue">未了承</p>';
                            } ?>
                        </td>
                        <td>
                            <?php if (isset($post['D03_SEISAN']) && $post['D03_SEISAN'] == 0) {
                                echo '<p class="txtValue">現金</p>';
                            }
                            if (isset($post['D03_SEISAN']) && $post['D03_SEISAN'] == 1) {
                                echo '<p class="txtValue">プリカ</p>';
                            }
                            if (isset($post['D03_SEISAN']) && $post['D03_SEISAN'] == 2) {
                                echo '<p class="txtValue">クレジット</p>';
                            }
                            if (isset($post['D03_SEISAN']) && $post['D03_SEISAN'] == 3) {
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
                            <?php
                            $sagyo = '';
                            if (isset($post['M01_SAGYO_NO'])) {
                                foreach ($post['M01_SAGYO_NO'] as $k => $v) {
                                    $sagyo .= $job[$v] . '、';
                                }
                                echo preg_replace('/、$/', '', $sagyo);
                            }
                            ?>
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
                            <p class="txtValue"><?php echo isset($post['tanto']) ? $post['tanto'] : ''; ?></p>
                        </td>
                        <td>
                            <p class="txtValue"><?php echo isset($post['kakunin']) ? $post['kakunin'] : ''; ?></p>
                        </td>
                        <td>
                            <p class="txtValue"><?php echo nl2br($post['D03_SAGYO_OTHER']); ?></p>
                        </td>
                    </tr>
                </table>
            </fieldset>
        </section>
        <section class="pContent">
            <fieldset class="fieldsetRegist">
                <legend class="titleLegend">商品情報</legend>
                <table class="tablePrint">
                    <tr class="mini">
                        <th>商品コード</th>
                        <th>品名</th>
                        <th>数量</th>
                        <th>単価</th>
                        <th>金額</th>
                    </tr>
                    <?php
                    $count = count(array_filter($post['LIST_NAME'])) > 5 ? count(array_filter($post['LIST_NAME'])) : 5;
                    for ($k = 1; $k <= $count; $k++) {
                        if (isset($post['D05_COM_CD' . $k])) {
                            ?>
                            <tr class="mini">
                                <td class="tdLeft"
                                    style="min-width: 15%"><?php echo $post['D05_COM_CD' . $k] . $post['D05_NST_CD' . $k]; ?></td>
                                <td class="tdLeft"><?php echo $post['M05_COM_NAMEN' . $k]; ?></td>
                                <td style="min-width: 8%"><?php echo $post['D05_SURYO' . $k]; ?></td>
                                <td style="min-width: 10%"><?php echo $post['D05_TANKA' . $k] != '' ? number_format($post['D05_TANKA' . $k]).'円' : ''; ?></td>
                                <td style="min-width: 15%"><?php echo $post['D05_KINGAKU' . $k] != '' ? number_format($post['D05_KINGAKU' . $k]).'円' : ''; ?></td>
                            </tr>
                        <?php } else { ?>
                            <tr class="mini">
                                <td class="tdLeft"></td>
                                <td class="tdLeft"></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        <?php }
                    } ?>
                    <tr class="mini">
                        <td colspan="3"></td>
                        <th>合計</th>
                        <td><?php echo $post['D03_SUM_KINGAKU'] != '' ? number_format($post['D03_SUM_KINGAKU']).'円' : ''; ?></td>
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
                        <td colspan="2"><p class="leftside leftside-custom">タイヤ交換図</p>
                            <div class="areaPrintCheckImg"><img
                                    src="<?php echo \yii\helpers\BaseUrl::base(true) ?>/img/handwriting.png" alt=""
                                    class="itemPrintCheckImg">
                                <div class="itemPrintCheck FR">
                                    <label class="labelPrintCheck">
                                        <input type="checkbox" <?php echo isset($post['tire_1']) ? 'checked' : '' ?>
                                               disabled name="tire_1">
                                    </label>
                                </div>
                                <div class="itemPrintCheck FL">
                                    <label class="labelPrintCheck">
                                        <input type="checkbox" <?php echo isset($post['tire_2']) ? 'checked' : '' ?>
                                               disabled name="tire_2">
                                    </label>
                                </div>
                                <div class="itemPrintCheck RR">
                                    <label class="labelPrintCheck">
                                        <input type="checkbox" <?php echo isset($post['tire_3']) ? 'checked' : '' ?>
                                               disabled name="tire_3">
                                    </label>
                                </div>
                                <div class="itemPrintCheck RL">
                                    <label class="labelPrintCheck">
                                        <input type="checkbox" <?php echo isset($post['tire_4']) ? 'checked' : '' ?>
                                               disabled name="tire_4">
                                    </label>
                                </div>
                            </div>
                            <p class="centering">点検レ　交換Ｘ　調整Ａ　締付Ｔ　該当／</p></td>
                        <td colspan="2"><p class="leftside leftside-custom">空気圧</p>
                            <div class="areaAirCheck">
                                <div class="itemPrintAir">
                                    <p class="txtValue"><span class="txtUnit">前</span><span class="spcValue"><input
                                                type="text" class="textFormConf"
                                                value="<?php echo $post['pressure_front'] ?>" disabled
                                                name="pressure_front"></span><span
                                            class="txtUnit">kpa</span></p>
                                </div>
                                <div class="itemPrintAir">
                                    <p class="txtValue"><span class="txtUnit">後</span><span class="spcValue"><input
                                                type="text" class="textFormConf"
                                                value="<?php echo $post['pressure_behind'] ?>" disabled
                                                name="pressure_behind"></span><span
                                            class="txtUnit">kpa</span></p>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 25%"><p class="leftside">リムバルブ</p>
                            <div class="checkPrint">
                                <label class="labelPrintCheck">
                                    <input type="checkbox" <?php echo isset($post['rim']) ? 'checked' : '' ?> disabled
                                           name="rim">
                                    確認</label>
                            </div>
                        </td>
                        <td style="width: 25%"><p class="leftside">トルクレンチ</p>
                            <div class="checkPrint">
                                <label class="labelPrintCheck">
                                    <input type="checkbox" <?php echo isset($post['torque']) ? 'checked' : '' ?>
                                           disabled name="torque">
                                    締付</label>
                            </div>
                        </td>
                        <td style="width: 25%"><p class="leftside">ホイルキャップ</p>
                            <div class="checkPrint">
                                <label class="labelPrintCheck">
                                    <input type="checkbox" <?php echo isset($post['foil']) ? 'checked' : '' ?> disabled
                                           name="foil">
                                    取付</label>
                            </div>
                        </td>
                        <td style="width: 25%"><p class="leftside">持帰ナット</p>
                            <div class="checkPrint">
                                <label class="labelPrintCheck">
                                    <input type="checkbox" <?php echo isset($post['nut']) ? 'checked' : '' ?> disabled
                                           name="nut">
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
                                    <input type="checkbox" <?php echo isset($post['oil']) ? 'checked' : '' ?> disabled
                                           name="oil">
                                    確認</label>
                            </div>
                        </td>
                        <td><p class="leftside">オイルキャップ</p>
                            <div class="checkPrint">
                                <label class="labelPrintCheck">
                                    <input type="checkbox"<?php echo isset($post['oil_cap']) ? 'checked' : '' ?>
                                           disabled name="oil_cap">
                                    確認</label>
                            </div>
                        </td>
                        <td><p class="leftside">レベルゲージ</p>
                            <div class="checkPrint">
                                <label class="labelPrintCheck">
                                    <input type="checkbox" <?php echo isset($post['level']) ? 'checked' : '' ?> disabled
                                           name="level">
                                    確認</label>
                            </div>
                        </td>
                        <td><p class="leftside">ドレンボルト</p>
                            <div class="checkPrint">
                                <label class="labelPrintCheck">
                                    <input type="checkbox" <?php echo isset($post['drain_bolt']) ? 'checked' : '' ?>
                                           disabled name="drain_bolt">
                                    確認</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><p class="leftside">パッキン</p>
                            <div class="checkPrint">
                                <label class="labelPrintCheck">
                                    <input type="checkbox" <?php echo isset($post['packing']) ? 'checked' : '' ?>
                                           disabled name="packing">
                                    確認</label>
                            </div>
                        </td>
                        <td><p class="leftside">オイル漏れ</p>
                            <div class="checkPrint">
                                <label class="labelPrintCheck">
                                    <input type="checkbox" <?php echo isset($post['oil_leak']) ? 'checked' : '' ?>
                                           disabled name="oil_leak">
                                    確認</label>
                            </div>
                        </td>
                        <td colspan="2" class="td-custom-input"><p class="leftside">次回交換目安</p>
                            <div class="checkPrint">
                                <p class="txtValue">
                                    <input type="text" class="textFormConf" value="<?php echo $post['date_1'] ?>"
                                           disabled maxlength="4" style="width:4em;" name="date_1">
                                    <span class="txtUnit">年</span>
                                    <input type="text" class="textFormConf" value="<?php echo $post['date_2'] ?>"
                                           disabled maxlength="2" style="width:2em;" name="date_2">
                                    <span class="txtUnit">月</span>
                                    <input type="text" class="textFormConf" value="<?php echo $post['date_3'] ?>"
                                           disabled="" maxlength="2" style="width:2em;" name="date_3">
                                    <span class="txtUnit">日　または、</span>
                                    <input type="text" class="textFormConf" value="<?php echo $post['km'] ?>" disabled
                                           name="km">
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
                                    <input type="checkbox" <?php echo isset($post['terminal']) ? 'checked' : '' ?>
                                           disabled name="terminal">
                                    確認</label>
                            </div>
                        </td>
                        <td><p class="leftside">ステー取付</p>
                            <div class="checkPrint">
                                <label class="labelPrintCheck">
                                    <input type="checkbox" <?php echo isset($post['stay']) ? 'checked' : '' ?> disabled
                                           name="stay">
                                    確認</label>
                            </div>
                        </td>
                        <td><p class="leftside">バックアップ</p>
                            <div class="checkPrint">
                                <label class="labelPrintCheck">
                                    <input type="checkbox" <?php echo isset($post['backup']) ? 'checked' : '' ?>
                                           disabled name="backup">
                                    確認</label>
                            </div>
                        </td>
                        <td><p class="leftside">スタートアップ</p>
                            <div class="checkPrint">
                                <label class="labelPrintCheck">
                                    <input type="checkbox" <?php echo isset($post['startup']) ? 'checked' : '' ?>
                                           disabled name="startup">
                                    確認</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                      <th colspan="4">備考</th>
                    </tr>
                    <tr>
                      <td colspan="4"><p class="txtValue"><?php echo nl2br($post['D03_NOTE']); ?></p></td>
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
                                class="txtValue"><?php echo isset($post['tanto']) ? $post['tanto'] : ''; ?></p>
                        </td>
                        <td class="vMiddle wd15"><p
                                class="txtValue"><?php echo isset($post['kakunin']) ? $post['kakunin'] : ''; ?></p>
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