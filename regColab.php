<?php
    function modColab($iduser,$tipo,$fecha,$gen,$cprin,$numcas,$csec,$sec,$ciu,$conv,$cel,$adj) {
		$pdo = new PDO('mysql:host=localhost;dbname=sistemaoa;charset=utf8', 'root','');
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "CALL modColab(:idPersona, :userType, :fechana, :genero, :cprin, :numcas, :csec, :sec, :ciu, :conv, :cel, :adj )";
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
            ':adj' => $adj));
    }
    function modColabF($iduser,$tipo,$fecha,$gen,$cprin,$numcas,$csec,$sec,$ciu,$conv,$cel) {
		$pdo = new PDO('mysql:host=localhost;dbname=sistemaoa;charset=utf8', 'root','');
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "CALL modColabF(:idPersona, :userType, :fechana, :genero, :cprin, :numcas, :csec, :sec, :ciu, :conv, :cel)";
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
            ':cel' => $cel));
    }
?>
