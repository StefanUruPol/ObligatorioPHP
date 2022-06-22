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
    
        if(!isset($_SESSION['start']))

{

    //Set the session start time

    $_SESSION['start'] = time();

}


//Check the session is expired or not

if (isset($_SESSION['start']) && (time() - $_SESSION['start'] > 60 * 60)) {

    //Unset the session variables

    session_unset();

    //Destroy the session

    session_destroy();

    echo "Session is expired.<br/>";

}

else

    echo "Current session exists.<br/>";    
    
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
