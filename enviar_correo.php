<?php
require_once('./controladores/funciones.php');


$bd = conexion('localhost', 'restaurant', 'root', '');

$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: index.php');
    exit;
}

$usuario = buscarUsuarioPorId($bd, 'users', $id);

if (!$usuario) {
    header('Location: index.php');
    exit;
}


$errores = [];

$correoEnviado = false;
$correoError   = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Validar correo
    if (empty($_POST['email'])) {
        $errores[] = "El correo es obligatorio";
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errores[] = "El correo no es válido";
    }

    // Validar mensaje
    if (empty($_POST['mensaje'])) {
        $errores[] = "El mensaje no puede estar vacío";
    }

    // Enviar correo si no hay errores
    if (empty($errores)) {

        if (enviarCorreo($_POST)) {
            $correoEnviado = true;
        } else {
            $correoError = true;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Enviar Correo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">

                <div class="card shadow-lg border-0">

                    <!-- HEADER -->
                    <div class="card-header bg-dark text-white text-center">
                        <h5 class="mb-0">
                            Enviar correo a <strong><?= $usuario['nombre'] . ' ' . $usuario['apellido'] ?></strong>
                        </h5>
                    </div>

                    <div class="card-body p-4">

                        <!-- ERRORES -->
                        <?php if (!empty($errores)) : ?>
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    <?php foreach ($errores as $error) : ?>
                                        <li><?= $error ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <form method="POST">

                            
                            <input type="hidden" name="email" value="<?= $usuario['email'] ?>">
                            <input type="hidden" name="nombre" value="<?= $usuario['nombre'] ?>">
                            <input type="hidden" name="apellido" value="<?= $usuario['apellido'] ?>">

                            <!-- CORREO -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Correo del usuario</label>
                                <input type="text" class="form-control" value="<?= $usuario['email'] ?>" disabled>
                            </div>

                            <!-- MENSAJE -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Mensaje personalizado</label>
                                <textarea name="mensaje" class="form-control" rows="6" placeholder="Escribe tu mensaje aquí..." required></textarea>
                            </div>

                            <!-- BOTONES -->
                            <div class="d-flex justify-content-between">
                                <a href="administrar.php" class="btn btn-outline-secondary">
                                    ← Volver
                                </a>

                                <button type="submit" class="btn btn-success px-4">
                                    Enviar correo
                                </button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="modalExito" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Correo enviado</h5>
                </div>

                <div class="modal-body text-center">
                    <p>El correo fue enviado correctamente.</p>
                    <p>¿Deseas volver al panel de administración?</p>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-success" onclick="window.location='administrar.php'">
                        Aceptar
                    </button>
                </div>

            </div>
        </div>
    </div>


    <!--MODAL - ERROR --->
    <div class="modal fade" id="modalError" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Error</h5>
                </div>

                <div class="modal-body text-center">
                    <p>Ocurrió un error al enviar el correo.</p>
                    <p>Inténtalo nuevamente.</p>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-danger" data-bs-dismiss="modal">
                        Cerrar
                    </button>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            <?php if ($correoEnviado): ?>
                new bootstrap.Modal(document.getElementById('modalExito')).show();
            <?php endif; ?>

            <?php if ($correoError): ?>
                new bootstrap.Modal(document.getElementById('modalError')).show();
            <?php endif; ?>

        });
    </script>

</body>

</html>