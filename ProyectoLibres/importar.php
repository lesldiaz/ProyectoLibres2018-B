<?php
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
                <h2 class="display-5 text-center">Importar y Catalogar</h2>
            </div>
        </div>
        <div class="row bottom5">
            <div class="col-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <form method="post">
                                <div class="form-group">
                                    <label for="nombreOA">Nombre del OA</label>
                                    <input type="text" class="form-control" id="nombreOA" placeholder="Nombre" required>
                                </div>
                                <div class="form-group">
                                    <label for="descripcion">Descripcion</label>
                                    <textarea rows="3" class="form-control" id="descripcion" placeholder="Descripcion" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="autorOA">Autor</label>
                                    <input type="text" class="form-control" id="autorOA" placeholder="Autor" required>
                                </div>
                                <div class="form-group">
                                    <label for="institucionOA">Institución</label>
                                    <input type="text" class="form-control" id="institucionOA" placeholder="Institución" required>
                                </div>
                                <div class="form-group">
                                    <label for="fechaCreacionOA">Fecha de creacion</label>
                                    <input type="date" class="form-control" id="fechaCreacionOA" placeholder="Fecha de creacion OA" required>
                                </div>
                                <div class="form-group">
                                    <label for="palabraClaveOA">Palabras clave</label>
                                    <input type="text" class="form-control" id="palabraClaveOA" placeholder="Palabras clave OA" required>
                                </div>
                                <div class="form-group">
                                    <label for="file1">Adjuntar un archivo</label>
                                    <input type="file" class="form-control" name="file1" id="file1" accept=".zip">
                                </div>
                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-4 offset-4">
                                            <button type="button" class="btn btn-danger btn-block" onclick="javascript:location.href='index.php'">Cancelar</button>
                                        </div>
                                        <div class="col-4">
                                            <button type="button" class="btn btn-success btn-block" onclick="uploadFile()">Subir</button>
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

                if (document.getElementById('nombreOA').value == '' || document.getElementById('descripcion').value ==
                    '' || document.getElementById('autorOA').value == '' ||
                    document.getElementById('institucionOA').value == '' || document.getElementById(
                        'palabraClaveOA').value ==
                    '' || document.getElementById('fechaCreacionOA').value == '') {

                    alert("Error uno o mas campos vacios");

                } else {

                    var file = _("file1").files[0];
                    //alert(file.name+" | "+file.size+" | "+file.type);
                    var formdata = new FormData();
                    formdata.append("file1", file);
                    formdata.append("nombreOA", _("nombreOA").value);
                    formdata.append("descripcion", _("descripcion").value);
                    formdata.append("autorOA", _("autorOA").value);
                    formdata.append("institucionOA", _("institucionOA").value);
                    formdata.append("palabraClaveOA", _("palabraClaveOA").value);
                    formdata.append("fechaCreacionOA", _("fechaCreacionOA").value);
                    var ajax = new XMLHttpRequest();
                    ajax.upload.addEventListener("progress", progressHandler, false);
                    ajax.open("POST", "upload.php");
                    ajax.send(formdata);
                    alert("Objeto de Aprendizaje guardado con exito!");
                    javascript: location.href = 'buscar.php';
                }
            }

            function progressHandler(event) {
                _("loaded_n_total").innerHTML = "Subidos " + event.loaded + " bytes de " + event.total;
            }
        </script>
        <script>
            document.getElementById('file1').addEventListener('change', unzipFile);

            function unzipFile(event) {
                var eTarget = event.target;
                var file = eTarget.files[0];

                JSZip.loadAsync(file) // 1) read the Blob
                    .then(function (zip) {
                        var temp = true;
                        Object.keys(zip.files).forEach(function (filename) {
                            if (filename == "contentv3.xml") {
                                temp = false;
                                zip.files[filename].async('string').then(function (fileData) {
                                    console.log(fileData) // These are your file contents      
                                    parser = new DOMParser();
                                    xmlDoc = parser.parseFromString(fileData, "text/xml");
                                    dublincore = xmlDoc.children[0].children[0];
                                    for (i = 0; i < dublincore.children.length; i++) {
                                        if (dublincore.children[i].className ==
                                            "exe.engine.package.DublinCore") {
                                            dublincore = dublincore.children[i].children[0];
                                            break;
                                        }
                                    }
                                    debugger;
                                    autor = dublincore.children[5].attributes.value.nodeValue;
                                    fecha = dublincore.children[7].attributes.value.nodeValue;
                                    descripcion = dublincore.children[9].attributes.value.nodeValue;
                                    institucion = dublincore.children[17].attributes.value.nodeValue;
                                    palabrasclave = dublincore.children[25].attributes.value
                                        .nodeValue;
                                    titulo = dublincore.children[27].attributes.value.nodeValue;
                                    document.getElementById("nombreOA").value = titulo;
                                    document.getElementById("descripcion").value =
                                        descripcion;
                                    document.getElementById("autorOA").value = autor;
                                    document.getElementById("fechaCreacionOA").value =
                                        fecha;
                                    document.getElementById("palabraClaveOA").value =
                                        palabrasclave;
                                    document.getElementById("institucionOA").value =
                                        institucion;
                                })
                            }
                        })
                        if (temp) {
                            alert("Error el objeto no fue creado con exeLearning");
                        }
                    });
            }
        </script>
    </div>
</body>

</html>