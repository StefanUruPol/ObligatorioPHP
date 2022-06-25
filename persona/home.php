<?php

include 'conexion.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title>Banco PHP - Home</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>

<body>
    <form>

        <?php
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

            echo "<strong>La Sesion de Usuario Expiró su Tiempo</strong><br/><br/>
            <button type='button' name='volver'><a href='login.php'> Volver a Iniciar Sesión </a></button>
            <button type='button' name='volver'><a href='/ObligatorioPHP/index.php'> Salir </a></button>";
        } else

            //echo "Sesion de Usuario Existente.<br/>";

            $email = $_SESSION['email'];

        if (!isset($email)) {
            header("login.php");
        } else {

            $sql = mysqli_query($conexion, "SELECT * FROM persona
                            WHERE email= '$email'");

            $data = mysqli_fetch_array($sql);

        
    

               
                
                
                $sql2 = mysqli_query($conexion, "SELECT 
                    persona.codigo_credencial,
                    empresa.logo,
                    empresa.nombre,
                    credencial.tipo,
                    credencial.codigo,
                    credencial.fecha_valida_hasta
                FROM persona
                JOIN empresa
                    ON persona.codigo_credencial = empresa.codigo_credencial 
                JOIN credencial
                    ON credencial.codigo = empresa.codigo_credencial
                   
                    AND
                    credencial.codigo = persona.codigo_credencial");

                    $resultado = mysqli_fetch_array($sql2);

                    
        }    
                    
                    
                    
                   

            echo "
            <header style=' padding: 3px;background-color: #001a57;'>
            <button><a href='home.php'> Inicio </a></button>
            <button><a href='historial.php'> Historial de Credenciales </a></button>
            <button><a href='perfil.php'> Perfil </a></button>
            <button><a href='salir.php'> Salir </a></button>
            <h1 align='right'><font color='#FFFFFF'>" . $data['primer_nombre'] . " " . $data['primer_apellido'] . " " . "<img src = data:image/.jpg;base64," . base64_encode($data['foto']) . " width = '70px' height = '90px'/></font></h1>
            </header></br>
        
            <h2 align='center'>Página Principal</h2><br> "
            
            . $resultado['RUT'];
        
        ?>

    </form>
</body>

</html>