<?php
session_start();
require_once "../config.php";

if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit();
}

$id = $_GET["id"] ?? null;

// Obtener datos del usuario
$stmt = $conexion->prepare("SELECT usuario FROM usuarios WHERE id = :id");
$stmt->bindParam(":id", $id);
$stmt->execute();
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    
<div class="container-fluid mt-4">
    <h2 class="text-center">Editar Usuario</h2>

    <div class="row justify-content-center">
        <div class="col-md-6 col-sm-12">
            <form action="../controllers/procesar_usuario.php" method="POST" class="shadow p-4 bg-white rounded">
                <input type="hidden" name="id" value="<?= $id; ?>">

                <div class="mb-3">
                    <label class="form-label">Usuario</label>
                    <input type="text" name="usuario" class="form-control" value="<?= htmlspecialchars($usuario["usuario"]); ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nueva Contraseña</label>
                    <input type="password" name="password" class="form-control">
                    <small class="text-muted">Deja en blanco si no deseas cambiar la contraseña</small>
                </div>

                <button type="submit" name="editar" class="btn btn-success btn-lg w-100">Guardar cambios</button>
            </form>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="usuarios.php" class="btn btn-secondary btn-lg w-50">Volver</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

