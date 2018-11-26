<?php
    session_start();
    require_once "pdo.php";

    if ( isset($_POST["nombreOA"]) && isset($_POST["descripcion"]) && isset($_POST["autorOA"]) && isset($_POST["idOA"])
        && isset($_POST["institucionOA"]) && isset($_POST["fechaCreacionOA"]) && isset($_POST["palabraClaveOA"]) ) {
        $sql = "UPDATE objetoaprendizaje SET 
                nombre = :nombre,   
                autor = :autor,
                descripcion = :descripcion,
                fecha = :fecha,
                p_clave = :p_clave,
                institucion = :institucion
                WHERE idOA = :idOA";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':nombre' => $_POST["nombreOA"],
            ':autor' => $_POST["autorOA"],
            ':descripcion' => $_POST["descripcion"],
            ':fecha' => $_POST["fechaCreacionOA"],
            ':p_clave' => $_POST["palabraClaveOA"],
            ':institucion' => $_POST["institucionOA"],
            ':idOA' => $_POST["idOA"]));
        $_SESSION["oa"] = "Objeto de Aprendizaje editado correctamente.";
        header( 'Location: buscar.php' ) ;
        return;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
        require "head.php";
    ?>
    <style>
    .jumbotron {
        padding-top: 20px;
        padding-bottom: 20px;
    }

    .bottom5 { 
        margin-bottom:20px; 
    }
    </style>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
    <?php
        require "navbar.php";
    ?>

    <div class="content-wrapper bg-light">
        <div class="container">
            <div class="jumbotron">
                <h2 class="display-5 text-center">Editar OA</h2>
            </div>
        </div>
        <div class="row bottom5">
            <div class="col-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <form method="post">
                        <?php
                            $sql = "SELECT nombre, descripcion, autor, institucion, DATE_FORMAT(fecha,'%Y-%m-%d') as fecha_f, p_clave FROM objetoaprendizaje WHERE idOA = :id";
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute(array(':id' => $_GET["id"]));
                            $row = $stmt->fetch(PDO::FETCH_ASSOC);
                            echo '<div class="form-group">';
                            echo '<label for="nombreOA">Nombre del OA</label>';
                            echo '<input  type="text" class="form-control" name="nombreOA" placeholder="Nombre del OA" required value="' . $row["nombre"] . '">';
                            echo '</div>';
                            echo '<div class="form-group">';
                            echo '<label for="descripcion">Descripcion</label>';
                            echo '<textarea rows="3" class="form-control" name="descripcion" placeholder="Descripcion" required>' . $row["descripcion"] . '</textarea>';
                            echo '</div>';
                            echo '<div class="form-group">';
                            echo '<label for="autorOA">Autor</label>';
                            echo '<input type="text" class="form-control" name="autorOA" placeholder="Autor" required value="' . $row["autor"] . '">';
                            echo '</div>';
                            echo '<div class="form-group">';
                            echo '<label for="institucionOA">Institución</label>';
                            echo '<input type="text" class="form-control" name="institucionOA" placeholder="Institución" required value="' . $row["institucion"] . '">';
                            echo '</div>';
                            echo '<div class="form-group">';
                            echo '<label for="fechaCreacionOA">Fecha de creacion</label>';
                            echo '<input type="date" class="form-control" name="fechaCreacionOA" placeholder="Fecha de creacion OA" required value="' . $row["fecha_f"] . '">';
                            echo '</div>';
                            echo '<div class="form-group">';
                            echo '<label for="palabraClaveOA">Palabras clave</label>';
                            echo '<input type="text" class="form-control" name="palabraClaveOA" placeholder="Palabra clave OA" required value="' . $row["p_clave"] . '">';
                            echo '</div>';
                            echo '<div class="form-group">';
                            echo '<div class="form-row">';
                            echo '<div class="col-4 offset-4">';
                            echo '<button type="button" class="btn btn-danger btn-block" onclick="javascript:location.href=' . "'buscar.php'" . '">Cancelar</button>';
                            echo '</div>';
                            echo '<div class="col-4">';
                            echo '<input type="hidden" name="idOA" value="' . $_GET["id"] . '">';
                            echo '<input type="submit" class="btn btn-success btn-block" value="Guardar">';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <?php
            require "footer.php";
        ?>
    </div>
</body>

</html>