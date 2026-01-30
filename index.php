<?php
require_once('./controladores/funciones.php');
$bd = conexion('localhost', 'restaurant', 'root', '');

$nombre = '';
$descripcion = '';
$precio = '';
$descuento = '';
$errores = [];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();

    if (!isset($_SESSION['nombre'])) {
        echo "<script>alert('Debes iniciar sesión o registrarte antes de guardar un plato');</script>";
        echo "<script>window.location.href='iniciarSesion.php';</script>";
        exit;
    }

    $nombre = $_POST['nombre_plato'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $descuento = $_POST['descuento'];

    $errores = validarRegistro($_POST);

    if (count($errores) === 0) {
        $imagen = cargarImagen($_FILES);
        guardarUsuarios($bd, 'dishes', $_POST, $imagen);
    }
}




?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Naruto Ramen</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <?php require_once('./partials/navbar.php') ?>

    <!-- === SECCIÓN HERO === -->
    <section class="banner-hero" id="inicio">
        <div class="container hero-content text-start">
            <h3>Descubre nuestra</h3>
            <h1>esencia</h1>
            <button class="btn btn-red mt-3">IR A LA CARTA →</button>
        </div>
    </section>

    <!-- === MENÚ DESTACADO === -->
    <section class="menu-section" id="menu">
        <div class="container">
            <h2>Nuestros menús destacados</h2>
            <div class="row g-4 justify-content-center">

                <div class="col-md-3">
                    <div class="card text-center p-3">
                        <img src="img/yakitori-3795433_1280.jpg" class="card-img-top rounded" alt="Yakitori">
                        <div class="card-body">
                            <h5 class="card-title">Yakitori</h5>
                            <p class="card-text">Brochetas de pollo bañadas en salsa teriyaki.</p>
                            <p class="fw-bold">S/. 22.00</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card text-center p-3">
                        <img src="img/shrimp-tempura-4665687_1280.jpg" class="card-img-top rounded" alt="Ebi Furay">
                        <div class="card-body">
                            <h5 class="card-title">Ebi Furay</h5>
                            <p class="card-text">Langostinos empanizados con salsa tártara.</p>
                            <p class="fw-bold">S/. 42.90</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card text-center p-3">
                        <img src="img/bars-ramen-in-saigon-3227779_1280.jpg" class="card-img-top rounded"
                            alt="Ramen">
                        <div class="card-body">
                            <h5 class="card-title">Ramen</h5>
                            <p class="card-text"> fideos de trigo, caldo concentrado de carne (cerdo, pollo) o vegetal y salsa de soya o miso.</p>
                            <p class="fw-bold">S/. 40.00</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center p-3">
                        <img src="img/sushi-5699481_1280.jpg" class="card-img-top rounded"
                            alt="Sushi">
                        <div class="card-body">
                            <h5 class="card-title">Ramen</h5>
                            <p class="card-text"> Arroz condimentado con vinagre de arroz, azúcar y sal, combinado con pescado crudo o cocido, mariscos, verduraspescado crudo o cocido, mariscos, verduras</p>
                            <p class="fw-bold">S/. 40.00</p>
                        </div>
                    </div>
            </div>
        </div>
    </section>

    <!-- === SECCIÓN FORMULARIO DE PLATO === -->
    <section id="form-plato" class="py-5">
        <div class="container">
            <div class="row shadow-lg rounded overflow-hidden">

                <!-- LADO IZQUIERDO -->
                <div class="col-md-5 bg-dark text-light d-flex align-items-center justify-content-center p-4">
                    <div>
                        <h3 class="fw-bold mb-3 text-success">
                            <i class="bi bi-cup-hot-fill me-2"></i> NARUTO FOOD
                        </h3>
                        <p class="mb-2">
                            <i class="bi bi-geo-alt-fill text-success me-2"></i> Calle Samurai N°108 - Lima</p>
                        <p class="mb-2">
                            <i class="bi bi-telephone-fill text-success me-2"></i> +51 999 222 444</p>
                        <p><i class="bi bi-envelope-fill text-success me-2"></i> contacto@ramenhouse.pe</p>
                    </div>
                </div>

                <!-- FORMULARIO -->
                <div class="col-md-7 bg-white p-5">
                    <h2 class="text-center mb-4 fw-bold text-uppercase">Agregar Nuevo Plato</h2>

                    <?php if (count($errores) > 0): ?>
                        <ul class="alert alert-danger shadow-sm">
                            <?php foreach ($errores as $error): ?>
                                <li><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif ?>

                    <form action="index.php#form-plato" method="POST" enctype="multipart/form-data">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nombre del plato</label>
                            <input type="text" class="form-control border-secondary" name="nombre_plato" value="<?= $nombre ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Descripción</label>
                            <textarea class="form-control border-secondary" rows="3" name="descripcion"><?= $descripcion ?></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Precio (S/.)</label>
                                <input type="number" class="form-control border-secondary" name="precio" value="<?= $precio ?>">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Descuento</label>
                                <select class="form-select border-secondary" name="descuento">
                                    <option value="">Seleccione</option>
                                    <option value="0" <?= ($descuento == '0') ? 'selected' : '' ?>>Sin descuento</option>
                                    <option value="10" <?= ($descuento == '10') ? 'selected' : '' ?>>10%</option>
                                    <option value="15" <?= ($descuento == '15') ? 'selected' : '' ?>>15%</option>
                                    <option value="20" <?= ($descuento == '20') ? 'selected' : '' ?>>20%</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Imagen del plato *</label>
                            <input type="file" class="form-control border-secondary" name="imagen" onchange="previewImage(event)">
                        </div>

                        <div class="text-center mb-3">
                            <img id="img-preview" class="img-fluid rounded shadow-sm" style="max-height: 180px;">
                        </div>

                        <button type="submit" class="btn btn-success w-100 py-2 fw-semibold">Guardar Plato</button>
                    </form>
                </div>

            </div>
        </div>
    </section>

    <!-- Testimonios -->
    <section class="py-5" id="comentarios">
        <div class="container">
            <h2 class="text-center mb-5 display-5 fw-bold">Lo que dicen nuestros clientes</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <img src="img/perfil1.avif" class="rounded-circle mb-3" width="80" alt="Cliente 1">
                            <h5 class="card-title">María González</h5>
                            <div class="text-warning mb-3">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                            </div>
                            <p class="card-text">"La comida llegó caliente y en perfecto estado. ¡Excelente servicio!"</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <img src="img/perfil2.avif" class="rounded-circle mb-3" width="80" alt="Cliente 2">
                            <h5 class="card-title">Juan Pérez</h5>
                            <div class="text-warning mb-3">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-half"></i>
                            </div>
                            <p class="card-text">"Muy fácil de usar la app y la comida siempre deliciosa. Lo recomiendo."</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <img src="img/perfil3.png" class="rounded-circle mb-3" width="80" alt="Cliente 3">
                            <h5 class="card-title">Laura Martínez</h5>
                            <div class="text-warning mb-3">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                            </div>
                            <p class="card-text">"Los tiempos de entrega son exactos y la presentación impecable. ¡Genial!"</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-3 mb-md-0">
                    <h5 class="fw-bold mb-3">NARUTO</h5>
                    <p>Llevando los sabores de tu restaurante Japones favorito directamente a tu hogar.</p>
                    <div class="social-icons">
                        <a href="#" class="text-white me-2"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="text-white me-2"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="text-white me-2"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>
                <div class="col-md-2 mb-3 mb-md-0">
                    <h5 class="fw-bold mb-3">Enlaces</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#inicio" class="text-white text-decoration-none">Inicio</a></li>
                        <li class="mb-2"><a href="#menu" class="text-white text-decoration-none">Menú</a></li>
                        <li class="mb-2"><a href="#pedido" class="text-white text-decoration-none">Pedido</a></li>
                        <li class="mb-2"><a href="#contacto" class="text-white text-decoration-none">Comentarios</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <h5 class="fw-bold mb-3">Horario</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">Lunes a Viernes: 10am - 10pm</li>
                        <li class="mb-2">Sábado: 11am - 11pm</li>
                        <li class="mb-2">Domingo: 11am - 9pm</li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5 class="fw-bold mb-3">Descarga nuestra app</h5>
                    <div class="d-flex flex-column">
                        <a href="#" class="btn btn-outline-light mb-2">
                            <i class="bi bi-apple me-2"></i>App Store
                        </a>
                        <a href="#" class="btn btn-outline-light">
                            <i class="bi bi-google-play me-2"></i>Google Play
                        </a>
                    </div>
                </div>
            </div>
            <hr class="my-4">
            <div class="text-center">
                <p class="mb-0">&copy; 2025 NARUTO Food. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="js/script.js"></script>
</body>

</html>