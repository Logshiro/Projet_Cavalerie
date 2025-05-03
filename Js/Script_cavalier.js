function autocompletGalop() {
    var min_length = 0;
    var keyword = $('#RefG').val();
    if (keyword.length >= min_length) {
        $.ajax({
            url: '../Ajax/ajax_refresh_cavalier.php',
            type: 'POST',
            data: {keyword:keyword},
            success:function(data){
                $('#nom_list_idG').show();
                $('#nom_list_idG').html(data);
            }
        });
    } else {
        $('#nom_list_idG').hide();
    }
}

function set_itemGalop(item, id) {
    $('#RefG').val(item);
    $('#idG').val(id);
    $('#nom_list_idG').hide();
}

function autocomplet_InsertGalop() {
    var min_length = 0;
    var keyword = $('#RefG').val();
    if (keyword.length >= min_length) {
        $.ajax({
            url: '../Ajax/ajax_refresh_cavalier.php',
            type: 'POST',
            data: {keywordInsert:keyword},
            success:function(data){
                $('#nom_list_idG').show();
                $('#nom_list_idG').html(data);
            }
        });
    } else {
        $('#nom_list_idG').hide();
    }
}

function set_item_InsertGalop(item, id) {
    $('#RefG').val(item);
    $('#idG').val(id);
    $('#nom_list_idG').hide();
}