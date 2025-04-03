function autocompletRefG_Insert() {
    var min_length = 1; // Minimum de caractères avant de déclencher l'autocomplétion
    var keyword = $('#RefG').val();  // Champ d'entrée avec identifiant unique par formulaire

    if (keyword.length >= min_length) {
        $.ajax({
            url: 'Ajax/ajax_refresh_cavalier.php', // URL de la requête pour obtenir les résultats
            type: 'POST',
            data: {keywordInsert:keyword},
            success: function(data) {
                $('#nom_list_idRefG').show(); // Affiche les suggestions
                $('#nom_list_idRefG').html(data); // Insère les suggestions dans la liste
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("Erreur Ajax :", {
                    status: jqXHR.status,
                    statusText: jqXHR.statusText,
                    responseText: jqXHR.responseText,
                    textStatus: textStatus,
                    errorThrown: errorThrown
                });
                
                $('#nom_list_idRefG').html('<div class="error-message">Une erreur est survenue lors de la recherche. Veuillez réessayer.</div>');
                $('#nom_list_idRefG').show();
            }
        });
    } else {
        $('#nom_list_idRefG').hide(); // Masque les suggestions si le mot-clé est trop court
    }
}
function set_item_InsertGalop(item, idMod) {
    // Met à jour le champ avec la valeur sélectionnée
    $('#RefG').val(item);
    // Masque la liste de suggestions
    $('#nom_list_idRefG').hide();
    // Met à jour le champ caché avec l'ID de la catégorie
    $('#idGalop').val(idMod);
}