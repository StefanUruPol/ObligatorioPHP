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
            <button type="button" onclick="location.href='asignar.php' "> Asignación de Credenciales</button>
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

            if (isset($_SESSION['start']) && (time() - $_SESSION['start'] > 60 * 60)) {

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

                $sql = mysqli_query($conexion, "SELECT * FROM empresa
                            WHERE email= '$email'");

                $data = mysqli_fetch_array($sql);

                echo "
                <h1 align='right'>
                    <font color='#FFFFFF'>" . $data['nombre'] . " " . "<img src = data:image/.jpg;base64," . base64_encode($data['logo']) . " width = '90px' height = '90px'/></font>
                </h1>
        </header></br>

            <h2 align='center'><strong> BIENVENIDO</strong></h2><br><br>
            
            <p align='center'><strong> Credenciales Válidas</strong></p><br>";
            
            }

            $sql2 = mysqli_query($conexion, "SELECT *
            FROM 
            credencial 
            INNER JOIN empresa ON credencial.RUT_empresa = empresa.RUT
            INNER JOIN persona ON credencial.CI_persona = persona.CI
            WHERE empresa.email = '$email'
            AND credencial.fecha_valida_hasta >= CURDATE()");

            $resultado = mysqli_fetch_array($sql2, MYSQLI_ASSOC);

            if(!$resultado) {
                die("<p align='center'><strong>No hay Credenciales emitidas por esta Empresa!</strong></p> ");
            }
                          
            do{      
                
                echo "
                <table border='1' align='center' style='text-align: center; width: 60%'>
            <tr>
                <th>Tipo de Credencial</th>
                <th>Foto</th>
                <th>CI</th>
                <th>Apellido</th>
                <th>Nombre</th>
                <th>Código</th>
                <th>Fecha válida desde</th>
                <th>Fecha válida hasta</th>
            </tr>
            <tr>
                <td>" . $resultado['tipo'] . "</td>
                <td><img src= data:image/.jpg;base64," . base64_encode($resultado['foto']) . " width = '90px' height = '110px' /></td>
                <td>" . $resultado['CI'] . "</td>
                <td>" . $resultado['primer_apellido'] . "</td>
                <td>" . $resultado['primer_nombre'] . "</td>
                <td>" . $resultado['codigo'] . "</td>
                <td>" . $resultado['fecha_valida_desde'] . "</td>
                <td>" . $resultado['fecha_valida_hasta'] . "</td>
            </tr>

            </table><br>";
           
                } while($resultado = mysqli_fetch_array($sql2, MYSQLI_ASSOC));
                 
                
                mysqli_close($conexion);
            ?>

    </form>
</body>

</html>