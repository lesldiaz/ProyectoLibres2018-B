
<?php
  ## function to unzip OA
    require_once "pdo.php";
    session_start();

    $filepath = 'zip/' . $_POST["zip_path"];
    $name = basename($filepath,".zip");
    $zip = new ZipArchive;
    $descomp = $_SESSION["userID"] . '-' . $_SESSION["userType"];
    mkdir("$descomp", 0700);
    if ($zip->open($filepath) === TRUE) {
        $zip->extractTo("oa/$descomp/$name");
        $zip->close();
        $sql = "INSERT INTO rutaoa (idUser, idOA, username, rutaoa)
                VALUES (:idUser, :idOA, :username, :rutaoa)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':idUser' => $_SESSION["userID"],
            ':idOA' => $_POST["id"],
            ':username' => $_SESSION["userName"],
            ':rutaoa' => "oa/$descomp/$name/index.html"));
        $_SESSION["oa"] = "Objeto de Aprendizaje descomprimido correctamente.";
    }
?>
