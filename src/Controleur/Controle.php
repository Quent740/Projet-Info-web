<?php
namespace P2114792\Projet\Controleur;

use P2114792\Projet\Model\Stagiere;
use P2114792\Projet\Model\Prof;

require_once '../config/database.php';

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
        $this->pdo = $pdo;
    }

    public function accueil() {
        // Afficher la page d'accueil
        echo $this->renderView('accueil.twig');
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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $login = $_POST['login'];
            $mdp = $_POST['mdp'];
            $role = $_POST['role'];
    
            try {
                
                // Vérification en fonction du rôle
                if ($role === 'Eleve') {
                    $stmt = $this->pdo->prepare("SELECT * FROM etudiant WHERE login = ? AND mdp = ?");
                } elseif ($role === 'Professeur') {
                    $stmt = $this->pdo->prepare("SELECT * FROM professeur WHERE login = ? AND mdp = ?");
                } else {
                    throw new Exception("Rôle invalide !");
                }
    
                $stmt->execute([$login, $mdp]);
                $user = $stmt->fetch(\PDO::FETCH_ASSOC);
    
                if ($user) {
                    $_SESSION['role'] = $role;
                    $_SESSION['login'] = $login;
                    // Si les identifiants sont corrects, redirection vers l'accueil
                    header('Location: index.php?action=Accueil');
                    exit;
                } else {
                    // Si les identifiants sont incorrects
                    $error_message = "Identifiant ou mot de passe incorrect.";
                    echo $this->renderView('accueilconnexion.twig', ['error_message' => $error_message]);
                }
            } catch (Exception $e) {
                // En cas d'erreur
                $error_message = "Erreur : " . $e->getMessage();
                echo $this->renderView('accueilconnexion.twig', ['error_message' => $error_message]);
            }
        } else {
            // Afficher simplement la page de connexion
            echo $this->renderView('accueilconnexion.twig');
        }
    }

    public function inscrireStage() {
        // Afficher la page d'accueil
        echo $this->renderView('inscrireStage.twig');
    }

    public function listStagiere() {
        // Afficher la liste des utilisateurs
        $users = $this->Prof1->getAllStagiere();
        echo $this->renderView('Stagiaire.twig',['etudiants' => $users]);
    }
    
    public function Entreprise($NumEntreprise) {
        // Modifier une entreprise
        $user = $this->Prof1->getEntreprise($NumEntreprise);
        echo $this->renderView('EntrepriseEdit.twig', ['entreprise' => $user]);
    }

    public function listEntreprise() {
        // Afficher la liste des utilisateurs
        $users = $this->Prof1->getAllEntreprise();
        echo $this->renderView('Entreprise.twig',['entreprises' => $users]);
    }

    public function editEntreprise($NumEntreprise) {
        // Modifier une entreprise
        $user = $this->Prof1->getEntreprise($NumEntreprise);
        echo $this->renderView('EntrepriseEdit.twig', ['entreprise' => $user]);
    }

    public function editStagiere($NumEtudiant) {
        // Modifier un utilisateur
        $user = $this->Prof1->getStagiere($NumEtudiant);
        echo $this->renderView('StagiaireEdit.twig', ['etudiant' => $user]);
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
            header("Location: /projet-info-web/public/index.php?action=createEntreprise");
        } else {
            echo $this->renderView('Entrepriseajout.twig');
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
            
            header("Location: /projet-info-web/public/index.php?action=updateEntreprise");
        }
    }

    public function deleteEntreprise($NumEntreprise) {
        
        // Supprimer une entreprise
        $this->Prof1->deleteEntreprise($NumEntreprise);
        header("Location: /projet-info-web/public/index.php?action=Entreprise");
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
            echo $this->renderView('StagiaireEdit.twig');
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
        header("Location: /projet-info-web/public/index.php?action=Stagiaire");
    }

}