<?php

require('../connection_BDO.php');
require('bar_nav_forum.php');

// Vérifier si le formulaire a été soumis
if (isset($_POST['user_id']) && isset($_POST['new_role'])) {
    $user_id = $_POST['user_id'];
    $new_role = $_POST['new_role'];

    // Requête pour mettre à jour le rôle de l'utilisateur
    $query = "UPDATE inscription SET FROLE = ? WHERE ID_USER = ?";
    $stmt = $bdd->prepare($query);
    $stmt->execute([$new_role, $user_id]);

    // Message de confirmation
    echo "<p>Le rôle de l'utilisateur a été changé avec succès.</p>";

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/privilege.css">
    <title>attribution de role</title>
</head>

<body>

    <form class="role"  method="post">
        <h2>Changer le rôle d'un utilisateur</h2>
        <select name="user_id">
            <?php
            // Requête pour récupérer tous les utilisateurs
            $query = "SELECT ID_USER, PSEUDO FROM inscription";
            $result = $bdd->query($query);

            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value=\"{$row['ID_USER']}\">{$row['PSEUDO']}</option>";
            }
            ?>
        </select>
        <br>
        <select class="select" name="new_role">
            <option value="user">Utilisateur</option>
            <option value="admin">Administrateur</option>
        </select>
        <br><br>
        <input id="bnt_change" type="submit" value="Change rôle">
    </form>
</body>

</html>