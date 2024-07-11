<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once 'config/config.php';
require_once 'controllers/ArticleController.php';
require_once 'controllers/CategoryController.php';
require_once 'controllers/UserController.php';


$db = db_connect();


$controller = isset($_GET['controller']) ? $_GET['controller'] : 'article';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';
$id = isset($_GET['id']) ? intval($_GET['id']) : null;

switch ($controller) {
    case 'article':
        require_once 'controllers/ArticleController.php';
        $controller = new ArticleController($db);
        break;
    case 'user':
        require_once 'controllers/UserController.php';
        $controller = new UserController($db);
        break;
    case 'category':
        require_once 'controllers/CategoryController.php';
        $controller = new CategoryController($db);
        break;
    default:
        require_once 'controllers/ArticleController.php';
        $controller = new ArticleController($db);
        break;
}

if (method_exists($controller, $action)) {
    $controller->{$action}($id);
} else {
    die('Action not found.');
}

// foreach ($articles as $article) {
//     $titre = isset($article['titre']) ? htmlspecialchars($article['titre']) : 'Titre non disponible';
//     $categorie = isset($article['id_categorie']) ? htmlspecialchars($article['id_categorie']) : 'Catégorie non disponible';
//     $contenu = isset($article['contenu']) ? htmlspecialchars($article['contenu']) : 'Contenu non disponible';

//     echo "<h2>$title</h2>";
//     echo "<p>Catégorie : $id_categorie</p>";
//     echo "<p>$contenu</p>";
// }

?>
