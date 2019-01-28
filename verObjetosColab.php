<?php
  require_once "pdo.php";
  require_once "delete.php";
  session_start();
if ( isset($_POST["idOAComment"]) && isset($_POST["comment"]) ) {
      $nombre = $_FILES['imagen']['name'];
      $nombrer = strtolower($nombre);
      //$cd=$_FILES['imagen']['tmp_name'];
      $ruta = "img/" . $_FILES['imagen']['name'];
      $destino = "img/".$nombrer;
      $resultado = @move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta);
    $sql = "CALL insertarComentario (:detalleComent, :idOA, :idAutor, :userNameAutor, :rutaArchivo, :fechaComentario, :rutaVideo)";
    $stmt = $pdo->prepare($sql);
      $fecha=date("d") . "/" . date("m") . "/" . date("Y");
    $stmt->execute(array(
      ':detalleComent' => $_POST["comment"],
      ':idOA' => $_POST["idOAComment"],
      ':idAutor' => $_SESSION["userID"],
	  ':userNameAutor' => $_SESSION["userName"],
        ':rutaArchivo' => $destino,
        ':fechaComentario' => $fecha,
        ':rutaVideo'=> $_POST["videoYoutube"]));
    $_SESSION["oa"] = "Comentario agregado correctamente.";
    unset($_POST["idOAComment"]);
    unset($_POST["comment"]);
    $loc="Location: verObjetosColab.php?idC=";
    $loc.=$_GET["idC"];
    header($loc);
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
    * {
        box-sizing: border-box;
    }

    #myInput {
        background-image: url('images/searchicon.png');
        background-position: 10px 10px;
        background-repeat: no-repeat;
        width: 100%;
        font-size: 16px;
        padding: 12px 20px 12px 40px;
        border: 1px solid #ddd;
        margin-bottom: 12px;
    }

    #myTable {
        border-collapse: collapse;
        width: 100%;
        border: 1px solid #ddd;
        font-size: 18px;
    }

    #myTable th,
    #myTable td {
        text-align: left;
        padding: 12px;
    }

    #myTable tr {
        border-bottom: 1px solid #ddd;
    }

    #myTable tr.header,
    #myTable tr:hover {
        background-color: #f1f1f1;
    }

    .modalmy {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        padding-top: 100px;
        padding-left: 250px;
        /* Location of the box */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4);
        /* Black w/ opacity */
    }
    /* Modal Content */

    .modalmy-content {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-direction: column;
            flex-direction: column;
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        border-radius: 0.3rem;
        background-clip: padding-box;
        outline: 0;
    }

    .arrow {
        box-sizing: border-box;
        height: 1vw;
        width: 1vw;
        border-style: solid;
        border-color: black;
        border-width: 0px 1px 1px 0px;
        transform: rotate(45deg);
        transition: border-width 150ms ease-in-out;
    }

    .arrow:hover {
        border-bottom-width: 4px;
        border-right-width: 4px;
    }

    .top5 {
      margin-top:15px;
    }

    .bottom5 {
      margin-bottom:20px;
    }

    .bottom10 {
      margin-bottom:10px;
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
      if ( isset($_SESSION["oa"]) ) {
        echo('<div class="alert alert-success alert-dismissable">');
        echo('<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>');
        echo($_SESSION["oa"]);
        echo('</div>');
        unset($_SESSION["oa"]);
      }
    ?>
    <div class="container">
      <div class="jumbotron">
          <h4 class="display-5 text-center">Aportes del Colaborador<img src="images/logoEPN.png" width="5%", height="5%"></h4>
      </div>

      <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Buscar OA..." title="Ingrese un OA">


      <table id="myTable">
        <tr class="header">
          <th style="width:20%;">Nombre OA</th>
          <th style="width:20%;">Fecha de Publicación</th>
          <th style="width:20%;">Palabras Clave</th>
            <th style="width:20%;">Visualizar</th>
        </tr>


          <?php

		  $sql1 = "SELECT * FROM objetoaprendizaje WHERE idAutor = :idAutor";
		  $stmt1 = $pdo->prepare($sql1);
		  $stmt1->execute(array(':idAutor' => $_GET["idC"]));
          foreach ($stmt1 as $row1) {
            $id = $row1['idOA'];
            echo '<tr>';
            echo '<td>' . $row1['nombre'] . '</td>';
            echo '<td>' . date("d-m-Y",strtotime($row1['fecha'])) . '</td>';
            echo '<td>' . $row1['p_clave'] . '</td>';
            echo '<td> <div onclick="openModal(' . "'myModal" . $id . "'" . ')" class="arrow"></div> </td>';
            echo '</tr>';
            echo '<div id="myModal' . $id . '" class="modalmy">';
            echo '<div class="modalmy-content">';
            echo '<div class="modal-header">';
            echo '<h4 class="modal-title">' . $row1['nombre'] . '</h4>';
            echo '<button type="button" class="close" onclick="getElementById(' . "'myModal" . $id . "'" . ').style.display =' . "'none'" . ';">&times;</button>';
            echo '</div>';

            echo '<div class="container">';
            echo '<div class="row top5">';
            echo '<div class="col-3">';
            echo '<b>Informacion:</b>';
            echo '</div>';
            echo '<div class="col-1 offset-8">';
            echo '<div onclick="showHide(' . "'myDiv" . $id . "'" . ')" class="arrow"></div>';
            echo '</div>';
            echo '</div>';
            echo '<input type="text" style="display:none" id="ObjA' .$row1['idOA'].'" value="' .$row1['idOA'].'">';
            echo '<div id="myDiv' . $id . '">';
            echo '<div class="row top5">';
            echo '<div class="col-3 text-right padding5">';
            echo '<b>Descripcion:</b>';
            echo '</div>';
            echo '<div class="col text-justify padding15">';
            echo $row1['descripcion'];
            echo '</div>';
            echo '</div>';
            echo '<div class="row top5">';
            echo '<div class="col-3 text-right padding5">';
            echo '<b>Institucion:</b>';
            echo '</div>';
            echo '<div class="col text-justify padding15">';
            echo $row1['institucion'];
            echo '</div>';
            echo '</div>';
            echo '<div class="row top5">';
            echo '<div class="col-3 text-right padding5">';
            echo '<b>Fecha de Creacion:</b>';
            echo '</div>';
            echo '<div class="col text-justify padding15">';
            echo $row1['fecha'];
            echo '</div>';
            echo '</div>';
            echo '<div class="row top5">';
            echo '<div class="col-3 text-right padding5">';
            echo '<b>Palabras Clave:</b>';
            echo '</div>';
            echo '<div class="col text-justify padding15">';
            echo $row1['p_clave'];
            echo '</div>';
            echo '</div>';
            echo '<div class="row top5">';
            echo '<div class="col-3 text-right padding5">';
            echo '<b>Tamaño:</b>';
            echo '</div>';
            echo '<div class="col text-justify padding15">';
            echo $row1['tamano'];
            echo '</div>';
            echo '</div>';
            echo '<div class="row top5">';
            echo '<div class="col-3 text-right padding5">';
            echo '<b>Tipo:</b>';
            echo '</div>';
            echo '<div class="col text-justify padding15">';
            echo $row1['tipo'];
            echo '</div>';
            echo '</div>';
            echo '<div class="row top5 bottom5">';
            echo '<div class="col-3 text-right padding5">';
            echo '<b>Fecha Ingreso:</b>';
            echo '</div>';
            echo '<div class="col text-justify padding15">';
            echo $row1['fecha_ing'];
            echo '</div>';
            echo '</div>';
              echo '<div class="row top5 bottom5">';
              echo '<div class="col-3 text-right padding5">';
              echo '<b>Visualización:</b>';
              echo '</div>';
              echo '<div class="col text-justify padding15">';
              $ruta=$row1['ruta_zip'];
              //echo '<div>'.$ruta.'</div>';
              $zip = new ZipArchive;
              //en la función open se le pasa la ruta de nuestro archivo (alojada en carpeta temporal)
              if ($zip->open($ruta) === TRUE)
              {
                  $zip->extractTo('almacen/');
                  $zip->close();
              }
              echo '<a href="almacen/index.html" target="_blank">Visualización</a>';
              echo '</div>';
              echo '</div>';
            echo '</div>';

            echo '<hr><div class="row bottom10">';
            echo '<div class="col-3">';
            echo '<b>Comentarios:</b>';
            echo '</div>';
            echo '</div>';
            echo '<div class="comments">';
            echo '<ul class="list-group">';
            $sql = 'CALL cargarComentarios(:idOA)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(':idOA' => $id));

            foreach ($stmt as $comment) {
              echo '<li class="list-group-item">';
              echo '<strong>' . $comment['userNameAutor'] . ' '.$comment['fechaComentario'].'</strong>&emsp;&emsp;&emsp;&emsp;';
              echo $comment['detalleComent'];
			             if( $comment['pathImagen'] == "img/"){}else {
				                 echo '<div><img src="'.$comment['pathImagen'].'" style="width: 50%; height: 80%">';
			             }
			             if ($comment['pathVideo']== ""){ }else {
					                echo '<div>'.$comment['pathVideo'].'</div>';
			             }
              echo '</li>';
            }

            echo '</ul>';
            echo '</div>';
			 echo '<form method="post" class="top5" enctype="multipart/form-data">';
              echo '<div class="form-group">';
              echo '<textarea name="comment" placeholder="Ingrese un comentario." class="form-control"></textarea>';
              echo '<input id="imagen" name="imagen" type="file" maxlength="150">';
              echo '<input class="form-control" placeholder="Ingrese link video" id="videoYoutube" name="videoYoutube" type="text">';
              echo '<br />';
              echo '<div id="preview"></div>';
              echo '</div>';
              echo '<div class="form-group">';
              echo '<div class="form-row">';
              echo '<div class="col-6 offset-6">';
              echo '<input type="hidden" name="idOAComment" value="' . $id . '">';
              echo '<input class="btn btn-info btn-block" type="submit" value="Agregar Comentario">';
              echo '</div>';
              echo '</div>';
              echo '</div>';
              echo '</form><hr>';
            echo '<div class="form-group">';
            echo '<div class="form-row">';
            echo '<div class="col-3 offset-6">';
            echo '</div>';
            echo '<div class="col-3">';
            echo '<a class="btn btn-primary btn-block" id="Descargar'.$row1['idOA'].'" href="'. $row1['ruta_zip'] . '" download>Descargar</a>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
          }
        ?>
      </table><hr>
      <a class="btn btn-secondary" href="busColab.php"> Regresar </a>
    </div>

    <?php
      require "footer.php";
    ?>


    <script>
      function myFunction() {
        var input, filter, table, tr, tn, ta, tan, tc, i;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
          tn = tr[i].getElementsByTagName("td")[0];
          ta = tr[i].getElementsByTagName("td")[1];
          tan = tr[i].getElementsByTagName("td")[2];
          tc = tr[i].getElementsByTagName("td")[3];
          if (tn || ta || tan || tc) {
            if (tn.innerHTML.toUpperCase().indexOf(filter) > -1) {
              tr[i].style.display = "";
            } else if (ta.innerHTML.toUpperCase().indexOf(filter) > -1) {
              tr[i].style.display = "";
            } else if (tan.innerHTML.toUpperCase().indexOf(filter) > -1) {
              tr[i].style.display = "";
            } else if (tc.innerHTML.toUpperCase().indexOf(filter) > -1) {
              tr[i].style.display = "";
            } else {
              tr[i].style.display = "none";
            }
          }
        }
      }

      function openModal(modale) {
        var modal = document.getElementById(modale);
        modal.style.display = "block";

        window.onclick = function (event) {
          if (event.target == modal) {
            modal.style.display = "none";
          }
        }
      }

      function showHide(div) {
        var x = document.getElementById(div);
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
      }

      function unzip(zip_path, id, name) {
        var formdata = new FormData();
        formdata.append("zip_path", zip_path);
        formdata.append("id", id);
        var ajax = new XMLHttpRequest();
        ajax.open("POST", "unzip.php");
        ajax.send(formdata);
        alert("Objeto de Aprendizaje descomprimido con exito!");
        javascript:location.href='buscar.php';
      }


    </script>
  </div>
</body>

</html>
<script src="vendor/jquery/jquery.js"></script>
<script src="vendor/jquery/jquery.min.js"></script>
<script>
	$(document).ready(function(){
                $.ajax({
                    method: "GET",
                    url: "mat.php",
                }).done(function( data ) {
                        var result = $.parseJSON(data);
                        $.each( result, function( key, value ) {
                            $("#cbxMaterias").append("<option>"+value['nombreMateria']+"</option>");

                        });
                });
            });
var puntuacion;
    $('[type*="radio"]').change(function () {
        var me = $(this);
        //alert(me.attr('value'));
        puntuacion=me.attr('value');
    });
$('[id*="btnCalificar"]').click(function () {
    var me = $(this);
    var strId=me.attr('id');
    var numeroId=strId.substring(12);
    var id=$("#idUsuario").val();
    $.ajax({
        method: "POST",
        url: "puntuacion.php",
        data: {"idObjetoAprendizaje": numeroId, "puntuacion": puntuacion, "idUsuario": id},
    }).done(function( data ) {
        var result = $.parseJSON(data);
        $.each( result, function( key, value ) {
            alert(value['mensaje']);
        });
    });
});
$('[id*="Descargar"]').click(function () {
        var me = $(this);
        var strId = me.attr('id');
        var numeroId = strId.substring(9);
        $.ajax({
            method: "POST",
            url: "cargarObjetos.php",
            data: {"idDescargas": numeroId},
        }).done(function( data ) {
            var result = $.parseJSON(data);
            $.each( result, function( key, value ) {
                alert(value['mensaje']);
            });
        });

    });






   /* $("#btnCalificar3").click(function(){
        var id=$("#idUsuario").val()
        var objeto=$("#ObjA3").val();
        $.ajax({
            method: "POST",
            url: "puntuacion.php",
            data: {"idObjetoAprendizaje": id, "puntuacion": puntuacion, "idUsuario": objeto},
        }).done(function( data ) {
            var result = $.parseJSON(data);
            $.each( result, function( key, value ) {
                alert(value['mensaje']);
            });
        });

    });*/

</script>
