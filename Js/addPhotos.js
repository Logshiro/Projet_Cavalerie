function handleFileSelect(input) {
    const additionalPhotosDiv = document.getElementById('additional-photos');
    
    // Si un fichier est sélectionné dans le champ actuel
    if (input.files.length > 0) {
        // Crée un nouveau champ unique
        const newInput = document.createElement('input');
        newInput.type = 'file';
        newInput.name = 'LibPhoto[]';
        newInput.className = 'form-control photo-input mt-2';
        newInput.accept = 'image/*';
        newInput.onchange = function() { handleFileSelect(this); };
        additionalPhotosDiv.appendChild(newInput);
    }
}

// function handleFileSelectCL(input) {
//     const additionalCavalierDiv = document.getElementById('additional-cavalier');

//     // Si un fichier est sélectionné dans le champ actuel
//     if (input.value.trim() !== '') {
//         // Crée un nouveau champ unique
//         const newInput = document.createElement('input');
//         newInput.type = 'text';
//         newInput.name = 'RefCavalier[]';
//         newInput.className = 'form-control mt-2';
//         newInput.onchange = function() { handleFileSelectCL(this); };
//         additionalCavalierDiv.appendChild(newInput);
//     }
// }

// function ajouterCavalier() {
//     const container = document.getElementById('cavaliers-container');
    
//     // Créer un nouveau div pour contenir les champs
//     const newDiv = document.createElement('div');
//     newDiv.className = 'cavalier-input mt-2';

//     // Créer le champ de texte
//     const newInput = document.createElement('input');
//     newInput.type = 'text';
//     newInput.name = 'RefCavalier[]';
//     newInput.className = 'form-control';
//     newInput.required = true;
//     newInput.onkeyup = function() { autocomplet_InsertCL(this); };

//     // Créer le div pour la liste d'autocomplétion
//     const listDiv = document.createElement('div');
//     listDiv.className = 'nom_list_idCL list-group';
//     listDiv.style.display = 'none';

//     // Créer le champ caché pour l'ID
//     const hiddenInput = document.createElement('input');
//     hiddenInput.type = 'hidden';
//     hiddenInput.name = 'idCL[]';
//     hiddenInput.className = 'idCL-input';

//     // Ajouter un bouton de suppression
//     const deleteButton = document.createElement('button');
//     deleteButton.type = 'button';
//     deleteButton.className = 'btn btn-danger btn-sm mt-1';
//     deleteButton.textContent = 'Supprimer';
//     deleteButton.onclick = function() {
//         newDiv.remove();
//     };

//     // Assembler tous les éléments
//     newDiv.appendChild(newInput);
//     newDiv.appendChild(listDiv);
//     newDiv.appendChild(hiddenInput);
//     newDiv.appendChild(deleteButton);

//     // Ajouter le nouveau div au container
//     container.appendChild(newDiv);
// }