<?php

    include 'conexion.php';

?>

<!DOCTYPE html>
<html>

<head>
    <title>Banco PHP - Home</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
</head>

<body>
    <form>

    <?php
    session_start();
    $email = $_SESSION['email'];

    if (!isset($email)) {
        header("login.php");

    } else {

        $sql = mysqli_query($conexion, "SELECT * FROM persona
                            WHERE email= '$email'");

        $data = mysqli_fetch_array($sql);

        echo "<h1> BIENVENIDO " .$data['primer_nombre'] . " " . $data['primer_apellido']. "</h1>

        <button><a href='salir.php'>SALIR</a></button>";
    }
    ?>

    </form>
  </body>
</html>