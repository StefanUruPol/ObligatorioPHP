<html>
  <head>
    <meta charset="utf-8" />
    <title>Banco PHP - Login</title>
  </head>
  <body>
    
    <form action="loguear.php" method="post">
      <h1>Inicio de sesión</h1>

      Ingrese Email:
      <input type= "email" name= "email" placeholder= "Correo electrónico" required/><br/><br/>
      Ingrese Contraseña:
      <input type= "password" name= "password" placeholder= "Contraseña" required/><br/><br/>

      <input type= "submit" name="ingresar" value="Ingresar"/>
      <button type= "button" name="registrarse" value="Registrarse"><a href= "registrarse.php"> Registrarse </a></button>
      
    </form>
  </body>
</html>