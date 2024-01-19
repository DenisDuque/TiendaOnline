<?php
require_once __DIR__.'/../models/ProductModel.php';
class ProductController {
    public function showAdminProduct() {
        $products = ProductModel::getAllProducts();
        include __DIR__.'/../views/Administrator/AdminProductsView.php';
    }

    public function showAdminDashboard() {
        $products = ProductModel::getTopProducts(10);
        include __DIR__.'/../views/Administrator/AdminDashboardView.php';
    }

    public function showSearchProducts() {
        require_once __DIR__.'/../models/CategoryModel.php';
        // Hay que filtrar tanto por categoria, como por barra de busqueda, y ordenar por Sort by.
        $categories = CategoryModel::listCategories("");
        $products = ProductModel::getAllProducts();
        $productArray = array_map(function($product) {
            return [
                'code' => $product->getCode(),
                'name' => $product->getName(),
                'price' => $product->getPrice(),
                'image' => $product->getImage("lateral"),
                'codecategory' => $product->getCategory(),
                'inWishlist' => false // TODO: Función para saber si se encuentra en la wishlist del usuario
            ];
        }, $products);
        //header("Content-Type: application/json");
        $jsonResult = json_encode($productArray);
        include __DIR__.'/../views/General/SearchProducts.php';
    }

    public function fetchProducts() {
        try {
            $condition = $_REQUEST['condition'];
            $products = ProductModel::getProductsWhere($condition);
    
            if (!empty($products)) {
                // cambiar map por for each
                $data = array_map(function($product) {
                    return [
                        'code' => $product->getCode(),
                        'codecategory' => $product->getCategory(),
                        'name' => $product->getName(),
                        'price' => $product->getPrice(),
                        'sold' => $product->getSold(),
                        'stock' => $product->getStock(),
                        'status' => $product->getStatus(),
                        'image' => $product->getImage("lateral"),
                    ];
                }, $products);
    
               // header('Content-Type: application/json');
                $jsonData = json_encode($data);

                echo $jsonData;
            } else {
                
                echo "";
            }
        } catch (Exception $e) {
            error_log("Error: " . $e->getMessage());
            throw new Exception("Fetch data error: " . $e->getMessage());
        }
    }
    public function adaptImage($data, $name, $tmpname, $perspective) {
        $imagename = $name;
        $extension = pathinfo($imagename, PATHINFO_EXTENSION);
        $data = str_replace(" ","_",$data);
        $image = $data . "-" . $perspective . "." . $extension;

        $image = str_replace(" ","_",$image);

        $image_tmp = $tmpname;
        if($perspective != "3D") {
            $image_path = "views/assets/images/products/".$image;
            $imageToDelete = "views/assets/images/products/".$data."-".$perspective.".*";
        } else {
            $image_path = "views/assets/3dmodels/".$image;
            $imageToDelete = "views/assets/3dmodels/".$data."-".$perspective.".*";
        }
        $matchingFiles = glob($imageToDelete);
        foreach ($matchingFiles as $file) {
            unlink($file);
        }
        move_uploaded_file($image_tmp, $image_path);
        return $image;
    }

    public function showProduct() {
        require_once __DIR__.'/../models/CategoryModel.php';
        $product = ProductModel::getProductWithCode();
        $product["category"] = CategoryModel::getCategory($product["codecategory"]);
        include __DIR__.'/../views/General/productPage.php';

    }
    public function editProduct() {
        $Sideimage = null;
        $Bottomimage = null;
        $Upimage = null;
        $image3D = null;
        if(isset($_FILES['Side']) && $_FILES['Side']['error'] === UPLOAD_ERR_OK){
            $Sideimage = $this->adaptImage(str_replace(' ', '', $_POST['code']), $_FILES['Side']['name'], $_FILES['Side']['tmp_name'], "Side"); 
        } if(isset($_FILES['Bottom']) && $_FILES['Bottom']['error'] === UPLOAD_ERR_OK){
            $Bottomimage = $this->adaptImage(str_replace(' ', '', $_POST['code']), $_FILES['Bottom']['name'], $_FILES['Bottom']['tmp_name'], "Bottom"); 
        } if(isset($_FILES['Up']) && $_FILES['Up']['error'] === UPLOAD_ERR_OK){
            $Upimage = $this->adaptImage(str_replace(' ', '', $_POST['code']), $_FILES['Up']['name'], $_FILES['Up']['tmp_name'], "Up");
        } if(isset($_FILES['3D']) && $_FILES['3D']['error'] === UPLOAD_ERR_OK){
            $image3D = $this->adaptImage(str_replace(' ', '', $_POST['code']), $_FILES['3D']['name'], $_FILES['3D']['tmp_name'], "3D"); 
        }
        if (isset($_POST) && isset($_GET['page']) && isset($_GET['action']) && $_GET['action'] == 'editProduct') {
            ProductModel::editProduct(str_replace(' ', '', $_POST['code']),$_POST['name'], $_POST['description'], $_POST['price'], $_POST['stock'], $_POST['active'], $_POST['category'], $Sideimage, $Upimage, $Bottomimage, $image3D, $_POST['sizes']);
        }
    }
    public function createProduct() {
        $Sideimage = null;
        $Bottomimage = null;
        $Upimage = null;
        $image3D = null;
        $name = $_POST['name'];
        $category = $_POST['category'];
        $code = ProductModel::generateCode($name, $category);
        if(isset($_FILES['Side']) && $_FILES['Side']['error'] === UPLOAD_ERR_OK){
            $Sideimage = $this->adaptImage($code, $_FILES['Side']['name'], $_FILES['Side']['tmp_name'], "Side"); 
        } if(isset($_FILES['Bottom']) && $_FILES['Bottom']['error'] === UPLOAD_ERR_OK){
            $Bottomimage = $this->adaptImage($code, $_FILES['Bottom']['name'], $_FILES['Bottom']['tmp_name'], "Bottom"); 
        } if(isset($_FILES['Up']) && $_FILES['Up']['error'] === UPLOAD_ERR_OK){
            $Upimage = $this->adaptImage($code, $_FILES['Up']['name'], $_FILES['Up']['tmp_name'], "Up");
        } if(isset($_FILES['3D']) && $_FILES['3D']['error'] === UPLOAD_ERR_OK){
            $image3D = $this->adaptImage($code, $_FILES['3D']['name'], $_FILES['3D']['tmp_name'], "3D"); 
        }
        if (isset($_POST) && isset($_GET['page']) && isset($_GET['action']) && $_GET['action'] == 'createProduct') {
            ProductModel::createProduct($code, $_POST['name'], $_POST['description'], $_POST['price'], $_POST['stock'], $_POST['active'], $_POST['category'], $Sideimage, $Upimage, $Bottomimage, $image3D, $_POST['sizes']);
        }
    }
}
?>