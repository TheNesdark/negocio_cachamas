<?php
require_once "config.php";
session_start();
if (!isset($_SESSION["usuario_id"])) {
    header("Location: views/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Negocio de Cachamas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

    <?php include("views/header.php"); ?>

    <div class="container-fluid mt-4">
        <h1 class="text-center">Sistema de Gestión para Cachamas</h1>

        <div class="row text-center">
            <div class="col-md-6 col-sm-12 mb-2">
                <a href="views/clientes.php" class="btn btn-primary btn-lg w-100">Gestión de Clientes</a>
                <a href="views/gastos.php" class="btn btn-danger btn-lg w-100 mt-2">Registro de Gastos</a>
            </div>
            <div class="col-md-6 col-sm-12 mb-2">
                <a href="views/lotes.php" class="btn btn-warning btn-lg w-100">Control de Lotes</a>
                <a href="views/ventas.php" class="btn btn-success btn-lg w-100 mt-2">Registro de Ventas</a>
            </div>
        </div>

        <hr>

        <h2 class="text-center mb-4">Panel de Control Financiero</h2>

        <?php include("views/dashboard.php"); ?>
        
        <hr>
        <div class="text-center">
            <a href="controllers/logout.php" class="btn btn-secondary btn-lg w-50">Cerrar Sesión</a>
        </div>
    </div>

    <?php include("views/footer.php"); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>



