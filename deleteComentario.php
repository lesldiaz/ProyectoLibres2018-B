<?php
    require_once "pdo.php";
    require_once "delete_files.php";

    function deleteComent($idComentario) {
        $sql = "DELETE FROM comentario WHERE idComentario = :idComentario";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(':idComentario' => $idComentario));
    }
