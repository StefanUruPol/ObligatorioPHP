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


    $sql2 = mysqli_query($conexion, "SELECT 
                    persona.codigo_credencial,
                    empresa.nombre,
                    credencial.tipo,
                    credencial.codigo,
                    credencial.fecha_valida_desde,
                    credencial.fecha_valida_hasta,
                    credencial.PIN
                FROM persona
                JOIN empresa
                    ON persona.codigo_credencial = empresa.codigo_credencial 
                JOIN credencial
                    ON credencial.codigo = empresa.codigo_credencial
                   
                    AND
                    credencial.codigo = persona.codigo_credencial");


    $data = mysqli_fetch_array($sql2);
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Banco PHP - Detalle de Credencial</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
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
            <font color="#FFFFFF"><?php echo $row['primer_nombre'] . " " . $row['primer_apellido'] . " " ?><img src='data:image/.jpg;base64, <?php echo base64_encode($row['foto']) ?> ' width='70px' height='90px' /></font>
        </h1>

    </header></br>

    <h2 align="center">Detalle de Credencial</h2></br>

    <fieldset align="center" style="width:450px; margin:auto;"></br>

        <form>

            <label for="nombre">Empresa Emisora: </label>
            <input type="text" name="nombre" placeholder="Ingrese Empresa Emisora" value="<?php echo $data['nombre'] ?>" required></br></br>

            <label for="direccion">Tipo de credencial: </label>
            <input type="text" name="direccion" placeholder="Ingrese tipo de credencial" value="<?php echo $data['tipo'] ?>" required></br></br>

            <label for="telefono">Código: </label>
            <input name="telefono" type="tel" pattern="([0-9]{4}(-[0-9]{4})(-[0-9]{4})(-[0-9]{4}))" placeholder="XXXX-XXXX-XXXX-XXXX" value="<?php echo $data['codigo'] ?>" required></br></br>

            <label for="email">Fecha válida desde: </label>
            <input type="email" name="email" placeholder="Ingrese Fecha Válida Desde" size="21" value="<?php echo $data['fecha_valida_desde'] ?>" required></br></br>

            <label for="email">Fecha válida hasta: </label>
            <input type="email" name="email" placeholder="Ingrese Fecha Válida Hasta" size="21" value="<?php echo $data['fecha_valida_hasta'] ?>" required></br></br>

            <label for="logo">PIN: </label>
            <input name="pin" type="text" pattern="([0-9]{4})" placeholder="XXXX" value="<?php echo $data['PIN'] ?>" required></br></br>

        </form>
    </fieldset>
</body>

</html>