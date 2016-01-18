/**
 * Created by HP400 on 1/11/2016.
 */
var login = function(){
    var validate = function(){
        $('#frmLogin').validate({
            rules: {
                ssid:{
                    required: true
                },
                password:{
                    required: true
                }
            },
            messages: {
                ssid:{
                    required: 'SSIDを入力してください'
                },
                password:{
                    required: 'パスワードを入力してください'
                }
            },
            submitHandler: function(form) {
                $(form).submit();
            }
        });
    }
    return{
        init: function(){
            validate();
        }
    }
}();
$(function(){
    login.init();

});