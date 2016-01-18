var search = function(){
    /* END SCREEN SEARCH */
    var change_branch_search = function(){
        $('#selectBranch').off('change').on('change', function(){
           load_ss_search();
        });
    };

    var load_ss_search = function(){
        var param = {
            branch_id: $('#selectBranch').val()
        };
        console.log(param);
        var request = $.ajax({
            type: 'post',
            data: param,
            url: baseUrl + '/listworkslip/default/getss',
        });
        var result = request.done(function(data){
            console.log(data);
            var option = '';
            $.each(data, function(key, value){
                option += '<option value="' + key + '">' + value + '</option>';
            });
            $('#selectSS').html(option);
        });
    };

    var search = function(){
        $('.btnSearch').off('click').on('click', function(){
            $(this).closest('form').submit();
        });
    };
    /* END SCREEN SEARCH */

    var validate = function(){
    //    $('#staff_form').validate({
    //        groups: {
    //            name: 'Sdptm08sagyosya[M08_NAME_SEI] Sdptm08sagyosya[M08_NAME_MEI]',
    //        },
    //        rules: {
    //            'Sdptm08sagyosya[M08_JYUG_CD]' : {
    //                required: true,
    //                digits: true
    //            },
    //            'Sdptm08sagyosya[M08_NAME_SEI]': {
    //                required: true
    //            },
    //            'Sdptm08sagyosya[M08_NAME_MEI]': {
    //                required: true
    //            },
    //            'Sdptm08sagyosya[M08_ORDER]': {
    //                digits:true
    //            }
    //        },
    //        messages: {
    //            'Sdptm08sagyosya[M08_JYUG_CD]': {
    //                required: '従業員CDを入力してください',
    //                digits: '従業員CDが10桁以内の数字で入力されていない場合'
    //            },
    //            'Sdptm08sagyosya[M08_NAME_SEI]': {
    //                required: '作業者名 姓を入力してください'
    //            },
    //            'Sdptm08sagyosya[M08_NAME_MEI]': {
    //                required: '作業者名 姓を入力してください'
    //            },
    //            'Sdptm08sagyosya[M08_ORDER]': {
    //                digits: '表示順は3文字以内の数字で入力してください'
    //            }
    //        }
    //    });
    };

    var convert_zen2han = function(){
        $('#sdptm08sagyosya-m08_jyug_cd , #sdptm08sagyosya-m08_order').on('change',function(){
            utility.zen2han(this);
        });
    };

    var convert_han2zen = function() {
        $('#sdptm08sagyosya-m08_name_sei , #sdptm08sagyosya-m08_name_mei').on('change',function(){
            utility.han2zen(this);
        });
    };

    return{
      init:function(){
          change_branch_search();
          search();
          validate();
          convert_zen2han();
          convert_han2zen();
      }
    };
}();
$(function(){
    search.init();
});