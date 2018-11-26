<!DOCTYPE html>
<html lang="en">
<head>

</head>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">

<div>
    <input type="text" id="nombre">
    <input type="text" id="autor">
    <input type="text" id="descripcion">
    <input type="date" id="fecha">
    <input type="text" id="p_clave">
    <input type="text" id="institucion">
    <input type="text" id="tamano">
    <input type="text" id="tipo">
    <input type="text" id="ruta_zip">
    <input type="text" id="idProfesor">
    <button id="mario">Aprobar</button>
</div>
</body>

</html>
<script type="text/javascript" src="/vendor/jquery/jquery.js"></script>
<script>

    $("#mario").click(function(){
        var nombre = $("#nombre").val();
        var autor= $("#autor").val();
        var descripcion= $("#descripcion").val();
        var fecha= $("#fecha").val();
        var p_clave= $("#p_clave").val();
        var institucion= $("#institucion").val();
        var tamano= $("#tamano").val();
        var tipo= $("#tipo").val();
        var ruta_zip= $("#ruta_zip").val();
        var idProfesor= $("#idProfesor").val();
        var form_data =
            'nombre='+nombre+
            '&autor='+autor+
            '&descripcion='+descripcion+
            '&fecha='+fecha+
            '&p_clave='+p_clave+
            '&institucion='+institucion+
            '&tamano='+tamano+
            '&tipo='+tipo+
            '&ruta_zip='+ruta_zip+
            '&idProfesor='+idProfesor;
        $.ajax({
            url: "process.php",
            type: "POST",
            data: form_data,
            success: function (html) {
                //if process.php returned 1/true (send mail success)
                if (html==1) {
                    alert("Datos guardados satisfactoriamente");
                } else alert('No se pudo');
            }
        });

    });

</script>