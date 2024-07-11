<?php
require_once 'models/Article.php';

class ArticleController {
    private $articleModel;
    private $db;

    public function __construct($db) {
        $this->articleModel = new Article($db);
        $this->db = $db;
    }

    public function index() {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $articlesPerPage = 5;
        $offset = ($page - 1) * $articlesPerPage;

        // Appel de la méthode getArticles
        $articles = $this->articleModel->getArticles($offset, $articlesPerPage);
        $totalArticles = $this->articleModel->countArticles();
        $hasMorePages = $totalArticles > $offset + $articlesPerPage;

        include 'views/articles/index.php';
    }

    public function view($id) {
        $article = $this->articleModel->getArticleById($id);
        include 'views/articles/view.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $titre = $_POST['titre'];
            $contenu = $_POST['contenu'];
            $id_categorie = $_POST['id_categorie'];
            $id_utilisateur = $_SESSION['user_id'];
            $this->articleModel->createArticle($titre, $contenu, $id_categorie, $id_utilisateur);
            header('Location: index.php?controller=article&action=index');
        } else {
            $categories = $this->articleModel->getCategories();
            include 'views/articles/edit.php';
        }
    }

    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $titre = $_POST['titre'];
            $contenu = $_POST['contenu'];
            $id_categorie = $_POST['id_categorie'];
            $this->articleModel->updateArticle($id, $titre, $contenu, $id_categorie);
            header('Location: index.php?controller=article&action=index');
        } else {
            $article = $this->articleModel->getArticleById($id);
            $categories = $this->articleModel->getCategories();
            include 'views/articles/edit.php';
        }
    }

    public function delete($id) {
        $this->articleModel->deleteArticle($id);
        header('Location: index.php?controller=article&action=index');
    }
}
?>
