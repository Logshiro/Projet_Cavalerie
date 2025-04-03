<?php
session_start();
    include_once "vue.header.php";
?>
</php>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
    <h1>Inscription</h1>
    <form action="./?action=defaut" method="post">
        <label for="mail">Email :</label>
        <input type="email" id="mail" name="mail" required><br><br>

        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required><br><br>

        <button type="submit">S'inscrire</button>
    </form>
</body>
</html>