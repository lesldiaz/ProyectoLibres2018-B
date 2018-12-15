
<?php

include('database_connection.php');

session_start();

$message = '';

if(isset($_SESSION['user_id']))
{
	header('location:index.php');
}

if(isset($_POST['login']))
{
	$query = "
		SELECT * FROM login
  		WHERE username = :username
	";
	$statement = $connect->prepare($query);
	$statement->execute(
		array(
			':username' => $_POST["username"]
		)
	);
	$count = $statement->rowCount();
	if($count > 0)
	{
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			if(password_verify($_POST["password"], $row["password"]))
			{
				$_SESSION['user_id'] = $row['user_id'];
				$_SESSION['username'] = $row['usuario'];
				$sub_query = "
				INSERT INTO login_details
	     		(user_id)
	     		VALUES ('".$row['user_id']."')
				";
				$statement = $connect->prepare($sub_query);
				$statement->execute();
				$_SESSION['login_details_id'] = $connect->lastInsertId();
				$_SESSION["success"] = "Logged in.";
				header('location:index.php');
			}
			else
			{
				$message = '<label>Contraseña Incorrecta</label>';
			}
		}
	}
	else
	{
		$message = '<label>Usuario No Registrado</labe>';
	}
}


?>
<html>
    <head>
        <?php require "head.php" ?>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    </head>

    <body style="background-color:#343a40;">
        <?php require "navbar.php" ?>
				<style>
				.fixed-panel {
  			max-width: 500px;
				}
				#modal_form_proceso{
        margin:auto;
        }

    </style>
		<!-- <div class="container">

			<div class="panel panel-default">
  				<div class="panel-heading">Ingreso al Sistema</div>
				<div class="panel-body">
					<p class="text-danger"><?php echo $message; ?></p>
					<form method="post">
						<div class="form-group">
							<label>Usuario</label>
							<input type="text" name="username" class="form-control" required />
						</div>
						<div class="form-group">
							<label>Contraseña</label>
							<input type="password" name="password" class="form-control" required />
						</div>
						<div class="form-group">
							<input type="submit" name="login" class="btn btn-info" value="Ingresar" />
						</div>
					</form>
					<p><b>Ingresa como anónimo con las siguientes credenciales</b></p>
					<p><b>Nombre de Usuario</b> - anonimo<br /><b>Contraseña</b> - anonimo</p>
				</div>
			</div>
		</div>
-->
<div class="container">
	<div class="panel panel-default fixed-panel" style="margin:auto">
			<div class="panel-heading" align="center"><h4>Ingreso al Sistema</h4></div>
		<div class="panel-body ">
			<p class="text-danger"><?php echo $message; ?></p>
			<form method="post">
				<div class="form-group" >
					<label for="inputUser">Usuario</label>
					<input name="username" class="form-control" type="text" placeholder="Ingresar Usuario" required>
				</div>
				<div class="form-group">
					<label for="inputPW">Contraseña</label>
					<input class="form-control"name="password" type="password" placeholder="Ingresar Contraseña" required>
				</div>
				<table class="table">
					<th scope="col"><input name="login" class="btn btn-primary btn-block" type="submit" value="Ingresar"></th>
      		<th scope="col"><a class="btn btn-danger btn-block" href="indexniu.php">Cancelar</a></th>
			</table>

			</form>
			<br />
			<br />
			<p><b>Ingresa como anónimo con las siguientes credenciales</b></p>
			<p><b>Nombre de Usuario</b> - anonimo<br /><b>Contraseña</b> - anonimo</p>
		</div>
	</div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    </body>
</html>
