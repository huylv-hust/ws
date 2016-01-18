<?php
    use yii\helpers\Html;

?>
<main id="contents">
  <section class="readme">
    <h2 class="titleContent">作業伝票作成</h2>
    <p class="rightside">受付日 2015年11月18日</p>
  </section>
	<?php
		use yii\widgets\ActiveForm;
		$form = ActiveForm::begin([
				'id' => 'login-form',
				'action'=>'/detail-workslip.html',
				'options' => ['class' => 'form-horizontal'],
				])
	?>
	<article class="container">
	<p class="note">項目を入力してください。<span class="must">*</span>は必須入力項目です。<br>
      商品情報にタイヤを追加すると、保証書作成用の入力フォームが表示されます。
	</p>
    <section class="bgContent">
      <fieldset class="fieldsetRegist">
        <div class="formGroup">
          <div class="formItem">
            <label class="titleLabel">受付担当者(SDP_TM08_SAGYOSYA)<span class="must">*</span></label>
            <?= \yii\helpers\Html::dropDownList('M08_SS_CD',0,$ssUer,array('class' => 'selectForm', 'id' => 'M08_SS_CD')) ?>
          </div>
          <div class="formItem">
            <label class="titleLabel">SSコード<span class="must">*</span></label>
            <input type="text" maxlength="6" id="member_ssCode" value="<?=$cus['D01_SS_CD']?>" class="textForm">
          </div>
        </div>
      </fieldset>
    </section>
    <section class="bgContent">
      <fieldset class="fieldsetRegist">
        <div class="flexHead">
          <legend class="titleLegend">お客様情報</legend>
          <a data-toggle="modal" class="onModal" href="#modalEditCustomer">編集</a> </div>
        <div class="formGroup">
          <div class="formItem">
            <label class="titleLabel">お名前</label>
            <p class="txtValue"><?=$cus['D01_CUST_NAMEN']?></p>
          </div>
          <div class="formItem">
            <label class="titleLabel">フリガナ</label>
            <p class="txtValue"><?=$cus['D01_CUST_NAMEK']?></p>
          </div>
        </div>
        <div class="formGroup">
          <div class="formItem">
            <label class="titleLabel">備考</label>
            <p></p>
          </div>
        </div>
      </fieldset>
    </section>
    <section class="bgContent">
      <fieldset class="fieldsetRegist">
        <div class="flexHead">
          <legend class="titleLegend">車両情報</legend>
          <a data-toggle="modal" onclick="showSeqCar()" class="onModal" href="#modalEditCar">編集</a>
		</div>
        <div class="formGroup">
          <div class="formItem">
            <label class="titleLabel">今回メンテナンスする車両</label>
            <select class="selectForm" name="D02_CAR_SEQ" id="D02_CAR_SEQ">
              <?php
				$carOrigin = $car;
				$selected = 1;
				if(isset($carOrigin['denpyo']))
				{
					unset($carOrigin['denpyo']);
					$selected = $car['denpyo']['D02_CAR_SEQ'];
				}
				$countCar = count($carOrigin);
				for($i = 1 ; $i < $countCar + 1; ++$i){
					if($i == $selected)
						echo '<option selected="selected" value="'.($i).'">'.str_pad($i,4,'0',STR_PAD_LEFT).'</option>';
					else
						echo '<option value="'.($i).'">'.str_pad($i,4,'0',STR_PAD_LEFT).'</option>';
				}
			  ?>
            </select>
		  </div>
			<script type="text/javascript">
				$(function(){
					var carSeq = $("#D02_CAR_SEQ").val();
					$(".carDataBasic").removeClass('show').addClass('hide');
					$(".carDataBasic"+carSeq).removeClass('hidd').addClass('show');
				})
				function showSeqCar(){
					var carSeq = $("#D02_CAR_SEQ").val();
					$("section").removeClass('accOpen').addClass('accClose');
					$("#dataCar"+carSeq).removeClass('accClose').addClass('accOpen');
				}
				$("#D02_CAR_SEQ").on('change',function(){
					var carSeq = $("#D02_CAR_SEQ").val();
					$(".carDataBasic").removeClass('show').addClass('hide');
					$(".carDataBasic"+carSeq).removeClass('hidd').addClass('show');
				})

			</script>
		  <?php
		  $k=1;
		  $denpyo['denpyo'] = [];
		  $carData = $carOrigin;
		  if(isset($car['denpyo']))
		  {
			$carData = [];
			$denpyo['denpyo']= $car['denpyo'];
			foreach($carOrigin as $tmp)
			{
				if($car['denpyo']['D02_CAR_SEQ'] != $tmp['D02_CAR_SEQ'])
				{
					$carData[] = $tmp;
				}
			}

			$carData = array_merge($denpyo,$carData);
		  }
		  foreach($carData as $key => $carFirst)
		  {
			  ?>
			    <div class="formItem carDataBasic carDataBasic<?=$k?>" >
				 <label class="titleLabel">車名</label>
				 <p class="txtValue"><?=$carFirst['D02_CAR_NAMEN']?></p>
			   </div>
			   <div class="formItem carDataBasic carDataBasic<?=$k?>">
				 <label class="titleLabel">車検満了日</label>
				 <p class="txtValue"><?php echo substr($carFirst['D02_JIKAI_SHAKEN_YM'],0,4).'年'.substr($carFirst['D02_JIKAI_SHAKEN_YM'],4,2).'月'.substr($carFirst['D02_JIKAI_SHAKEN_YM'],6,2) ?></p>
			   </div>
			   <div class="formItem carDataBasic carDataBasic<?=$k?>">
				 <label class="titleLabel">走行距離</label>
				 <p class="txtValue"><?=$carFirst['D02_METER_KM']?></p>
			   </div>
			   <div class="formItem carDataBasic carDataBasic<?=$k?>">
				 <label class="titleLabel">運輸支局</label>
				 <p class="txtValue"><?=$carFirst['D02_RIKUUN_NAMEN']?></p>
			   </div>
			   <div class="formItem carDataBasic carDataBasic<?=$k?>">
				 <label class="titleLabel">分類コード</label>
				 <p class="txtValue"><?=$carFirst['D02_CAR_ID']?></p>
			   </div>
			   <div class="formItem carDataBasic carDataBasic<?=$k?>">
				 <label class="titleLabel">ひらがな</label>
				 <p class="txtValue"><?=@$carFirst['D02_HIRA']?></p>
			   </div>
			   <div class="formItem carDataBasic carDataBasic<?=$k?>">
				 <label class="titleLabel">登録番号</label>
				 <p class="txtValue"><?=$carFirst['D02_CAR_NO']?></p>
			   </div>
		  <?php ++$k;}?>
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
                <label class="labelRadios<?php if($denpyo['denpyo']['D02_KITYOHIN'] == 1) echo ' checked'?>" for="valuables1">有り</label>
              </div>
              <div class="radioItem">
				  <input type="radio" name="D03_KITYOHIN" value="0" id="valuables2" class="radios">
                <label class="labelRadios<?php if($denpyo['denpyo']['D02_KITYOHIN'] == 0) echo ' checked'?>" for="valuables2">無し</label>
              </div>
            </div>

          </div>
			<!-- BEGIN PAY -->
				<div class="formItem">
				  <label class="titleLabel">お客様確認</label>
				  <div class="checkGroup">
					<div class="checkItem">
					  <input type="checkbox" name="D03_KAKUNIN" value="1" <?php if($denpyo['denpyo']['D02_KAKUNIN'] == 1) echo 'checked="checked"'?> id="agree1" class="checks">
					  <label class="labelSingleCheck" for="agree1">了解済OK</label>
					</div>
				  </div>
				</div>
				<div class="formItem">
				  <label class="titleLabel">精算方法</label>
				  <div class="radioGroup">
					<div class="radioItem">
					  <input type="radio" value="1" name="D03_SEISAN" id="pays1" class="radios">
					  <label class="labelRadios <?php if($denpyo['denpyo']['D02_SEISAN'] == 0) echo ' checked' ?>" for="pays1">現金</label>
					</div>
					<div class="radioItem">
					  <input type="radio" name="D03_SEISAN" value="2" id="pays2" class="radios">
					  <label class="labelRadios<?php if($denpyo['denpyo']['D02_SEISAN'] == 1) echo ' checked' ?>" for="pays2">プリカ</label>
					</div>
					<div class="radioItem">
					  <input type="radio" name="D03_SEISAN"  value="3" id="pays3" class="radios">
					  <label class="labelRadios<?php if($denpyo['denpyo']['D02_SEISAN'] == 2) echo ' checked' ?>" for="pays3">クレジット</label>
					</div>
					<div class="radioItem">
					  <input type="radio" name="D03_SEISAN" value="4" id="pays4" class="radios">
					  <label class="labelRadios<?php if($denpyo['denpyo']['D02_SEISAN'] == 3) echo ' checked' ?>" for="pays4">掛</label>
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
            <input type="text" value="<?=$denpyo['denpyo']['D02_SEKOU_YMD']?>" name="D03_SEKOU_YMD" class="textForm">
            <span class="txtExample">例)2013年1月30日→20130130</span> </div>
          <div class="formItem">
            <label class="titleLabel">お預かり時間</label>
            <select class="selectForm" name="D03_AZU_BEGIN_HH">

              <?php
			  for($i = 0 ; $i < 24; ++$i){
				  if($i == (int)$denpyo['denpyo']['D02_AZU_BEGIN_HH']) {
			  ?>
			  <option selected="selected" value="<?=$i?>"><?php echo str_pad($i,2,'0',STR_PAD_LEFT)?></option>
				  <?php  } else{?>
			   <option  value="<?=$i?>"><?php echo str_pad($i,2,'0',STR_PAD_LEFT)?></option>
				  <?php }}?>

            </select>
            <span class="txtUnit">：</span>
            <select class="selectForm" name="D03_AZU_BEGIN_MI">
                <?php
			  for($i = 0 ; $i < 60; $i = $i + 10){
				  if($i == (int)$denpyo['denpyo']['D02_AZU_BEGIN_MI']) {
			  ?>
			  <option selected="selected" value="<?=$i?>"><?php echo str_pad($i,2,'0',STR_PAD_LEFT)?></option>
				  <?php  } else{?>
			   <option  value="<?=$i?>"><?php echo str_pad($i,2,'0',STR_PAD_LEFT)?></option>
				  <?php }}?>
            </select>
            <span class="txtUnit">〜</span>
            <select class="selectForm" name="D03_AZU_END_HH">
             <?php
			  for($i = 0 ; $i < 24; ++$i){
				  if($i == (int)$denpyo['denpyo']['D02_AZU_END_HH']) {
			  ?>
			  <option selected="selected" value="<?=$i?>"><?php echo str_pad($i,2,'0',STR_PAD_LEFT)?></option>
				  <?php  } else{?>
			   <option  value="<?=$i?>"><?php echo str_pad($i,2,'0',STR_PAD_LEFT)?></option>
				  <?php }}?>
            </select>
            <span class="txtUnit">：</span>
            <select class="selectForm" name="D03_AZU_END_MI">
               <?php
			  for($i = 0 ; $i < 60; $i = $i + 10){
				  if($i == (int)$denpyo['denpyo']['D02_AZU_END_MI']) {
			  ?>
			  <option selected="selected" value="<?=$i?>"><?php echo str_pad($i,2,'0',STR_PAD_LEFT)?></option>
				  <?php  } else{?>
			   <option  value="<?=$i?>"><?php echo str_pad($i,2,'0',STR_PAD_LEFT)?></option>
				  <?php }}?>
            </select>
          </div>
        </div>
        <div class="formGroup">
          <div class="formItem">
            <label class="titleLabel">予約内容</label>
			<?= \yii\helpers\Html::dropDownList('D03_YOYAKU_SAGYO_NO',$denpyo['denpyo']['D02_YOYAKU_SAGYO_NO'],  Yii::$app->params['d03YoyakuSagyoNo'],array('class' => 'selectForm', 'id' => 'D03_YOYAKU_SAGYO_NO')) ?>
          </div>
          <div class="formItem">
            <label class="titleLabel">作業者</label>
            <?= \yii\helpers\Html::dropDownList('D03_TANTO_SEI.D03_TANTO_MEI',0,$ssUer,array('class' => 'selectForm', 'id' => 'D03_TANTO_SEI.D03_TANTO_MEI')) ?>
          </div>
          <div class="formItem">
            <label class="titleLabel">確認者</label>
             <?= \yii\helpers\Html::dropDownList('D03_KAKUNIN_SEI.D03_KAKUNIN_MEI',0,$ssUer,array('class' => 'selectForm', 'id' => 'M08_SS_CD')) ?>
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
            <?php $k = 1; foreach($tm01Sagyo as $work) {?>
			<div class="checkItem">
                <input type="checkbox" name="M01_SAGYO_NO[]" id="workDetai<?=$k?>" value="<?=$work['M01_SAGYO_NO']?>" class="checks">
                <label class="labelChecks" for="workDetail<?=$k?>"><?=$work['M01_SAGYO_NAMEN']?></label>
            </div>
			<?php ++$k;} ?>
            </div>
          </div>
        </div>
        <div class="formGroup">
          <div class="formItem">
            <label class="titleLabel">その他作業内容</label>
            <textarea class="textarea" name="D03_SAGYO_OTHER"><?=$denpyo['denpyo']['D02_SAGYO_OTHER']?></textarea>
          </div>
        </div>
      </fieldset>
    </section>
    <section class="bgContent" id="bgContentProduct">
      <fieldset class="fieldsetRegist">
        <a class="addCommodity" href="#">追加</a>
        <legend class="titleLegend">商品情報</legend>
        <?php for($k = 1; $k < 12; ++$k) { ?>
		<div id="commodity<?=$k?>" class="commodityBox<?php if($k ==1) echo ' on' ?>"><?php if($k > 1) { ?><a class="removeCommodity" href="#">削除</a><?php } ?>
			<input name="kind<?=$k?>" id="kind<?=$k?>" type="hidden" value="" />
			<input name="large<?=$k?>" id="large<?=$k?>" type="hidden" value="" />
			<div class="formGroup">
            <div class="formItem">
              <label class="titleLabel">商品・荷姿コード</label>
              <input rel="<?=$k?>" type="text" name="code_search<?=$k?>" id="code_search<?=$k?>" maxlength="9" value="" class="textForm codeSearchProduct">
              <a onclick="codeSearch(<?=$k?>);" class="btnFormTool" style="cursor: pointer" rel="<?=$k?>">コード一覧から選択</a> </div>
            <div class="formItem">
              <label class="titleLabel">品名</label>
              <p class="txtValue" id="txtValueName<?=$k?>"></p>
            </div>
            <div class="formItem">
              <label class="titleLabel">参考価格</label>
              <p class="txtValue" id="txtValuePrice<?=$k?>"></p>
            </div>
          </div>
          <div class="formGroup">
            <div class="formItem">
              <label class="titleLabel">数量</label>
              <input type="text" value="" name="no_<?=$k?>" rel="<?=$k?>" id="no_<?=$k?>" class="textForm noProduct">
            </div>
            <div class="formItem">
              <label class="titleLabel">単価</label>
              <input type="text" name="price_<?=$k?>" rel="<?=$k?>" id="price_<?=$k?>" value="" class="textForm priceProduct">
              <span class="txtUnit">円</span> </div>
            <div class="formItem">
              <label class="titleLabel">金額</label>
              <input type="text" name="total_<?=$k?>" rel="<?=$k?>" id="total_<?=$k?>" readonly="" value="" class="textForm">
              <span class="txtUnit">円</span> </div>
          </div>
        </div>
		<input type="hidden" name="indexSearch" rel="<?=$k?>" id="indexSearch<?=$k?>" value="<?=$k?>">
		<?php } ?>

        <div class="formGroup lineTop">
          <div class="flexRight">
            <label class="titleLabelTotal">合計金額</label>
            <p class="txtValue"><strong class="totalPrice" id="totalPrice"><?=$denpyo['denpyo']['D02_SUM_KINGAKU']?></strong><span class="txtUnit">円</span></p>
          </div>
        </div>
      </fieldset>
    </section>
	<!-- BEGIN BAOHANH -->
    <section id="warrantyBox" class="bgContent">
      <fieldset class="fieldsetRegist">
        <legend class="titleLegend">保証書情報</legend>
        <div class="formGroup">
          <div class="formItem">
            <label class="titleLabel">保証書作成</label>
            <div class="checkGroup">
              <div class="checkItem">
                <input type="checkbox" name="warranty[]" id="checkWarranty" class="checks">
                <label class="labelSingleCheck" for="checkWarranty">保証書を作成する</label>
              </div>
            </div>
          </div>
          <div class="formItem">
            <label class="titleLabel">保証書番号</label>
            <p class="txtValue toggleWarranty"><?=$tm09WarrantyNo['M09_SS_CD'].str_pad($tm09WarrantyNo['M09_WARRANTY_NO'],4,'0',STR_PAD_LEFT)?></p>
          </div>
          <div class="formItem">
            <label class="titleLabel">購入日</label>
            <p class="txtValue toggleWarranty"><?=date('Y年m月d日')?></p>
          </div>
          <div class="formItem">
            <label class="titleLabel">保証期間</label>
            <p class="txtValue toggleWarranty" id="toggleWarranty"></p>
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
        <?php for($i = 1; $i < 5; ++$i) {?>
		<div class="formGroup lineBottom">
          <div class="formItem">
            <p class="txtValue">右前</p>
          </div>
          <div class="formItem">
            <select class="selectForm">
              <option value=""></option>
              <option selected="" value="BS">BS</option>
              <option value="YH">YH</option>
              <option value="DF">DF</option>
              <option value="TY">TY</option>
            </select>
          </div>
          <div class="formItem">
            <input type="text" value="" class="textForm">
          </div>
          <div class="formItem">
            <input type="text" value="" class="textForm">
          </div>
          <div class="formItem">
            <input type="text" value="" class="textForm">
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
            <select class="selectForm">
              <option selected="" value=""></option>
              <option value="BS">BS</option>
              <option value="YH">YH</option>
              <option value="DF">DF</option>
              <option value="TY">TY</option>
            </select>
          </div>
          <div class="formItem">
            <input type="text" value="" class="textForm">
          </div>
          <div class="formItem">
            <input type="text" value="" class="textForm">
          </div>
          <div class="formItem">
            <input type="text" value="" class="textForm">
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
            <select class="selectForm">
              <option selected="" value=""></option>
              <option value="BS">BS</option>
              <option value="YH">YH</option>
              <option value="DF">DF</option>
              <option value="TY">TY</option>
            </select>
          </div>
          <div class="formItem">
            <input type="text" value="" class="textForm">
          </div>
          <div class="formItem">
            <input type="text" value="" class="textForm">
          </div>
          <div class="formItem">
            <input type="text" value="" class="textForm">
          </div>
          <div class="formItem">
            <p class="txtValue"><!-- 1 --></p>
          </div>
        </div>
      </fieldset>
    </section>
	<!-- END BAOHANH -->
    <section class="bgContent">
      <fieldset class="fieldsetRegist">
        <legend class="titleLegend">その他</legend>
        <div class="formGroup">
          <div class="formItem">
            <label class="titleLabel">POS伝票番号</label>
            <textarea class="textarea" nam="D03_POS_DEN_NO"><?=$denpyo['denpyo']['D02_POS_DEN_NO']?></textarea>
          </div>
          <div class="formItem">
            <label class="titleLabel">備考</label>
            <textarea class="textarea" name="D03_NOTE"><?=$denpyo['denpyo']['D02_NOTE']?></textarea>
          </div>
        </div>
      </fieldset>
    </section>
  </article>
</main>
<footer id="footer">
	<div class="toolbar">
	<a class="btnBack" href="menu.html">戻る</a>
	<a class="btnSubmit" data-toggle="modal" href="#modalRegistConfirm">登録</a>
	</div>
	<p class="copyright">Copyright(C) Usami Koyu Corp. All Rights Reserved.</p>
</footer>
<div class="sidr left" id="sidr">
  <div class="closeSideMenu"><a id="sidrClose" href="#">Close</a></div>
  <ul>
    <li><a href="menu.html">SSサポートサイトTOP</a></li>
  </ul>
</div>
<div class="sidr left" id="sidr">
  <div class="closeSideMenu"><a id="sidrClose" href="#">Close</a></div>
  <ul>
    <li><a href="menu.html">SSサポートサイトTOP</a></li>
  </ul>
</div>

<!-- BEGIN InfoCus -->
<div id="modalEditCustomer" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">お客様情報登録</h4>
      </div>
      <div class="modal-body">
		  <div id="updateInfo"></div>
        <p class="note">項目を入力してください。<span class="must">*</span>は必須入力項目です。</p>
        <section class="bgContent">
		<input type="hidden" value="<?=$cus['D01_KAIIN_CD']?>" name="D01_KAIIN_CD">
		<fieldset class="fieldsetRegist">
            <legend class="titleLegend">お客様情報</legend>
            <div class="formGroup">
              <div class="formItem">
                <label class="titleLabel">お名前<span class="must">*</span></label>
                <input type="text" value="<?=$cus['D01_CUST_NAMEN']?>" class="textForm" name="D01_CUST_NAMEN">
              </div>
              <div class="formItem">
                <label class="titleLabel">フリガナ<span class="must">*</span></label>
                <input type="text" value="<?=$cus['D01_CUST_NAMEK']?>" name="D01_CUST_NAMEK" class="textForm">
              </div>
              <div class="formItem">
                <label class="titleLabel">掛カード</label>
                <input type="text" value="<?=trim($cus['D01_KAKE_CARD_NO'])?>" name="D01_KAKE_CARD_NO" id="D01_KAKE_CARD_NO" class="textForm">
              </div>
            </div>
            <div class="formGroup">
              <div class="formItem">
                <label class="titleLabel">郵便番号</label>
                <input type="text" value="1400002" name="D01_YUBIN_BANGO" class="textForm">
                <a class="btnFormTool" href="#">住所検索</a> </div>
              <div class="formItem">
                <label class="titleLabel">ご住所</label>
                <input type="text" value="<?=$cus['D01_ADDR']?>" name="D01_ADDR" id="D01_ADDR" class="textForm">
              </div>
            </div>
            <div class="formGroup">
              <div class="formItem">
                <label class="titleLabel">電話番号</label>
                <input type="text" value="<?=$cus['D01_TEL_NO']?>" name="D01_TEL_NO" id="D01_TEL_NO" class="textForm">
              </div>
              <div class="formItem">
                <label class="titleLabel">携帯電話番号</label>
                <input type="text" value="<?=$cus['D01_MOBTEL_NO']?>" id="D01_MOBTEL_NO" name="D01_MOBTEL_NO" class="textForm">
              </div>
            </div>
            <div class="formGroup">
              <div class="formItem">
                <label class="titleLabel">備考</label>
                <textarea class="textarea" name="D01_NOTE" id="D01_NOTE"><?=$cus['D01_NOTE']?></textarea>
              </div>
            </div>
            <div class="formGroup">
              <div class="formItem">
                <label class="titleLabel">約款・個人情報は、以下のリンクよりご確認ください。</label>
                <div class="checkGroup">
                  <div class="checkItem">
					  <input type="checkbox" onchange="agreeForm();" name="agreeCheck" id="agreeCheck"  value="1" class="checks">
                    <label class="labelSingleCheck" for="agreeCheck"><a target="_blank" href="https://verify-ups.com/sss/pdf/PrivacyPolicy.pdf">プライバシーポリシー</a>に同意する</label>
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
    </div>
  </div>
</div>
<!-- END InfoCus -->
<!-- BEGIN InfoCar -->
<div id="modalEditCar" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">車両情報登録</h4>
      </div>
      <div class="modal-body">
        <p class="note">項目を入力してください。<span class="must">*</span>は必須入力項目です。</p>
		<?php  use backend\components\Api; ?>
		<?php
		$k = 1;
		foreach($carOrigin as $carFirst) {
			if($k != 1)
				$class = 'accordion accClose';
			else
				$class = 'accordion accOpen';
		?>
		<section class="bgContent dataCar<?=$k?> <?=$class?>" id="dataCar<?=$k?>">
          <fieldset class="fieldsetRegist">
			<div class="accordionHead">
				<legend class="titleLegend"><?=$k?>台目</legend>
				<a class="toggleAccordion" href="#">削除</a>
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
					  foreach($maker as $mak)
					  {
						  $list_maker[$mak['maker_code']] = $mak['maker'];
					  }

					  $list_model = ['0' => 'ジープ・ラングラーアンリミテッド'];
					  if($carFirst['D02_MAKER_CD'])
					  {
						  $model = $api->getListModel($carFirst['D02_MAKER_CD']);
						  foreach($model as $mod)
						  {
							  $list_model[$mod['model_code']] = $mod['model'];
						  }
					  }
					  if($carFirst['D02_MODEL_CD'])
					  {
						  $list_year = ['0' => ''];
						  $year = $api->getListYearMonth($carFirst['D02_MAKER_CD'],$carFirst['D02_MODEL_CD']);
						  foreach($year as $y)
						  {
							  $list_year[$y['year']] = $y['year'];
						  }

						  if($carFirst['D02_SHONENDO_YM'])
						  {
							  $type = $api->getListTypeCode($carFirst['D02_MAKER_CD'],$carFirst['D02_MODEL_CD'],substr($carFirst['D02_SHONENDO_YM'],0,4));
							  foreach($type as $tp)
							  {
								  $list_type[$tp['type_code']] = $tp['type'];
							  }
						  }

						  if($carFirst['D02_TYPE_CD'])
						  {
							  $grade = $api->getListGradeCode($carFirst['D02_MAKER_CD'],$carFirst['D02_MODEL_CD'],substr($carFirst['D02_SHONENDO_YM'],0,4),$carFirst['D02_TYPE_CD']);
							  foreach($grade as $gra) {
								  $list_grade[$gra['grade_code']] = $gra['grade'];
							  }
						  }
					  }
					  ?>
					  <?= \yii\helpers\Html::dropDownList('D02_MAKER_CD',$carFirst['D02_MAKER_CD'],$list_maker,array('class' => 'selectForm', 'id' => 'D02_MAKER_CD')) ?>
					<span class="txtExample">例)トヨタ</span></div>
				  <div class="formItem">
					<label class="titleLabel">車名<span class="must">*</span></label>
					 <?= \yii\helpers\Html::dropDownList('D02_MODEL_CD',$carFirst['D02_MODEL_CD'],$list_model,array('class' => 'selectForm', 'id' => 'D02_MODEL_CD')) ?>
					<span class="txtExample">例)プリウス</span></div>
				</div>
				<div class="formGroup">
				  <div class="formItem">
					<label class="titleLabel">初年度登録年月</label>
					<input type="text" name="D02_SHONENDO_YM" value="<?=$carFirst['D02_SHONENDO_YM']?>" class="textForm">
					<span class="txtExample">例)2013年1月→201301</span></div>
				  <div class="formItem">
					<label class="titleLabel">型式</label>
					<?= \yii\helpers\Html::dropDownList('D02_TYPE_CD',$carFirst['D02_TYPE_CD'],$list_type,array('class' => 'selectForm', 'id' => 'D02_TYPE_CD')) ?>
				  </div>
				  <div class="formItem">
					<label class="titleLabel">グレード</label>
					<?= \yii\helpers\Html::dropDownList('D02_GRADE_CD',$carFirst['D02_GRADE_CD'],$list_grade,array('class' => 'selectForm', 'id' => 'D02_GRADE_CD')) ?>
				  </div>
				</div>
				<div class="formGroup">
				  <div class="formItem">
					<label class="titleLabel">車検満了日</label>
					<input type="text" value="20130131" class="textForm">
					<span class="txtExample">例)2013年1月31日→20130131</span></div>
				  <div class="formItem">
					<label class="titleLabel">走行距離<span class="must">*</span></label>
					<input type="text" value="<?=$carFirst['D02_METER_KM']?>" name="D02_METER_KM" id="D02_METER_KM" class="textForm formWidthXS">
					<span class="txtUnit">km</span> </div>
				  <div class="formItem">
					<label class="titleLabel">車検サイクル<span class="must">*</span></label>
					<?= \yii\helpers\Html::dropDownList('D02_SYAKEN_CYCLE',$carFirst['D02_SYAKEN_CYCLE'],  Yii::$app->params['d02SyakenCycle'],array('class' => 'selectForm', 'id' => 'list_grade')) ?>
					<span class="txtUnit">年</span> </div>
				</div>
				<div class="formGroup">
				  <div class="formItem">
					<label class="titleLabel">運輸支局<span class="must">*</span></label>
					<input type="text" value="<?=$carFirst['D02_RIKUUN_NAMEN']?>" id="D02_RIKUUN_NAMEN" class="textForm">
					<span class="txtExample">例)名古屋</span></div>
				  <div class="formItem">
					<label class="titleLabel">分類コード<span class="must">*</span></label>
					<input type="text" value="<?=$carFirst['D02_CAR_ID']?>" name="D02_CAR_ID" id="D02_CAR_ID" class="textForm formWidthXS">
					<span class="txtExample">例)330</span> </div>
				  <div class="formItem">
					<label class="titleLabel">ひらがな<span class="must">*</span></label>
					<input type="text" value="<?=@$carFirst['D02_HIRA']?>" name="D02_HIRA" id="D02_HIRA" class="textForm formWidthXXS">
					<span class="txtExample">例)あ</span> </div>
				  <div class="formItem">
					<label class="titleLabel">登録番号<span class="must">*</span></label>
					<input type="text" value="<?=$carFirst['D02_CAR_NO']?>" name="D02_CAR_NO" id="D02_CAR_NO" class="textForm formWidthXS">
					<span class="txtExample">例)0301</span> </div>
				</div>
			</div>
		  </fieldset>
        </section>
		<?php ++$k;} ?>
      </div>
      <div class="modal-footer"> <a class="btnSubmit" href="#">登録する</a> </div>
    </div>
  </div>
</div>
<!-- END InfoCar -->
<!-- BEGIN CodeSearchProduct -->
<div id="modalCodeSearch" class="modal fade ">
  <div class="modal-dialog widthS">
    <div class="modal-content">
      <div class="modal-header">
        <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
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
                    <input type="radio" name="search_M05_COM_CD" checked="checked" id="search_M05_COM_CD" class="radios">
                    <label class="labelRadios checked" for="valuables1">商品コード</label>
                  </div>
                  <div class="radioItem">
                    <input type="radio" name="search_M05_NST_CD" id="search_M05_NST_CD" class="radios">
                    <label class="labelRadios" for="valuables2">荷姿コード</label>
                  </div>
                  <div class="radioItem">
                    <input type="radio" name="search_M05_COM_NAMEN" id="search_M05_COM_NAMEN" class="radios">
                    <label class="labelRadios" for="valuables2">品名</label>
                  </div>
                </div>
                <div class="itemFlex">
                  <input type="text" style="width:15em;" value="" class="textForm">
                  <a class="btnFormTool" href="#">検索する</a></div>
              </div>
            </div>
          </section>
        </form>
		<?php use yii\data\Pagination; ?>
        <nav class="paging">
          <ul class="ulPaging">
            <?php echo yii\widgets\LinkPager::widget(['pagination' =>$pagination])?>
          </ul>
        </nav>
		<input type="hidden" value="" id="searchProduct" />
        <table class="tableList">
          <tbody><tr>
            <th></th>
            <th>商品コード</th>
            <th>荷姿コード</th>
            <th>品名</th>
          </tr>

		  <?php foreach($tm05Com as $product){ ?>
          <tr>
			<td><input type="radio" name="M05_COM_CD.M05_NST_CD" onclick="setValue('<?=$product['M05_COM_CD'].$product['M05_NST_CD']?>')" value="<?=$product['M05_COM_CD'].$product['M05_NST_CD']?>"></td>
            <td><?=$product['M05_COM_CD']?></td>
            <td><?=$product['M05_NST_CD']?></td>
            <td><?=$product['M05_COM_NAMEN']?></td>
			<input type="hidden" value="<?=$product['M05_COM_NAMEN']?>" id="name<?=$product['M05_COM_CD'].$product['M05_NST_CD']?>" />
			<input type="hidden" value="<?=$product['M05_LIST_PRICE']?>" id="price<?=$product['M05_COM_CD'].$product['M05_NST_CD']?>" />
			<input type="hidden" value="<?=$product['M05_KIND_COM_NO']?>" id="kind<?=$product['M05_COM_CD'].$product['M05_NST_CD']?>" />
			<input type="hidden" value="<?=$product['M05_LARGE_COM_NO']?>" id="large<?=$product['M05_COM_CD'].$product['M05_NST_CD']?>" />
          </tr>
		  <?php }?>
        </tbody></table>
        <nav class="paging">
          <ul class="ulPaging">
			<?php echo yii\widgets\LinkPager::widget(['pagination' =>$pagination])?>
          </ul>
        </nav>
      </div>
		<div class="modal-footer"> <a class="btnSubmit" style="cursor: pointer" onclick="closePop()">選択する</a> </div>
    </div>
  </div>
</div>
<div id="modalRegistConfirm" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">作業伝票作成</h4>
      </div>
      <div class="modal-body">
        <p class="note">入力した内容で作業伝票を作成します。よろしいですか？</p>
      </div>
      <div class="modal-footer"> <a aria-label="Close" data-dismiss="modal" class="btnCancel flLeft" href="#">いいえ</a> <a class="btnSubmit flRight" href="detail-workslip.html">はい</a> </div>
    </div>
  </div>
</div>
<!-- END CodeSearchProduct -->

<?php ActiveForm::end() ?>
<script type="text/javascript">
function closePop(){

	$("#modalCodeSearch").modal('hide');
}
$('.btnFormTool').click(function(){$("#searchProduct").val($(this).attr('rel'));});
function setValue(m05ComCD){
	var index = $("#searchProduct").val();
	$("#txtValueName"+index).html($("#name"+m05ComCD).val());
	$("#txtValuePrice"+index).html($("#price"+m05ComCD).val());
	$('#kind'+index).val($("#kind"+m05ComCD).val());
	$('#large'+index).val($("#large"+m05ComCD).val());
	$.post('<?php yii\helpers\BaseUrl::base(true)?>registworkslip/default/largecom',
		{
			'M05_KIND_COM_NO':$('#kind'+index).val(),
			'M05_LARGE_COM_NO':$('#large'+index).val(),
		},
		function(data){
			$("#toggleWarranty").html(data.M03_HOZON_KIKAN);
		}
	);
}
$(function(){
	$( ".codeSearchProduct" ).change(function(){
			var index = $(this).attr('rel');
			var code = $("#code_search"+index).val();
			if(code.length < 9) return;
			$.post('<?php yii\helpers\BaseUrl::base(true)?>registworkslip/default/search',
				{
					'code':$("#code_search"+index).val()
				},
				function(data){
					$("#txtValueName"+index).html(data.M05_COM_NAMEN);
					$("#txtValuePrice"+index).html(data.M05_LIST_PRICE);
				}
			);
		}
	);
	$("#member_ssCode").change(function(){
		var member_ssCode = $("#member_ssCode").val();
		if(member_ssCode.length != '6') {
			return;
		}
		$.post('<?php yii\helpers\BaseUrl::base(true)?>registworkslip/default/ss',
			{
				'ssCode':member_ssCode
			},
			function(data){
				var option = '';
				$.each(data, function(key, value){
					option += '<option value="' + key + '">' + value + '</option>';
				});
				$("#M08_SS_CD").html(option);
			}
		);
	});

	$(".priceProduct,.noProduct").change(function(){
		var index = $(this).attr('rel');
		var total = 0;
		var totalPrice = 0;

		if($("#no_"+index).val() !=null && $("#price_"+index).val() !=null && Number.isInteger(parseInt($("#no_"+index).val())) && Number.isInteger(parseInt($("#price_"+index).val())))
		{
			total = parseInt($("#no_"+index).val()) * parseInt($("#price_"+index).val());
			if(Number.isInteger(total))
			{
				$("#total_"+index).val(total);
			}
			else
				$("#total_"+index).val('0');
		}
		else
		{
			$("#total_"+index).val('0');
		}

		for(var i = 1; i < 11; ++i)
		{
			if($('#commodity'+i).hasClass('on')) {
				totalPrice = totalPrice + parseInt($("#total_"+i).val());
			}
		}
		console.log(totalPrice);
		if(Number.isInteger(totalPrice))
			$("#totalPrice").html(totalPrice);
		else
			$("#totalPrice").html('0');
	});
	$(".removeCommodity").click(function(){
		var totalPrice = 0;
		$(this).parent('.commodityBox').removeClass('on');
		$(this).parent('.commodityBox').find('input[type=text]').val('');
		for(var i = 1; i < 11; ++i)
		{
			if($('#commodity'+i).hasClass('on') && $("#total_"+i).val() != '') {
				console.log(parseInt($("#total_"+i).val()));
				totalPrice = totalPrice + parseInt($("#total_"+i).val());
			}
		}

		if(Number.isInteger(totalPrice))
			$("#totalPrice").html(totalPrice);
		else
			$("#totalPrice").html('0');
	})
	$("#agreeFormBtn").click(function(){
		if($("#agreeCheck").val())
		{
			$.post('<?php yii\helpers\BaseUrl::base(true)?>registworkslip/default/cus',
				{
					'D01_CUST_NAMEN':$("input[name = D01_CUST_NAMEN]").val(),
					'D01_CUST_NAMEK':$("input[name = D01_CUST_NAMEK]").val(),
					'D01_KAKE_CARD_NO':$("input[name = D01_KAKE_CARD_NO]").val(),
					'D01_ADDR':$("input[name = D01_ADDR]").val(),
					'D01_TEL_NO':$("input[name = D01_TEL_NO]").val(),
					'D01_MOBTEL_NO':$("input[name = D01_MOBTEL_NO]").val(),
					'D01_NOTE':$("#D01_NOTE").val(),
					'D01_KAIIN_CD':$("input[name = D01_KAIIN_CD]").val()
				},
				function(data){
					if(data.result_api == '1' && data.result_db == '1')
					{
						$("#updateInfo").html('<div class="alert alert-success">編集が成功しました。</div>');
						setTimeout(function(){ $("#modalEditCustomer").modal('hide'); window.location.reload();},1000);

					}
					else
					{
						$("#updateInfo").html('<div class="alert alert-danger">編集が失敗しました。</div>');
					}
				}
			);
		}
	})
})

</script>