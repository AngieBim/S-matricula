<?php
$corepage = explode('/', $_SERVER['PHP_SELF']);
$corepage = end($corepage);
if ($corepage !== 'index.php') {
    $page_parts = explode('.', $corepage);
    header('Location: index.php?page=' . $page_parts[0]);
}
?>

<h1><a href="index.php"><i class="fas fa-tachometer-alt"></i> Panel de Control</a></h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-user"></i> Panel</li>
    </ol>
</nav>

<div class="row student">
    <div class="col-sm-4">
        <div class="card text-white bg-primary mb-3">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-4">
                        <i class="fa fa-users fa-3x"></i>
                    </div>
                    <div class="col-sm-8">
                        <div class="float-sm-right">&nbsp;<span style="font-size: 30px">
                            <?php
                            $estu_query = mysqli_query($db_con, 'SELECT * FROM `estudiantes_info`');
                            if ($estu_query) {
                                $estu = mysqli_num_rows($estu_query);
                                echo $estu;
                            } else {
                                echo "Error en la consulta: " . mysqli_error($db_con);
                            }
                            ?>
                        </span></div>
                        <div class="clearfix"></div>
                        <div class="float-sm-right">Total Estudiantes</div>
                    </div>
                </div>
            </div>
            <div class="list-group-item-primary list-group-item list-group-item-action">
                <div class="row">
                    <div class="col-sm-8">
                        <p class="">Ver Estudiantes</p>
                    </div>
                    <div class="col-sm-4">
                        <a href="estudiantes.php"><i class="fa fa-arrow-right float-sm-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div in array quiere decir que no esta presente en un array  in_array(2, $m) = false

    <div class="col-sm-4">
    <div class="card text-white bg-info mb-3">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-4">
                    <i class="fa fa-users fa-3x"></i>
                </div>
                <div class="col-sm-8">
                    <div class="float-sm-right">&nbsp;<span style="font-size: 30px">
                        <?php
                        $tusuarios_query = mysqli_query($db_con, 'SELECT * FROM `usuario`');
                        if ($tusuarios_query) {
                            $tusuarios = mysqli_num_rows($tusuarios_query);
                            echo $tusuarios;
                        } else {
                            echo "Error en la consulta: " . mysqli_error($db_con);
                        }
                        ?>
                    </span></div>
                    <div class="clearfix"></div>
                    <div class="float-sm-right">Total de Usuarios</div>
                </div>
            </div>
        </div>
        

        
        <div class="list-group-item-primary list-group-item list-group-item-action">
            <a href="index.php?page=usuarios">
                <div class="row">
                    <div class="col-sm-8">
                        <p class="">Ver Usuarios</p>
                    </div>
                    <div class="col-sm-4">
                        <i class="fa fa-arrow-right float-sm-right"></i>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

    <div class="col-sm-4">
        <div class="card text-white bg-warning mb-3">
            <div class="card-header">
                <div class="row">
                    <?php
                    $nombre_usuario = $_SESSION['login'];
                    $query_usuario = mysqli_query($db_con, "SELECT * FROM `usuario` WHERE `nom_user`='$nombre_usuario';");
                    if ($query_usuario) {
                        $datos_usuario = mysqli_fetch_array($query_usuario);
                        echo '<div class="col-sm-6">
                                <img class="showimg" src="images/' . $datos_usuario['foto'] . '">
                                <div style="font-size: 20px">' . ucwords($datos_usuario['nombre']) . '</div>
                            </div>
                            <div class="col-sm-6">
                                <div class="clearfix"></div>
                                <div class="float-sm-right"> hola</div>
                            </div>';
                    } else {
                        echo "Error en la consulta: " . mysqli_error($db_con);
                    }
                    ?>
                </div>
            </div>
            <div class="list-group-item-primary list-group-item list-group-item-action">
                <a href="index.php?page=user-perfil">
                    <div class="row">
                        <div class="col-sm-8">
                            <p class="">Tu perfil</p>
                        </div>
                        <div class="col-sm-4">
                            <i class="fa fa-arrow-right float-sm-right"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<hr>
<h3>Reporte de Estudiantes</h3>
<table class="table table-striped table-hover table-bordered" id="data">
    <thead class="thead-dark">
        <tr>
            <th scope="col">N°</th>
            <th scope="col">Nombre</th>
            <th scope="col">Cod_Matrícula</th>
            <th scope="col">Dirección</th>
            <th scope="col">Contacto</th>
            <th scope="col">Fotografía</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = mysqli_query($db_con, 'SELECT * FROM `estudiantes_info` ORDER BY `estudiantes_info`.`fecha` DESC;');
        if ($query) {
            $i = 1;
            while ($result = mysqli_fetch_array($query)) { ?>
                <tr>
                    <?php
                    echo '<td>' . $i . '</td>
                          <td>' . (isset($result['nombre']) ? ucwords($result['nombre']) : '') . '</td>
                          <td>' . (isset($result['cod_matricula']) ? $result['cod_matricula'] : '') . '</td>
                          <td>' . (isset($result['direccion']) ? ucwords($result['direccion']) : '') . '</td>
                          <td>' . (isset($result['contacto']) ? $result['contacto'] : '') . '</td>
                          <td>' . (isset($result['foto']) ? '<img src="images/' . $result['foto'] . '" height="50px">' : '') . '</td>';
                    ?>
                </tr>
            <?php
                $i++;
            }
        } else {
            echo "Error en la consulta: " . mysqli_error($db_con);
        }
        ?>
    </tbody>
</table>