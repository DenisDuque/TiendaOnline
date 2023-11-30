<?php

class Database{
<<<<<<< HEAD
	protected static $conn;

	public function __construct() {
    	self::$conn = self::connect();
	}
	public static function connect() {

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
    
=======
    protected static $conn = connect();
    public static function connect() {

        try {
            // Configuración de la base de datos
            $servername = "localhost";
            $username = "postgres";
            $password = "password";
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
>>>>>>> dffd9b2bb7dc7a64527c5a2e5e8aa989c41b5786
}

?>
