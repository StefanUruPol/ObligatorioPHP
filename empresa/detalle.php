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
        <button type="button" onclick="location.href='asignar.php' "> Asignación de Credenciales</button>
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
          WHERE email = '$email'");

            $data = mysqli_fetch_array($sql);

            echo "<h1 align='right'>
            <font color='#FFFFFF'>" . $data['nombre'] . " " . "<img src = data:image/.jpg;base64," . base64_encode($data['logo']) . " width = '90px' height = '90px'/></font>
            </h1>
    </header></br>

            <h2 align='center'>Detalle de Credencial</h2></br>";

            $codigo = $_GET['cod'];

            $sql2 = mysqli_query($conexion, "SELECT *
                                            FROM 
                                            credencial 
                                    INNER JOIN empresa ON credencial.RUT_empresa = empresa.RUT
                                    INNER JOIN persona ON credencial.CI_persona = persona.CI
                                    WHERE empresa.email = '$email'");


            $resultado = mysqli_fetch_array($sql2);

            echo "<fieldset align='center' style='width:450px; margin:auto;'></br>

        <form>

            <label for='tipo'>Tipo de credencial: </label>
            <input type='text' name='tipo' value=" . $resultado['tipo'] . " required></br></br>

            <label for='ci'>CI: </label>
            <input name='ci' type='tel' pattern='([0-9]{8})' placeholder='12345678' value=" . $resultado['CI'] . " required></br></br>

            <label for='apellido'>Apellido: </label>
            <textarea name='apellido' placeholder='Ingrese su Apellido' rows='1' required> " . $resultado['primer_apellido'] . "</textarea></br></br>

            <label for='nombre'>Nombre: </label>
            <input type='text' name='nombre' value=" . $resultado['primer_nombre'] . " required></br></br>

            <label for='codigo'>Código: </label>
            <input name='codigo' type='tel' pattern='([0-9]{4}(-[0-9]{4})(-[0-9]{4})(-[0-9]{4}))' placeholder='XXXX-XXXX-XXXX-XXXX' value=" . $resultado['codigo'] . " required></br></br>

            <label for='fecha_desde'>Fecha válida desde: </label>
            <input type='text' name='fecha_desde' size='21' value=" . $resultado['fecha_valida_desde'] . " required></br></br>

            <label for='fecha_hasta'>Fecha válida hasta: </label>
            <input type='text' name='fecha_hasta' size='21' value=" . $resultado['fecha_valida_hasta'] . " required></br></br>

            <label for='pin'>PIN: </label>
            <input name='pin' type='text' pattern='([0-9]{4})' value=" . $resultado['PIN'] . " required></br></br>

            <label for='asignacion'>Fecha y Hora: </label>
            <textarea name='asignacion' placeholder='Ingrese su Fecha y Hora de Asignación' rows='1' required> " . $resultado['fecha_y_hora'] . "</textarea></br></br>

        </form>
    </fieldset>";
        }

        ?>

</body>

</html>