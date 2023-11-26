<?php
session_start();
if (isset($_SESSION['user_login'])) {
    if (isset($_GET['id']) && isset($_GET['foto'])) {
        $id = base64_decode($_GET['id']);
        $foto = base64_decode($_GET['foto']);
        
        if (mysqli_query($db_con, "DELETE FROM `estudiantes_info` WHERE `id` = '$id'")) {
            unlink('images/' . $foto);
            header('Location: index.php?page=estudiantes&eliminar=exitoso');
            exit();
        } else {
            header('Location: index.php?page=estudiantes&eliminar=error');
            exit();
        }
    } else {
        header('Location: index.php?page=estudiantes&eliminar=error');
        exit();
    }
} else {
    header('Location: login.php');
    exit();
}
?>