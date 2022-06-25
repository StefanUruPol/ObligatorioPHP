<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Banco PHP - Login</title>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>

<body align="center">
  <header style=" padding: 3px;background-color: #001a57;"><br />
    <h1><img src="WampServer-logo.png" width='90px' height='90px' />
      <font color="#FFFFFF"> Banco PHP</font>
    </h1><br />
  </header></br>

  <h2>Inicio de sesión</h2>

  <fieldset style=" width:450px; margin:auto;"></br>
    <form action="loguear.php" method="post">

      Email:
      <input type="email" name="email" placeholder="Ingrese Correo electrónico" required /><br /><br />
      Contraseña:
      <input type="password" name="password" placeholder="Ingrese Contraseña" required /><br /><br />

      <input type="submit" name="ingresar" value="Ingresar" />
      <button type="button" name="registrarse" value="Registrarse"><a href="registrarse.php"> Registrarse </a></button>
      <button type="button" name="salir"><a href='/ObligatorioPHP/index.php'> Inicio </a></button>

    </form>
  </fieldset>
</body>

</html>