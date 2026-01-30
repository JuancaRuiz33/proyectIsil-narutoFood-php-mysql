<?php
require_once('./controladores/funciones.php');
$bd = conexion('localhost', 'restaurant', 'root', '');


$nombre = '';
$apellido = '';
$email = '';
$clave = '';
$confirmar = '';
$errores = [];

if ($_POST) {

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $clave = $_POST['password'];
    $confirmar = $_POST['confirmar'];
    $errores = validarRegistroPerfil($_POST);

    if (count($errores) === 0) {
        $imagen = cargarImagenPerfil($_FILES);

        guardarUsuariosPerfil($bd, 'users', $_POST, $imagen);
    }
}

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro | NarutoFood</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

</head>

<body class="page-bg">

    <?php require_once('./partials/navbar.php') ?>

    <div class="container mt-5 pt-5">
        <div class="row justify-content-center align-items-center min-vh-100">

            <div class="col-lg-8 col-md-10">
                <div class="card shadow-lg register-card">

                    <div class="row g-0">

                        <!-- IMAGEN A LA IZQUIERDA -->
                        <div class="col-md-5 register-img d-none d-md-block"></div>

                        <!-- FORMULARIO -->
                        <div class="col-md-7 bg-white p-5">

                            <h3 class="fw-bold text-center mb-4">Crear Cuenta</h3>
                            <?php
                            if (count($errores) > 0): ?>
                                <ul class="alert alert-danger">
                                    <?php
                                    foreach ($errores as $index =>  $error) : ?>
                                        <li><?= $error ?> </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif ?>

                            <form action="" method="POST" enctype="multipart/form-data">

                                <!-- SUBIR FOTO -->
                                <div class="mb-4 text-center">
                                    <label class="form-label d-block">Foto de perfil</label>
                                    <input type="file" class="form-control" name="perfil" accept="image/*">
                                </div>

                                <!-- NOMBRE -->
                                <div class="mb-3">
                                    <label class="form-label">Nombre</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                                        <input type="text" name="nombre" class="form-control" placeholder="Ej. Naruto" value="<?= $nombre ?>">
                                    </div>
                                </div>

                                <!-- APELLIDO -->
                                <div class="mb-3">
                                    <label class="form-label">Apellido</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                                        <input type="text" name="apellido" class="form-control" placeholder="Ej. Uzumaki" value="<?= $apellido ?>">
                                    </div>
                                </div>

                                <!-- EMAIL -->
                                <div class="mb-3">
                                    <label class="form-label">Correo</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                        <input type="email" name="email" class="form-control" placeholder="naruto@konoha.com" value="<?= $email ?>">
                                    </div>
                                </div>

                                <!-- CONTRASEÑA -->
                                <div class="mb-4">
                                    <label class="form-label">Contraseña</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                        <input type="password" name="password" class="form-control" placeholder="Mínimo 8 caracteres">
                                    </div>
                                </div>

                                <!-- CONFIRMAR CONTRASEÑA -->
                                <div class="mb-4">
                                    <label class="form-label">Confirmar contraseña</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                        <input type="password" name="confirmar" class="form-control" placeholder="Repite tu contraseña">
                                    </div>
                                </div>

                                <!-- BOTÓN -->
                                <button type="submit" class="btn btn-danger w-100 fw-bold">
                                    <i class="bi bi-person-plus me-2"></i> Registrarse
                                </button>

                                <div class="text-center mt-3">
                                    <small>¿Ya tienes cuenta? <a href="iniciarSesion.php" class="text-decoration-none">Inicia sesión</a></small>
                                </div>

                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- BOOTSTRAP SCRIPTS -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>

</body>

</html>