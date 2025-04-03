<?php
session_start();
session_unset();
session_destroy();
$message = urlencode("Vous avez été déconnecté avec succès.");
header("Location: index.php?action=acceuil&message=$message");
die();
?>