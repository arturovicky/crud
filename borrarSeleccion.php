<?php
    $datos = json_decode(file_get_contents('php://input'),true);
    $no_serie = $datos['no_serie'];
    $url = "localhost:3307";
    $usuario = "root";
    $password = "";
    $base = "computadoras";

    
    $conexion = new mysqli($url, $usuario,$password, $base);
    
    if ($conexion -> connect_error) {
        # code...
        die("error de conexion".$conexion->connect_error);
    }
    
    if ($datos) {
        # code...       
        
        
        $stmt = $conexion-> prepare("DELETE FROM computadora WHERE no_serie = ?");

        $stmt ->bind_param("s", $no_serie);
        
        $stmt -> execute();
        $stmt->close();

    }
    $conexion ->close();

?>