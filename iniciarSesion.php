<?php

require_once('./controladores/funciones.php');
$email = '';
$password = '';
$errores = [];

if($_POST){

    $password = $_POST['password'];

    $bd = conexion('localhost', 'restaurant','root','');
    $errores = validarSesion($_POST);

    if(count($errores) === 0){
        $usuario = buscarPorEmail($bd,'users', $_POST['email']);

        if($usuario == false){
            $errores['password'] = 'Datos invaldios, Por favor revisar nuevamente';

        }else{
            if(password_verify($password, $usuario['password'])== false){
                $errores['password'] = 'Datos invalidos, revisar nuevamente';

            }else{

                activarSesion($usuario);
                if($_POST['remember']){
                    seteoCookies($usuario['email']);
                }
                header('location: index.php');
            }
            

        }
    }

}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión | NarutoFood</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

</head>

<body class="login-bg">
    <?php require_once('./partials/navbar.php') ?>

    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">

            <div class="col-lg-8 col-md-10">
                <div class="card shadow-lg login-card">

                    <div class="row g-0">

                        <!-- IMAGEN -->
                        <div class="col-md-5 login-img d-none d-md-block"></div>

                        <!-- FORMULARIO -->
                        <div class="col-md-7 bg-white p-5">

                            <h3 class="fw-bold text-center mb-4">Iniciar Sesión</h3>
                            <?php
                            if(count($errores) > 0):?> 
                                <ul class="alert alert-danger">
                                    <?php
                                    foreach ($errores as $index =>  $error) :?>
                                        <li><?=$error ?> </li>      
                                    <?php endforeach;?>
                                </ul>
                            <?php endif?>

                            <form method="POST">

                                <!-- EMAIL -->
                                <div class="mb-3">
                                    <label class="form-label">Correo</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                        <input type="email" name="email" class="form-control" placeholder="tuemail@ejemplo.com">
                                    </div>
                                </div>

                                <!-- CONTRASEÑA -->
                                <div class="mb-3">
                                    <label class="form-label">Contraseña</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                        <input type="password" name="password" class="form-control" placeholder="********">
                                    </div>
                                </div>

                                <!-- RECORDAR -->
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                    <label class="form-check-label" for="remember">Recordarme</label>
                                </div>

                                <!-- BOTÓN -->
                                <button type="submit" class="btn btn-danger w-100 fw-bold mb-3">
                                    <i class="bi bi-box-arrow-in-right me-2"></i> Iniciar Sesión
                                </button>

                                <div class="text-center">
                                    <small>¿No tienes cuenta?
                                        <a href="registrarUsuario.php" class="text-decoration-none">Registrarse</a>
                                    </small>
                                </div>

                            </form>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>