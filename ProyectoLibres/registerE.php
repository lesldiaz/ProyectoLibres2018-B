<?php
  require_once "pdo.php";
  require_once "mail.php";
  require_once "cedula.php";
  session_start();
  if ( isset($_POST["cedula"]) && isset($_POST["nombre"]) && isset($_POST["apellido"]) && isset($_POST["usuario"])
    && isset($_POST["correo"]) && isset($_POST["carrera"]) && isset($_POST["pw"]) && isset($_POST["pwConf"]) ) {
    if ($_POST["pw"] == $_POST["pwConf"]) {
      if (validarCedula($_POST["cedula"])) 
      {
        $pwd_hash = password_hash($_POST["pw"], PASSWORD_DEFAULT);
        $sql = "INSERT INTO estudiante (cedulaEst, nombresEst, apellidosEst, correoEst, idCarrera, usuarioEst, pwEst)
              VALUES (:cedulaEst, :nombresEst, :apellidosEst, :correoEst, :idCarrera, :usuarioEst, :pwEst)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
          ':cedulaEst' => $_POST["cedula"],
          ':nombresEst' => $_POST["nombre"],
          ':apellidosEst' => $_POST["apellido"],
          ':correoEst' => $_POST["correo"],
          ':idCarrera' => $_POST["carrera"],
          ':usuarioEst' => $_POST["usuario"],
          ':pwEst' => $pwd_hash));
        $_SESSION["reg"] = "Usuario estudiante creado correctamente.";
        header( 'Location: index.php' ) ;
        return;
      }
    } else {
      $_SESSION['errorRE'] = 'Contraseñas no coinciden.';
    }
  }
?>

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
      <h4 class="card-header">Registro Estudiante</h4>
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
            <label for="carrera">Carrera</label>
            <select class="form-control" id="carrera" name="carrera">
            <?php
              $result = $pdo->query("SELECT c.idCarrera, c.nombreCarrera, f.nombreFacultad FROM carrera c JOIN facultad f ON c.idFacultad = f.idFacultad");
              $facultad = ' ';
              foreach ($result as $row) {
                $carrera = $row['nombreCarrera'];
                $idCarrera = $row['idCarrera'];
                if ($row['nombreFacultad'] != $facultad) {
                  $facultad = $row['nombreFacultad'];
                  if ($idCarrera > 1) {
                    echo('</optgroup>');
                  }
                  echo('<optgroup label="' . $facultad . '">');
                }
                echo('<option value="' . $idCarrera . '">' . $carrera . '</option>');
              }
              echo('</optgroup>');
            ?>
            </select>
          </div>
          <div class="form-group">
            <label for="cedula">Usuario</label>
            <input class="form-control" id="usuario" name="usuario" type="text" maxlength="15" placeholder="Ingrese su usuario" required>
          </div>
          <div class="form-group">
            <div class="form-row"> 
              <div class="col-md-6"> 
                <label for="pw">Contraseña</label> 
                <input class="form-control" id="pw" name="pw" type="password" placeholder="Contraseña" required> 
              </div> 
              <div class="col-md-6"> 
                <label for="pwconfirm">Confirmar contraseña</label> 
                <input class="form-control" id="pwConf" name="pwConf" type="password" placeholder="Confirmar contraseña" required> 
              </div> 
            </div>
          </div>
          <input class="btn btn-primary btn-block" type="submit" value="Registrarse">
        </form>
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
