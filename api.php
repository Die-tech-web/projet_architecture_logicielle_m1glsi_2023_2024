<?php
require_once 'config/Config.php';
require_once 'controllers/RestArticleController.php';

$db = db_connect();

$articleController = new RestArticleController($db);

$requestMethod = $_SERVER["REQUEST_METHOD"];
$format = isset($_GET['format']) ? $_GET['format'] : 'json';

switch ($requestMethod) {
    case 'GET':
        if (isset($_GET['category'])) {
            $categoryId = intval($_GET['category']);
            echo $articleController->getArticlesByCategory($categoryId, $format);
        } elseif (isset($_GET['groupByCategory'])) {
            echo $articleController->getArticlesGroupedByCategory($format);
        } else {
            echo $articleController->getAllArticles($format);
        }
        break;
    default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}
?>
