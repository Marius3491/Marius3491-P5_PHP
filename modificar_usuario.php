<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
    exit;
}

// Incluir la clase Usuarios y las funciones
require_once 'usuarios.php';

// Conectar a la base de datos (reemplaza con tus propios datos)
$db = new PDO('mysql:host=localhost;dbname=tarea4', 'usu4', 'usu4');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Crear una instancia de la clase Usuarios
$usuarios = new Usuarios($db);

// Verificar si el formulario de modificación ha sido enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];

    // Lógica para modificar datos de usuario
    $usuarios->modificarUsuario($id, $usuario, $email);

    // Redirigir a la página principal después de modificar los datos
    header('Location: aplicacion.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Datos de Usuario</title>
</head>
<body>
<h1>Modificar Datos de Usuario</h1>

<!-- Formulario de modificación de usuario -->
<form method="post" action="">
    <label for="id">ID del Usuario:</label>
    <input type="text" name="id" required><br>
    <label for="usuario">Nuevo Usuario:</label>
    <input type="text" name="usuario" required><br>
    <label for="email">Nuevo Email:</label>
    <input type="email" name="email" required><br>
    <input type="submit" value="Modificar Datos">
</form>
</body>
</html>
