<?php

include 'conexion.php';
session_start();

$email = $_SESSION['email'];

$sql = mysqli_query($conexion, "SELECT * FROM empresa
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

            <label for="rut">RUT: </label>
            <input type="text" name="rut" pattern="[0-9]+" placeholder="XXXXXXXXXXXX" value="<?php echo $data['RUT'] ?>" required></br></br>

            <label for="nombre">Nombre: </label>
            <input type="text" name="nombre" placeholder="Ingrese su Nombre" value="<?php echo $data['nombre'] ?>" required></br></br>

            <label for="direccion">Dirección: </label>
            <input type="text" name="direccion" placeholder="Ingrese su Dirección" value="<?php echo $data['direccion'] ?>" required></br></br>

            <label for="telefono">Teléfono: </label>
            <input name="telefono" type="tel" pattern="([0-9]{1}(-[0-9]{3})(-[0-9]{4}))" placeholder="X-XXX-XXXX" value="<?php echo $data['telefono'] ?>" required></br></br>

            <label for="email">Email: </label>
            <input type="email" name="email" placeholder="Ingrese su Dirección de Correo" size="25" value="<?php echo $data['email'] ?>" required></br></br>

            <label for="logo">Logo: </label>
            <img src = 'data:image/.jpg;base64, <?php echo base64_encode($data['logo']) ?>' width = '70px' height = '100px'/><br><br>

            <button type="button" name="volver"><a href="home.php"> Volver </a></button>

        </form>
    </fieldset>
</body>

</html>