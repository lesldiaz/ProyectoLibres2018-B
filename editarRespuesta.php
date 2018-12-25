<?php
require_once "enviar_correoAprendizaje.php";
require_once "pdo.php";
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
        require "head.php";
    ?>
    <style>
        .jumbotron {
            padding-top: 20px;
            padding-bottom: 20px;
        }

        .bottom5 {
            margin-bottom:20px;
        }
    </style>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">

    <?php
        require "navbar.php";
    ?>

    <div class="content-wrapper bg-light">
        <div class="container">
            <div class="jumbotron">
                <h2 class="display-5 text-center">Editar Respuesta</h2>
            </div>
        </div>
        <div class="row bottom5">
            <div class="col-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <form method="post">
                          <?php
                          $sql = "SELECT * FROM resforo WHERE idRespuesta = :id";
                          $stmt = $pdo->prepare($sql);
                          $stmt->execute(array(':id' => $_GET["id"]));
                          $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                echo '<div class="form-group">
                                    <label for="nombreOA">Asunto</label>
                                    <input type="text" class="form-control" id="nombreOA" placeholder="Tema o Asunto" value="' . $row["asunto"] . '" required>
                                </div>
                                <div class="form-group">
                                    <label for="descripcion">Descripción</label>
                                    <textarea rows="3" class="form-control" id="descripcion" required>' . $row["descripcion"] . '</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="autorOA">Autor</label>
                                    <input type="text" class="form-control" id="autorOA" value="' . $row["autor"]  . '" readonly>
                                </div>';
                                if ($row["nombreadjunto"]){
                                echo '<div class="form-group">
                                    <label for="autorOA">¿Eliminar Archivo <b><a href="foroimg/'.$row["nombreadjunto"].'" target="_blank">'.$row["nombreadjunto"].'</a></b>? </label>
                                    <a class="btn btn-danger" href="borrarAdjuntoR.php?nombre='.$row["nombreadjunto"].'&idRespuesta='.$row["idRespuesta"].'"> Si </a>
                                </div>';
                              }
                              else{
                                echo '<div class="form-group">
                                    <label for="file1">Adjuntar un archivo</label>
                                    <input type="file" class="form-control" name="file1" id="file1">
                                </div>';
                              }
                                echo '<div class="form-group">
                                    <div class="form-row">
                                        <div class="col-4 offset-4">
                                            <a class="btn btn-primary" href="foroActual.php?foroID='.$row["idForo"].'"> Cancelar </a>
                                        </div>
                                        <div class="col-4">
                                            <input name="idRespuesta" type="hidden" id="idRespuesta" value="'.$row["idRespuesta"].'">';
                                            $ed=0;
                                            if ($row["autor"] != $_SESSION["userName"]){
                                              $ed=1;
                                                echo '<input name="edAutor" type="hidden" id="edAutor" value="'.$ed.'">';
                                            }else {
                                                echo '<input name="edAutor" type="hidden" id="edAutor" value='.$ed.'>';
                                            }
                                            echo '<input name="idForo" type="hidden" id="idForo" value="'.$row["idForo"].'">';
                                            echo '<button type="button" class="btn btn-success btn-block" onclick="uploadFile()">Actualizar</button>
                                        </div>
                                    </div>
                                </div>';
                                ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
            require "footer.php";
        ?>
	       <script src="vendor/jszip/jszip.js"></script>
         <script src="vendor/jszip/jszip-utils.js"></script>
         <script>
            /* Script written by Miguel Nunez @ minuvasoft10.com */
            function _(el) {
                return document.getElementById(el);
            }

            function uploadFile() {
				//enviarcorreobloc();
              if (document.getElementById('nombreOA').value == '' || document.getElementById('descripcion').value ==
                    '' || document.getElementById('autorOA').value == '') {
                        alert("Error: Uno o más campos vacios");
                } else {
                    var formdata = new FormData();
                    if(document.getElementById('file1')!=null){
                    var file = _("file1").files[0];
                  }else {
                    var file = null;
                  }
                    var idForo = _("idForo").value;
                    formdata.append("file1", file);
                    formdata.append("nombreOA", _("nombreOA").value);
                    formdata.append("descripcion", _("descripcion").value);
                    formdata.append("autorOA", _("autorOA").value);
                    formdata.append("idRespuesta", _("idRespuesta").value);
                    formdata.append("edAutor", _("edAutor").value);
                    var ajax = new XMLHttpRequest();
                    ajax.upload.addEventListener("progress", progressHandler, false);
                    ajax.open('POST','upload5.php');
                    ajax.send(formdata);
                    alert("Respuesta Actualizado Existosamente");
                    var ubic = "foroActual.php?foroID=";
                    ubic = ubic+idForo;
					          javascript: location.href = ubic;
                }
            }

            function progressHandler(event) {
                _("loaded_n_total").innerHTML = "Subidos " + event.loaded + " bytes de " + event.total;
            }


      </script>
    </div>
</body>

</html>
