<?php
require_once('connect.php');
require_once 'vendor/autoload.php'; // Pour charger Twig

// Initialisation de Twig
$loader = new \Twig\Loader\FilesystemLoader('vue'); // Répertoire contenant les fichiers .twig
$twig = new \Twig\Environment($loader, [
    'cache' => false, // Activer le cache en production
]);

session_start(); // Démarrer la session pour stocker les messages d'erreur

// Traitement du formulaire d'ajout d'utilisateur
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        isset($_POST['login']) && !empty($_POST['login']) &&
        isset($_POST['password']) && !empty($_POST['password']) &&
        isset($_POST['firstname']) && !empty($_POST['firstname']) &&
        isset($_POST['lastname']) && !empty($_POST['lastname']) &&
        isset($_POST['description']) && !empty($_POST['description']) &&
        isset($_POST['role']) && !empty($_POST['role']) &&
        isset($_POST['enabled']) && !empty($_POST['enabled'])
    ) {
        // Récupérer les valeurs du formulaire
        $login = strip_tags($_POST['login']);
        $password = strip_tags($_POST['password']);
        $firstname = strip_tags($_POST['firstname']);
        $lastname = strip_tags($_POST['lastname']);
        $description = strip_tags($_POST['description']);
        $role = strip_tags($_POST['role']);
        $enabled = (int)strip_tags($_POST['enabled']); // S'assurer que 'enabled' est un entier

        // Requête SQL pour insérer les données (id est auto-généré)
        $sql = "INSERT INTO users (login, password, firstname, lastname, description, role, enabled) 
                VALUES (:login, :password, :firstname, :lastname, :description, :role, :enabled);";

        $query = $db->prepare($sql);
        
        // Lier les paramètres
        $query->bindValue(':login', $login, PDO::PARAM_STR);
        $query->bindValue(':password', $password, PDO::PARAM_STR);
        $query->bindValue(':firstname', $firstname, PDO::PARAM_STR);
        $query->bindValue(':lastname', $lastname, PDO::PARAM_STR);
        $query->bindValue(':description', $description, PDO::PARAM_STR);
        $query->bindValue(':role', $role, PDO::PARAM_STR);
        $query->bindValue(':enabled', $enabled, PDO::PARAM_BOOL);
        
        // Exécuter la requête
        if ($query->execute()) {
            $_SESSION['message'] = "Utilisateur ajouté avec succès !";
            header('Location: index.php');
            exit(); // Important pour arrêter le script après redirection
        } else {
            $_SESSION['error'] = "Erreur lors de l'ajout de l'utilisateur.";
        }
    } else {
        $_SESSION['error'] = "Veuillez remplir tous les champs.";
    }
}

// Affichage du template Twig
echo $twig->render('add.twig', ['session' => $_SESSION]);

require_once('close.php');
?>
