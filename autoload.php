<?php 
    function load($className) {
        include "controllers/$className.php";
    }
    spl_autoload_register("load");
?>