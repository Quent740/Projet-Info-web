<?php
namespace P2114792\Projet\Model;

class User {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllUsers() {
        $stmt = $this->pdo->query("SELECT * FROM entreprise");
        return $stmt->fetchAll();
    }

    public function getUserById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM entreprise WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function createUser($name, $email) {
        $stmt = $this->pdo->prepare("INSERT INTO entreprise (name, email) VALUES (?, ?)");
        return $stmt->execute([$name, $email]);
    }

    public function updateUser($id, $name, $email) {
        $stmt = $this->pdo->prepare("UPDATE entreprise SET name = ?, email = ? WHERE id = ?");
        return $stmt->execute([$name, $email, $id]);
    }

    public function deleteUser($id) {
        $stmt = $this->pdo->prepare("DELETE FROM entreprise WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
