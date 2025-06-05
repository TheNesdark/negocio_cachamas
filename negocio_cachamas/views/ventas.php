<?php
require_once "../config.php";

// Procesar la inserción de ventas
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_cliente = $_POST["id_cliente"];
    $id_lote = $_POST["id_lote"];
    $peso_vendido = $_POST["peso_vendido"];
    $precio_por_kg = $_POST["precio_por_kg"];
    $fecha_venta = $_POST["fecha_venta"];

    $stmt = $conexion->prepare("INSERT INTO ventas (id_cliente, id_lote, peso_vendido, precio_por_kg, fecha_venta) 
                                VALUES (:id_cliente, :id_lote, :peso_vendido, :precio_por_kg, :fecha_venta)");
    $stmt->bindParam(":id_cliente", $id_cliente);
    $stmt->bindParam(":id_lote", $id_lote);
    $stmt->bindParam(":peso_vendido", $peso_vendido);
    $stmt->bindParam(":precio_por_kg", $precio_por_kg);
    $stmt->bindParam(":fecha_venta", $fecha_venta);
    $stmt->execute();

    header("Location: ventas.php?mensaje=Venta registrada");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Ventas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<?php include("header.php"); ?>

<div class="container-fluid mt-4">
    <h2 class="text-center">Registrar Venta</h2>

    <div class="row justify-content-center">
        <div class="col-md-6 col-sm-12">
            <form action="ventas.php" method="POST" class="shadow-lg p-4 bg-white rounded d-flex flex-column gap-3">
                <div>
                    <label for="id_cliente" class="form-label">Cliente:</label>
                    <select name="id_cliente" class="form-control">
                        <?php
                        $stmt = $conexion->prepare("SELECT id, nombre FROM clientes ORDER BY nombre ASC");
                        $stmt->execute();
                        $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($clientes as $cliente) {
                            echo "<option value='{$cliente['id']}'>{$cliente['nombre']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="id_lote" class="form-label">Lote:</label>
                    <select name="id_lote" class="form-control">
                        <?php
                        $stmt = $conexion->prepare("SELECT id, nombre FROM lotes WHERE estado = 'Activo' ORDER BY nombre ASC");
                        $stmt->execute();
                        $lotes = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($lotes as $lote) {
                            echo "<option value='{$lote['id']}'>{$lote['nombre']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="peso_vendido" class="form-label">Peso vendido (kg):</label>
                    <input type="number" step="0.01" name="peso_vendido" class="form-control" required>
                </div>
                <div>
                    <label for="precio_por_kg" class="form-label">Precio por kg:</label>
                    <input type="number" step="0.01" name="precio_por_kg" class="form-control" required>
                </div>
                <div>
                    <label for="fecha_venta" class="form-label">Fecha de venta:</label>
                    <input type="date" name="fecha_venta" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary btn-lg w-100">Registrar Venta</button>
            </form>
        </div>
    </div>
</div>


<h2 class="text-center mt-4">Lista de Ventas</h2>

<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead class="table-dark text-center">
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Lote</th>
                <th>Peso Vendido</th>
                <th>Precio por kg</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody class="text-center">
            <?php
            $stmt = $conexion->prepare("SELECT ventas.*, clientes.nombre AS cliente, lotes.nombre AS lote 
                                        FROM ventas 
                                        JOIN clientes ON ventas.id_cliente = clientes.id 
                                        JOIN lotes ON ventas.id_lote = lotes.id
                                        ORDER BY fecha_venta DESC");
            $stmt->execute();
            $ventas = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $totalGeneral = 0;
            foreach ($ventas as $venta) {
                $total = $venta['peso_vendido'] * $venta['precio_por_kg'];
                $totalGeneral += $total;

                echo "<tr>
                        <td class='fw-bold'>{$venta['id']}</td>
                        <td>{$venta['cliente']}</td>
                        <td>{$venta['lote']}</td>
                        <td>{$venta['peso_vendido']} kg</td>
                        <td>$ {$venta['precio_por_kg']}</td>
                        <td>{$venta['fecha_venta']}</td>
                        <td class='fw-bold text-success'>$ {$total}</td>
                        <td class='d-flex gap-2 justify-content-center'>
                            <a href='editar_venta.php?id={$venta['id']}' class='btn btn-warning btn-sm'>Editar</a>
                            <a href='eliminar_venta.php?id={$venta['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"¿Eliminar esta venta?\")'>Eliminar</a>
                        </td>
                    </tr>";
            }
            ?>
        </tbody>
        <tfoot>
            <tr class="table-secondary text-center">
                <th colspan="6">Total de Ventas:</th>
                <th class="fw-bold text-primary">$ <?php echo number_format($totalGeneral, 2); ?></th>
                <th></th>
            </tr>
        </tfoot>
    </table>
</div>
<div class="text-center mt-4">
        <a href="/negocio_cachamas/index.php" class="btn btn-secondary btn-lg w-50">Volver al Inicio</a>
    </div>


<?php include("footer.php"); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
