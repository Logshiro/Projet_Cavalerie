<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendrier FullCalendar</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
    <link rel="stylesheet" href="../Css/Css_header.css">
    <link rel="stylesheet" href="../Css/Css_calendrier.css">
</head>
<body>
    <?php require 'vue_header.php'; ?>

    <main class="container">
        <div id="calendar"></div>

        <form id="eventForm" class="mb-4 d-none" aria-label="Formulaire de gestion des événements">
            <h3 id="formTitle">Ajouter un événement</h3>

            <div class="form-group mb-3">
                <label for="RefCours">Cours</label>
                <input type="text" class="form-control" id="RefCours" placeholder="Rechercher un cours" onkeyup="autocompletCoursI()" required aria-describedby="RefCoursError">
                <div id="nom_list_idCoursI" class="list-group"></div>
                <input type="hidden" class="form-control" name="idCours" id="idCours" readonly required aria-describedby="idCoursError">
                <div id="RefCoursError" class="invalid-feedback">Veuillez sélectionner un cours valide.</div>
            </div>

            <div class="form-group mb-3">
                <label for="selectedDate">Date de l'événement</label>
                <input type="date" class="form-control" id="selectedDate" readonly required aria-describedby="selectedDateError">
                <div id="selectedDateError" class="invalid-feedback">Veuillez sélectionner une date.</div>
            </div>

            <div class="d-flex justify-content-center gap-2 flex-wrap">
                <button id="addEventBtn" class="btn btn-success" type="button" aria-label="Ajouter un événement">Ajouter</button>
                <button id="modifyBtn" class="btn btn-warning d-none" type="button" aria-label="Modifier l'événement">Modifier</button>
                <button id="deleteBtn" class="btn btn-danger d-none" type="button" aria-label="Supprimer l'événement">Supprimer</button>
                <button id="cancelEventBtn" class="btn btn-secondary" type="button" aria-label="Annuler la sélection">Annuler</button>
            </div>
        </form>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script src="../Js/Script_inscrit.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var eventForm = document.getElementById('eventForm');
            var formTitle = document.getElementById('formTitle');
            var selectedEvent = null;
            var selectedDate = null;

            // Fonction pour formater une date en YYYY-MM-DD dans le fuseau horaire local
            function formatLocalDate(date) {
                const year = date.getFullYear();
                const month = String(date.getMonth() + 1).padStart(2, '0');
                const day = String(date.getDate()).padStart(2, '0');
                return `${year}-${month}-${day}`;
            }

            var calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                initialDate: new Date().toISOString().slice(0, 10),
                navLinks: true,
                selectable: true,
                editable: true,
                events: function(fetchInfo, successCallback, failureCallback) {
                    fetch('../Class/class_calendrier2.php')
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Erreur HTTP : ' + response.status);
                            }
                            return response.json();
                        })
                        .then(data => {
                            console.log('Événements reçus :', data);
                            if (data.success === false) {
                                alert('Erreur serveur : ' + data.message);
                                successCallback([]);
                                return;
                            }
                            if (Array.isArray(data) && data.length === 0) {
                                console.warn('Aucun événement à afficher');
                            }
                            data.forEach(event => {
                                // Convertir la date en objet Date local
                                event.start = new Date(event.start + 'T00:00:00');
                            });
                            successCallback(data);
                        })
                        .catch(error => {
                            console.error('Erreur lors de la récupération des événements :', error);
                            alert('Impossible de charger les événements : ' + error.message);
                            failureCallback(error);
                        });
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
                eventForm.reset();
                eventForm.querySelectorAll('.invalid-feedback').forEach(error => error.style.display = 'none');
                eventForm.querySelectorAll('.form-control').forEach(input => input.classList.remove('is-invalid'));
                document.getElementById('selectedDate').value = date;
                selectedDate = date;
                formTitle.textContent = 'Ajouter un événement';

                eventForm.classList.remove('d-none');
                document.getElementById('addEventBtn').classList.remove('d-none');
                document.getElementById('modifyBtn').classList.add('d-none');
                document.getElementById('deleteBtn').classList.add('d-none');

                document.getElementById('addEventBtn').onclick = function() {
                    addEvent(selectedDate);
                };

                document.getElementById('cancelEventBtn').onclick = function() {
                    eventForm.classList.add('d-none');
                };

                calendar.unselect();
            }

            function showModifyDeleteForm(arg) {
                selectedEvent = arg.event;

                // Formater la date en local pour éviter le décalage
                const localDate = formatLocalDate(selectedEvent.start);
                console.log('Date de l\'événement sélectionné :', selectedEvent.start, '-> Formatée :', localDate);

                document.getElementById('RefCours').value = selectedEvent.title || '';
                document.getElementById('idCours').value = selectedEvent.extendedProps.idCours || '';
                document.getElementById('selectedDate').value = localDate;
                formTitle.textContent = 'Modifier un événement';

                document.getElementById('addEventBtn').classList.add('d-none');
                document.getElementById('modifyBtn').classList.remove('d-none');
                document.getElementById('deleteBtn').classList.remove('d-none');

                eventForm.classList.remove('d-none');

                const events = document.querySelectorAll('.fc-event');
                events.forEach(event => event.style.backgroundColor = '');
                arg.el.style.backgroundColor = '#f0f0f0';
            }

            function addEvent(date) {
                var idCours = document.getElementById('idCours').value;
                var addBtn = document.getElementById('addEventBtn');

                if (!idCours) {
                    document.getElementById('idCours').classList.add('is-invalid');
                    document.getElementById('idCoursError').style.display = 'block';
                    return;
                }

                addBtn.disabled = true;
                addBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Chargement...';
                fetch('../Class/class_calendrier2.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: new URLSearchParams({
                        action: 'add',
                        idCours: idCours,
                        dateCours: date
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Réponse ajout événement :', data);
                    if (!data.success) {
                        alert(data.message);
                        return;
                    }
                    calendar.refetchEvents();
                    alert(data.message);
                    eventForm.classList.add('d-none');
                })
                .catch(error => {
                    console.error('Erreur lors de l\'ajout de l\'événement :', error);
                    alert('Une erreur est survenue lors de l\'ajout de l\'événement');
                })
                .finally(() => {
                    addBtn.disabled = false;
                    addBtn.innerHTML = 'Ajouter';
                });
            }

            function updateEvent(arg) {
                let startDate = arg.event.start;
                let formattedDate = formatLocalDate(startDate);
                var modifyBtn = document.getElementById('modifyBtn');

                console.log('Mise à jour événement, date envoyée :', formattedDate);

                modifyBtn.disabled = true;
                modifyBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Chargement...';
                fetch('../Class/class_calendrier2.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: new URLSearchParams({
                        action: 'update',
                        idCourSeance: arg.event.id,
                        idCours: arg.event.extendedProps.idCours,
                        dateCours: formattedDate
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Réponse mise à jour événement :', data);
                    if (!data.success) {
                        alert(data.message);
                        return;
                    }
                    console.log(data.message);
                })
                .catch(error => {
                    console.error('Erreur lors de la mise à jour de l\'événement :', error);
                    alert('Une erreur est survenue lors de la mise à jour de l\'événement');
                })
                .finally(() => {
                    modifyBtn.disabled = false;
                    modifyBtn.innerHTML = 'Modifier';
                });
            }

            document.getElementById('modifyBtn').addEventListener('click', function() {
                if (selectedEvent) {
                    var newIdCours = document.getElementById('idCours').value;
                    var newDate = document.getElementById('selectedDate').value;
                    var modifyBtn = document.getElementById('modifyBtn');

                    if (!newIdCours) {
                        document.getElementById('idCours').classList.add('is-invalid');
                        document.getElementById('idCoursError').style.display = 'block';
                        return;
                    }

                    console.log('Modification événement, date envoyée :', newDate);

                    modifyBtn.disabled = true;
                    modifyBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Chargement...';
                    fetch('../Class/class_calendrier2.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        body: new URLSearchParams({
                            action: 'update',
                            idCourSeance: selectedEvent.id,
                            idCours: newIdCours,
                            dateCours: newDate
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Réponse mise à jour événement :', data);
                        if (!data.success) {
                            alert(data.message);
                            return;
                        }
                        calendar.refetchEvents();
                        alert(data.message);
                        resetModifyDeleteButtons();
                        eventForm.classList.add('d-none');
                    })
                    .catch(error => {
                        console.error('Erreur lors de la mise à jour de l\'événement :', error);
                        alert('Une erreur est survenue lors de la mise à jour de l\'événement');
                    })
                    .finally(() => {
                        modifyBtn.disabled = false;
                        modifyBtn.innerHTML = 'Modifier';
                    });
                }
            });

            document.getElementById('deleteBtn').addEventListener('click', function() {
                if (selectedEvent && confirm('Voulez-vous vraiment supprimer cet événement ?')) {
                    var deleteBtn = document.getElementById('deleteBtn');
                    deleteBtn.disabled = true;
                    deleteBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Chargement...';
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
                        console.log('Réponse suppression événement :', data);
                        if (!data.success) {
                            alert(data.message);
                            return;
                        }
                        selectedEvent.remove();
                        alert(data.message);
                        resetModifyDeleteButtons();
                        eventForm.classList.add('d-none');
                    })
                    .catch(error => {
                        console.error('Erreur lors de la suppression de l\'événement :', error);
                        alert('Une erreur est survenue lors de la suppression de l\'événement');
                    })
                    .finally(() => {
                        deleteBtn.disabled = false;
                        deleteBtn.innerHTML = 'Supprimer';
                    });
                }
            });

            function resetModifyDeleteButtons() {
                selectedEvent = null;
                document.getElementById('addEventBtn').classList.remove('d-none');
                document.getElementById('modifyBtn').classList.add('d-none');
                document.getElementById('deleteBtn').classList.add('d-none');
                formTitle.textContent = 'Ajouter un événement';
            }

            window.autocompletCoursI = function() {
                var query = document.getElementById('RefCours').value;
                var list = document.getElementById('nom_list_idCoursI');
                list.innerHTML = '';
                if (query.length < 2) {
                    return;
                }

                fetch('../Class/class_calendrier2.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: new URLSearchParams({ action: 'getCourses' })
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Cours reçus pour autocomplétion :', data);
                    if (!data.success) {
                        list.innerHTML = '<div class="list-group-item text-danger">Erreur : ' + data.message + '</div>';
                        return;
                    }

                    data.data.forEach(course => {
                        if (course.LibCours.toLowerCase().includes(query.toLowerCase()) || 
                            course.jour.toLowerCase().includes(query.toLowerCase())) {
                            var item = document.createElement('div');
                            item.className = 'list-group-item list-group-item-action';
                            item.textContent = course.LibCours + ' (' + course.jour + ' ' + course.HD + '-' + course.HF + ')';
                            item.dataset.id = course.idCours;
                            item.onclick = function() {
                                document.getElementById('RefCours').value = item.textContent;
                                document.getElementById('idCours').value = course.idCours;
                                list.innerHTML = '';
                                document.getElementById('RefCours').classList.remove('is-invalid');
                                document.getElementById('RefCoursError').style.display = 'none';
                            };
                            list.appendChild(item);
                        }
                    });
                })
                .catch(error => {
                    console.error('Erreur lors de l\'autocomplétion :', error);
                    list.innerHTML = '<div class="list-group-item text-danger">Erreur lors de la recherche</div>';
                });
            };

            calendar.render();
        });
    </script>
</body>
</html>