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
    $sql = "INSERT INTO comentario (detalleComent, idOA, idProfesor, pathImagen, fechaComentario)
            VALUES (:detalleComent, :idOA, :idProfesor, :rutaArchivo, :fechaComentario)";
    $stmt = $pdo->prepare($sql);
      $fecha=date("d") . "/" . date("m") . "/" . date("Y");
    $stmt->execute(array(
      ':detalleComent' => $_POST["comment"],
      ':idOA' => $_POST["idOAComment"],
      ':idProfesor' => $_SESSION["userID"],
        ':rutaArchivo' => $destino,
        ':fechaComentario' => $fecha));
    $_SESSION["oa"] = "Comentario agregado correctamente.";
    unset($_POST["idOAComment"]);
    unset($_POST["comment"]);
    header( 'Location: buscar.php' );
    return;
  }
  if ( isset($_POST["idOADelete"]) && isset($_POST["idOARuta"]) ) {
    deleteOA($_POST["idOARuta"], $_POST["idOADelete"]);
    $_SESSION["oa"] = "Objeto de Aprendizaje eliminado del sistema correctamente.";
    unset($_POST["idOADelete"]);
    unset($_POST["idOARuta"]);
    header( 'Location: buscar.php' );
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
	<h1>Estadistica de Objetos de aprendizaje</h1>
    <div class="container">
      <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Buscar OA..." title="Ingrese un OA">
      <table id="myTable">
        <tr class="header">
          <th style="width:25%;">Nombre</th>
          <th style="width:10%;">Autor</th>
          <th style="width:20%;">Descargas</th>
          <th style="width:5%;"></th>
        </tr>
		<div id="graficaLineal" style="width: 100%; height: 500px; margin: 0 auto">
</div>
        <?php
          $result = $pdo->query("SELECT * FROM objetoaprendizaje oa JOIN profesor p ON oa.idProfesor = p.idProfesor");
          foreach ($result as $row) {
            $id = $row['idOA'];
            $userID = false;
            if (($_SESSION["userID"] == $row['idProfesor'] && $_SESSION["userType"] != "est") || $_SESSION["userType"] == "admin") {
              $userID = true;
            }
            echo '<tr>';
            echo '<td>' . $row['autor'] . '</td>';
            echo '<td>' . $row['p_clave'] . '</td>';
           echo '<td>' . $row['descargas'] .'</td>';
		   echo '<td><button onclick="graficar();"> Graficar</button></td>';
		   echo '</tr>';
          }
        ?>
      </table>
    </div>

    <?php
      require "footer.php";
    ?>

    <script type="text/javascript" src="js/highcharts.js"></script>
	<script type="text/javascript" src="/vendor/jquery/jquery.js"></script>
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
	  
	  function graficar(){
		var chart;
		chart = new Highcharts.Chart({
			chart: {
				renderTo: 'graficaCircular'
			},
			title: {
				text: 'Porcentaje de Visitas por Paises'
			},
			subtitle: {
				text: 'Jarroba.com'
			},
			plotArea: {
				shadow: null,
				borderWidth: null,
				backgroundColor: null
			},
			tooltip: {
				formatter: function() {
					return '<b>'+ this.point.name +'</b>: '+ this.y +' %';
				}
			},
			plotOptions: {
				pie: {
					allowPointSelect: true,
					cursor: 'pointer',
					dataLabels: {
						enabled: true,
						color: '#000000',
						connectorColor: '#000000',
						formatter: function() {
							return '<b>'+ this.point.name +'</b>: '+ this.y +' %';
						}
					}
				}
			},
		    series: [{
				type: 'pie',
				name: 'Browser share',
				data: [
						['España',35.38],
						['México',21.0],
						['Colombia',9.45],
						['Perú',5.74],
						['Argentina',5.14],
						['Chile',4.89],
						['Venezuela',3.04],
						['Ecuador',2.53],
						['Bolivia',1.66],
						['Rep. Dominicana',1.12],
						['Guatemala',1.08],
						['Costa Rica',1.07],
						['Estados Unidos',1.03],
						['+81 paises',6.87]
					]
			}]
		});
	  };
	  	
    </script>
  </div>
</body>

</html>

<script type="text/javascript" src="/vendor/jquery/jquery.js"></script>
<script>
    $("#btn").click(function(){
        var archivos = document.getElementById("file").files;
        alert(archivos.name);
    });
</script>