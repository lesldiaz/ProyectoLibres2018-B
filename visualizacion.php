<h1>Objetos contenidos en el zip</h1>";
<?php
/**
 * Created by PhpStorm.
 * User: mjg70
 * Date: 12/6/2018
 * Time: 17:43
 */
session_start();

$dir = "almacen/";

// Abrir un directorio conocido, y proceder a leer sus contenidos
if (is_dir($dir)) {
    if ($gd = opendir($dir)) {
        echo '<label>Nombres de archivos:</label>';
        while (($archivo = readdir($gd)) !== false) {
            if ($archivo != "." && $archivo != "..")
                echo '<br></br>';
                echo ('<a href="#" class="list-group-item">'.$archivo .'</a>');

        }
        closedir($gd);
    }
}