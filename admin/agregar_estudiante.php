<?php 
$corepage = explode('/', $_SERVER['PHP_SELF']);
$corepage = end($corepage);
if ($corepage !== 'index.php') {
    $corepage = explode('.', $corepage);
    header('Location: index.php?page=' . $corepage[0]);
}

if (isset($_POST['agregar_estudiante'])) {
    // Verifica si los índices existen antes de acceder a ellos
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $codigo = isset($_POST['codigo']) ? $_POST['codigo'] : '';
    $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : '';
    $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
    $grado = isset($_POST['grado']) ? $_POST['grado'] : '';

    // Accede al nombre del archivo desde $_FILES['foto']['name']
    $fotografia = explode('.', $_FILES['foto']['name']);
    $fotografia = end($fotografia); 
    $fotografia = $codigo . '-' . date('d-m-Y') . '.' . $fotografia;
    $query = "INSERT INTO `estudiantes_info`(`nombre`, `codigo`, `grado`, `direccion`, `telefono`, `fotografia`) VALUES ('$nombre', '$codigo', '$grado', '$direccion', '$telefono', '$fotografia');";

    if (mysqli_query($db_con, $query)) {
        $inserdato['insertsucess'] = '<p style="color: green;">Estudiante Ingresado Exitosamente</p>';
        move_uploaded_file($_FILES['foto']['tmp_name'], 'images/' . $fotografia);
    } else {
        $inserdato['inserterror'] = '<p style="color: red;">Estudiante no ingresado, revise la información.</p>';
    }
}
?>
<h1 class="text-primary"><i class="fas fa-user-plus"></i> Agregar Estudiante<small class="text-warning"></small></h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item" aria-current="page"><a href="index.php">Panel de Control</a></li>
        <li class="breadcrumb-item active" aria-current="page">Agregar Estudiante</li>
    </ol>
</nav>

<div class="row">
    <div class="col-sm-6">
        <?php if (isset($inserdato)) {?>
        <div role="alert" aria-live="assertive" aria-atomic="true" class="toast fade" data-autohide="true" data-animation="true" data-delay="2000">
            <div class="toast-header">
                <strong class="mr-auto">Ingresar Estudiantes</strong>
                <small><?php echo date('l-M-M-J-V'); ?></small>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                <?php 
                if (isset($inserdato['insertsucess'])) {
                    echo $inserdato['insertsucess'];
                }
                if (isset($inserdato['inserterror'])) {
                    echo $inserdato['inserterror'];
                }
                ?>
            </div>
        </div>
        <?php } ?>
        <form enctype="multipart/form-data" method="POST" action="">
            <div class="form-group">
                <label for="nombre">Nombre de Estudiante</label>
                <input name="nombre" type="text" class="form-control" id="nombre" value="<?= isset($nombre) ? $nombre : ''; ?>" required="">
            </div>
            <div class="form-group">
                <label for="codigo">Codigo de Matrícula</label>
                <input name="codigo" type="text" value="<?= isset($codigo) ? $codigo : ''; ?>" class="form-control" pattern="[0-9]{6}" id="codigo" required="">
            </div>
            <div class="form-group">
                <label for="direccion">Direccion de Estudiante</label>
                <input name="direccion" type="text" class="form-control" id="direccion" value="<?= isset($_POST['direccion']) ? $_POST['direccion'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono de Contacto</label>
                 <input name="telefono" type="text" class="form-control" id="telefono" pattern="^\[0-9]{9}$" value="<?= isset($telefono) ? $telefono : ''; ?>" placeholder="........" required="">
            </div>
            <div class="form-group">
                <label for="grado">Grado Estudiantil</label>
                <select name="grado" class="form-control" id="grado" required="">
                    <option>Selecciona</option>
                    <option value="Primero">Primero</option>
                    <option value="Segundo">Segundo</option>
                    <option value="Tercero">Tercero</option>
                    <option value="Cuarto">Cuarto</option>
                    <option value="Quinto">Quinto</option>
                    <option value="Sexto">Sexto</option>
                </select>
            </div>
            <div class="form-group">
                <label for="fotografia">Fotografía de Estudiante</label>
                <input name="foto" type="file" class="form-control" id="fotografia" required="">
            </div>
            <div class="form-group text-center">
            <input name="agregar_estudiante" value="Agregar Estudiante" type="submit" class="btn btn-danger">
            </div>
        </form>
    </div>
</div>