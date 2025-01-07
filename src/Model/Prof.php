<?php
namespace P2114792\Projet\Model;
use P2114792\Projet\Model\Stagiere;

class Prof extends Stagiere {

    public function getAllStagiere() {
        $stmt = $this->pdo->query("SELECT * FROM etudiant");
        return $stmt->fetchAll();
    }

    public function getStagiere($NumEtudiant) {
        $stmt = $this->pdo->prepare("SELECT * FROM etudiant WHERE num_etudiant = ?");
        $stmt->execute([$NumEtudiant]);
        return $stmt->fetch();
    }

    public function createEntreprise($raisonSocial, $email, $NomContact, $NomResp, $Rue, $Ville, $CodePostal, $Tel, $Fax, $Observation, $SiteWeb, $Niveau, $EnActivite) {
        $stmt = $this->pdo->prepare("INSERT INTO entreprise ( email, raison_sociale, nom_contact, nom_resp, rue_entreprise, cp_entreprise, ville_entreprise, tel_entreprise, fax_entreprise, observation, site_entreprise, niveau, en_activite) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([ $email, $NomContact, $NomResp, $Rue, $Ville, $CodePostal, $Tel, $Fax, $Observation, $SiteWeb, $Niveau, $EnActivite, $raisonSocial]);
    }

    public function updateEntreprise($NumEntreprise, $raisonSocial, $email, $NomContact, $NomResp, $Rue, $Ville, $CodePostal, $Tel, $Fax, $Observation, $SiteWeb, $Niveau, $EnActivite) {
        $stmt = $this->pdo->prepare("UPDATE entreprise SET  email = ?, raison_sociale = ?, nom_contact = ?,nom_resp = ?, rue_entreprise = ?, cp_entreprise = ?, ville_entreprise = ?, tel_entreprise = ?,fax_entreprise = ?, observation = ?,site_entreprise = ?, niveau = ?, en_activite = ?,  WHERE num_entreprise = ?");
        return $stmt->execute([$NumEntreprise, $email, $NomContact, $NomResp, $Rue, $Ville, $CodePostal, $Tel, $Fax, $Observation, $SiteWeb, $Niveau, $EnActivite, $raisonSocial]);
    }

    public function deleteEntreprise($NumEntreprise) {
        $stmt = $this->pdo->prepare("DELETE FROM entreprise WHERE num_entreprise = ?");
        return $stmt->execute([$NumEntreprise]);
    }

    public function createStagiere($NomEtudiant, $PrenomEtudiant, $AnneeObtention, $Login, $Mdp, $NumClasse, $EnActivite) {
        $stmt = $this->pdo->prepare("INSERT INTO etudiant ( nom_etudiant, prenom_etudiant, annee_obtention, login, mdp, num_classe, en_activite) VALUES (?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$NomEtudiant, $PrenomEtudiant, $AnneeObtention, $Login, $Mdp, $NumClasse, $EnActivite]);
    }

    public function updateStagiere($NumEtudiant, $NomEtudiant, $PrenomEtudiant, $AnneeObtention, $Login, $Mdp, $NumClasse, $EnActivite) {
        $stmt = $this->pdo->prepare("UPDATE etudiant SET  nom_etudiant = ?, prenom_etudiant = ?, annee_obtention = ?,login = ?, mdp = ?, num_classe = ?, en_activite = ?  WHERE num_etudiant = ?");
        return $stmt->execute([$NumEtudiant, $NomEtudiant, $PrenomEtudiant, $AnneeObtention, $Login, $Mdp, $NumClasse, $EnActivite]);
    }

    public function deleteStagiere($NumEtudiant) {
        $stmt = $this->pdo->prepare("DELETE FROM etudiant WHERE num_etudiant = ?");
        return $stmt->execute([$NumEtudiant]);
    }
}
