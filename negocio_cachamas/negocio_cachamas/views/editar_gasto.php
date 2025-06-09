<?php
require_once "../config.php";
require_once "../controllers/verificar_acceso.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conexion->prepare("SELECT * FROM gastos WHERE id = :id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $gasto = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $descripcion = $_POST["descripcion"];
    $monto = $_POST["monto"];
    $fecha = $_POST["fecha"];
    $categoria = $_POST["categoria"];

    $stmt = $conexion->prepare("UPDATE gastos SET descripcion = :descripcion, monto = :monto, fecha = :fecha, categoria = :categoria WHERE id = :id");
    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":descripcion", $descripcion);
    $stmt->bindParam(":monto", $monto);
    $stmt->bindParam(":fecha", $fecha);
    $stmt->bindParam(":categoria", $categoria);
    $stmt->execute();

    header("Location: gastos.php?mensaje=Gasto actualizado");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Gasto</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container-fluid mt-4">
    <h2 class="text-center">Editar Gasto</h2>

    <div class="row justify-content-center">
        <div class="col-md-6 col-sm-12">
            <form action="editar_gasto.php" method="POST" class="shadow p-4 bg-white rounded">
                <input type="hidden" name="id" value="<?= $gasto['id']; ?>">

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción:</label>
                    <input type="text" name="descripcion" value="<?= htmlspecialchars($gasto['descripcion']); ?>" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="monto" class="form-label">Monto:</label>
                    <input type="number" name="monto" value="<?= htmlspecialchars($gasto['monto']); ?>" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="fecha" class="form-label">Fecha:</label>
                    <input type="date" name="fecha" value="<?= htmlspecialchars($gasto['fecha']); ?>" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="categoria" class="form-label">Categoría:</label>
                    <select name="categoria" class="form-control">
                        <option value="Alimentación" <?= ($gasto['categoria'] == "Alimentación") ? "selected" : ""; ?>>Alimentación</option>
                        <option value="Mantenimiento" <?= ($gasto['categoria'] == "Mantenimiento") ? "selected" : ""; ?>>Mantenimiento</option>
                        <option value="Servicios" <?= ($gasto['categoria'] == "Servicios") ? "selected" : ""; ?>>Servicios</option>
                        <option value="Otros" <?= ($gasto['categoria'] == "Otros") ? "selected" : ""; ?>>Otros</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success btn-lg w-100">Actualizar Gasto</button>
            </form>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="gastos.php" class="btn btn-secondary btn-lg w-50">Volver</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
