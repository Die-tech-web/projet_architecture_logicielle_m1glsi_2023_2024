<?php
require_once 'models/User.php';

class UserController {
    private $userModel;

    public function __construct($db) {
        $this->userModel = new User($db);
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $mot_de_passe = $_POST['mot_de_passe'];
            $user = $this->userModel->authenticateUser($email, $mot_de_passe);

            if ($user) {
                $_SESSION['id_utilisateur'] = $user['id'];
                $_SESSION['user_name'] = $user['nom'];
                $_SESSION['user_type'] = $user['type'];
                header('Location: index.php');
                exit();
            } else {
                $error = "Email ou mot de passe incorrect.";
            }
        }

        include 'views/users/login.php';
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            $mot_de_passe = $_POST['mot_de_passe'];
            $type = 'visiteur';

            if ($this->userModel->createUser($prenom, $nom, $email, $mot_de_passe, $type)) {
                header('Location: index.php?controller=user&action=login');
                exit();
            } else {
                $error = "Erreur lors de l'inscription.";
            }
        }

        include 'views/users/register.php';
    }

    public function profile($id) {
        $user = $this->userModel->getUserById($id);
        include 'views/users/profile.php';
    }

    public function listUsers() {
        if ($_SESSION['user_type'] !== 'administrateur') {
            header('Location: index.php');
            exit();
        }
        $users = $this->userModel->getUsers();
        include 'views/users/list.php';
    }
    
    public function createUser() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $prenom = $_POST['prenom'];
            $nom = $_POST['nom'];
            $email = $_POST['email'];
            $mot_de_passe = $_POST['mot_de_passe'];
            $type = $_POST['type'];

            if ($this->userModel->createUser($prenom, $nom, $email, $mot_de_passe, $type)) {
                header('Location: index.php?controller=user&action=listUsers');
                exit();
            } else {
                $error = "Erreur lors de la création de l'utilisateur.";
            }
        }

        include 'views/users/create.php';
    }

    public function editUser($id) {
        $user = $this->userModel->getUserById($id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $prenom = $_POST['prenom'];
            $nom = $_POST['nom'];
            $email = $_POST['email'];
            $mot_de_passe = $_POST['mot_de_passe'];
            $type = $_POST['type'];

            if ($this->userModel->updateUser($id, $prenom, $nom, $email, $mot_de_passe, $type)) {
                header('Location: index.php?controller=user&action=listUsers');
                exit();
            } else {
                $error = "Erreur lors de la mise à jour de l'utilisateur.";
            }
        }

        include 'views/users/edit.php';
    }

    public function deleteUser($id) {
        if ($_SESSION['user_type'] === 'administrateur') {
            $this->userModel->deleteUser($id);
            header('Location: index.php?controller=user&action=listUsers');
            exit();
        } else {
            header('Location: index.php');
            exit();
        }
    }

    public function logout() {
        session_unset();
        session_destroy();
        header('Location: index.php');
    }
}
?>
