
// autocompletion
function autocompletCavalierI() {
    var min_length = 1; 
    var keyword = $('#RefCavalier').val(); // Récupérer la valeur du champ texte
    
    // Vérifier si le nombre de caractères est suffisant
    if (keyword.length >= min_length) {
        $.ajax({
            url: '../Ajax/ajax_refresh_prend.php', // Fichier PHP pour traiter la requête
            type: 'POST',
            data: { 
                keywordCavalierI: keyword,  // Envoi du mot-clé pour la recherche
            },
            success: function(data) {
                $('#nom_list_idCavalierI').show(); // Afficher les suggestions
                $('#nom_list_idCavalierI').html(data); // Insérer les suggestions dans la liste
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log("Erreur Ajax : " + textStatus + " - " + errorThrown); // Loguer l'erreur en cas de problème
            }
        });
    } else {
        $('#nom_list_idCavalierI').hide(); // Cacher la liste si le mot-clé est trop court
    }
}

function set_item_CavalierI(item,idCavalier) {
    $('#RefCavalier').val(item); // Mettre à jour le champ texte avec la valeur sélectionnée
    $('#nom_list_idCavalierI').hide(); // Cacher la liste des suggestions
    $('#idCavalier').val(idCavalier); // Mettre à jour le champ caché avec l'ID de la commune
}


function autocompletPensionI() {
    var min_length = 1; // Minimum de caractères avant de déclencher l'autocomplétion
    var keyword = $('#RefPension').val();  // Champ d'entrée avec identifiant unique par formulaire

    if (keyword.length >= min_length) {
        $.ajax({
            url: '../Ajax/ajax_refresh_prend.php', // URL de la requête pour obtenir les résultats
            type: 'POST',
            data: {keywordPensionI:keyword},
            success: function(data) {
                $('#nom_list_idPensionI').show(); // Affiche les suggestions
                $('#nom_list_idPensionI').html(data); // Insère les suggestions dans la liste
            },
             error: function(jqXHR, textStatus, errorThrown) {
                console.log("Erreur Ajax : " + textStatus + " - " + errorThrown); // Loguer l'erreur en cas de problème
            }
        });
    } else {
        $('#nom_list_idPensionI').hide(); // Masque les suggestions si le mot-clé est trop court
    }
}
function set_item_PensionI(item, idPension) {
    // Met à jour le champ avec la valeur sélectionnée
    $('#RefPension').val(item);
    // Masque la liste de suggestions
    $('#nom_list_idPensionI').hide();
    // Met à jour le champ caché avec l'ID de la catégorie
    $('#idPension').val(idPension);
}

function autocompletPensionE() {
    var min_length = 1; 
    var keywordPensionE = $('#RefPension').val(); // Récupérer la valeur du champ texte
    
    // Vérifier si le nombre de caractères est suffisant
    if (keywordPensionE.length >= min_length) {
        $.ajax({
            url: '../Ajax/ajax_refresh_prend.php', // Fichier PHP pour traiter la requête
            type: 'POST',
            data: { 
                keywordPensionE: keywordPensionE,  // Envoi du mot-clé pour la recherche
            },
            success: function(data) {
                $('#nom_list_idPensionE').show(); // Afficher les suggestions
                $('#nom_list_idPensionE').html(data); // Insérer les suggestions dans la liste
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log("Erreur Ajax : " + textStatus + " - " + errorThrown); // Loguer l'erreur en cas de problème
            }
        });
    } else {
        $('#nom_list_idPensionE').hide(); // Cacher la liste si le mot-clé est trop court
    }
}

function set_item_PensionE(item,idPension) {
    $('#RefPension').val(item); // Mettre à jour le champ texte avec la valeur sélectionnée
    $('#nom_list_idPensionE').hide(); // Cacher la liste des suggestions
    $('#idPension').val(idPension); // Mettre à jour le champ caché avec l'ID de la commune
}


function autocompletCavalierE() {
    var min_length = 1; // Minimum de caractères avant de déclencher l'autocomplétion
    var keyword = $('#RefCavalier').val();  // Champ d'entrée avec identifiant unique par formulaire

    if (keyword.length >= min_length) {
        $.ajax({
            url: '../Ajax/ajax_refresh_prend.php', // URL de la requête pour obtenir les résultats
            type: 'POST',
            data: {keywordCavalierE:keyword},
            success: function(data) {
                $('#nom_list_idCavalierE').show(); // Affiche les suggestions
                $('#nom_list_idCavalierE').html(data); // Insère les suggestions dans la liste
            },
             error: function(jqXHR, textStatus, errorThrown) {
                console.log("Erreur Ajax : " + textStatus + " - " + errorThrown); // Loguer l'erreur en cas de problème
            }
        });
    } else {
        $('#nom_list_idCavalierE').hide(); // Masque les suggestions si le mot-clé est trop court
    }
}
function set_item_CavalierE(item, idCavalier) {
    // Met à jour le champ avec la valeur sélectionnée
    $('#RefCavalier').val(item);
    // Masque la liste de suggestions
    $('#nom_list_idCavalierE').hide();
    // Met à jour le champ caché avec l'ID de la catégorie
    $('#idCavalier').val(idCavalier);
}