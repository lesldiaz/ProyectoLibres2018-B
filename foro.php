<?php
require_once "pdo.php";
session_start();
if ( isset($_POST["textarea"])){
    $sql = "INSERT INTO comentario (detalleComent)
              VALUES (:detalleComentario)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':detalleComentario' => $_POST["textarea"]));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    require "head.php"; //la funcion requiere en cada script toma la funcionalidad de dicho script y lo replica en este documento. Sirve para codigo limpio
    ?>

</head>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">
<?php
require "navbar.php";
?>
<div class="content-wrapper bg-light">
    <div class="jumbotron">
        <h2 class="display-5 text-center">Foro Estudiantes - Profesores<img src="images/logoEPN.png" width="10%", height="10%"></h2>
    </div>
    <div style="display:none" id="comment"></div>
    <div>
        <label>Tema del foro</label>

            <input type="text" id="temaForo" name="temaForo">

        <div style="display: none" id="comentario">
            <label>Escriba su comentario</label>
            <br>
            <form method="post">
                <textarea id="textarea" name="textarea" rows="3" cols="50"></textarea>
                <input class="button-group" id="saveComment" type="submit">
            </form>

        </div>
        <div>
                <?php
                $result = $pdo->query("SELECT t.descripcionTema, c.detalleComent  FROM comentario c, tema t where t.idComentario=c.idComentario");
                foreach ($result as $row) {
                    $comentario = $row['detalleComent'];
                    $tema=$row['descripcionTema'];
                    $adjuntar ='<p class="list-group-item-text">' . $comentario . '</p>';
                    echo ('<a href="#" class="list-group-item">'.$tema . $adjuntar.'</a>');
                }
                ?>
        </div>

    </div>
</div>
</body>

</html>
<?php
require "footer.php";
?>
<script type="text/javascript" src="/vendor/jquery/jquery.js"></script>
<script>
   $("#temaForo").change(function(){
       $("#comentario").show();
   })
</script>