<?php
namespace P2114792\Projet\Controleur;

use P2114792\Projet\Model\Stagiere;
use P2114792\Projet\Model\Prof;

class Controle {
    private $Stagierel;
    private $Prof1;

    private function renderView($view, $data = []) {
        $loader = new \Twig\Loader\FilesystemLoader('../src/vue');
        $twig = new \Twig\Environment($loader);
        return $twig->render($view, $data);
    }

    public function __construct($pdo) {
        $this->Stagierel = new Stagiere($pdo);
        $this->Prof1 = new Prof($pdo);
    }

    public function accueil() {
        // Afficher la page d'accueil
        echo $this->renderView('accueil.twig');
    }

    public function Entreprise() {
        // Afficher la page d'accueil
        echo $this->renderView('Entreprise.twig');
    }

    public function Stagiaire() {
        // Afficher la page d'accueil
        echo $this->renderView('Stagiaire.twig');
    }

    public function Inscrire() {
        // Afficher la page d'accueil
        echo $this->renderView('Inscrire.twig');
    }

    public function Aide() {
        // Afficher la page d'accueil
        echo $this->renderView('Aide.twig');
    }

    public function Deconnection() {
        // Afficher la page d'accueil
        echo $this->renderView('Deconnection.twig');
    }

    public function Connection() {
        // Afficher la page d'accueil
        echo $this->renderView('accueilconnexion.twig');
    }
    
    //modifier pour etudiant aussi
    public function listEntreprise() {
        // Afficher la liste des utilisateurs
        $users = $this->Prof1->getAllEntreprise();
        echo $this->renderView('list.twig', ['users' => $users]);
    }

    public function editEntreprise($NumEntreprise) {
        // Modifier une entreprise
        $user = $this->Prof1->getEntreprise($NumEntreprise);
        echo $this->renderView('EntrepriseEdit.twig', ['num_entreprise' => $user]);
    }

    public function editStagiere($NumEtudiant) {
        // Modifier un utilisateur
        $user = $this->Prof1->getStagiere($NumEtudiant);
        echo $this->renderView('StagiaireEdit.twig', ['num_etudiant' => $user]);
    }

    public function createEntreprise() {
        // Ajouter une entreprise (demande de POST)
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $raisonSocial = $_POST['raison_sociale'];
            $NomContact = $_POST['nom_contact'];
            $NomResp = $_POST['nom_resp'];
            $Rue = $_POST['rue_entreprise'];
            $CodePostal = $_POST['cp_entreprise'];
            $Ville = $_POST['ville_entreprise'];
            $Tel = $_POST['tel_entreprise'];
            $Fax = $_POST['fax_entreprise'];
            $email = $_POST['email'];
            $Observation = $_POST['observation'];
            $SiteWeb = $_POST['site_entreprise'];
            $Niveau = $_POST['niveau'];
            $EnActivite = $_POST['en_activite'];

            $this->Prof1->createEntreprise($raisonSocial, $email, $NomContact, $NomResp, $Rue, $Ville, $CodePostal, $Tel, $Fax, $Observation, $SiteWeb, $Niveau, $EnActivite);
            header("Location: /projet-info-web/public/index.php?action=EntrepriseEdit");
        } else {
            echo $this->renderView('create.twig');
        }
    }

    public function updateEntreprise($NumEntreprise) {
        // Mettre à jour une entreprise
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $raisonSocial = $_POST['raison_sociale'];
            $NomContact = $_POST['nom_contact'];
            $NomResp = $_POST['nom_resp'];
            $Rue = $_POST['rue_entreprise'];
            $CodePostal = $_POST['cp_entreprise'];
            $Ville = $_POST['ville_entreprise'];
            $Tel = $_POST['tel_entreprise'];
            $Fax = $_POST['fax_entreprise'];
            $email = $_POST['email'];
            $Observation = $_POST['observation'];
            $SiteWeb = $_POST['site_entreprise'];
            $Niveau = $_POST['niveau'];
            $EnActivite = $_POST['en_activite'];

            $this->Prof1->updateEntreprise($NumEntreprise, $raisonSocial, $email, $NomContact, $NomResp, $Rue, $Ville, $CodePostal, $Tel, $Fax, $Observation, $SiteWeb, $Niveau, $EnActivite);
            header("Location: /projet-info-web/public/index.php?action=EntrepriseEdit");
        }
    }

    public function deleteEntreprise($NumEntreprise) {
        // Supprimer une entreprise
        $this->Prof1->deleteEntreprise($NumEntreprise);
        header("Location: /projet-info-web/public/index.php?action=listEntreprise");
    }

    public function createStagiere() {
        // Ajouter un utilisateur (demande de POST)
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $NomEtudiant = $_POST['nom_etudiant'];
            $PrenomEtudiant = $_POST['prenom_etudiant'];
            $AnneeObtention = $_POST['annee_obtention'];
            $Login = $_POST['login'];
            $Mdp = $_POST['mdp'];
            $NumClasse = $_POST['num_classe'];
            $EnActivite = $_POST['en_activite'];

            $this->Prof1->createStagiere($NomEtudiant, $PrenomEtudiant, $AnneeObtention, $Login, $Mdp, $NumClasse, $EnActivite);
            header("Location: /projet-info-web/public/index.php?action=StagiaireEdit");
        } else {
            echo $this->renderView('create.twig');
        }
    }

    public function updateStagiere($NumEtudiant) {
        // Mettre à jour un utilisateur
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $NomEtudiant = $_POST['nom_etudiant'];
            $PrenomEtudiant = $_POST['prenom_etudiant'];
            $AnneeObtention = $_POST['annee_obtention'];
            $Login = $_POST['login'];
            $Mdp = $_POST['mdp'];
            $NumClasse = $_POST['num_classe'];
            $EnActivite = $_POST['en_activite'];

            $this->Prof1->updateStagiere($NumEtudiant, $NomEtudiant, $PrenomEtudiant, $AnneeObtention, $Login, $Mdp, $NumClasse, $EnActivite);
            header("Location: /projet-info-web/public/index.php?action=StagiaireEdit");
        }
    }

    public function deleteStagiere($NumEtudiant) {
        // Supprimer un utilisateur
        $this->Prof1->deleteStagiere($NumEtudiant);
        header("Location: /projet-info-web/public/index.php?action=listEtudiant");
    }

}