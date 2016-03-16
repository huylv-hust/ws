<?php $request = Yii::$app->request->post();?>
<?php
if (count($request)) {

    foreach ($confirm as $k => $v) {
        if (isset($request[$k])) {
            $confirm[$k] = $request[$k];
        }
    }

    foreach ($denpyo as $k => $v) {
        if (isset($request[$k])) {
            $denpyo[$k] = $request[$k];
        }
    }

    foreach ($car as $k => $v) {
        if (isset($request[$k])) {
            $car[$k] = $request[$k];
        }
    }
}
?>
<form id="login_form" method="post"
      action="<?= \yii\helpers\BaseUrl::base(true) ?>/regist-workslip?denpyo_no=<?= (int) $d03DenNo ?>"
      class="form-horizontal">
    <main id="contents">
        <section class="readme">
            <h2 class="titleContent">作業伝票作成</h2>
            <p class="rightside">受付日 <?php echo date('Y年m月d日'); ?></p>
        </section>
        <input type="hidden" id="url_action"
               value="<?= \yii\helpers\BaseUrl::base(true) ?>/regist-workslip?denpyo_no=<?= (int) $d03DenNo ?>">
        <input type="hidden" name="D03_DEN_NO" id="D03_DEN_NO" value="<?= $d03DenNo ?>"/>
        <input type="hidden" name="D01_CUST_NO" value="<?= $cus['D01_CUST_NO'] ?>" id="D01_CUST_NO"/>
        <input type="hidden" name="WARRANTY_CUST_NAMEN" value="<?= $cus['D01_CUST_NAMEN'] ?>" id="D01_CUST_NAMEN"/>
        <input type="hidden" name="D03_CUST_NO" value="<?= $denpyo['D03_CUST_NO'] ?>" id="D03_CUST_NO"/>
        <input type="hidden" name="D03_STATUS" value="<?= isset($denpyo['D03_STATUS']) ? $denpyo['D03_STATUS'] : 0 ?>"
               id="D03_CUST_NO"/>
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
                        <div style="padding-right: 150px;">
                            <label class="titleLabel">受付担当者<span class="must">*</span></label>
                            <?= \yii\helpers\Html::dropDownList('M08_NAME_MEI_M08_NAME_SEI', isset($request['M08_NAME_MEI_M08_NAME_SEI']) ? $request['M08_NAME_MEI_M08_NAME_SEI'] : $cus['D01_UKE_JYUG_CD'], $ssUer, array('class' => 'selectForm D01_UKE_JYUG_CD', 'id' => 'D01_UKE_JYUG_CD')) ?>
                        </div>

                        <div style="padding-right: 30px;">
                           <label class="titleLabel">作業日</label>
                            <input maxlength="8" type="text"
                                   value="<?php
								   if (isset($_POST['D03_SEKOU_YMD']))
									   echo $_POST['D03_SEKOU_YMD'];
									else{
										if($d03DenNo)
											echo $denpyo['D03_SEKOU_YMD'];
										else
											echo date('Ymd');
									}
						?>"
                                   name="D03_SEKOU_YMD"
                                   class="textForm dateform">
						</div>
                        <div class="formItem">
                            <label class="titleLabel">お預かり時間</label>
                            <select class="selectForm" name="D03_AZU_BEGIN_HH">

<?php
$hour = (int) date('H');
$selected = $d03DenNo ? $denpyo['D03_AZU_BEGIN_HH'] : $hour;
if (isset($request['D03_AZU_BEGIN_HH']))
    $selected = $request['D03_AZU_BEGIN_HH'];
for ($i = 0; $i < 24; ++$i) {
    if ($i == $selected) {
        ?>
                                        <option selected="selected"
                                                value="<?php echo str_pad($i, 2, '0', STR_PAD_LEFT) ?>"><?php echo str_pad($i, 2, '0', STR_PAD_LEFT) ?></option>
                                    <?php } else { ?>
                                        <option
                                            value="<?php echo str_pad($i, 2, '0', STR_PAD_LEFT) ?>"><?php echo str_pad($i, 2, '0', STR_PAD_LEFT) ?></option>
                                                <?php
                                            }
                                        }
                                        ?>

                            </select>
                            <span class="txtUnit">：</span>
                            <select class="selectForm" name="D03_AZU_BEGIN_MI">
<?php
$mi = (int) date('i') - (int) date('i') % 10;
$selected = $d03DenNo ? $denpyo['D03_AZU_BEGIN_MI'] : $mi;
if (isset($request['D03_AZU_BEGIN_MI']))
    $selected = $request['D03_AZU_BEGIN_MI'];
for ($i = 0; $i < 60; $i = $i + 10) {
    if ($i == $selected) {
        ?>
                                        <option selected="selected"
                                                value="<?php echo str_pad($i, 2, '0', STR_PAD_LEFT) ?>"><?php echo str_pad($i, 2, '0', STR_PAD_LEFT) ?></option>
    <?php } else { ?>
                                        <option
                                            value="<?php echo str_pad($i, 2, '0', STR_PAD_LEFT) ?>"><?php echo str_pad($i, 2, '0', STR_PAD_LEFT) ?></option>
    <?php
    }
}
?>
                            </select>
                            <span class="txtUnit">〜</span>
                            <select class="selectForm" name="D03_AZU_END_HH">
                                <?php
                                $hour = (int) date('H');
                                $selected = $d03DenNo ? $denpyo['D03_AZU_END_HH'] : ($hour + 1);
                                if (isset($request['D03_AZU_END_HH']))
                                    $selected = $request['D03_AZU_END_HH'];
                                if ($denpyo['D03_AZU_END_HH'])
                                    $selected = $denpyo['D03_AZU_END_HH'];
                                for ($i = 0; $i < 24; ++$i) {
                                    if ($i == $selected) {
                                        ?>
                                        <option selected="selected"
                                                value="<?php echo str_pad($i, 2, '0', STR_PAD_LEFT) ?>"><?php echo str_pad($i, 2, '0', STR_PAD_LEFT) ?></option>
    <?php } else { ?>
                                        <option
                                            value="<?php echo str_pad($i, 2, '0', STR_PAD_LEFT) ?>"><?php echo str_pad($i, 2, '0', STR_PAD_LEFT) ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                            </select>
                            <span class="txtUnit">：</span>
                            <select class="selectForm" name="D03_AZU_END_MI">
                                <?php
                                $mi = (int) date('i') - (int) date('i') % 10;
                                $selected = $d03DenNo ? $denpyo['D03_AZU_END_MI'] : $mi;
                                if (isset($request['D03_AZU_END_MI']))
                                    $selected = $request['D03_AZU_END_MI'];
                                for ($i = 0; $i < 60; $i = $i + 10) {
                                    if ($i == $selected) {
                                        ?>
                                        <option selected="selected"
                                                value="<?php echo str_pad($i, 2, '0', STR_PAD_LEFT) ?>"><?php echo str_pad($i, 2, '0', STR_PAD_LEFT) ?></option>
                                        <?php } else { ?>
                                        <option
                                            value="<?php echo str_pad($i, 2, '0', STR_PAD_LEFT) ?>"><?php echo str_pad($i, 2, '0', STR_PAD_LEFT) ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                            </select>
                        </div>
						<input type="hidden" maxlength="6" id="D01_SS_CD"
                                   value="<?= $d03DenNo ? $denpyo['D03_SS_CD'] : $cus['D01_SS_CD'] ?>"
                                   name="D01_SS_CD" class="textForm">
                    </div>
                </fieldset>
            </section>
            <section class="bgContent">
                <fieldset class="fieldsetRegist">
                    <div class="flexHead">
                        <legend class="titleLegend">お客様情報</legend>
                        <?php if ($d03DenNo == 0) { ?>
                            <a data-toggle="modal" class="btnTool flRight" href="#modalEditCustomer">編集</a>
                        <?php } ?>
                    </div>
                    <div class="formGroup">
                        <div class="formItem">
                            <label class="titleLabel">お名前</label>
                            <p class="txtValue"><?= $cus['D01_CUST_NAMEN'] ?></p>
                            <input type="hidden" value="<?= $cus['D01_CUST_NAMEN'] ?>" name="D01_CUST_NAMEN"
                                   maxlength="22">
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
                    <input type="hidden" name="D01_YUBIN_BANGO" value="<?= $cus['D01_YUBIN_BANGO'] ?>">
                    <input type="hidden" name="D01_ADDR" value="<?= $cus['D01_ADDR'] ?>">
                    <input type="hidden" name="D01_TEL_NO" value="<?= $cus['D01_TEL_NO'] ?>">
                    <input type="hidden" name="D01_MOBTEL_NO" value="<?= $cus['D01_MOBTEL_NO'] ?>">
                </fieldset>
            </section>
            <section class="bgContent">
                <fieldset class="fieldsetRegist">
                    <div class="flexHead">
                        <legend class="titleLegend">車両情報</legend>
                        <?php if ($d03DenNo == 0) { ?>
                            <a data-toggle="modal" onclick="showSeqCar()" class="btnTool flRight" href="#modalEditCar">編集</a>
                        <?php } ?>
                    </div>
                    <?php
                    $carHasDenpyo = $car;
                    if ($d03DenNo) {
                        $carOfDenpyo = [
                            'D02_CAR_NAMEN' => $denpyo['D03_CAR_NAMEN'],
                            'D02_JIKAI_SHAKEN_YM' => $denpyo['D03_JIKAI_SHAKEN_YM'],
                            'D02_METER_KM' => $denpyo['D03_METER_KM'],
                            'D02_RIKUUN_NAMEN' => $denpyo['D03_RIKUUN_NAMEN'],
                            'D02_CAR_ID' => $denpyo['D03_CAR_ID'],
                            'D02_HIRA' => $denpyo['D03_HIRA'],
                            'D02_CAR_NO' => $denpyo['D03_CAR_NO'],
                            'D02_CAR_SEQ' => $denpyo['D03_CAR_SEQ'],
                            'D02_SELECTED' => 1,
                        ];
                        $tmpCar = [];
                        foreach ($carHasDenpyo as $row) {
                            if ($row['D02_CAR_SEQ'] != $denpyo['D03_CAR_SEQ']) {
                                $tmpCar[] = $row;
                            } else {
                                $carOfDenpyo['D02_SYAKEN_CYCLE'] = $row['D02_SYAKEN_CYCLE'];
                            }
                        }
                        array_unshift($tmpCar, $carOfDenpyo);
                        $carHasDenpyo = $tmpCar;
                    }
                    ?>
                    <div class="formGroup">
                        <div class="formItem">
                            <label class="titleLabel">今回メンテナンスする車両</label>
                            <select class="selectForm" name="D02_CAR_SEQ_SELECT" id="D02_CAR_SEQ">
<?php
foreach ($carHasDenpyo as $carFirst) {
    if ($carFirst['D02_CAR_NO']) {
        if ($d03DenNo) {
            if (isset($carFirst['D02_CAR_SEQ']))
                echo '<option value="' . $carFirst['D02_CAR_SEQ'] . '">' . $carFirst['D02_CAR_NO'] . '</option>';
            else
                echo '<option value="' . $carFirst['D02_CAR_SEQ'] . '">' . $carFirst['D02_CAR_NO'] . '</option>';
        } else {
            echo '<option value="' . $carFirst['D02_CAR_SEQ'] . '">' . $carFirst['D02_CAR_NO'] . '</option>';
        }
    }
}
?>
                            </select>
                        </div>
                                <?php

                                function showCar($carFirst, $k)
                                {
                                    if (isset($carFirst['D02_SELECTED']) || $k == 1)
                                        $class = "show";
                                    else {
                                        $class = "hide";
                                    }


                                    $prefix = 'D02';
                                    $carFirst['D02_SYAKEN_CYCLE'] = isset($carFirst['D02_SYAKEN_CYCLE']) ? $carFirst['D02_SYAKEN_CYCLE'] : '';
                                    echo '<div class="formItem' . $carFirst['D02_CAR_SEQ'] . '">
                            <input type="hidden" name="D02_CAR_NO_' . $carFirst['D02_CAR_SEQ'] . '" value="' . $carFirst['D02_CAR_NO'] . '"/>
                            <input type="hidden" name="D02_CAR_ID_' . $carFirst['D02_CAR_SEQ'] . '" value="' . $carFirst['D02_CAR_ID'] . '"/>
                            <input type="hidden" name="D02_METER_KM_' . $carFirst['D02_CAR_SEQ'] . '"
                                   value="' . $carFirst['D02_METER_KM'] . '"/>
                            <input type="hidden" name="D02_HIRA_' . $carFirst['D02_CAR_SEQ'] . '" value="' . $carFirst['D02_HIRA'] . '"/>
                            <input type="hidden" name="D02_CAR_NAMEN_' . $carFirst['D02_CAR_SEQ'] . '"
                                   value="' . $carFirst['D02_CAR_NAMEN'] . '"/>
                            <input type="hidden" name="D02_JIKAI_SHAKEN_YM_' . $carFirst['D02_CAR_SEQ'] . '"
                                   value="' . $carFirst['D02_JIKAI_SHAKEN_YM'] . '"/>
                            <input type="hidden" name="D02_RIKUUN_NAMEN_' . $carFirst['D02_CAR_SEQ'] . '"
                                   value="' . $carFirst['D02_RIKUUN_NAMEN'] . '"/>
                            <input type="hidden" name="D02_SYAKEN_CYCLE' . $carFirst['D02_CAR_SEQ'] . '"
                                   value="' . $carFirst['D02_SYAKEN_CYCLE'] . '"/>
                                   </div>
                           <div class="formItem carDataBasic carDataBasic' . $carFirst['D02_CAR_SEQ'] . ' ' . $class . '">
                                <label class="titleLabel">車名</label>
                                <p class="txtValue">' . $carFirst[$prefix . '_CAR_NAMEN'] . '</p>
                            </div>
                            <div class="formItem carDataBasic carDataBasic' . $carFirst['D02_CAR_SEQ'] . ' ' . $class . '">
                                <label class="titleLabel">車検満了日</label>
                                <p class="txtValue">' . ($carFirst[$prefix . '_JIKAI_SHAKEN_YM'] ? substr($carFirst[$prefix . '_JIKAI_SHAKEN_YM'], 0, 4) . '年' . substr($carFirst[$prefix . '_JIKAI_SHAKEN_YM'], 4, 2) . '月' . substr($carFirst[$prefix . '_JIKAI_SHAKEN_YM'], 6, 2) : '') . '</p>
                            </div>
                            <div class="formItem carDataBasic carDataBasic' . $carFirst['D02_CAR_SEQ'] . ' ' . $class . '">
                                <label class="titleLabel">走行距離</label>
                                <p class="txtValue">' . $carFirst[$prefix . '_METER_KM'] . 'km</p>
                            </div>
                            <div class="formItem carDataBasic carDataBasic' . $carFirst['D02_CAR_SEQ'] . ' ' . $class . '">
                                <label class="titleLabel">運輸支局</label>
                                <p class="txtValue">' . $carFirst[$prefix . '_RIKUUN_NAMEN'] . '</p>
                            </div>
                            <div class="formItem carDataBasic carDataBasic' . $carFirst['D02_CAR_SEQ'] . ' ' . $class . '">
                                <label class="titleLabel">分類コード</label>
                                <p class="txtValue">' . $carFirst[$prefix . '_CAR_ID'] . '</p>
                            </div>
                            <div class="formItem carDataBasic carDataBasic' . $carFirst['D02_CAR_SEQ'] . ' ' . $class . '">
                                <label class="titleLabel">ひらがな</label>
                                <p class="txtValue">' . $carFirst[$prefix . '_HIRA'] . '</p>
                            </div>
                            <div class="formItem carDataBasic carDataBasic' . $carFirst['D02_CAR_SEQ'] . ' ' . $class . '">
                                <label class="titleLabel">登録番号</label>
                                <p class="txtValue">' . $carFirst[$prefix . '_CAR_NO'] . '</p>
                            </div>
                           ';
                                }

                                $k = 1;
                                foreach ($carHasDenpyo as $key => $carFirst) {
                                    if ($carFirst['D02_CAR_NO']) {
                                        showCar($carFirst, $k);
                                        ++$k;
                                    }
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
                                    <input type="radio" name="D03_KITYOHIN" value="1" id="valuables1"
                                           class="radios" <?php if ($denpyo['D03_KITYOHIN'] == 1) echo ' checked' ?>>
                                    <label class="labelRadios<?php if ($denpyo['D03_KITYOHIN'] == 1) echo ' checked' ?>"
                                           for="valuables1">有り</label>
                                </div>
                                <div class="radioItem">
                                    <input type="radio" name="D03_KITYOHIN" value="0" id="valuables2"
                                           class="radios" <?php if ($d03DenNo == 0 || $denpyo['D03_KITYOHIN'] == 0) echo 'checked="checked"'; ?>>
                                    <label
                                        class="labelRadios<?php if ($d03DenNo == 0 || $denpyo['D03_KITYOHIN'] == 0) echo ' checked' ?>"
                                        for="valuables2">無し</label>
                                </div>
                            </div>

                        </div>
                        <div class="formItem">
                            <label class="titleLabel">お客様確認</label>
                            <div class="checkGroup">
                                <div class="checkItem checkSingle" style="position: relative;">
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
                                    <input type="radio" value="0" name="D03_SEISAN" id="pays1"
                                           class="radios" <?php if (!isset($denpyo['D03_SEISAN']) || ($d03DenNo == 0 || $denpyo['D03_SEISAN'] == 0)) echo 'checked' ?>>
                                    <label
                                        class="labelRadios <?php if ($d03DenNo == 0 || $denpyo['D03_SEISAN'] == 0) echo ' checked' ?>"
                                        for="pays1">現金</label>
                                </div>
                                <div class="radioItem">
                                    <input type="radio" name="D03_SEISAN" value="1" id="pays2"
                                           class="radios" <?php if ($denpyo['D03_SEISAN'] == 1) echo ' checked' ?>>
                                    <label class="labelRadios<?php if ($denpyo['D03_SEISAN'] == 1) echo ' checked' ?>"
                                           for="pays2">プリカ</label>
                                </div>
                                <div class="radioItem">
                                    <input type="radio" name="D03_SEISAN" value="2" id="pays3"
                                           class="radios" <?php if ($denpyo['D03_SEISAN'] == 2) echo ' checked' ?>>
                                    <label class="labelRadios<?php if ($denpyo['D03_SEISAN'] == 2) echo ' checked' ?>"
                                           for="pays3">クレジット</label>
                                </div>
                                <div class="radioItem">
                                    <input type="radio" name="D03_SEISAN" value="3" id="pays4"
                                           class="radios" <?php if ($denpyo['D03_SEISAN'] == 3) echo ' checked' ?>>
                                    <label class="labelRadios<?php if ($denpyo['D03_SEISAN'] == 3) echo ' checked' ?>"
                                           for="pays4">掛</label>
                                </div>
                            </div>
                        </div>
                        <!-- END PAY -->
                    </div>
                </fieldset>
            </section>
			<input type="hidden" name="D03_YOYAKU_SAGYO_NO" value="0" />
            <section class="bgContent">
                <fieldset class="fieldsetRegist">

                    <div class="formGroup">
                        <div class="formItem flx-2">
							<label class="titleLabel">作業内容</label>
                            <div class="checkGroup">
                                <?php
                                $k = 1;
                                foreach ($tm01Sagyo as $work) {
                                    if ((isset($request['M01_SAGYO_NO']) && in_array($work['M01_SAGYO_NO'], $request['M01_SAGYO_NO'])) || in_array($work['M01_SAGYO_NO'], $sagyoCheck))
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
						<div class="formItem flx-05">
                            <label
                                class="titleLabel">作業者<?php //echo $denpyo['D03_TANTO_MEI'].$denpyo['D03_TANTO_SEI'];  ?></label>
<?= \yii\helpers\Html::dropDownList('D03_TANTO_MEI_D03_TANTO_SEI', isset($request['D03_TANTO_MEI_D03_TANTO_SEI']) ? $request['D03_TANTO_MEI_D03_TANTO_SEI'] : $denpyo['D03_TANTO_SEI'] . '[]' . $denpyo['D03_TANTO_MEI'], $ssUerDenpyo, array('class' => 'selectForm D03_TANTO_MEI_D03_TANTO_SEI', 'id' => 'D03_TANTO_MEI_D03_TANTO_SEI', 'style' => 'width: 180px')) ?>

                        </div>
                        <div class="formItem flx-05">
                            <label
                                class="titleLabel">確認者<?php //echo $denpyo['D03_KAKUNIN_MEI'].$denpyo['D03_KAKUNIN_SEI']  ?></label>
<?= \yii\helpers\Html::dropDownList('D03_KAKUNIN_MEI_D03_KAKUNIN_SEI', isset($request['D03_KAKUNIN_MEI_D03_KAKUNIN_SEI']) ? $request['D03_KAKUNIN_MEI_D03_KAKUNIN_SEI'] : $denpyo['D03_KAKUNIN_SEI'] . '[]' . $denpyo['D03_KAKUNIN_MEI'], $ssUerDenpyo, array('class' => 'selectForm D03_KAKUNIN_MEI_D03_KAKUNIN_SEI', 'id' => 'D03_KAKUNIN_MEI_D03_KAKUNIN_SEI', 'style' => 'width: 180px')) ?>
                        </div>
                    </div>
                    <div class="formGroup">
                        <div class="formItem">
                            <label class="titleLabel">その他作業内容</label>
                            <textarea maxlength="1000" class="textarea"
                                      name="D03_SAGYO_OTHER"><?= isset($request['D03_SAGYO_OTHER']) ? $request['D03_SAGYO_OTHER'] : $denpyo['D03_SAGYO_OTHER'] ?></textarea>
                        </div>
                    </div>
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
                    if (file_exists('data/pdf/' . $d03DenNo . '.pdf')) {
                        $disabled = 'disabled';
                    }

                    echo '<input id="check_pdf" type="hidden" value="' . $disabled . '">';
					$totalDenpyoPost = 0 ;
					if(count($request)) {
						for($i = 1; $i < 11; ++$i) {
							if($request['code_search'.$i] || $request['D05_SURYO'.$i] || $request['D05_TANKA'.$i] || $request['D05_KINGAKU'.$i]) {
								++$totalDenpyoPost;
							}
						}
					}

                    foreach ($listDenpyoCom as $com) {

                        if (in_array((int) $com['D05_COM_CD'], range(42000, 42999))) {
                            $showWarranty = true;
                            $isTaisa = true;
                        } else {
                            $isTaisa = false;
                        }
                        ?>
                        <div id="commodity<?= $k ?>"
							 class="commodityBox<?php if ($k == 1 || $k < ($totalDenpyoCom + 1) || $k <= $totalDenpyoPost) { echo ' on'; }?>">
                                 <?php if ($k > 1) { ?>
                                     <?php if ($isTaisa == false || $d03DenNo == 0 || $disabled == '') { ?>
                                    <a
                                        class="removeCommodity" href="#">削除</a>
                                    <?php }
                                }
                                ?>
                            <input name="D05_NST_CD<?= $k ?>" id="nstcd<?= $k ?>" type="hidden"
                                   value="<?= (isset($request['D05_NST_CD' . $k])) ? $request['D05_NST_CD' . $k] : $com['D05_NST_CD'] ?>"/>
                            <input name="D05_COM_CD<?= $k ?>" id="comcd<?= $k ?>" type="hidden" class="D05_COM_CD"
                                   value="<?= (isset($request['D05_COM_CD' . $k])) ? $request['D05_COM_CD' . $k] : $com['D05_COM_CD'] ?>"/>
                            <input name="D05_COM_SEQ<?= $k ?>" id="comseq<?= $k ?>" type="hidden"
                                   value="<?= (isset($request['D05_COM_SEQ' . $k])) ? $request['D05_COM_SEQ' . $k] : $k ?>">
                            <input name="LIST_NAME[<?= $k ?>]" id="list<?= $k ?>" type="hidden"
                                   value="<?= (isset($request['LIST_NAME'][$k])) ? $request['LIST_NAME'][$k] : (isset($listTm05Edit[$com['D05_COM_CD']]) ? $listTm05Edit[$com['D05_COM_CD']]['M05_COM_NAMEN'] : '') ?>"/>
                            <div class="formGroup">
                                <div class="formItem">
                                    <label class="titleLabel">
										商品・荷姿コード
										 <a onclick="<?php echo ($disabled == '' || $isTaisa == false) ? 'codeSearch(' . $k . ');' : '' ?>"
                                       class="btnFormTool searchGoods openSearchCodeProduct"
                                       style="cursor: pointer" rel="<?= $k ?>">商品検索</a>
									</label>
                                    <input
                                        rel="<?= $k ?>" type="text" name="code_search<?= $k ?>"
                                        id="code_search<?= $k ?>"
                                        maxlength="9"
                                        value="<?= (isset($request['code_search' . $k])) ? $request['code_search' . $k] : $com['D05_COM_CD'] . $com['D05_NST_CD'] ?>"
                                        class="textForm codeSearchProduct <?php if ($disabled == 'disabled' && $isTaisa) echo 'no_event' ?>">

								</div>
                                <div class="formItem">
                                    <label class="titleLabel">品名</label>
                                    <p class="txtValue"
                                       id="txtValueName<?= $k ?>"><?php echo (isset($request['LIST_NAME'][$k])) ? $request['LIST_NAME'][$k] : (isset($listTm05Edit[$com['D05_COM_CD']]) ? $listTm05Edit[$com['D05_COM_CD']]['M05_COM_NAMEN'] : '') ?></p>
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
                                    <input maxlength="5" type="text"
                                           value="<?= (isset($request['D05_SURYO' . $k])) ? $request['D05_SURYO' . $k] : ($com['D05_SURYO'] ? ($com['D05_SURYO'] < 1 ? floatval($com['D05_SURYO']) : $com['D05_SURYO']) : '') ?>"
                                           name="D05_SURYO<?= $k ?>" rel="<?= $k ?>" id="no_<?= $k ?>"
                                           class="textForm noProduct <?php if ($disabled == 'disabled' && $isTaisa) echo 'no_event' ?>">
                                </div>
                                <div class="formItem">
                                    <label class="titleLabel">単価</label>
                                    <input maxlength="10" type="text" name="D05_TANKA<?= $k ?>" rel="<?= $k ?>"
                                           id="price_<?= $k ?>"
                                           value="<?= (isset($request['D05_TANKA' . $k])) ? $request['D05_TANKA' . $k] : $com['D05_TANKA'] ?>"
                                           class="textForm priceProduct <?php if ($disabled == 'disabled' && $isTaisa) echo 'no_event' ?>">
                                    <span class="txtUnit">円</span></div>
                                <div class="formItem">
                                    <label class="titleLabel">金額</label>

                                    <input maxlength="10" type="text" name="D05_KINGAKU<?= $k ?>" rel="<?= $k ?>"
                                           id="total_<?= $k ?>"
                                           value="<?= (isset($request['D05_KINGAKU' . $k])) ? $request['D05_KINGAKU' . $k] : $com['D05_KINGAKU'] ?>"
                                           class="textForm totalPriceProduct <?php if ($disabled == 'disabled' && $isTaisa) echo 'no_event' ?>">
                                    <span class="txtUnit">円</span></div>
                            </div>
                        </div>
                        <input type="hidden" name="indexSearch" rel="<?= $k ?>" id="indexSearch<?= $k ?>"
                               value="<?= $k ?>">
                               <?php ++$k;
                           }
                           ?>

                    <div class="formGroup lineTop">

						<div class="flexLeft" style="width: 50%">
                            <label class="titleLabel">POS伝票番号</label>
                            <textarea class="textarea" name="D03_POS_DEN_NO"
                                      maxlength="50"><?= $denpyo['D03_POS_DEN_NO'] ?></textarea>
                        </div>
						<div class="flexRight">
                            <label class="titleLabelTotal">合計金額</label>
                            <p class="txtValue" style="position: relative"><strong class="totalPrice"
                                                                                   id="totalPrice"><?= $denpyo['D03_SUM_KINGAKU'] ?></strong><span
                                                                                   class="txtUnit">円</span>
                                <input maxlength="10" type="hidden" id="D03_SUM_KINGAKU"
                                       value="<?= $denpyo['D03_SUM_KINGAKU'] ?>" name="D03_SUM_KINGAKU"/>
                            </p>
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
                                                    type="checkbox"
                                                    value="1" <?php echo ($confirm['tire_1']) == 1 ? 'checked' : '' ?>
                                                    name="tire_1">
                                            </label>
                                        </div>
                                        <div class="itemPrintCheck FL">
                                            <label class="labelPrintCheck">
                                                <input
                                                    type="checkbox"
                                                    value="1" <?php echo ($confirm['tire_2']) == 1 ? 'checked' : '' ?>
                                                    name="tire_2">
                                            </label>
                                        </div>
                                        <div class="itemPrintCheck RR">
                                            <label class="labelPrintCheck">
                                                <input
                                                    type="checkbox"
                                                    value="1" <?php echo ($confirm['tire_3']) == 1 ? 'checked' : '' ?>
                                                    name="tire_3">
                                            </label>
                                        </div>
                                        <div class="itemPrintCheck RL">
                                            <label class="labelPrintCheck">
                                                <input
                                                    type="checkbox"
                                                    value="1" <?php echo ($confirm['tire_4']) == 1 ? 'checked' : '' ?>
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
                                                        value="<?php echo (isset($request['pressure_front'])) ? $request['pressure_front'] : $confirm['pressure_front'] ?>"
                                                        name="pressure_front"></span><span
                                                    class="txtUnit">kpa</span></p>
                                        </div>
                                        <div class="itemPrintAir">
                                            <p class="txtValue"><span class="txtUnit">後</span><span class="spcValue"><input
                                                        min="0"
                                                        type="number" class="textFormConf"
                                                        value="<?php echo (isset($request['pressure_behind'])) ? $request['pressure_behind'] : $confirm['pressure_behind'] ?>"
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
                                                   value="1" <?php echo $confirm['rim'] ? 'checked' : '' ?>
                                                   name="rim">
                                            確認</label>
                                    </div>
                                </td>
                                <td><p class="leftside">トルクレンチ</p>
                                    <div class="checkPrint">
                                        <label class="labelPrintCheck">
                                            <input type="checkbox"
                                                   value="1" <?php echo $confirm['torque'] ? 'checked' : '' ?>
                                                   name="torque">
                                            締付</label>
                                    </div>
                                </td>
                                <td><p class="leftside">ホイルキャップ</p>
                                    <div class="checkPrint">
                                        <label class="labelPrintCheck">
                                            <input type="checkbox"
                                                   value="1" <?php echo $confirm['foil'] ? 'checked' : '' ?>
                                                   name="foil">
                                            取付</label>
                                    </div>
                                </td>
                                <td><p class="leftside">持帰ナット</p>
                                    <div class="checkPrint">
                                        <label class="labelPrintCheck">
                                            <input type="checkbox"
                                                   value="1" <?php echo $confirm['nut'] ? 'checked' : '' ?>
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
                                                   value="1" <?php echo $confirm['oil'] ? 'checked' : '' ?>
                                                   name="oil">
                                            確認</label>
                                    </div>
                                </td>
                                <td><p class="leftside">オイルキャップ</p>
                                    <div class="checkPrint">
                                        <label class="labelPrintCheck">
                                            <input type="checkbox"<?php echo $confirm['oil_cap'] ? 'checked' : '' ?>
                                                   value="1" name="oil_cap">
                                            確認</label>
                                    </div>
                                </td>
                                <td><p class="leftside">レベルゲージ</p>
                                    <div class="checkPrint">
                                        <label class="labelPrintCheck">
                                            <input type="checkbox" <?php echo $confirm['level'] ? 'checked' : '' ?>
                                                   value="1" name="level">
                                            確認</label>
                                    </div>
                                </td>
                                <td><p class="leftside">ドレンボルト</p>
                                    <div class="checkPrint">
                                        <label class="labelPrintCheck">
                                            <input
                                                type="checkbox" <?php echo $confirm['drain_bolt'] ? 'checked' : '' ?>
                                                value="1" name="drain_bolt">
                                            確認</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><p class="leftside">パッキン</p>
                                    <div class="checkPrint">
                                        <label class="labelPrintCheck">
                                            <input type="checkbox" <?php echo $confirm['packing'] ? 'checked' : '' ?>
                                                   value="1" name="packing">
                                            確認</label>
                                    </div>
                                </td>
                                <td><p class="leftside">オイル漏れ</p>
                                    <div class="checkPrint">
                                        <label class="labelPrintCheck">
                                            <input
                                                type="checkbox" <?php echo $confirm['oil_leak'] ? 'checked' : '' ?>
                                                value="1" name="oil_leak">
                                            確認</label>
                                    </div>
                                </td>
                                <td colspan="2"><p class="leftside">次回交換目安</p>
                                    <div class="checkPrint">
                                        <p class="txtValue">
                                            <input min="0" type="number" class="textFormConf"
                                                   value="<?php echo isset($request['date_1']) ? $request['date_1'] : (($confirm['date']) && (int) substr($confirm['date'], 0, 4) ? substr($confirm['date'], 0, 4) : '') ?>"
                                                   style="width:4em;" name="date_1">
                                            <span class="txtUnit">年</span>
                                            <input min="0" type="number" class="textFormConf"
                                                   value="<?php echo isset($request['date_2']) ? $request['date_2'] : (($confirm['date']) && (int) substr($confirm['date'], 4, 2) ? substr($confirm['date'], 4, 2) : '') ?>"
                                                   style="width:2em;" name="date_2">
                                            <span class="txtUnit">月</span>
                                            <input min="0" type="number" class="textFormConf"
                                                   value="<?php echo isset($request['date_3']) ? $request['date_3'] : (($confirm['date']) && (int) substr($confirm['date'], 6, 2) ? substr($confirm['date'], 6, 2) : '') ?>"
                                                   maxlength="2" style="width:2em;" name="date_3">
                                            <span class="txtUnit">日　または、</span>
                                            <input min="0" type="number" class="textFormConf"
                                                   value="<?php echo ($confirm['km']) ? $confirm['km'] : '' ?>" name="km" style="width: 12%">
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
					<div class="formGroup">
						<div class="formItem">
								<label class="titleLabel">備考</label>
								<textarea class="textarea" name="D03_NOTE"><?= $denpyo['D03_NOTE'] ?></textarea>
						</div>
					</div>
				</fieldset>
            </section>

            <!-- BEGIN BAOHANH -->
            <?php
            $ck = '';
            $class = "";
			$style = "";
            $style1 = "";
			$style2 = "";
            $view_pdf = true;
            if (file_exists('data/pdf/' . $d03DenNo . '.pdf')) {
                $style = 'style="display:block"';
				$style1 = 'style="pointer-events: none;"';
				$style2 = 'style="display:block"';
                $ck = 'checked="checked"';
                $class = "checked";
                $view_pdf = false;
            } else {
                if ($d03DenNo && $showWarranty) {
                    $style = 'style="display:block"';
					$style2 = 'style="display:block"';
                } else {
					if(isset($request['checkClickWarranty']) && $request['checkClickWarranty'] == '1') {
						$ck = 'checked="checked"';
						$style2 = 'style="display:block"';
						$class = "checked";
					}
					//print_r($request);
					for($i = 1; $i < 11; ++$i) {
						if(isset($request['code_search'.$i])) {
							if(in_array((int) substr($request['code_search'.$i],0,6),  range(42000, 42999))) {
								$style = 'style="display:block"';
								break;
							}

						}
					}

                }
            }
            ?>

            <!-- END BAOHANH -->
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
                                    <label class="labelSingleCheck <?= $class ?>" <?= $style1 ?>
                                           id="checkWarranty_label"
                                           for="checkWarranty">保証書を作成する</label>
                                </div>
                            </div>
                        </div>
                        <div class="formItem">
                            <label class="titleLabel">保証書番号</label>

                            <p class="txtValue toggleWarranty"
                               id="warrantyNo" <?= $style2 ?>><?php if(isset($request['M09_WARRANTY_NO'])) echo $request['M09_WARRANTY_NO']; else echo $csv['M09_WARRANTY_NO']; ?>
							</p>
                        </div>
                        <div class="formItem">
                            <label class="titleLabel">購入日</label>
                            <p class="txtValue toggleWarranty" <?= $style2 ?>><?php if ($csv['M09_INP_DATE'] && $csv['M09_WARRANTY_NO'])
                                    echo Yii::$app->formatter->asDate(date('Y/m/d', strtotime($csv['M09_INP_DATE'])), 'yyyy年MM月dd日');
                                else
                                    echo date('Y年m月d日')
                                    ?>
							</p>
                        </div>
                        <div class="formItem">
                            <label class="titleLabel">保証期間</label>
                            <p class="txtValue toggleWarranty" id="toggleWarranty" <?= $style2 ?>>
<?php if ($csv['warranty_period'])
    echo Yii::$app->formatter->asDate(date('Y/m/d', strtotime($csv['warranty_period'])), 'yyyy年MM月dd日');
else
    echo date('Y年m月d日', strtotime('+ 6 month'));
?>
                                <input type="hidden" value="0" name="checkClickWarranty" id="checkClickWarranty"/>

                                <input type="hidden" name="M09_WARRANTY_NO" id="M09_WARRANTY_NO"
                                       value="<?php if(isset($request['M09_WARRANTY_NO'])) echo $request['M09_WARRANTY_NO']; else echo $csv['M09_WARRANTY_NO']; ?>"/>
                                <input type="hidden" name="M09_INP_DATE" id="M09_INP_DATE"
                                       value="<?php if ($csv['M09_INP_DATE'] && $csv['M09_WARRANTY_NO'])
    echo $csv['M09_INP_DATE'];
else
    echo date('Y/m/d')
    ?>"/>
                                <input type="hidden" name="warranty_period" id="warranty_period"
                                       value="<?php if ($csv['warranty_period'] && $csv['M09_WARRANTY_NO'])
    echo $csv['warranty_period'];
else
    echo date('Y/m/d', strtotime('+ 6 month'));
?>"/>
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
                            <label class="titleLabel">サイズ<span class="txtExample">例)1956515</span></label>
                        </div>
                        <div class="formItem">
                            <label class="titleLabel">セリアル番号</label>
                        </div>
                        <div class="formItem">
                            <label class="titleLabel">数量</label>
                        </div>
                    </div>
                                <?php $warranty_item = ['' => '', 'BS' => 'BS', 'YH' => 'YH', 'DF' => 'DF', 'TY' => 'TY','FK' => 'FK'] ?>
                                <?php for ($i = 1; $i < 7; ++$i) { ?>
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
                                    } elseif ($i == 5) {
                                        $name = 'other_a';
                                        echo 'その他A';
                                    } elseif ($i == 6) {
                                        $name = 'other_b';
                                        echo 'その他B';
                                    } else {
                                        $name = 'left_behind';
                                        echo '左後';
                                    }
                                    ?>

                                </p>
                            </div>
                            <div class="formItem">
    <?= \yii\helpers\Html::dropDownList($name . '_manu', isset($request[$name . '_manu']) ? $request[$name . '_manu'] : $csv[$name . '_manu'], $warranty_item, array('class' => 'selectForm select_product', 'id' => $name . '_manu')) ?>
                            </div>
                            <div class="formItem">
                                <input type="text" value="<?= isset($request[$name . '_product']) ? $request[$name . '_product'] : $csv[$name . '_product'] ?>" class="textForm ui-autocomplete-input"
                                       id="<?= $name . '_product' ?>" name="<?= $name . '_product' ?>">
                            </div>
                            <div class="formItem">
                                <input type="text" value="<?= isset($request[$name . '_size']) ? $request[$name . '_size'] : $csv[$name . '_size'] ?>" class="textForm"
                                       id="<?= $name . '_size' ?>" name="<?= $name . '_size' ?>">
                            </div>
                            <div class="formItem">
                                <input type="text" value="<?= isset($request[$name . '_serial']) ? $request[$name . '_serial'] : $csv[$name . '_serial'] ?>" class="textForm"
                                       id="<?= $name . '_serial' ?>" name="<?= $name . '_serial' ?>">
                            </div>
                            <div class="formItem">
                                <p class="txtValue number_product_p"><?php if(isset($request[$name . '_no']) && $request[$name . '_no'] == '1') echo '1'; else  echo $csv[$name . '_manu'] != '' ? 1 : ''; ?></p>
                                <input type="hidden" value="<?php echo $csv[$name . '_manu'] != '' ? 1 : 0; ?>" class="number_product_hidden"
                                       id="<?= $name . '_no' ?>" name="<?= $name . '_no' ?>">
                            </div>
                        </div>
<?php } ?>

                </fieldset>
            </section>
        </article>
    </main>
    <footer id="footer">
        <div class="toolbar">
            <a class="btnBack"
               href="<?php echo isset($d03DenNo) ? yii\helpers\BaseUrl::base(true) . '/detail-workslip?den_no=' . $d03DenNo : yii\helpers\BaseUrl::base(true); ?>">戻る</a>

            <div class="btnSet" style="width:150px;">
                <a class="btnTool" id="preview">作業指示書</a>
            </div>

            <a class="btnSubmit cR" id="btnRegistWorkSlip">登録</a>
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
    <div class="modal-dialog modal-form">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span
                        aria-hidden="true">×</span></button>
                <h4 class="modal-title">
                    お客様情報登録
                    <span class="note">　項目を入力してください。<span class="must">*</span>は必須入力項目です。</span>
                </h4>
            </div>
            <form id="modal_customer">
                <div class="modal-body modal-body">
                    <div id="updateInfo"></div>

                    <section class="bgContent">
                        <input type="hidden" value="<?= $cus['D01_KAIIN_CD'] ?>" id="D01_KAIIN_CD" name="D01_KAIIN_CD"/>
                        <input type="hidden" value="<?= $cus['D01_CUST_NO'] ?>" name="D01_CUST_NO"/>
                        <fieldset class="fieldsetRegist">
                            <legend class="titleLegend">お客様情報</legend>
                            <div class="formGroup">
                                <div class="formItem">
                                    <label class="titleLabel">お名前<span class="must">*</span></label>
                                    <input maxlength="22" type="text" value="<?= $cus['D01_CUST_NAMEN'] ?>" class="textForm"
                                           name="D01_CUST_NAMEN" id="autokana-name">
                                </div>
                                <div class="formItem">
                                    <label class="titleLabel">フリガナ<span class="must">*</span></label>
                                    <input maxlength="30" type="text" value="<?= $cus['D01_CUST_NAMEK'] ?>" name="D01_CUST_NAMEK"
                                           class="textForm" id="D01_CUST_NAMEK">
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
                                    <label class="titleLabel">郵便番号<a id="btn_get_address" class="btnFormTool" href="javascript:void(0)">住所検索</a></label>
                                    <input maxlength="7" type="text"
                                           value="<?= isset($cus['D01_YUBIN_BANGO']) ? $cus['D01_YUBIN_BANGO'] : '' ?>"
                                           name="D01_YUBIN_BANGO"
                                           class="textForm" id="D01_YUBIN_BANGO">

                                </div>
                                <div class="formItem flx-2">
                                    <label class="titleLabel">ご住所</label>
                                    <input maxlength="35" type="text" value="<?= $cus['D01_ADDR'] ?>" name="D01_ADDR" id="D01_ADDR"
                                           class="textForm">
                                </div>
                            </div>
                            <div class="formGroup">
                                <div class="formItem">
                                    <label class="titleLabel">電話番号</label>
                                    <input maxlength="12" type="text" value="<?php if ($cus['D01_TEL_NO']) echo $cus['D01_TEL_NO']; ?>" name="D01_TEL_NO"
                                           id="D01_TEL_NO"
                                           class="textForm">
                                </div>
                                <div class="formItem">
                                    <label class="titleLabel">携帯電話番号</label>
                                    <input maxlength="12" type="text" value="<?= $cus['D01_MOBTEL_NO'] ?>" id="D01_MOBTEL_NO"
                                           name="D01_MOBTEL_NO" class="textForm">
                                </div>
                                <div class="formItem">
                                </div>
                            </div>
                            <div class="formGroup">
                                <div class="formItem">
                                    <label class="titleLabel">備考</label>
                                    <textarea maxlength="1000" class="textarea" name="D01_NOTE"
                                              id="D01_NOTE"><?= $cus['D01_NOTE'] ?></textarea>
                                </div>
                            </div>
                        </fieldset>
                    </section>
                </div>
                <div class="modal-footer">
                    <input type="checkbox" onchange="//agreeForm();" name="agreeCheck"
                           id="agreeCheck"
                           value="1" class="checks">
                    <label id="agreeLabel" class="labelSingleCheck" for="agreeCheck">
                        <a target="_blank"
                           href="<?= \yii\helpers\BaseUrl::base() ?>/img/PrivacyPolicy.pdf">プライバシーポリシー</a>に同意する
                           (約款・個人情報は左のリンクよりご確認ください)
                    </label>
					<div style="top: 500px; left: 90%; display: none;" id="showValidateUpdateCus" role="tooltip" class="tooltip fade top in">
						<div style="left: 50%;" class="tooltip-arrow"></div>
						<div class="tooltip-inner showValidateUpdateCus">エラーがあります</div>
					</div>
                    <input type="button" disabled="" value="登録する" id="agreeFormBtn" class="btnSubmit disabled flRight">
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END InfoCus -->
<!-- BEGIN InfoCar -->
<div id="modalEditCar" class="modal fade">
    <div class="modal-dialog modal-form">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span
                        aria-hidden="true">×</span></button>
                <h4 class="modal-title">車両情報登録</h4>
            </div>
            <form id="modal_car" action="">
                <div class="modal-body modal-form">
                    <div id="updateCarInfo"></div>
                    <p class="note">項目を入力してください。<span class="must">*</span>は必須入力項目です。</p>
                    <?php

                    use backend\components\Api; ?>
<?php
$k = 1;
foreach ($car as $carFirst) {
    if ((int) $carFirst['D02_CAR_SEQ'] == 0) {
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
                            <input type="hidden" value="<?= (int) $carFirst['D02_CAR_SEQ'] ?>" name="D02_CAR_SEQ"
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
                                    <a class="toggleAccordion" id="delete<?= $k ?>"
                                       style="cursor: pointer;"><?= $label_delete ?></a>
                                </div>
                                <div class="accordionBody">
                                    <div class="formGroup">
                                        <div class="formItem">
                                            <label class="titleLabel">メーカー<span class="must">*</span></label>
                                            <?php
                                            $api = new Api();
                                            $maker = $api->getListMaker();
                                            $list_maker = [];
                                            $list_grade = ['' => ''];
                                            $list_type = ['' => ''];
                                            $maker_code = 0;
                                            foreach ($maker as $mak) {
                                                $list_maker[$mak['maker_code']] = $mak['maker'];
                                            }

                                            $makers = array('' => 'メーカーを選択して下さい', '-111' => 'その他');
                                            static $_GENRE_NAMES = array('1' => '----- 国産車 -----', '2' => '----- 輸入車 -----');

                                            foreach ($list_maker as $maker_value => $value) {
                                                $genre_code = substr($maker_value, 0, 1);
                                                if ($genre_code > '2') {
                                                    $genre_code = '2';
                                                }
                                                $genre_name = $_GENRE_NAMES[$genre_code];
                                                if (isset($makers[$genre_name]) == false) {
                                                    $makers[$genre_name] = array();
                                                }
                                                $makers[$genre_name][$maker_value] = $value;
                                            }

                                            $list_model = ['' => ''];
                                            if ((int) $carFirst['D02_MAKER_CD'] > 0) {

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
                                            <?= \yii\helpers\Html::dropDownList('D02_MAKER_CD[' . $k . ']', $carFirst['D02_MAKER_CD'], $makers, array('class' => 'selectForm D02_MAKER_CD', 'id' => 'D02_MAKER_CD', 'rel' => $k)) ?>
    <?php
    if ($carFirst['D02_MAKER_CD'] == '-111') {
        if (isset($carFirst['ApiCar']['car_carName']))
            echo '<input type="text" id="D02_CAR_NAMEN_OTHER" name="D02_CAR_NAMEN_OTHER[' . $k . ']"' . ' class="textForm D02_CAR_NAMEN_OTHER" value="' . $carFirst['ApiCar']['car_carName'] . '">';
        else
            echo '<input type="text" id="D02_CAR_NAMEN_OTHER" name="D02_CAR_NAMEN_OTHER[' . $k . ']"' . ' class="textForm D02_CAR_NAMEN_OTHER" value="' . $carFirst['D02_CAR_NAMEN'] . '">';
    } else
        echo '<input type="text" id="D02_CAR_NAMEN_OTHER"  name="D02_CAR_NAMEN_OTHER[' . $k . ']"' . ' class="textForm D02_CAR_NAMEN_OTHER" value="" style="display:none">';
    ?>
                                        </div>
                                        <div class="formItem flx-2">
                                            <label class="titleLabel">車名<span class="must">*</span></label>
                                            <?= \yii\helpers\Html::dropDownList('D02_MODEL_CD[' . $k . ']', $carFirst['D02_MODEL_CD'], $list_model, array('class' => 'selectForm D02_MODEL_CD', 'id' => 'D02_MODEL_CD', 'rel' => $k)) ?>
                                        </div>
                                    </div>
                                    <div class="formGroup">
                                        <div class="formItem">
                                            <label class="titleLabel">初年度登録年月</label>
                                            <input maxlength="6" type="text" id="D02_SHONENDO_YM<?= $k ?>"
                                                   name="D02_SHONENDO_YM[<?= $k ?>]"
                                                   value="<?php echo $carFirst['D02_SHONENDO_YM']; ?>"
                                                   class="textForm D02_SHONENDO_YM ymform">
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
                                                   name="D02_JIKAI_SHAKEN_YM[<?= $k ?>]" id="D02_JIKAI_SHAKEN_YM<?= $k ?>"
                                                   class="textForm dateform D02_JIKAI_SHAKEN_YM">
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
                                        <div class="formItem flx-05">
                                            <label class="titleLabel">運輸支局都道府県</label>
                                            <select name="prefecture" class="selectForm" style="width:160px">
                                                <option value=""></option>
                                                <?php foreach ($car_regions as $region => $prefectures) { ?>
                                                    <optgroup label="<?php echo htmlspecialchars($region) ?>">
                                                        <?php foreach (array_keys($prefectures) as $prefecture) { ?>
                                                        <option value="<?php echo htmlspecialchars($prefecture) ?>"><?php echo htmlspecialchars($prefecture) ?></option>
                                                        <?php } ?>
                                                    </optgroup>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="formItem flx-05">
                                            <label class="titleLabel">運輸支局<span class="must">*</span></label>
                                            <select id="D02_RIKUUN_NAMEN" name="D02_RIKUUN_NAMEN[<?= $k ?>]" class="selectForm D02_RIKUUN_NAMEN">
                                                <option value=""></option>
                                                <option value="<?= $carFirst['D02_RIKUUN_NAMEN'] ?>" selected><?= $carFirst['D02_RIKUUN_NAMEN'] ?></option>
                                            </select>
                                        </div>
                                        <div class="formItem flx-05">
                                            <label class="titleLabel">分類コード<span class="must">*</span></label>
                                            <input maxlength="3" type="text" value="<?= $carFirst['D02_CAR_ID'] ?>"
                                                   name="D02_CAR_ID[<?= $k ?>]"
                                                   id="D02_CAR_ID" class="textForm formWidthXS D02_CAR_ID">
                                            <span class="txtExample">例)330</span>
                                        </div>
                                        <div class="formItem flx-05">
                                            <label class="titleLabel">ひらがな<span class="must">*</span></label>
                                            <input maxlength="1" type="text" value="<?= @$carFirst['D02_HIRA'] ?>"
                                                   name="D02_HIRA[<?= $k ?>]"
                                                   id="D02_HIRA" class="textForm formWidthXXS D02_HIRA">
                                            <span class="txtExample">例)あ</span>
                                        </div>
                                        <div class="formItem">
                                            <label class="titleLabel">登録番号<span class="must">*</span></label>
                                            <input maxlength="4" type="text" value="<?= $carFirst['D02_CAR_NO'] ?>"
                                                   name="D02_CAR_NO[<?= $k ?>]"
                                                   id="D02_CAR_NO" class="textForm formWidthXS D02_CAR_NO">
                                            <span class="txtExample">例)0301</span>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </section>
    <?php
    ++$k;
}
?>
                </div>

                <div class="modal-footer">
					<div class="tooltip fade top in" role="tooltip" id="showValidateUpdateCar" style="top: 490px; left: 45.5%; display: none;">
						<div class="tooltip-arrow" style="left: 50%;"></div>
						<div class="tooltip-inner showValidateUpdateCar">エラーがあります</div>
					</div>
					<a class="btnSubmit" style="cursor: pointer;" id="updateCar">登録する</a>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END InfoCar -->
<!-- BEGIN CodeSearchProduct -->
<div id="modalCodeSearch" class="modal fade ">
    <input type="hidden" value="" id="condition">
    <div class="modal-dialog widthS">
        <div class="modal-content" style="width: 850px;">
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
                                <div class="radioGroup itemFlex initial">
                                    <div class="radioItem">
                                        <input type="radio" name="search_M05_COM_CD" checked="checked" id="M05_COM_CD"
                                               class="radios">
                                        <label class="labelRadios checked" for="valuables1">商品コード</label>
                                    </div>
                                    <div class="radioItem">
                                        <input type="radio" name="search_M05_COM_NAMEN" id="M05_COM_NAMEN"
                                               class="radios">
                                        <label class="labelRadios" for="valuables2">品名</label>
                                    </div>
                                </div>
                                <div class="itemFlex">
                                    <input id="code_search_value" type="text" style="width:18em;" value="" class="textForm" />
								</div>
                            </div>
                        </div>
						<div class="formGroup">
							<div class="formItem flexHorizontal">
								<label class="titleLabel">カテゴリ検索 </label>
								<div class="checkGroupGroup itemFlex pl10">
									<?php
									$a_search = [
										'1' => 'タイヤ',
										'2' => 'オイル',
										'3' => 'バッテリー',
										'4' => 'コーティング',
										'5' => 'リペア',
										'6' => '車検',
										'7' => 'その他',
									];
									foreach($a_search as $key => $val)
									{
										echo '<div class="checkItem radioItem">
										<input type="checkbox" name="search_M05_KIND_DM_NO[]" value="'.$key.'" id="search_M05_KIND_DM_NO'.$key.'" class="checks">
										<label class="labelChecks labelRadios kind_dm_no_search" id="labelSearch_M05_KIND_DM_NO'.$key.'" rel="'.$key.'" for="search_M05_KIND_DM_NO'.$key.'" rel="'.$key.'">'.$val.'</label>
										</div>';
									}
									?>
								</div>
							</div>
						</div>
						<div class="formGroup">
							<div class="formItem flexHorizontal centering" style="display:block">
                                <a id="code_search_btn" class="btnFormTool" href="#" style="height: 35px;line-height: 35px;">検索する</a>
                            </div>
                        </div>
					</section>
                </form>
				<script>

				/*
				$(".kind_dm_no_search").click(function(){
					var index = $(this).attr("rel");
					if(index == '7'){
						for(var i = 1; i < 7; ++i){
							$("#search_M05_KIND_DM_NO" + i).removeAttr('checked');
							$("#labelSearch_M05_KIND_DM_NO" + i).removeClass('checked');
						}
					}
					else
					{
						$("#search_M05_KIND_DM_NO7").prop('checked',false);
						$("#labelSearch_M05_KIND_DM_NO7").removeClass('checked');
					}
				});
				*/
				</script>
<?php
use yii\data\Pagination; ?>
                <nav class="paging">
<?php
echo yii\widgets\LinkPager::widget([
    'pagination' => $pagination,
    'nextPageLabel' => '&gt;',
    'prevPageLabel' => '&lt;',
    'firstPageLabel' => '&laquo;',
    'lastPageLabel' => '&raquo;',
])
?>
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
                                           onclick="setValue('<?= $product['M05_COM_CD'] . $product['M05_NST_CD'] ?>',<?= (int) $product['M05_COM_CD'] ?>)"
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

<?php
echo yii\widgets\LinkPager::widget([
    'pagination' => $pagination,
    'nextPageLabel' => '&gt;',
    'prevPageLabel' => '&lt;',
    'firstPageLabel' => '&laquo;',
    'lastPageLabel' => '&raquo;',
])
?>

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
                                         href="#">いいえ</a> <a class="btnSubmit cR flRight btnSubmitDenpyo"
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
        var link = window.open('');
		link.document.title = 'ViewPdf';
		$.ajax({
            url: '<?php yii\helpers\BaseUrl::base(true) ?>registworkslip/default/pdfview',
            type: 'post',
            data: {
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
                'M09_WARRANTY_NO': ($("#M09_WARRANTY_NO:enabled").val() != undefined) ? $("#M09_WARRANTY_NO:enabled").val() : '',
                'WARRANTY_CUST_NAMEN': $("#D01_CUST_NAMEN").val(),
                'D03_CAR_NO': $("input[name =D02_CAR_NO_" + $("#D02_CAR_SEQ").val() + ']').val(),
                'D03_CAR_NAMEN': $("input[name =D02_CAR_NAMEN_" + $("#D02_CAR_SEQ").val() + ']').val(),
                'D03_RIKUUN_NAMEN': $("input[name =D02_RIKUUN_NAMEN_" + $("#D02_CAR_SEQ").val() + ']').val(),
                'D03_CAR_ID': $("input[name =D02_CAR_ID_" + $("#D02_CAR_SEQ").val() + ']').val(),
                'D03_HIRA': $("input[name =D02_HIRA_" + $("#D02_CAR_SEQ").val() + ']').val()
            },
            async: false,
            success: function (data) {
               link.location= data;
            }
        });
        return false
    });
    $(".labelRadios").click(function () {
        var id = $(this).attr('for');
        $("#" + id).attr('checked', 'checked');
    });
    $(".labelChecks").click(function () {
        var id = $(this).attr('for');
        $("#" + id).attr('checked', 'checked');
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
        $(cur).parents('section').find('.D02_MODEL_CD option[value!=""]').remove();
        $(cur).parents('section').find('.D02_TYPE_CD option[value!=""]').remove();
        $(cur).parents('section').find('.D02_GRADE_CD option[value!=""]').remove();
        $(cur).parents('section').find('.D02_SHONENDO_YM').val('');

        if ($(this).val() == '' || $(this).val() == '-111') {
            if ($(this).val() == '-111') {
                $(cur).parents('section').find('#D02_CAR_NAMEN_OTHER').removeAttr('disabled').show();
            } else {
                $(cur).parents('section').find('#D02_CAR_NAMEN_OTHER').attr('disabled', 'disabled').hide();
            }
            return;
        } else {
            $(cur).parents('section').find('#D02_CAR_NAMEN_OTHER').attr('disabled', 'disabled').hide();
        }

        $.getJSON(
            '<?php echo $url_car_api ?>', {
                'maker_code': $(this).val()
            }
        ).done(function(data)
        {
            $.each(data, function()
            {
                $(cur).parents('section').find('.D02_MODEL_CD').append(
                    $('<option value="' + this.model_code + '">' + this.model + '</option>')
                );
            });
        });
    });

    $(".D02_MODEL_CD").change(function()
    {
        var cur = $(this);
        $(cur).parents('section').find('.D02_TYPE_CD option[value!=""]').remove();
        $(cur).parents('section').find('.D02_GRADE_CD option[value!=""]').remove();
        var year = $(cur).parents('section').find('.D02_SHONENDO_YM').val().substr(0, 4);

        if ($(this).val() == '0' || year.length == 0) {
            return;
        }

        $.getJSON(
            '<?php echo $url_car_api ?>',
            {
                'maker_code': $(cur).parents('section').find('.D02_MAKER_CD').val(),
                'model_code': $(this).val(),
                'year': year
            }
        ).done(function(data)
        {
            $.each(data, function()
            {
                $(cur).parents('section').find('.D02_TYPE_CD').append(
                    $('<option value="' + this.type_code + '">' + this.type + '</option>')
                );
            });
        });
    });

    $(".D02_TYPE_CD").change(function()
    {
        var cur = $(this);
        $(cur).parents('section').find('.D02_GRADE_CD option[value!=""]').remove();
        var year = $(cur).parents('section').find('.D02_SHONENDO_YM').val().substr(0, 4);

        if ($(this).val() == '' || year.length == 0) {
            return;
        }

        $.getJSON(
            '<?php echo $url_car_api ?>',
            {
                'type_code': $(this).val(),
                'year': year,
                'maker_code': $(cur).parents('section').find('.D02_MAKER_CD').val(),
                'model_code': $(cur).parents('section').find('.D02_MODEL_CD').val()
            }
        ).done(function(data)
        {
            $.each(data, function()
            {
                $(cur).parents('section').find('.D02_GRADE_CD').append(
                    $('<option value="' + this.grade_code + '">' + this.grade + '</option>')
                );
            });
        });
    });

    $(".D02_SHONENDO_YM").change(function()
    {
        $(this).parents('section:first').find('.D02_MODEL_CD').trigger('change');
    });
</script>
<script type="text/javascript">
    function closePop() {
        if ($('input[name="M05_COM_CD.M05_NST_CD"]').is(':checked')) {
            $("#modalCodeSearch").modal('hide');
        } else {
            alert('商品を選択してください');
        }
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
        $("#code_search" + index).attr('title1', m05ComCD);
        $("#list" + index).val($("#name" + m05ComCD).val());
        comCd = parseInt(comCd);
        if (comCd > 41999 && comCd < 43000) {
            $("#warrantyBox").show();
        } else {
            var count = 0;
            $('.commodityBox.on').each(function () {
                var value = parseInt($(this).find('.D05_COM_CD').val());
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
        if (!$('#checkWarranty_label').hasClass('checked')) {
            $('.toggleWarranty').hide();
        }

        $("#checkWarranty_label").click(function () {
            var check = $("#checkClickWarranty").val(),
                    warranty_no = $("#M09_WARRANTY_NO").val();
            $("#checkWarranty").attr('checked', 'checked');
            if ($(this).hasClass('checked')) {
                $("#checkWarranty").attr('checked', 'checked');
                $("#checkClickWarranty").val('1');
                $("#warrantyNo").html(warranty_no);
                $('#M09_WARRANTY_NO').removeAttr('disabled');
                $('#warranty_period').removeAttr('disabled');
                $('#M09_INP_DATE').removeAttr('disabled');
            } else {
                $("#checkWarranty").removeAttr('checked');
                $("#checkClickWarranty").val('');
                $("#warrantyNo").html('');
                $('#M09_WARRANTY_NO').attr('disabled', true);
                $('#warranty_period').attr('disabled', true);
                $('#M09_INP_DATE').attr('disabled', true);
            }

            if (warranty_no != '') {
                return;
            }

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
			var length = parseInt(code.length);
			if(code.length == 8){
				$("#code_search" + index).val('0'+code);
				length=9;
			}

            if (length < 9) {
				var count = 0;
                $('#nstcd' + index).val('');
                $('#comcd' + index).val('');
                $('#comseq' + index).val('');
                $('#list' + index).val('');
                $('#no_'+index).val('');
				$("#txtValueName" + index).html('');
				$("#txtValuePrice" + index).html('');
                $('#no_'+index).trigger('change');
                $('#price_'+index).val('');
                $('#total_'+index).val('');
                $('.commodityBox.on').each(function () {
                    var value = parseInt($(this).find('.D05_COM_CD').val());
                    if (value > 41999 && value < 43000) {
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
				if(data == false)
				{
					$("#txtValueName" + index).html('');
					$("#txtValuePrice" + index).html('');
					$('#nstcd' + index).val('');
					$('#comcd' + index).val('');
					$(item).attr('title1', '');
				}
				else
				{
					$("#txtValueName" + index).html(data.M05_COM_NAMEN);
					$("#txtValuePrice" + index).html(data.M05_LIST_PRICE);
					$('#nstcd' + index).val(data.M05_NST_CD);
					$('#comcd' + index).val(data.M05_COM_CD);
                    $("#list" + index).val(data.M05_COM_NAMEN);
					$(item).attr('title1', (data.M05_COM_CD + data.M05_NST_CD));
					if (data.M05_COM_CD > 41999 && data.M05_COM_CD < 43000) {
                    $("#warrantyBox").show();
					}
				}

                var count = 0;
                $('.commodityBox.on').each(function () {
                    var value = parseInt($(this).find('.D05_COM_CD').val());
                    if (value > 41999 && value < 43000) {
                        count++;
                    }
                });
                if (count == 0) {
                    $("#warrantyBox").hide();
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
                var option0 = '<option></option>';
                var option1 = '<option></option>';

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

        $('.totalPriceProduct').on('change', function () {
            var total = 0,
                sub_price = isNaN(parseInt($(this).val())) == false ? parseInt($(this).val()) : 0,
                totalHasVat,
                rel = $(this).attr('rel');
            for (var i = 1; i < 11; ++i) {
                if ($('#commodity' + i).hasClass('on')) {
                    sub_price = isNaN(parseInt($("#total_" + i).val())) == false ? parseInt($("#total_" + i).val()) : 0,
                            total = total + sub_price;
                }
            }
            totalHasVat = (total *<?php echo(100 + Yii::$app->params['vat']) ?>) / 100;
            totalHasVat = Math.round(totalHasVat);
            $("#D03_SUM_KINGAKU").val(totalHasVat);
            $("#totalPrice").html(totalHasVat);
            $(".priceProduct[rel="+rel+"]").val('');
        });

        $(".priceProduct,.noProduct").change(function () {
            var index = $(this).attr('rel');
            var total = 0;
            var totalPrice = 0;
            utility.zen2han(this);
            if ($("#no_" + index).val() != null && $("#price_" + index).val() != null) {
                total = $("#no_" + index).val() * parseInt($("#price_" + index).val());
				total = Math.round(total);
                if(isNaN(total))
                    $("#total_" + index).val('0');
                else
                    $("#total_" + index).val(total);
            }
            else {
                $("#total_" + index).val('0');
            }

            for (var i = 1; i < 11; ++i) {
                if ($('#commodity' + i).hasClass('on')) {
                    var sub_total = parseInt($("#total_" + i).val()),
                            totalPrice = totalPrice + sub_total;
                }
            }

            if (parseInt(totalPrice)) {
                var totalHasVat = (totalPrice *<?php echo(100 + Yii::$app->params['vat']) ?>) / 100;
                totalHasVat = Math.round(totalHasVat);
                $("#D03_SUM_KINGAKU").val(totalHasVat);
                $("#totalPrice").html(totalHasVat);
            }
            else{
                $("#totalPrice").html('0');
				$("#D03_SUM_KINGAKU").val('0');
			}
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

            if (!isNaN(totalPrice)) {
                var totalHasVat = (totalPrice *<?php echo(100 + Yii::$app->params['vat']) ?>) / 100;
                totalHasVat = Math.round(totalHasVat);
                $("#D03_SUM_KINGAKU").val(totalHasVat);
                $("#totalPrice").html(totalHasVat);
            }
            else{
                $("#totalPrice").html('0');
				 $("#D03_SUM_KINGAKU").val('0');
			}

            var check = false;
            for (var i = 1; i < 11; ++i) {
                if (parseInt($("#comcd" + i).val()) > 4200 && parseInt($("#comcd" + i).val()) < 43000) {
                    check = true;
                }
            }
            if (check)
                $("#warrantyBox").show();
            else
                $("#warrantyBox").hide();
        });

		$('input[name$=_product]').autocomplete({ minLength: 0 });
		$('.select_product').change(function(){
            if ($(this).val().length == 0) { return; }
			var name = $(this).attr('name');
			if(name == 'left_front_manu' && $("#left_front_product").val() == '' && $("#left_front_size").val() == '' && $("#left_front_serial").val() == '') {
				$("#left_front_product").val($("#right_front_product").val());
				$("#left_front_size").val($("#right_front_size").val());
				$("#left_front_serial").val($("#right_front_serial").val());
			}
			if(name == 'right_behind_manu' && $("#right_behind_product").val() == '' && $("#right_behind_size").val() == '' && $("#right_behind_serial").val() == '') {
				$("#right_behind_product").val($("#right_front_product").val());
				$("#right_behind_size").val($("#right_front_size").val());
				$("#right_behind_serial").val($("#right_front_serial").val());
			}
			if(name == 'left_behind_manu' && $("#left_behind_product").val() == '' && $("#left_behind_size").val() == '' && $("#left_behind_serial").val() == '') {
				$("#left_behind_product").val($("#right_front_product").val());
				$("#left_behind_size").val($("#right_front_size").val());
				$("#left_behind_serial").val($("#right_front_serial").val());
			}
			if(name == 'other_a_manu' && $("#other_a_product").val() == '' && $("#other_a_size").val() == '' && $("#other_a_serial").val() == '') {
				$("#other_a_product").val($("#right_front_product").val());
				$("#other_a_size").val($("#right_front_size").val());
				$("#other_a_serial").val($("#right_front_serial").val());
			}
			if(name == 'other_b_manu' && $("#other_b_product").val() == '' && $("#other_b_size").val() == '' && $("#other_b_serial").val() == '') {
				$("#other_b_product").val($("#right_front_product").val());
				$("#other_b_size").val($("#right_front_size").val());
				$("#other_b_serial").val($("#right_front_serial").val());
			}
			var tire = <?php echo json_encode($item)?>;
			if(name == 'right_front_manu') {
				var items = [];
				if ($(this).val() != '') {
					items = tire[$(this).val()];
				}
				$('input[name=right_front_product]').autocomplete(
					'option', 'source', items
				);
			}
			if(name == 'left_front_manu') {
				var items = [];
				if ($(this).val() != '') {
					items = tire[$(this).val()];
				}
				$('input[name=left_front_product]').autocomplete(
					'option', 'source', items
				);
			}
			if(name == 'right_behind_manu') {
				var items = [];
				if ($(this).val() != '') {
					items = tire[$(this).val()];
				}
				$('input[name=right_behind_product]').autocomplete(
					'option', 'source', items
				);
			}
			if(name == 'left_behind_manu') {
				var items = [];
				if ($(this).val() != '') {
					items = tire[$(this).val()];
				}
				$('input[name=left_behind_product]').autocomplete(
					'option', 'source', items
				);
			}
			if(name=='other_a_manu') {
				var items = [];
				if ($(this).val() != '') {
					items = tire[$(this).val()];
				}
				$('input[name=other_a_product]').autocomplete(
					'option', 'source', items
				);
			}
			if(name == 'other_b_manu') {
				var items = [];
				if ($(this).val() != '') {
					items = tire[$(this).val()];
				}
				$('input[name=other_b_product]').autocomplete(
					'option', 'source', items
				);
			}
		}).trigger('change');

		function onFocus(name){
			$('input[name='+name+']').on('focus', function()
			{
				$(this).autocomplete('search', $(this).val());
			});
		}
		onFocus('right_front_product');
		onFocus('left_front_product');
		onFocus('right_behind_product');
		onFocus('left_behind_product');
		onFocus('other_a_product');
		onFocus('other_b_product');
        $("#agreeFormBtn").click(function () {
            var form = $(this).closest('form'),
                    valid = form.valid();
            if (valid == false) {
                $("#showValidateUpdateCus").show();
				return false;
			}
            if ($("#agreeCheck").val()) {
                utility.showLoading('登録中です');
                $.post('<?php yii\helpers\BaseUrl::base(true) ?>registworkslip/default/cus',
                        {
                            'D01_CUST_NO': $("#modalEditCustomer input[name = D01_CUST_NO]").val(),
                            'D01_CUST_NAMEN': $("#modalEditCustomer input[name = D01_CUST_NAMEN]").val(),
                            'D01_CUST_NAMEK': $("#modalEditCustomer input[name = D01_CUST_NAMEK]").val(),
                            'D01_KAKE_CARD_NO': $("#modalEditCustomer input[name = D01_KAKE_CARD_NO]").val(),
                            'D01_ADDR': $("#modalEditCustomer input[name = D01_ADDR]").val(),
                            'D01_TEL_NO': $("#modalEditCustomer input[name = D01_TEL_NO]").val(),
                            'D01_MOBTEL_NO': $("#modalEditCustomer input[name = D01_MOBTEL_NO]").val(),
                            'D01_NOTE': $("#modalEditCustomer #D01_NOTE").val(),
                            'D01_KAIIN_CD': $("#modalEditCustomer input[name = D01_KAIIN_CD]").val(),
                            'D01_YUBIN_BANGO': $("#modalEditCustomer input[name = D01_YUBIN_BANGO]").val(),
                        },
                        function (data) {
                            if (data.kake_card_no_exist == 1) {
                                $("#updateInfo").html('<div class="alert alert-danger">同じ掛カード番号が既に登録されています。</div>');
                                return;
                            }
                            if (data.result_api == '1' && data.result_db == '1') {
                                $("#updateInfo").html('<div class="alert alert-success">編集が成功しました。</div>');
                                setTimeout(function () {
                                    $("#modalEditCustomer").modal('hide');
                                    if (data.custNo) {
                                        $("#D01_CUST_NO").val(data.custNo);
                                        $("#login_form").attr('action', "<?php echo yii\helpers\BaseUrl::base(true) ?>/regist-workslip?addCust=true&custNo=" + data.custNo)['0'].submit();
                                    }
                                    else{
                                        $("#login_form").attr('action', "<?php echo yii\helpers\BaseUrl::base(true) ?>/regist-workslip?addCust=true")['0'].submit();
										//window.location.reload(true);
									}

                                }, 1000);

                            }
                            else {
                                $("#updateInfo").html('<div class="alert alert-danger">編集が失敗しました。</div>');
                            }
                        }
                );
            }
        });

		$("#modal_car").mouseover(function() {
			if($("#modal_car .tooltip-inner:visible").length == '0' || ($("#modal_car .tooltip-inner:visible").length == '1' && $("#modal_car .tooltip-inner:visible").hasClass('showValidateUpdateCar'))){
				$("#showValidateUpdateCar").hide();
			}
			else
			{
				$("#showValidateUpdateCar").show();
			}
		 });
		$("#modal_customer").mouseover(function() {
		   if($("#modal_customer .tooltip-inner:visible").length == '0' || ($("#modal_customer .tooltip-inner:visible").length == '1' && $("#modal_customer .tooltip-inner:visible").hasClass('showValidateUpdateCus'))){
			   $("#showValidateUpdateCus").hide();
		   }
		   else
		   {
			   $("#showValidateUpdateCus").show();
		   }
		});


        $("#updateCar").click(function () {
            var form = $(this).closest('form'),
                    valid = form.valid();
            if (valid == false){
                $("#showValidateUpdateCar").show();
				return false;
			}
            var arr = [];
            var string;
            for (var j = 1; j < 6; ++j) {
                if ($("#dataCar" + j).hasClass('accOpen')) {
                    string = {
                        'D02_CUST_NO': $("#D01_CUST_NO").val(),
                        'D02_CAR_SEQ': $("#dataCar" + j).find("#D02_CAR_SEQ").val(),
                        'D02_CAR_NAMEN': $("#dataCar" + j).find("#D02_MODEL_CD option:selected").html(),
                        'D02_JIKAI_SHAKEN_YM': $("#dataCar" + j).find("#D02_JIKAI_SHAKEN_YM" + j).val(),
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
                        'MAKER_CD_OTHER': $("#dataCar" + j).find("#D02_CAR_NAMEN_OTHER").val(),
                        'car_makerNamen': $("#dataCar" + j).find("#D02_MAKER_CD option:selected").html(),
                        'D02_MODEL_CD': $("#dataCar" + j).find("#D02_MODEL_CD").val(),
                        'car_modelNamen': $("#dataCar" + j).find("#D02_MODEL_CD option:selected").html(),
                        'D02_SHONENDO_YM': $("#dataCar" + j).find("#D02_SHONENDO_YM" + j).val(),
                        'D02_TYPE_CD': $("#dataCar" + j).find("#D02_TYPE_CD").val(),
                        'car_typeNamen': $("#dataCar" + j).find("#D02_TYPE_CD option:selected").html(),
                        'D02_GRADE_CD': $("#dataCar" + j).find("#D02_GRADE_CD").val(),
                        'car_gradeNamen': $("#dataCar" + j).find("#D02_GRADE_CD option:selected").html(),
                        'dataCarApiField': $("#dataCar" + j).find("#CAR_API_FIELD").val(),
                    };
                    arr.push(string);
                }
            }

            var custNo = $("#D01_CUST_NO").val();
            utility.showLoading('登録中です');
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
                        $("#D01_CUST_NO").val(custNo);
                        $("#login_form").attr('action', "<?php echo yii\helpers\BaseUrl::base(true) ?>/regist-workslip?addCust=true&custNo=" + custNo)['0'].submit();
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
    });

    $('div.checkPrint').parents('td').on('click', function(e)
    {
        if (e.target.tagName == 'P' || e.target.tagName == 'TD') {
            var checkbox = $(this).find('input:checkbox');
            checkbox.prop('checked', checkbox.prop('checked') ? false : true);
        }
    });

    $(function()
    {
        $.fn.autoKana('#autokana-name', '#D01_CUST_NAMEK', { katakana : true });
        $('#autokana-name').on('blur', function(){ $('#D01_CUST_NAMEK').trigger('change'); });

        var carPlaces = <?php echo json_encode($car_places) ?>;
        $('input:text[name^=D02_RIKUUN_NAMEN]').autocomplete({ minLength: 0 });
        $('input:text[name^=D02_RIKUUN_NAMEN]').on('focus', function()
        {
            $(this).autocomplete('search', $(this).val());
        });
        $('select[name=prefecture]').on('change', function()
        {
            var items = [];
            if ($(this).val() != '') {
                items = carPlaces[$(this).val()];
            }

            var select = $(this).parents('div.formGroup:first').find('select[name^=D02_RIKUUN_NAMEN]');
            select.find('option[value!=""]').remove();

            for (var i=0;i<items.length;i++) {
                select.append(
                    $('<option></option>').attr('value', items[i]).text(items[i])
                );
            }

            if (items.length == 1) {
                select.find('option:last').prop('selected', true);
            }
        });

        $('select[name^=D02_RIKUUN_NAMEN]').each(function()
        {
            var inputPlace = $(this).val();
            if (inputPlace.length == 0) {
                return;
            }

            for (var prefecture in carPlaces) {
                for (var i=0;i<carPlaces[prefecture].length;i++) {
                    if (carPlaces[prefecture][i] == inputPlace) {
                        $(this).parents('div.formGroup:first').find('select[name=prefecture]').val(prefecture);
                        return;
                    }
                }
            }
        });

    });
</script>
<script type="text/javascript">
<?php
if ($d03DenNo && file_exists('data/pdf/' . $d03DenNo . '.pdf')) {
    ?>
        $(function () {
            $("#warrantyBox").find("input,select").addClass('no_event');
        });
<?php } ?>
</script>

<script src="<?php echo \yii\helpers\BaseUrl::base(true) ?>/js/module/registwork.js?030401"></script>