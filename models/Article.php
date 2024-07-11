<?php
class Article {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Ajoutez cette méthode si elle n'existe pas encore
    public function getArticles($offset = 0, $limit = 5) {
        $sql = "SELECT articles.*, categories.nom AS nom_categorie 
                FROM articles 
                LEFT JOIN categories ON articles.id_categorie = categories.id 
                ORDER BY date_publication DESC 
                LIMIT ?, ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $offset, $limit);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function countArticles() {
        $sql = "SELECT COUNT(*) as total FROM articles";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc()['total'];
    }

    public function getArticleById($id) {
        $sql = "SELECT * FROM articles WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function createArticle($titre, $contenu, $id_categorie, $id_utilisateur) {
        $sql = "INSERT INTO articles (titre, contenu, id_categorie, id_utilisateur) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssii", $titre, $contenu, $id_categorie, $id_utilisateur);
        return $stmt->execute();
    }

    public function updateArticle($id, $titre, $contenu, $id_categorie) {
        $sql = "UPDATE articles SET titre = ?, contenu = ?, id_categorie = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssii", $titre, $contenu, $id_categorie, $id);
        return $stmt->execute();
    }

    public function deleteArticle($id) {
        $sql = "DELETE FROM articles WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function getCategories() {
        $sql = "SELECT * FROM categories";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getArticlesByCategory($categoryId) {
        $sql = "SELECT * FROM articles WHERE id_categorie = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $categoryId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getArticlesGroupedByCategory() {
        $sql = "SELECT c.nom as categorie, a.id, a.titre, a.contenu 
                FROM articles a 
                JOIN categories c ON a.id_categorie = c.id 
                ORDER BY c.nom";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>
