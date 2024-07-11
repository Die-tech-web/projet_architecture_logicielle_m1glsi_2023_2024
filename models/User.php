<?php
class User {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function createUser($prenom, $nom, $email, $mot_de_passe, $type) {
        $sql = "INSERT INTO utilisateurs (prenom, nom, email, mot_de_passe, type) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $mot_de_passe = password_hash($mot_de_passe, PASSWORD_BCRYPT);
        $stmt->bind_param("sssss", $prenom, $nom, $email, $mot_de_passe, $type);
        return $stmt->execute();
    }

    public function authenticateUser($email, $mot_de_passe) {
        $sql = "SELECT * FROM utilisateurs WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();

        if ($user && password_verify($mot_de_passe, $user['mot_de_passe'])) {
            return $user;
        }

        return false;
    }

    public function getUserById($id) {
        $sql = "SELECT * FROM utilisateurs WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getUsers() {
        $sql = "SELECT * FROM utilisateurs";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function deleteUser($id) {
        $sql = "DELETE FROM utilisateurs WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function updateUser($id, $prenom, $nom, $email, $mot_de_passe, $type) {
        $sql = "UPDATE utilisateurs SET prenom = ?, nom = ?, email = ?, mot_de_passe = ?, type = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $mot_de_passe = password_hash($mot_de_passe, PASSWORD_BCRYPT);
        $stmt->bind_param("sssssi", $prenom, $nom, $email, $mot_de_passe, $type, $id);
        return $stmt->execute();
    }

    public function saveToken($userId, $token) {
        $sql = "UPDATE utilisateurs SET jeton_authentification = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $token, $userId);
        return $stmt->execute();
    }

    public function getUserByToken($token) {
        $sql = "SELECT * FROM utilisateurs WHERE jeton_authentification = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $token);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}
?>
