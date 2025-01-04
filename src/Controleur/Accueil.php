<?php
namespace P2114792\Projet\Controleur;

class Accueil extends Controle{
    public function affiche(){
        echo $this->rendu('accueil.twig');
    }
}
