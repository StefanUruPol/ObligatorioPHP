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
        <header class='d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom' style=' padding: 3px;background-color: #001a57;'>
            <h1 align='center'><img src='WampServer-logo.png' width='90px' height='90px' />
                <font color='#FFFFFF'> Banco PHP</font>
            </h1>
            <button type="button" onclick="location.href='home.php' "> Inicio</button>
            <button type="button" onclick="location.href='historial.php' "> Historial de Credenciales</button>
            <button type="button" onclick="location.href='perfil.php' "> Perfil</button>
            <button type="button" onclick="location.href='salir.php' "> Salir</button>

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

            ?> <h2>
                    <font color='#FFFFFF'>La Sesion de Usuario Expiró su Tiempo</font>
                </h2><br /><br />
                <button type="button" onclick="location.href='login.php'"> Volver a Iniciar Sesión</button>
                <button type="button" onclick="location.href='/ObligatorioPHP/index.php'"> Salir</button>";
            <?php

            } else

                //echo "Sesion de Usuario Existente.<br/>";

                $email = $_SESSION['email'];

            if (!isset($email)) {
                header("login.php");
            } else {

                $sql = mysqli_query($conexion, "SELECT * FROM persona
                            WHERE email= '$email'");

                $data = mysqli_fetch_array($sql);

                echo "
            <h1 align='right'>
                <font color='#FFFFFF'>" . $data['primer_nombre'] . " " . $data['primer_apellido'] . " " . "<img src = data:image/.jpg;base64," . base64_encode($data['foto']) . " width = '70px' height = '90px'/></font>
            </h1>
            </header></br>

            <h2 align='center'><strong> BIENVENIDO</strong></h2><br><br>";
            }

            $sql2 = mysqli_query($conexion, "SELECT *
            FROM 
            credencial 
            INNER JOIN empresa ON credencial.RUT_empresa = empresa.RUT
            INNER JOIN persona ON credencial.CI_persona = persona.CI
            WHERE persona.email = '$email'
            AND credencial.fecha_valida_hasta >= CURDATE()
            
            ");

            $resultado = mysqli_fetch_array($sql2, MYSQLI_ASSOC);
            if(!$resultado) {
                die("<p align='center'><strong> No hay credenciales validas!</strong></p>");
            }

           //while ($resultado = mysqli_fetch_array($sql2, MYSQLI_ASSOC)) {
                    
                
            do{      
                
                echo "<p align='center'><strong> Credenciales Válidas</strong></p><br>

                <table border='1' align='center' style='text-align: center; width: 40%'>
            <tr>
                <th>Empresa Emisora</th>
                <th>Nombre</th>
                <th>Tipo de Credencial</th>
                <th>Código</th>
                <th>Fecha Válida Hasta</th>
            </tr>
            <tr>
                <td><img src= data:image/.jpg;base64," . base64_encode($resultado['logo']) . " width = '90px' height = '90px' /></td>
                <td>" . $resultado['nombre'] . "</td>
                <td>" . $resultado['tipo'] . "</td>
                <td>" . $resultado['codigo'] . "</td>
                <td>" . $resultado['fecha_valida_hasta'] . "</td>
            </tr>

            </table><br>";
           
                } while($resultado = mysqli_fetch_array($sql2, MYSQLI_ASSOC));
                 
                
                mysqli_close($conexion);
        ?>

    </form>
</body>

</html>