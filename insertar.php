<?php
    $datos = json_decode(file_get_contents('php://input'),true);
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
        $fecha_compra = $datos['fecha_compra'];
        $no_serie = $datos['no_serie'];
        $nombre = $datos['nombre'];
        $modelo = $datos['modelo'];
        $precio = $datos['precio'];
        
        $stmt = $conexion-> prepare("INSERT INTO computadora (fecha_compra,no_serie,nombre,modelo,precio) VALUES (?,?,?,?,?)");

        $stmt ->bind_param("sssss", $fecha_compra,$no_serie,$nombre,$modelo,$precio);
        
        $stmt -> execute();
        $stmt->close();

    }
    $conexion ->close();

?>