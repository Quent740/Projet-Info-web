<?php
use P2114792\Projet\Controleur\Accueil;

// Récupérer les paramètres de l'URL
$action = $_GET['action'] ?? null; // Action de la route
$id = $_GET['id'] ?? null;         // ID dans les routes (ex: pour 'edit', 'delete')

// Initialisation du contrôleur
$controller = null;
$method = null;

switch ($action) {
    case 'accueil':
        $controller = 'Controle';
        $method = 'accueil';
        break;
    case 'edit':
        $controller = 'Controle';
        $method = 'editUser';
        break;
    case 'update':
        $controller = 'Controle';
        $method = 'updateUser';
        break;
    case 'delete':
        $controller = 'Controle';
        $method = 'deleteUser';
        break;
    default:
        $controller = 'Controle';
        $method = 'listUsers';
        break;
}

// Vérifier si le contrôleur et la méthode sont définis et appelés
if ($controller && $method) {
    require_once '../config/database.php'; // Connexion à la base de données
    $controllerClass = 'P2114792\\Projet\\Controleur\\' . $controller;
    $controllerObject = new $controllerClass($pdo);

    // Appeler la méthode du contrôleur avec l'ID si besoin
    if ($action == 'edit' || $action == 'update' || $action == 'delete') {
        $controllerObject->$method($id);
    } else {
        $controllerObject->$method();
    }
} else {
    echo "404 Not Found";
}
