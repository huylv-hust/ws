


(function($) {
// checkboxデザイン変更
  //checkedだったら最初からチェックする
  $(".checks").each(function() {
    if ($(this).attr("checked") === "checked") {
      $(this).next().addClass("checked");

    }
  });
  //クリックした要素にクラス割り当てる
  $(".labelChecks,.labelSingleCheck").click(function() {
    if ($(this).hasClass("checked")) {
      $(this)
        .removeClass("checked")
        .prev(".checks").removeAttr("checked");
    } else {
      $(this)
        .addClass("checked")
        .prev(".checks").attr("checked", "checked");
    }
  });
  // radioデザイン変更
  var radioGroup = $(".radioGroup");
  $(".radio", radioGroup)
    //checkedだったら最初からチェックする
    .each(function() {
      if ($(this).attr("checked") === "checked") {
        $(this).next().addClass("checked");
      }
    });
  //クリックした要素にクラス割り当てる
  $(".labelRadios", radioGroup).click(function() {
    $(this).parent().parent().each(function() {
      $(".labelRadios", this).removeClass("checked");
    });
    $(this).addClass("checked");
  });

})(jQuery);

$(function() {
  // sidemenu
  $("#navSideMenu").sidr(open);
  $("#sidrClose").sidr(close);

  // accordion
  $(".toggleAccordion").on("click", function() {
    var acc = $(this).parents(".accordion");
    if (acc.hasClass("accClose")) {
      acc.removeClass("accClose");
      acc.addClass("accOpen");
      $(this).text("削除");
    } else {
      acc.removeClass("accOpen");
      acc.addClass("accClose");
      $(this).text("追加");
    }
    return false;
  });

  //（デモ用の仮script ここから）
  // 商品削除ボタン 後で直す
  $(".removeCommodity").on("click", function() {
    var commodity = $(this).parents(".commodityBox");
    commodity.removeClass("on");
    return false;
  });
  $("#commodity2 .removeCommodity").on("click", function() {
    $("#warrantyBox").hide();
    return false;
  });
  // 商品追加ボタン 後で直す
  $(".addCommodity").on("click", function() {
    var commodity = $(this).parents(".fieldsetRegist").children(".commodityBox");
    var lastID = "commodity";
    var onCount = 1;
    commodity.each(function() {
      if ($(this).hasClass("on")) {
        onCount = onCount + 1;
      }
    });

    if (onCount <= 10) {
      lastID = lastID + onCount;

      // 保証書作成部分表示
      if (onCount === 2) {
        $("#warrantyBox").show();
      }
    }
    $("#" + lastID).addClass("on");
    return false;
  });
  $("#checkWarranty").on("change", function(){
    if($(this).attr("checked") === "checked"){
      $(".toggleWarranty").show();
    }else{
      $(".toggleWarranty").hide();
    }
  });
  //（デモ用の仮script ここまで）

 validate('#frmLogin','.btnLogin');

 validate('#frmCardNumber','#btnCardNumberVerify');

});

function  validate(form,btnObj){

  var isValid = true;

  var ssidValid = 'SSIDを入力してください';
  var passValid = 'パスワードを入力してください';
  var oldCardNumber = '旧Usappyカード番号を入力してください';
  var newCardNumber = '新Usappyカード番号を入力してください';

  if(btnObj != '' || form != '' ){

	  //validate login page
	if(form == '#frmLogin'){

		$(btnObj).on('click',function(e){

			$(form).find('input[valid=true]').each(function(index, element) {

				var inputType = $(this).attr('name');

				 switch(inputType){
					case 'ssid':
						if($(this).val() == ''){
							$(this).addClass('invalid');
							showToolTip($(this).parent(),ssidValid);
							e.preventDefault();
							isValid = false;
						}
					 break;
					case 'password':
					    if($(this).val() == ''){
						 	$(this).addClass('invalid');
							showToolTip($(this).parent(),passValid);
							e.preventDefault();
							isValid = false;
						}
					break;
				  }
           });

         });

		 $(form).find('input[valid=true]').each(function(index, element) {
			 var inputType = $(this).attr('name');
			 $(this).on('focusout',function(){
				 switch(inputType){
					case 'ssid':
						 if($(this).val() == ''){
							$(this).addClass('invalid');
							 hideToolTip($(this).parent());
							 showToolTip($(this).parent(),ssidValid);
							 isValid  = false;
						 }else{
							 $(this).removeClass('invalid');
							 hideToolTip($(this).parent());
						 }
					 break;

					case 'password':
						if($(this).val() == ''){
						   $(this).addClass('invalid');
						   hideToolTip($(this).parent());
						   showToolTip($(this).parent(),passValid);
						   isValid  = false;
						}else{
							 $(this).removeClass('invalid');
							 hideToolTip($(this).parent());
						}
					 break;
				  }
			 });

		   });

	   }
  };

  //validate form number change
  if(form == '#frmCardNumber'){

	  //button onclick
	  $(btnObj).on('click',function(e){

			$(form).find('input[valid=true]').each(function(index, element) {

				var inputType = $(this).attr('name');

				 switch(inputType){

					 case 'oldCardNumber':
					    if($(this).val() == ''){
						 	$(this).addClass('invalid');
							showToolTip($(this).parent(),oldCardNumber);
							e.preventDefault();
							isValid = false;
						}
					break;

					case 'newCardNumber':
					    if($(this).val() == ''){
						 	$(this).addClass('invalid');
							showToolTip($(this).parent(),newCardNumber);
							e.preventDefault();
							isValid = false;
						}
					break;

				 }
           });

        });

		//focus out
		$(form).find('input[valid=true]').each(function(index, element) {
			 var inputType = $(this).attr('name');
			 $(this).on('focusout',function(){
				 switch(inputType){
					 case 'oldCardNumber':
						if($(this).val() == ''){
						   $(this).addClass('invalid');
						   hideToolTip($(this).parent());
						   showToolTip($(this).parent(),oldCardNumber);
						   isValid  = false;
						}else{
							 $(this).removeClass('invalid');
							 hideToolTip($(this).parent());
						}
					 break;

					 case 'newCardNumber':
						if($(this).val() == ''){
						   $(this).addClass('invalid');
						   hideToolTip($(this).parent());
						   showToolTip($(this).parent(),newCardNumber);
						   isValid  = false;
						}else{
							 $(this).removeClass('invalid');
							 hideToolTip($(this).parent());
						}
					 break;
			     }

			 });
		});
  }

  return isValid;
}

var hideToolTip = function(parent){
  $(parent).find('.toolTipMsg').hide();
}

var showToolTip = function(parent,msg){
  $(parent).find('.toolTipMsg').show();
  $(parent).find('.tooltipInner').html(msg);
}


// プライバシーポリシーに同意する
var agreeForm = function() {
  var status = $("#agreeCheck");
  var btn = $("#agreeFormBtn");
  if (status.attr("checked")) {
    btn.removeClass("disabled");
    btn.removeAttr("disabled");
  } else {
    console.log("disable");
    btn.addClass("disabled");
    btn.attr("disabled", "disabled");
  }
};


// コード一覧から選択ボタン
function codeSearch(){
  $("#modalCodeSearch").modal();
}

// 作業確定ボタン
function fncMakeWarranty(){
  $("#modalWorkSlipComp").modal("hide");
  $("#modalMakeWarranty").modal("show");
}