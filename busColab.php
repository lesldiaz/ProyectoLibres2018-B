<?php
  require_once "pdo.php";
  require_once "fechaCastellano.php";
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

    #myInputc {
        background-image: url('images/searchicon.png');
        background-position: 10px 10px;
        background-repeat: no-repeat;
        width: 100%;
        font-size: 16px;
        padding: 12px 20px 12px 40px;
        border: 1px solid #ddd;
        margin-bottom: 12px;
    }
    #myInputn {
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
        <h4 class="display-5 text-center">Colaboradores<img src="images/logoEPN.png" width="7%", height="7%"></h4>
    </div>
    <div class="container">
      <?php
      $result = $pdo->query("SELECT * FROM colaborador");
		    $iterated=false;
		      foreach ($result as $row) {
			         $iterated=true;
		           }
      if ($iterated){ ?>
        <label for="segun">Buscar por:</label>
        <select id="segun" class="form-control form-group">
          <option value="otro" disabled selected >Seleccione una opción</option>
          <option value="nombre" onClick="hola()" >Nombre</option>
          <option value="cedula" onClick="hola()">Cédula</option>
        </select>
      <input type="hidden" id="myInputc" onkeyup="cedula()" placeholder="Buscar...">
      <input type="hidden" id="myInputn" onkeyup="nombre()" placeholder="Buscar...">
      <table id="myTable">
        <tr class="header">
          <th style="width:20%; display:none;">Cédula</th>
          <th style="width:20%;">Colaborador</th>
          <th style="width:20%;">Total Aportes</th>
		  <!--<th style="width:20%;">Último Aporte</th>-->
          <th style="width:20%;">Opciones</th>
        </tr>
    <?php
          $result = $pdo->query("SELECT * FROM colaborador");
          foreach ($result as $row) {
            $id = $row['idColaborador'];

            $userID = false;
            if ($_SESSION["userType"] == $row['userType'] && $_SESSION["userID"]==$row["idPersona"]) {
					         $userID = true;
            }
            echo '<tr>';
            $sql="CALL buscarColaborador(:id)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(':id' => $id));
            foreach ($stmt as $val) {
              echo '<td style="display:none;">'.$val["cedula"].'</td>';
              echo '<td><img src="fotoperfil/'.$val["adjFoto"].'" width="16%", height="16%">   '.$val["nombres"].' '.$val["apellidos"].'</td>';
            }
            $sql="CALL aportesColab(:id)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(':id' => $id));
            $cuenta = $stmt->rowCount();
            echo '<td>'.$cuenta.'</td>';
            echo '<td>
            <a class="btn btn-primary" href="verObjetosColab.php?idC='.$row['idPersona'].'">Visualizar Aportes</a>
            </td>';
            echo '</tr>';
        } ?>
      </table>
    <?php }else {
      echo '<div class="row bottom5 top5">';
      echo '<div class="col-10 offset-1">';
      echo '<div class="card-block">';
      echo '<h5 class="card-title" align="center"><strong>No existen colaboradores</strong></h5>';
      echo '</div>';
      echo '</div>';
      echo '</div>';
     } ?>
    </div>

    <?php
      require "footer.php";
    ?>


    <script>
    var sele= document.getElementById("segun");
		sele.addEventListener('change',
		function hola(){
		var opcion = this.options[sele.selectedIndex];
		if(opcion.value == "cedula"){
      document.getElementById("myInputc").type = "text";
      document.getElementById("myInputn").type = "hidden";
		} else if (opcion.value == "nombre"){
      document.getElementById("myInputc").type = "hidden";
      document.getElementById("myInputn").type = "text";
	   }
  });


      function cedula() {
        var input, filter, table, tr, tn, ta, i;
        input = document.getElementById("myInputc");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
          tn = tr[i].getElementsByTagName("td")[0];
          if (tn) {
            if (tn.innerHTML.toUpperCase().indexOf(filter) > -1) {
              tr[i].style.display = "";

            } else {
              tr[i].style.display = "none";
            }
          }
        }
      }

      function nombre() {
        var input, filter, table, tr, tn, ta, i;
        input = document.getElementById("myInputn");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
          ta = tr[i].getElementsByTagName("td")[1];
          if (ta) {
            if (ta.innerHTML.toUpperCase().indexOf(filter) > -1) {
              tr[i].style.display = "";
            } else {
              tr[i].style.display = "none";
            }
          }
        }
      }
      function numeros(e){
          key = e.keyCode || e.which;
          tecla = String.fromCharCode(key).toLowerCase();
          letras = " 0123456789";
          especiales = [8,45];

          tecla_especial = false
          for(var i in especiales){
       if(key == especiales[i]){
           tecla_especial = true;
           break;
              }
          }

          if(letras.indexOf(tecla)==-1 && !tecla_especial)
              return false;
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
