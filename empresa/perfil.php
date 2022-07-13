<?php

include 'conexion.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title>Banco PHP - Perfil Usuario</title>
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
        </header></br>

    <h2 align='center'>Perfil de Usuario</h2></br>

    <fieldset style='width:450px; margin:auto;'></br>

        <form method='post' action='' enctype='multipart/form-data' align='center'>

            <label for='rut'>RUT: </label>
            <input type='text' name='ci' pattern='([0-9]{12})' placeholder='12 dígitos numéricos' value=" . $data['RUT'] . " required></br></br>

            <label for='nombre'>Nombre: </label>
            <textarea name='nombre' placeholder='Ingrese su Nombre' rows='1' cols='25' required> " . $data['nombre'] . " </textarea></br></br>

            <label for='direccion'>Dirección: </label>
            <textarea name='direccion' placeholder='Ingrese su Dirección' rows='1' cols='25' required> " . $data['direccion'] . " </textarea></br></br>

            <label for='telefono'>Teléfono: </label>
            <input name='telefono' type='tel' pattern='([0-9]{1}(-[0-9]{3})(-[0-9]{4}))' placeholder='X-XXX-XXXX' value=" .$data['telefono']. " required></br></br>

            <label for='email'>Email: </label>
            <input type='email' name='email' size='25' placeholder='Ingrese su Dirección de Correo' size='25' value=" . $data['email'] . " required></br></br>

            <label for='foto'>Logo: </label>
            <img src='data:image/.jpg;base64," . base64_encode($data['logo']) . "' width='130px' height='130px' /><br><br>

        </form>
    </fieldset>";
    if (isset($_POST['editar'])) {

        $primer_nombre = $_POST['primerNombre'];
        $segundo_nombre = $_POST['segundoNombre'];
        $primer_apellido = $_POST['primerApellido'];
        $segundo_apellido = $_POST['segundoApellido'];
        $fecha = $_POST['fechaDeNacimiento'];
        $password = md5($_POST['password']);
        $foto = addslashes(file_get_contents($_FILES['foto']['tmp_name']));


        $sql2 = mysqli_query($conexion, "UPDATE persona 
        SET primer_nombre= '$primer_nombre', segundo_nombre= '$segundo_nombre',
        primer_apellido= '$primer_apellido', segundo_apellido= '$segundo_apellido',
        fecha_de_nacimiento= '$fecha',
        foto= '$foto', password= '$password'
        WHERE email = '$email'");



        if ($sql2) {
            echo "<p style=' text-align: center'><strong>Registro guardado</strong></p>";
        }else{
            die(mysqli_error($conexion));
        }	  
    }

        }
        ?>
</body>

</html>