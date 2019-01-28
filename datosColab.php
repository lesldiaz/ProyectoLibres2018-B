<?php
    session_start();
    require_once "pdo.php";
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
        <?php
          if ($_SESSION["isColab"]=="SI"){
        ?>

        <div class="container">
            <div class="jumbotron">
                <h2 class="display-5 text-center">Editar Perfil de Colaborador</h2>
            </div>
        </div>
        <div class="row bottom5">
            <div class="col-8 offset-2">
                <div class="card">
                    <div class="card-body">
                        <form method="post">
                        <?php
                             if ($_SESSION["userType"] != "admin")
                            {
                                $sql = "CALL datosColaborador (:idPersona,:userType)";
                                $stmt = $pdo->prepare($sql);
                                $stmt->execute(array(':idPersona' => $_SESSION["userID"],
                                                      ':userType' => $_SESSION["userType"]));
                              foreach ($stmt as $row1) {
                                if ($row1["perfil"]){
                                      $valor = $row1["perfil"];
                                      echo '<div class="form-group">
                                        <label><b>Mantener su perfil: </b></label><br/><small>El modo semi-público no muestra su información de domicilio</small><br/>
                                        <fieldset>';
                                        if ($valor == 0){
                                            echo '
                                                <label><input type="radio" name="perfil" value="0" checked>Público</label>
                                                <label><input type="radio" name="perfil" value="1" checked>Semi-Público</label>
                                                <label><input type="radio" name="perfil" value="2" >Privado</label>';
                                        } else if ($valor == 1){
                                                echo '<label><input type="radio" name="perfil" value="0">Público</label>
                                                <label><input type="radio" name="perfil" value="1" checked>Semi-Público</label>
                                                <label><input type="radio" name="perfil" value="2">Privado</label>
                                                ';
                                        }else if ($valor == 2){
                                                echo '<label><input type="radio" name="perfil" value="0">Público</label>
                                                <label><input type="radio" name="perfil" value="1">Semi-Público</label>
                                                <label><input type="radio" name="perfil" value="2" checked>Privado</label>
                                                ';
                                              }
                                  echo ' </fieldset>
                              </div>';
                            }else {
                              echo '<div class="form-group">
                                    <label><b>Mantener su perfil: </b></label><br/><small>El modo semi-público no muestra su información de domicilio</small><br/>
                                    <fieldset>
                                    <label><input type="radio" name="perfil" value="0" checked>Público</label>
                                    <label><input type="radio" name="perfil" value="1">Semi-Público</label>
                                    <label><input type="radio" name="perfil" value="2">Privado</label>
                                    </fieldset>
                                </div>';
                            }
                                echo '<div class="form-group">
                                          <label for="cedula"><b>Cédula</b></label>
                                          <input class="form-control" id="cedula" name="cedula" type="text" value="'.$row1["cedula"].'" readonly>
                                      </div>';
                                echo '<div class="form-group">
                                        <div class="form-row">
                                          <div class="col-md-6">
                                            <label for="nombre"><b>Nombres</b></label>
                                            <input class="form-control" id="nombre" name="nombre" type="text" maxlength="50" value="'.$row1["nombres"].'" readonly>
                                          </div>
                                          <div class="col-md-6">
                                            <label for="apellido"><b>Apellidos</b></label>
                                            <input class="form-control" id="apellido" name="apellido" type="text" value="'.$row1["apellidos"].'" readonly>
                                          </div>
                                        </div>
                                      </div>';
                                      echo '<div class="form-group">';
                                      echo '<label for="correo"><b>Correo electronico</b></label>';
                                      echo '<input class="form-control" id="correo" name="correo" type="email" value="'.$row1["correo"].'" readonly>';
                                      echo '</div>';
                                echo '<div class="form-group">
                                        <label for="fechana"><b>Fecha de Nacimiento</b></label>';
                                        $fechaRestada = date('Y-m-d',strtotime('-18 year'));
                                        if($row1["fechaNac"]!=''){
                                          echo '<input class="form-control" id="fechana" name="fechana" type="date" max="'.$fechaRestada.'" value="'.$row1["fechaNac"].'"required>
                                          </div>';
                                        }else {
                                          echo '<input class="form-control" id="fechana" name="fechana" type="date" max="'.$fechaRestada.'" value="'.$fechaRestada.'"required>
                                          </div>';
                                        }
                                        if ($row1["genero"]!=''){
                                          $valor = $row1["genero"];
                                          echo '<div class="form-group">
                                            <label><b>Género</b></label><br/>
                                            <fieldset>';
                                            if ($valor == 0){
                                            echo '<label><input type="radio" name="genero" value="0" checked> Masculino</label>
                                            <label><input type="radio" name="genero" value="1"> Femenino</label>
                                            <label><input type="radio" name="genero" value="2" > Otro</label>';
                                            } else if ($valor == 1){
                                            echo '<label><input type="radio" name="genero" value="0"> Masculino</label>
                                            <label><input type="radio" name="genero" value="1" checked> Femenino</label>
                                            <label><input type="radio" name="genero" value="2"> Otro</label>';
                                          }else if ($valor == 2){
                                            echo '<label><input type="radio" name="genero" value="0"> Masculino</label>
                                            <label><input type="radio" name="genero" value="1" > Femenino</label>
                                            <label><input type="radio" name="genero" value="2" checked> Otro</label>';
                                          }
                                          echo ' </fieldset>
                                      </div>';
                                    }else {
                                      echo '<div class="form-group">
                                            <label><b>Género</b></label><br/>
                                            <fieldset>
                                            <label><input type="radio" name="genero" value="0"> Masculino</label>
                                            <label><input type="radio" name="genero" value="1"> Femenino</label>
                                            <label><input type="radio" name="genero" value="2" checked> Otro</label>
                                            </fieldset>
                                        </div>';
                                    }

                                    echo '<div class="form-group">
                                      <label><b>Dirección de Domicilio</b></label><br/>
                                      <div class="form-row">
                                        <div class="form-group col-md-8">
                                          <label for="cprin">Calle Principal</label>
                                          <input type="text" class="form-control" id="cprin" name="cprin" value="'.$row1["callePrinc"].'" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                          <label for="numcas">Numero de Casa</label>
                                          <input type="text" class="form-control" id="numcas" name="numcas" value="'.$row1["numCasa"].'" required>
                                        </div>
                                      </div>
                                      <div class="form-row">
                                        <div class="form-group col-md-6">
                                          <label for="csec">Calle Secundaria</label>
                                          <input type="text" class="form-control" id="csec" name="csec" value="'.$row1["calleSec"].'" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                          <label for="sector">Sector</label>
                                          <input type="text" class="form-control" id="sector" name="sector" value="'.$row1["sector"].'" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                          <label for="ciudad">Ciudad</label>
                                          <input type="text" class="form-control" id="ciudad" name="ciudad" value="'.$row1["ciudad"].'" required>
                                        </div>
                                </div>';
                                echo '<div class="form-group">
                                      <label><b>Telefonos de Contacto</b></label><br/>
                                      <div class="form-row">
                                        <div class="form-group col-md-6">
                                          <label for="numconv">Número Convencional</label>
                                          <input type="text" class="form-control" id="numconv" name="numconv" maxlength="9" minlength="9" value="'.$row1["tfconvencional"].'" onkeypress="return numeros(event)">
                                        </div>
                                        <div class="form-group col-md-6">
                                          <label for="numcel">Número Celular</label>
                                          <input type="text" class="form-control" id="numcel" name="numcel" maxlength="10" minlength="10" value="'.$row1["tfcelular"].'" onkeypress="return numeros(event)" required>
                                        </div>
                                      </div>
                                </div>';
                                if ($row1["adjFoto"]){
                                echo '<div class="form-group">
                                    <label><b>Foto de Perfil </b></label>
                                    <div align="center">
                                          <img  src="fotoperfil/'.$row1['adjFoto'].'" style="width: 30%; height: 30%; border=1; solid=#000000;">
                                    </div>
                                    <label><br/>¿Desea cambiar su foto actual?   </label>
                                    <a class="btn btn-danger" href="borrarPerFoto.php?adjFoto='.$row1["adjFoto"].'"> Si </a>

                                </div>';
                              }
                              else{
                                echo '<div class="form-group">';
                                echo '<label for="file1"><b>Adjuntar foto de Perfil</b></label>';
                                echo '<input class="form-control" id="file1" name="file1" type="file" accept="image/*">';
                                echo '</div>';
                              }

                              }
                                echo '<div class="form-group">
                                    <div class="form-row">
                                        <div class="col-4 offset-4">
                                            <button type="button" class="btn btn-danger btn-block" onclick="ir()">Cancelar</button>
                                        </div>
                                        <div class="col-4">
                                            <button type="button" class="btn btn-success btn-block" onclick="guardar()">Guardar</button>
                                        </div>
                                    </div>
                                </div>';
                            }
                          }else {
                            echo '<div class="row bottom5 top5">';
                            echo '<div class="col-10 offset-1">';
                            echo '<div class="card-block">';
                            echo '<h5 class="card-title" align="center"><i class="fa fa-hand-paper-o" aria-hidden="true"></i>
<strong>Lo sentimos, usted no es un Colaborador</strong></h5>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                          }
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
          <script>
              /* Script written by Miguel Nunez @ minuvasoft10.com */
              function _(el) {
                  return document.getElementById(el);
              }

              function guardar() {
  				          if (document.getElementById('cprin').value ==
                      '' || document.getElementById('numcas').value == '' ||
                      document.getElementById('csec').value == '' || document.getElementById(
                          'sector').value ==
                      '' || document.getElementById('fechana').value == '' || document.getElementById('ciudad').value == '' || document.getElementById('numcel').value == '') {

                      alert("Error uno o mas campos vacios");

                  } else {
                    var formdata = new FormData();
                    var file = null;
                    if(document.getElementById('file1')!=null){
                      file = _("file1").files[0];
                    }
                    var radios = document.getElementsByName('genero');
                    var genero = null;
                    for (var i = 0, length = radios.length; i < length; i++){
                        if (radios[i].checked)
                        {
                          genero = radios[i].value;
                          break;
                        }
                      }
                      var radios1 = document.getElementsByName('perfil');
                      var perfil = null;
                      for (var i = 0, length = radios1.length; i < length; i++){
                          if (radios1[i].checked)
                          {
                            perfil = radios1[i].value;
                            break;
                          }
                        }
                      formdata.append("file1", file);
                      formdata.append("fechana", _("fechana").value);
                      formdata.append("cprin", _("cprin").value);
                      formdata.append("numcas", _("numcas").value);
                      formdata.append("genero", genero);
                      formdata.append("perfil", perfil);
                      formdata.append("csec", _("csec").value);
                      formdata.append("sector", _("sector").value);
                      formdata.append("ciudad", _("ciudad").value);
                      formdata.append("numconv", _("numconv").value);
                      formdata.append("numcel", _("numcel").value);
                      var ajax = new XMLHttpRequest();
                      //document.querySelector('input[name="genero"]:checked').value;
                      ajax.open('POST', 'upload6.php');
                      ajax.send(formdata);
                      alert("Datos Actualizados con Exito!");
  					          javascript: location.href = 'perfilColab.php';
                  }
              }

              /*function progressHandler(event) {
                  _("loaded_n_total").innerHTML = "Subidos " + event.loaded + " bytes de " + event.total;
              }
              */
              function ir(){
                window.location="perfilColab.php";
              }

              function numeros(e){
                  key = e.keyCode || e.which;
                  tecla = String.fromCharCode(key).toLowerCase();
                  letras = " 0123456789";
                  especiales = [8,45];

                  tecla_especial = false
                  for(var i in especiales){
               if(key == especiales[i]){
                   tecla_especial = true;
                   break;
                      }
                  }

                  if(letras.indexOf(tecla)==-1 && !tecla_especial)
                      return false;
              }
          </script>

</body>

</html>
