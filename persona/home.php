<?php

include 'conexion.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title>Banco PHP - Home</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link href="/ObligatorioPHP/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
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

        if (isset($_SESSION['start']) && (time() - $_SESSION['start'] > 60 * 10)) {

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

            $sql = mysqli_query($conexion, "SELECT * FROM persona
                            WHERE email= '$email'");

            $data = mysqli_fetch_array($sql);

            $sql2 = mysqli_query($conexion, "SELECT 
                    persona.codigo_credencial,
                    empresa.logo,
                    empresa.nombre,
                    credencial.tipo,
                    credencial.codigo,
                    credencial.fecha_valida_hasta
                FROM persona
                JOIN empresa
                    ON persona.codigo_credencial = empresa.codigo_credencial 
                JOIN credencial
                    ON credencial.codigo = empresa.codigo_credencial
                   
                    AND
                    credencial.codigo = persona.codigo_credencial");

            $resultado = mysqli_fetch_array($sql2);
        }

        ?>

        <header class='d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom' style=' padding: 3px;background-color: #001a57;'>
            <h1 align='center'><img src='WampServer-logo.png' width='90px' height='90px' />
                <font color='#FFFFFF'> Banco PHP</font>
            </h1>
            <button type="button" onclick="location.href='home.php' "> Inicio</button>
            <button type="button" onclick="location.href='historial.php';"> Historial de Credenciales</button>
            <button type="button" onclick="location.href='perfil.php' "> Perfil</button>
            <button type="button" onclick="location.href='salir.php' "> Salir</button>
            <h1 align='right'>
                <font color='#FFFFFF'> <?php echo $data['primer_nombre'] . " " . $data['primer_apellido'] . " " . "<img src = data:image/.jpg;base64," . base64_encode($data['foto']) . " width = '70px' height = '90px'/> " ?></font>
            </h1>
        </header></br>

        <h2 align='center'><strong> BIENVENIDO</strong></h2><br>

    </form>
</body>

</html>