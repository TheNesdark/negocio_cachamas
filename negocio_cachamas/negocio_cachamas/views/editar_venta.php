<?php
require_once "../config.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conexion->prepare("SELECT * FROM ventas WHERE id = :id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $venta = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $peso_vendido = $_POST["peso_vendido"];
    $precio_por_kg = $_POST["precio_por_kg"];
    $fecha_venta = $_POST["fecha_venta"];

    $stmt = $conexion->prepare("UPDATE ventas SET peso_vendido = :peso_vendido, precio_por_kg = :precio_por_kg, fecha_venta = :fecha_venta WHERE id = :id");
    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":peso_vendido", $peso_vendido);
    $stmt->bindParam(":precio_por_kg", $precio_por_kg);
    $stmt->bindParam(":fecha_venta", $fecha_venta);
    $stmt->execute();

    header("Location: ventas.php?mensaje=Venta actualizada");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Venta</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    
<div class="container-fluid mt-4">
    <h2 class="text-center">Editar Venta</h2>

    <div class="row justify-content-center">
        <div class="col-md-6 col-sm-12">
            <form action="editar_venta.php" method="POST" class="shadow p-4 bg-white rounded">
                <input type="hidden" name="id" value="<?= $venta["id"]; ?>">

                <div class="mb-3">
                    <label class="form-label">Peso Vendido (kg)</label>
                    <input type="number" name="peso_vendido" class="form-control" value="<?= htmlspecialchars($venta["peso_vendido"]); ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Precio por kg ($)</label>
                    <input type="number" name="precio_por_kg" class="form-control" value="<?= htmlspecialchars($venta["precio_por_kg"]); ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Fecha de Venta</label>
                    <input type="date" name="fecha_venta" class="form-control" value="<?= htmlspecialchars($venta["fecha_venta"]); ?>" required>
                </div>

                <button type="submit" class="btn btn-success btn-lg w-100">Guardar cambios</button>
            </form>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="ventas.php" class="btn btn-secondary btn-lg w-50">Volver</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


