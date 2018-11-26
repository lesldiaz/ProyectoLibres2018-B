<?php
    require_once "pdo.php";
    require_once "mail.php";
    require_once "delete.php";
    session_start();

    if ( isset($_POST["usuario"]) && isset($_POST["pw"]) && isset($_POST["idProfAdd"]) &&
        isset($_POST["nomProf"]) && isset($_POST["mailProf"]) ) {
        $pwd_hash = password_hash($_POST["pw"], PASSWORD_DEFAULT);
        $sql = "UPDATE profesor SET
                usuarioProf = :usuarioProf,
                pwProf = :pwProf
                WHERE idProfesor = :idProfesor";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':usuarioProf' => $_POST["usuario"],
            ':pwProf' => $pwd_hash,
            ':idProfesor' => $_POST["idProfAdd"]));
        $_SESSION["addProf"] = "Profesor agregado al sistema correctamente.";
        sendMailP($_POST["mailProf"], $_POST["nomProf"], $_POST["usuario"], $_POST["pw"]);
        unset($_POST["usuario"]);
        unset($_POST["pw"]);
        unset($_POST["idProfAdd"]);
        unset($_POST["nomProf"]);
        unset($_POST["mailProf"]);
        header( 'Location: users.php' ) ;
        return;
    }
    if ( isset($_POST["idProfDel"]) ) {
        $sql = "SELECT idOA, ruta_zip FROM objetoaprendizaje WHERE idProfesor = :idProfesor";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(':idProfesor' => $_POST["idProfDel"]));
        foreach ($stmt as $oa) {
            deleteOA($oa['ruta_zip'], $oa['idOA']);
        }

        $sql = "DELETE FROM profesor WHERE idProfesor = :idProfesor";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(':idProfesor' => $_POST["idProfDel"]));
        $_SESSION["delProf"] = "Profesor eliminado del sistema correctamente.";
        unset($_POST["idProfDel"]);
        header( 'Location: users.php' ) ;
        return;
    }
    if ( isset($_POST["idEstDel"]) ) {
        $sql = "DELETE FROM estudiante WHERE idEstudiante = :idEstudiante";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(':idEstudiante' => $_POST["idEstDel"]));
        $_SESSION["delProf"] = "Estudiante eliminado del sistema correctamente.";
        unset($_POST["idEstDel"]);
        header( 'Location: users.php' ) ;
        return;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        require "head.php";
    ?>
    <style>
        .jumbotron {
            padding-top:20px;
            padding-bottom:20px;
        }

        .top5 {
            margin-top:15px;
        }

        .bottom5 {
            margin-bottom:20px;
        }

        .padding5 {
            padding-right: 45px;
        }

        .padding15 {
            padding-left: 0px;
        }
    </style>
</head>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <?php
    require "navbar.php";
  ?>
  <div class="content-wrapper bg-light">
    <?php
        #alerts sign in session
        if ( isset($_SESSION["addProf"]) ) {
            echo('<div class="alert alert-success alert-dismissable">');
            echo('<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>');
            echo($_SESSION["addProf"]);
            echo('</div>');
            unset($_SESSION["addProf"]);
        }
        if ( isset($_SESSION["delProf"]) ) {
            echo('<div class="alert alert-danger alert-dismissable">');
            echo('<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>');
            echo($_SESSION["delProf"]);
            echo('</div>');
            unset($_SESSION["delProf"]);
        }
    ?>
    <div class="container">
        <div class="jumbotron">
            <h2 class="display-5 text-center">Panel Administracion de Usuarios</h2>
        </div>
    </div>
    <div class="row bottom5">
        <div class="col-10 offset-1">
            <div class="card">
                <h5 class="card-header bg-dark text-white">Nuevos Profesores</h5>
                <div class="card-body">
                <?php
                    $result = $pdo->query("SELECT idProfesor, cedulaProf, nombresProf, apellidosProf, correoProf, nombreDepartamento FROM profesor p JOIN departamento d ON p.idDepartamento = d.idDepartamento WHERE usuarioProf = ''");
                    $iterated = false;
                    $counter = 0;
                    foreach ($result as $row) {
                        $iterated = true;
                        $id = $row['idProfesor'];
                        $nombre = $row['nombresProf'] . ' ' . $row['apellidosProf'];
                        if ($counter > 0) {
                            echo '<hr>';
                        }
                        echo '<div class="row bottom5">';
                        echo '<div class="col-10 offset-1">';
                        echo '<div class="card-block">';
                        echo '<h5 class="card-title"><strong><u>' . $nombre . '</u></strong></h5>';
                        echo '<div class="row top5">';
                        echo '<div class="col-3 text-right padding5">';
                        echo '<b>Cédula:</b>';
                        echo '</div>';
                        echo '<div class="col text-justify padding15">';
                        echo $row['cedulaProf'];
                        echo '</div>';
                        echo '</div>';
                        echo '<div class="row top5">';
                        echo '<div class="col-3 text-right padding5">';
                        echo '<b>Correo Electronico:</b>';
                        echo '</div>';
                        echo '<div class="col text-justify padding15">';
                        echo $row['correoProf'];
                        echo '</div>';
                        echo '</div>';
                        echo '<div class="row top5">';
                        echo '<div class="col-3 text-right padding5">';
                        echo '<b>Departamento:</b>';
                        echo '</div>';
                        echo '<div class="col text-justify padding15">';
                        echo $row['nombreDepartamento'];
                        echo '</div>';
                        echo '</div>';
                        echo '<form method="post">';
                        echo '<div class="form-group top5">';
                        echo '<div class="form-row">';
                        echo '<div class="col-4">';
                        echo '<input class="form-control" id="usuario" name="usuario" type="text" maxlength="15" placeholder="Usuario" required>';
                        echo '</div>';
                        echo '<div class="col-4">';
                        echo '<input class="form-control" id="pw" name="pw" type="password" placeholder="Contraseña" required>';
                        echo '</div>';
                        echo '<div class="col-4">';
                        echo '<input type="hidden" name="nomProf" value="' . $nombre . '">';
                        echo '<input type="hidden" name="mailProf" value="' . $row['correoProf'] . '">';
                        echo '<input type="hidden" name="idProfAdd" value="' . $id . '">';
                        echo '<input class="btn btn-primary btn-block" type="submit" value="Agregar Profesor">';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</form>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        $counter++;
                    }
                    if (!$iterated) {
                        echo '<div class="row bottom5 top5">';
                        echo '<div class="col-10 offset-1">';
                        echo '<div class="card-block">';
                        echo '<h5 class="card-title"><strong>No existen nuevos registros.</strong></h5>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row bottom5">
        <div class="col-10 offset-1">
            <div class="card">
                <h4 class="card-header bg-dark text-white">Profesores</h4>
                <div class="card-body">
                <?php
                    $result = $pdo->query("SELECT * FROM profesor p JOIN departamento d ON p.idDepartamento = d.idDepartamento WHERE usuarioProf != ''");
                    $iterated = false;
                    $counter = 0;
                    foreach ($result as $row) {
                        $iterated = true;
                        $id = $row['idProfesor'];
                        if ($counter > 0) {
                            echo '<hr>';
                        }
                        echo '<div class="row bottom5">';
                        echo '<div class="col-10 offset-1">';
                        echo '<div class="card-block">';
                        echo '<h5 class="card-title"><strong><u>' . $row['nombresProf'] . ' ' . $row['apellidosProf'] . '</u></strong></h5>';
                        echo '<div class="row top5">';
                        echo '<div class="col-3 text-right padding5">';
                        echo '<b>Cédula:</b>';
                        echo '</div>';
                        echo '<div class="col text-justify padding15">';
                        echo $row['cedulaProf'];
                        echo '</div>';
                        echo '</div>';
                        echo '<div class="row top5">';
                        echo '<div class="col-3 text-right padding5">';
                        echo '<b>Correo Electronico:</b>';
                        echo '</div>';
                        echo '<div class="col text-justify padding15">';
                        echo $row['correoProf'];
                        echo '</div>';
                        echo '</div>';
                        echo '<div class="row top5">';
                        echo '<div class="col-3 text-right padding5">';
                        echo '<b>Departamento:</b>';
                        echo '</div>';
                        echo '<div class="col text-justify padding15">';
                        echo $row['nombreDepartamento'];
                        echo '</div>';
                        echo '</div>';
                        echo '<div class="row top5">';
                        echo '<div class="col-3 text-right padding5">';
                        echo '<b>Usuario:</b>';
                        echo '</div>';
                        echo '<div class="col text-justify padding15">';
                        echo $row['usuarioProf'];
                        echo '</div>';
                        echo '</div>';
                        echo '<form method="post">';
                        echo '<div class="form-group top5">';
                        echo '<div class="form-row">';
                        echo '<div class="col-4 offset-8">';
                        echo '<input type="hidden" name="idProfDel" value="' . $id . '">';
                        echo '<input class="btn btn-danger btn-block" type="submit" value="Borrar">';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</form>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        $counter++;
                    }
                    if (!$iterated) {
                        echo '<div class="row bottom5 top5">';
                        echo '<div class="col-10 offset-1">';
                        echo '<div class="card-block">';
                        echo '<h5 class="card-title"><strong>No existen profesores registrados.</strong></h5>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row bottom5">
        <div class="col-10 offset-1">
            <div class="card">
                <h5 class="card-header bg-dark text-white">Estudiantes</h5>
                <div class="card-body">
                <?php
                    $result = $pdo->query("SELECT * FROM estudiante e JOIN carrera c ON e.idCarrera = c.idCarrera");
                    $iterated = false;
                    $counter = 0;
                    foreach ($result as $row) {
                        $iterated = true;
                        $id = $row['idEstudiante'];
                        if ($counter > 0) {
                            echo '<hr>';
                        }
                        echo '<div class="row bottom5">';
                        echo '<div class="col-10 offset-1">';
                        echo '<div class="card-block">';
                        echo '<h5 class="card-title"><strong><u>' . $row['nombresEst'] . ' ' . $row['apellidosEst'] . '</u></strong></h5>';
                        echo '<div class="row top5">';
                        echo '<div class="col-3 text-right padding5">';
                        echo '<b>Cédula:</b>';
                        echo '</div>';
                        echo '<div class="col text-justify padding15">';
                        echo $row['cedulaEst'];
                        echo '</div>';
                        echo '</div>';
                        echo '<div class="row top5">';
                        echo '<div class="col-3 text-right padding5">';
                        echo '<b>Correo Electronico:</b>';
                        echo '</div>';
                        echo '<div class="col text-justify padding15">';
                        echo $row['correoEst'];
                        echo '</div>';
                        echo '</div>';
                        echo '<div class="row top5">';
                        echo '<div class="col-3 text-right padding5">';
                        echo '<b>Carrera:</b>';
                        echo '</div>';
                        echo '<div class="col text-justify padding15">';
                        echo $row['nombreCarrera'];
                        echo '</div>';
                        echo '</div>';
                        echo '<div class="row top5">';
                        echo '<div class="col-3 text-right padding5">';
                        echo '<b>Usuario:</b>';
                        echo '</div>';
                        echo '<div class="col text-justify padding15">';
                        echo $row['usuarioEst'];
                        echo '</div>';
                        echo '</div>';
                        echo '<form method="post">';
                        echo '<div class="form-group top5">';
                        echo '<div class="form-row">';
                        echo '<div class="col-4 offset-8">';
                        echo '<input type="hidden" name="idEstDel" value="' . $id . '">';
                        echo '<input class="btn btn-danger btn-block" type="submit" value="Borrar">';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</form>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        $counter++;
                    }
                    if (!$iterated) {
                        echo '<div class="row bottom5 top5">';
                        echo '<div class="col-10 offset-1">';
                        echo '<div class="card-block">';
                        echo '<h5 class="card-title"><strong>No existen estudiantes registrados.</strong></h5>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                ?>
                </div>
            </div>
        </div>
    </div>
    <?php
      require "footer.php";
    ?>
  </div>
</body>

</html>
