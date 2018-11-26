<!DOCTYPE html>
<html lang="en">

<head>
  <?php
    require "head.php";
  ?>

  <style>
    .bottom5 { 
        margin-bottom:70px; 
    }
  </style> 
</head>

<body class="bg-dark">
  <div class="container">
    <?php
      if ( isset($_SESSION["errorRE"]) ) {
        echo('<div class="alert alert-danger alert-dismissable">');
        echo('<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>');
        echo('<strong>Error! </strong>' . $_SESSION["errorRE"]);
        echo('</div>');
        unset($_SESSION["errorRE"]);
      }
    ?>
    <div class="card card-register mx-auto mt-5 bottom5">
      <h4 class="card-header">Ayuda  Página Inicio Estudiante</h4>
      <div class="card-body">
        <form method="post">
          <div class="form-group">
            
			<h5> Repositorio de Objeto de Aprendizaje</h5>
            <pre> Al seleccionar esta opción  se desplegara un submenú en  cual 
 consta "Buscar Objetos  de aprendizaje". 			
			</pre>
			
			<h5> Buscar Objeto de Aprendizaje</h5>
            <pre> Al seleccionar esta opción  se desplegara un submenú "Bucar Objetos
 de Aprendizaje".
 Este menú te pide  que ingreses el nombre del objeto de aprendizaje 
 que quieres buscar.
			</pre>
			<pre><img src="images/ayudaInEst.png" style="float:center; width:550px;height:300px; margin:1em"></pre>
			
			
			<h5> Herramientas Adicionales</h5>
            <pre>En este apartado encontraras herramientas adicionales para la creación de OA
 <pre><img src="images/ayudaInEst1.png" style="float:center; width:550px;height:300px; margin:1em"></pre>
			</pre>
			<h5> Salir del sistema</h5>
            <pre> Para salir del sistema solo se debe hacer clic en la opción "Logout" que 
 se encuentra en la parte superior derecha de la pantalla 
 <pre><img src="images/ayudaInAdmin2.png" style="float:center; width:550px;height:50px; margin:1em"></pre>
			</pre>
			
          </div>
		  
        <div class="text-center">
          <a class="d-block small mt-3" href="index.php">Regresar Página Principal del Estudiante</a>
        </div>
      
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>
