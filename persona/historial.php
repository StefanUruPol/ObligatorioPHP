<?php

include 'conexion.php';
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

    echo "<h2>La Sesion de Usuario Expiró su Tiempo</h2><br/><br/>
    <button><a href='login.php'> Volver a Iniciar Sesión </a></button>
    <button><a href='/ObligatorioPHP/index.php'> Salir </a></button>";
} else 
    //echo "Sesion de Usuario Existente.<br/>";

$email = $_SESSION['email'];
if (!isset($email)) {
    header("login.php");
} else {

$sql = mysqli_query($conexion, "SELECT * FROM persona
          WHERE email = '$email'");

$row = mysqli_fetch_array($sql);


$sql2 = mysqli_query($conexion, "SELECT * FROM empresa, credencial
          WHERE email = '$email'
          AND codigo_credencial = codigo
          ORDER BY fecha_valida_hasta DESC");

$data = mysqli_fetch_array($sql2);
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Banco PHP - Historial de Credenciales</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>

<body>
    <header style=" padding: 3px;background-color: #001a57;">
        <button><a href='home.php'> Inicio </a></button>
        <button><a href='historial.php'> Historial de Credenciales </a></button>
        <button><a href='perfil.php'> Perfil </a></button>
        <button><a href='salir.php'> Salir </a></button>
        <h1 align="right">
            <font color="#FFFFFF"><?php echo $row['primer_nombre'] . " " . $row['primer_apellido'] . " " ?><img src='data:image/.jpg;base64, <?php echo base64_encode($row['foto']) ?> ' width='70px' height='90px' /></font>
        </h1>

    </header></br>
    <form>

        <h2 align="center">Historial de Credenciales</h2><br>

        <table border='1' align='center' style='text-align: center; width: 40%'>
            <tr>
                <th>Empresa Emisora</th>
                <th>Tipo de Credencial</th>
                <th>Código</th>
                <th>Fecha Válida Hasta</th>
            </tr>
            <tr>
                <td><?php echo $data['nombre'] ?></td>
                <td><?php echo $data['tipo'] ?></td>
                <td><?php echo $data['codigo'] ?></td>
                <td><?php echo $data['fecha_valida_hasta'] ?></td>
                <td><a href='detalle_credencial.php'> Detalle de Credencial </a></td>
            </tr>
        </table><br>
    </form>
</body>

</html>