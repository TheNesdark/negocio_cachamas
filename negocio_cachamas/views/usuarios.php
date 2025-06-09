<?php
session_start();
require_once "../config.php";
require_once "../controllers/verificar_acceso.php";


// Verificar acceso de administrador
if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit();
}

// Obtener lista de usuarios
$stmt = $conexion->query("SELECT id, usuario FROM usuarios ORDER BY id ASC");
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<?php include("header.php"); ?>

<div class="container-fluid mt-4">
    <h2 class="text-center mb-4">Gestión de Usuarios</h2>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-dark text-center">
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td class="text-center"><?= $usuario["id"]; ?></td>
                        <td><?= htmlspecialchars($usuario["usuario"]); ?></td>
                        <td class="text-center">
                            <a href="editar_usuario.php?id=<?= $usuario["id"]; ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="../controllers/procesar_usuario.php?eliminar=<?= $usuario["id"]; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar usuario?');">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="text-center mt-4">
        <a href="../index.php" class="btn btn-secondary btn-lg w-50">Volver al Inicio</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

