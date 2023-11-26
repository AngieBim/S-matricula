<?php require_once 'admin/db_con.php'; ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Matrícula de Estudiantes</title>
  </head>
  <body>
    <div class="container"><br>
      <a class="btn btn-primary float-right" href="admin/login.php">Panel Administrativo</a>
          <h1 class="text-center">Sistema de Matrícula de Estudiantes</h1><br>

          <div class="row">
            <div class="col-md-4 offset-md-4">
              <form method="POST">
            <table class="text-center infotable">
              <tr>
                <th colspan="2">
                  <p class="text-center">Información del Estudiante</p>
                </th>
              </tr>
              <tr>
                <td>
                   <p>Selecciona el Grado</p>
                </td>
                <td>
                   <select class="form-control" name="grado">
                     <option value="">
                       Selecciona
                     </option>
                     <option value="Primero">
                       Primero
                     </option>
                     <option value="Segundo">
                       Segundo
                     </option>
                     <option value="Tercero">
                       Tercero
                     </option>
                     <option value="Cuarto">
                       Cuarto
                     </option>
                     <option value="Quinto">
                       Quinto
                     </option>
                     <option value="Sexto">
                       Sexto
                     </option>
                   </select>
                </td>
              </tr>

              <tr>
                <td>
                  <p><label for="Codigo">Número Matricula</label></p>
                </td>
                <td>
                  <input class="form-control" type="text" pattern="[0-9]{6}" id="codigo" placeholder="6 dígitos..." name="codigo">
                </td>
              </tr>
              <tr>
                <td colspan="2" class="text-center">
                  <input class="btn btn-danger" type="submit" name="showinfo">
                </td>
              </tr>
            </table>
          </form>
            </div>
          </div>
        <br>
        <?php if (isset($_POST['showinfo'])) {
          $grado= $_POST['grado'];
          $codigo = $_POST['codigo'];
          if (!empty($grado && $codigo)) {
            $query = mysqli_query($db_con,"SELECT * FROM `estudiantes_info` WHERE `codigo`='$codigo' AND `grado`='$grado'");
            if (!empty($row=mysqli_fetch_array($query))) {
              if ($row['codigo'] == $codigo && $grado == $row['grado']) {
            
                $codigo= $row['codigo'];
                $nombre= $row['nombre'];
                $grado= $row['grado'];
                $direccion= $row['direccion'];
                $fotografia= $row['fotografia'];
                $fecha= $row['fecha'];
              ?>
        <div class="row">
          <div class="col-sm-6 offset-sm-3">
            <table class="table table-bordered">
              <tr>
                <td rowspan="5"><h3>Información de Estudiante</h3><img class="img-thumbnail" src="admin/images/<?= isset($photo)?$photo:'';?>" width="250px"></td>
                <td>Nombre</td>
                <td><?= isset($nombre)?$nombre:'';?></td>
              </tr>
              <tr>
                <td>Número de Matrícula</td>
                <td><?= isset($codigo)?$codigo:'';?></td>
              </tr>
              <tr>
                <td>Grado</td>
                <td><?= isset($grado)?$grado:'';?></td>
              </tr>
              <tr>
                <td>Dirección</td>
                <td><?= isset($direccion)?$direccion:'';?></td>
              </tr>
              <tr>
                <td>Fecha de Ingreso</td>
                <td><?= isset($fecha)?$fecha:'';?></td>
              </tr>
            </table>
          </div>
        </div>  
      <?php 
          }else{
                echo '<p style="color:red;">Por favor ingrese un número válido de matricula y grado</p>';
              }
            }else{
              echo '<p style="color:red;">Tu información ingresada no coincide</p>';
            }
            }else{?>
              <script type="text/javascript">alert("Datos no encontrados");</script>
            <?php }
          }; ?>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>