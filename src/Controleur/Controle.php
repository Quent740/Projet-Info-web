<?php

class Controle {
    protected function rendu($view,$data = []) {


        $loader = new \Twig\Loader\FilesystemLoader('vue');
        $twig = new \Twig\Environment($loader, [
            'cache' => false,
        ]);

        echo $twig->render($view,$data);

    }
}