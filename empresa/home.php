<?php

include 'conexion.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title>Banco PHP - Home</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>

<body>
    <form>

        <?php
        session_start();

        if (!isset($_SESSION['start'])) {

            //Set the session start time

            $_SESSION['start'] = time();
        }


        //Check the session is expired or not

        if (isset($_SESSION['start']) && (time() - $_SESSION['start'] > 60 * 60)) {

            //Unset the session variables

            session_unset();

            //Destroy the session

            session_destroy();

            echo "<strong>La Sesion de Usuario Expiró su Tiempo</strong><br/><br/>
            <button type='button' name='volver'><a href='login.php'> Volver a Iniciar Sesión </a></button>
            <button type='button' name='volver'><a href='/ObligatorioPHP/index.php'> Salir </a></button>";
        } else

            //echo "Sesion de Usuario Existente.<br/>";

        $email = $_SESSION['email'];

        if (!isset($email)) {
            header("login.php");
        } else {

            $sql = mysqli_query($conexion, "SELECT * FROM empresa
                            WHERE email= '$email'");

            $data = mysqli_fetch_array($sql);

            echo "<h1> BIENVENIDO " . $data['nombre'] . "</h1>
            <img src = data:image/.jpg;base64," . base64_encode($data['logo']) . " width = '70px' height = '100px'/><br><br>

            <a href='home.php'> Inicio </a><br>
            <a href='asignar.php'> Asignación de Credenciales </a><br>
            <a href='historial.php'> Historial de Credenciales </a><br>
            <a href='perfil.php'> Perfil </a><br>
            <a href='salir.php'> Salir </a>";
        }
        ?>

    </form>
</body>

</html>