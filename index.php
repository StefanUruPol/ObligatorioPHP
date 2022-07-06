<html>

<head>
  <title>Banco PHP</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link href="/ObligatorioPHP/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body>
  <header style=" padding: 3px;background-color: #001a57;"><br />
    <h1 align="center"><img src="WampServer-logo.png" width='90px' height='90px' />
      <font color="#FFFFFF"> Banco PHP</font>
    </h1><br />
  </header></br>

  <fieldset align="center" style=" width:450px; margin:auto;"></br>
    <form>

      <h2>Elija el tipo de usuario:</h2><br />

      <button type="button" name="persona" onclick= "location.href= '/ObligatorioPHP/persona/login.php' "> Persona</button>
      <button type="button" name="empresa" onclick= "location.href= '/ObligatorioPHP/empresa/login.php' "> Empresa</button>

    </form>
  </fieldset>
</body>

</html>