<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
</head>

<body>
    <!-- NAVBAR -->
    <?php require_once('./partials/navbar.php') ?>

    <!-- MAIN -->
    <!-- CONTENEDOR PRINCIPAL CON FONDO -->
    <div class="accesos-bg d-flex justify-content-center align-items-center" style="min-height: 100vh;">

        <div class="card shadow p-4 text-center" style="max-width: 350px; width: 100%;">

            <h4 class="fw-bold mb-4">Bienvenido</h4>

            <a href="iniciarSesion.php" class="btn btn-primary w-100 mb-3 d-flex align-items-center justify-content-center gap-2">
                <i class="bi bi-box-arrow-in-right"></i>
                Iniciar Sesión
            </a>

            <a href="registrarUsuario.php" class="btn btn-outline-primary w-100 d-flex align-items-center justify-content-center gap-2">
                <i class="bi bi-person-plus"></i>
                Registrarse
            </a>

        </div>

    </div>



    <!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>

</body>

</html>