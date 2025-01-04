// /public/index.php

<?php

use P2114792\Projet\Controleur\Accueil;

// Charger l'autoloader de Composer pour Twig
require_once '../vendor/autoload.php';

// Charger la configuration de la base de données
require_once '../config/routes.php';
$pdo = null;

$controleur = new Accueil($pdo, $twig);

// Appeler une méthode de la classe
$controleur->affiche();