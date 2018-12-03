<?php
include "db.php";
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
	
	<link rel="stylesheet" type="text/css" href="estilos.css">
	<link href="https://fonts.googleapis.com/css?family=Mukta+Vaani" rel="stylesheet">

	<script type="text/javascript">
		function ajax(){
			var req = new XMLHttpRequest();

			req.onreadystatechange = function(){
				if (req.readyState == 4 && req.status == 200) {
					document.getElementById('chat').innerHTML = req.responseText;
				}
			}

			req.open('GET', 'chat.php', true);
			req.send();
		}

		//linea que hace que se refreseque la pagina cada segundo
		setInterval(function(){ajax();}, 1000);
	</script>
</head>
<body class="fixed-nav sticky-footer bg-dark" id="page-top" onload="ajax();">
	<?php
    require "navbar.php";
	?>
	<div class="content-wrapper bg-light">
    <?php
        #alerts sign in session
        if ( isset($_SESSION["addProf"]) ) {
            echo('<div class="alert alert-success alert-dismissable">');
            echo('<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>');
            echo($_SESSION["addProf"]);
            echo('</div>');
            unset($_SESSION["addProf"]);
        }
        if ( isset($_SESSION["delProf"]) ) {
            echo('<div class="alert alert-danger alert-dismissable">');
            echo('<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>');
            echo($_SESSION["delProf"]);
            echo('</div>');
            unset($_SESSION["delProf"]);
        }
    ?>
	<div id="contenedor">
		<div id="caja-chat">
			<div id="chat"></div>
		</div>

		<form method="POST" action="indexchatAdmin.php">			
			<textarea name="mensaje" align="center" placeholder="Ingresar mensaje"></textarea>
			<input type="submit" name="enviar" value="Publicar">
		</form>

		<?php
			if (isset($_POST['enviar'])) {
				
				$nombre = "Administrador";
				$mensaje = $_POST['mensaje'];


				$consulta = "INSERT INTO chat (nombre, mensaje) VALUES ('$nombre', '$mensaje')";

				$ejecutar = $conexion->query($consulta);

				if ($ejecutar) {
					echo "<embed loop='false' src='beep.mp3' hidden='true' autoplay='true'>";
				}
			}

		?>
	</div>
	<?php
      require "footer.php";
    ?>
	</div>
</body>
</html>