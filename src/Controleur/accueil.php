<?php
namespace App\Controleur;

use App\Controleur\Controle;

class  Accueil extends Controle{
    public function affiche(){
        echo $this->rendu("../vue/accueil.twig");
    }
}
