<?php
// Controlador para gestionar el proceso de inicio de sesión
require_once __DIR__.'/../models/ProductModel.php';

class AdminCategoriesController {
    public function showAdminCategories() {
        // Mostrar la vista de inicio de sesión
        include __DIR__.'/../views/Administrator/AdminCategoriesView.php';
    }

    public static function showCategories() {
        $fetchedCategories = CategoryModel::listCategories();
    }
}

$AdminCategoriesController = new AdminCategoriesController();
$AdminCategoriesController->showAdminCategories();