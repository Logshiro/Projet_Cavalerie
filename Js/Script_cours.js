
// autocompletion
function autocompletGalop() {
    var min_length = 1; 
    var keyword = $('#RefGalop').val(); // Récupérer la valeur du champ texte
    
    // Vérifier si le nombre de caractères est suffisant
    if (keyword.length >= min_length) {
        $.ajax({
            url: '../Ajax/ajax_refresh_cours.php', // Fichier PHP pour traiter la requête
            type: 'POST',
            data: { 
                keyword: keyword,  // Envoi du mot-clé pour la recherche
            },
            success: function(data) {
                $('#nom_list_idGalop').show(); // Afficher les suggestions
                $('#nom_list_idGalop').html(data); // Insérer les suggestions dans la liste
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log("Erreur Ajax : " + textStatus + " - " + errorThrown); // Loguer l'erreur en cas de problème
            }
        });
    } else {
        $('#nom_list_idGalop').hide(); // Cacher la liste si le mot-clé est trop court
    }
}

function set_item(item,idMod) {
    $('#RefGalop').val(item); // Mettre à jour le champ texte avec la valeur sélectionnée
    $('#nom_list_idGalop').hide(); // Cacher la liste des suggestions
    $('#idGalop').val(idMod); // Mettre à jour le champ caché avec l'ID de la commune
}


function autocompletGalopI() {
    var min_length = 1; // Minimum de caractères avant de déclencher l'autocomplétion
    var keyword = $('#RefGalop').val();  // Champ d'entrée avec identifiant unique par formulaire

    if (keyword.length >= min_length) {
        $.ajax({
            url: '../Ajax/ajax_refresh_cours.php', // URL de la requête pour obtenir les résultats
            type: 'POST',
            data: {keywordInsert:keyword},
            success: function(data) {
                $('#nom_list_idGalop').show(); // Affiche les suggestions
                $('#nom_list_idGalop').html(data); // Insère les suggestions dans la liste
            },
             error: function(jqXHR, textStatus, errorThrown) {
                console.log("Erreur Ajax : " + textStatus + " - " + errorThrown); // Loguer l'erreur en cas de problème
            }
        });
    } else {
        $('#nom_list_idGalop').hide(); // Masque les suggestions si le mot-clé est trop court
    }
}
function set_item_Insert(item, idMod) {
    // Met à jour le champ avec la valeur sélectionnée
    $('#RefGalop').val(item);
    // Masque la liste de suggestions
    $('#nom_list_idGalop').hide();
    // Met à jour le champ caché avec l'ID de la catégorie
    $('#idGalop').val(idMod);
}

function autocompletCL() {
    var min_length = 1; 
    var keyword = $('#RefCavalier' ).val(); // Récupérer la valeur du champ texte
        
    // Vérifier si le nombre de caractères est suffisant
    if (keyword.length >= min_length) { 
        $.ajax({
            url: '../Ajax/ajax_refresh_pension.php', // Fichier PHP pour traiter la requête
                type: 'POST',
                data: { 
                    keywordCL: keyword,  // Envoi du mot-clé pour la recherche       // Envoi de l'index pour identifier le champ
                },
                success: function(data) {
                    $('#nom_list_idCL' ).show(); // Afficher les suggestions
                    $('#nom_list_idCL' ).html(data); // Insérer les suggestions dans la liste
                },
                error: function(jqXHR, textStatus, errorThrown) {
                console.log("Erreur Ajax : " + textStatus + " - " + errorThrown); // Loguer l'erreur en cas de problème
            }
        });
    } else {
        $('#nom_list_idCL').hide(); // Cacher la liste si le mot-clé est trop court
    }
}

function set_item_CL(item, idCL) {
    $('#RefCavalier').val(item);
    $('#nom_list_idCL').hide();
    $('#idCL').val(idCL);
}

function autocomplet_InsertCL(uniqueId = '') {
    var min_length = 1;
    // Utilise l'ID unique si fourni, sinon utilise l'ID par défaut
    var inputId = uniqueId ? '#RefCavalier_' + uniqueId : '#RefCavalier';
    var listId = uniqueId ? '#nom_list_idCLI_' + uniqueId : '#nom_list_idCLI';
    
    var keyword = $(inputId).val();
    
    if (keyword.length >= min_length) {
        $.ajax({
            url: '../Ajax/ajax_refresh_pension.php',
            type: 'POST',
            data: { 
                keywordInsertCL: keyword,
                fieldId: uniqueId // Envoyer l'ID unique au serveur si nécessaire
            },
            success: function(data) {
                $(listId).show();
                $(listId).html(data);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log("Erreur Ajax : " + textStatus + " - " + errorThrown);
            }
        });
    } else {
        $(listId).hide();
    }
}

function set_item_InsertCL(item, idCL, uniqueId = '') {
    // Utilise l'ID unique si fourni, sinon utilise l'ID par défaut
    var inputId = uniqueId ? '#RefCavalier_' + uniqueId : '#RefCavalier';
    var listId = uniqueId ? '#nom_list_idCLI_' + uniqueId : '#nom_list_idCLI';
    var hiddenId = uniqueId ? '#idCL_' + uniqueId : '#idCL';
    
    $(inputId).val(item);
    $(listId).hide();
    $(hiddenId).val(idCL);
}

function addCavalierField() {
    var uniqueId = new Date().getTime();
    var newCavalierFields = $('#cavalierFields').clone();

    // Mise à jour des IDs et noms
    newCavalierFields.find('#RefCavalier').attr('id', 'RefCavalier_' + uniqueId)
        .attr('name', 'RefCavalier[]')
        .val('') // Vider le champ cloné
        .attr('onkeyup', 'autocomplet_InsertCL("' + uniqueId + '")');
    
    newCavalierFields.find('#idCL').attr('id', 'idCL_' + uniqueId).attr('name', 'idCL[]');
    newCavalierFields.find('#nom_list_idCLI').attr('id', 'nom_list_idCLI_' + uniqueId);

    newCavalierFields.find('#nom_list_idCLI_' + uniqueId).empty();

    // Ajouter après le dernier groupe de champs cavalier
    $('#cavalierFields').after(newCavalierFields);
}

//fonction à créer
