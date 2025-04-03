
// autocompletion
function autocompletRefG() {
    var min_length = 1; 
    var keyword = $('#RefG').val(); // Récupérer la valeur du champ texte
    
    // Vérifier si le nombre de caractères est suffisant
    if (keyword.length >= min_length) {
        $.ajax({
            url: '../Ajax/ajax_refresh_cavalier.php', // Fichier PHP pour traiter la requête
            type: 'POST',
            data: { 
                keyword: keyword,  // Envoi du mot-clé pour la recherche
            },
            success: function(data) {
                $('#nom_list_idRefG').show(); // Afficher les suggestions
                $('#nom_list_idRefG').html(data); // Insérer les suggestions dans la liste
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log("Erreur Ajax : " + textStatus + " - " + errorThrown); // Loguer l'erreur en cas de problème
            }
        });
    } else {
        $('#nom_list_idRefG').hide(); // Cacher la liste si le mot-clé est trop court
    }
}

function set_itemGalop(item,idMod) {
    $('#RefG').val(item); // Mettre à jour le champ texte avec la valeur sélectionnée
    $('#nom_list_idRefG').hide(); // Cacher la liste des suggestions
    $('#idGalop').val(idMod); // Mettre à jour le champ caché avec l'ID de la commune
}


function autocompletRefG_Insert() {
    var min_length = 1; // Minimum de caractères avant de déclencher l'autocomplétion
    var keyword = $('#RefG').val();  // Champ d'entrée avec identifiant unique par formulaire

    if (keyword.length >= min_length) {
        $.ajax({
            url: '../Ajax/ajax_refresh_cavalier.php', // URL de la requête pour obtenir les résultats
            type: 'POST',
            data: {keywordInsert:keyword},
            success: function(data) {
                $('#nom_list_idRefG').show(); // Affiche les suggestions
                $('#nom_list_idRefG').html(data); // Insère les suggestions dans la liste
            },
             error: function(jqXHR, textStatus, errorThrown) {
                console.log("Erreur Ajax : " + textStatus + " - " + errorThrown); // Loguer l'erreur en cas de problème
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