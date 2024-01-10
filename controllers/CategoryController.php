<?php
require_once __DIR__.'/../models/CategoryModel.php';
require_once __DIR__.'/../models/ProductModel.php';
class CategoryController {
    
    public function showAdminCategory() {
        $search = isset($_GET['search']) ? $_GET['search'] : null;
        $categories = CategoryModel::listCategories($search);
        include __DIR__.'/../views/Administrator/AdminCategoriesView.php';
    }
    public static function generateCategoriesOptions() {
        $categories = CategoryModel::listCategories(null);
        return $categories;
    }
    public static function showProductsFromCategory($category){
        $products = CategoryModel::getProductsFromCategory($category);
        return $products;
    }
    
    public static function getCategoryInfo($code){
        $info = CategoryModel::getCategory($code);
        return $info[0];
    }
    public static function editCategory() {
        if (isset($_POST) && isset($_GET['page']) && isset($_GET['action']) && $_GET['action'] == 'editCategory') {
            CategoryModel::editCategory($_POST['code'], $_POST['name'], $_POST['active']);
        }
    }
    public static function createCategory() {
        if(isset($_POST) && isset($_GET['page']) && isset($_GET['action']) && $_GET['action'] == 'createCategory') {
            CategoryModel::createCategory($_POST['name'], $_POST['active']);
        }
    }
}
?>