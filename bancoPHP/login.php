
   

<html>
  <head>
    <meta charset="utf-8" />
  </head>
  <body>
    
    <form action="loguear.php" method="post">
      <h1>Inicio de sesión</h1>

      Ingrese email:
      <input
        type="email"
        id="email"
        name="email"
        placeholder="Correo electrónico"
        required
      /><br /><br />
      Ingrese contrasenia:
      <input
        type="password"
        id="password"
        name="password"
        placeholder="Contraseña"
        required
      /><br /><br />
      <input type="submit" name="ingresar" value="Ingresar" />
      <input type="submit" name="registrarse" value="Registrarse" />
      
    </form>
  </body>
</html>