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

            <h2 align='center'>Asignación de Credencial</h2></br></br>";

            $sql2 = mysqli_query($conexion, "SELECT * FROM credencial, persona");


            $resultado = mysqli_fetch_array($sql2);

            do {
                echo "<table border='1' align='center' style='text-align: center; width: 30%'>
            <tr>
                <th> </th> 
                <th>Nombre</th> 
                <th>Email</th>
            </tr>
            <tr>
                <td><input type='radio' name='radio' value=" . $resultado['CI'] . "></td>
                <td>" . $resultado['primer_nombre'] . "</td>
                <td>" . $resultado['email'] . "</td>
            </tr>

            </table><br>";
            } while ($resultado = mysqli_fetch_array($sql2, MYSQLI_ASSOC));

            echo "</br>
            <form align='center'>
            <label for='tipo'>Tipo de credencial: </label>
            <select name='tipo' required>
                <option value=''></option>
                <option value='bronze' >Bronze</option>
                <option value='premium'>Premium</option>
	            <option value='vip'>VIP</option>
	            <option value='silver'>Silver</option>
	            <option value='gold'>Gold</option>
	            <option value='platinum'>Platinum</option>
	            <option value='diamond'>Diamond</option>
            </select></br></br>

            <label for='codigo'>Código: </label>
            <input name='codigo' type='tel' pattern='([0-9]{4}(-[0-9]{4})(-[0-9]{4})(-[0-9]{4}))' placeholder='XXXX-XXXX-XXXX-XXXX' value='' required></br></br>

            <label for='fecha_desde'>Fecha válida desde: </label>
            <input type='date' name='fecha_desde' size='21' value='' required></br></br>

            <label for='fecha_hasta'>Fecha válida hasta: </label>
            <input type='date' name='fecha_hasta' size='21' value='' required></br></br>

            <label for='pin'>PIN: </label>
            <input name='pin' type='text' pattern='([0-9]{4})' value='' required></br></br></br>";

            if (isset($_POST['asignar'])) {

                $tipo = $_POST['tipo'];
                $cod = $_POST['codigo'];
                $desde = $_POST['fecha_desde'];
                $hasta = $_POST['fecha_hasta'];
                $pin = $_POST['pin'];

                $query = "INSERT INTO credencial (tipo, codigo, fecha_valida_desde, fecha_valida_hasta, PIN)
                        VALUES ('$tipo', '$cod', '$desde', '$hasta', '$pin')";

                $consulta = mysqli_query($conexion, $query);

                $data = mysqli_fetch_array($consulta);

                if ($data) {
                    echo "<p style=' text-align: center'><strong> Se asignó correctamente una nueva Credencial</strong></p></br>";
                } else {
                    die(mysqli_error($conexion));
                }
            } 
        }

        ?>

        <input type="submit" name="asignar" value="Asignar Credencial">
        <button type="button" name="volver" onclick="location.href='home.php'"> Volver</button>

        </form>
</body>

</html>