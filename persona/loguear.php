<?php
require 'conexion.php';
session_start();

$email = $_POST['email'];
$contrasenia = $_POST['password']; 

$query = "SELECT COUNT(*) as contar FROM persona  WHERE email = '$email' AND password = '$contrasenia'";
$consulta = mysqli_query($conexion, $query);
$array = mysqli_fetch_array($consulta);

if($array['contar'] > 0){
    $_SESSION['email'] = $email;
    $_SESSION['start'] = time(); 
  
            // Destroying session after 1 minute
            $_SESSION['expire'] = $_SESSION['start'] + (1 * 10) ; 
    header("location: home.php?") . $_SESSION['CI'];

} else {?>
    <?php include("login.php"); ?> <h2 align="center" class="bad">Usuario inválido</h2> <?php }

?>