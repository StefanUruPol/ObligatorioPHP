<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Banco PHP - Login</title>
  <link href="/ObligatorioPHP/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body align="center">
  <header style=" padding: 3px;background-color: #001a57;"><br />
    <h1><img src="WampServer-logo.png" width='90px' height='90px' />
      <font color="#FFFFFF"> Banco PHP</font>
    </h1><br />
  </header></br>

  <div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
      <h1><img src="WampServer-logo.png" width='90px' height='90px' />
        Banco PHP
      </h1><br />

      <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li><a href="#" class="nav-link px-2 link-secondary">Home</a></li>
        <li><a href="#" class="nav-link px-2 link-dark">Features</a></li>
        <li><a href="#" class="nav-link px-2 link-dark">Pricing</a></li>
        <li><a href="#" class="nav-link px-2 link-dark">FAQs</a></li>
        <li><a href="#" class="nav-link px-2 link-dark">About</a></li>
      </ul>

      <div class="col-md-3 text-end">
        <button type="button" class="btn btn-outline-primary me-2">Login</button>
        <button type="button" class="btn btn-primary">Sign-up</button>
      </div>
    </header>
  </div>

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