<?php
require_once "../config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $telefono = $_POST["telefono"];
    $email = $_POST["email"];
    $direccion = $_POST["direccion"];

    $stmt = $conexion->prepare("INSERT INTO clientes (nombre, telefono, email, direccion) VALUES (:nombre, :telefono, :email, :direccion)");
    $stmt->bindParam(":nombre", $nombre);
    $stmt->bindParam(":telefono", $telefono);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":direccion", $direccion);
    $stmt->execute();

    header("Location: clientes.php?mensaje=Cliente registrado");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Clientes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<?php include("header.php"); ?>

<div class="container-fluid mt-4">
    <h2 class="text-center">Registrar Cliente</h2>
    
    <div class="row justify-content-center">
        <div class="col-md-6 col-sm-12">
            <form action="clientes.php" method="POST" class="shadow p-4 bg-white rounded">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono:</label>
                    <input type="text" name="telefono" id="telefono" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email" id="email" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="direccion" class="form-label">Dirección:</label>
                    <textarea name="direccion" id="direccion" class="form-control"></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-lg w-100">Guardar Cliente</button>
            </form>
        </div>
    </div>

    <h2 class="text-center mt-4">Lista de Clientes</h2>
    
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-dark text-center">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Dirección</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $conexion->prepare("SELECT * FROM clientes ORDER BY id DESC");
                $stmt->execute();
                $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($clientes as $cliente) {
                    echo "<tr>
                        <td class='text-center'>{$cliente['id']}</td>
                        <td>{$cliente['nombre']}</td>
                        <td>{$cliente['telefono']}</td>
                        <td>{$cliente['email']}</td>
                        <td>{$cliente['direccion']}</td>
                        <td class='text-center'>
                            <a href='editar_cliente.php?id={$cliente['id']}' class='btn btn-warning btn-sm'>Editar</a>
                            <a href='eliminar_cliente.php?id={$cliente['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"¿Eliminar este cliente?\")'>Eliminar</a>
                        </td>
                        </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="text-center mt-4">
        <a href="/negocio_cachamas/index.php" class="btn btn-secondary btn-lg w-50">Volver al Inicio</a>
    </div>
</div>

<?php include("footer.php"); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


