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
                <h2 class="display-5 text-center">Perfil de Colaborador</h2>
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
                                if ($row1["adjFoto"]){
                                  echo '<div align="center"> <img  src="fotoperfil/'.$row1['adjFoto'].'" style="width: 30%; height: 30%; border=1; solid=#000000;">
                                  </div>';
                                }else {
                                echo '<div align="center"> <label for="foto">Sin foto de perfil </label><br/><img  src="fotoperfil/sinfoto123.jpg" style="width: 20%; height: 20%; border=1; solid=#000000;" name="foto" id="foto">
                                </div>';

                              }

                                echo '
                                <br/><table style="width:100%" BORDER=2>
                                <tr>
                                <td colspan="2" bgcolor="#343a40"><font size ="3", color ="#ffffff"><h5 align="center">Datos Personales</h5></font></td>
                                </tr>
                                  <tr>
                                    <th>Cédula:</th>
                                    <td>'.$row1["cedula"].'</td>
                                  </tr>
                                  <tr>
                                    <th>Colaborador:</th>
                                    <td>'.$row1["nombres"].' '.$row1["apellidos"].'</td>
                                  </tr>
                                  <tr>
                                    <th>Correo Electrónico:</th>
                                    <td>'.$row1["correo"].'</td>
                                  </tr>
                                  <tr>
                                    <th>Fecha de Nacimiento:</th>
                                    <td>'.$row1["fechaNac"].'</td>
                                  </tr>
                                  <tr>
                                    <th>Género:</th>
                                    ';
                                    if ($row1["genero"]!=''){
                                    if ($row1["genero"] == 0){
                                      echo'<td>Masculino</td>';
                                    } else if ($row1["genero"] == 1){
                                      echo'<td>Femenino</td>';
                                    } else{
                                      echo'<td>Otros</td>';
                                    }
                                  }else {
                                    echo'<td>Sin Especificar</td>';
                                  }
                                    echo '</tr>
                                    </table>';

                                    echo '<br/>
                                    <table style="width:100%" BORDER=2>
                                        <tr>
                                        <td colspan="2" bgcolor="#343a40"><font size ="3", color ="#ffffff"><h5 align="center">Datos de Domicilio</h5></font></td>
                                        </tr>
                                        <tr>
                                          <th>Calle Principal:</th>
                                          <td>'.$row1["callePrinc"].'</td>
                                        </tr>
                                        <tr>
                                          <th>Número de Casa:</th>
                                          <td>'.$row1["numCasa"].'</td>
                                        </tr>
                                        <tr>
                                          <th>Calle Secundaria:</th>
                                          <td>'.$row1["calleSec"].'</td>
                                        </tr>
                                        <tr>
                                          <th>Sector:</th>
                                          <td>'.$row1["sector"].'</td>
                                        </tr>
                                        <tr>
                                          <th>Ciudad:</th>
                                          <td>'.$row1["ciudad"].'</td>
                                        </tr>
                                      </table>
                                    ';

                                    echo '<br/>
                                    <table style="width:100%" BORDER=2>
                                    <tr>
                                    <td colspan="2" bgcolor="#343a40" ><font size ="3", color ="#ffffff"><h5 align="center">Datos de Contacto</h5></font></td>
                                    </tr>
                                    <tr>
                                          <th>Telefono Convencional:</th>
                                          <td>'.$row1["tfconvencional"].'</td>
                                        </tr>
                                        <tr>
                                          <th>Telefono Celular</th>
                                          <td>'.$row1["tfcelular"].'</td>
                                        </tr>
                                      </table>
                                      <br/><br/>
                                    ';

                              }
                                echo '<div class="form-group">
                                    <div class="form-row">
                                        <div class="col-4 offset-4">
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalBorrar">Borrar Perfil</button>
                                        </div>
                                        <div class="col-4">
                                            <button type="button" class="btn btn-success btn-block" onclick="guardar()">Actualizar Información</button>
                                        </div>
                                    </div>
                                </div>';
                            }
                            echo '<div id="modalBorrar" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                            <div class="modal-header" style="background-color: #d9534;">
                             <h4 class="modal-title" style="color:#868e96;">Eliminar Perfil de Colaborador</h4>
                             <button type="button" class="close" data-dismiss="modal">&times;</button>
                             </div>
                             <div class="modal-body">
                             <p>¿Realmente desea eliminar su perfil como Colaborador? <br/> Esta opcion no se puede revertir.</p>
                             </div>
                             <div class="modal-footer">
                             <a class="btn btn-danger" href="borrarColaborador.php"> Eliminar </a>
                             <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                             </div>
                             </div>

                       </div>
                     </div>';
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

              function guardar() {
  				       window.location="datosColab.php";
              }
              function ir(){
                window.location="index.php";
              }

          </script>

</body>

</html>
