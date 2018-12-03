<?php
  require_once "pdo.php";
  session_start();
  
  
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php
    require "head.php";
  ?>
<style>
		* {
        box-sizing: border-box;
    }

    #myInput {
        background-image: url('images/searchicon.png');
        background-position: 10px 10px;
        background-repeat: no-repeat;
        width: 100%;
        font-size: 16px;
        padding: 12px 20px 12px 40px;
        border: 1px solid #ddd;
        margin-bottom: 12px;
    }

    #myTable {
        border-collapse: collapse;
        width: 100%;
        border: 1px solid #ddd;
        font-size: 18px;
    }

    #myTable th,
    #myTable td {
        text-align: left;
        padding: 12px;
    }

    #myTable tr {
        border-bottom: 1px solid #ddd;
    }

    #myTable tr.header,
    #myTable tr:hover {
        background-color: #f1f1f1;
    }

    .modalmy {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        padding-top: 100px;
        padding-left: 250px;
        /* Location of the box */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4);
        /* Black w/ opacity */
    }
    /* Modal Content */

    .modalmy-content {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-direction: column;
            flex-direction: column;
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        border-radius: 0.3rem;
        background-clip: padding-box;
        outline: 0;
    }

    .arrow {
        box-sizing: border-box;
        height: 1vw;
        width: 1vw;
        border-style: solid;
        border-color: black;
        border-width: 0px 1px 1px 0px;
        transform: rotate(45deg);
        transition: border-width 150ms ease-in-out;
    }

    .arrow:hover {
        border-bottom-width: 4px;
        border-right-width: 4px;
    }

    .top5 {
      margin-top:15px;
    }

    .bottom5 {
      margin-bottom:20px;
    }

    .bottom10 {
      margin-bottom:10px;
    }

    .padding5 {
      padding-right: 45px;
    }

    .padding15 {
      padding-left: 0px;
    }

    </style>
</head>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">
	<?php
		require "navbar.php";
	?>
	 <div class="content-wrapper bg-light">
	  <?php
      if ( isset($_SESSION["oa"]) ) {
        echo('<div class="alert alert-success alert-dismissable">');
        echo('<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>');
        echo($_SESSION["oa"]);
        echo('</div>');
        unset($_SESSION["oa"]);
      }
    ?>
<div class="container">
        <div class="jumbotron bg-light text-secondary">
            <h2 class="display-5 text-center">Estadísticas</h2>
			<div class="panel panel panel-primary">

  <div class="panel-body">
		<div class="form-group">
                                <label for="graphfor">Origen:</label>
                                <select id="segun" class="form-control form-group">
								<option disabled selected>Seleccionar una opción</option>
								<option value="1">Cantidad de Descargas</option>
								<option value="2">Mejores Puntuaciones</option>					
                                </select>
								
       </div>
  </div>
</div>

        </div>
    </div>

	<div id="chart_div" align="center"></div>

 <?php
      require "footer.php";
    ?>
</body>
</html>
 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="vendor/jquery/jquery.js"></script>
		<script src="vendor/jquery/jquery.min.js"></script>
        <script type="text/javascript">
		var sele= document.getElementById("segun");
		sele.addEventListener('change',
		function(){
		var opcion = this.options[sele.selectedIndex];
		if(opcion.value == "1"){
			 function drawChart() {
                // call ajax function to get sports data
                var jsonData = $.ajax({
                    url: "getDataDescargas.php",
                    dataType: "json",
                    async: false
                }).responseText;
                //The DataTable object is used to hold the data passed into a visualization.
                var data = new google.visualization.DataTable(jsonData);
 
                // To render the pie chart.
                var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
                chart.draw(data, {width: 700, height: 500});
            }
			 google.charts.load('current', {'packages':['corechart']});
 
            // Set a callback to run when the Google Visualization API is loaded.
            google.charts.setOnLoadCallback(drawChart);
		} else if (opcion.value == "2"){
			 function drawChart() {
                // call ajax function to get sports data
                var jsonData = $.ajax({
                    url: "getDataPuntuacion.php",
                    dataType: "json",
                    async: false
                }).responseText;
                //The DataTable object is used to hold the data passed into a visualization.
                var data = new google.visualization.DataTable(jsonData);
 
                // To render the pie chart.
                var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
                chart.draw(data, {width: 700, height: 500});
            }
			 google.charts.load('current', {'packages':['corechart']});
 
            // Set a callback to run when the Google Visualization API is loaded.
            google.charts.setOnLoadCallback(drawChart);
	}
  });
            /*
			function drawChart() {
                // call ajax function to get sports data
                var jsonData = $.ajax({
                    url: "getDataDescargas.php",
                    dataType: "json",
                    async: false
                }).responseText;
                //The DataTable object is used to hold the data passed into a visualization.
                var data = new google.visualization.DataTable(jsonData);
 
                // To render the pie chart.
                var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
                chart.draw(data, {width: 700, height: 500});
            }
			
            // load the visualization api
            google.charts.load('current', {'packages':['corechart']});
 
            // Set a callback to run when the Google Visualization API is loaded.
            google.charts.setOnLoadCallback(drawChart);
			*/
        </script>
	
