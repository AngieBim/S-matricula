<?php 
$corepage = explode('/', $_SERVER['PHP_SELF']);
$corepage = end($corepage);
if ($corepage !== 'index.php') {
  if ($corepage == $corepage) {
    $corepage = explode('.', $corepage);
    header('Location: index.php?page=' . $corepage[0]);
  }
}
?>
<h1 class="text-primary"><i class="fas fa-users"></i>  Todos los Usuarios<small class="text-warning"> </small></h1>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
     <li class="breadcrumb-item" aria-current="page"><a href="index.php">Panel de Control </a></li>
 
  </ol>
</nav>

<table class="table  table-striped table-hover table-bordered" id="data">
  <thead class="thead-dark">
    <tr>
      <th scope="col">N°</th>
      <th scope="col">Nombre</th>
      <th scope="col">Correo</th>
      <th scope="col">Usuario</th>
      <th scope="col">Fotografía</th>
      <th scope="col">Estado</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php 
      $query = mysqli_query($db_con, 'SELECT * FROM `usuario`');
      $i = 1;
      while ($result = mysqli_fetch_array($query)) { ?>
      <tr>
        <?php 
        echo '<td>'.$i.'</td>
          <td>'.ucwords($result['nombre']).'</td>
          <td>'.$result['email'].'</td>';
        if (isset($result['usuario'])) {
          echo '<td>'.ucwords($result['usuario']).'</td>';
        } else {
          echo '<td>N/A</td>'; // O alguna otra indicación para valores no definidos
        }
        echo '<td><img src="images/'.$result['foto'].'" height="50px"></td>
          <td>'.$result['estado'].'</td>
          <td><a href="eliminar.php?id='.$result['id'].'" onclick="return confirmationDelete($(this));">Eliminar</a></td>';
        ?>
      </tr>  
     <?php $i++;
      } 
    ?>
  </tbody>
</table>

<script type="text/javascript">
  function confirmationDelete(anchor) {
    var conf = confirm('¿Estás seguro de que deseas eliminar este registro?');
    if (conf) {
      window.location = anchor.attr("href");
    }
    return false;
  }
</script>