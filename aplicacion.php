<?php
session_start();

require_once 'usuarios.php';

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
    exit;
}
$nombreDesarrollador = "Marius";
// Incluir la clase Usuarios y las funciones
require_once 'usuarios.php';

// Conectar a la base de datos (reemplaza con tus propios datos)
$db = new PDO('mysql:host=localhost;dbname=tarea4', 'usu4', 'usu4');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Crear una instancia de la clase Usuarios
$usuarios = new Usuarios($db);

// Obtener todos los usuarios
$listaUsuarios = $usuarios->obtenerTodosUsuarios();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Aplicación</title>
</head>
<body>
<h1>Bienvenido a la Aplicación</h1>
<p>Acceso correcto. Desarrollado por: <?php echo $nombreDesarrollador; ?></p>

<!-- Opciones de alta, modificación, eliminación y salir -->
<ul>
    <li><a href="alta_usuario.php">Dar de Alta Usuario</a></li>
    <li><a href="modificar_usuario.php">Modificar Datos de Usuario</a></li>
    <li><a href="eliminar_usuario.php">Eliminar Usuario</a></li>
</ul>

<form method="post" action="salir.php">
    <input type="submit" value="Salir">
</form>

<!-- Mostrar la tabla de usuarios -->
<h2>Usuarios Registrados</h2>
<table border="1">
    <thead>
    <tr>
        <th>ID</th>
        <th>Usuario</th>
        <th>Email</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($listaUsuarios as $usuario) : ?>
        <tr>
            <td><?php echo $usuario['id']; ?></td>
            <td><?php echo $usuario['usuario']; ?></td>
            <td><?php echo $usuario['email']; ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>

