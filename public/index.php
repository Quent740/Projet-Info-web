<?php


use App\Controleur\Accueil;

// Charger l'autoloader de Composer pour Twig
require_once '../vendor/autoload.php';

// Charger la configuration de la base de données
require_once '../config/database.php';

// Initialiser Twig
$loader = new Twig\Loader\FilesystemLoader('../src/vue'); // Dossier contenant les fichiers .twig
$twig = new Twig\Environment($loader, [
    'cache' => '../cache',  // Optionnel, pour le cache des templates (recommandé en prod)
]);

$controleur = new Accueil($pdo, $twig);

// Appeler une méthode de la classe
$controleur->affiche();

// Récupérer les paramètres de l'URL
$action = $_GET['action'] ?? null; // Action de la route
$id = $_GET['id'] ?? null;         // ID dans les routes (ex: pour 'edit', 'delete')

// Initialisation du contrôleur
$controller = null;
$method = null;

switch ($action) {
    case 'accueil':
        $controller = 'Controle';
        $method = 'listUsers';
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
    $controllerClass = 'App\\Controleur\\' . $controller;
    $controllerObject = new $controllerClass($pdo, $twig);

    // Appeler la méthode du contrôleur avec l'ID si besoin
    if ($action == 'edit' || $action == 'update' || $action == 'delete') {
        $controllerObject->$method($id);
    } else {
        $controllerObject->$method();
    }
} else {
    echo "404 Not Found";
}