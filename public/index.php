<?php


require_once  '../src/Controleur/accueil.php';

use App\Controle;

// Utiliser la classe MonControleur
use Controleur\accueil;

$controleur = new accueil();

// Appeler une méthode de la classe
$controleur->affiche();