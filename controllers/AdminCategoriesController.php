<?php
// Controlador para gestionar el proceso de inicio de sesión
require_once __DIR__.'/../models/CategoryModel.php';
require_once __DIR__.'/../models/ProductModel.php';
class AdminCategoriesController {
    public function showAdminCategories() {
        // Mostrar la vista de inicio de sesión
        include __DIR__.'/../views/Administrator/AdminCategoriesView.php';
    }

    public static function showCategories() {
        $search = isset($_GET['search']) ? $_GET['search'] : null;
        $Categories = CategoryModel::listCategories($search);
        foreach($Categories as $category) {
            $ProductsID = ProductModel::getCategoryProductId($category->getCode());
            $ProductsTextValue = implode(',', $ProductsID);
            $ProductsTextValue = str_replace(' ','',$ProductsTextValue);
            echo "
                <div id='". $category->getCode() ."' class='categoryComponent'>
                    <h5 class='categoryName'>". $category->getName() ."</h5>
                    <p class='categoryCount'>Products: ". count($ProductsID) ."</p>
                    <input class='products' type='hidden' value='". $ProductsTextValue ."'>
                    <input class='status' type='hidden' value='". $category->getStatus() ."'>
                    <div id='editBtn_". $category->getCode() ."' class='editBtn'><img src='views/assets/images/utils/edit.png' alt='Edit'></div>
                </div>
            ";
        }
    }
    public static function generateCategoriesOptions() {
        $categories = CategoryModel::listCategories(null);
        foreach($categories as $category) {
            echo "<option value='". $category->getCode() ."'>". $category->getName() ."</option>";
        }
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

