<?php
namespace App\Controleur;

use Twig\Environment;

class Controle {
    private $pdo;
    private $twig;

    public function __construct($pdo, Environment $twig) {
        $this->pdo = $pdo;
        $this->twig = $twig;
    }

    public function rendu($view,$data = []) {
        
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__.'/../../vue');
        $twig = new \Twig\Environment($loader);

        return $this->twig->render($view,$data);

    }

    public function listUsers() {
        // Récupérer tous les utilisateurs de la base de données
        $stmt = $this->pdo->query("SELECT * FROM users");
        $users = $stmt->fetchAll();

        // Rendre la vue avec les utilisateurs via Twig
        echo $this->twig->render('list.twig', ['users' => $users]);
    }

    public function editUser($id) {
        // Récupérer l'utilisateur par son ID
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $user = $stmt->fetch();

        // Rendre la vue d'édition avec l'utilisateur via Twig
        echo $this->twig->render('edit.twig', ['user' => $user]);
    }

    public function updateUser($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données du formulaire
            $name = $_POST['name'];
            $email = $_POST['email'];

            // Mettre à jour l'utilisateur dans la base de données
            $stmt = $this->pdo->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
            $stmt->execute([$name, $email, $id]);

            // Rediriger vers la page d'accueil après la mise à jour
            header("Location: index.php?action=accueil");
        } else {
            // Afficher le formulaire d'édition
            $this->editUser($id);
        }
    }

    public function deleteUser($id) {
        // Supprimer un utilisateur de la base de données
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$id]);

        // Rediriger vers la page d'accueil après suppression
        header("Location: index.php?action=accueil");
    }
}