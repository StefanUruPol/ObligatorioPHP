<?php

include 'conexion.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title>Banco PHP - Asignación de Credencial - Persona</title>
    <meta htpp-equiv="Refresh" content="10" charset="UTF-8">
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
            </h2>
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
        </header></br>";

        $persona = $_GET['id'];

            $sql2 = mysqli_query($conexion, "SELECT * FROM persona, empresa, credencial
                                             WHERE persona.email = '$persona'
                                             AND empresa.email = '$email'");


            $resultado = mysqli_fetch_array($sql2);

    echo "<h2 align='center'>Asignación de Credencial </h2></br>

    <fieldset style='width:450px; margin:auto;'></br>

        <form method='post' action='' align='center'>

        <label for='tipo'>Tipo de credencial: </label>
        <select name='tipo' required>
            <option value=''></option>
            <option value='Bronze' >Bronze</option>
            <option value='Premium'>Premium</option>
            <option value='VIP'>VIP</option>
            <option value='Silver'>Silver</option>
            <option value='Gold'>Gold</option>
            <option value='Platinum'>Platinum</option>
            <option value='Diamond'>Diamond</option>
        </select></br></br>
        
        <label for='codigo'>Código: </label>
        <input name='codigo' type='tel' pattern='([0-9]{4}(-[0-9]{4})(-[0-9]{4})(-[0-9]{4}))' placeholder='XXXX-XXXX-XXXX-XXXX' value='' required></br></br>

        <label for='fecha_desde'>Fecha válida desde: </label>
        <input type='date' name='fecha_desde' size='21' value='' required></br></br>

        <label for='fecha_hasta'>Fecha válida hasta: </label>
        <input type='date' name='fecha_hasta' size='21' value='' required></br></br>

        <label for='pin'>PIN: </label>
        <input name='pin' type='text' pattern='([0-9]{4})' value='' required></br></br>

        <label for='ci'>Cédula de Identidad: </label>
        <input type='text' name='ci' pattern='([0-9]{7})' placeholder='12345678' value=" . $resultado['CI'] . " required></br></br>

        <label for='rut'>RUT: </label>
        <input type='text' name='rut' pattern='([0-9]{6})' placeholder='12 dígitos numéricos' value=" . $resultado['RUT'] . " required></br></br>
        
        <input type='submit' name='asignar' value='Asignar Credencial'>";

    if (isset($_POST['asignar'])) {

        $tipo = $_POST['tipo'];
        $cod = $_POST['codigo'];
        $desde = $_POST['fecha_desde'];
        $hasta = $_POST['fecha_hasta'];
        $pin = $_POST['pin'];
        ?>
        <?php

        date_default_timezone_set('America/Montevideo');    
        $dateAndTime = date('Y-m-d h:i:s a', time());

        ?>
        <?php
        $persona = $_POST['ci'];
        $empresa = $_POST['rut'];

        $query = mysqli_query($conexion, "INSERT INTO credencial (tipo, codigo, fecha_valida_desde, fecha_valida_hasta, PIN, fecha_y_hora, CI_persona, RUT_empresa)
                VALUES ('$tipo', '$cod', '$desde', '$hasta', '$pin', '$dateAndTime', '$persona', '$empresa')");

        if($query) {
            echo "<p style=' text-align: center'><strong> Se asignó correctamente una nueva Credencial</strong></p></br>";
        }
    }
    ?>   
            
            <button type='button' name='volver' onclick="location.href='home.php'"> Volver</button>
        </form>
    </fieldset>

        <?php

    }

        ?>
</body>

</html>