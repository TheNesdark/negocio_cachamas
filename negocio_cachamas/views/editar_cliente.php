<?php
require_once "../config.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conexion->prepare("SELECT * FROM clientes WHERE id = :id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $cliente = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $telefono = $_POST["telefono"];
    $email = $_POST["email"];
    $direccion = $_POST["direccion"];

    $stmt = $conexion->prepare("UPDATE clientes SET nombre = :nombre, telefono = :telefono, email = :email, direccion = :direccion WHERE id = :id");
    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":nombre", $nombre);
    $stmt->bindParam(":telefono", $telefono);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":direccion", $direccion);
    $stmt->execute();

    header("Location: clientes.php?mensaje=Cliente actualizado");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container-fluid mt-4">
    <h2 class="text-center">Editar Cliente</h2>

    <div class="row justify-content-center">
        <div class="col-md-6 col-sm-12">
            <form action="editar_cliente.php" method="POST" class="shadow p-4 bg-white rounded">
                <input type="hidden" name="id" value="<?= $cliente['id']; ?>">

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" name="nombre" value="<?= htmlspecialchars($cliente['nombre']); ?>" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono:</label>
                    <input type="text" name="telefono" value="<?= htmlspecialchars($cliente['telefono']); ?>" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email" value="<?= htmlspecialchars($cliente['email']); ?>" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="direccion" class="form-label">Dirección:</label>
                    <textarea name="direccion" class="form-control"><?= htmlspecialchars($cliente['direccion']); ?></textarea>
                </div>

                <button type="submit" class="btn btn-success btn-lg w-100">Actualizar Cliente</button>
            </form>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="clientes.php" class="btn btn-secondary btn-lg w-50">Volver</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

