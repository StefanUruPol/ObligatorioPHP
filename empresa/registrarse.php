<!DOCTYPE html>
<html>

<head>

    <title>Banco PHP - Registrar Usuario</title>
    <meta htpp-equiv="Refresh" content="10" charset="UTF-8">

</head>

<body align="center">

    <h1>Registrar Usuario</h1>

    <fieldset style="width:450px; margin:auto;"></br>

        <form method="post" action="" enctype="multipart/form-data">

            <label for="rut">RUT: </label>
            <input type="text" name="rut" pattern="[0-9]+" placeholder="XXXXXXXXXXXX" required></br></br>

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
                $contrasenia = md5($_POST['password']);

                $query = "INSERT INTO empresa (RUT, nombre, direccion, telefono, logo, email, password)
                        VALUES ('$rut', '$name', '$dir', '$tel', '$logo', '$correo', '$contrasenia')";

                $resultado = $conexion->query($query);

                if ($resultado) {
                    echo "<p style=' text-align: center'><strong> Se Agrego Correctamente una Nuevo Usuario </strong></p></br>";
                } else {
                    die(mysqli_error($conexion));
                }
            }

            ?>

            <input type="submit" name="registrar" value="Registrar usuario">
            <button type="button" name="volver"><a href="login.php"> Volver </a></button>

        </form>
    </fieldset>
</body>

</html>