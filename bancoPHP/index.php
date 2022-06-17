<html>
  <head>
    <title>Banco PHP</title>
    <script>
      function navegar() {
        var persona = document.getElementById("empresa").value;
        var empresa = document.getElementById("persona").value;
        if ((empresa = "")) {
          window.location.assign("empresaLog.php");
        } else {
          window.location.assign("personaLog.php");
        }
      }
    </script>
  </head>
  <body>
    <form>
      <h1>Banco PHP</h1>
      Elija usuario:<br /><br />
      <button
        type="button"
        name="boton"
        value="a"
        id="empresa"
        onclick="navegar()"
        ;
      >
        Empresa
      </button>
      <button
        type="button"
        name="boton"
        value="b"
        id="persona"
        onclick="navegar()"
        ;
      >
        Persona
      </button>
    </form>
  </body>
</html>
