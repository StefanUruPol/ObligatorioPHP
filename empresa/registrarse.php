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

            <label for="rut">RUT: </label>
            <input type="text" name="rut" pattern="([0-9]{9}[0-9]{3})" placeholder="12 dígitos numéricos" required></br></br>

            <label for="nombre">Nombre: </label>
            <input type="text" name="nombre" placeholder="Ingrese su Nombre" required></br></br>

            <label for="direccion">Dirección: </label>
            <input type="text" name="direccion" placeholder="Ingrese su Dirección" required></br></br>

            <label for="telefono">Teléfono: </label>
            <input name="telefono" type="tel" pattern="([0-9]{1}(-[0-9]{3})(-[0-9]{4}))" placeholder="X-XXX-XXXX" required></br></br>

            <label for="logo">Logo: </label>
            <input type="file" name="logo" size="75" required></br></br>

            <label for="email">Email: </label>
            <input type="email" name="email" placeholder="Ingrese su Dirección de Correo" size="25" required></br></br>

            <label for="password">Password: </label>
            <input type="password" name="password" placeholder="Ingrese una Contraseña" required><br /><br /><br />

            <?php

            require 'conexion.php';
            session_start();

            if (isset($_POST['registrar'])) {

                $rut = $_POST['rut'];
                $name = $_POST['nombre'];
                $dir = $_POST['direccion'];
                $tel = $_POST['telefono'];
                $logo = addslashes(file_get_contents($_FILES['logo']['tmp_name']));
                $correo = $_POST['email'];
                $password = md5($_POST['password']);

                $query = "INSERT INTO empresa (RUT, nombre, direccion, telefono, logo, email, password)
                        VALUES ('$rut', '$name', '$dir', '$tel', '$logo', '$correo', '$password')";

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