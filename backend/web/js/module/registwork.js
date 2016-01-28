var regist_work = function () {

    var removeHrefPaging = function () {
        $('#modalCodeSearch .paging a').attr('href', '#');
    };

    var paging = function () {
        $('#modalCodeSearch .paging').on('click', 'a', function () {
            var condition = $('#modalCodeSearch .labelRadios.checked').parent().find('input').attr('id'),
                value = $('#code_search_value').val(),
                page = $(this).attr('data-page'),
                url = baseUrl + '/registworkslip/search/index',
                param = {
                    condition: condition,
                    value: value,
                    page: page
                };
            var request = $.ajax({
                type: 'post',
                data: param,
                url: url
            });
            var response = request.done(function (data) {
                $('#modalCodeSearch .paging a').parent('li').removeClass('active');
                $('#modalCodeSearch .paging a[data-page=' + page + ']').parent('li').addClass('active');
                var tr = '<tr><th></th><th>商品コード</th><th>荷姿コード</th><th>品名</th></tr>';
                $.each(data.product, function (key, value) {
                    tr += '<tr>'
                        + '<td><input type="radio" value="' + value.M05_COM_CD + value.M05_NST_CD + '" onclick="setValue(\'' + value.M05_COM_CD + value.M05_NST_CD + '\',' + parseInt(value.M05_COM_CD) + ')"'
                        + ' name="M05_COM_CD.M05_NST_CD"></td>'
                        + '<td>' + value.M05_COM_CD + '</td>'
                        + '<td>' + value.M05_NST_CD + '</td>'
                        + '<td>' + ((value.M05_COM_NAMEN == null) ? '' : value.M05_COM_NAMEN) + '</td>'
                        + '<input type="hidden" id="name' + value.M05_COM_CD + value.M05_NST_CD + '" value="' + value.M05_COM_NAMEN + '">'
                        + '<input type="hidden" id="price' + value.M05_COM_CD + value.M05_NST_CD + '" value="' + ((value.M05_LIST_PRICE == null) ? '' : value.M05_LIST_PRICE) + '">'
                        + '<input type="hidden" id="kind' + value.M05_COM_CD + value.M05_NST_CD + '" value="' + value.M05_KIND_COM_NO + '">'
                        + '<input type="hidden" id="large' + value.M05_COM_CD + value.M05_NST_CD + '" value="' + value.M05_LARGE_COM_NO + '">'
                        + '<input type="hidden" value="' + value.M05_COM_CD + '" id="comcd' + value.M05_COM_CD + value.M05_NST_CD + '" />'
                        + '<input type="hidden" value="' + value.M05_NST_CD + '" id="nstcd' + value.M05_COM_CD + value.M05_NST_CD + '" />'
                        + '</tr>'

                });

                $('#modalCodeSearch .tableList tbody').html(tr);
                $('nav.paging').html(html_paging(data.count, page, 10));
            });
        });
    };

    var search = function () {
        $('#code_search_btn').off('click').on('click', function () {
            var condition = $('#modalCodeSearch .labelRadios.checked').parent().find('input').attr('id'),
                value = $('#code_search_value').val(),
                page = 0,
                url = baseUrl + '/registworkslip/search/index',
                param = {
                    condition: condition,
                    value: value,
                    page: page
                };
            var request = $.ajax({
                type: 'post',
                data: param,
                url: url
            });
            var response = request.done(function (data) {
                $('#modalCodeSearch .paging a').parent('li').removeClass('active');
                $('#modalCodeSearch .paging a[data-page=' + page + ']').parent('li').addClass('active');
                var tr = '<tr><th></th><th>商品コード</th><th>荷姿コード</th><th>品名</th></tr>';
                $.each(data.product, function (key, value) {
                    tr += '<tr>'
                        + '<td><input type="radio" value="' + value.M05_COM_CD + value.M05_NST_CD + '" onclick="setValue(\'' + value.M05_COM_CD + value.M05_NST_CD + '\',' + parseInt(value.M05_COM_CD) + ')"'
                        + ' name="M05_COM_CD.M05_NST_CD"></td>'
                        + '<td>' + value.M05_COM_CD + '</td>'
                        + '<td>' + value.M05_NST_CD + '</td>'
                        + '<td>' + ((value.M05_COM_NAMEN == null) ? '' : value.M05_COM_NAMEN) + '</td>'
                        + '<input type="hidden" id="name' + value.M05_COM_CD + value.M05_NST_CD + '" value="' + value.M05_COM_NAMEN + '">'
                        + '<input type="hidden" id="price' + value.M05_COM_CD + value.M05_NST_CD + '" value="' + ((value.M05_LIST_PRICE == null) ? '' : value.M05_LIST_PRICE) + '">'
                        + '<input type="hidden" id="kind' + value.M05_COM_CD + value.M05_NST_CD + '" value="' + value.M05_KIND_COM_NO + '">'
                        + '<input type="hidden" id="large' + value.M05_COM_CD + value.M05_NST_CD + '" value="' + value.M05_LARGE_COM_NO + '">'
                        + '<input type="hidden" value="' + value.M05_COM_CD + '" id="comcd' + value.M05_COM_CD + value.M05_NST_CD + '" />'
                        + '<input type="hidden" value="' + value.M05_NST_CD + '" id="nstcd' + value.M05_COM_CD + value.M05_NST_CD + '" />'
                        + '</tr>'

                });
                $('#modalCodeSearch .tableList tbody').html(tr);
                $('nav.paging').html(html_paging(data.count, page, 10));
            });
        });
    };

    var html_paging = function (count_data, current_page, per_page) {
        if (count_data / per_page <= 1) return '';
        var total_page,
            prev,
            next,
            start,
            end;
        if(count_data <= per_page) total_page = 1;
        else {
            total_page = count_data % per_page > 0 ? parseInt(count_data / per_page) + 1 : count_data / per_page;
        }
        if (current_page == 0) {
            prev = '<li class="prev disabled"><span>«</span></li>';
            next = '<li class="next"><a data-page="' + (parseInt(current_page) + 1) + '" href="#">»</a></li>';
        }
        else if (current_page == total_page - 1) {
            prev = '<li class="prev"><a data-page="' + (parseInt(current_page) - 1) + '" href="#">«</a></li>';
            next = '<li class="next"><span>»</span></li>';
        } else {
            prev = '<li class="prev"><a data-page="' + (parseInt(current_page) - 1) + '" href="#">«</a></li>';
            next = '<li class="next"><a data-page="' + (parseInt(current_page) + 1) + '" href="#">»</a></li>';
        }

        if (total_page < 10) {
            start = 0;
            end = total_page;
        } else {
            if (parseInt(current_page) < 6) {
                start = 0;
                end = 10;
            } else {
                if (parseInt(current_page) > total_page - 5) {
                    start = total_page - 10;
                    end = total_page;
                } else {
                    start = parseInt(current_page) - 5;
                    end = parseInt(current_page) + 5;
                }
            }
        }
        var html = '<ul class="pagination">' + prev;
        for (var i = start; i < end; i++) {
            var display = i + 1;
            if (i == current_page)
                html += '<li class="active"><a data-page="' + i + '" href="#">' + display + '</a></li>';
            else
                html += '<li><a data-page="' + i + '" href="#">' + display + '</a></li>';
        }

        html += next + '</ul>';
        return html;
    };

    var validate_customer = function () {
        $('#modal_customer').validate({
            rules: {
                D01_CUST_NAMEN: {
                    required: true
                },
                D01_CUST_NAMEK: {
                    required: true
                },
                D01_KAKE_CARD_NO: {
                    digits: true,
                    minlength: 16
                },
                D01_YUBIN_BANGO: {
                    minlength: 7
                },
                D01_TEL_NO: {
                    digits: true,
                    required: function () {
                        if ($('#D01_MOBTEL_NO').val() == '') {
                            return true;
                        }
                        return false;
                    }
                },
                D01_MOBTEL_NO: {
                    required: function () {
                        if ($('#D01_TEL_NO').val() == '') {
                            return true;
                        }
                        return false;
                    },
                    digits: true
                }
            },
            messages: {
                D01_CUST_NAMEN: {
                    required: 'お名前を入力してください'
                },
                D01_CUST_NAMEK: {
                    required: 'お名前（フリガナ）を入力してください'
                },
                'D01_KAKE_CARD_NO': {
                    minlength: '掛カード番号は16文字の数字で入力してください',
                    digits: '掛カード番号は16文字の数字で入力してください'
                },
                D01_YUBIN_BANGO: {
                    minlength: '郵便番号は7文字の数字で入力してください'
                },
                D01_TEL_NO: {
                    digits: '電話番号は数字で入力してください',
                    required: '電話番号または携帯電話番号を入力してください'
                },
                D01_MOBTEL_NO: {
                    digits: '携帯電話番号は数字で入力してください',
                    required: '電話番号または携帯電話番号を入力してください'
                }
            }
        });
    };

    var validate_car = function () {
        jQuery.validator.addMethod("car_no", function (value, element) {
            if (value == '0000') return false;
            return true;
        });
        $('#modal_car').validate({});

        $('.D02_SHONENDO_YM').each(function () {
            var rel = $(this).parents('section').attr('rel');
            $(this).rules('add', {
                minlength: 6,
                date_year_month: true,
                messages: {
                    minlength: function () {
                        return rel + '台目の初年度登録年月は6文字の数字で入力してください';
                    },
                    date_year_month: rel + '台目の初年度登録年月が正しくありません'
                }
            });
        });

        $('.D02_JIKAI_SHAKEN_YM').each(function () {
            var rel = $(this).parents('section').attr('rel');
            $(this).rules("add", {
                required: true,
                digits: true,
                minlength: 8,
                date_format: true,
                messages: {
                    required: function () {
                        return rel + '台目の車検満了日を入力してください';
                    },
                    digits: function () {
                        return rel + '台目の車検満了日は8文字の数字で入力してください';
                    },
                    minlength: function () {
                        return rel + '台目の車検満了日は8文字の数字で入力してください';
                    },
                    date_format: rel + '台目の車検満了日が正しくありません'
                }
            });
        });

        $('.D02_METER_KM').each(function () {
            var rel = $(this).parents('section').attr('rel');
            $(this).rules("add", {
                required: true,
                digits: true,
                messages: {
                    required: function () {
                        return rel + '台目の走行距離を入力してください';
                    },
                    digits: function () {
                        return rel + '台目の走行距離は数字で入力してください';
                    }
                }
            });
        });

        $('.D02_RIKUUN_NAMEN').each(function () {
            var rel = $(this).parents('section').attr('rel');
            $(this).rules("add", {
                required: true,
                messages: {
                    required: function () {
                        return rel + '台目の運輸支局を入力してください';
                    }
                }
            });
        });

        $('.D02_CAR_ID').each(function () {
            var rel = $(this).parents('section').attr('rel');
            $(this).rules("add", {
                required: true,
                minlength: 3,
                messages: {
                    required: function () {
                        return rel + '台目の分類コードを入力してください';
                    },
                    minlength: rel + '台目の分類コードは3文字の数字で入力してください'
                }
            });
        });

        $('.D02_HIRA').each(function () {
            var rel = $(this).parents('section').attr('rel');
            $(this).rules("add", {
                required: true,
                hiragana: true,
                messages: {
                    required: function () {
                        return rel + '台目のひらがなを入力してください';
                    },
                    hiragana: function () {
                        return rel + '台目のひらがなはひらがなで入力してください';
                    }
                }
            });
        });

        $('.D02_CAR_NO').each(function () {
            var rel = $(this).parents('section').attr('rel');
            $(this).rules("add", {
                required: true,
                digits: true,
                minlength: 4,
                car_no: true,
                messages: {
                    required: function () {
                        return rel + '台目の登録番号を入力してください';
                    },
                    digits: function () {
                        return rel + '台目の登録番号は4文字の数字で入力してください';
                    },
                    minlength: function () {
                        return rel + '台目の登録番号は4文字の数字で入力してください';
                    },
                    car_no: function () {
                        return rel + '台目の登録番号に0000は入力できません';
                    }
                }
            });
        });
    };

    var validate_workslip = function () {
        jQuery.validator.addMethod("totalPriceProduct", function (value, element) {
            var count = parseInt($(element).closest('.on').find('.noProduct').val()),
                price = parseInt($(element).closest('.on').find('.priceProduct').val());
            if (parseInt(value) < count * price) return false;
            return true;
        });

        jQuery.validator.addMethod("pos_den_no", function (value, element) {
            if (value == '') return true;
            if (value.match(/^([0-9,]+)?$/)) {
                var arr = value.split(','),
                    arr_length = arr.length,
                    count_delimeter = arr_length - 1;

                if (count_delimeter == 0) {
                    if (value.length != 4) {
                        return false;
                    }
                } else {
                    for (var i = 0; i < arr_length; i++) {
                        if (arr[i].length != 4) return false;
                    }
                }

                return true;
            }
            return false;
        }, 'POS伝票番号はカンマ区切りの4文字の数字で入力してください');

        jQuery.validator.addMethod("check_date_order", function (value, element) {
            var start_h = parseInt($('[name=D03_AZU_BEGIN_HH]').val()),
                start_m = parseInt($('[name=D03_AZU_BEGIN_MI]').val()),
                end_h = parseInt($('[name=D03_AZU_END_HH]').val()),
                end_m = parseInt($('[name=D03_AZU_END_MI]').val());

            if (start_h > end_h) return false;
            if (start_h == end_h && start_m > end_m) return false;
            return true;
        }, '終了時間は開始時間より入力してください。');

        var validator = $('#login_form').validate({
            ignore: "",
            rules: {
                M08_NAME_MEI_M08_NAME_SEI: {
                    required: true
                },
                D01_SS_CD: {
                    required: true,
                    digits: true,
                    minlength: 6
                },
                D02_CAR_SEQ_SELECT: {
                    required: true
                },
                D03_SEKOU_YMD: {
                    required: true,
                    digits: true,
                    minlength: 8,
                    date_format: true
                },
                D03_POS_DEN_NO: {
                    pos_den_no: true
                },
                D03_KAKUNIN: {
                    required: function () {
                        return $('#valuables1').is(':checked');
                    }
                },
                D03_AZU_END_HH: {
                    check_date_order: true
                },
                D03_SUM_KINGAKU: {
                    maxlength: 10
                },
                date_1: {
                    maxlength: 4,
                    min:0
                },
                date_2: {
                    maxlength: 2,
                    min:0
                },
                date_3: {
                    maxlength: 2,
                    min:0
                },
                pressure_front: {
                    min:0
                },
                pressure_behind: {
                    min:0
                },
                km: {
                    min:0
                }
            },
            messages: {
                M08_NAME_MEI_M08_NAME_SEI: {
                    required: '受付担当者を選択してください'
                },
                D01_SS_CD: {
                    required: 'SSコードを入力してください',
                    digits: 'SSコードは6文字の数字で入力してください',
                    minlength: 'SSコードは6文字の数字で入力してください'
                },
                D02_CAR_SEQ_SELECT: {
                    required: '先に車両情報を作成して下さい。'
                },
                D03_SEKOU_YMD: {
                    required: '施行日を入力してください',
                    digits: '施行日は8文字の数字で入力してください',
                    minlength: '施行日は8文字の数字で入力してください',
                    date_format: '施行日が正しくありません'
                },
                D03_KAKUNIN: {
                    required: function () {
                        return '貴重品「有」の場合は、お客様確認を行い、お客様確認チェックをＯＮにしてください';
                    }
                },
                D03_SUM_KINGAKU: {
                    maxlength: '合計金額は10桁の数字以内で入力してください。'
                },
                date_1: {
                    maxlength: '年は4桁の数字以内で入力してください。',
                    min:'年は0桁の数字以外で入力してください'
                },
                date_2: {
                    maxlength: '月は2桁の数字以内で入力してください。',
                    min:'月は0桁の数字以外で入力してください'
                },
                date_3: {
                    maxlength: '日は2桁の数字以内で入力してください。',
                    min:'日は0桁の数字以外で入力してください。'
                },
                pressure_front: {
                    min:'前は0桁の数字以外で入力してください。'
                },
                pressure_behind: {
                    min:'後は0桁の数字以外で入力してください。'
                },
                km: {
                    min:'kmは0桁の数字以外で入力してください。'
                }
            },
            invalidHandler: function() {
                var errors = validator.numberOfInvalids();
                if (errors) {
                    validator.errorList[0].element.focus();
                }
            }
        });

        $('.noProduct').each(function () {
            $(this).rules("add", {
                digits: true,
                messages: {
                    digits: '数量は数字で入力してください'
                }
            });
        });

        $('.priceProduct').each(function () {
            $(this).rules("add", {
                digits: true,
                messages: {
                    digits: '単価は数字で入力してください'
                }
            });
        });

        $('.totalPriceProduct').each(function () {
            $(this).rules("add", {
                digits: true,
                totalPriceProduct: true,
                messages: {
                    digits: '金額は数字で入力してください',
                    totalPriceProduct: '伝票作業データを更新できませんでした'
                }
            });
        });
    };

    var submit_registWork = function () {
        $('#btnRegistWorkSlip').on('click', function () {
            var form = $(this).closest('form'),
                valid = form.valid();
            if (valid == false) {
                var tooltip_hidden = $('input[name=D03_KAKUNIN]').attr('aria-describedby');
                if (tooltip_hidden != '') {
                    $('#' + tooltip_hidden).css({"top": "-29px", "left": "-202px"});
                    $('#' + tooltip_hidden).find('.tooltip-arrow').css("left", "50%");
                }
                var tooltip_hidden = $('input[name=D03_SUM_KINGAKU]').attr('aria-describedby');
                if (tooltip_hidden != '') {
                    $('#' + tooltip_hidden).css({"top": "-30px", "left": "948px"});
                    $('#' + tooltip_hidden).find('.tooltip-arrow').css("left", "80%");
                }
                return false;
            }
            $('#modalRegistConfirm').modal();
        });
    };

    var convert_zen2han = function () {
        $('#D01_YUBIN_BANGO , #D01_TEL_NO, #D01_MOBTEL_NO, #D01_KAKE_CARD_NO').on('change', function () {
            utility.zen2han(this);
        });

        $('.D02_JIKAI_SHAKEN_YM , .D02_METER_KM, .D02_CAR_NO, .D02_CAR_ID').on('change', function () {
            utility.zen2han(this);
        });

        $('[name=D03_SEKOU_YMD] , [name=D01_SS_CD], [name=D03_POS_DEN_NO], .noProduct, .priceProduct, .totalPriceProduct').on('change', function () {
            utility.zen2han(this);
        });
        $('[name=date_1] , [name=date_2], [name=date_3], [name=pressure_front], [name=pressure_behind], [name=km]').on('change', function () {
            utility.zen2han(this);
        });
    };

    var click_label_modal_customer = function () {
        $('#agreeLabel').on('click', function () {
            var status = $("#agreeCheck");
            var btn = $("#agreeFormBtn");
            if (status.attr("checked")) {
                btn.removeClass("disabled");
                btn.removeAttr("disabled");
            } else {
                btn.addClass("disabled");
                btn.attr("disabled", "disabled");
            }
        });
    };

    var preview = function () {
        $('#preview').on('click', function () {
            $('#login_form').attr('action', baseUrl + '/preview2');
            $('#login_form')[0].submit();
        });
    };

    var get_addr_from_zipcode = function() {
        $('#btn_get_address').off('click').on('click',function(){
            var zipcode = $('#D01_YUBIN_BANGO').val();
            if(zipcode.length != 7) return;
            var request = $.ajax({
                type: 'post',
                data: {
                    zipcode : zipcode
                },
                url: baseUrl + '/registworkslip/search/address'
            });
            var response = request.done(function (data) {
                var html = '';
                if(data != false) {
                    html = data[0].prefecture + ' ' + data[0].city + ' ' + data[0].town;
                }

                $('#D01_ADDR').val(html);
            });
        });
    };

    return {
        init: function () {
            removeHrefPaging();
            paging();
            search();
            validate_customer();
            convert_zen2han();
            validate_car();
            validate_workslip();
            submit_registWork();
            click_label_modal_customer();
            preview();
            get_addr_from_zipcode();
        }
    };
}();

$(function () {
    regist_work.init();
});