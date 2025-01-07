<?php
session_start();
// Récupérer les paramètres de l'URL
$Role = $_SESSION['role'] ?? null;
$action = $_GET['action'] ?? null; // Action de la route
$id = $_GET['id'] ?? null;         // ID dans les routes (ex: pour 'edit', 'delete')
//$pdo = null;                        

// Initialisation du contrôleur
$controleur = 'Controle';
$method = 'Connection';

switch ($action) {
    case 'Accueil':
        $controller = 'Controle';
        $method = 'accueil';
        break;
    case 'Accueilconnexion':
        $controller = 'Controle';
        $method = 'Connection';
        break;
    case 'inscrireStage':
        if ($Role == 'Professeur') {
            $controller = 'Controle';
            $method = 'inscrireStage';
        } else {
            $controller = 'Controle';
            $method = 'Connection';
        }
        break;
    //insrire Stagiaire
    case 'InscrireStagiaire':
        if ($Role == 'Professeur') {
            $controller = 'Controle';
            $method = 'createStagiere';
        } else {
            $controller = 'Controle';
            $method = 'Connection';
        }
        break;
    //peut etre pas besoin
    case 'editStagiaire':
        $controller = 'Controle';
        $method = 'editStagiere';
        break;
    //update stagiere
    case 'updateStagiaire':
        $controller = 'Controle';
        $method = 'updateStagiere';

        break;
    //delet stagiere
    case 'deleteStagiaire':
        $controller = 'Controle';
        $method = 'deleteStagiere';
        break;
    //afichage stagiere
    case 'Stagiaire':
        if ($Role == 'Professeur') {
            $controller = 'Controle';
            $method = 'listStagiere';
        } else {
            $controller = 'Controle';
            $method = 'Connection';
        }
        break;
    case '1Stagiaire':
        if ($Role == 'Professeur') {
            $controller = 'Controle';
            $method = 'Stagiere';
        } else {
            $controller = 'Controle';
            $method = 'Connection';
        }
        break;
    //insrire Stagiaire
    case 'createEntreprise':
        if ($Role == 'Professeur') {
            $controller = 'Controle';
            $method = 'createEntreprise';
        } else {
            $controller = 'Controle';
            $method = 'Connection';
        }
        break;
    //edit entreprise
    case 'editEntreprise':
        if ($Role == 'Professeur') {
            $controller = 'Controle';
            $method = 'editEntreprise';
        } else {
            $controller = 'Controle';
            $method = 'Connection';
        }
        break;
    //update Entreprise
    case 'updateEntreprise':
        if ($Role == 'Professeur') {
            $controller = 'Controle';
            $method = 'updateEntreprise';
        } else {
            $controller = 'Controle';
            $method = 'Connection';
        }
        break;
    //delet Entreprise
    case 'deleteEntreprise':
        if ($Role == 'Professeur') {
            $controller = 'Controle';
            $method = 'deleteEntreprise';
        } else {
            $controller = 'Controle';
            $method = 'Connection';
        }
        break;
    //afichage entreprise
    case 'Entreprise':
        $controller = 'Controle';
        $method = 'listEntreprise';
        break;
    case '1Entreprise':
        $controller = 'Controle';
        $method = 'Entreprise';
        break;
    case 'Deconnection':
        $controller = 'Controle';
        $method = 'Deconnection';
        break;
    case 'Aide':
        $controller = 'Controle';
        $method = 'Aide';
        break;
    default:
        $controller = 'Controle';
        $method = 'Connection'; 
        break;
}

// Vérifier si le contrôleur et la méthode sont définis et appelés
if ($controller && $method) {
    require_once '../config/database.php'; // Connexion à la base de données
    $controllerClass = 'P2114792\\Projet\\Controleur\\' . $controller;
    $controllerObject = new $controllerClass($pdo);

    // Appeler la méthode du contrôleur avec l'ID si besoin
    if ($action == 'Accueil' || $action == 'Accueilconnexion' || $action == 'Entreprise' ||$action == 'Stagiaire' || $action == 'Deconnection' || $action == 'Aide' || $action == 'InscrireStagiaire' || $action == 'updateStagiaire' || $action == 'deleteStagiaire' || $action == 'editStagiaire' || $action == 'updateEntreprise' || $action == 'deleteEntreprise' || $action == 'editEntreprise' || $action == '1Stagiaire' || $action == '1Entreprise') {
        $controllerObject->$method($id);
    } else {
        $controllerObject->$method();
    }
} else {
    echo "404 Not Found";
}
