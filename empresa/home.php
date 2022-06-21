<?php
    include 'conexion.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title>Banco PHP - Home</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
</head>

<body>
    <form>

    <?php
    session_start();
    $email = $_SESSION['email'];

    if (!isset($email)) {
        header("login.php");

    } else {

        $sql = mysqli_query($conexion, "SELECT * FROM empresa
                            WHERE email= '$email'");

        $data = mysqli_fetch_array($sql);

        echo "<h1> BIENVENIDO " .$data['nombre']. "</h1>

        <button><a href='salir.php'> Salir </a></button>";
    }
    ?>

    </form>
  </body>
</html>