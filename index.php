<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php
    require "head.php"; //la funcion requiere en cada script toma la funcionalidad de dicho script y lo replica en este documento. Sirve para codigo limpio
  ?>

</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <?php
    require "navbar.php";

  ?>
  <input type="hidden" id="variable" name="variable" value="<?php echo $_GET["comp"]?>">
  <div class="modal fade" id="mostrarmodal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">

            <h3>¡Felicidades!</h3>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
     </div>
         <div class="modal-body">
            <h5>Ahora eres un Colaborador</h5>
            Por favor completa el formulario con tus datos lo más pronto posible.
     </div>
         <div class="modal-footer">
        <button type="button" class="btn btn-success btn-block" onclick="guardar()">Completar Ahora</button>
        <a href="#" data-dismiss="modal" class="btn btn-danger">Más Tarde</a>
     </div>
      </div>
   </div>
</div>
  <div class="content-wrapper">
    <?php //En esta parte el $_SESSION[] succes controla que un usuario se haya logueado correctamente
      if ( isset($_SESSION["success"]) ) {
          echo('<div class="alert alert-success alert-dismissable">');
          echo('<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>');
          echo('<strong>Ingreso Correcto!</strong> Ahora puede usar el sistema.');
          echo('</div>');
          unset($_SESSION["success"]);
      }

      //esta parte del codigo es el anuncia cuando un usuario se registro correctamente
      //<button>Probando <i class="fas fa-play"></i></button>
      if ( isset($_SESSION["reg"]) ) {
        echo('<div class="alert alert-success alert-dismissable">');
        echo('<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>');
        echo($_SESSION["reg"]);
        echo('</div>');
        unset($_SESSION["reg"]);
      }

    ?>
      <div class="jumbotron">
          <img src="images/logoEPN.png" style="float:right; width:100px;height:100px; margin:1em">
          <h1>SISTEMA DE GESTIÓN DE OBJETOS DE APRENDIZAJE</h1>
          <p class="lead" align="justify">Esta herramienta es desarrollada por estudiantes de la Escuela Politécnica Nacional para la creación y gestión de objetos de aprendizaje. Es una herramienta gratuita la cual permite expandir y compartir conocimiento en diversas áreas  mediante la utilización  de herramientas de aprendizaje.</p>
          <p class="lead" align="justify">Un Objeto de Aprendizaje es un conjunto de recursos digitales, autocontenible y reutilizable, con un propósito educativo y constituido por al menos tres componentes internos: contenidos, actividades de aprendizaje y elementos de contextualización.</p>

          <hr class="my-3">

          <a href="#" onclick="window.open('Manual-Usuario.pdf')">Conocer Más</a>
      </div>

    <?php
      require "footer.php";
    ?>

  </div>
</body>
<script>
$(document).ready(function()
  {
    var elemento = document.getElementById("variable").value;
    if (elemento == "SI"){
      $("#mostrarmodal").modal("show");
    }
  });
  function guardar() {
     window.location="datosColab.php";
  }
</script>
</html>
