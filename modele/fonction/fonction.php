<?php

//Fonction pour formater la date pour l'affichage
function getFormattedDateForDisplay($date) {
    if (empty($date)) {
        return '';
    }

    $date = new DateTime($date);
    return $date->format('d-m-Y'); // Format français pour l'affichage
}
?>
