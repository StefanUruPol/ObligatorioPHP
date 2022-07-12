<?php

include 'conexion.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title>Banco PHP - Perfil de Usuario</title>
    <meta htpp-equiv="Refresh" content="10" charset="UTF-8">
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

            $sql = mysqli_query($conexion, "SELECT * FROM persona
                            WHERE email= '$email'");

            $data = mysqli_fetch_array($sql);


            echo "<h1 align='right'>
            <font color='#FFFFFF'>" . $data['primer_nombre'] . " " . $data['primer_apellido'] . "<img src='data:image/.jpg;base64," . base64_encode($data['foto']) . " ' width='70px' height='90px' /></font>
            </h1>
    </header></br>

    <h2 align='center'>Perfil de Usuario</h2></br>

    <fieldset style='width:450px; margin:auto;'></br>

        <form method='post' action='' enctype='multipart/form-data' align='center'>

            <label for='ci'>Cédula de Identidad: </label>
            <input type='text' name='ci' pattern='([0-9]{7})' placeholder='12345678' value=" . $data['CI'] . " ></br></br>

            <label for='nombre'>Primer Nombre: </label>
            <input type='text' name='primerNombre' size='25' placeholder='Ingrese su Primer Nombre' value=" . $data['primer_nombre'] . " ></br></br>

            <label for='nombre2'>Segundo Nombre: </label>
            <input type='text' name='segundoNombre' size='25' value=" . $data['segundo_nombre'] . "></br></br>

            <label for='apellido'>Primer Apellido: </label>
            <textarea name='primerApellido' placeholder='Ingrese su Primer Apellido' rows='1' cols='25'> " . $data['primer_apellido'] . " </textarea></br></br>

            <label for='apellido2'>Segundo Apellido: </label>
            <input type='text' name='segundoApellido' size='25' placeholder='Ingrese su Segundo Apellido' value=" . $data['segundo_apellido'] . " ></br></br>

            <label for='fecha'>Fecha de Nacimiento: </label>
            <input type='text' name='fechaDeNacimiento' value=" . $data['fecha_de_nacimiento'] . " ></br></br>

            <label for='email'>Email: </label>
            <input type='email' name='email' size='25' placeholder='Ingrese su Dirección de Correo' size='25' value=" . $data['email'] . " ></br></br>

            <label for='password'>Password: </label>
            <input type='password' name='password' placeholder='Ingrese Contraseña' value=" . $data['password'] . " /><br /><br />

            <label for='foto'>Foto de Usuario: </label>
            <img src='data:image/.jpg;base64," . base64_encode($data['foto']) . "' width='100px' height='130px' /><br><br>
            <input type='file' name='foto' size='75' ></br></br>

            <input type='submit' name='editar' value='Editar Perfil'>

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


                $sql = mysqli_query($conexion, "UPDATE persona 
                SET primer_nombre= '$primer_nombre', segundo_nombre= '$segundo_nombre',
                primer_apellido= '$primer_apellido', segundo_apellido= '$segundo_apellido',
                fecha_de_nacimiento= '$fecha',
                foto= '$foto', password= '$password'
                WHERE email = '$email'");



                if ($sql) {
                    echo "<p style=' text-align: center'><strong>Registro guardado</strong></p>";
                }else{
                    die(mysqli_error($conexion));
                }	  
            }
        }

        mysqli_close($conexion);
        ?>
</body>

</html>