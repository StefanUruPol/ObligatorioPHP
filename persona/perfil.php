<?php

include 'conexion.php';
session_start();

$email = $_SESSION['email'];

$sql = mysqli_query($conexion, "SELECT * FROM persona
          WHERE email = '$email'");

$data = mysqli_fetch_array($sql);

?>

<!DOCTYPE html>
<html>

<head>

    <title>Banco PHP - Perfil Usuario</title>
    <meta htpp-equiv="Refresh" content="10" charset="UTF-8">

</head>

<body align="center">

    <h1>Perfil Usuario</h1>

    <fieldset style="width:450px; margin:auto;"></br>

        <form method="post" action="" enctype="multipart/form-data">

            <label for="ci">Cédula de Identidad: </label>
            <input type="text" name="ci" pattern="[0-9]+" placeholder="12345678" value= " <?php echo $data['CI'] ?> " required></br></br>

            <label for="nombre">Primer Nombre: </label>
            <input type="text" name="primerNombre" placeholder="Ingrese su Primer Nombre" value= " <?php echo $data['primer_nombre'] ?> " required></br></br>

            <label for="nombre2">Segundo Nombre: </label>
            <input type="text" name="segundoNombre" placeholder="Ingrese su Segundo Nombre" value= " <?php echo $data['segundo_nombre'] ?> "></br></br>

            <label for="apellido">Primer Apellido: </label>
            <input type="text" name="primerApellido" placeholder="Ingrese su Primer Apellido" value= " <?php echo $data['primer_apellido'] ?> " required></br></br>

            <label for="apellido2">Segundo Apellido: </label>
            <input type="text" name="segundoApellido" placeholder="Ingrese su Segundo Apellido" value= " <?php echo $data['segundo_apellido'] ?> " required></br></br>

            <label for="fecha">Fecha de Nacimiento: </label>
            <input type="text" name="fechaDeNacimiento" value= " <?php echo $data['fecha_de_nacimiento'] ?> " required></br></br>

            <label for="email">Email: </label>
            <input type="email" name="email" placeholder="Ingrese su Dirección de Correo" size="25" value= " <?php echo $data['email'] ?> " required></br></br>

            <label for="foto">Foto de Usuario: </label>
            <img src = 'data:image/.jpg;base64, <?php echo base64_encode($data['foto']) ?>' width = '70px' height = '100px'/><br><br>

            <button type="button" name="volver"><a href="home.php"> Volver </a></button>

        </form>
    </fieldset>
</body>

</html>