<?php

// Récupérer les paramètres de l'URL
$action = $_GET['action'] ?? null; // Action de la route
$id = $_GET['id'] ?? null;         // ID dans les routes (ex: pour 'edit', 'delete')
$pdo = null;                        

// Initialisation du contrôleur
$controleur = 'Controle';
$method = 'Connection';

switch ($action) {
    case 'Accueil':
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
    case 'Stagiaire':
        $controller = 'Controle';
        $method = 'Stagiaire';
        break;
    case 'Entreprise':
        $controller = 'Controle';
        $method = 'Entreprise';
        break;
    case 'Deconnection':
        $controller = 'Controle';
        $method = 'Deconnection';
        break;
    case 'Inscrire':
        $controller = 'Controle';
        $method = 'Inscrire';
        break;
    case 'Aide':
        $controller = 'Controle';
        $method = 'Aide';
        break;
    case 'Accueilconnexion':
        $controller = 'Controle';
        $method = 'Connection';
        break;
    default:
        $controller = 'Controle';
        $method = 'Connection'; //listUsers
        break;
}

// Vérifier si le contrôleur et la méthode sont définis et appelés
if ($controller && $method) {
    require_once '../config/database.php'; // Connexion à la base de données
    $controllerClass = 'P2114792\\Projet\\Controleur\\' . $controller;
    $controllerObject = new $controllerClass($pdo);

    // Appeler la méthode du contrôleur avec l'ID si besoin
    if ($action == 'edit' || $action == 'update' || $action == 'delete' ||$action == 'Stagiaire' || $action == 'Entreprise' || $action == 'Deconnection' || $action == 'Inscrire' || $action == 'Aide') {
        $controllerObject->$method($id);
    } else {
        $controllerObject->$method();
    }
} else {
    echo "404 Not Found";
}
