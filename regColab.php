<?php
    function modColab($iduser,$tipo,$fecha,$gen,$cprin,$numcas,$csec,$sec,$ciu,$conv,$cel,$adj,$perfil) {
		$pdo = new PDO('mysql:host=localhost;dbname=sistemaoa;charset=utf8', 'root','');
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "CALL modColab(:idPersona, :userType, :fechana, :genero, :cprin, :numcas, :csec, :sec, :ciu, :conv, :cel, :adj, :perfil )";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':idPersona' => $iduser,
            ':userType' => $tipo,
            ':fechana' => $fecha,
            ':genero' => $gen,
            ':cprin' => $cprin,
            ':numcas' => $numcas,
            ':csec' => $csec,
            ':sec' => $sec,
            ':ciu' => $ciu,
            ':conv' => $conv,
            ':cel' => $cel,
            ':adj' => $adj,
            ':perfil' => $perfil));
    }
    function modColabF($iduser,$tipo,$fecha,$gen,$cprin,$numcas,$csec,$sec,$ciu,$conv,$cel,$perfil) {
		$pdo = new PDO('mysql:host=localhost;dbname=sistemaoa;charset=utf8', 'root','');
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "CALL modColabF(:idPersona, :userType, :fechana, :genero, :cprin, :numcas, :csec, :sec, :ciu, :conv, :cel, :perfil)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':idPersona' => $iduser,
            ':userType' => $tipo,
            ':fechana' => $fecha,
            ':genero' => $gen,
            ':cprin' => $cprin,
            ':numcas' => $numcas,
            ':csec' => $csec,
            ':sec' => $sec,
            ':ciu' => $ciu,
            ':conv' => $conv,
            ':cel' => $cel,
            ':perfil' => $perfil));
    }
?>
