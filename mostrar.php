<?php
    // Mostrar errores para depuración
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // Asegurar que el contenido devuelto sea JSON
    header('Content-Type: application/json');
    
    // Datos de conexión a la base de datos
    $url = "localhost:3307";
    $usuario = "root";
    $password = "";
    $base = "computadoras";

    // Crear la conexión a MySQL
    $conexion = new mysqli($url, $usuario, $password, $base);

    // Verificar la conexión
    if ($conexion->connect_error) {
        die(json_encode(["error" => "Error de conexión: " . $conexion->connect_error]));
    }

    // Realizar la consulta
    $resultado = $conexion->query("SELECT * FROM computadora");

    // Verificar si hay registros
    if ($resultado->num_rows > 0) {
        $registros = [];

        // Recorrer los registros
        while ($fila = $resultado->fetch_assoc()) {
            $registros[] = $fila;
        }

        // Devolver los registros como JSON
        echo json_encode($registros);
    } else {
        // Si no hay registros, devolver un array vacío
        echo json_encode([]);
    }

    // Cerrar la conexión
    $conexion->close();
?>
