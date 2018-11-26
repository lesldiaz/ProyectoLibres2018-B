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
	<?php
        $sql = 'CALL cargarComentarios(:idOA)';
                /*"SELECT detalleComent, nombresProf, apellidosProf
                    FROM comentario c
                    JOIN profesor p
                    ON p.idProfesor = c.idProfesor
                    WHERE idOA = :idOA";*/
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(':idOA' => $id));
            foreach ($stmt as $comment) {
              echo '<li class="list-group-item">';
              echo '<strong>' . $comment['nombresProf'] . ' ' . $comment['apellidosProf'].'  '.$comment['fechaComentario'].'</strong>&emsp;&emsp;&emsp;&emsp;';
              echo $comment['detalleComent'];
			  $idComent=$comment['idComentario'];
			}
	?>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>