<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Prueba querys</title>
    </head>
    <body>
        
    <?php
    function connect(){
        try {
            // Configuración de la base de datos
            $servername = "localhost";
            $username = "postgres";
            $password = "admin";
            $dbname = "urbanstore";
            
            // Crear conexión
            $connectPdo = new PDO('pgsql:host='.$servername.';dbname='.$dbname, $username, $password);
            $connectPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Establecer el conjunto de caracteres a UTF-8
            $connectPdo->exec("SET NAMES 'utf8'");
            return $connectPdo;
        
        } catch (PDOException $e) {
            echo "Error de PDO: " . $e->getMessage();
        }
    
    }
    // QUERYS PARA PAGINA ADMIN-CATEGORIAS, PARA PODER MOSTRAR LAS CATEGORIAS Y SUS PRODUCTOS
    $conn = connect();
    $query = "SELECT * FROM categories";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    if($stmt->rowCount() > 0) {
        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        echo "No hay categorias aún!";
    }
    if(isset($categories)){
        foreach($categories as $categorie){
            $query = "SELECT * FROM products WHERE codeCategory LIKE :code";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':code', $categorie['code']);
            $stmt->execute();
            $products=$stmt->rowCount();
            echo $categorie['code'].'- '.ucfirst($categorie['name']).str_repeat("&nbsp;", 40).'Products: '.$products;
            echo "<br>";
        }
    }

    // QUERYS PARA PAGINA ADMIN-






    ?>
</body>
</html>