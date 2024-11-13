<?php



$loader = new \Twig\Loader\FilesystemLoader('vue');  // Le répertoire où se trouvent vos fichiers .twig
$twig = new \Twig\Environment($loader, [
    'cache' => false, // Vous pouvez activer le cache dans un environnement de production
]);

// Rendu du template avec les données
echo $twig->render('index.twig', ['users' => $result]);
