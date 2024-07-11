<?php
require_once __DIR__ . '/../models/Article.php';

class RestArticleController {
    private $articleModel;

    public function __construct($db) {
        $this->articleModel = new Article($db);
    }

    public function getAllArticles($format) {
        $articles = $this->articleModel->getAllArticles();
        return $this->formatResponse($articles, $format);
    }

    public function getArticlesGroupedByCategory($format) {
        $articles = $this->articleModel->getArticlesGroupedByCategory();
        return $this->formatResponse($articles, $format);
    }

    public function getArticlesByCategory($categoryId, $format) {
        $articles = $this->articleModel->getArticlesByCategory($categoryId);
        return $this->formatResponse($articles, $format);
    }

    private function arrayToXml($data, &$xmlData) {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                if (is_numeric($key)) {
                    $key = 'item' . $key; // Dealing with <0/>..<n/> issues
                }
                $subnode = $xmlData->addChild($key);
                $this->arrayToXml($value, $subnode);
            } else {
                if (is_numeric($key)) {
                    $key = 'item' . $key; // Dealing with <0/>..<n/> issues
                }
                $xmlData->addChild("$key", htmlspecialchars("$value"));
            }
        }
    }

    private function formatResponse($data, $format) {
        if ($format === 'xml') {
            header('Content-Type: application/xml');
            $xmlData = new SimpleXMLElement('<root/>');
            $this->arrayToXml($data, $xmlData);
            return $xmlData->asXML();
        } else {
            header('Content-Type: application/json');
            return json_encode($data);
        }
    }
}
?>
