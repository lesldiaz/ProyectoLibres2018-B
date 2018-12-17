<?php
  require_once "pdo.php";
  require_once "delete.php";
  session_start();
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
    <div class="jumbotron">
        <h4 class="display-5 text-center">Foro Estudiantes - Profesores<img src="images/logoEPN.png" width="7%", height="7%"></h4>
    </div>
    <div class="container">

        <?php
		if ($_SESSION['userType'] != "admin"){
		echo '<input type="text" style="display:none" id="idUsuario" value="'.$_SESSION['userID'].'">';
		}
        ?>


      <?php
      $result = $pdo->query("SELECT * FROM foro");
      $iterated=false;
      foreach ($result as $row) {
        $iterated=true;
      }
      if ($iterated){ ?>
      <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Buscar Tema..." title="Ingrese el Tema de Discusion a Buscar">
      <table id="myTable">
        <tr class="header">
          <th style="width:20%;">Tema</th>
          <th style="width:20%;">Empezado por</th>
          <th style="width:20%;">Fecha de Apertura</th>
          <th style="width:20%;">Opciones</th>
        </tr>
    <?php
          $result = $pdo->query("SELECT * FROM foro");
          $iterated=false;
          foreach ($result as $row) {
            $id = $row['idForo'];
            $iterated=true;
            $userID = false;
            $name = $row['asunto'];
            if ($_SESSION["userName"] == $row['autor']) {
              $userID = true;
            }
		        echo '<tr>';
            echo '<td>' . $row['asunto'] . '</td>';
            echo '<td>' . $row['autor'] . '</td>';
            echo '<td>' . date("d-m-Y",strtotime($row['fechaapertura'])) . '</td>';
            echo '<td> <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal' . $id . '">Visualizar</button> </td>';
            echo '</tr>';
            echo '<div id="myModal' . $id . '" class="modal fade" role="dialog">';
              echo '<div class="modal-dialog">';
                echo '<div class="modal-content">';
                  echo '<div class="modal-header">';
                    echo '<h4 class="modal-title">'.$name.'</h4>';
                    echo '<button type="button" class="close" data-dismiss="modal">&times;</button>';
                    echo '</div>';
                    echo '<div class="modal-body">';
                    echo '<h6><b>Descripción: </b></h6>';
                    echo '<p align="justify">'.$row["descripcion"].'</p>';
                    echo '<p align="justify"> Tema iniciado por <b>'.$row["autor"].'</b> el <b>'.$row["fechaapertura"].'</b> </p>';
                    echo '<p><b>Archivo Adjunto:</b> <a href="foroimg/'.$row["nombreadjunto"].'" target="_blank" class="tooltip-test" title="Tooltip">'.$row["nombreadjunto"].'</a></p>';
                    echo '<hr>';
                    echo '<div class="row bottom10">';
                    echo '<div class="col-3">';
                    echo '<b>Respuestas:</b>';
                    echo '</div>';
                    echo '<div class="comments">';
                    echo '<ul class="list-group">';
                    //Comentario -Respuestas
                    echo '<p> Hola Comente</p>';
                    echo '</ul>';
                    echo '</div>';
                    echo '</div>';
                    //Comentario
                    echo '</div>';
                    echo '<div class="modal-footer">';
                    echo '<form action="nuevaRes.php" method="post">
                          <input type="hidden" name="idForoR" value="'.$row["idForo"].'"/>
                          <input type="hidden" name="asuntoForoR" value="'.$row["asunto"].'"/>';
                    echo '<input class="btn btn-primary" type="submit" value="Agregar Respuesta" onclick="ir()">';
                    echo '</form>';
                    echo '<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>';
                  echo '</div>';
                echo '</div>';

              echo '</div>';
            echo '</div>';
        } ?>
      </table>
    <?php }else {
      echo '<div class="row bottom5 top5">';
      echo '<div class="col-10 offset-1">';
      echo '<div class="card-block">';
      echo '<h5 class="card-title" align="center"><strong>No existen temas nuevos </strong></h5>';
      echo '</div>';
      echo '</div>';
      echo '</div>';
     } ?>
    </div>

    <?php
      require "footer.php";
    ?>


    <script>
      function myFunction() {
        var input, filter, table, tr, tn, ta, i;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
          tn = tr[i].getElementsByTagName("td")[0];
          ta = tr[i].getElementsByTagName("td")[1];
          if (tn || ta) {
            if (tn.innerHTML.toUpperCase().indexOf(filter) > -1) {
              tr[i].style.display = "";
            } else if (ta.innerHTML.toUpperCase().indexOf(filter) > -1) {
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
      function ir(){
        window.location="nuevaRes.php";
      }

      function showHide(div) {
        var x = document.getElementById(div);
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
      }

    </script>
  </div>
</body>

</html>
