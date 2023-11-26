<?php 
  $corepage = explode('/', $_SERVER['PHP_SELF']);
    $corepage = end($corepage);
    if ($corepage!=='index.php') {
      if ($corepage==$corepage) {
        $corepage = explode('.', $corepage);
       header('Location: index.php?page='.$corepage[0]);
     }
    }
    
    $id = base64_decode($_GET['id']);
    $agfotografia = base64_decode($_GET['fotografia']);

	if (isset($_POST['estudianteactualizado'])) {
  	$nombre = $_POST['nombre'];
  	$codigo = $_POST['codigo'];
  	$direccion = $_POST['direccion'];
  	$telefono = $_POST['telefono'];
  	$grado = $_POST['grado'];
  	
  	if (!empty($_FILES['fotografia']['nombre'])) {
        $fotografia = $_FILES['fotografia']['nombre'];
	  	 $fotografia = explode('.', $fotografia);
		 $fotografia = end($fotografia); 
		 $fotografia = $rol.date('l-m-d-m-s').'.'.$fotografia;
		} else {
			$fotografia = $agfotografia;
		}
  	

  	$query = "UPDATE `estudiantes_info` SET `nombre`='$nombre',`codigo`='$codigo',`grado`='$grado',`direccion`='$direccion',`telefono`='$telefono',`ffotografia`='$fotografia' WHERE `id`= $id";
  	if (mysqli_query($db_con,$query)) {
  		$insertardatos['insertardatos'] = '<p style="color: green;">Estudiante Actualizado!</p>';
		if (!empty($_FILES['fotografia']['nombre'])) {
			move_uploaded_file($_FILES['fotografia']['tmp_nombre'], 'images/'.$fotografia);
			unlink('images/'.$agfotografia);
		}	
  		header('Location: index.php?page=estudiantet&editudiante=success');
  	}else{
  		header('Location: index.php?page=estudiante&editestuadiante=error');
  	}
  }
?>
<h1 class="text-primary"><i class="fas fa-user-plus"></i>  Editar Información de Estudiante<small class="text-warning"> Editar</small></h1>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
     <li class="breadcrumb-item" aria-current="page"><a href="index.php">Panel de Control </a></li>
     <li class="breadcrumb-item" aria-current="page"><a href="index.php?page=estudiantes">Todos los Estudiantes </a></li>
   
  </ol>
</nav>

	<?php
		if (isset($id)) {
			$query = "SELECT `id`, `nombre`, `codigo`, `grado`, `direccion`, `telefono`, `fotografia`, `fecha` FROM `estudiantes_info` WHERE `id`=$id";
			$resultado = mysqli_query($db_con,$query);
			if ($resultado) {
			$row = mysqli_fetch_array($resultado);
			 $class = isset($row['class']) ? $row['class'] : '';
		}else {
			// Manejar el caso donde la consulta no fue exitosa
			die('Error en la consulta: ' . mysqli_error($db_con));
		}
	}
	 ?>
<div class="row">
    <div class="col-sm-6">
        <form enctype="multipart/form-data" method="POST" action="">
            <div class="form-group">
                <label for="nombre">Nombre de Estudiante</label>
                <input name="nombre" type="text" class="form-control" id="nombre" value="<?php echo $row['nombre']; ?>" required="">
            </div>
            <div class="form-group">
                <label for="codigo">Número de Matrícula</label>
                <input name="codigo" type="text" class="form-control" pattern="[0-9]{6}" id="codigo" value="<?php echo $row['codigo']; ?>" required="">
            </div>
            <div class="form-group">
                <label for="direccion">Dirección de Estudiante</label>
                <input name="direccion" type="text" class="form-control" id="direccion" value="<?php echo $row['direccion']; ?>" required="">
            </div>
            <div class="form-group">
                <label for="telefono">Número de Contacto</label>
                <input name="telefono" type="text" class="form-control" id="telefono" value="<?php echo $row['telefono']; ?>" pattern="[0-9]+" placeholder="..." required="">
            </div>
            <div class="form-group">
                <label for="grado">Grado</label>
                <select name="grado" class="form-control" id="class" required="">
				<option>Select</option>
                    <option value="Primero" <?php echo $row['class'] == 'Primero' ? 'selected' : ''; ?>>Primero</option>
                    <option value="Segundo" <?php echo $row['class'] == 'Segundo' ? 'selected' : ''; ?>>Segundo</option>
                    <option value="Tercero" <?php echo $row['class']=='Tercero'? 'selected':''; ?>>Tercero</option>
                    <option value="Cuarto" <?php echo $row['class']=='Cuarto'? 'selected':''; ?>>Cuarto</option>
                    <option value="Quinto" <?php echo $row['class']=='Quinto'? 'selected':''; ?>>Quinto</option>
                    <option value="Sexto" <?php echo $row['class']=='Sexto'? 'selected':''; ?>>Sexto</option>
                </select>
            </div>
            <div class="form-group">
                <label for="fotografia">Fotografía</label>
                <input name="fotografia" type="file" class="form-control" id="fotografia">
            </div>
            <div class="form-group text-center">
                <input name="estudianteactualizado" value="Editar Estudiante" type="submit" class="btn btn-danger">
            </div>
        </form>
    </div>
</div>