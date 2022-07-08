<?php

include 'conexion.php';
session_start();

//Check the session is expired or not

if (isset($_SESSION['start']) && (time() - $_SESSION['start'] > 60 * 10)) {

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

} else {
    //echo "Sesion de Usuario Existente.<br/>";
}

$email = $_SESSION['email'];

$sql = mysqli_query($conexion, "SELECT * FROM persona
          WHERE email = '$email'");

$data = mysqli_fetch_array($sql);

if (!isset($_SESSION['start'])) {

    //Set the session start time

    $_SESSION['start'] = time();
}

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
        <h1 align="right">
            <font color="#FFFFFF"><?php echo $data['primer_nombre'] . " " . $data['primer_apellido'] . " " ?><img src='data:image/.jpg;base64, <?php echo base64_encode($data['foto']) ?> ' width='70px' height='90px' /></font>
        </h1>
    </header></br>

    <h2 align="center">Perfil de Usuario</h2></br>

    <fieldset style=" width:450px; margin:auto;"></br>

        <form method="post" action="" enctype="multipart/form-data" align="center">

            <label for="ci">Cédula de Identidad: </label>
            <input type="text" name="ci" pattern="[0-9]+" placeholder="12345678" value=" <?php echo $data['CI'] ?> " required></br></br>

            <label for="nombre">Primer Nombre: </label>
            <input type="text" name="primerNombre" placeholder="Ingrese su Primer Nombre" value=" <?php echo $data['primer_nombre'] ?> " required></br></br>

            <label for="nombre2">Segundo Nombre: </label>
            <input type="text" name="segundoNombre" placeholder="Ingrese su Segundo Nombre" value=" <?php echo $data['segundo_nombre'] ?> "></br></br>

            <label for="apellido">Primer Apellido: </label>
            <input type="text" name="primerApellido" placeholder="Ingrese su Primer Apellido" value=" <?php echo $data['primer_apellido'] ?> " required></br></br>

            <label for="apellido2">Segundo Apellido: </label>
            <input type="text" name="segundoApellido" placeholder="Ingrese su Segundo Apellido" value=" <?php echo $data['segundo_apellido'] ?> " required></br></br>

            <label for="fecha">Fecha de Nacimiento: </label>
            <input type="text" name="fechaDeNacimiento" value=" <?php echo $data['fecha_de_nacimiento'] ?> " required></br></br>

            <label for="email">Email: </label>
            <input type="email" name="email" placeholder="Ingrese su Dirección de Correo" size="25" value=" <?php echo $data['email'] ?> " required></br></br>

            <label for="foto">Foto de Usuario: </label>
            <img src='data:image/.jpg;base64, <?php echo base64_encode($data['foto']) ?>' width='100px' height='130px' /><br><br>

        </form>
    </fieldset>
</body>

</html>