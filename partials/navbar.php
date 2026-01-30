<?php
require_once('./controladores/funciones.php');



?>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container-fluid">

        <a class="navbar-brand" href="index.php">NARUTO</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <!-- Menú principal al lado del logo -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php#inicio">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php#menu">Menú</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php#comentarios">Comentarios</a>
                </li>
                <?php
                if (isset($_SESSION['nombre'])): ?>
                    <?php
                    if ($_SESSION['perfil'] === 9): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="administrar.php">Administrar</a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>

            <!-- LOGIN COMO UNA TARJETA CLICKEABLE -->
            <?php
            if (!isset($_SESSION['nombre'])): ?>

                <!-- Si NO hay sesión -->
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="accesos.php">
                            Iniciar sesión / Registrarse
                        </a>
                    </li>
                </ul>

            <?php else: ?>

                <!-- Si SÍ hay sesión activa -->
                <ul class="navbar-nav ms-auto">

                    <!-- Imagen del usuario -->
                    <li class="nav-item me-2">
                        <img
                            src="imagenes-food/<?= $_SESSION['imagen']; ?>"
                            alt="<?= strtoupper($_SESSION['nombre']); ?>"
                            style="width:40px; height:40px; border-radius:50%; object-fit:cover;">
                    </li>

                    <!-- Nombre del usuario -->
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">
                            <?= strtoupper($_SESSION['nombre'] . ' ' . $_SESSION['apellido']); ?>
                        </a>
                    </li>

                    <!-- Cerrar sesión -->
                    <li class="nav-item">
                        <a class="nav-link fw-bold cerrar-sesion" href="logout.php">
                            Cerrar sesión
                        </a>
                    </li>

                </ul>

            <?php endif; ?>


            <!-- BOTÓN Hacer pedido -->
            <a class="btn btn-pedido ms-3" href="index.php#form-plato">Hacer Pedido</a>

        </div>
    </div>
</nav>