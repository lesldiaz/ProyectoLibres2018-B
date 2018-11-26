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
          <img src="images/logoEPN.png" style="float:right; width:300px;height:300px; margin:1em">
          <h1 class="display-2">SISTEMA DE GESTIÓN DE OBJETOS DE APRENDIZAJE</h1>
          <p class="lead">Esta herramienta es desarrollada por estudiantes de la Escuela Politécnica Nacional para la creación y gestión de objetos de aprendizaje. Es una herramienta gratuita la cual permite expandir y compartir conocimiento en diversas áreas  mediante la utilización  de herramientas de aprendizaje.</p>
          <p class="lead">Un Objeto de Aprendizaje es un conjunto de recursos digitales, autocontenible y reutilizable, con un propósito educativo y constituido por al menos tres componentes internos: contenidos, actividades de aprendizaje y elementos de contextualización.</p>

          <hr class="my-3">

          <a href="#" onclick="window.open('Manual-Usuario.pdf')">Conocer Más</a>
      </div>

    <?php
      require "footer.php";
    ?>

  </div>
</body>

</html>
