<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Categories</title>
    </head>
    <body>
        <script src="views/js/editForms.js"></script>
        <div>
            <img src="views/assets/images/utils/signout.png" alt="Sign out">
        </div>
        <h1>Urban Store</h1>
        <form action="#" method='POST'>
            <div id="placeHolder">
                <div>
                    <div class='panel' id='categories'>
                        <div class='image'>
                            <img src="views/assets/images/utils/dashboard.png" alt="Dashboard">
                        </div>
                        <p>Dashboard</p>
                    </div>
                    <div class='panel' id='products'>
                        <div class='image'>
                            <img src="views/assets/images/utils/products.png" alt="Products">
                        </div>
                        <p>Products</p>
                    </div>
                    <div class='panel' id='customers'>
                        <div class='image'>
                            <img src="views/assets/images/utils/customers.png" alt="Customers">
                        </div>
                        <p>Customers</p>
                    </div>
                    <div class='panel' id='orders'>
                        <div class='image'>
                            <img src="views/assets/images/utils/orders.png" alt="Orders">
                        </div>
                        <p>Orders</p>
                    </div>
                </div>
                <div>
                    <div id='row'>
                        <img src="views/assets/images/utils/row.png" alt="Dashboard">
                    </div>
                    <div>
                        <div id='productImage'>
                            <img src="views/assets/images/utils/productImage.png" alt="Product's Image">
                        </div>
                        <p>Product's Name</p>
                    </div>
                    <div>
                        <div>
                            <p>Product Code</p>
                            <hr>
                            <p>NI001NIK</p>
                        </div>
                        <div>
                            <p>Price</p>
                            <hr>
                            <p>$ 120.00</p>
                        </div>
                        <div>
                            <p>Stock</p>
                            <hr>
                            <p>99</p>
                        </div>
                        <div>
                            <label>Status</label>
                            <select name="status" id="status">
                                <option value="Enabled">Enabled</option>
                            </select>
                        </div>
                        <div>
                            <label>Category</label>
                            <select name="category" id="category">
                                <option value="Sneakers">Sneakers</option>
                            </select>
                        </div>
                        <div id='button'>
                            <input type="submit" value="Save Changes">
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <h2>Categories</h2>
                <?php
                    include(__DIR__."/../../models/CategoryModel.php");
                    $category = new CategoryModel("","");
                    $category->listCategories();
                ?>
            </div>
        </form>
    </body>
</html>