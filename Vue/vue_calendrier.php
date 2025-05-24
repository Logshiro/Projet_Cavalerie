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
            <h3 id="formTitle">Voir un événement</h3>

            <div class="form-group mb-3">
                <label for="RefCours">Nom du Cours</label>
                <input type="text" class="form-control" id="RefCours" placeholder="Nom du cours" required aria-describedby="RefCoursError">
                <div id="RefCoursError" class="invalid-feedback">Veuillez entrer un nom de cours valide.</div>
            </div>

            <div class="form-group mb-3">
                <label for="jour">Jour</label>
                <select class="form-control" id="jour" required aria-describedby="jourError">
                    <option value="">Sélectionner un jour</option>
                    <option value="Lundi">Lundi</option>
                    <option value="Mardi">Mardi</option>
                    <option value="Mercredi">Mercredi</option>
                    <option value="Jeudi">Jeudi</option>
                    <option value="Vendredi">Vendredi</option>
                    <option value="Samedi">Samedi</option>
                    <option value="Dimanche">Dimanche</option>
                </select>
                <div id="jourError" class="invalid-feedback">Veuillez sélectionner un jour.</div>
            </div>

            <div class="form-group mb-3">
                <label for="HD">Heure de début</label>
                <input type="time" class="form-control" id="HD" required aria-describedby="HDError">
                <div id="HDError" class="invalid-feedback">Veuillez entrer une heure de début valide.</div>
            </div>

            <div class="form-group mb-3">
                <label for="HF">Heure de fin</label>
                <input type="time" class="form-control" id="HF" required aria-describedby="HFError">
                <div id="HFError" class="invalid-feedback">Veuillez entrer une heure de fin valide.</div>
            </div>

            <div class="form-group mb-3">
                <label for="selectedDate">Date du Cours</label>
                <input type="date" class="form-control" id="selectedDate" required aria-describedby="selectedDateError">
                <div id="selectedDateError" class="invalid-feedback">Veuillez sélectionner une date.</div>
            </div>

            <div class="form-group mb-3 cavaliers-section d-none">
                <label>Cavaliers inscrits</label>
                <ul id="cavaliersList" class="list-group"></ul>
            </div>

            <input type="hidden" id="idCours" name="idCours">
            <input type="hidden" id="idCourSeance" name="idCourSeance">

            <div class="d-flex justify-content-center gap-2 flex-wrap">
                <button id="viewBtn" class="btn btn-info d-none" type="button" aria-label="Voir l'événement">Voir</button>
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
            var cavaliersSection = document.querySelector('.cavaliers-section');
            var cavaliersList = document.getElementById('cavaliersList');
            var selectedEvent = null;
            var currentMode = 'view';

            function formatLocalDate(date) {
                if (!(date instanceof Date)) {
                    date = new Date(date);
                }
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
                selectable: false,
                editable: true,
                events: function(fetchInfo, successCallback, failureCallback) {
                    fetch('../Class/class_calendrier2.php', {
                        headers: { 'Accept': 'application/json' }
                    })
                        .then(response => {
                            console.log('Statut HTTP :', response.status);
                            if (!response.ok) {
                                throw new Error('Erreur HTTP : ' + response.status);
                            }
                            return response.text();
                        })
                        .then(text => {
                            console.log('Réponse brute :', text);
                            let data;
                            try {
                                data = JSON.parse(text);
                            } catch (e) {
                                console.error('Erreur JSON :', e, 'Réponse brute :', text);
                                throw new Error('Réponse JSON invalide');
                            }
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
                eventClick: function(arg) {
                    showViewForm(arg);
                },
                eventDrop: function(arg) {
                    updateEventDate(arg);
                }
            });

            function fetchCavaliers(idCours) {
                cavaliersList.innerHTML = '<li class="list-group-item">Chargement...</li>';
                fetch('../Class/class_calendrier2.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded', 'Accept': 'application/json' },
                    body: new URLSearchParams({
                        action: 'getCavaliers',
                        idCours: idCours
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Cavaliers reçus :', data);
                    cavaliersList.innerHTML = '';
                    if (!data.success) {
                        cavaliersList.innerHTML = '<li class="list-group-item text-danger">Erreur : ' + data.message + '</li>';
                        return;
                    }
                    if (data.data.length === 0) {
                        cavaliersList.innerHTML = '<li class="list-group-item">Aucun cavalier inscrit</li>';
                    } else {
                        data.data.forEach(cavalier => {
                            var item = document.createElement('li');
                            item.className = 'list-group-item';
                            item.textContent = cavalier.NomCavalier + ' ' + cavalier.PrenomCavalier;
                            cavaliersList.appendChild(item);
                        });
                    }
                })
                .catch(error => {
                    console.error('Erreur lors de la récupération des cavaliers :', error);
                    cavaliersList.innerHTML = '<li class="list-group-item text-danger">Erreur lors de la récupération des cavaliers</li>';
                });
            }

            function setFormMode(mode) {
                currentMode = mode;
                const inputs = [document.getElementById('RefCours'), document.getElementById('jour'),
                               document.getElementById('HD'), document.getElementById('HF'), document.getElementById('selectedDate')];
                const viewBtn = document.getElementById('viewBtn');
                const modifyBtn = document.getElementById('modifyBtn');
                const deleteBtn = document.getElementById('deleteBtn');

                viewBtn.classList.add('d-none');
                modifyBtn.classList.add('d-none');
                deleteBtn.classList.add('d-none');
                inputs.forEach(input => {
                    input.classList.remove('is-invalid');
                    input.nextElementSibling.style.display = 'none';
                });

                if (mode === 'view') {
                    formTitle.textContent = 'Voir un événement';
                    inputs.forEach(input => input.disabled = true);
                    viewBtn.classList.add('d-none');
                    modifyBtn.classList.remove('d-none');
                    deleteBtn.classList.remove('d-none');
                    cavaliersSection.classList.remove('d-none');
                } else if (mode === 'modify') {
                    formTitle.textContent = 'Modifier un événement';
                    inputs.forEach(input => input.disabled = false);
                    viewBtn.classList.remove('d-none');
                    modifyBtn.classList.remove('d-none');
                    deleteBtn.classList.remove('d-none');
                    cavaliersSection.classList.add('d-none');
                } else if (mode === 'delete') {
                    formTitle.textContent = 'Supprimer un événement';
                    inputs.forEach(input => input.disabled = true);
                    viewBtn.classList.remove('d-none');
                    modifyBtn.classList.remove('d-none');
                    deleteBtn.classList.remove('d-none');
                    cavaliersSection.classList.add('d-none');
                }

                eventForm.classList.remove('d-none');
            }

            function showViewForm(arg) {
                selectedEvent = arg.event;
                const localDate = formatLocalDate(selectedEvent.start);
                
                const title = selectedEvent.title;
                const titleParts = title.match(/(.*) \((.*) (\d{2}:\d{2})-(\d{2}:\d{2})\)/);
                const libCours = titleParts ? titleParts[1] : '';
                const jour = titleParts ? titleParts[2] : '';
                const hd = titleParts ? titleParts[3] : '';
                const hf = titleParts ? titleParts[4] : '';

                document.getElementById('RefCours').value = libCours;
                document.getElementById('jour').value = jour;
                document.getElementById('HD').value = hd;
                document.getElementById('HF').value = hf;
                document.getElementById('selectedDate').value = localDate;
                document.getElementById('idCours').value = selectedEvent.extendedProps.idCours || '';
                document.getElementById('idCourSeance').value = selectedEvent.id;

                setFormMode('view');
                fetchCavaliers(selectedEvent.extendedProps.idCours);

                const events = document.querySelectorAll('.fc-event');
                events.forEach(event => event.style.backgroundColor = '');
                arg.el.style.backgroundColor = '#f0f0f0';
            }

            function updateEventDate(arg) {
                let startDate = arg.event.start;
                let formattedDate = formatLocalDate(startDate);
                var modifyBtn = document.getElementById('modifyBtn');

                console.log('Mise à jour de la date, date envoyée :', formattedDate);

                modifyBtn.disabled = true;
                modifyBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Chargement...';
                fetch('../Class/class_calendrier2.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded', 'Accept': 'application/json' },
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
                        arg.revert();
                        return;
                    }
                    console.log(data.message);
                })
                .catch(error => {
                    console.error('Erreur lors de la mise à jour de l\'événement :', error);
                    alert('Une erreur est survenue lors de la mise à jour de l\'événement');
                    arg.revert();
                })
                .finally(() => {
                    modifyBtn.disabled = false;
                    modifyBtn.innerHTML = 'Modifier';
                });
            }

            document.getElementById('viewBtn').addEventListener('click', function() {
                setFormMode('view');
                fetchCavaliers(selectedEvent.extendedProps.idCours);
            });

            document.getElementById('modifyBtn').addEventListener('click', function() {
                if (currentMode !== 'modify') {
                    setFormMode('modify');
                } else if (selectedEvent) {
                    var newLibCours = document.getElementById('RefCours').value;
                    var newJour = document.getElementById('jour').value;
                    var newHD = document.getElementById('HD').value;
                    var newHF = document.getElementById('HF').value;
                    var newDate = document.getElementById('selectedDate').value;
                    var idCours = document.getElementById('idCours').value;
                    var idCourSeance = document.getElementById('idCourSeance').value;
                    var modifyBtn = document.getElementById('modifyBtn');

                    if (!newLibCours || !newJour || !newHD || !newHF || !newDate || !idCours || !idCourSeance) {
                        document.getElementById('RefCours').classList.add('is-invalid');
                        document.getElementById('jour').classList.add('is-invalid');
                        document.getElementById('HD').classList.add('is-invalid');
                        document.getElementById('HF').classList.add('is-invalid');
                        document.getElementById('selectedDate').classList.add('is-invalid');
                        document.getElementById('RefCoursError').style.display = 'block';
                        document.getElementById('jourError').style.display = 'block';
                        document.getElementById('HDError').style.display = 'block';
                        document.getElementById('HFError').style.display = 'block';
                        document.getElementById('selectedDateError').style.display = 'block';
                        return;
                    }

                    console.log('Modification événement, données envoyées :', { idCourSeance, idCours, newLibCours, newJour, newHD, newHF, newDate });

                    modifyBtn.disabled = true;
                    modifyBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Chargement...';
                    fetch('../Class/class_calendrier2.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded', 'Accept': 'application/json' },
                        body: new URLSearchParams({
                            action: 'update',
                            idCourSeance: idCourSeance,
                            idCours: idCours,
                            libCours: newLibCours,
                            jour: newJour,
                            HD: newHD,
                            HF: newHF,
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
                        resetForm();
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
                if (currentMode !== 'delete') {
                    setFormMode('delete');
                } else if (selectedEvent && confirm('Voulez-vous vraiment supprimer cet événement ?')) {
                    var deleteBtn = document.getElementById('deleteBtn');
                    deleteBtn.disabled = true;
                    deleteBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Chargement...';
                    fetch('../Class/class_calendrier2.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded', 'Accept': 'application/json' },
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
                        resetForm();
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

            document.getElementById('cancelEventBtn').addEventListener('click', function() {
                resetForm();
                eventForm.classList.add('d-none');
            });

            function resetForm() {
                selectedEvent = null;
                currentMode = 'view';
                formTitle.textContent = 'Voir un événement';
                eventForm.reset();
                cavaliersSection.classList.add('d-none');
                cavaliersList.innerHTML = '';
                const inputs = [document.getElementById('RefCours'), document.getElementById('jour'),
                               document.getElementById('HD'), document.getElementById('HF'), document.getElementById('selectedDate')];
                inputs.forEach(input => {
                    input.classList.remove('is-invalid');
                    input.disabled = false;
                    input.nextElementSibling.style.display = 'none';
                });
                document.getElementById('viewBtn').classList.add('d-none');
                document.getElementById('modifyBtn').classList.add('d-none');
                document.getElementById('deleteBtn').classList.add('d-none');
                const events = document.querySelectorAll('.fc-event');
                events.forEach(event => event.style.backgroundColor = '');
            }

            calendar.render();
        });
    </script>
</body>
</html>