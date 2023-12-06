<?php
// Controlador para gestionar el proceso de inicio de sesión
require_once __DIR__.'/../models/CategoryModel.php';

class AdminCategoriesController {
    public function showAdminCategories() {
        // Mostrar la vista de inicio de sesión
        include __DIR__.'/../views/Administrator/AdminCategoriesView.php';
    }

    public static function showCategories() {
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $Categories = CategoryModel::listCategories($search);
    }

    public static function showProductsFromCategory($category){
        $products = CategoryModel::getProductsFromCategory($category);
        return $products;
    }

    public static function getCategoryInfo($code){
        $info = CategoryModel::getCategory($code);
        return $info;
    }

    public static function start()
    {
        $AdminCategoriesController = new AdminCategoriesController();
        $AdminCategoriesController->showAdminCategories();
    }
}

