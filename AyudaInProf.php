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
      <h4 class="card-header">Ayuda  Página Inicio Profesor</h4>
      <div class="card-body">
        <form method="post">
          <div class="form-group">
            <h5>Crear Objeto de Aprendizaje</h5>
            <pre> Al seleccionar esta opción  se desplegara en la parte derecha la 
 herramienta  exelearning, la cual nos ayudara a crear objetos de 
 aprendizaje.
 A continuación se encuentra un video instructivo de cómo utilizar
 la herramienta.
 
 
 
 <iframe width="560" height="315" src="https://www.youtube.com/embed/6GTNU_3moiI" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
   <p> Imagen pantalla crear objeto de aprendizaje</p>
   <pre><img src="images/ayudaInProf.png" style="float:center; width:550px;height:300px; margin:1em"></pre>
			</pre>
			<h5> Repositorio de Objeto de Aprendizaje</h5>
            <pre> Al seleccionar esta opción  se desplegara un submenú en  cual 
 consta de "Importar y catalogar objetos de aprendizaje" y "Buscar Objetos 
 de aprendizaje". 			
			</pre>
			
			<h5> Importar y Catalogar Objetos de Aprendizaje</h5>
            <pre> Al seleccionar esta opción  se desplegara en la parte derecha 
un formulario el cual deberemos ingresar la información requerida que es:
1) Nombre del OA : en esta opción ingresaremos el nombre de nuestro OA
2)  Descripción: se ingresara una descripción rápida del OA
3)  Autor: ingresaremos el nombre del creador del OA
4) Institución: ingresaremos  el nombre de la institución que pertenece el 
   autor
5) Fecha de creación: ingresaremos la fecha en la que fue creado el OA
6) Palabra clave : ingresamos una palabra que identifique el OA
7) Adjuntar un archivo: adjuntamos el archivo .zip del OA

			</pre>
			<pre><img src="images/AyudaInProf1.png" style="float:center; width:550px;height:300px; margin:1em"></pre>
			
			<h5> Buscar Objeto de Aprendizaje</h5>
            <pre> Al seleccionar esta opción  se desplegara un submenú "Bucar Objetos
 de Aprendizaje".
 Este menú te pide  que ingreses el nombre del objeto de aprendizaje 
 que quieres buscar.
			</pre>
			<pre><img src="images/AyudaInProf2.png" style="float:center; width:550px;height:300px; margin:1em"></pre>
			
			
			<h5> Herramientas Adicionales</h5>
            <pre>En este apartado encontraras herramientas adicionales para la creación de OA
 <pre><img src="images/ayudaInProf3.png" style="float:center; width:550px;height:300px; margin:1em"></pre>
			</pre>
			<h5> Salir del sistema</h5>
            <pre> Para salir del sistema solo se debe hacer clic en la opción "Logout" que 
 se encuentra en la parte superior derecha de la pantalla 
 <pre><img src="images/ayudaInAdmin2.png" style="float:center; width:550px;height:50px; margin:1em"></pre>
			</pre>
			
          </div>
		  
        <div class="text-center">
          <a class="d-block small mt-3" href="index.php">Regresar Página Principal del Profesor</a>
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
