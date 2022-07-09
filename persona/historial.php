<?php

include 'conexion.php';

?>

<!DOCTYPE html>
<html>

<head>
    <title>Banco PHP - Historial de Credenciales</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link href="/ObligatorioPHP/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
        </symbol>
        <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
        </symbol>
        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
        </symbol>
    </svg>
</head>

<body>
    <form>
        <header class='d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom' style=' padding: 3px;background-color: #001a57;'>
            <h1 align='center'><img src='WampServer-logo.png' width='90px' height='90px' />
                <font color='#FFFFFF'> Banco PHP</font>
            </h1>
            <button type="button" onclick="location.href='home.php' "> Inicio</button>
            <button type="button" onclick="location.href='historial.php';"> Historial de Credenciales</button>
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
            WHERE email = '$email'");

                $data = mysqli_fetch_array($sql);

                echo "
            <h1 align='right'>
                <font color='#FFFFFF'>" . $data['primer_nombre'] . " " . $data['primer_apellido'] . " " . "<img src = data:image/.jpg;base64," . base64_encode($data['foto']) . " width = '70px' height = '90px'/></font>
            </h1>
            </header></br>

            <h2 align='center'>Historial de Credenciales</h2><br>";

                $sql2 = mysqli_query($conexion, "SELECT *
                                            FROM 
                                            credencial 
                                    INNER JOIN empresa ON credencial.RUT_empresa = empresa.RUT
                                    INNER JOIN persona ON credencial.CI_persona = persona.CI
                                    WHERE persona.email = '$email'
                                    ORDER BY fecha_valida_hasta DESC");


                while ($resultado = mysqli_fetch_array($sql2)) {

                    echo "<table border='1' align='center' style='text-align: center; width: 40%'>
                <tr>
                    <th> </th>
                    <th>Empresa Emisora</th>
                    <th>Tipo de Credencial</th>
                    <th>Código</th>
                    <th>Fecha Válida Hasta</th>
                </tr>
                <tr>
                <td>";
                    $fecha = date("Y-m-d");

                    if ($resultado['fecha_valida_hasta'] >= $fecha) {
                        echo "
                        <div class='alert alert-success d-flex align-items-center' role='alert'>
                        <svg class='bi flex-shrink-0 me-2' width='34' height='24' role='img' aria-label='Info:'Success:'><use xlink:href='#check-circle-fill'/></svg>
                        <div>
                            Credencial Válida
                        </div>
                    </div>";
                    } else {
                        echo "
                        <div class='alert alert-danger d-flex align-items-center' role='alert'>
                            <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Danger:'><use xlink:href='#exclamation-triangle-fill'/></svg>
                            <div>
                                Credencial Inválida
                            </div>
                        </div>";
                    }
                    echo "</td>
                <td>" . $resultado['nombre'] . "</td>
                <td>" . $resultado['tipo'] . "</td>
                <td>" . $resultado['codigo'] . "</td>
                <td>" . $resultado['fecha_valida_hasta'] .  "</td>
                    <td><a href='detalle_credencial.php?cod=" . $resultado['codigo'] . " '> Detalle de Credencial </a></td>
                </tr>
            </table><br>";
                    // }
                }
            }

            ?>


    </form>
</body>

</html>