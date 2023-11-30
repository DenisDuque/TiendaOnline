<?php


class Database{
   
    public function conectar(){

        try {
            // Configuración de la base de datos
            $servername = "localhost";
            $username = "root";
            $password = "";
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
    
}

?>