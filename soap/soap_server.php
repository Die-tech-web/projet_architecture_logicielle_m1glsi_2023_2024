<?php
require_once '../models/User.php';

class UserService {
    private $userModel;

    public function __construct() {
        $db = new mysqli('localhost', 'root', '', 'site');
        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }
        $this->userModel = new User($db);
    }

    public function authenticate($email, $mot_de_passe) {
        $user = $this->userModel->authenticateUser($email, $mot_de_passe);
        if ($user) {
            $token = base64_encode($user['id'] . ':' . $user['email']);
            $this->userModel->saveToken($user['id'], $token);
            return $token;
        }
        return "Invalid credentials";
    }

    public function addUser($token, $prenom, $nom, $email, $mot_de_passe, $type) {
        if ($this->verifyToken($token)) {
            if ($this->userModel->createUser($prenom, $nom, $email, $mot_de_passe, $type)) {
                return "User added successfully";
            }
            return "Error adding user";
        }
        return "Authentication failed";
    }

    public function deleteUser($token, $id) {
        if ($this->verifyToken($token)) {
            if ($this->userModel->deleteUser($id)) {
                return "User deleted successfully";
            }
            return "User not found";
        }
        return "Authentication failed";
    }

    public function modifyUser($token, $id, $prenom, $nom, $email, $mot_de_passe, $type) {
        if ($this->verifyToken($token)) {
            if ($this->userModel->updateUser($id, $prenom, $nom, $email, $mot_de_passe, $type)) {
                return "User modified successfully";
            }
            return "User not found";
        }
        return "Authentication failed";
    }

    public function listUsers($token) {
        if ($this->verifyToken($token)) {
            $users = $this->userModel->getUsers();
            return json_encode($users);
        }
        return "Authentication failed";
    }

    private function verifyToken($token) {
        $user = $this->userModel->getUserByToken($token);
        return $user ? true : false;
    }
}

$options = array('uri' => 'http://localhost/site/soap/soap_server.php');
$server = new SoapServer('http://localhost/site/soap/user_service.wsdl', $options);
$server->setClass('UserService');
$server->handle();
?>
