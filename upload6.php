<?php
    require_once "pdo.php";
    include_once "regColab.php";
    session_start();
    $ejemplo='fotoperfil/';
    $nombrearchivo = $_FILES["file1"]["name"];
    $fileName = $ejemplo.$_FILES["file1"]["name"]; // The file name
    $fileTmpLoc = $_FILES["file1"]["tmp_name"]; // File in the PHP tmp folder
    $fileType = $_FILES["file1"]["type"]; // The type of file it is
    $fileSize = $_FILES["file1"]["size"]; // File size in bytes
    $fileErrorMsg = $_FILES["file1"]["error"]; // 0 for false... and 1 for true
    if (!$fileTmpLoc) { // if file not chosen
        modColabF($_SESSION["userID"],$_SESSION["userType"],$_POST["fechana"],$_POST["genero"],$_POST["cprin"],$_POST["numcas"],$_POST["csec"],$_POST["sector"],$_POST["ciudad"],$_POST["numconv"],$_POST["numcel"],$_POST["perfil"]);
        exit();
    }

    if(move_uploaded_file($fileTmpLoc,$fileName)){
        echo "sucessful";
		      modColab($_SESSION["userID"],$_SESSION["userType"],$_POST["fechana"],$_POST["genero"],$_POST["cprin"],$_POST["numcas"],$_POST["csec"],$_POST["sector"],$_POST["ciudad"],$_POST["numconv"],$_POST["numcel"],$nombrearchivo,$_POST["perfil"]);

    } else {
        echo "move_uploaded_file function failed";
    }
?>
