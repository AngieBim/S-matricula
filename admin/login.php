<?php
require_once 'db_con.php';
session_start();

if (isset($_SESSION['login'])) {
    header('Location: panel.php'); // Redirige a la página de panel si ya hay una sesión activa
    exit();
}

$input_arr = array();
$usuario = $contraseña = '';

if (isset($_POST['login'])) {
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];

    if (empty($usuario)) {
        $input_arr['input_user_error'] = "El usuario es necesario.";
    }

    if (empty($contraseña)) {
        $input_arr['input_pass_error'] = "La contraseña es necesaria.";
    }

    if (!empty($usuario) && !empty($contraseña)) {
        $query = "SELECT * FROM usuario WHERE nom_user = '$usuario' AND contraseña = '$contraseña' AND estado = 'activo'";
        $result = mysqli_query($db_con, $query);

        if (mysqli_num_rows($result) == 1) {
            // Usuario válido, iniciar sesión y redirigir al panel de control
            $_SESSION['login'] = $usuario;
            header('Location: panel.php');
            exit();
        } else {
            // Credenciales incorrectas o usuario inactivo
            $input_arr['usuario_no_existe'] = "Usuario o contraseña incorrectos.";
        }
    }
}
?>

<!doctype html>
<html lang="es">
<head>
    <!-- Meta etiquetas requeridas -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" />
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <title>Acceso Administrativo</title>
	<style>
    body {
        background-image: url('C:\xampp\htdocs\matriculas\admin\images\usuario1.jpg');  /* tu imagen de fondo */
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: center center;
        background-color: rgba(255, 255, 255, 0.7); /* Define la opacidad del fondo (en este caso, 0.7) */
    }
</style>
</head>
<body>
<div class="container"><br>
    <h1 class="text-center">Acceso Administrativo</h1><hr><br>
    <div class="d-flex justify-content-center">
        <?php if (isset($usuario_no_existe)) : ?>
            <div role="alert" aria-live="assertive" aria-atomic="true" align="center" class="toast alert alert-danger fade show" data-delay="2000"><?php echo $usuario_no_existe; ?></div>
        <?php endif; ?>
        <?php if (isset($contraseña_incorrecta)) : ?>
            <div role="alert" aria-live="assertive" aria-atomic="true" align="center" class="toast alert alert-danger fade show" data-delay="2000"><?php echo $contraseña_incorrecta; ?></div>
        <?php endif; ?>
        <?php if (isset($estado_inactivo)) : ?>
            <div role="alert" aria-live="assertive" aria-atomic="true" align="center" class="toast alert alert-danger fade show" data-delay="2000"><?php echo $estado_inactivo; ?></div>
        <?php endif; ?>
    </div>
    <div class="row animate__animated animate__pulse">
        <div class="col-md-4 offset-md-4">
            <form method="POST" action="">
                <div class="form-group row">
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="usuario" value="<?= htmlspecialchars($usuario); ?>" placeholder="Usuario" id="inputEmail3">
                        <?php echo isset($input_arr['input_user_error']) ? '<label>' . $input_arr['input_user_error'] . '</label>' : ''; ?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <input type="password" name="contraseña" class="form-control" id="inputPassword3" placeholder="Contraseña">
                        <?php echo isset($input_arr['input_pass_error']) ? '<label>' . $input_arr['input_pass_error'] . '</label>' : ''; ?>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" name="login" class="btn btn-warning">Ingresar</button>
                </div>
                <p>Si aún no tienes una cuenta de usuario, puedes <a href="registro.php">Registrarte aquí</a></p>
            </form>
			
        </div>
    </div>
</div>

<!-- JavaScript opcional -->
<!-- jQuery primero, luego Popper.js, luego Bootstrap JS -->
<script src="../js/jquery-3.5.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script type="text/javascript">
    $('.toast').toast('show')
</script>
</body>
</html>