<?php
require_once "../config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $descripcion = $_POST["descripcion"];
    $monto = $_POST["monto"];
    $fecha = $_POST["fecha"];
    $categoria = $_POST["categoria"];

    $stmt = $conexion->prepare("INSERT INTO gastos (descripcion, monto, fecha, categoria) VALUES (:descripcion, :monto, :fecha, :categoria)");
    $stmt->bindParam(":descripcion", $descripcion);
    $stmt->bindParam(":monto", $monto);
    $stmt->bindParam(":fecha", $fecha);
    $stmt->bindParam(":categoria", $categoria);
    $stmt->execute();

    header("Location: gastos.php?mensaje=Gasto registrado");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Gastos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<?php include("header.php"); ?>

<div class="container-fluid mt-4">
    <h2 class="text-center">Registrar Gasto</h2>

    <div class="row justify-content-center">
        <div class="col-md-6 col-sm-12">
            <form action="gastos.php" method="POST" class="shadow p-4 bg-white rounded">
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción:</label>
                    <input type="text" name="descripcion" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="monto" class="form-label">Monto:</label>
                    <input type="number" name="monto" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="fecha" class="form-label">Fecha:</label>
                    <input type="date" name="fecha" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="categoria" class="form-label">Categoría:</label>
                    <select name="categoria" class="form-control">
                        <option value="Alimentación">Alimentación</option>
                        <option value="Mantenimiento">Mantenimiento</option>
                        <option value="Servicios">Servicios</option>
                        <option value="Otros">Otros</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-lg w-100">Guardar Gasto</button>
            </form>
        </div>
    </div>

    <h2 class="text-center mt-4">Lista de Gastos</h2>
    
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-dark text-center">
                <tr>
                    <th>ID</th>
                    <th>Descripción</th>
                    <th>Monto</th>
                    <th>Fecha</th>
                    <th>Categoría</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $conexion->prepare("SELECT * FROM gastos ORDER BY id DESC");
                $stmt->execute();
                $gastos = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($gastos as $gasto) {
                    echo "<tr>
                        <td class='text-center'>{$gasto['id']}</td>
                        <td>{$gasto['descripcion']}</td>
                        <td>{$gasto['monto']}</td>
                        <td>{$gasto['fecha']}</td>
                        <td>{$gasto['categoria']}</td>
                        <td class='text-center'>
                            <a href='editar_gasto.php?id={$gasto['id']}' class='btn btn-warning btn-sm'>Editar</a>
                            <a href='eliminar_gasto.php?id={$gasto['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"¿Eliminar este gasto?\")'>Eliminar</a>
                        </td>
                        </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<div class="text-center mt-4">
        <a href="/negocio_cachamas/index.php" class="btn btn-secondary btn-lg w-50">Volver al Inicio</a>
    </div>

<?php include("footer.php"); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

