<!DOCTYPE html>
<html lang="en">

<head>
  <?php
    require "head.php";
  ?>

  <style>
    .bottom5 { 
        margin-bottom:70px; 
    }
  </style> 


	
</head>

<body class="bg-dark">

<div id="cuerpo"></div>
<div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
 

</body>


</html>
<script src="Highcharts/code/highcharts.js"></script>
<script src="Highcharts/code/modules/exporting.js"></script>
<script src="Highcharts/code/modules/export-data.js"></script>
<script src="vendor/jquery/jquery.js"></script>
<script src="vendor/jquery/jquery.min.js"></script>


<script type="text/javascript">
var lst=[];
    $(document).ready(function () {
        $.ajax({
            method: "POST",
            url: "cargarDescargas.php",
        }).done(function( data ) {
            var result = $.parseJSON(data);
			var fila='';
            $.each( result, function( key, value ) {
              
				lst.push(value['descargas']);
            });
            $('#cuerpo').html(fila);
        });
    });

Highcharts.chart('container', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Estadisticas'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
    series: [{
        name: 'Brands',
        colorByPoint: true,
        data: [{
            name: 'Diseno de Software Libre',
            y: 61.41,
            sliced: true,
            selected: true
        }, {
            name: 'Interfaz de Usuario',
            y: 11.84
        }, {
            name: 'Refactorizar',
            y: 10.85
        }, {
            name: 'DISENO A NIVEL DE COMPONENTES',
            y: 4.67
        }, {
            name: 'Algebra Lineal',
            y: 4.18
        }, {
            name: 'Diseño arquitectónico del repositorio de Objetos de Aprendizaje',
            y: 1.64
        }]
    }]
});
</script>
