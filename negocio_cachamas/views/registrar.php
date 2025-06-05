<?php
require_once "../config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $stmt = $conexion->prepare("INSERT INTO usuarios (usuario, password) VALUES (:usuario, :password)");
    $stmt->bindParam(":usuario", $usuario);
    $stmt->bindParam(":password", $password);

    if ($stmt->execute()) {
        header("Location: login.php?mensaje=Registro exitoso");
        exit();
    } else {
        echo "Error al registrar usuario.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<?php include("header.php"); ?>

<div class="container-fluid d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg p-4 rounded" style="max-width: 400px; width: 100%;">
        <h3 class="text-center mb-3">Registro de Usuario</h3>

        <form method="POST" class="d-flex flex-column gap-3">
            <div>
                <label for="usuario" class="form-label">Usuario</label>
                <input type="text" name="usuario" class="form-control" placeholder="Ingrese un nombre de usuario" required>
            </div>
            <div>
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" name="password" class="form-control" placeholder="Ingrese una contraseña segura" required>
                <small class="text-muted">Debe contener al menos 8 caracteres</small>
            </div>
            <button type="submit" class="btn btn-success btn-lg w-100">Registrarse</button>
        </form>

        <div class="text-center mt-3">
            <a href="../index.php" class="text-decoration-none text-muted">Volver al inicio</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


