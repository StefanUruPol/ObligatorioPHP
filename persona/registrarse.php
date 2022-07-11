<!DOCTYPE html>
<html>

<head>

    <title>Banco PHP - Registrar Usuario</title>
    <meta htpp-equiv="Refresh" content="10" charset="UTF-8">
    <link href="/ObligatorioPHP/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body>
    <header style=" padding: 3px;background-color: #001a57;"><br />
        <h1 align="center"><img src="WampServer-logo.png" width='90px' height='90px' />
            <font color="#FFFFFF"> Banco PHP</font>
        </h1><br />
    </header></br>

    <h2 align="center">Registrar Usuario</h2>

    <fieldset align="center" style="width:450px; margin:auto;"></br>

        <form method="post" action="" enctype="multipart/form-data">

            <label for="ci">Cédula de Identidad: </label>
            <input type="text" name="ci" pattern="([0-9]{8})" placeholder="12345678" required></br></br>

            <label for="nombre">Primer Nombre: </label>
            <input type="text" name="primerNombre" placeholder="Ingrese su Primer Nombre" required></br></br>

            <label for="nombre2">Segundo Nombre: </label>
            <input type="text" name="segundoNombre" placeholder="Ingrese su Segundo Nombre"></br></br>

            <label for="apellido">Primer Apellido: </label>
            <input type="text" name="primerApellido" placeholder="Ingrese su Primer Apellido" required></br></br>

            <label for="apellido2">Segundo Apellido: </label>
            <input type="text" name="segundoApellido" placeholder="Ingrese su Segundo Apellido" required></br></br>

            <label for="fecha">Fecha de Nacimiento: </label>
            <input type="date" name="fechaDeNacimiento" required></br></br>

            <label for="email">Email: </label>
            <input type="email" name="email" placeholder="Ingrese su Dirección de Correo" size="25" required></br></br>

            <label for="foto">Foto de Usuario: </label>
            <input type="file" name="foto" size="75" required></br></br>

            <label for="password">Password: </label>
            <input type="password" name="password" placeholder="Ingrese una Contraseña" required><br /><br /><br />

            <?php

            require 'conexion.php';
            session_start();

            if (isset($_POST['registrar'])) {

                $cedula = $_POST['ci'];
                $firstName = $_POST['primerNombre'];
                $secondName = $_POST['segundoNombre'];
                $firstSurname = $_POST['primerApellido'];
                $secondSurname = $_POST['segundoApellido'];
                $date = $_POST['fechaDeNacimiento'];
                $correo = $_POST['email'];
                $contrasenia = md5($_POST['password']);
                $photo = addslashes(file_get_contents($_FILES['foto']['tmp_name']));

                $query = "INSERT INTO persona (CI, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, fecha_de_nacimiento, email, foto, password)
                        VALUES ('$cedula', '$firstName', '$secondName', '$firstSurname', '$secondSurname', '$date', '$correo', '$photo', '$contrasenia')";

                $resultado = $conexion->query($query);

                if ($resultado) {
                    echo "<p style=' text-align: center'><strong> Se Agrego Correctamente una Nuevo Usuario </strong></p></br>";
                } else {
                    die(mysqli_error($conexion));
                }
            }

            ?>

            <input type="submit" name="registrar" value="Registrar usuario">
            <button type="button" name="volver" onclick="location.href='login.php'"> Volver</button>

        </form>
    </fieldset>
</body>

</html>