<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="utf-8">

    <script src="vendor/jquery/jquery.js"></script>
    <script src="vendor/jquery/jquery.min.js"></script>



    <script>

        $(document).ready(function(){

            // Capturamos el click encima de una estrella

            $("#stars li").click(function(){

                if($(this).is("li:first") && $(this).hasClass("selected") && !$(this).nextAll("li").hasClass("selected"))

                {

                    // Si es la primera estrella la selecciona, y dicha estrella

                    // esta marcada y es la unica marcada, quitamos la clase

                    $(this).removeClass("selected");



                    // añadimos al valor al formulario

                    $("input[name=stars]").val(0);

                }else{

                    // añadimos la clase "selected"

                    $(this).addClass("selected");



                    // añadimos la clase "selected" a todas las estrellas anteriores

                    $(this).prevAll("li").addClass("selected");



                    // eliminamos la clase "selected" a todas las estrellas siguientes

                    $(this).nextAll("li").removeClass("selected");



                    // añadimos al valor al formulario

                    $("input[name=stars]").val($( "li" ).index($(this))+1);

                }

            });

        });

    </script>



    <style>

        ul {

            list-style-type: none;

            margin:0;

            padding:0;

            overflow:hidden;

        }

        ul li{

            background:url('stars.png') no-repeat 0px 0px transparent;

            width:16px;

            height:16px;

            float:left;

        }

        ul li.selected{ /* esta clase añade la imagen seleccionada */

            background:url('stars.png') no-repeat -16px 0px transparent;

        }

    </style>

</head>



<body>



<?php

if(isset($_POST["stars"]))

{

    # Mostramos la valoración que se ha enviado mediante el formulario

    echo "<p>La valoración a sido de: ".$_POST["stars"]."</p>";

}

?>

<form action="<?php echo $_SERVER["PHP_SELF"]?>" method="post">

    <input type="hidden" name="stars" value="0">

    <ul id="stars">

        <li></li>

        <li></li>

        <li></li>

        <li></li>

        <li></li>

    </ul>

    <p><input type="submit" value="Enviar valoración"></p>

</form>



</body>

</html>