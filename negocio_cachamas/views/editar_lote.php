<?php
require_once "../config.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conexion->prepare("SELECT * FROM lotes WHERE id = :id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $lote = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $fecha_inicio = $_POST["fecha_inicio"];
    $cantidad_inicial = $_POST["cantidad_inicial"];
    $peso_promedio = $_POST["peso_promedio"];
    $estado = $_POST["estado"];

    $stmt = $conexion->prepare("UPDATE lotes SET nombre = :nombre, fecha_inicio = :fecha_inicio, cantidad_inicial = :cantidad_inicial, peso_promedio = :peso_promedio, estado = :estado WHERE id = :id");
    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":nombre", $nombre);
    $stmt->bindParam(":fecha_inicio", $fecha_inicio);
    $stmt->bindParam(":cantidad_inicial", $cantidad_inicial);
    $stmt->bindParam(":peso_promedio", $peso_promedio);
    $stmt->bindParam(":estado", $estado);
    $stmt->execute();

    header("Location: lotes.php?mensaje=Lote actualizado");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Lote</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container-fluid mt-4">
    <h2 class="text-center">Editar Lote</h2>

    <div class="row justify-content-center">
        <div class="col-md-6 col-sm-12">
            <form action="editar_lote.php" method="POST" class="shadow p-4 bg-white rounded">
                <input type="hidden" name="id" value="<?= $lote['id']; ?>">

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre del lote:</label>
                    <input type="text" name="nombre" value="<?= htmlspecialchars($lote['nombre']); ?>" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="fecha_inicio" class="form-label">Fecha de inicio:</label>
                    <input type="date" name="fecha_inicio" value="<?= htmlspecialchars($lote['fecha_inicio']); ?>" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="cantidad_inicial" class="form-label">Cantidad inicial:</label>
                    <input type="number" name="cantidad_inicial" value="<?= htmlspecialchars($lote['cantidad_inicial']); ?>" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="peso_promedio" class="form-label">Peso promedio (kg):</label>
                    <input type="text" name="peso_promedio" value="<?= htmlspecialchars($lote['peso_promedio']); ?>" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="estado" class="form-label">Estado:</label>
                    <select name="estado" class="form-control">
                        <option value="Activo" <?= ($lote['estado'] == "Activo") ? "selected" : ""; ?>>Activo</option>
                        <option value="Finalizado" <?= ($lote['estado'] == "Finalizado") ? "selected" : ""; ?>>Finalizado</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success btn-lg w-100">Actualizar Lote</button>
            </form>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="lotes.php" class="btn btn-secondary btn-lg w-50">Volver</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

