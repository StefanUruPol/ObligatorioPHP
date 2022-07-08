<?php

include 'conexion.php';

?>

<!DOCTYPE html>
<html>

<head>
    <title>Banco PHP - Detalle de Credencial</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link href="/ObligatorioPHP/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body>
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

            echo "<h2><font color='#FFFFFF'>La Sesion de Usuario Expiró su Tiempo</font></h2><br/><br/>
    <button><a href='login.php'> Volver a Iniciar Sesión </a></button>
    <button><a href='/ObligatorioPHP/index.php'> Salir </a></button>";
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

    <h2 align='center'>Detalle de Credencial</h2></br>";

            $codigo = $_GET['cod'];

            $sql2 = mysqli_query($conexion, "SELECT * FROM persona, empresa, credencial
                                             WHERE CI_persona = CI
                                             AND RUT_empresa = RUT
                                             ");


            while ($resultado = mysqli_fetch_array($sql2)) {

                echo "<fieldset align='center' style='width:450px; margin:auto;'></br>

        <form>

            <label for='nombre'>Empresa Emisora: </label>
            <input type='text' name='nombre' value=" . $resultado['nombre'] . " required></br></br>

            <label for='tipo'>Tipo de credencial: </label>
            <input type='text' name='tipo' value=" . $resultado['tipo'] . " required></br></br>

            <label for='codigo'>Código: </label>
            <input name='codigo' type='tel' pattern='([0-9]{4}(-[0-9]{4})(-[0-9]{4})(-[0-9]{4}))' placeholder='XXXX-XXXX-XXXX-XXXX' value=" . $resultado['codigo'] . " required></br></br>

            <label for='fecha_desde'>Fecha válida desde: </label>
            <input type='text' name='fecha_desde' size='21' value=" . $resultado['fecha_valida_desde'] . " required></br></br>

            <label for='fecha_hasta'>Fecha válida hasta: </label>
            <input type='text' name='fecha_hasta' size='21' value=" . $resultado['fecha_valida_hasta'] . " required></br></br>

            <label for='pin'>PIN: </label>
            <input name='pin' type='text' pattern='([0-9]{4})' value=" . $resultado['PIN'] . " required></br></br>

        </form>
    </fieldset>";
            }
        }

        ?>

</body>

</html>