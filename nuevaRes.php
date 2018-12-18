<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>c
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
                <h2 class="display-5 text-center">Añadir respuesta</h2>
            </div>
        </div>
        <div class="row bottom5">
            <div class="col-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <form method="post" >
                                <div class="form-group">
                                    <label for="nombreOA">Asunto</label>
                                    <input type="text" class="form-control" id="nombreOA" value="Re: <?php echo $_POST["asuntoForoR"]?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="descripcion">Descripción</label>
                                    <textarea rows="3" class="form-control" id="descripcion" placeholder="Descripción" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="autorOA">Autor</label>
                                    <input type="text" class="form-control" id="autorOA" value="<?php echo $_SESSION["userName"]?>" readonly>
                                </div>
                                <div class="form-group">
                                  <input type="hidden" class="form-control" id="idForo" value="<?php echo $_POST["idForoR"];?>">
                                  <input type="hidden" class="form-control" id="fechaCreacionOA" value="<?php echo date("Y-m-d H:i:s");?>">
                                </div>
                                <div class="form-group">
                                    <label for="file1">Adjuntar un archivo</label>
                                    <input type="file" class="form-control" name="file1" id="file1">
                                </div>
                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-4 offset-4">
                                            <button type="button" class="btn btn-danger btn-block" onclick="javascript:location.href='busTemas.php'">Cancelar</button>
                                        </div>
                                        <div class="col-4">
                                            <button type="button" class="btn btn-success btn-block" onclick="uploadFile()">Añadir</button>
                                        </div>
                                    </div>
                                </div>
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
					          var file = _("file1").files[0];
                    //alert(file.name+" | "+file.size+" | "+file.type);
                    var formdata = new FormData();
                    formdata.append("file1", file);
                    formdata.append("nombreOA", _("nombreOA").value);
                    formdata.append("descripcion", _("descripcion").value);
                    formdata.append("autorOA", _("autorOA").value);
                    formdata.append("fechaCreacionOA", _("fechaCreacionOA").value);
                    formdata.append("idForoR", _("idForo").value);
                    var ajax = new XMLHttpRequest();
                    ajax.upload.addEventListener("progress", progressHandler, false);
                    ajax.open('POST', 'upload3.php');
                    ajax.send(formdata);
                    alert("Respuesta Agregada Correctamente");
					          javascript: location.href = 'busTemas.php';
                }
            }

            function progressHandler(event) {
                _("loaded_n_total").innerHTML = "Subidos " + event.loaded + " bytes de " + event.total;
            }
      </script>
    </div>
</body>

</html>
