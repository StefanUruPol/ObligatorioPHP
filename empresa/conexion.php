<?php 

$conexion = mysqli_connect("127.0.0.1", "root", "", "obligatorio_bancophp"); 

$conexion ->query("SET NAMES 'utf8'");

mysqli_close($conexion);

/*if (!$conexion) { 
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL; echo "error de depuración: " . mysqli_connect_error() . PHP_EOL; 
    exit; } 
    else{ 
        echo "Éxito: Se realizó una conexión apropiada a MySQL! <br>" . PHP_EOL; 
        echo "Información del host: " . mysqli_get_host_info($conexion) . PHP_EOL . '<br>'; 
        $conexion ->query("SET NAMES 'utf8'"); 
    } */
?>
