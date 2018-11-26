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
    <div class="container">
        <div class="jumbotron">
            <h2 class="display-5 text-center">Herramientas Adicionales</h2>
        </div>
    </div>
    <div class="row bottom5">
        <div class="col-10 offset-1">
            <div class="card">
                <h5 class="card-header bg-dark text-white">Mapas Conceptuales</h5>
                <div class="card-body">
                    <div class="card-block">
                        <h5 class="card-title"><strong><a href="https://cmap.ihmc.us/cmaptools/" target="_blank">CmapTools</a></strong></h5>
                        <div class="row top5">
                            <div class="col-3 text-center">
                                <a href="https://cmap.ihmc.us/cmaptools/" target="_blank">
                                    <img src="images/cmap.jpg" style="width:110px;height:110px;">
                                </a>
                            </div>
                            <div class="col text-justify padding15">
                                El software de CmapTools permite a los usuarios construir, navegar, compartir y criticar modelos de conocimiento representados como mapas conceptuales. Permite a los usuarios, entre muchas otras características, construir sus mapas en su ordenador personal, compartirlos en servidores (CmapServers) en cualquier lugar de Internet.
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="card-block">
                        <h5 class="card-title"><strong><a href="https://bubbl.us/" target="_blank">Bubbl.us</a></strong></h5>
                        <div class="row top5">
                            <div class="col-3 text-center">
                                <a href="https://bubbl.us/" target="_blank">
                                    <img src="images/bubbl.png" style="width:110px;height:110px;">
                                </a>
                            </div>
                            <div class="col text-justify padding15">
                            Esta herramienta en línea gratuita y fácil que permite intercambiar ideas, guardar su mapa mental como una imagen, compartir con los estudiantes, y crear coloridos organizadores mapa mental.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row bottom5">
        <div class="col-10 offset-1">
            <div class="card">
                <h5 class="card-header bg-dark text-white">Presentaciones</h5>
                <div class="card-body">
                    <div class="card-block">
                        <h5 class="card-title"><strong><a href="https://www.clearslide.com/product/sliderocket/" target="_blank">SlideRocket</a></strong></h5>
                        <div class="row top5">
                            <div class="col-3 text-center">
                                <a href="https://www.clearslide.com/product/sliderocket/" target="_blank">
                                    <img src="images/slide.jpg" style="width:110px;height:110px;">
                                </a>
                            </div>
                            <div class="col text-justify padding15">
                                Crear un estilo de aspecto de PowerPoint para presentaciones multimedia, impresionantes que se pueden ver y compartir en línea. Una gran manera de introducir temas en el aula.
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="card-block">
                        <h5 class="card-title"><strong><a href="https://prezi.com/" target="_blank">Prezi</a></strong></h5>
                        <div class="row top5">
                            <div class="col-3 text-center">
                                <a href="https://prezi.com/" target="_blank">
                                    <img src="images/prezi.jpg" style="width:110px;height:110px;">
                                </a>
                            </div>
                            <div class="col text-justify padding15">
                                Es un programa de presentaciones para explorar y compartir ideas sobre un documento virtual basado en la informática en nube.​ La aplicación se distingue por su interfaz gráfica con zoom, que permite a los usuarios disponer de una visión más acercada o alejada de la zona de presentación, en un espacio 2.5D.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row bottom5">
        <div class="col-10 offset-1">
            <div class="card">
                <h5 class="card-header bg-dark text-white">Editores de Video</h5>
                <div class="card-body">
                    <div class="card-block">
                        <h5 class="card-title"><strong><a href="https://animoto.com/" target="_blank">Animoto</a></strong></h5>
                        <div class="row top5">
                            <div class="col-3 text-center">
                                <a href="https://animoto.com/" target="_blank">
                                    <img src="images/animoto.png" style="width:110px;height:110px;">
                                </a>
                            </div>
                            <div class="col text-justify padding15">
                            Los docentes y sus estudiantes pueden subir imágenes y sonidos y crear vídeos profesionales que buscan que puede ser descargado y compartido en línea. Promover el entusiasmo para tareas menos interesantes como extendida práctica de la escritura y pronunciación oral.
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="card-block">
                        <h5 class="card-title"><strong><a href="https://clipchamp.com/en" target="_blank">ClipChamp</a></strong></h5>
                        <div class="row top5">
                            <div class="col-3 text-center">
                                <a href="https://clipchamp.com/en" target="_blank">
                                    <img src="images/clip.jpg" style="width:110px;height:110px;">
                                </a>
                            </div>
                            <div class="col text-justify padding15">
                            Conversor de vídeo todo en uno, compresor de vídeo, grabador de vídeo con cámara web, editor de vídeo y solución de carga de vídeo. Sube vídeos a YouTube, Vimeo o Facebook hasta 20 veces más rápido. Guardar vídeos en el equipo o en la unidad de disco de Google.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row bottom5">
        <div class="col-10 offset-1">
            <div class="card">
                <h5 class="card-header bg-dark text-white">Editores Graficos</h5>
                <div class="card-body">
                    <div class="card-block">
                        <h5 class="card-title"><strong><a href="https://www.gimp.org/" target="_blank">GIMP</a></strong></h5>
                        <div class="row top5">
                            <div class="col-3 text-center">
                                <a href="https://www.gimp.org/" target="_blank">
                                    <img src="images/gimp.png" style="width:150px;height:110px;">
                                </a>
                            </div>
                            <div class="col text-justify padding15">
                            GIMP es un editor de imágenes multiplataforma disponible para GNU/Linux, OS X, Windows y más sistemas operativos. Es software libre, puedes cambiar su código fuente y distribuir tus cambios.
                            </div>
                        </div>
                    </div>
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
