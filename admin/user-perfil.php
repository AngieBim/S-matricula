<?php

$usuario = $_SESSION['login'];

$corepage = explode('/', $_SERVER['PHP_SELF']);
$corepage = end($corepage);
if ($corepage !== 'index.php') {
    if ($corepage == $corepage) {
        $corepage = explode('.', $corepage);
        header('Location: index.php?page=' . $corepage[0]);
    }
}
?>

<h1 class="text-primary"><i class="fas fa-user"></i> Perfil de Usuario</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item" aria-current="page"><a href="index.php">Panel de Control</a></li>
        <li class="breadcrumb-item active" aria-current="page">Perfil de Usuario</li>
    </ol>
</nav>

<?php
$query = mysqli_query($db_con, "SELECT * FROM `usuario` WHERE `nom_user` = '$usuario';");
if ($query === false) {
  // Manejo de errores de consulta
  die("Error en la consulta: " . mysqli_error($db_con));
}

$row = mysqli_fetch_array($query);

?>
<div class="row">
  <div class="col-sm-6">
    <table class="table table-bordered">
      <tr>
        <td>ID de Usuario</td>
        <td><?php echo $row['id']; ?></td>
      </tr>
      <tr>
        <td>Nombre</td>
        <td><?php echo ucwords($row['nombre']); ?></td>
        
      </tr>
      <tr>
        <td>Correo</td>
        <td><?php echo $row['email']; ?></td>
      </tr>
      <tr>
        <td>nom_user</td>
        <td><?php echo ucwords($row['nom_user']); ?></td>
        
      </tr>
      <tr>
        <td>Estado</td>
        <td><?php echo ucwords($row['estado']); ?></td>
      </tr>
      <tr>
        <td>Fecha de Registro</td>
        <td><?php echo $row['fecha']; ?></td>
      </tr>
    </table>
    <a class="btn btn-warning pull-right" href="index.php?page=edit-usuario&id=<?php echo base64_encode($row['id']); ?>">Editar Perfil</a>
  </div>
  <div class="col-sm-6">
    <h3>Fotografía de Perfil</h3>
    <a href="images/<?php echo $row['foto']; ?>">
      <img class="img-thumbnail" id="imguser" src="images/<?php echo $row['foto']; ?>" width="200px">
    </a>

    <?php 
if (isset($_POST['fotosubida'])) {
    if (isset($_FILES['user-perfil']['tmp_name'])) {
        $photofile = $_FILES['user-perfil']['tmp_name'];
        $fotosubida = $usuario . date('d-m-y') . $_FILES['user-perfil']['nombre'];

        if (move_uploaded_file($photofile, 'images/' . $fotosubida)) {
            // Realiza la actualización en la base de datos usando $ufotosubida
            $update_query = mysqli_prepare($db_con, "UPDATE `usuario` SET `foto` = ? WHERE `nom_user` = ?");
            mysqli_stmt_bind_param($update_query, "ss", $fotosubida, $usuario);

            // Asegúrate de que $usuario esté definido antes de ejecutar la consulta
            
            if (isset($usuario)) {
                mysqli_stmt_execute($update_query);
                mysqli_stmt_close($update_query);
                echo "Foto de perfil actualizada correctamente.";
            } else {
                echo "Error: La variable \$usuario no está definida.";
            }
        } else {
            echo "Error al subir la foto de perfil.";
        }
    } else {
        echo "No se seleccionó ningún archivo para subir.";
    }
}
?>

    <br>
    <form method="POST" enctype="multipart/form-data">
      <input type="file" name="userphoto" required="" id="fotografia"><br>
      <input class="btn btn-info" type="submit" name="upphoto" value="Subir Fotografía">
    </form>
  </div>
</div>