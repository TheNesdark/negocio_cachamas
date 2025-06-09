<?php
require_once "../config.php";
require_once "../controllers/verificar_acceso.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $fecha_inicio = $_POST["fecha_inicio"];
    $cantidad_inicial = $_POST["cantidad_inicial"];
    $peso_promedio = $_POST["peso_promedio"];
    $estado = $_POST["estado"];

    $stmt = $conexion->prepare("INSERT INTO lotes (nombre, fecha_inicio, cantidad_inicial, peso_promedio, estado) VALUES (:nombre, :fecha_inicio, :cantidad_inicial, :peso_promedio, :estado)");
    $stmt->bindParam(":nombre", $nombre);
    $stmt->bindParam(":fecha_inicio", $fecha_inicio);
    $stmt->bindParam(":cantidad_inicial", $cantidad_inicial);
    $stmt->bindParam(":peso_promedio", $peso_promedio);
    $stmt->bindParam(":estado", $estado);
    $stmt->execute();

    header("Location: lotes.php?mensaje=Lote registrado");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Lotes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<?php include("header.php"); ?>



<div class="container-fluid mt-4">
    <h2 class="text-center">Registrar Lote</h2>

    <div class="row justify-content-center">
        <div class="col-md-6 col-sm-12">
            <form action="lotes.php" method="POST" class="shadow p-4 bg-white rounded">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre del lote:</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="fecha_inicio" class="form-label">Fecha de inicio:</label>
                    <input type="date" name="fecha_inicio" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="cantidad_inicial" class="form-label">Cantidad inicial:</label>
                    <input type="number" name="cantidad_inicial" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="peso_promedio" class="form-label">Peso promedio (kg):</label>
                    <input type="text" name="peso_promedio" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="estado" class="form-label">Estado:</label>
                    <select name="estado" class="form-control">
                        <option value="Activo">Activo</option>
                        <option value="Finalizado">Finalizado</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-lg w-100">Guardar Lote</button>
            </form>
        </div>
    </div>

    <h2 class="text-center mt-4">Lista de Lotes</h2>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-dark text-center">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Fecha de Inicio</th>
                    <th>Cantidad Inicial</th>
                    <th>Peso Promedio</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $conexion->prepare("SELECT * FROM lotes ORDER BY id DESC");
                $stmt->execute();
                $lotes = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($lotes as $lote) {
                    echo "<tr>
                        <td class='text-center'>{$lote['id']}</td>
                        <td>{$lote['nombre']}</td>
                        <td>{$lote['fecha_inicio']}</td>
                        <td>{$lote['cantidad_inicial']}</td>
                        <td>{$lote['peso_promedio']}</td>
                        <td>{$lote['estado']}</td>
                        <td class='text-center'>
                            <a href='editar_lote.php?id={$lote['id']}' class='btn btn-warning btn-sm'>Editar</a>
                            <a href='eliminar_lote.php?id={$lote['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"¿Eliminar este lote?\")'>Eliminar</a>
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

