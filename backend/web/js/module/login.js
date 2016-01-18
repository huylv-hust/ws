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
            highlight: function(element, errorClass) {
                $(element).addClass('invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('invalid');
            }
        });
    };
    submit = function() {
        $('.btnLogin').click(function(){
            $('.alert').hide();
            var form = $('#frmLogin'),
                valid;
            valid = form.valid();
            if (valid == false)
                return false;
            form.submit();
        });
    };
    return{
        init: function(){
            submit();
            validate();
        }
    }
}();
$(function(){
    login.init();

});