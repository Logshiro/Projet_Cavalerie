// Fonction d'autocomplétion pour les cavaliers
function autocompletCavalierE() {
    var min_length = 1;
    var keyword = $('#RefCavalier').val();
    
    if (keyword.length >= min_length) {
        $.ajax({
            url: '../Ajax/ajax_refresh_inscrit.php',
            type: 'POST',
            data: {keywordCavalierE: keyword},
            success: function(data) {
                $('#nom_list_idCavalierE').show();
                $('#nom_list_idCavalierE').html(data);
            }
        });
    } else {
        $('#nom_list_idCavalierE').hide();
    }
}

// Fonction pour sélectionner un cavalier
function set_item_CavalierE(item, idCavalier) {
    $('#RefCavalier').val(item);
    $('#nom_list_idCavalierE').hide();
    $('#idCavalier').val(idCavalier);
}

// Fonction d'autocomplétion pour les cours
function autocompletCoursE() {
    var min_length = 1;
    var keyword = $('#RefCours').val();
    
    if (keyword.length >= min_length) {
        $.ajax({
            url: '../Ajax/ajax_refresh_inscrit.php',
            type: 'POST',
            data: {keywordCoursE: keyword},
            success: function(data) {
                $('#nom_list_idCoursE').show();
                $('#nom_list_idCoursE').html(data);
            }
        });
    } else {
        $('#nom_list_idCoursE').hide();
    }
}

// Fonction pour sélectionner un cours
function set_item_CoursE(item, idCours) {
    $('#RefCours').val(item);
    $('#nom_list_idCoursE').hide();
    $('#idCours').val(idCours);
}