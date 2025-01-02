<?php
namespace App\Controleur;

class Accueil extends Controle{
    public function affiche(){
        $this->rendu("accueil.twig");
    }
}
