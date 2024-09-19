<?php
    
    $url = "localhost:3307";
    $usuario = "root";
    $password = "";
    $base = "computadoras";

    
    $conexion = new mysqli($url, $usuario,$password, $base);
    
    if ($conexion -> connect_error) {
        # code...
        die("error de conexion".$conexion->connect_error);
    }
    
    $stmt = $conexion ->prepare("DELETE FROM computadora");
    $stmt-> execute();
    $stmt -> close();
    $conexion->close();

?>