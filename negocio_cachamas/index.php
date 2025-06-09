<?php
require_once "config.php";


$rol = $_SESSION["rol_id"] ?? null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Negocio de Cachamas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>

    <?php include("views/header.php"); ?>

    <div class="container mt-4">
        <h1 class="text-center">Sistema de Gestión para Cachamas</h1>
        
        <div class="row">
            <div class="col-md-6">
                <a href="views/clientes.php" class="btn btn-outline-primary w-100 mb-2">Gestión de Clientes</a>
                <?php if ($rol == 1): ?>
                    <a href="views/gastos.php" class="btn btn-outline-danger w-100 mb-2">Registro de Gastos</a>
                <?php else: ?>
                    <button class="btn btn-outline-danger w-100 mb-2" onclick="mostrarModal()">Registro de Gastos</button>
                <?php endif; ?>
            </div>
            <div class="col-md-6">
                <?php if ($rol == 1): ?>
                    <a href="views/lotes.php" class="btn btn-outline-dark w-100 mb-2">Control de Lotes</a>
                <?php else: ?>
                    <button class="btn btn-outline-dark w-100 mb-2" onclick="mostrarModal()">Control de Lotes</button>
                <?php endif; ?>
                <a href="views/ventas.php" class="btn btn-outline-success w-100 mb-2">Registro de Ventas</a>
            </div>
        </div>

        <hr>

        <h2 class="text-center mb-4">Panel de Control Financiero</h2>

        <?php include("views/dashboard.php"); ?>
        
        <hr>
        
    </div>

    <?php include("views/footer.php"); ?>

    
    <div class="modal fade" id="accesoDenegado" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Acceso Denegado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <p>No tienes los permisos necesarios para acceder a esta sección.</p>
                    
                </div>
                <div class="modal-footer">
                    <a href="index.php" class="btn btn-secondary">Volver al inicio</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function mostrarModal() {
            var accesoModal = new bootstrap.Modal(document.getElementById("accesoDenegado"));
            accesoModal.show();
            setTimeout(() => { window.location.href = "index.php"; }, 3000);
        }
    </script>
</body>
</html>



