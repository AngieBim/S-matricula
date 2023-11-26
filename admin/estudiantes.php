<?php 
  $corepage = explode('/', $_SERVER['PHP_SELF']);
  $corepage = end($corepage);
  if ($corepage !== 'index.php') {
    $corepage = explode('.', $corepage);
    header('Location: index.php?page='.$corepage[0]);
  }
?>
<h1 class="text-primary"><i class="fas fa-users"></i>  Todos los Estudiantes<small class="text-warning"></small></h1>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
     <li class="breadcrumb-item" aria-current="page"><a href="index.php">Panel de Control </a></li>

  </ol>
</nav>
<?php if(isset($_GET['eliminar']) || isset($_GET['editar'])) { ?>
  <div role="alert" aria-live="assertive" aria-atomic="true" class="toast fade" data-autohide="true" data-animation="true" data-delay="2000">
    <div class="toast-header">
      <strong class="mr-auto">Insertar Estudiantes</strong>
      <small><?php echo date('L-M-M'); ?></small>
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body">
      <?php 
        if (isset($_GET['eliminar'])) {
          if ($_GET['eliminar'] == 'exitoso') {
            echo "<p style='color: green; font-weight: bold;'>Estudiante eliminado exitósamente</p>";
          }  
        }
        if (isset($_GET['eliminar'])) {
          if ($_GET['eliminar'] == 'error') {
            echo "<p style='color: red; font-weight: bold;'>Estudiante no eliminado</p>";
          }  
        }
        if (isset($_GET['editar'])) {
          if ($_GET['editar'] == 'existoso') {
            echo "<p style='color: green; font-weight: bold;'>Estudiante editado exitósamente</p>";
          }  
        }
        if (isset($_GET['editar'])) {
          if ($_GET['editar'] == 'error') {
            echo "<p style='color: red; font-weight: bold;'>Estudiante no editado</p>";
          }  
        }
      ?>
    </div>
  </div>
<?php } ?>

<table class="table table-striped table-hover table-bordered" id="data">
  <thead class="thead-dark">
    <tr>
      <th scope="col">N°</th>
      <th scope="col">Nombre</th>
      <th scope="col">Cod Matricula</th>
      <th scope="col">Dirección</th>
      <th scope="col">Contacto</th>
      <th scope="col">Fotografía</th>
      <th scope="col">Acción</th>
    </tr>
  </thead>
  <tbody>
    <?php 
      $query = mysqli_query($db_con, 'SELECT * FROM `estudiantes_info` ORDER BY `codigo` DESC;');
      if ($query) { // Verificar si la consulta se ejecutó correctamente
        $i = 1;
        while ($result = mysqli_fetch_array($query)) { ?>
        <tr>
  <td><?= $i ?></td>
  <td><?= ucwords($result['nombre']) ?></td>
  <td><?= $result['codigo'] ?></td>
  <td><?= ucwords($result['direccion']) ?></td>
  <td><?= $result['telefono'] ?></td>
  <td><img src="images/<?= $result['fotografia'] ?>" height="50px"></td>
  <td>
    <div class="btn-group">
      <a class="btn btn-warning btn-sm" href="index.php?page=editestudiante&id=<?= base64_encode($result['id']) ?>&fotografia=<?= base64_encode($result['fotografia']) ?>">
        <i class="fa fa-edit"></i> Editar
      </a>
      <a class="btn btn-danger btn-sm" onclick="confirmationDelete($(this));return false;" href="index.php?page=eliminar&id=<?= base64_encode($result['id']) ?>&fotografia=<?= base64_encode($result['fotografia']) ?>">
        <i class="fas fa-trash-alt"></i> Eliminar
      </a>
    </div>
  </td>
</tr>
       <?php $i++;
        }
      } else {
        echo "Error en la consulta: " . mysqli_error($db_con); // Muestra el mensaje de error
      }
    ?>
    
  </tbody>
</table>
  </tbody>
</table>
<script type="text/javascript">
 $(document).ready(function() {
  // Destruir la tabla DataTable si ya existe
  if ($.fn.DataTable.isDataTable('#data')) {
    $('#data').DataTable().destroy();
  }

  // Inicializar el DataTable con las configuraciones de idioma
  $('#data').DataTable({
    "language": {
      "sLengthMenu": "Mostrar _MENU_ entradas",
      "search": "Buscar: ",
      "sInfo": "Mostrando _START_ a _END_ de _TOTAL_ entradas",
      "sInfoEmpty": "Mostrando 0 a 0 de 0 entradas",
      "sInfoFiltered": "(filtrado de un total de _MAX_ entradas)",
      "sZeroRecords": "No se encontraron resultados",
      "sEmptyTable": "No hay datos disponibles en la tabla",
      "oPaginate": {
        "sFirst": "Primero",
        "sLast": "Último",
        "sNext": "Siguiente",
        "sPrevious": "Anterior"
      },
      "oAria": {
        "sSortAscending": ": activar para ordenar la columna ascendente",
        "sSortDescending": ": activar para ordenar la columna descendente"
      }
    }
  });
});

  function confirmationDelete(anchor) {
    var conf = confirm('Estás seguro que deseas eliminar este registro, esta opción es irreversible');
    if (conf) {
      window.location = anchor.attr("href");
    }
  }
</script>