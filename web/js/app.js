$(document).on('click', '#add_category', function(){
    var category_id = $(this).attr('data-category_id');
    $.ajax({
        type: 'get',
        url: `category/form/${category_id}`,
        success: function(response) {
            $('#Category_Modal').html(response);
            $('#Category_Modal').modal('show');
            $("#parent_id option[value=" + $('#parent_id').attr('data_parent_id') + "]").attr('selected', 'true');
        }
    });
});


$(document).on('click', '#add_item', function(){
    var category_id = $(this).attr('data-category_id');
    var item_id = $(this).attr('data-item_id');
    $.ajax({
        type: 'get',
        url: `item/form/${category_id}/${item_id}`,
        success: function(response) {
            $('#Category_Modal').html(response);
            $('#Category_Modal').modal('show');
            $("#category_id option[value=" + $('#category_id').attr('data_parent_id') + "]").attr('selected', 'true');
        }
    });
});

$( document ).ready(function() {
    $(".category_li").each(function () {
        var count = $(this).find('.item_li').length;
        $(this).find('.count_item').text(count);
    });

    if(sessionStorage.getItem('test1bit_main_sort_params') != 0){
        $(`#main_sort_select option[value='${sessionStorage.getItem('test1bit_main_sort_params')}']`).attr('selected', 'true');
        $('#secondary_sort_select').append(`<option value="1">По возрастанию</option>`);
        $('#secondary_sort_select').append(`<option value="2">По убыванию</option>`);
        $(`#secondary_sort_select option[value='${sessionStorage.getItem('test1bit_secondary_sort_params')}']`).attr('selected', 'true');
    }
    
});

$(document).on('input keyup', '#main_sort_select', function() {
    if($("#main_sort_select").val() != 0){
        $('#secondary_sort_select').empty();
        $('#secondary_sort_select').append(`<option value="1">По возрастанию</option>`);
        $('#secondary_sort_select').append(`<option value="2">По убыванию</option>`);
    }else{
        $('#secondary_sort_select').empty();
    }
});

$(document).on('input keyup', '.sort_select', function() {
    sessionStorage.setItem('test1bit_main_sort_params', $("#main_sort_select").val());
    sessionStorage.setItem('test1bit_secondary_sort_params', $("#secondary_sort_select").val());
    var sort_param_main = $("#main_sort_select").val();
    var sort_param_secondary = $("#secondary_sort_select").val();
    $.ajax({
        type: 'post',
        url: "site/sort/",
        data:{
            'sort_param_main': sort_param_main,
            'sort_param_secondary': sort_param_secondary
        },
        success: function(response) {
            location.reload();
        }
    });
});