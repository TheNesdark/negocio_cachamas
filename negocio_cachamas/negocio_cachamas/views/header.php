<?php
require_once __DIR__ . "/../config.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Negocio de Cachamas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
    <div class="container-fluid">
        <a class="navbar-brand fs-4" href="/negocio_cachamas/index.php">Negocio de Cachamas</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse text-center" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <?php if (isset($_SESSION["rol_id"]) && $_SESSION["rol_id"] == 1): ?>
                    <li class="nav-item py-2"><a class="nav-link fs-5" href="/negocio_cachamas/views/usuarios.php">Usuarios</a></li>
                    <li class="nav-item py-2"><a class="nav-link fs-5" href="/negocio_cachamas/views/gastos.php">Gastos</a></li>
                    <li class="nav-item py-2"><a class="nav-link fs-5" href="/negocio_cachamas/views/lotes.php">Lotes</a></li>
                    <li class="nav-item py-2"><a class="nav-link fs-5" href="/negocio_cachamas/views/clientes.php">Clientes</a></li>
                    <li class="nav-item py-2"><a class="nav-link fs-5" href="/negocio_cachamas/views/ventas.php">Ventas</a></li>
                <?php elseif (isset($_SESSION["rol_id"]) && $_SESSION["rol_id"] == 2):?>
                    <li class="nav-item py-2"><a class="nav-link fs-5" href="/negocio_cachamas/views/clientes.php">Clientes</a></li>
                    <li class="nav-item py-2"><a class="nav-link fs-5" href="/negocio_cachamas/views/ventas.php">Ventas</a></li>
                <?php endif; ?>
                
                <li class="nav-item py-2"><a class="nav-link fs-5 text-danger" href="/negocio_cachamas/controllers/logout.php">Cerrar Sesión</a></li>
            </ul>
        </div>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


