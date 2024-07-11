<?php
require_once 'models/Category.php';

class CategoryController {
    private $categoryModel;

    public function __construct($db) {
        $this->categoryModel = new Category($db);
    }

    public function index() {
        $categories = $this->categoryModel->getCategories();
        include 'views/categories/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nom = $_POST['nom'];
            $this->categoryModel->createCategory($nom);
            header('Location: index.php?controller=category&action=index');
        } else {
            include 'views/categories/edit.php';
        }
    }

    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nom = $_POST['nom'];
            $this->categoryModel->updateCategory($id, $nom);
            header('Location: index.php?controller=category&action=index');
        } else {
            $category = $this->categoryModel->getCategoryById($id);
            include 'views/categories/edit.php';
        }
    }

    public function delete($id) {
        $this->categoryModel->deleteCategory($id);
        header('Location: index.php?controller=category&action=index');
    }


    
}
?>
