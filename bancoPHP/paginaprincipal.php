<?php

session_start();
$email = $_SESSION['email'];


if(!isset($email)){
    header("login.php");

}else{

echo "<h1>BIENVENIDO $email </h1>";


echo "<button><a href='salir.php'>SALIR</a></button>";
}
?>