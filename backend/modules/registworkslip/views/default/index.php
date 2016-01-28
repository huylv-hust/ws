<form id="login_form" method="post"
      action="<?= \yii\helpers\BaseUrl::base(true) ?>/regist-workslip?denpyo_no=<?= (int)$d03DenNo ?>"
      class="form-horizontal">
    <main id="contents">
        <section class="readme">
            <h2 class="titleContent">作業伝票作成</h2>
            <p class="rightside">受付日 <?php echo date('Y年m月d日'); ?></p>
        </section>

        <input type="hidden" name="D03_DEN_NO" id="D03_DEN_NO" value="<?= $d03DenNo ?>"/>
        <input type="hidden" name="D01_CUST_NO" value="<?= $cus['D01_CUST_NO'] ?>" id="D01_CUST_NO"/>
        <input type="hidden" name="WARRANTY_CUST_NAMEN" value="<?= $cus['D01_CUST_NAMEN'] ?>" id="D01_CUST_NAMEN"/>
        <input type="hidden" name="D03_CUST_NO" value="<?= $denpyo['D03_CUST_NO'] ?>" id="D03_CUST_NO"/>
        <input type="hidden" name="D03_STATUS" value="<?= isset($denpyo['D03_STATUS']) ? $denpyo['D03_STATUS'] : 0?>" id="D03_CUST_NO"/>
        <article class="container">
            <?php if (isset($errorEditInsert)) { ?>
                <div class="alert alert-danger">編集が失敗しました。</div>
            <?php } ?>
            <?php if (isset($notExitCus)) { ?>
                <div class="alert alert-danger">編集が失敗しました。(No Cust)</div>
            <?php } ?>


            <p class="note">項目を入力してください。<span class="must">*</span>は必須入力項目です。<br>
                商品情報にタイヤを追加すると、保証書作成用の入力フォームが表示されます。
            </p>
            <section class="bgContent">
                <fieldset class="fieldsetRegist">
                    <div class="formGroup">
                        <div class="formItem">
                            <label class="titleLabel">受付担当者<span class="must">*</span></label>
                            <?= \yii\helpers\Html::dropDownList('M08_NAME_MEI_M08_NAME_SEI', $cus['D01_UKE_JYUG_CD'], $ssUer, array('class' => 'selectForm D01_UKE_JYUG_CD', 'id' => 'D01_UKE_JYUG_CD')) ?>
                        </div>
                        <div class="formItem">
                            <label class="titleLabel">SSコード<span class="must">*</span></label>
                            <input type="text" maxlength="6" id="D01_SS_CD"
                                   value="<?= $d03DenNo ? $denpyo['D03_SS_CD'] : $cus['D01_SS_CD'] ?>"
                                   name="D01_SS_CD" class="textForm">
                        </div>
                    </div>
                </fieldset>
            </section>
            <section class="bgContent">
                <fieldset class="fieldsetRegist">
                    <div class="flexHead">
                        <legend class="titleLegend">お客様情報</legend>
                        <?php if ($d03DenNo == 0) { ?>
                            <a data-toggle="modal" class="onModal" href="#modalEditCustomer">編集</a>
                        <?php } ?>
                    </div>
                    <div class="formGroup">
                        <div class="formItem">
                            <label class="titleLabel">お名前</label>
                            <p class="txtValue"><?= $cus['D01_CUST_NAMEN'] ?></p>
                            <input type="hidden" value="<?= $cus['D01_CUST_NAMEN'] ?>" name="D01_CUST_NAMEN">
                        </div>
                        <div class="formItem">
                            <label class="titleLabel">フリガナ</label>
                            <p class="txtValue"><?= $cus['D01_CUST_NAMEK'] ?></p>
                            <input type="hidden" value="<?= $cus['D01_CUST_NAMEK'] ?>" name="D01_CUST_NAMEK">
                        </div>
                    </div>
                    <div class="formGroup">
                        <div class="formItem">
                            <label class="titleLabel">備考</label>
                            <p><?= nl2br($cus['D01_NOTE']) ?></p>
                            <input type="hidden" value="<?= $cus['D01_NOTE'] ?>" name="D01_NOTE">
                        </div>
                    </div>
                </fieldset>
            </section>
            <section class="bgContent">
                <fieldset class="fieldsetRegist">
                    <div class="flexHead">
                        <legend class="titleLegend">車両情報</legend>
                        <?php if ($d03DenNo == 0) { ?>
                            <a data-toggle="modal" onclick="showSeqCar()" class="onModal" href="#modalEditCar">編集</a>
                        <?php } ?>
                    </div>
                    <div class="formGroup">
                        <div class="formItem">
                            <label class="titleLabel">今回メンテナンスする車両</label>
                            <select class="selectForm" name="D02_CAR_SEQ_SELECT" id="D02_CAR_SEQ">
                                <?php
                                $selected = (int)$denpyo['D03_CAR_SEQ'];
                                for ($i = 1; $i < $totalCarOfCus + 1; ++$i) {
                                    if ($i == $selected)
                                        echo '<option selected="selected" value="' . ($i) . '">' . str_pad($i, 4, '0', STR_PAD_LEFT) . '</option>';
                                    else
                                        echo '<option value="' . ($i) . '">' . str_pad($i, 4, '0', STR_PAD_LEFT) . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <?php
                        $k = 1;
                        $carOrigin = $car;
                        foreach ($carOrigin as $key => $carFirst) {
                            ?>
                            <input type="hidden" name="D02_CAR_NO_<?= $k ?>" value="<?= $carFirst['D02_CAR_NO'] ?>"/>
                            <input type="hidden" name="D02_CAR_ID_<?= $k ?>" value="<?= $carFirst['D02_CAR_ID'] ?>"/>
                            <input type="hidden" name="D02_METER_KM_<?= $k ?>"
                                   value="<?= $carFirst['D02_METER_KM'] ?>"/>
                            <input type="hidden" name="D02_HIRA_<?= $k ?>" value="<?= $carFirst['D02_HIRA'] ?>"/>
                            <input type="hidden" name="D02_CAR_NAMEN_<?= $k ?>"
                                   value="<?= $carFirst['D02_CAR_NAMEN'] ?>"/>
                            <input type="hidden" name="D02_JIKAI_SHAKEN_YM_<?= $k ?>"
                                   value="<?= $carFirst['D02_JIKAI_SHAKEN_YM'] ?>"/>
                            <input type="hidden" name="D02_SYAKEN_CYCLE_<?= $k ?>"
                                   value="<?= $carFirst['D02_SYAKEN_CYCLE'] ?>"/>
                            <input type="hidden" name="D02_RIKUUN_NAMEN_<?= $k ?>"
                                   value="<?= $carFirst['D02_RIKUUN_NAMEN'] ?>"/>
                            <div class="formItem carDataBasic carDataBasic<?= $k ?>" style="display: none;">
                                <label class="titleLabel">車名</label>
                                <p class="txtValue"><?= $carFirst['D02_CAR_NAMEN'] ?></p>
                            </div>
                            <div class="formItem carDataBasic carDataBasic<?= $k ?>" style="display: none;">
                                <label class="titleLabel">車検満了日</label>
                                <p class="txtValue"><?php echo substr($carFirst['D02_JIKAI_SHAKEN_YM'], 0, 4) . '年' . substr($carFirst['D02_JIKAI_SHAKEN_YM'], 4, 2) . '月' . substr($carFirst['D02_JIKAI_SHAKEN_YM'], 6, 2) ?></p>
                            </div>
                            <div class="formItem carDataBasic carDataBasic<?= $k ?>" style="display: none;">
                                <label class="titleLabel">走行距離</label>
                                <p class="txtValue"><?= $carFirst['D02_METER_KM'] ?></p>
                            </div>
                            <div class="formItem carDataBasic carDataBasic<?= $k ?>" style="display: none;">
                                <label class="titleLabel">運輸支局</label>
                                <p class="txtValue"><?= $carFirst['D02_RIKUUN_NAMEN'] ?></p>
                            </div>
                            <div class="formItem carDataBasic carDataBasic<?= $k ?>" style="display: none;">
                                <label class="titleLabel">分類コード</label>
                                <p class="txtValue"><?= $carFirst['D02_CAR_ID'] ?></p>
                            </div>
                            <div class="formItem carDataBasic carDataBasic<?= $k ?>" style="display: none;">
                                <label class="titleLabel">ひらがな</label>
                                <p class="txtValue"><?= $carFirst['D02_HIRA'] ?></p>
                            </div>
                            <div class="formItem carDataBasic carDataBasic<?= $k ?>" style="display: none;">
                                <label class="titleLabel">登録番号</label>
                                <p class="txtValue"><?= $carFirst['D02_CAR_NO'] ?></p>
                            </div>
                            <?php
                            ++$k;
                        }
                        ?>
                    </div>
                </fieldset>
            </section>
            <section class="bgContent">
                <fieldset class="fieldsetRegist">
                    <legend class="titleLegend">貴重品・精算情報</legend>
                    <div class="formGroup">
                        <div class="formItem">
                            <label class="titleLabel">貴重品</label>
                            <div class="radioGroup">
                                <div class="radioItem">
                                    <input type="radio" name="D03_KITYOHIN" value="1" id="valuables1" class="radios">
                                    <label class="labelRadios<?php if ($denpyo['D03_KITYOHIN'] == 1) echo ' checked' ?>"
                                           for="valuables1">有り</label>
                                </div>
                                <div class="radioItem">
                                    <input type="radio" name="D03_KITYOHIN" value="0" id="valuables2"
                                           class="radios" <?php if ($d03DenNo == 0) echo 'checked="checked"'; ?>>
                                    <label
                                        class="labelRadios<?php if ($d03DenNo == 0 || $denpyo['D03_KITYOHIN'] == 0) echo ' checked' ?>"
                                        for="valuables2">無し</label>
                                </div>
                            </div>

                        </div>
                        <div class="formItem">
                            <label class="titleLabel">お客様確認</label>
                            <div class="checkGroup">
                                <div class="checkItem" style="position: relative;">
                                    <input type="checkbox" name="D03_KAKUNIN"
                                           value="1" <?php if ($denpyo['D03_KAKUNIN'] == 1) echo 'checked="checked"' ?>
                                           id="agree1" style="display: none">
                                    <label
                                        class="labelSingleCheck <?php if ($denpyo['D03_KAKUNIN'] == 1) echo 'checked'; ?>"
                                        for="agree1">了解済OK</label>
                                </div>
                            </div>
                        </div>
                        <!-- BEGIN PAY -->
                        <div class="formItem">
                            <label class="titleLabel">精算方法</label>
                            <div class="radioGroup">
                                <div class="radioItem">
                                    <input type="radio" value="0" name="D03_SEISAN" id="pays1" class="radios" checked>
                                    <label
                                        class="labelRadios <?php if ($d03DenNo == 0 || $denpyo['D03_SEISAN'] == 0) echo ' checked' ?>"
                                        for="pays1">現金</label>
                                </div>
                                <div class="radioItem">
                                    <input type="radio" name="D03_SEISAN" value="1" id="pays2" class="radios">
                                    <label class="labelRadios<?php if ($denpyo['D03_SEISAN'] == 1) echo ' checked' ?>"
                                           for="pays2">プリカ</label>
                                </div>
                                <div class="radioItem">
                                    <input type="radio" name="D03_SEISAN" value="2" id="pays3" class="radios">
                                    <label class="labelRadios<?php if ($denpyo['D03_SEISAN'] == 2) echo ' checked' ?>"
                                           for="pays3">クレジット</label>
                                </div>
                                <div class="radioItem">
                                    <input type="radio" name="D03_SEISAN" value="3" id="pays4" class="radios">
                                    <label class="labelRadios<?php if ($denpyo['D03_SEISAN'] == 3) echo ' checked' ?>"
                                           for="pays4">掛</label>
                                </div>
                            </div>
                        </div>
                        <!-- END PAY -->
                    </div>
                </fieldset>
            </section>
            <section class="bgContent">
                <fieldset class="fieldsetRegist">
                    <legend class="titleLegend">作業日など</legend>
                    <div class="formGroup">
                        <div class="formItem">
                            <label class="titleLabel">施行日（予約日）<span class="must">*</span></label>
                            <input maxlength="8" type="text" value="<?= $denpyo['D03_SEKOU_YMD'] ?>"
                                   name="D03_SEKOU_YMD"
                                   class="textForm">
                            <span class="txtExample">例)2013年1月30日→20130130</span></div>
                        <div class="formItem">
                            <label class="titleLabel">お預かり時間</label>
                            <select class="selectForm" name="D03_AZU_BEGIN_HH">

                                <?php
                                $hour = (int)date('H');
                                $selected = $d03DenNo ? $denpyo['D03_AZU_BEGIN_HH'] : $hour;
                                for ($i = 0; $i < 24; ++$i) {
                                    if ($i == $selected) {
                                        ?>
                                        <option selected="selected"
                                                value="<?= $i ?>"><?php echo str_pad($i, 2, '0', STR_PAD_LEFT) ?></option>
                                    <?php } else { ?>
                                        <option
                                            value="<?= $i ?>"><?php echo str_pad($i, 2, '0', STR_PAD_LEFT) ?></option>
                                        <?php
                                    }
                                }
                                ?>

                            </select>
                            <span class="txtUnit">：</span>
                            <select class="selectForm" name="D03_AZU_BEGIN_MI">
                                <?php
                                $mi = (int)date('i') - (int)date('i') % 10;
                                $selected = $d03DenNo ? $denpyo['D03_AZU_BEGIN_MI'] : $mi;
                                for ($i = 0; $i < 60; $i = $i + 10) {
                                    if ($i == $mi) {
                                        ?>
                                        <option selected="selected"
                                                value="<?= $i ?>"><?php echo str_pad($i, 2, '0', STR_PAD_LEFT) ?></option>
                                    <?php } else { ?>
                                        <option
                                            value="<?= $i ?>"><?php echo str_pad($i, 2, '0', STR_PAD_LEFT) ?></option>
                                    <?php }
                                }
                                ?>
                            </select>
                            <span class="txtUnit">〜</span>
                            <select class="selectForm" name="D03_AZU_END_HH">
                                <?php
                                $hour = (int)date('H');
                                $selected = $d03DenNo ? $denpyo['D03_AZU_END_HH'] : ($hour + 1);
                                for ($i = 0; $i < 24; ++$i) {
                                    if ($i == $selected) {
                                        ?>
                                        <option selected="selected"
                                                value="<?= $i ?>"><?php echo str_pad($i, 2, '0', STR_PAD_LEFT) ?></option>
                                    <?php } else { ?>
                                        <option
                                            value="<?= $i ?>"><?php echo str_pad($i, 2, '0', STR_PAD_LEFT) ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                            <span class="txtUnit">：</span>
                            <select class="selectForm" name="D03_AZU_END_MI">
                                <?php
                                $mi = (int)date('i') - (int)date('i') % 10;
                                $selected = $d03DenNo ? $denpyo['D03_AZU_END_MI'] : $mi;
                                for ($i = 0; $i < 60; $i = $i + 10) {
                                    if ($i == $selected) {
                                        ?>
                                        <option selected="selected"
                                                value="<?= $i ?>"><?php echo str_pad($i, 2, '0', STR_PAD_LEFT) ?></option>
                                    <?php } else { ?>
                                        <option
                                            value="<?= $i ?>"><?php echo str_pad($i, 2, '0', STR_PAD_LEFT) ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="formGroup">
                        <div class="formItem">
                            <label class="titleLabel">予約内容</label>
                            <?= \yii\helpers\Html::dropDownList('D03_YOYAKU_SAGYO_NO', $denpyo['D03_YOYAKU_SAGYO_NO'], Yii::$app->params['d03YoyakuSagyoNo'], array('class' => 'selectForm', 'id' => 'D03_YOYAKU_SAGYO_NO')) ?>
                        </div>
                        <div class="formItem">
                            <label
                                class="titleLabel">作業者<?php //echo $denpyo['D03_TANTO_MEI'].$denpyo['D03_TANTO_SEI']; ?></label>
                            <?= \yii\helpers\Html::dropDownList('D03_TANTO_MEI_D03_TANTO_SEI', $denpyo['D03_TANTO_MEI'] . '[]' . $denpyo['D03_TANTO_SEI'], $ssUerDenpyo, array('class' => 'selectForm D03_TANTO_MEI_D03_TANTO_SEI', 'id' => 'D03_TANTO_MEI_D03_TANTO_SEI')) ?>

                        </div>
                        <div class="formItem">
                            <label
                                class="titleLabel">確認者<?php //echo $denpyo['D03_KAKUNIN_MEI'].$denpyo['D03_KAKUNIN_SEI'] ?></label>
                            <?= \yii\helpers\Html::dropDownList('D03_KAKUNIN_MEI_D03_KAKUNIN_SEI', $denpyo['D03_KAKUNIN_MEI'] . '[]' . $denpyo['D03_KAKUNIN_SEI'], $ssUerDenpyo, array('class' => 'selectForm D03_KAKUNIN_MEI_D03_KAKUNIN_SEI', 'id' => 'D03_KAKUNIN_MEI_D03_KAKUNIN_SEI')) ?>
                        </div>
                    </div>
                </fieldset>
            </section>
            <section class="bgContent">
                <fieldset class="fieldsetRegist">
                    <legend class="titleLegend">作業内容</legend>
                    <div class="formGroup">
                        <div class="formItem">
                            <div class="checkGroup">
                                <?php
                                $k = 1;
                                foreach ($tm01Sagyo as $work) {
                                    if (in_array($work['M01_SAGYO_NO'], $sagyoCheck))
                                        $ck = 'checked="checked"';
                                    else
                                        $ck = '';
                                    ?>
                                    <div class="checkItem">
                                        <input type="checkbox" name="M01_SAGYO_NO[]" id="workDetai<?= $k ?>"
                                               value="<?= $work['M01_SAGYO_NO'] ?>" class="checks" <?= $ck ?> >
                                        <label class="labelChecks"
                                               for="workDetail<?= $k ?>"><?= $work['M01_SAGYO_NAMEN'] ?></label>
                                    </div>
                                    <?php
                                    ++$k;
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="formGroup">
                        <div class="formItem">
                            <label class="titleLabel">その他作業内容</label>
							<textarea maxlength="1000" class="textarea"
                                      name="D03_SAGYO_OTHER"><?= $denpyo['D03_SAGYO_OTHER'] ?></textarea>
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
                                            <input
                                                type="checkbox" <?php echo ($confirm['tire_1']) == 1 ? 'checked' : '' ?>
                                                name="tire_1">
                                        </label>
                                    </div>
                                    <div class="itemPrintCheck FL">
                                        <label class="labelPrintCheck">
                                            <input
                                                type="checkbox" <?php echo ($confirm['tire_2']) == 1 ? 'checked' : '' ?>
                                                name="tire_2">
                                        </label>
                                    </div>
                                    <div class="itemPrintCheck RR">
                                        <label class="labelPrintCheck">
                                            <input
                                                type="checkbox" <?php echo ($confirm['tire_3']) == 1 ? 'checked' : '' ?>
                                                name="tire_3">
                                        </label>
                                    </div>
                                    <div class="itemPrintCheck RL">
                                        <label class="labelPrintCheck">
                                            <input
                                                type="checkbox" <?php echo ($confirm['tire_4']) == 1 ? 'checked' : '' ?>
                                                name="tire_4">
                                        </label>
                                    </div>
                                </div>
                                <p class="centering">点検レ　交換Ｘ　調整Ａ　締付Ｔ　該当／</p></td>
                            <td colspan="2"><p class="leftside">空気圧</p>
                                <div class="areaAirCheck">
                                    <div class="itemPrintAir">
                                        <p class="txtValue"><span class="txtUnit">前</span><span class="spcValue"><input
                                                    min="0"
                                                    type="number" class="textFormConf"
                                                    value="<?php echo $confirm['pressure_front'] ?>"
                                                    name="pressure_front"></span><span
                                                class="txtUnit">kpa</span></p>
                                    </div>
                                    <div class="itemPrintAir">
                                        <p class="txtValue"><span class="txtUnit">後</span><span class="spcValue"><input
                                                    min="0"
                                                    type="number" class="textFormConf"
                                                    value="<?php echo $confirm['pressure_behind'] ?>"
                                                    name="pressure_behind"></span><span
                                                class="txtUnit">kpa</span></p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><p class="leftside">リムバルブ</p>
                                <div class="checkPrint">
                                    <label class="labelPrintCheck">
                                        <input type="checkbox"
                                               value="1" <?php echo ($confirm['rim']) == 1 ? 'checked' : '' ?>
                                               name="rim">
                                        確認</label>
                                </div>
                            </td>
                            <td><p class="leftside">トルクレンチ</p>
                                <div class="checkPrint">
                                    <label class="labelPrintCheck">
                                        <input type="checkbox"
                                               value="1" <?php echo ($confirm['rim']) ? 'checked' : '' ?> name="torque">
                                        締付</label>
                                </div>
                            </td>
                            <td><p class="leftside">ホイルキャップ</p>
                                <div class="checkPrint">
                                    <label class="labelPrintCheck">
                                        <input type="checkbox"
                                               value="1" <?php echo ($confirm['foil']) == 1 ? 'checked' : '' ?>
                                               name="foil">
                                        取付</label>
                                </div>
                            </td>
                            <td><p class="leftside">持帰ナット</p>
                                <div class="checkPrint">
                                    <label class="labelPrintCheck">
                                        <input type="checkbox"
                                               value="1" <?php echo ($confirm['nut']) == 1 ? 'checked' : '' ?>
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
                                        <input type="checkbox"
                                               value="1" <?php echo ($confirm['oil']) == 1 ? 'checked' : '' ?>
                                               name="oil">
                                        確認</label>
                                </div>
                            </td>
                            <td><p class="leftside">オイルキャップ</p>
                                <div class="checkPrint">
                                    <label class="labelPrintCheck">
                                        <input type="checkbox"<?php echo ($confirm['oil_cap']) == 1 ? 'checked' : '' ?>
                                               value="1" name="oil_cap">
                                        確認</label>
                                </div>
                            </td>
                            <td><p class="leftside">レベルゲージ</p>
                                <div class="checkPrint">
                                    <label class="labelPrintCheck">
                                        <input type="checkbox" <?php echo ($confirm['level']) == 1 ? 'checked' : '' ?>
                                               value="1" name="level">
                                        確認</label>
                                </div>
                            </td>
                            <td><p class="leftside">ドレンボルト</p>
                                <div class="checkPrint">
                                    <label class="labelPrintCheck">
                                        <input
                                            type="checkbox" <?php echo ($confirm['drain_bolt']) == 1 ? 'checked' : '' ?>
                                            value="1" name="drain_bolt">
                                        確認</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><p class="leftside">パッキン</p>
                                <div class="checkPrint">
                                    <label class="labelPrintCheck">
                                        <input type="checkbox" <?php echo ($confirm['packing']) == 1 ? 'checked' : '' ?>
                                               value="1" name="packing">
                                        確認</label>
                                </div>
                            </td>
                            <td><p class="leftside">オイル漏れ</p>
                                <div class="checkPrint">
                                    <label class="labelPrintCheck">
                                        <input
                                            type="checkbox" <?php echo ($confirm['oil_leak']) == 1 ? 'checked' : '' ?>
                                            value="1" name="oil_leak">
                                        確認</label>
                                </div>
                            </td>
                            <td colspan="2"><p class="leftside">次回交換目安</p>
                                <div class="checkPrint">
                                    <p class="txtValue">
                                        <input min="0" type="number" class="textFormConf"
                                               value="<?php echo ($confirm['date']) ? substr($confirm['date'], 0, 4) : '' ?>"
                                                style="width:4em;" name="date_1">
                                        <span class="txtUnit">年</span>
                                        <input min="0" type="number" class="textFormConf"
                                               value="<?php echo ($confirm['date']) ? substr($confirm['date'], 4, 2) : '' ?>"
                                                style="width:2em;" name="date_2">
                                        <span class="txtUnit">月</span>
                                        <input min="0" type="number" class="textFormConf"
                                               value="<?php echo ($confirm['date']) ? substr($confirm['date'], 6, 2) : '' ?>"
                                               maxlength="2" style="width:2em;" name="date_3">
                                        <span class="txtUnit">日　または、</span>
                                        <input min="0" type="number" class="textFormConf"
                                               value="<?php echo ($confirm['km']) ? $confirm['km'] : '' ?>" name="km">
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
                                        <input
                                            type="checkbox" <?php echo ($confirm['terminal']) == 1 ? 'checked' : '' ?>
                                            value="1" name="terminal">
                                        確認</label>
                                </div>
                            </td>
                            <td><p class="leftside">ステー取付</p>
                                <div class="checkPrint">
                                    <label class="labelPrintCheck">
                                        <input type="checkbox" <?php echo ($confirm['stay']) == 1 ? 'checked' : '' ?>
                                               value="1" name="stay">
                                        確認</label>
                                </div>
                            </td>
                            <td><p class="leftside">バックアップ</p>
                                <div class="checkPrint">
                                    <label class="labelPrintCheck">
                                        <input type="checkbox" <?php echo ($confirm['backup']) == 1 ? 'checked' : '' ?>
                                               value="1" name="backup">
                                        確認</label>
                                </div>
                            </td>
                            <td><p class="leftside">スタートアップ</p>
                                <div class="checkPrint">
                                    <label class="labelPrintCheck">
                                        <input type="checkbox" <?php echo ($confirm['startup']) == 1 ? 'checked' : '' ?>
                                               value="1" name="startup">
                                        確認</label>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </fieldset>
            </section>
            <section class="bgContent" id="bgContentProduct">
                <fieldset class="fieldsetRegist">
                    <a class="addCommodity" href="#">追加</a>
                    <legend class="titleLegend">商品情報</legend>
                    <?php
                    $k = 1;
                    $showWarranty = false;
                    $disabled = '';
                    if(file_exists('data/pdf/'.$d03DenNo.'.pdf')) {
                        $disabled = 'disabled';
                    }
                    foreach ($listDenpyoCom as $com) {

                        if (in_array((int)$com['D05_COM_CD'], range(42000, 42999))) {
                            $showWarranty = true;
                            $isTaisa = true;

                        } else {
                            $isTaisa = false;

                        }

                        ?>
                        <div id="commodity<?= $k ?>"
                             class="commodityBox<?php if ($k == 1 || $k < ($totalDenpyoCom + 1)) echo ' on' ?>">
                            <?php if ($k > 1) { ?>
                                <?php if ($isTaisa == false || $d03DenNo == 0) { ?>
                                    <a
                                        class="removeCommodity" href="#">削除</a>
                                <?php }
                            } ?>
                            <input name="D05_NST_CD<?= $k ?>" id="nstcd<?= $k ?>" type="hidden"
                                   value="<?= $com['D05_NST_CD'] ?>"/>
                            <input name="D05_COM_CD<?= $k ?>" id="comcd<?= $k ?>" type="hidden"
                                   value="<?= $com['D05_COM_CD'] ?>"/>
                            <input name="D05_COM_SEQ<?= $k ?>" id="comseq<?= $k ?>" type="hidden" value="<?= $k ?>">
                            <input name="LIST_NAME[<?= $k ?>]" id="list<?= $k ?>" type="hidden" value=""/>
                            <div class="formGroup">
                                <div class="formItem">
                                    <label class="titleLabel">商品・荷姿コード</label>
                                    <input <?= $disabled?> rel="<?= $k ?>" type="text" name="code_search<?= $k ?>"
                                           id="code_search<?= $k ?>"
                                           maxlength="9" value="<?= $com['D05_COM_CD'] . $com['D05_NST_CD'] ?>"
                                           class="textForm codeSearchProduct">
                                    <a onclick="<?php echo ($disabled == '') ? 'codeSearch('.$k.');' : ''?>" class="btnFormTool openSearchCodeProduct"
                                       style="cursor: pointer" rel="<?= $k ?>">コード一覧から選択</a></div>
                                <div class="formItem">
                                    <label class="titleLabel">品名</label>
                                    <p class="txtValue"
                                       id="txtValueName<?= $k ?>"><?php if (isset($listTm05Edit[$com['D05_COM_CD']])) echo $listTm05Edit[$com['D05_COM_CD']]['M05_COM_NAMEN'] ?></p>
                                </div>
                                <div class="formItem">
                                    <label class="titleLabel">参考価格</label>
                                    <p class="txtValue"
                                       id="txtValuePrice<?= $k ?>"><?php if (isset($listTm05Edit[$com['D05_COM_CD']])) echo $listTm05Edit[$com['D05_COM_CD']]['M05_LIST_PRICE'] ?></p>
                                </div>
                            </div>
                            <div class="formGroup">
                                <div class="formItem">
                                    <label class="titleLabel">数量</label>
                                    <input maxlength="5" type="text" value="<?= $com['D05_SURYO'] ?>"
                                           name="D05_SURYO<?= $k ?>" rel="<?= $k ?>" id="no_<?= $k ?>"
                                           class="textForm noProduct">
                                </div>
                                <div class="formItem">
                                    <label class="titleLabel">単価</label>
                                    <input maxlength="10" type="text" name="D05_TANKA<?= $k ?>" rel="<?= $k ?>"
                                           id="price_<?= $k ?>" value="<?= $com['D05_TANKA'] ?>"
                                           class="textForm priceProduct">
                                    <span class="txtUnit">円</span></div>
                                <div class="formItem">
                                    <label class="titleLabel">金額</label>

                                    <input maxlength="10" type="text" name="D05_KINGAKU<?= $k ?>" rel="<?= $k ?>" id="total_<?= $k ?>"
                                           value="<?= $com['D05_KINGAKU'] ?>" class="textForm totalPriceProduct">
                                    <span class="txtUnit">円</span></div>
                            </div>
                        </div>
                        <input type="hidden" name="indexSearch" rel="<?= $k ?>" id="indexSearch<?= $k ?>"
                               value="<?= $k ?>">
                        <?php ++$k;
                    } ?>

                    <div class="formGroup lineTop">
                        <div class="flexRight">
                            <label class="titleLabelTotal">合計金額</label>
                            <p class="txtValue" style="position: relative"><strong class="totalPrice"
                                                        id="totalPrice"><?= $denpyo['D03_SUM_KINGAKU'] ?></strong><span
                                    class="txtUnit">円</span>
                                <input maxlength="10" type="hidden" id="D03_SUM_KINGAKU" name="D03_SUM_KINGAKU"/>
                            </p>
                        </div>
                    </div>
                </fieldset>
            </section>
            <!-- BEGIN BAOHANH -->
            <?php
            $ck = '';
            $class = "";
            $style1 = "";
            $view_pdf = true;
            if (file_exists('data/pdf/' . $d03DenNo . '.pdf')) {
                $style = 'style="display:block"';
                $ck = 'checked="checked"';
                $class = "checked";
                $style1 = 'style="pointer-events: none;"';
                $view_pdf = false;
            } else {
                if ($d03DenNo && $showWarranty) {
                    $style = 'style="display:block"';
                } else {
                    $style = "";
                }
            }
            ?>

            <!-- END BAOHANH -->

            <section class="bgContent">
                <fieldset class="fieldsetRegist">
                    <legend class="titleLegend">その他</legend>
                    <div class="formGroup">
                        <div class="formItem">
                            <label class="titleLabel">POS伝票番号</label>
                            <textarea class="textarea" name="D03_POS_DEN_NO"><?= $denpyo['D03_POS_DEN_NO'] ?></textarea>
                        </div>
                        <div class="formItem">
                            <label class="titleLabel">備考</label>
                            <textarea class="textarea" name="D03_NOTE"><?= nl2br($denpyo['D03_NOTE']) ?></textarea>
                        </div>
                    </div>
                </fieldset>
            </section>
            <section id="warrantyBox" class="bgContent" <?php echo $style; ?>>
                <fieldset class="fieldsetRegist">
                    <legend class="titleLegend">保証書情報</legend>
                    <?php if ($view_pdf) { ?>
                        <a class="onPreview" target="_blank" style="cursor: pointer;">プレビュー</a>
                    <?php } ?>
                    <div class="formGroup">
                        <div class="formItem">
                            <label class="titleLabel">保証書作成</label>
                            <div class="checkGroup">
                                <div class="checkItem">
                                    <input type="checkbox" name="warranty_check" <?= $ck ?> value="1" id="checkWarranty"
                                           style="display: none;">
                                    <label class="labelSingleCheck <?= $class ?>" <?= $style1 ?> id="checkWarranty"
                                           for="checkWarranty">保証書を作成する</label>
                                </div>
                            </div>
                        </div>
                        <div class="formItem">
                            <label class="titleLabel">保証書番号</label>

                            <p class="txtValue toggleWarranty"
                               id="warrantyNo" <?= $style ?>><?php echo $csv['M09_WARRANTY_NO'] ?></p>
                        </div>
                        <div class="formItem">
                            <label class="titleLabel">購入日</label>
                            <p class="txtValue toggleWarranty" <?= $style ?>><?php if ($csv['M09_INP_DATE']) echo Yii::$app->formatter->asDate(date('d-M-Y', strtotime($csv['M09_INP_DATE'])), 'yyyy年MM月dd日');
                                else echo date('Y年m月d日') ?></p>
                        </div>
                        <div class="formItem">
                            <label class="titleLabel">保証期間</label>
                            <p class="txtValue toggleWarranty" id="toggleWarranty" <?= $style ?>>
                                <?php if ($csv['warranty_period']) echo Yii::$app->formatter->asDate(date('d-M-Y', strtotime($csv['warranty_period'])), 'yyyy年MM月dd日');
                                else echo date('Y年m月d日', mktime(0, 0, 0, date('m', time()) + 6, date('d', time()), date('Y', time()))); ?>
                                <input type="hidden" value="0" name="checkClickWarranty" id="checkClickWarranty"/>

                                <input type="hidden" name="M09_WARRANTY_NO" id="M09_WARRANTY_NO"
                                       value="<?php echo $csv['M09_WARRANTY_NO'] ?>"/>
                                <input type="hidden" name="M09_INP_DATE" id="M09_INP_DATE"
                                       value="<?php if ($csv['M09_INP_DATE']) echo $csv['M09_INP_DATE'];
                                       else echo date('y-M-d') ?>"/>
                                <input type="hidden" name="warranty_period" id="warranty_period"
                                       value="<?php if ($csv['warranty_period']) echo $csv['warranty_period'];
                                       else echo date('y-M-d', mktime(0, 0, 0, date('m', time()) + 6, date('d', time()), date('Y', time()))); ?>"/>
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
                            <label class="titleLabel">商品名<span class="txtExample">例)エコピアPRV</span></label>
                        </div>
                        <div class="formItem">
                            <label class="titleLabel">サイズ<span class="txtExample">例)1956515</span></label>
                        </div>
                        <div class="formItem">
                            <label class="titleLabel">セリアル番号</label>
                        </div>
                        <div class="formItem">
                            <label class="titleLabel">数量</label>
                        </div>
                    </div>
                    <?php $warranty_item = ['' => '', 'BS' => 'BS', 'YH' => 'YH', 'DF' => 'DF', 'TY' => 'TY'] ?>
                    <?php for ($i = 1; $i < 5; ++$i) { ?>
                        <div class="formGroup lineBottom">
                            <div class="formItem">
                                <p class="txtValue">
                                    <?php
                                    if ($i == 1) {
                                        echo '右前';
                                        $name = 'right_front';
                                    } elseif ($i == 2) {
                                        echo '左前';
                                        $name = 'left_front';
                                    } elseif ($i == 3) {
                                        $name = 'right_behind';
                                        echo '右後';
                                    } else {
                                        $name = 'left_behind';
                                        echo '左後';
                                    }
                                    ?>

                                </p>
                            </div>
                            <div class="formItem">
                                <?= \yii\helpers\Html::dropDownList($name . '_manu', $csv[$name . '_manu'], $warranty_item, array('class' => 'selectForm', 'id' => $name . '_manu')) ?>
                            </div>
                            <div class="formItem">
                                <input type="text" value="<?= $csv[$name . '_product'] ?>" class="textForm"
                                       id="<?= $name . '_product' ?>" name="<?= $name . '_product' ?>">
                            </div>
                            <div class="formItem">
                                <input type="text" value="<?= $csv[$name . '_size'] ?>" class="textForm"
                                       id="<?= $name . '_size' ?>" name="<?= $name . '_size' ?>">
                            </div>
                            <div class="formItem">
                                <input type="text" value="<?= $csv[$name . '_serial'] ?>" class="textForm"
                                       id="<?= $name . '_serial' ?>" name="<?= $name . '_serial' ?>">
                            </div>
                            <div class="formItem">
                                <p class="txtValue">1</p>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="formGroup lineBottom">
                        <div class="formItem">
                            <p class="txtValue">その他A</p>
                        </div>
                        <div class="formItem">
                            <select class="selectForm" name="other_a_manu" id="other_a_manu">
                                <option selected="" value=""></option>
                                <option value="BS">BS</option>
                                <option value="YH">YH</option>
                                <option value="DF">DF</option>
                                <option value="TY">TY</option>
                            </select>
                        </div>
                        <div class="formItem">
                            <input type="text" value="" class="textForm" name="other_a_product" id="other_a_product">
                        </div>
                        <div class="formItem">
                            <input type="text" value="" class="textForm" name="other_a_size" id="other_a_size">
                        </div>
                        <div class="formItem">
                            <input type="text" value="" class="textForm" name="other_a_serial" id="other_a_serial">
                        </div>
                        <div class="formItem">
                            <p class="txtValue"><!-- 1 --></p>
                        </div>
                    </div>
                    <div class="formGroup">
                        <div class="formItem">
                            <p class="txtValue">その他B</p>
                        </div>
                        <div class="formItem">
                            <select class="selectForm" name="other_b_manu" id="other_b_manu">
                                <option selected="" value=""></option>
                                <option value="BS">BS</option>
                                <option value="YH">YH</option>
                                <option value="DF">DF</option>
                                <option value="TY">TY</option>
                            </select>
                        </div>
                        <div class="formItem">
                            <input type="text" value="" class="textForm" name="other_b_product" id="other_b_product">
                        </div>
                        <div class="formItem">
                            <input type="text" value="" class="textForm" name="other_b_size" id="other_b_size">
                        </div>
                        <div class="formItem">
                            <input type="text" value="" class="textForm" name="other_b_serial" id="other_b_serial">
                        </div>
                        <div class="formItem">
                            <p class="txtValue"><!-- 1 --></p>
                        </div>
                    </div>
                </fieldset>
            </section>
        </article>
    </main>
    <footer id="footer">
        <div class="toolbar">
            <a class="btnBack"
               href="<?php echo isset($d03DenNo) ? yii\helpers\BaseUrl::base(true) . '/detail-workslip?den_no=' . $d03DenNo : yii\helpers\BaseUrl::base(true); ?>">戻る</a>
            <?php if ($d03DenNo == 0) { ?>
                <div class="btnSet" style="width:150px;">
                    <a class="btnTool" href="javascript:void(0)" id="preview">作業指示書</a>
                </div>
            <?php } ?>

            <a class="btnSubmit" id="btnRegistWorkSlip">登録</a>
        </div>
        <p class="copyright">Copyright(C) Usami Koyu Corp. All Rights Reserved.</p>
    </footer>
</form>
<div class="sidr left" id="sidr">
    <div class="closeSideMenu"><a id="sidrClose" href="#">Close</a></div>
    <ul>
        <li><a href="menu">SSサポートサイトTOP</a></li>
    </ul>
</div>
<div class="sidr left" id="sidr">
    <div class="closeSideMenu"><a id="sidrClose" href="#">Close</a></div>
    <ul>
        <li><a href="menu">SSサポートサイトTOP</a></li>
    </ul>
</div>
<!-- BEGIN InfoCus -->
<div id="modalEditCustomer" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span
                        aria-hidden="true">×</span></button>
                <h4 class="modal-title">お客様情報登録</h4>
            </div>
            <form id="modal_customer">
                <div class="modal-body">
                    <div id="updateInfo"></div>
                    <p class="note">項目を入力してください。<span class="must">*</span>は必須入力項目です。</p>
                    <section class="bgContent">
                        <input type="hidden" value="<?= $cus['D01_KAIIN_CD'] ?>" id="D01_KAIIN_CD" name="D01_KAIIN_CD"/>
                        <input type="hidden" value="<?= $cus['D01_SS_CD'] ?>" name="D01_SS_CD"/>
                        <input type="hidden" value="<?= $cus['D01_CUST_NO'] ?>" name="D01_CUST_NO"/>
                        <fieldset class="fieldsetRegist">
                            <legend class="titleLegend">お客様情報</legend>
                            <div class="formGroup">
                                <div class="formItem">
                                    <label class="titleLabel">お名前<span class="must">*</span></label>
                                    <input type="text" value="<?= $cus['D01_CUST_NAMEN'] ?>" class="textForm"
                                           name="D01_CUST_NAMEN">
                                </div>
                                <div class="formItem">
                                    <label class="titleLabel">フリガナ<span class="must">*</span></label>
                                    <input type="text" value="<?= $cus['D01_CUST_NAMEK'] ?>" name="D01_CUST_NAMEK"
                                           class="textForm">
                                </div>
                                <div class="formItem">
                                    <label class="titleLabel">掛カード</label>
                                    <input maxlength="16" type="text" value="<?= trim($cus['D01_KAKE_CARD_NO']) ?>"
                                           name="D01_KAKE_CARD_NO"
                                           id="D01_KAKE_CARD_NO" class="textForm">
                                </div>
                            </div>
                            <div class="formGroup">
                                <div class="formItem">
                                    <label class="titleLabel">郵便番号</label>
                                    <input maxlength="7" type="text" value="" name="D01_YUBIN_BANGO"
                                           class="textForm" id="D01_YUBIN_BANGO">
                                    <a id="btn_get_address" class="btnFormTool" href="javascript:void(0)">住所検索</a></div>
                                <div class="formItem">
                                    <label class="titleLabel">ご住所</label>
                                    <input type="text" value="<?= $cus['D01_ADDR'] ?>" name="D01_ADDR" id="D01_ADDR"
                                           class="textForm">
                                </div>
                            </div>
                            <div class="formGroup">
                                <div class="formItem">
                                    <label class="titleLabel">電話番号</label>
                                    <input type="text" value="<?= $cus['D01_TEL_NO'] ?>" name="D01_TEL_NO"
                                           id="D01_TEL_NO"
                                           class="textForm">
                                </div>
                                <div class="formItem">
                                    <label class="titleLabel">携帯電話番号</label>
                                    <input type="text" value="<?= $cus['D01_MOBTEL_NO'] ?>" id="D01_MOBTEL_NO"
                                           name="D01_MOBTEL_NO" class="textForm">
                                </div>
                            </div>
                            <div class="formGroup">
                                <div class="formItem">
                                    <label class="titleLabel">備考</label>
									<textarea maxlength="1000" class="textarea" name="D01_NOTE"
                                              id="D01_NOTE"><?= $cus['D01_NOTE'] ?></textarea>
                                </div>
                            </div>
                            <div class="formGroup">
                                <div class="formItem">
                                    <label class="titleLabel">約款・個人情報は、以下のリンクよりご確認ください。</label>
                                    <div class="checkGroup">
                                        <div class="checkItem">
                                            <input type="checkbox" onchange="//agreeForm();" name="agreeCheck"
                                                   id="agreeCheck"
                                                   value="1" class="checks">
                                            <label id="agreeLabel" class="labelSingleCheck" for="agreeCheck">
                                                <a target="_blank"
                                                   href="https://verify-ups.com/sss/pdf/PrivacyPolicy.pdf">プライバシーポリシー</a>に同意する
                                            </label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </fieldset>
                    </section>
                </div>
                <div class="modal-footer">
                    <input type="button" disabled="" value="登録する" id="agreeFormBtn" class="btnSubmit disabled">
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END InfoCus -->
<!-- BEGIN InfoCar -->
<div id="modalEditCar" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span
                        aria-hidden="true">×</span></button>
                <h4 class="modal-title">車両情報登録</h4>
            </div>
            <form id="modal_car" action="">
                <div class="modal-body">
                    <div id="updateCarInfo"></div>
                    <p class="note">項目を入力してください。<span class="must">*</span>は必須入力項目です。</p>
                    <?php

                    use backend\components\Api; ?>
                    <?php
                    $k = 1;
                    $carOrigin = $car;
                    foreach ($carOrigin as $carFirst) {
                        if ((int)$carFirst['D02_CAR_SEQ'] == 0) {
                            $class = 'accordion accClose';
                            $label_delete = '追加';
                        } else {
                            $label_delete = '削除';
                            $class = 'accordion accOpen';
                        }
                        ?>
                        <section class="bgContent dataCar<?= $k ?> <?= $class ?>" id="dataCar<?= $k ?>" rel="<?= $k ?>">
                            <input type="hidden" value="<?php echo $denpyo['D03_CAR_SEQ'] ?>" name="D03_CAR_SEQ"
                                   id="D03_CAR_SEQ"/>
                            <input type="hidden" value="<?= date('y-M-d') ?>" name="D02_UPD_DATE" id="D02_UPD_DATE"/>
                            <input type="hidden" value="1" name="D02_UPD_USER_ID" id="D02_UPD_USER_ID"/>
                            <input type="hidden"
                                   value="<?php echo $carFirst['D02_CUST_NO'] ? $carFirst['D02_CUST_NO'] : $cus['D01_CUST_NO'] ?>"
                                   name="D02_CUST_NO" id="D02_CUST_NO"/>
                            <input type="hidden" value="<?= (int)$carFirst['D02_CAR_SEQ'] ?>" name="D02_CAR_SEQ"
                                   id="D02_CAR_SEQ"/>
                            <input type="hidden" value="<?= $carFirst['D02_INP_DATE'] ?>" name="D02_INP_DATE"
                                   id="D02_INP_DATE"/>
                            <input type="hidden" value="<?= $carFirst['D02_INP_USER_ID'] ?>" name="D02_INP_USER_ID"
                                   id="D02_INP_USER_ID"/>
                            <input type="hidden" value="<?= $carFirst['D02_CAR_NAMEN'] ?>" name="D02_CAR_NAMEN"
                                   id="D02_CAR_NAMEN"/>
                            <?php
                            if (isset($carFirst['ApiCar'])) {
                                $apiFieldCarApi = [];
                                foreach ($carFirst['ApiCar'] as $key => $val) {
                                    $apiFieldCarApi[$key] = $val;
                                }
                                echo '<input type="hidden" value="' . base64_encode(json_encode($apiFieldCarApi)) . '"  name="CAR_API_FIELD" id="CAR_API_FIELD" />';
                                echo '<input type="hidden" value="1"  name="is_car_api" id="is_car_api" />';
                            } else {
                                echo '<input type="hidden" value=""  name="CAR_API_FIELD" id="CAR_API_FIELD" />';
                                echo '<input type="hidden" value="0"  name="is_car_api" id="is_car_api" />';
                            }
                            ?>
                            <fieldset class="fieldsetRegist">
                                <div class="accordionHead">
                                    <legend class="titleLegend"><?= $k ?>台目</legend>
                                    <?php if (!in_array($carFirst['D02_CAR_SEQ'], $carSeqUse)) { ?>
                                        <a class="toggleAccordion" id="delete<?= $k ?>"
                                           style="cursor: pointer;"><?= $label_delete ?></a>
                                    <?php } ?>
                                </div>
                                <div class="accordionBody">
                                    <div class="formGroup">
                                        <div class="formItem">
                                            <label class="titleLabel">メーカー<span class="must">*</span></label>
                                            <?php
                                            $api = new Api();
                                            $maker = $api->getListMaker();
                                            $list_maker = ['0' => 'クライスラー・ジープ'];
                                            $list_grade = ['' => ''];
                                            $list_type = ['' => ''];
                                            $maker_code = 0;
                                            foreach ($maker as $mak) {
                                                $list_maker[$mak['maker_code']] = $mak['maker'];
                                            }

                                            $list_model = ['0' => 'ジープ・ラングラーアンリミテッド'];
                                            if ((int)$carFirst['D02_MAKER_CD']) {

                                                $model = $api->getListModel($carFirst['D02_MAKER_CD']);
                                                foreach ($model as $mod) {
                                                    $list_model[$mod['model_code']] = $mod['model'];
                                                }
                                            }
                                            if ($carFirst['D02_MODEL_CD']) {
                                                $list_year = ['0' => ''];
                                                $year = $api->getListYearMonth($carFirst['D02_MAKER_CD'], $carFirst['D02_MODEL_CD']);
                                                foreach ($year as $y) {
                                                    $list_year[$y['year']] = $y['year'];
                                                }

                                                if ($carFirst['D02_SHONENDO_YM']) {
                                                    $type = $api->getListTypeCode($carFirst['D02_MAKER_CD'], $carFirst['D02_MODEL_CD'], substr($carFirst['D02_SHONENDO_YM'], 0, 4));
                                                    foreach ($type as $tp) {
                                                        $list_type[$tp['type_code']] = $tp['type'];
                                                    }
                                                }

                                                if ($carFirst['D02_TYPE_CD']) {
                                                    $grade = $api->getListGradeCode($carFirst['D02_MAKER_CD'], $carFirst['D02_MODEL_CD'], substr($carFirst['D02_SHONENDO_YM'], 0, 4), $carFirst['D02_TYPE_CD']);
                                                    foreach ($grade as $gra) {
                                                        $list_grade[$gra['grade_code']] = $gra['grade'];
                                                    }
                                                }
                                            }
                                            ?>
                                            <?= \yii\helpers\Html::dropDownList('D02_MAKER_CD', $carFirst['D02_MAKER_CD'], $list_maker, array('class' => 'selectForm D02_MAKER_CD', 'id' => 'D02_MAKER_CD', 'rel' => $k)) ?>
                                            <span class="txtExample">例)トヨタ</span>
                                        </div>
                                        <div class="formItem">
                                            <label class="titleLabel">車名<span class="must">*</span></label>
                                            <?= \yii\helpers\Html::dropDownList('D02_MODEL_CD', $carFirst['D02_MODEL_CD'], $list_model, array('class' => 'selectForm D02_MODEL_CD', 'id' => 'D02_MODEL_CD', 'rel' => $k)) ?>
                                            <span class="txtExample">例)プリウス</span>
                                        </div>
                                    </div>
                                    <div class="formGroup">
                                        <div class="formItem">
                                            <label class="titleLabel">初年度登録年月</label>
                                            <input maxlength="6" type="text" id="D02_SHONENDO_YM"
                                                   name="D02_SHONENDO_YM[<?= $k ?>]"
                                                   value="<?= $carFirst['D02_SHONENDO_YM'] ?>"
                                                   class="textForm D02_SHONENDO_YM">
                                            <span class="txtExample">例)2013年1月→201301</span></div>
                                        <div class="formItem">
                                            <label class="titleLabel">型式</label>
                                            <?= \yii\helpers\Html::dropDownList('D02_TYPE_CD[' . $k . ']', $carFirst['D02_TYPE_CD'], $list_type, array('class' => 'selectForm D02_TYPE_CD', 'id' => 'D02_TYPE_CD', 'rel' => $k)) ?>
                                        </div>
                                        <div class="formItem">
                                            <label class="titleLabel">グレード</label>
                                            <?= \yii\helpers\Html::dropDownList('D02_GRADE_CD[' . $k . ']', $carFirst['D02_GRADE_CD'], $list_grade, array('class' => 'selectForm D02_GRADE_CD', 'id' => 'D02_GRADE_CD', 'rel' => $k)) ?>
                                        </div>
                                    </div>
                                    <div class="formGroup">
                                        <div class="formItem">
                                            <label class="titleLabel">車検満了日</label>
                                            <input maxlength="8" type="text"
                                                   value="<?= $carFirst['D02_JIKAI_SHAKEN_YM'] ?>"
                                                   name="D02_JIKAI_SHAKEN_YM[<?= $k ?>]" id="D02_JIKAI_SHAKEN_YM"
                                                   class="textForm D02_JIKAI_SHAKEN_YM">
                                            <span class="txtExample">例)2013年1月31日→20130131</span></div>
                                        <div class="formItem">
                                            <label class="titleLabel">走行距離<span class="must">*</span></label>
                                            <input maxlength="6" type="text" value="<?= $carFirst['D02_METER_KM'] ?>"
                                                   name="D02_METER_KM[<?= $k ?>]" id="D02_METER_KM"
                                                   class="textForm formWidthXS D02_METER_KM">
                                            <span class="txtUnit">km</span></div>
                                        <div class="formItem">
                                            <label class="titleLabel">車検サイクル<span class="must">*</span></label>
                                            <?= \yii\helpers\Html::dropDownList('D02_SYAKEN_CYCLE[' . $k . ']', $carFirst['D02_SYAKEN_CYCLE'], Yii::$app->params['d02SyakenCycle'], array('class' => 'selectForm D02_SYAKEN_CYCLE', 'id' => 'D02_SYAKEN_CYCLE')) ?>
                                            <span class="txtUnit">年</span></div>
                                    </div>
                                    <div class="formGroup">
                                        <div class="formItem">
                                            <label class="titleLabel">運輸支局<span class="must">*</span></label>
                                            <input maxlength="10" type="text"
                                                   value="<?= $carFirst['D02_RIKUUN_NAMEN'] ?>"
                                                   id="D02_RIKUUN_NAMEN" name="D02_RIKUUN_NAMEN[<?= $k ?>]"
                                                   class="textForm D02_RIKUUN_NAMEN">
                                            <span class="txtExample">例)名古屋</span></div>
                                        <div class="formItem">
                                            <label class="titleLabel">分類コード<span class="must">*</span></label>
                                            <input maxlength="3" type="text" value="<?= $carFirst['D02_CAR_ID'] ?>"
                                                   name="D02_CAR_ID[<?= $k ?>]"
                                                   id="D02_CAR_ID" class="textForm formWidthXS D02_CAR_ID">
                                            <span class="txtExample">例)330</span></div>
                                        <div class="formItem">
                                            <label class="titleLabel">ひらがな<span class="must">*</span></label>
                                            <input maxlength="1" type="text" value="<?= @$carFirst['D02_HIRA'] ?>"
                                                   name="D02_HIRA[<?= $k ?>]"
                                                   id="D02_HIRA" class="textForm formWidthXXS D02_HIRA">
                                            <span class="txtExample">例)あ</span></div>
                                        <div class="formItem">
                                            <label class="titleLabel">登録番号<span class="must">*</span></label>
                                            <input maxlength="4" type="text" value="<?= $carFirst['D02_CAR_NO'] ?>"
                                                   name="D02_CAR_NO[<?= $k ?>]"
                                                   id="D02_CAR_NO" class="textForm formWidthXS D02_CAR_NO">
                                            <span class="txtExample">例)0301</span></div>
                                    </div>
                                </div>
                            </fieldset>
                        </section>
                        <?php ++$k;
                    }
                    ?>
                </div>
                <div class="modal-footer"><a class="btnSubmit" style="cursor: pointer;" id="updateCar">登録する</a>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END InfoCar -->
<!-- BEGIN CodeSearchProduct -->
<div id="modalCodeSearch" class="modal fade ">
    <div class="modal-dialog widthS">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span
                        aria-hidden="true">×</span></button>
                <h4 class="modal-title">商品・荷姿コード</h4>
            </div>
            <div class="modal-body">
                <p class="note mb10">検索対象の選択とキーワードを入力して、「検索する」ボタンを押してください。<br>
                    一覧の中から使用する商品を選んで、「選択する」ボタンを押してください。</p>
                <form class="formSearchList" action="">
                    <section class="bgContent">
                        <div class="formGroup">
                            <div class="formItem flexHorizontal">
                                <label class="titleLabel">検索対象：</label>
                                <div class="radioGroup itemFlex">
                                    <div class="radioItem">
                                        <input type="radio" name="search_M05_COM_CD" checked="checked" id="M05_COM_CD"
                                               class="radios">
                                        <label class="labelRadios checked" for="valuables1">商品コード</label>
                                    </div>
                                    <div class="radioItem">
                                        <input type="radio" name="search_M05_NST_CD" id="M05_NST_CD" class="radios">
                                        <label class="labelRadios" for="valuables2">荷姿コード</label>
                                    </div>
                                    <div class="radioItem">
                                        <input type="radio" name="search_M05_COM_NAMEN" id="M05_COM_NAMEN"
                                               class="radios">
                                        <label class="labelRadios" for="valuables2">品名</label>
                                    </div>
                                </div>
                                <div class="itemFlex">
                                    <input id="code_search_value" type="text" style="width:15em;" value=""
                                           class="textForm">
                                    <a id="code_search_btn" class="btnFormTool" href="#">検索する</a></div>
                            </div>
                        </div>
                    </section>
                </form>
                <?php

                use yii\data\Pagination; ?>
                <nav class="paging">
                    <?php echo yii\widgets\LinkPager::widget(['pagination' => $pagination]) ?>
                </nav>
                <input type="hidden" value="" id="searchProduct"/>
                <table class="tableList">
                    <tbody>
                    <tr>
                        <th></th>
                        <th>商品コード</th>
                        <th>荷姿コード</th>
                        <th>品名</th>
                    </tr>

                    <?php foreach ($tm05Com as $product) { ?>
                        <tr>
                            <td><input type="radio" name="M05_COM_CD.M05_NST_CD"
                                       onclick="setValue('<?= $product['M05_COM_CD'] . $product['M05_NST_CD'] ?>',<?= (int)$product['M05_COM_CD'] ?>)"
                                       value="<?= $product['M05_COM_CD'] . $product['M05_NST_CD'] ?>"></td>
                            <td><?= $product['M05_COM_CD'] ?></td>
                            <td><?= $product['M05_NST_CD'] ?></td>
                            <td><?= $product['M05_COM_NAMEN'] ?></td>
                            <input type="hidden" value="<?= $product['M05_COM_NAMEN'] ?>"
                                   id="name<?= $product['M05_COM_CD'] . $product['M05_NST_CD'] ?>"/>
                            <input type="hidden" value="<?= $product['M05_LIST_PRICE'] ?>"
                                   id="price<?= $product['M05_COM_CD'] . $product['M05_NST_CD'] ?>"/>
                            <input type="hidden" value="<?= $product['M05_KIND_COM_NO'] ?>"
                                   id="kind<?= $product['M05_COM_CD'] . $product['M05_NST_CD'] ?>"/>
                            <input type="hidden" value="<?= $product['M05_LARGE_COM_NO'] ?>"
                                   id="large<?= $product['M05_COM_CD'] . $product['M05_NST_CD'] ?>"/>
                            <input type="hidden" value="<?= $product['M05_COM_CD'] ?>"
                                   id="comcd<?= $product['M05_COM_CD'] . $product['M05_NST_CD'] ?>"/>
                            <input type="hidden" value="<?= $product['M05_NST_CD'] ?>"
                                   id="nstcd<?= $product['M05_COM_CD'] . $product['M05_NST_CD'] ?>"/>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <nav class="paging">
                    <ul class="ulPaging">
                        <?php echo yii\widgets\LinkPager::widget(['pagination' => $pagination]) ?>
                    </ul>
                </nav>
            </div>
            <div class="modal-footer"><a href="#bgContentProduct" class="btnSubmit" style="cursor: pointer"
                                         onclick="closePop()">選択する</a></div>
        </div>
    </div>
</div>
<div id="modalRegistConfirm" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span
                        aria-hidden="true">×</span></button>
                <h4 class="modal-title">作業伝票作成</h4>
            </div>
            <div class="modal-body">
                <p class="note">入力した内容で作業伝票を作成します。よろしいですか？</p>
            </div>
            <div class="modal-footer"><a aria-label="Close" data-dismiss="modal" class="btnCancel flLeft"
                                         href="#">いいえ</a> <a class="btnSubmit flRight btnSubmitDenpyo"
                                                             style="cursor: pointer">はい</a></div>
        </div>
    </div>
</div>
<!-- END CodeSearchProduct -->
<script type="text/javascript">
    $(".btnSubmitDenpyo").click(function () {

        $("#login_form").submit();
    });
    $(".onPreview").click(function () {
        $.post('<?php yii\helpers\BaseUrl::base(true) ?>registworkslip/default/pdfview',
            {
                'D03_SS_CD': $("#D01_SS_CD").val(),
                'right_front_manu': $("#right_front_manu").val(),
                'right_front_product': $("#right_front_product").val(),
                'right_front_size': $("#right_front_size").val(),
                'right_front_serial': $("#right_front_serial").val(),
                'left_front_manu': $("#left_front_manu").val(),
                'left_front_product': $("#left_front_product").val(),
                'left_front_size': $("#left_front_size").val(),
                'left_front_serial': $("#left_front_serial").val(),
                'right_behind_manu': $("#right_behind_manu").val(),
                'right_behind_product': $("#right_behind_product").val(),
                'right_behind_size': $("#right_behind_size").val(),
                'right_behind_serial': $("#right_behind_serial").val(),
                'left_behind_manu': $("#left_behind_manu").val(),
                'left_behind_product': $("#left_behind_product").val(),
                'left_behind_size': $("#left_behind_size").val(),
                'left_behind_serial': $("#left_behind_serial").val(),
                'other_a_manu': $("#other_a_manu").val(),
                'other_a_product': $("#other_a_product").val(),
                'other_a_size': $("#other_a_size").val(),
                'other_a_serial': $("#other_a_serial").val(),
                'other_b_manu': $("#other_b_manu").val(),
                'other_b_product': $("#other_b_product").val(),
                'other_b_size': $("#other_b_size").val(),
                'other_b_serial': $("#other_b_serial").val(),
                'M09_WARRANTY_NO': $("#M09_WARRANTY_NO").val(),
                'WARRANTY_CUST_NAMEN': $("#D01_CUST_NAMEN").val(),
                'D03_CAR_NO': $("input[name =D02_CAR_NO_" + $("#D02_CAR_SEQ").val() + ']').val(),
                'D03_CAR_NAMEN': $("input[name =D02_CAR_NAMEN_" + $("#D02_CAR_SEQ").val() + ']').val()

            },
            function (data) {
                window.open("<?php echo yii\helpers\BaseUrl::base(true) ?>/data/pdf/review.pdf", '_blank');
            }
        );
    });
    $(".labelRadios").click(function () {
        var id = $(this).attr('for');
        $("#" + id).attr('checked', 'checked');
    });
    $(".labelChecks").click(function () {
        var id = $(this).attr('for');
        $("#" + id).attr('checked', 'checked');
    });
    $(function () {
        var carSeq = $("#D02_CAR_SEQ").val();
        $(".carDataBasic").removeClass('show').addClass('hide');
        $(".carDataBasic" + carSeq).removeClass('hide').addClass('show');
    });
    function showSeqCar() {
        var carSeq = $("#D02_CAR_SEQ").val();
        if (carSeq != null) {
            $("#delete" + carSeq).removeClass('toggleAccordion').addClass('hide');
        }
    }
    $("#D02_CAR_SEQ").on('change', function () {
        var carSeq = $("#D02_CAR_SEQ").val();
        if (carSeq > 0) {
            $(".carDataBasic").removeClass('show').addClass('hide');
            $(".carDataBasic" + carSeq).removeClass('hidd').addClass('show');
        }
    })
</script>
<script>
    $(".D02_MAKER_CD").change(function () {
        var cur = $(this);
        if ($(this).val() == '0') {
            $("#car_model_code").html('<option value=""></option>');
            $("#car_type_code").html('<option value=""></option>');
            $("#car_grade_code").html('<option value=""></option>');
            return;
        }
        $.post('<?php yii\helpers\BaseUrl::base(true) ?>registworkslip/default/maker',
            {
                'car_maker_code': $(this).val(),
                'level': '1'
            },
            function (data) {
                var option = '';
                $.each(data, function (key, value) {
                    option += '<option value="' + key + '">' + value + '</option>';
                });
                $(cur).parents('section').find('.D02_MODEL_CD').html(option);
                $(cur).parents('section').find('.D02_TYPE_CD').html('<option value=""></option>');
                $(cur).parents('section').find('.D02_GRADE_CD').html('<option value=""></option>');
                //$(cur).parent('section').find('.D02_TYPE_CD').html('<option value=""></option>');
            }
        );
    });
    $(".D02_MODEL_CD").change(function () {

        var cur = $(this);
        if ($(this).val() == '0') {
            $(cur).parents('section').find('.D02_TYPE_CD').html('<option value=""></option>');
            $(cur).parents('section').find('.D02_GRADE_CD').html('<option value=""></option>');
            return;
        }

        $.post('<?php yii\helpers\BaseUrl::base(true) ?>registworkslip/default/maker',
            {
                'car_maker_code': $(cur).parents('section').find('.D02_MAKER_CD').val(),
                'car_model_code': $(this).val(),
                'car_year': $(cur).parents('section').find('.D02_SHONENDO_YM').val(),
                'level': '3'
            },
            function (data) {

                var option = '';
                $.each(data, function (key, value) {
                    option += '<option value="' + key + '">' + value + '</option>';
                });
                $(cur).parents('section').find('.D02_TYPE_CD').html(option);
                $(cur).parents('section').find('.D02_GRADE_CD').html('<option value=""></option>');
            }
        );
    });

    $(".D02_TYPE_CD").change(function () {
        var cur = $(this);
        if ($(this).val() == '') {
            $(cur).parents('section').find('.D02_GRADE_CD').html('<option value=""></option>');
            return;
        }
        $.post('<?php yii\helpers\BaseUrl::base(true) ?>registworkslip/default/maker',
            {
                'car_type_code': $(this).val(),
                'car_year': $(cur).parents('section').find('.D02_SHONENDO_YM').val(),
                'car_maker_code': $(cur).parents('section').find('.D02_MAKER_CD').val(),
                'car_model_code': $(cur).parents('section').find('.D02_MODEL_CD').val(),
                'level': '4'
            },
            function (data) {
                //alert(data);
                var option = '';
                $.each(data, function (key, value) {
                    option += '<option value="' + key + '">' + value + '</option>';
                });
                $(cur).parents('section').find('.D02_GRADE_CD').html(option);
            }
        );
    });
</script>
<script type="text/javascript">
    function closePop() {
        $("#modalCodeSearch").modal('hide');
    }
    $('.openSearchCodeProduct').click(function () {
        $("#searchProduct").val($(this).attr('rel'));
    });
    function setValue(m05ComCD, comCd) {
        var index = $("#searchProduct").val();
        $("#txtValueName" + index).html($("#name" + m05ComCD).val());
        if ($("#price" + m05ComCD).val() == null || $("#price" + m05ComCD).val() == 'null')
            $("#txtValuePrice" + index).html('');
        else
            $("#txtValuePrice" + index).html($("#price" + m05ComCD).val());

        $('#nstcd' + index).val($("#nstcd" + m05ComCD).val());
        $('#comcd' + index).val($("#comcd" + m05ComCD).val());
        $("#code_search" + index).val(m05ComCD);
        $("#code_search" + index).attr('title', m05ComCD);
        $("#list" + index).val(m05ComCD);
        comCd = parseInt(comCd);
        if (comCd > 41999 && comCd < 43000) {
            $("#warrantyBox").show();
        } else {
            var count = 0;
            $('.commodityBox.on').each(function () {
                var value = parseInt($(this).find('[name=D05_COM_CD1]').val());
                if (value > 41999 && value < 43000) {
                    count++;
                }
            });
            if (count == 0) {
                $("#warrantyBox").hide();
            }
        }
    }

    $(function () {
        $("#checkWarranty").click(function () {
            var check = $("#checkClickWarranty").val();
            $("#checkWarranty").attr('checked', 'checked');
            if (check == '1')
                return;
            $.post('<?php yii\helpers\BaseUrl::base(true) ?>registworkslip/default/warranty',
                {
                    'ss_cd': $("#D01_SS_CD").val()
                },
                function (data) {
                    $("#warrantyNo").html(data.numberWarrantyNo);
                    $("#checkClickWarranty").val('1');
                    $("#M09_WARRANTY_NO").val(data.numberWarrantyNo);

                }
            );

        });
        $(".codeSearchProduct").change(function () {
            var item = $(this);
            var index = $(this).attr('rel');
            var code = $("#code_search" + index).val();

            if (code.length < 9) {
                var count = 0;
                $('.codeSearchProduct').each(function () {
                    var value = $(this).val(),
                        title = $(this).attr('title');
                    if (value == title) {
                        count++;
                    }
                });
                if (count == 0) {
                    $("#warrantyBox").hide();
                }
                return;
            }
            $.post('<?php yii\helpers\BaseUrl::base(true) ?>registworkslip/default/search',
                {
                    'code': $("#code_search" + index).val()
                },
                function (data) {
                    $("#txtValueName" + index).html(data.M05_COM_NAMEN);
                    $("#txtValuePrice" + index).html(data.M05_LIST_PRICE);
                    $('#nstcd' + index).val(data.M05_NST_CD);
                    $('#comcd' + index).val(data.M05_COM_CD);
                    $(item).attr('title', (data.M05_COM_CD + data.M05_NST_CD));
                    if (data.M05_COM_CD > 41999 && data.M05_COM_CD < 43000) {
                        $("#warrantyBox").show();
                    }
                });
        });

        $("#D01_SS_CD").change(function () {
            var member_ssCode = $("#D01_SS_CD").val();
            if (member_ssCode.length != '6') {
                $("#D01_UKE_JYUG_CD").html('<option></option>');
                $("#D03_TANTO_MEI_D03_TANTO_SEI").html('<option></option>');
                $("#D03_KAKUNIN_MEI_D03_KAKUNIN_SEI").html('<option></option>');
                return;
            }
            $.post('<?php yii\helpers\BaseUrl::base(true) ?>registworkslip/default/ss',
                {
                    'ssCode': member_ssCode
                },
                function (data) {
                    var option0 = '';
                    var option1 = '';

                    $.each(data['0'], function (key, value) {
                        option0 += '<option value="' + key + '">' + value + '</option>';
                    });
                    $.each(data['1'], function (key, value) {
                        option1 += '<option value="' + key + '">' + value + '</option>';
                    });

                    $("#D01_UKE_JYUG_CD").html(option0);
                    $("#D03_TANTO_MEI_D03_TANTO_SEI").html(option1);
                    $("#D03_KAKUNIN_MEI_D03_KAKUNIN_SEI").html(option1);
                }
            );
        });

        $('.totalPriceProduct').on('change', function(){
            var total = 0,
                sub_price = Number.isInteger(parseInt($(this).val())) ? parseInt($(this).val()) : 0,
                totalHasVat;
            for (var i = 1; i < 11; ++i) {
                if ($('#commodity' + i).hasClass('on')) {
                    sub_price = Number.isInteger(parseInt($("#total_" + i).val())) ? parseInt($("#total_" + i).val()) : 0,
                    total = total + sub_price;
                }
            }
            totalHasVat = (total *<?php echo(100 + Yii::$app->params['vat']) ?>) / 100;
            totalHasVat = Math.round(totalHasVat);
            $("#D03_SUM_KINGAKU").val(totalHasVat);
            $("#totalPrice").html(totalHasVat);
        });

        $(".priceProduct,.noProduct").change(function () {
            var index = $(this).attr('rel');
            var total = 0;
            var totalPrice = 0;

            if ($("#no_" + index).val() != null && $("#price_" + index).val() != null && Number.isInteger(parseInt($("#no_" + index).val())) && Number.isInteger(parseInt($("#price_" + index).val()))) {
                total = parseInt($("#no_" + index).val()) * parseInt($("#price_" + index).val());
                if (Number.isInteger(total)) {
                    $("#total_" + index).val(total);
                }
                else
                    $("#total_" + index).val('0');
            }
            else {
                $("#total_" + index).val('0');
            }

            for (var i = 1; i < 11; ++i) {
                if ($('#commodity' + i).hasClass('on')) {
                    totalPrice = totalPrice + parseInt($("#total_" + i).val());
                }
            }

            if (Number.isInteger(totalPrice)) {
                var totalHasVat = (totalPrice *<?php echo(100 + Yii::$app->params['vat']) ?>) / 100;
                totalHasVat = Math.round(totalHasVat);
                $("#D03_SUM_KINGAKU").val(totalHasVat);
                $("#totalPrice").html(totalHasVat);
            }
            else
                $("#totalPrice").html('0');
        });

        $(".removeCommodity").click(function () {
            var totalPrice = 0;
            $(this).parent('.commodityBox').removeClass('on');
            $(this).parent('.commodityBox').find('input[type=text]').val('');
            $(this).parent('.commodityBox').find('input[type=hidden]').val('');
            $(this).parent('.commodityBox').find('.txtValue').html('');
            for (var i = 1; i < 11; ++i) {
                if ($('#commodity' + i).hasClass('on') && $("#total_" + i).val() != '') {
                    totalPrice = totalPrice + parseInt($("#total_" + i).val());
                }
            }

            if (Number.isInteger(totalPrice)) {
                var totalHasVat = (totalPrice *<?php echo(100 + Yii::$app->params['vat']) ?>) / 100;
                totalHasVat = Math.round(totalHasVat);
                $("#D03_SUM_KINGAKU").val(totalHasVat);
                $("#totalPrice").html(totalHasVat);
            }
            else
                $("#totalPrice").html('0');

            var check = false;
            for (var i = 1; i < 11; ++i) {
                if ($("#comcd" + i).val() > 4200 && $("#comcd" + i).val() < 43000) {
                    check = true;
                }
            }
            if (check)
                $("#warrantyBox").show();
            else
                $("#warrantyBox").hide();
        })

        $("#agreeFormBtn").click(function () {
            var form = $(this).closest('form'),
                valid = form.valid();
            if (valid == false)
                return false;
            if ($("#agreeCheck").val()) {
                $.post('<?php yii\helpers\BaseUrl::base(true) ?>registworkslip/default/cus',
                    {
                        'D01_CUST_NO': $("input[name = D01_CUST_NO]").val(),
                        'D01_CUST_NAMEN': $("input[name = D01_CUST_NAMEN]").val(),
                        'D01_CUST_NAMEK': $("input[name = D01_CUST_NAMEK]").val(),
                        'D01_KAKE_CARD_NO': $("input[name = D01_KAKE_CARD_NO]").val(),
                        'D01_ADDR': $("input[name = D01_ADDR]").val(),
                        'D01_TEL_NO': $("input[name = D01_TEL_NO]").val(),
                        'D01_MOBTEL_NO': $("input[name = D01_MOBTEL_NO]").val(),
                        'D01_NOTE': $("#D01_NOTE").val(),
                        'D01_KAIIN_CD': $("input[name = D01_KAIIN_CD]").val()
                    },
                    function (data) {
                        if (data.result_api == '1' && data.result_db == '1') {
                            $("#updateInfo").html('<div class="alert alert-success">編集が成功しました。</div>');
                            setTimeout(function () {
                                $("#modalEditCustomer").modal('hide');
                                if (data.custNo) {
                                    window.location.href = "<?php echo yii\helpers\BaseUrl::base(true) ?>/regist-workslip?custNo=" + data.custNo;
                                }
                                else
                                    window.location.href = "<?php echo yii\helpers\BaseUrl::base(true) ?>/regist-workslip";
                                /*window.location.reload();*/
                            }, 1000);

                        }
                        else {
                            $("#updateInfo").html('<div class="alert alert-danger">編集が失敗しました。</div>');
                        }
                    }
                );
            }
        });
        $("#updateCar").click(function () {
            var form = $(this).closest('form'),
                valid = form.valid();
            if (valid == false)
                return false;
            var arr = [];
            var string;
            for (var j = 1; j < 6; ++j) {
                if ($("#dataCar" + j).hasClass('accOpen')) {
                    string = {
                        'D02_CUST_NO': $("#dataCar" + j).find("#D02_CUST_NO").val(),
                        'D02_CAR_SEQ': $("#dataCar" + j).find("#D02_CAR_SEQ").val(),
                        'D02_CAR_NAMEN': $("#dataCar" + j).find("#D02_MODEL_CD option:selected").html(),
                        'D02_JIKAI_SHAKEN_YM': $("#dataCar" + j).find("#D02_JIKAI_SHAKEN_YM").val(),
                        'D02_METER_KM': $("#dataCar" + j).find("#D02_METER_KM").val(),
                        'D02_SYAKEN_CYCLE': $("#dataCar" + j).find("#D02_SYAKEN_CYCLE").val(),
                        'D02_RIKUUN_NAMEN': $("#dataCar" + j).find("#D02_RIKUUN_NAMEN").val(),
                        'D02_CAR_ID': $("#dataCar" + j).find("#D02_CAR_ID").val(),
                        'D02_HIRA': $("#dataCar" + j).find("#D02_HIRA").val(),
                        'D02_CAR_NO': $("#dataCar" + j).find("#D02_CAR_NO").val(),
                        'D02_INP_DATE': $("#dataCar" + j).find("#D02_INP_DATE").val(),
                        'D02_INP_USER_ID': $("#dataCar" + j).find("#D02_INP_USER_ID").val(),
                        'D02_UPD_DATE': $("#dataCar" + j).find("#D02_UPD_DATE").val(),
                        'D02_UPD_USER_ID': $("#dataCar" + j).find("#D02_UPD_USER_ID").val(),
                        'D02_MAKER_CD': $("#dataCar" + j).find("#D02_MAKER_CD").val(),
                        'car_makerNamen': $("#dataCar" + j).find("#D02_MAKER_CD option:selected").html(),
                        'D02_MODEL_CD': $("#dataCar" + j).find("#D02_MODEL_CD").val(),
                        'car_modelNamen': $("#dataCar" + j).find("#D02_MODEL_CD option:selected").html(),
                        'D02_SHONENDO_YM': $("#dataCar" + j).find("#D02_SHONENDO_YM").val(),
                        'D02_TYPE_CD': $("#dataCar" + j).find("#D02_TYPE_CD").val(),
                        'car_typeNamen': $("#dataCar" + j).find("#D02_TYPE_CD option:selected").html(),
                        'D02_GRADE_CD': $("#dataCar" + j).find("#D02_GRADE_CD").val(),
                        'car_gradeNamen': $("#dataCar" + j).find("#D02_GRADE_CD option:selected").html(),
                        'dataCarApiField': $("#dataCar" + j).find("#CAR_API_FIELD").val(),
                    };
                    arr.push(string);
                }
            }

            $.post('<?php yii\helpers\BaseUrl::base(true) ?>registworkslip/default/car',
                {
                    'dataPost': JSON.stringify(arr),
                    'D02_CUST_NO': $("#D02_CUST_NO").val(),
                    'D03_DEN_NO': $("#D03_DEN_NO").val(),
                    'is_car_api': $("#is_car_api").val(),
                    'D01_KAIIN_CD': $("#D01_KAIIN_CD").val()
                },
                function (data) {
                    if (data.result == '1') {
                        $("#updateCarInfo").html('<div class="alert alert-success">編集が成功しました。</div>');
                        setTimeout(function () {
                            $("#modalEditCar").modal('hide');
                            window.location.reload();
                        }, 1000);

                    }
                    else {
                        if (data.result == '-1')
                            $("#updateCarInfo").html('<div class="alert alert-danger">先にお客様情報を作成して下さい。</div>');
                        else
                            $("#updateCarInfo").html('<div class="alert alert-danger">編集が失敗しました。</div>');
                    }
                }
            );
        })
    })

</script>
<script type="text/javascript">
    <?php
    if ($d03DenNo && file_exists('data/pdf/' . $d03DenNo . '.pdf')) {
    ?>
    $(function () {
        $("#warrantyBox").find("input,select").attr('disabled', true);
    })
    <?php } ?>
</script>
<script src="<?php echo \yii\helpers\BaseUrl::base(true) ?>/js/module/registwork.js"></script>