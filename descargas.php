<?php
/**
 * Created by PhpStorm.
 * User: mjg70
 * Date: 23/7/2018
 * Time: 23:12
 */
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require "head.php";
    ?>

</head>


<style type="text/css">
    body
    {
        background:
            url("/images/fondo.jpg");
    }
</style>


<body class="fixed-nav sticky-footer bg-dark" id="page-top">

<?php
require "navbar.php";
?>
<div class="content-wrapper bg-light">
    <table class="table table-bordered table-hover">

        <thead>
        <tr>
            <th>
                Nombre Objeto Aprendizaje
            </th>
            <th>
                Descripción
            </th>
            <th>
                Descargas
            </th>
        </tr>
        </thead>
        <tbody class="tbody"></tbody>
    </table>
</div>
<?php
require "footer.php";
?>

<script src="vendor/jszip/jszip.js"></script>
<script src="vendor/jszip/jszip-utils.js"></script>
<script>
    $(document).ready(function () {
        $.ajax({
            method: "POST",
            url: "cargarDescargas.php",
        }).done(function( data ) {
            var result = $.parseJSON(data);
            var fila='';
            $.each( result, function( key, value ) {
                fila += '<tr>';
                fila += '<td>' + value['nombre'] + '</td>';
                fila += '<td>' + value['descripcion'] + '</td>';
                fila += '<td>' + value['descargas'] + '</td>';
                fila += '</tr>';
            });
            $('.tbody').html(fila);
        });
    });

</script>

</div>
</body>

</html>