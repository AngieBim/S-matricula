<?php
$corepage = explode('/', $_SERVER['PHP_SELF']);
$corepage = end($corepage);
if ($corepage !== 'index.php') {
    $corepage = explode('.', $corepage);
    header('Location: index.php?page=' . $corepage[0]);
}

$id = base64_decode($_GET['id']);

if (isset($_POST['edit_user'])) {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];

    $query = "UPDATE `usuario` SET `nombre`='$nombre', `email`='$email' WHERE `id` = $id";

    if (mysqli_query($db_con, $query)) {
        $insertardatos['insertardatos'] = '<p style="color: green;">Usuario actualizado exitosamente</p>';
        header('Location: index.php?page=user-profile&edit=success');
        exit();
    } else {
        header('Location: index.php?page=user-profile&edit=error');
        exit();
    }
}
?>
<h1 class="text-primary"><i class="fas fa-user-plus"></i> Editar Información de Usuario<small class="text-warning"> Editar Usuario</small></h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item" aria-current="page"><a href="index.php">Panel de Control</a></li>
        <li class="breadcrumb-item" aria-current="page"><a href="index.php?page=user-profile">Perfil de Usuario</a></li>
        <li class="breadcrumb-item active" aria-current="page">Editar Perfil de Usuario</li>
    </ol>
</nav>

<?php
if (isset($id)) {
    $query = "SELECT `nombre`, `email` FROM `usuario` WHERE `id` = $id";
    $result = mysqli_query($db_con, $query);
    $row = mysqli_fetch_array($result);
}
?>
<div class="row">
    <div class="col-sm-6">
        <form enctype="multipart/form-data" method="POST" action="">
            <div class="form-group">
                <label for="nombre">Nombre Completo</label>
                <input name="nombre" type="text" class="form-control" id="nombre" value="<?php echo $row['nombre']; ?>" required="">
            </div>
            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input name="email" type="email" class="form-control" id="email" value="<?php echo $row['email']; ?>" required="">
            </div>

            <div class="form-group text-center">
                <input name="edit_user" value="Actualizar Perfil" type="submit" class="btn btn-danger">
            </div>
        </form>
    </div>
</div>