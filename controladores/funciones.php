<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './librerias/PHPMailer/src/Exception.php';
require './librerias/PHPMailer/src/PHPMailer.php';
require './librerias/PHPMailer/src/SMTP.php';


function conexion($host, $bd, $user, $password)
{
    try {
        $db = new PDO("mysql:host=$host; dbname=$bd", $user, $password);
        return $db;
    } catch (PDOException $error) {
        echo '<h2 style="color:red;">Ufff ha ocurrido un error: ' . $error->getMessage() . '</h2>';
    }
}

function guardarUsuarios($bd, $tabla, $datos, $imagen)
{

    // Datos del formulario
    $nombre = $datos['nombre_plato'];
    $descripcion = $datos['descripcion'];
    $precio = $datos['precio'];
    $descuento = $datos['descuento'];

    // Llamamos a la función que carga la imagen y devuelve el nombre del archivo
    $imagen = $imagen;

    // Sentencia SQL
    $sql = "INSERT INTO $tabla (name, description, price, discount, image)
            VALUES (:name, :description, :price, :discount, :image)";

    $query = $bd->prepare($sql);
    $query->bindValue(':name', $nombre);
    $query->bindValue(':description', $descripcion);
    $query->bindValue(':price', $precio);
    $query->bindValue(':discount', $descuento);
    $query->bindValue(':image', $imagen);

    $query->execute();
    header('location: exito.php');
}

function validarRegistro($datos)
{
    $nombre = $datos['nombre_plato'] ?? '';
    $descripcion = $datos['descripcion'] ?? '';
    $precio = $datos['precio'] ?? '';
    $descuento = $datos['descuento'] ?? '';
    $errores = [];

    if ($nombre === '') {
        $errores['nombre_plato'] = 'El campo nombre no puede estar vacío';
    }

    if ($descripcion === '') {
        $errores['descripcion'] = "La descripción es obligatoria.";
    }
    if ($precio === '') {
        $errores['precio'] = "El precio es obligatorio.";
    }
    if ($descuento === '') {
        $errores['descuento'] = "El descuento es obligatorio.";
    }

    // Validación precio entre 30 y 190
    if ($precio !== '' && ($precio < 30 || $precio > 190)) {
        $errores['precio'] = "El precio debe estar entre 30 y 190 soles.";
    }

    if (!isset($_FILES['imagen']) || $_FILES['imagen']['error'] === UPLOAD_ERR_NO_FILE) {
        $errores['imagen'] = "Debe seleccionar una imagen del plato.";
    }

    return $errores;
}



function cargarImagen($imagen)
{
    $foto = $imagen['imagen']['name'];
    $ext = pathinfo($foto, PATHINFO_EXTENSION);

    $archivoOrigen = $imagen['imagen']['tmp_name'];

    $nombreArchivo = uniqid('imagen-') . '.' . $ext;

    $ruta = dirname(__DIR__) . '/imagenes-food/';
    if (!file_exists($ruta)) {
        mkdir($ruta, 0777, true);
    }

    $archivoDestino = $ruta . $nombreArchivo;

    move_uploaded_file($archivoOrigen, $archivoDestino);

    return $nombreArchivo;
}



//===========REGISTRO Y INICIAR SESION===================================
function guardarUsuariosPerfil($bd, $table, $datos, $imagen)
{

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $clave = password_hash($datos['password'], PASSWORD_DEFAULT);
    $imagen = $imagen;

    $perfil = 2;

    $sql = "insert into $table (nombre, apellido, email, password, perfil, imagen) values(:nombre, :apellido, :email, :password, :perfil, :imagen)";
    $query = $bd->prepare($sql);

    $query->bindValue(':nombre', $nombre);
    $query->bindValue(':apellido', $apellido);
    $query->bindValue(':email', $email);
    $query->bindValue(':password', $clave);
    $query->bindValue(':perfil', $perfil);
    $query->bindValue(':imagen', $imagen);


    $query->execute();
    header('location: iniciarSesion.php');
}
function buscarUsuariosPerfil($bd, $tabla)
{
    $sql = "Select * from $tabla";

    $query = $bd->prepare($sql);

    $query->execute();

    $usuarios = $query->fetchAll(PDO::FETCH_ASSOC);

    return $usuarios;
}

function buscarUsuarioPorId($bd, $tabla, $id)
{
    $sql = "SELECT * FROM $tabla WHERE id = :id";
    $query = $bd->prepare($sql);
    $query->bindValue(':id', $id);
    $query->execute();

    $usuarios = $query->fetch(PDO::FETCH_ASSOC);

    return $usuarios;
}

function validarRegistroPerfil($datos)
{
    $nombre = $datos['nombre'];
    $apellido = $datos['apellido'];
    $email = $datos['email'];
    $clave = $datos['password'];
    $confirmar = $datos['confirmar'];
    $errores = [];

    if ($nombre === '') {
        $errores['nombre'] = 'El campo nombre no puede estar vacio';
    }
    if ($apellido === '') {
        $errores['apellido'] = 'El campo apellido no puede estar vacio';
    }
    if ($email === '') {
        $errores['email'] = 'El correo es obligatorio';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores['email'] = 'El formato del correo no es valido';
    }
    if ($clave === '') {
        $errores['password'] = 'La contraseña es obligatorio';
    } else if (strlen($clave) < 8) {
        $errores['password'] = 'la contraseña debe tener minimo 8 caracteres';
    }

    if ($confirmar === '') {
        $errores['confirmar'] = 'Debes confirmar tu contraseña';
    } else if (strlen($confirmar) < 8) {
        $errores['confirmar'] = 'La confirmación debe tener mínimo 8 caracteres';
    }
    if ($clave !== '' && $confirmar !== '' && $clave !== $confirmar) {
        $errores['coinciden'] = 'Las contraseñas no coinciden';
    }

    return $errores;
}

function buscarUsuario($bd, $tabla, $id) {}

function cargarImagenPerfil($imagen)
{
    $avatar = $imagen['perfil']['name'];
    //dd($avatar);
    $ext = pathinfo($avatar, PATHINFO_EXTENSION);

    $archivoOrigen = $imagen['perfil']['tmp_name'];

    $nombreArchivo = uniqid('avatar-') . '.' . $ext;

    $ruta = dirname(__DIR__) . '/imagenes-food/';

    $archivoDestino = $ruta . $nombreArchivo;

    move_uploaded_file($archivoOrigen, $archivoDestino);
    return $nombreArchivo;
}

function validarSesion($datos)
{
    $email = $datos['email'];
    $password = $datos['password'];
    $errores = [];
    if ($email === '') {
        $errores['email'] = 'Datos invalidos, revisar nuevamente';
    } else if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $errores['email'] = 'datos invalidos, revise nuevamente';
    }

    if ($password == '') {
        $errores['password'] = 'Datos invalidos, revise nuevamente';
    }
    return $errores;
}

function buscarEmail($bd, $tabla, $datos)
{
    $email = $datos['email'];
    $sql = "SELECT * FROM $tabla WHERE email = '$email'";
    $query = $bd->prepare($sql);
    $query->execute();
    $usuario = $query->fetch(PDO::FETCH_ASSOC);

    return $usuario;
}

function buscarPorEmail($bd, $tabla, $email)
{
    $recibidoEmail = $email;
    $sql = "select * from $tabla where email = :email";

    $query = $bd->prepare($sql);
    $query->bindValue(':email', $recibidoEmail);
    $query->execute();

    $usuario = $query->fetch(PDO::FETCH_ASSOC);
    return $usuario;
}
function activarSesion($datos)
{
    $_SESSION['nombre'] = $datos['nombre'];
    $_SESSION['apellido'] = $datos['apellido'];
    $_SESSION['perfil'] = $datos['perfil'];
    $_SESSION['imagen'] = $datos['imagen'];
}

function seteoCookies($email)
{

    setcookie('email', $email, time() + 3600);
}
function controlAcceso()
{
    if (!isset($_COOKIE['email'])) {
        return false;
    } else {
        if (isset($_COOKIE['email'])) {
            $email = $_COOKIE['email'];

            $bd = conexion('localhost', 'restaurant', 'root', '');
            $usuario = buscarPorEmail($bd, 'users', $email);

            activarSesion($usuario);
            return true;
        }
    }
}

function enviarCorreo($datos)
{


    $nombreCompleto = $datos['nombre'] . ' ' . $datos['apellido'];
    $correo = $datos['email'];
    $mensaje = $datos['mensaje'];

    $mail = new PHPMailer(true);

    try {
        
        // Configuración SMTP
        $mail->SMTPDebug = 0;
        $mail->Debugoutput = 'html';

        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'ruizjuanca2001@gmail.com';
        $mail->Password   = 'holmamalmdzuraif';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Remitente y destinatario
        $mail->setFrom('ruizjuanca2001@gmail.com', 'Juan Ruiz Lazo');
        $mail->addAddress($correo, $nombreCompleto);

        // Contenido
        $mail->isHTML(true);
        $mail->Subject = 'Gracias por el Registro';

        $mail->Body = "
            <h3>Hola, muy buenas dias $nombreCompleto</h3>
            <p>$mensaje</p>
            <hr>
            <small>Atentamente: </small>
            <ul>
                <li>Juan Carlos Ruiz Lazo</li>
                <li>NCR 1063 - Programacion Web I</li>
            </ul>
            <h5>que tenga un buen navidad y prospero año nuevo. SALUDOS.. </h5>
        ";

        //$mail->AltBody = $mensaje;

        $mail->send();
        return true;
    } catch (Exception $e) {

        echo "<pre>";
        echo "ERROR REAL: " . $mail->ErrorInfo;
        echo "</pre>";
        exit; 
    }



    function dd($valor){
        echo '<pre>';
            var_dump($valor);
            exit;
        echo '</pre>';
    }
}
