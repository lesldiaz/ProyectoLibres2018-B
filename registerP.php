<?php
 require_once "pdo.php";
require_once "mail.php";

require_once "cedula.php";
  //session_start();
  if ( isset($_POST["cedula"]) && isset($_POST["nombre"]) && isset($_POST["apellido"])
    && isset($_POST["correo"]) && isset($_POST["departamento"]) ) {
    if (validarCedula($_POST["cedula"])) 
    {
        $sql =' CALL registrarProfesor(:cedulaProf, :nombresProf, :apellidosProf, :correoProf, :idDepartamento, :bloqueo)';
        $pwd_hash = password_hash($_POST["nombre"], PASSWORD_DEFAULT);
        $stmt = $pdo->prepare($sql);
      $stmt->execute(array(
      ':cedulaProf' => $_POST["cedula"],
      ':nombresProf' => $_POST["nombre"],
      ':apellidosProf' => $_POST["apellido"],
      ':correoProf' => $_POST["correo"],
      ':idDepartamento' => $_POST["departamento"],
	  ':bloqueo' => 0));
      
      //$nameto = $_POST["nombre"] . ' ' . $_POST["apellido"];
      //sendMailP($_POST["correo"], $nameto,$_POST["nombre"],$_POST["nombre"]);
	  $_SESSION["reg"] = "Formulario enviado correctamente! El administrador le enviara su usuario y contraseña a su correo.";
	  header( 'Location: index.php' ) ;
      return;
    }
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php
    require "head.php";
  ?>
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
    <div class="card card-register mx-auto mt-5">
      <h4 class="card-header">Registro Profesor</h4>
      <div class="card-body">
        <form method="post">
          <div class="form-group">
            <label for="cedula">Cédula</label>
            <input class="form-control" id="cedula" name="cedula" type="text" pattern="\d*" maxlength="10" placeholder="Ingrese su cédula" required>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="nombre">Nombres</label>
                <input class="form-control" id="nombre" name="nombre" type="text" maxlength="50" placeholder="Ingrese sus nombres" required>
              </div>
              <div class="col-md-6">
                <label for="apellido">Apellidos</label>
                <input class="form-control" id="apellido" name="apellido" type="text" placeholder="Ingrese sus apellidos" required>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="correo">Correo electronico</label>
            <input class="form-control" id="correo" name="correo" type="email" placeholder="Ingrese su correo electronico" required>
          </div>
          <div class="form-group">
            <label for="departamento">Departamento</label>
            <select class="form-control" id="departamento" name="departamento">
            <?php
              $result = $pdo->query("SELECT d.idDepartamento, d.nombreDepartamento, f.nombreFacultad FROM departamento d JOIN facultad f ON d.idFacultad = f.idFacultad");
              $facultad = ' ';
              foreach ($result as $row) {
                $departamento = $row['nombreDepartamento'];
                $idDepartamento = $row['idDepartamento'];
                if ($row['nombreFacultad'] != $facultad) {
                  $facultad = $row['nombreFacultad'];
                  if ($idDepartamento > 1) {
                    echo('</optgroup>');
                  }
                  echo('<optgroup label="' . $facultad . '">');
                }
                echo('<option value="' . $idDepartamento . '">' . $departamento . '</option>');
              }
              echo('</optgroup>');
            ?>
            </select>
          </div>
          <input class="btn btn-primary btn-block" type="submit" value="Enviar Formulario">
        </form>
          <div class="text-center">
              <a class="d-block small mt-3" href="AyudaProf.php">Ayuda</a>
          </div>
        <div class="text-center">
          <a class="d-block small mt-3" href="login.php">Regresar a Login</a>
        </div>
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
