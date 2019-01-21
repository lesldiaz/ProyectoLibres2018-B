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
                        $sql = "CALL datosColaborador (:idPersona,:userType)";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute(array(':idPersona' => $_GET["id"],
                                             ':userType' => $_GET["tipo"]));
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
                                    if ($row1["perfil"]!=1){
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
                                  }
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
                                    <div class="col-4">
                                            <button type="button" class="btn btn-success btn-block" onclick="reg()">Regresar</button>
                                        </div>
                                    </div>
                                </div>';

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

              function reg() {
  				       window.location="busColab.php";
              }
              function ir(){
                window.location="index.php";
              }

          </script>

</body>

</html>
