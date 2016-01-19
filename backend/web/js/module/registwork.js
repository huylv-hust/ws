var regist_work = function() {

    var removeHrefPaging = function(){
        $('#modalCodeSearch .paging a').attr('href', '#');
    };

    var paging = function() {
        $('#modalCodeSearch .paging').on('click', 'a', function() {
            var condition = $('#modalCodeSearch .labelRadios.checked').parent().find('input').attr('id'),
                value = $('#code_search_value').val(),
                page = $(this).attr('data-page'),
                url = baseUrl + '/registworkslip/search/index',
                param = {
                    condition : condition,
                    value : value,
                    page : page
                };
            var request = $.ajax({
                type: 'post',
                data: param,
                url: url
            });
            var response = request.done(function(data){
                $('#modalCodeSearch .paging a').parent('li').removeClass('active');
                $('#modalCodeSearch .paging a[data-page='+ page +']').parent('li').addClass('active');
                var tr = '<tr><th></th><th>商品コード</th><th>荷姿コード</th><th>品名</th></tr>';
                $.each(data.product, function(key, value){
                    tr += '<tr>'
                        + '<td><input type="radio" value="' + value.M05_COM_CD + value.M05_NST_CD + '" onclick="setValue(\'' + value.M05_COM_CD + value.M05_NST_CD + '\')"'
                        + ' name="M05_COM_CD.M05_NST_CD"></td>'
                        + '<td>' + value.M05_COM_CD + '</td>'
                        + '<td>' + value.M05_NST_CD + '</td>'
                        + '<td>' + value.M05_COM_NAMEN + '</td>'
                        + '<input type="hidden" id="name' + value.M05_COM_CD + value.M05_NST_CD + '" value="' +  value.M05_COM_NAMEN + '">'
                        + '<input type="hidden" id="price' + value.M05_COM_CD + value.M05_NST_CD + '" value="' + ((value.M05_LIST_PRICE == null) ? '' : value.M05_LIST_PRICE) + '">'
                        + '<input type="hidden" id="kind' + value.M05_COM_CD + value.M05_NST_CD + '" value="' + value.M05_KIND_COM_NO + '">'
                        + '<input type="hidden" id="large' + value.M05_COM_CD + value.M05_NST_CD + '" value="' + value.M05_LARGE_COM_NO + '">'
                        + '</tr>'

                });
                $('#modalCodeSearch .tableList tbody').html(tr);
                $('nav.paging').html(html_paging(data.count, page, 10));
            });
        });
    };

    var search = function() {
        $('#code_search_btn').off('click').on('click', function() {
            var condition = $('#modalCodeSearch .labelRadios.checked').parent().find('input').attr('id'),
                value = $('#code_search_value').val(),
                page = 0,
                url = baseUrl + '/registworkslip/search/index',
                param = {
                    condition : condition,
                    value : value,
                    page : page
                };
            var request = $.ajax({
                type: 'post',
                data: param,
                url: url
            });
            var response = request.done(function(data){
                $('#modalCodeSearch .paging a').parent('li').removeClass('active');
                $('#modalCodeSearch .paging a[data-page='+ page +']').parent('li').addClass('active');
                var tr = '<tr><th></th><th>商品コード</th><th>荷姿コード</th><th>品名</th></tr>';
                $.each(data.product, function(key, value){
                    tr += '<tr>'
                        + '<td><input type="radio" value="' + value.M05_COM_CD + value.M05_NST_CD + '" onclick="setValue(\'' + value.M05_COM_CD + value.M05_NST_CD + '\')"'
                        + ' name="M05_COM_CD.M05_NST_CD"></td>'
                        + '<td>' + value.M05_COM_CD + '</td>'
                        + '<td>' + value.M05_NST_CD + '</td>'
                        + '<td>' + value.M05_COM_NAMEN + '</td>'
                        + '<input type="hidden" id="name' + value.M05_COM_CD + value.M05_NST_CD + '" value="' +  value.M05_COM_NAMEN + '">'
                        + '<input type="hidden" id="price' + value.M05_COM_CD + value.M05_NST_CD + '" value="' + value.M05_LIST_PRICE + '">'
                        + '<input type="hidden" id="kind' + value.M05_COM_CD + value.M05_NST_CD + '" value="' + value.M05_KIND_COM_NO + '">'
                        + '<input type="hidden" id="large' + value.M05_COM_CD + value.M05_NST_CD + '" value="' + value.M05_LARGE_COM_NO + '">'
                        + '</tr>'

                });
                $('#modalCodeSearch .tableList tbody').html(tr);
                $('nav.paging').html(html_paging(data.count, page, 10));
            });
        });
    };

    var html_paging = function(count_data, current_page, per_page){
        if(count_data/per_page <= 1) return '';
        var total_page = count_data % per_page > 0 ? parseInt(count_data/per_page) + 1 : 0,
            prev,
            next,
            start,
            end;
        if(current_page == 0) {
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

        if(total_page < 10) {
            start = 0;
            end = total_page;
        } else {
            if(parseInt(current_page) < 6) {
                start = 0;
                end = 10;
            } else {
                if(parseInt(current_page) > total_page - 5) {
                    start = total_page - 10;
                    end = total_page;
                } else {
                    start = parseInt(current_page) - 5;
                    end = parseInt(current_page) + 5;
                }
            }
        }

        var html = '<ul class="pagination">' + prev;
        for (var i = start; i < end; i ++) {
            var display = i + 1;
            if(i == current_page)
                html += '<li class="active"><a data-page="' + i + '" href="#">' + display + '</a></li>';
            else
                html += '<li><a data-page="' + i + '" href="#">' + display + '</a></li>';
        }

        html += next + '</ul>';
        return html;
    };

    return {
        init:function(){
            removeHrefPaging();
            paging();
            search();
        }
    };
}();

$(function(){
    regist_work.init();
});