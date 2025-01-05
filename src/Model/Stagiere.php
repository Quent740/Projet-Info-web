<?php
namespace P2114792\Projet\Model;

class Stagiere {
    protected $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllUsers() {
        $stmt = $this->pdo->query("SELECT * FROM entreprise");
        return $stmt->fetchAll();
    }

    public function getEntreprise($NumEntreprise) {
        $stmt = $this->pdo->prepare("SELECT * FROM entreprise WHERE num_entreprise = ?");
        $stmt->execute([$NumEntreprise]);
        return $stmt->fetch();
    }

}
