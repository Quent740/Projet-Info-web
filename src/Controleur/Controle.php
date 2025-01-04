<?php
namespace P2114792\Projet\Controleur;
use P2114792\Projet\Model\User;

class Controle {
    private $userModel;

    public function __construct($pdo) {
        $this->userModel = new User($pdo);
    }

    public function accueil() {
        // Afficher la page d'accueil
        echo $this->renderView('accueil.twig');
    }

    public function listUsers() {
        // Afficher la liste des utilisateurs
        $users = $this->userModel->getAllUsers();
        echo $this->renderView('list.twig', ['users' => $users]);
    }

    public function createUser() {
        // Ajouter un utilisateur (demande de POST)
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $this->userModel->createUser($name, $email);
            header("Location: /projet-info-web/public/index.php?action=listUsers");
        } else {
            echo $this->renderView('create.twig');
        }
    }

    public function editUser($id) {
        // Modifier un utilisateur
        $user = $this->userModel->getUserById($id);
        echo $this->renderView('edit.twig', ['user' => $user]);
    }

    public function updateUser($id) {
        // Mettre à jour un utilisateur
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $this->userModel->updateUser($id, $name, $email);
            header("Location: /projet-info-web/public/index.php?action=listUsers");
        }
    }

    public function deleteUser($id) {
        // Supprimer un utilisateur
        $this->userModel->deleteUser($id);
        header("Location: /projet-info-web/public/index.php?action=listUsers");
    }

    private function renderView($view, $data = []) {
        $loader = new \Twig\Loader\FilesystemLoader('../src/vue');
        $twig = new \Twig\Environment($loader);
        return $twig->render($view, $data);
    }
}