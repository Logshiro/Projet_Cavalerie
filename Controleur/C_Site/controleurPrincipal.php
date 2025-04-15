<?php
/*
 * Description de controleurPrincipal.php
 * 
 * @author Quentin
 * Creation 01/2024
 * Derniere MAJ 05/01/2022
*/
    function controleurPrincipal(string $action) {
        //var_dump($action);
        $lesActions = [
            "defaut" => "../../Vue/Vue_Site/accueil.php",
            "acceuil" => "../../Vue/Vue_Site/accueil.php",
            "cavalerie_site" => "../../Vue/Vue_Site/cavalerie.php",
            "pension_site" => "../../Vue/Vue_Site/pension.php",
            "cours_site" => "../../Vue/Vue_Site/cours.php",
            "evenement_site" => "../../Vue/Vue_Site/evenement.php",
            "contact_site" => "../../Vue/Vue_Site/contact.php",
            "connexion_site" => "c_connexion.php",
            "inscription_site" => "c_inscription.php",
            "cavalerie" => "c_cavalerie.php",
            "cavalier" => "c_cavalier.php",
            "inscrit" => "c_inscrit.php",
            "evenement" => "c_evenement.php",
            "galop" => "c_galop.php",
            "pension" => "c_pension.php",
            "race" => "c_race.php",
            "robe" => "c_robe.php",
            "cours" => "c_cours.php",
            "prend" => "c_prend.php",
            "calendrier" => "c_calendrier.php",
            "deconnexion" => "c_deconnexion.php",
            "espace_personnel" => "../../Vue/Vue_Site/vue_espace_personnel.php",
            "photos_cavalier" => "../../modele/fonction/getImage.php",
        ];

        // Ensure the action is valid and return the corresponding file
        if (array_key_exists($action, $lesActions)) {
            return $lesActions[$action];
        } else {
            return $lesActions["defaut"];
        }
    }

    // <ul>
    //             <li><a href="?action=acceuil">Accueil</a></li>
    //             <li><a href="?action=cavalerie_site">Cavalerie</a></li>
    //             <li><a href="?action=pension_site" class="active">Pension</a></li>
    //             <li><a href="?action=cours_site">Cours</a></li>
    //             <li><a href="?action=evenement_site" class="active">Événements</a></li>
    //             <li><a href="?action=contact_site">Contact</a></li>
    //             <li class="auth-buttons">
    //                 <a href="?action=connexion_site" class="btn-login">Connexion</a>
    //             </li>
    //         </ul>