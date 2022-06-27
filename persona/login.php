<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Banco PHP - Login</title>
  <link href="/ObligatorioPHP/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body>
  <header style=" padding: 3px;background-color: #001a57;"><br />
    <h1 align="center"><img src="WampServer-logo.png" width='90px' height='90px' />
      <font color="#FFFFFF"> Banco PHP</font>
    </h1><br />
  </header></br>

  <h2 align="center">Inicio de sesión</h2>

  <fieldset align="center" style=" width:450px; margin:auto;"></br>
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