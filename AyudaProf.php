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
      <h4 class="card-header">Ayuda  Registro Profesor</h4>
      <div class="card-body">
        <form method="post">
          <div class="form-group">
            <h5>Cédula</h5>
            <pre> Ingrese la cédula de ciudadania 10 digitos 
   Ejemplo: 0502873328
			</pre>
			<h5> Nombres y Apellidos</h5>
            <pre> Ingrese los nombres y apellidos del usuario
   Ejemplo: Steven Ramon Vaca Zambrano
			</pre>
			<h5> Correo electronico</h5>
            <pre> Ingrese el correo electronico del usuario
   Ejemplo: srvz@gmail.com
			</pre>
			<h5>Departamento</h5>
            <pre> Los departamentos  están distribuidos por  facultades 
   Ejemplo: Facultad de Ciencias - Departamento de Física (DF)
			</pre>
			<h5> Usuario y Contraseña</h5>
            <pre> Ingrese el usuario y contraseña ha utilizar para iniciar sesión
   Ejemplo: Usuario: srvacaz
            Contraseña: srvacaz1243
			</pre>
			
			
			<pre><img src="images/ayudaRegProf.png" style="float:center; width:500px;height:500px; margin:1em"></pre>
			
          </div>
		  
        <div class="text-center">
          <a class="d-block small mt-3" href="registerP.php">Regresar a Registro Profesor</a>
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
