<?php
namespace App\Controle;

class  accueil extends Controle{
    public function affiche(){
        echo $this->rendu("../vue/accueil.twig");
    }
}
