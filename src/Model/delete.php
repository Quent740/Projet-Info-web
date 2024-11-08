<?php
require_once('connect.php');

// Vérification de l'ID dans l'URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Sécurisation de l'ID
    $id = strip_tags($_GET['id']);

    // Requête SQL pour supprimer l'utilisateur
    $sql = "DELETE FROM `users` WHERE `id`=:id;";
    $query = $db->prepare($sql);

    // Liaison de l'ID à la requête
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // Exécution de la requête
    $query->execute();

    // Redirection après suppression
    header('Location: index.php');
}

require_once('close.php');
