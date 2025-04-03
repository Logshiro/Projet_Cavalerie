<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Calendrier FullCalendar</title>
  
  <script src="../Js/jquery.min.js"></script>
  <script src="../Js/Script_calendrier.js"></script>
  <script src="../JS/Script_inscrit.js"></script>
  <link rel="stylesheet" href="../Css/Css_calendrier.css">

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');
      var selectedEvent = null;  // Événement sélectionné
      var selectedDate = null;   // Date sélectionnée

      var calendar = new FullCalendar.Calendar(calendarEl, {
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        initialDate: new Date().toISOString().slice(0, 10), // Date actuelle
        navLinks: true, // Navigation par clic sur un jour/semaine
        selectable: true, // Permet la sélection d'un jour
        editable: true, // Permet de modifier les événements
        events: function(fetchInfo, successCallback, failureCallback) {
          // Récupération des événements avec conversion correcte des dates
          fetch('../Class/class_calendrier2.php')
            .then(response => response.json())
            .then(events => {
              events.forEach(event => {
                event.start = new Date(event.start); // Convertir la date de début en objet Date
                event.end = new Date(event.end);     // Convertir la date de fin en objet Date
              });
              successCallback(events);
            })
            .catch(failureCallback);
        },
        select: function(arg) {
          showEventForm(arg.startStr);
        },
        eventClick: function(arg) {
          showModifyDeleteForm(arg);
        },
        eventDrop: function(arg) {
          updateEvent(arg);
        }
      });

      function showEventForm(date) {
        var eventForm = document.getElementById('eventForm');
        eventForm.style.display = 'block';

        selectedDate = date; // Stocker la date sélectionnée
        document.getElementById('selectedDate').value = selectedDate;

        // Bouton "Ajouter l'événement"
        document.getElementById('addEventBtn').onclick = function() {
          addEvent(selectedDate);
        };

        // Bouton "Annuler"
        document.getElementById('cancelEventBtn').onclick = function() {
          eventForm.style.display = 'none';
        };

        calendar.unselect(); // Désélectionner la plage de dates
      }

      function showModifyDeleteForm(arg) {
        selectedEvent = arg.event; // Stocker l'événement sélectionné

        document.getElementById('RefCours').value = selectedEvent.title || '';
        document.getElementById('idCours').value = selectedEvent.extendedProps.idCours || '';

        // Afficher les boutons de modification et suppression
        document.getElementById('modifyBtn').style.display = 'inline-block';
        document.getElementById('deleteBtn').style.display = 'inline-block';

        // Surbrillance de l'événement sélectionné
        const events = document.querySelectorAll('.fc-event');
        events.forEach(event => event.style.backgroundColor = ''); // Réinitialiser
        arg.el.style.backgroundColor = '#f0f0f0'; // Surbrillance
      }

      function addEvent(date) {
        var title = document.getElementById('idCours').value;
        if (title) {
          fetch('../Class/class_calendrier2.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({
              action: 'add',
              idCours: title,
              dateCours: new Date(date).toISOString().slice(0, 10) // Format ISO
            })
          })
          .then(response => response.json())
          .then(data => {
            calendar.refetchEvents(); // Rafraîchir les événements
            alert('Événement ajouté avec succès');
            document.getElementById('eventForm').style.display = 'none';
          })
          .catch(error => console.error('Erreur lors de l\'ajout de l\'événement :', error));
        } else {
          alert('Veuillez saisir un titre pour le cours.');
        }
      }

      function updateEvent(arg) {
        // Utiliser directement la date sans la convertir immédiatement
        let startDate = arg.event.start;
        let formattedDate = startDate.toISOString().slice(0, 10); // Format "YYYY-MM-DD"

        fetch('../Class/class_calendrier2.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: new URLSearchParams({
            action: 'update',
            idCourSeance: arg.event.id,
            idCours: arg.event.extendedProps.idCours,
            dateCours: formattedDate // Passer la date formatée correctement
          })
        })
        .then(response => response.json())
        .then(data => {
          console.log('Événement mis à jour');
        })
        .catch(error => console.error('Erreur lors de la mise à jour de l\'événement :', error));
      }

      // Modification d'événement
      document.getElementById('modifyBtn').addEventListener('click', function() {
        if (selectedEvent) {
          var newIdCours = document.getElementById('idCours').value;
          var newDate = selectedEvent.start; // Utiliser directement l'objet Date, sans conversion

          fetch('../Class/class_calendrier2.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({
              action: 'update',
              idCourSeance: selectedEvent.id,
              idCours: newIdCours,
              dateCours: newDate.toISOString().slice(0, 10) // Utiliser le format correct sans décalage
            })
          })
          .then(response => response.json())
          .then(data => {
            selectedEvent.setProp('title', newIdCours); // Mise à jour du titre
            alert('Événement mis à jour');
            resetModifyDeleteButtons();
          })
          .catch(error => console.error('Erreur lors de la mise à jour de l\'événement :', error));
        }
      });

      // Suppression d'événement
      document.getElementById('deleteBtn').addEventListener('click', function() {
        if (selectedEvent && confirm('Voulez-vous vraiment supprimer cet événement ?')) {
          fetch('../Class/class_calendrier2.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({
              action: 'delete',
              idCourSeance: selectedEvent.id
            })
          })
          .then(response => response.json())
          .then(data => {
            selectedEvent.remove(); // Supprimer l'événement du calendrier
            alert('Événement supprimé');
            resetModifyDeleteButtons();
          })
          .catch(error => console.error('Erreur lors de la suppression de l\'événement :', error));
        }
      });

      function resetModifyDeleteButtons() {
        selectedEvent = null;
        document.getElementById('modifyBtn').style.display = 'none';
        document.getElementById('deleteBtn').style.display = 'none';
      }

      calendar.render();
    });
  </script>
</head>
<body>
  <div id="calendar"></div>

  <?php
    require_once __DIR__ . '/../Class/class_calendrier2.php';
    $Calendrier = new Calendrier("","","");
    $OneCalendrier = $Calendrier->getEvents();
  ?>

  <!-- Formulaire de modification d'événement -->
  <div>
    <div id="eventForm" style="display: none;">
      <label for="RefCours">Cours :</label>
      <input type="text" id="RefCours" placeholder="Titre du cours" onkeyup="autocompletCoursI()" required />
      <div id="nom_list_idCoursI" class="list-group"></div>
      <input type="text" name="idCours" id="idCours" value="<?= isset($Modif) && $Modif ? htmlspecialchars($Calendrier->getCoursInscrit($OneCalendrier['Cour']), ENT_QUOTES, 'UTF-8') : '' ?>" />

      <!-- Affichage de la date sélectionnée -->
      <label for="selectedDate">Date de l'événement :</label>
      <input type="text" id="selectedDate" readonly />

      <!-- Boutons de modification et suppression -->
      <button id="addEventBtn">Ajouter l'événement</button>
      <button id="modifyBtn" style="display: none;">Modifier l'événement</button>
      <button id="deleteBtn" style="display: none;">Supprimer l'événement</button>
      <button id="cancelEventBtn">Annuler la sélection</button>
    </div>
  </div>

  <script>
    function cancelDateSelection() {
      document.getElementById('selectedDate').value = ''; // Réinitialise la date
      selectedDate = null; // Réinitialise la date sélectionnée
    }
  </script>
</body>
</html>