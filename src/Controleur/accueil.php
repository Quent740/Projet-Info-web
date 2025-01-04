<?php
namespace P2114792\Projet\Controleur;

class Accueil extends Controle{
    public function affiche(){
        $this->rendu('../src/vue');
    }
}
