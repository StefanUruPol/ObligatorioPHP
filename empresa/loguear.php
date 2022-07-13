<?php
require 'conexion.php';
session_start();

$email = $_POST['email'];
$contrasenia = ($_POST['password']);
$contrasenia = md5($contrasenia);  

$query = "SELECT COUNT(*) as contar FROM empresa  WHERE email = '$email' AND password = '$contrasenia'";
$consulta = mysqli_query($conexion, $query);
$array = mysqli_fetch_array($consulta);

if($array['contar'] > 0){
    $_SESSION['email'] = $email;
    $_SESSION['start'] = time(); 
  
            // Destroying session after 1 minute
            $_SESSION['expire'] = $_SESSION['start'] + (1 * 60) ; 
    header("location: home.php");

} else {?>
    <?php include("login.php"); ?> <h1 class="bad">Usuario inválido</h1> <?php }

?>