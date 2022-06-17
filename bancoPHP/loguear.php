<?php
require 'conexion.php';
session_start();


$email = $_POST['email'];
$password = $_POST['password']; 



$query = "SELECT COUNT(*) as contar FROM usuario  WHERE email = '$email'
AND password = '$password'";
$consulta = mysqli_query($conexion, $query);
$array = mysqli_fetch_array($consulta);

if($array['contar'] > 0){
    $_SESSION['email'] = $email;
    $_SESSION['start'] = time(); 
  
            // Destroying session after 1 minute
            $_SESSION['expire'] = $_SESSION['start'] + (1 * 10) ; 
    header("location: paginaprincipal.php");

} else {?>
    <?php include("login.php"); ?> <h1 class="bad">Usuario inválido</h1> <?php }

?>