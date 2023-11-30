<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Products</title>
    </head>
    <body>
        <div>
            <img src="../assets/images/utils/signout.png" alt="Sign out">
        </div>
        <h1>Urban Store</h1>
        <form action="#" method='POST'>
            <div>
                <div>
                    <div class='panel' id='categories'>
                        <div class='image'>
                            <img src="../assets/images/utils/categories.png" alt="Categories">
                        </div>
                        <p>Categories</p>
                    </div>
                    <div class='panel' id='dashboard'>
                        <div class='image'>
                            <img src="../assets/images/utils/dashboard.png" alt="Dashboard">
                        </div>
                        <p>Dashboard</p>
                    </div>
                    <div class='panel' id='customers'>
                        <div class='image'>
                            <img src="../assets/images/utils/customers.png" alt="Customers">
                        </div>
                        <p>Customers</p>
                    </div>
                    <div class='panel' id='orders'>
                        <div class='image'>
                            <img src="../assets/images/utils/orders.png" alt="Orders">
                        </div>
                        <p>Orders</p>
                    </div>
                </div>
                <div>
                    <div id='row'>
                        <img src="../assets/images/utils/row.png" alt="Dashboard">
                    </div>
                    <div>
                        <div id='productImage'>
                            <img src="../assets/images/utils/productImage.png" alt="Product's Image">
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
                <h2>Products</h2>
                <div id='searcher'>
                    <input type="text" name="q" placeholder="Search">
                    <!-- LA IMAGEN SE PONE DESDE EL CSS CON EL BACKGROUND-IMAGE, AQUI SE DEJARIA EL BOTON SOLO -->
                    <button type="submit"><img src="../assets/images/utils/search.png" alt="Search"></a></button>
                    <button type="submit"><img src="../assets/images/utils/addProduct.png" alt="Add Product"></a></button>
                </div>
                <div>
                    <div>
                        <div id='productImage'>
                            <img src="../assets/images/utils/productImage.png" alt="Product's Image">
                        </div>
                        <div>
                            <p>Product's Name</p>
                            <p>Category: Sneakers</p>
                            <p>Product Code: Code</p>
                            <p>$120.00</p>
                        </div>
                        <div>
                            <p>Sold: 222</p>
                            <p>Stock: 125</p>
                            <p><button type="submit"><img src="../assets/images/utils/edit.png" alt="Edit"></a></button></p>
                        </div>
                    </div>
                    <div>
                        <div id='productImage'>
                            <img src="../assets/images/utils/productImage.png" alt="Product's Image">
                        </div>
                        <div>
                            <p>Product's Name</p>
                            <p>Category: Sneakers</p>
                            <p>Product Code: Code</p>
                            <p>$120.00</p>
                        </div>
                        <div>
                            <p>Sold: 222</p>
                            <p>Stock: 125</p>
                            <p><button type="submit"><img src="../assets/images/utils/edit.png" alt="Edit"></a></button></p>
                        </div>
                    </div>
                    <div>
                        <div id='productImage'>
                            <img src="../assets/images/utils/productImage.png" alt="Product's Image">
                        </div>
                        <div>
                            <p>Product's Name</p>
                            <p>Category: Sneakers</p>
                            <p>Product Code: Code</p>
                            <p>$120.00</p>
                        </div>
                        <div>
                            <p>Sold: 222</p>
                            <p>Stock: 125</p>
                            <p><button type="submit"><img src="../assets/images/utils/edit.png" alt="Edit"></a></button></p>
                        </div>
                    </div>
                    <div>
                        <div id='productImage'>
                            <img src="../assets/images/utils/productImage.png" alt="Product's Image">
                        </div>
                        <div>
                            <p>Product's Name</p>
                            <p>Category: Sneakers</p>
                            <p>Product Code: Code</p>
                            <p>$120.00</p>
                        </div>
                        <div>
                            <p>Sold: 222</p>
                            <p>Stock: 125</p>
                            <p><button type="submit"><img src="../assets/images/utils/edit.png" alt="Edit"></a></button></p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </body>
</html>