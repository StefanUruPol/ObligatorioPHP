<?php

    include 'conexion.php';

    session_start();
    $email = $_SESSION['email'];

    if (!isset($email)) {
    header("login.php");
    } else {

        $codigo=$_GET['ci'];

        $sql = mysqli_query($conexion, "SELECT * FROM pelicula, genero, lenguaje
               WHERE codigo_pelicula= '$codigo'
			   AND genero = codigo_genero
		       AND lenguaje = codigo_lenguaje");

        echo "<h1>BIENVENIDO $nombre </h1>";

        echo "<button><a href='salir.php'>SALIR</a></button>";
    }

?>
