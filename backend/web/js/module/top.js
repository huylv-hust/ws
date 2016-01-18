//GLOBAR var
var url_usappy_number_change = base_url+'/usappy-number-change.html';
var url_regist_workslip = base_url+'/regist-workslip.html';
var url_list_workslip = base_url+'/list-workslip.html';
var type_usappy = '1';
var type_receivable = '2';
var type_other = '3';



//Remove value and validate if modal hide
function clearValueModal(form) {
    $('.box-alert').html('');
    $(form).find('input,textarea,select').each(function(index, element) {
        $(element).val('').end();
        $(element).removeClass('invalid');
        hideToolTip($(element).parent());
    });
}

// Menu Usappy‚ カード番号変更
function fncCard(){
    $('#modalAuthUsappy').on('hidden.bs.modal', function (e) {
        clearValueModal(this);
    });
    $("#modalAuthUsappy").on('show.bs.modal', function(event){
        $('.card_url_redirect').attr('value', url_usappy_number_change);
        $('.card_type_redirect').attr('value',type_usappy);
    });
    $.sidr("close", "sidr", function(){
        return false;
    });
    $("#modalAuthUsappy").modal();
}


// Menu ä½œæ¥­ä¼ç¥¨ä½œæˆãƒ»æƒ…å ±æ¤œç´¢ãƒœã‚¿ãƒ³
function fncType(moveType) {
    $("#modalAuthUsappy").on('hidden.bs.modal', function (e) {
        clearValueModal(this);
    });
    $("#modalAuthReceivable").on('hidden.bs.modal', function (e) {
        clearValueModal(this);
    });
    if(moveType === "regist"){
        $('.card_url_redirect').attr('value', url_regist_workslip);
        // $.sidr("close", "sidr");
        $.sidr("close", "sidr", function(){
            return false;
        });
        $("#modalSelectMember").modal();
    }else if(moveType === "search"){
        $('.card_url_redirect').attr('value', url_list_workslip);
        // $.sidr("close", "sidr");
        $.sidr("close", "sidr", function(){
            return false;
        });
        $("#modalSelectMember").modal();
    }
}
function fncAuth(modalType){
    $("#modalSelectMember").modal("hide");
    if(modalType === "usappy"){
        $('.card_type_redirect').attr('value',type_usappy);
        $.sidr("close", "sidr", function(){
            return false;
        });
        $("#modalAuthUsappy").modal("show");
    }else if(modalType === "receivable"){
        $('.card_type_redirect').attr('value',type_receivable);
        $.sidr("close", "sidr", function(){
            return false;
        });
        $("#modalAuthReceivable").modal("show");
    }
}

var cardmembers = function(){
    var validate = function(){
        $.validator.addMethod("mynumber", function (value, element) {
            if (value == '') {
                return true;
            }
            if (value.match(/^(\d)*$/)) {
                return true;
            } else {
                return false;
            }
        });
        $.validator.addMethod("isKatakana", function (value, element) {
            if(value.match(/^[ァ-ンー\s]+$/) && value.length <= 50) {
                return true;
            }
            return false;
        });
        $('#card_member_usappy #moveTypeUsappy').click(function(){
            $('#card_member_usappy').validate({
                rules: {
                    card_number:{
                        required: true,
                        mynumber: true
                    },
                    member_birthday:{
                        mynumber: true,
                        rangelength: [8,8],
                        required: function(){
                            if($('#form_license_plates').val() == '' && $('#form_member_kaiinKana').val() == '' && $('#form_member_tel').val() == '')
                            {
                                return true;
                            }
                            else{
                                return false;
                            }
                        }
                    },
                    license_plates: {
                        mynumber: true,
                        rangelength: [4,4],
                        required: function(){
                            if($('#form_member_birthday').val() == '' && $('#form_member_kaiinKana').val() == '' && $('#form_member_tel').val() == '')
                            {
                                return true;
                            }
                            else{
                                return false;
                            }
                        }
                    },
                    member_kaiinKana:{
                        isKatakana: true,
                        required: function(){
                            if($('#form_member_birthday').val() == '' && $('#form_license_plates').val() == '' && $('#form_member_tel').val() == '')
                            {
                                return true;
                            }
                            else{
                                return false;
                            }
                        }
                    },
                    member_tel: {
                        mynumber: true,
                        rangelength: [11,11],
                        required: function(){
                            if($('#form_member_birthday').val() == '' && $('#form_license_plates').val() == '' && $('#form_member_kaiinKana').val() == '')
                            {
                                return true;
                            }
                            else{
                                return false;
                            }
                        }
                    }

                },
                messages: {
                    card_number:{
                        required: 'カード番号を入力してください',
                        mynumber: 'カード番号は数字で入力してください'
                    },
                    member_birthday:{
                        mynumber: '生年月日は数字で入力してください',
                        rangelength: '生年月日は8文字で入力してください',
                        required: '生年月日/車番/氏名カナ/電話番号のいずれか１つ以上を入力してください'
                    },
                    license_plates: {
                        mynumber: '車番は4文字で入力してください',
                        rangelength: '車番は4文字で入力してください',
                        required: '生年月日/車番/氏名カナ/電話番号のいずれか１つ以上を入力してください'
                    },
                    member_kaiinKana:{
                        isKatakana: '氏名カナはカタカナ50文字以内で入力してください',
                        required: '生年月日/車番/氏名カナ/電話番号のいずれか１つ以上を入力してください'
                    },
                    member_tel: {
                        mynumber: '電話番号は11文字の数字で入力してください',
                        rangelength: '電話番号は11文字の数字で入力してください',
                        required: '生年月日/車番/氏名カナ/電話番号のいずれか１つ以上を入力してください'
                    }
                }
            }).form();
        });
    };
    var submit = function(){
        $('#card_member_usappy #moveTypeUsappy').click(function() {

            $('.box-alert').html('');
            var form = $('#card_member_usappy'),
                valid;
            valid = form.valid();
            if (valid == false)
                return false;
            //Get url and type
            $('.box-alert').html('<img src="'+base_url+'/img/loading7_light_blue.gif" width="30px">');
            var url_redirect = $('#card_member_usappy .card_url_redirect').val();
            var type_redirect = $('#card_member_usappy .card_type_redirect').val();

            var card_number = $('#card_member_usappy #form_card_number').val();
            var member_birthday = $('#card_member_usappy #form_member_birthday').val();
            var member_kaiinKana = $('#card_member_usappy #form_member_kaiinKana').val();
            var member_tel = $('#card_member_usappy #form_member_tel').val();
            var license_plates = $('#card_member_usappy #form_license_plates').val();
            $.ajax({
                url: base_url + '/site/checkmember',
                method: 'post',
                data: {
                    card_number: card_number,
                    member_birthday: member_birthday,
                    member_kaiinKana: member_kaiinKana,
                    member_tel: member_tel,
                    license_plates: license_plates,
                    url_redirect: url_redirect,
                    type_redirect: type_redirect
                },
                dataType: 'json'
            })
                .success(function (data) {
                    if (data === false) {
                        $('.box-alert').html('<div class="alert alert-danger" role="alert">入力条件に該当する会員が存在しません</div>');
                    }
                    else {
                        $('.box-alert').html('');
                    }
                });
        });
    };

    return{
        init: function(){
            validate();
            submit();
        }
    };
}();

var card = function(){
    var ready = function(){
        $(function(){

        });
    };

    var validate = function(){
        $.validator.addMethod("mynumber", function (value, element) {
            if (value == '') {
                return true;
            }
            if (value.match(/^(\d)*$/)) {
                return true;
            } else {
                return false;
            }
        });
        $('#card_usappy #moveTypeReceivable').click(function(){
            $('#card_usappy').validate({
                rules: {
                    card_number:{
                        required: true,
                        mynumber: true
                    }
                },
                messages: {
                    card_number:{
                        required: '掛カード番号を入力してください。',
                        mynumber: '掛カード番号を入力してください。'
                    }
                }
            }).form();
        });
    };
    var submit = function(){
        $('#card_usappy #moveTypeReceivable').click(function() {
            $('.box-alert').html('');
            var form = $('#card_usappy'),
                valid;
            valid = form.valid();
            if (valid == false)
                return false;
            //Get url and type
            var url_redirect = $('#card_usappy .card_url_redirect').val();
            var type_redirect = $('#card_usappy .card_type_redirect').val();
            var card_number = $('#card_usappy #form_card_number').val();

            $.ajax({
                url: base_url + '/site/checkcard',
                method: 'post',
                data: {
                    card_number: card_number,
                    url_redirect: url_redirect,
                    type_redirect: type_redirect
                },
                dataType: 'json'
            })
                .success(function (data) {
                    if (data === false) {
                        $('.box-alert').html('<div class="alert alert-danger" role="alert">設定された掛カード番号が存在しません</div>');
                    }
                    else {
                        $('.box-alert').html('');
                    }
                });
        });
    };

    return{
        init: function(){
            ready();
            validate();
            submit();
        }
    };
}();

var other = function(){
    var submit = function(){
        $('.btnMemberEtc').click(function() {
            var url_redirect = $('.card_url_redirect').val();
            $.ajax({
                url: base_url + '/site/checkother',
                method: 'post',
                data: {
                    url_redirect: url_redirect,
                    type_redirect: type_other
                },
                dataType: 'json'
            })
                .success(function (data) {

                });
        });
    };
    return{
        init: function(){
            submit();
        }
    }
}();

$(function(){
    cardmembers.init();
    card.init();
    other.init();

});
