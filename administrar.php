<?php
$error = [];
require_once('./controladores/funciones.php');
if (!isset($_SESSION['nombre'])) {
    header('location: iniciarSesion.php');
} else {
    if ($_SESSION['perfil'] !== 9) {
        $error['perfil'] = 'no tienes permiso de administrador';
    }
}
$bd = conexion('localhost', 'restaurant', 'root', '');
$usuarios = buscarUsuariosPerfil($bd, 'users');



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <!-- NAVBAR -->
    <?php require_once('./partials/navbar.php') ?>

    <!-- TÍTULO -->
    <!-- CONTENIDO ADMIN -->
    <div class="bg-secondary min-vh-100 pt-5">
        <div class="container mt-5">

            <!-- BLOQUE ADMIN -->
            <div class="card shadow-lg">

                <!-- TÍTULO -->
                <div class="card-header text-center titulo-admin">
                    <h1 class="fw-light display-6 mb-0 text-dark">
                        Listado de Usuarios Registrados
                    </h1>
                </div>

                <!-- TABLA -->
                <div class="card-body p-4">
                    <table class="table table-striped table-bordered mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Correo</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($usuarios as $usuario) : ?>
                                <tr>
                                    <td><?= $usuario['id'] ?></td>
                                    <td><?= $usuario['nombre'] ?></td>
                                    <td><?= $usuario['apellido'] ?></td>
                                    <td><?= $usuario['email'] ?></td>
                                    <td>
                                        <a href="enviar_correo.php?id=<?= $usuario['id'] ?>"
                                            class="btn btn-primary btn-sm">
                                            Enviar Correo
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>


</body>


</html>