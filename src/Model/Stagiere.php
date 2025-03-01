<?php
namespace P2114792\Projet\Model;

class Stagiere {
    protected $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllEntreprise() {
        $stmt = $this->pdo->query("SELECT * FROM entreprise");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getEntreprise($NumEntreprise) {
        $stmt = $this->pdo->prepare("SELECT * FROM entreprise WHERE num_entreprise = ?");
        $stmt->execute([$NumEntreprise]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

}
