<?php
  require_once "pdo.php";
  require_once "delete.php";
  require "fechaCastellano.php";
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
    <div class="container">
		<div class="panel panel-default">
		<?php
		$sql="SELECT * FROM foro WHERE idForo = :idForo";
		$stmt = $pdo->prepare($sql);
		$stmt->execute(array(':idForo' => $_GET["foroID"]));
		foreach ($stmt as $row) {
				$fecha = fechaCastellano($row["fechaapertura"]);
				$hora= date("H:i:s",strtotime($row["fechaapertura"]));
				echo '<div class="panel-heading"> <hr> <h2>'.$row["asunto"].'</h2> 
					de '.$row["autor"].' - '.$fecha.', '.$hora.'</div>
					</br> 
					<div class="panel-body">
					<ul>
					<li style="list-style:none;"><p align="justify">'.$row["descripcion"].'</p></li>';
					if($row["nombreadjunto"]){
					echo '<li style="list-style:none;"><p><b>Archivo Adjunto:</b> <a href="foroimg/'.$row["nombreadjunto"].'" target="_blank">'.$row["nombreadjunto"].'</a></p></li>';
					}
					echo '<table border=0>
  
					<tr>
					<th style="width:30%;"></th>
					<th style="width:30%;"></th>
					<th style="width:30%;"></th>
					<form action="nuevaRes.php" method="post">
                          <input type="hidden" name="idForoR" value="'.$row["idForo"].'"/>
                          <input type="hidden" name="asuntoForoR" value="'.$row["asunto"].'"/>
                    <th style="width:10%;"><input class="btn btn-primary" type="submit" value="Responder" onclick="ir()"></th>
                    </form>
					</tr>
					</table> 
					';
					
					$sql="SELECT * FROM resforo WHERE idForo = :idForo";
					$si=false;
					$stmt = $pdo->prepare($sql);
					$stmt->execute(array(':idForo' => $_GET["foroID"]));
					foreach ($stmt as $lol) {
						$si=true;
					}
					if ($si){
						$sql="SELECT * FROM resforo WHERE idForo = :idForo";
						$stmt = $pdo->prepare($sql);
						$stmt->execute(array(':idForo' => $_GET["foroID"]));
						foreach ($stmt as $row1) {
						$fecha1 = fechaCastellano($row1["fechaapertura"]);
						$hora1= date("H:i:s",strtotime($row1["fechaapertura"]));
						echo '<ul>';
						echo '<hr>';
							echo '<h2>'.$row1["asunto"].'</h2>
							de '.$row1["autor"].' - '.$fecha1.', '.$hora1.' </br>';
							echo '<br>';
							echo '<li style="list-style:none;"><p align="justify">'.$row1["descripcion"].'</p></li>';
							if($row1["nombreadjunto"]){
							echo '<li style="list-style:none;"><p><b>Archivo Adjunto:</b> <a href="foroimg/'.$row["nombreadjunto"].'" target="_blank">'.$row["nombreadjunto"].'</a></p></li>';
							}
							if ($row1["autor"]==$_SESSION["userName"] && $row1["userType"]==$_SESSION["userType"]){
							echo '<li style="list-style:none;">
							<table border="0">
							<tr>
							<th style="width:30%;"></th>
							<th style="width:30%;"></th>
							<th style="width:30%;"></th>
							<th style="width:20%;"><button type="button" class="btn btn-info">Editar</button> </th>
							<th style="width:20%;"><button type="button" class="btn btn-danger">Borrar</button> </th>
							</tr>
							</li></table>';
							}
						echo '<hr></ul>';
						} 
					}else {
						echo '<h4 align="center"> Aun no existen respuestas. </h4>';
					}
					echo '</ul>
					</div>
					';
				} 
				?>
			
		
		</div>
    </div>

    <?php
      require "footer.php";
    ?>

  </div>
</body>
</html>
<script>
	function ir(){
        window.location="nuevaRes.php";
      }
</script>
