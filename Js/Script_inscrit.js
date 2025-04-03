
// autocompletion
function autocompletCavalierI() {
    var min_length = 1; 
    var keyword = $('#RefCavalier').val(); // Récupérer la valeur du champ texte
    
    // Vérifier si le nombre de caractères est suffisant
    if (keyword.length >= min_length) {
        $.ajax({
            url: '../Ajax/ajax_refresh_inscrit.php', // Fichier PHP pour traiter la requête
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

function autocompletCoursI() {
    var min_length = 1; // Minimum de caractères avant de déclencher l'autocomplétion
    var keyword = $('#RefCours').val();  // Champ d'entrée avec identifiant unique par formulaire

    if (keyword.length >= min_length) {
        $.ajax({
            url: '../Ajax/ajax_refresh_inscrit.php', // URL de la requête pour obtenir les résultats
            type: 'POST',
            data: {keywordCoursI:keyword},
            success: function(data) {
                $('#nom_list_idCoursI').show(); // Affiche les suggestions
                $('#nom_list_idCoursI').html(data); // Insère les suggestions dans la liste
            },
             error: function(jqXHR, textStatus, errorThrown) {
                console.log("Erreur Ajax : " + textStatus + " - " + errorThrown); // Loguer l'erreur en cas de problème
            }
        });
    } else {
        $('#nom_list_idCoursI').hide(); // Masque les suggestions si le mot-clé est trop court
    }
}
function set_item_CoursI(item, idCours) {
    // Met à jour le champ avec la valeur sélectionnée
    $('#RefCours').val(item);
    // Masque la liste de suggestions
    $('#nom_list_idCoursI').hide();
    // Met à jour le champ caché avec l'ID de la catégorie
    $('#idCours').val(idCours);
}

function autocompletCoursE() {
    var min_length = 1; 
    var keyword = $('#RefCours').val(); // Récupérer la valeur du champ texte
    
    // Vérifier si le nombre de caractères est suffisant
    if (keyword.length >= min_length) {
        $.ajax({
            url: '../Ajax/ajax_refresh_inscrit.php', // Fichier PHP pour traiter la requête
            type: 'POST',
            data: { 
                keywordCoursE: keyword,  // Envoi du mot-clé pour la recherche
            },
            success: function(data) {
                $('#nom_list_idCoursE').show(); // Afficher les suggestions
                $('#nom_list_idCoursE').html(data); // Insérer les suggestions dans la liste
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log("Erreur Ajax : " + textStatus + " - " + errorThrown); // Loguer l'erreur en cas de problème
            }
        });
    } else {
        $('#nom_list_idCoursE').hide(); // Cacher la liste si le mot-clé est trop court
    }
}

function set_item_CoursE(item,idCours) {
    $('#RefCours').val(item); // Mettre à jour le champ texte avec la valeur sélectionnée
    $('#nom_list_idCoursE').hide(); // Cacher la liste des suggestions
    $('#idCours').val(idCours); // Mettre à jour le champ caché avec l'ID de la commune
}


function autocompletCavalierE() {
    var min_length = 1; // Minimum de caractères avant de déclencher l'autocomplétion
    var keyword = $('#RefCavalier').val();  // Champ d'entrée avec identifiant unique par formulaire

    if (keyword.length >= min_length) {
        $.ajax({
            url: '../Ajax/ajax_refresh_inscrit.php', // URL de la requête pour obtenir les résultats
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