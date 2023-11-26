<?php
require_once 'db_con.php';
session_start();

$nombre = $email = $usuario = $contraseña = $c_contraseña = $foto_nombre = '';
$input_error = [];
$passlan = $email_error = $username_error = $usernamelan = '';

if (isset($_POST['registro'])) {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];
    $c_contraseña = $_POST['c_contraseña'];

    if (empty($nombre)) {
        $input_error['nombre'] = "Es necesario diligenciar el campo de Nombre";
    }
    if (empty($email)) {
        $input_error['email'] = "Es necesario diligenciar el campo de Correo";
    }
    if (empty($usuario)) {
        $input_error['usuario'] = "Debes diligenciar el campo de usuario";
    }
    if (empty($contraseña)) {
        $input_error['contraseña'] = "Debes diligenciar el campo de contraseña";
    }

    $foto = $_FILES['foto'];
    if (empty($foto['name'])) {
        $input_error['foto'] = "La fotografía es un campo requerido";
    } else {
        $foto_extension = pathinfo($foto['name'], PATHINFO_EXTENSION);
        $foto_nombre = $usuario . '.' . $foto_extension;
    }

    if (!empty($contraseña) && $c_contraseña !== $contraseña) {
        $input_error['notmatch'] = "Las contraseñas no coinciden";
    }

    if (count($input_error) == 0) {
        $check_email = mysqli_query($db_con, "SELECT * FROM `usuario` WHERE `email`='$email';");

        if (mysqli_num_rows($check_email) == 0) {
            $check_username = mysqli_query($db_con, "SELECT * FROM `usuario` WHERE `nom_user`='$usuario';");
            if (mysqli_num_rows($check_username) == 0) {
                if (strlen($usuario) < 8) {
                    $usernamelan = 'El nombre de usuario debe contener al menos 8 caracteres';
                } elseif (strlen($contraseña) < 8) {
                    $passlan = "La contraseña debe contener al menos 8 caracteres";
                } else {
                    $contraseña = sha1(md5($contraseña));
                    $query = "INSERT INTO `usuario`(`nombre`, `email`, `nom_user`, `contraseña`, `foto`, `estado`) VALUES ('$nombre', '$email', '$usuario', '$contraseña', '$foto_nombre', 'inactivo');";
                    $result = mysqli_query($db_con, $query);
                    if ($result) {
                        move_uploaded_file($foto['tmp_name'], 'images/' . $foto_nombre);
                        header('Location: registro.php?insert=exitoso');
                    } else {
                        header('Location: registro.php?insert=error');
                    }
                }
            } else {
                $username_error = "Este usuario ya fue utilizado, intenta con uno diferente";
            }
        } else {
            $email_error = "El correo ya existe en la base de datos";
        }
    }
}
?>

<!doctype html>
<html lang="es">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"/>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <title>Registro de Usuarios</title>
</head>
<body>
<div class="container"><br>
    <h1 class="text-center">Registro de Usuarios</h1><hr><br>
    <div class="d-flex justify-content-center">
        <?php
        if (isset($_GET['insert'])) {
            if ($_GET['insert'] == 'exitoso') {
                echo '<div role="alert" aria-live="assertive" aria-atomic="true" align="center" class="toast alert alert-success fade hide" data-delay="2000">Tus datos han sido ingresados exitósamente</div>';
            }
        }
        ;?>
    </div>
    <div class="row animate__animated animate__pulse">
        <div class="col-md-8 offset-md-2">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group row">
                    <div class="col-sm-6">
                        <input type="text" class="form-control" value="<?= $nombre ?>" name="nombre" placeholder="Nombre" id="inputEmail3">
                        <?= isset($input_error['nombre']) ? '<label for="inputEmail3" class="error">' . $input_error['nombre'] . '</label>' : ''; ?>
                    </div>
                    <div class="col-sm-6">
                        <input type="email" class="form-control" value="<?= $email ?>" name="email" placeholder="Correo" id="inputEmail3">
                        <?= isset($input_error['email']) ? '<label class="error">' . $input_error['email'] . '</label>' : ''; ?>
                        <?= $email_error ? '<label class="error">' . $email_error . '</label>' : ''; ?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <input type="text" name="usuario" value="<?= $usuario ?>" class="form-control" id="inputPassword3" placeholder="Usuario">
                        <?= isset($input_error['usuario']) ? '<label class="error">' . $input_error['usuario'] . '</label>' : ''; ?>
                        <?= $username_error ? '<label class="error">' . $username_error . '</label>' : ''; ?>
                        <?= $usernamelan ? '<label class="error">' . $usernamelan . '</label>' : ''; ?>
                    </div>
                    <div class="col-sm-4">
                        <input type="password" name="contraseña" class="form-control" id="inputcontraseña" placeholder="Contraseña">
                        <?= isset($input_error['contraseña']) ? '<label class="error">' . $input_error['contraseña'] . '</label>' : ''; ?>
                        <?= $passlan ? '<label class="error">' . $passlan . '</label>' : ''; ?>
                    </div>
                    <div class="col-sm-4">
                        <input type="password" name="c_contraseña" class="form-control" id="inputPassword3" placeholder="Confirmar Contraseña">
                        <?= isset($input_error['notmatch']) ? '<label class="error">' . $input_error['notmatch'] . '</label>' : ''; ?>
                        <?= $passlan ? '<label class="error">' . $passlan . '</label>' : ''; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3"><label for="photo">Escoge tu fotografía</label></div>
                    <div class="col-sm-9">
                        <input type="file" id="foto" name="foto" class="form-control" id="inputPassword3">
                        <br>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" name="registro" class="btn btn-danger">Registro</button>
                </div>
            </form>
        </div>
    </div>
    <p>Si tienes una cuenta de acceso administrativo, puedes <a href="login.php">Ingresar Aquí</a></p>
</div>
<br><br><br><br><br><br>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="../js/jquery-3.5.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script type="text/javascript">
    $('.toast').toast('show')
</script>
</body>
</html>