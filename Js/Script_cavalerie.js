
// autocompletion
function autocompletRace() {
    var min_length = 1; 
    var keyword = $('#RefRace').val(); // Récupérer la valeur du champ texte
    
    // Vérifier si le nombre de caractères est suffisant
    if (keyword.length >= min_length) {
        $.ajax({
            url: '../Ajax/ajax_refresh_cavalerie.php', // Fichier PHP pour traiter la requête
            type: 'POST',
            data: { 
                keywordRace: keyword,  // Envoi du mot-clé pour la recherche
            },
            success: function(data) {
                $('#nom_list_idRace').show(); // Afficher les suggestions
                $('#nom_list_idRace').html(data); // Insérer les suggestions dans la liste
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log("Erreur Ajax : " + textStatus + " - " + errorThrown); // Loguer l'erreur en cas de problème
            }
        });
    } else {
        $('#nom_list_idRace').hide(); // Cacher la liste si le mot-clé est trop court
    }
}

function set_item_Race(item,idRace) {
    $('#RefRace').val(item); // Mettre à jour le champ texte avec la valeur sélectionnée
    $('#nom_list_idRace').hide(); // Cacher la liste des suggestions
    $('#idRace').val(idRace); // Mettre à jour le champ caché avec l'ID de la commune
}


function autocompletRaceI() {
    var min_length = 1; // Minimum de caractères avant de déclencher l'autocomplétion
    var keyword = $('#RefRace').val();  // Champ d'entrée avec identifiant unique par formulaire

    if (keyword.length >= min_length) {
        $.ajax({
            url: '../Ajax/ajax_refresh_cavalerie.php', // URL de la requête pour obtenir les résultats
            type: 'POST',
            data: {keywordRaceI:keyword},
            success: function(data) {
                $('#nom_list_idRaceI').show(); // Affiche les suggestions
                $('#nom_list_idRaceI').html(data); // Insère les suggestions dans la liste
            },
             error: function(jqXHR, textStatus, errorThrown) {
                console.log("Erreur Ajax : " + textStatus + " - " + errorThrown); // Loguer l'erreur en cas de problème
            }
        });
    } else {
        $('#nom_list_idRaceI').hide(); // Masque les suggestions si le mot-clé est trop court
    }
}
function set_item_RaceI(item, idRace) {
    // Met à jour le champ avec la valeur sélectionnée
    $('#RefRace').val(item);
    // Masque la liste de suggestions
    $('#nom_list_idRaceI').hide();
    // Met à jour le champ caché avec l'ID de la catégorie
    $('#idRace').val(idRace);
}

function autocompletRobe() {
    var min_length = 1; 
    var keyword = $('#RefRobe').val(); // Récupérer la valeur du champ texte
    
    // Vérifier si le nombre de caractères est suffisant
    if (keyword.length >= min_length) {
        $.ajax({
            url: '../Ajax/ajax_refresh_cavalerie.php', // Fichier PHP pour traiter la requête
            type: 'POST',
            data: { 
                keywordRobe: keyword,  // Envoi du mot-clé pour la recherche
            },
            success: function(data) {
                $('#nom_list_idRobe').show(); // Afficher les suggestions
                $('#nom_list_idRobe').html(data); // Insérer les suggestions dans la liste
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log("Erreur Ajax : " + textStatus + " - " + errorThrown); // Loguer l'erreur en cas de problème
            }
        });
    } else {
        $('#nom_list_idRobe').hide(); // Cacher la liste si le mot-clé est trop court
    }
}

function set_item_Robe(item,idRobe) {
    $('#RefRobe').val(item); // Mettre à jour le champ texte avec la valeur sélectionnée
    $('#nom_list_idRobe').hide(); // Cacher la liste des suggestions
    $('#idRobe').val(idRobe); // Mettre à jour le champ caché avec l'ID de la commune
}


function autocompletRobeI() {
    var min_length = 1; // Minimum de caractères avant de déclencher l'autocomplétion
    var keyword = $('#RefRobe').val();  // Champ d'entrée avec identifiant unique par formulaire

    if (keyword.length >= min_length) {
        $.ajax({
            url: '../Ajax/ajax_refresh_cavalerie.php', // URL de la requête pour obtenir les résultats
            type: 'POST',
            data: {keywordRobeI:keyword},
            success: function(data) {
                $('#nom_list_idRobeI').show(); // Affiche les suggestions
                $('#nom_list_idRobeI').html(data); // Insère les suggestions dans la liste
            },
             error: function(jqXHR, textStatus, errorThrown) {
                console.log("Erreur Ajax : " + textStatus + " - " + errorThrown); // Loguer l'erreur en cas de problème
            }
        });
    } else {
        $('#nom_list_idRobeI').hide(); // Masque les suggestions si le mot-clé est trop court
    }
}
function set_item_RobeI(item, idRobe) {
    // Met à jour le champ avec la valeur sélectionnée
    $('#RefRobe').val(item);
    // Masque la liste de suggestions
    $('#nom_list_idRobeI').hide();
    // Met à jour le champ caché avec l'ID de la catégorie
    $('#idRobe').val(idRobe);
}