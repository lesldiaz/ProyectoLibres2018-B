<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
	<div id='cssmenu'>
		<ul>
			<li class='active'><a href='#'>Sistema de Gestión de Objetos de Aprendizaje - Chat de Soporte</a></li>
			<?php if ( !isset($_SESSION["user_id"]) ) { ?>
				<li><a align="right" href='login.php'>Iniciar Sesion</a></li>
				<li><a align="right" href='../index.php'>Regresar a SIGOA</a></li>
			<?php } else { ?>
			<li><a align="right" href='#'>
			Hola, <?php echo $_SESSION["username"];?>
			</a></li>
			<li><a align="right" href='logout.php'>Cerrar Sesion</a></li>
			<?php } ?>
		</ul>
	</div>		
</nav>