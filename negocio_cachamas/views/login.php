<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-lg p-4 rounded" style="max-width: 400px; width: 100%;">
            <h3 class="text-center mb-3">Iniciar Sesión</h3>

            <?php if (isset($_GET["error"])): ?>
                <div class="alert alert-danger text-center"><?= htmlspecialchars($_GET["error"]); ?></div>
            <?php endif; ?>

            <form action="../controllers/autenticar.php" method="POST" class="d-flex flex-column gap-3">
                <div>
                    <label for="usuario" class="form-label">Usuario</label>
                    <input type="text" name="usuario" class="form-control" placeholder="Ingrese su usuario" required>
                </div>
                <div>
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" name="password" class="form-control" placeholder="Ingrese su contraseña" required>
                </div>
                <button type="submit" class="btn btn-primary btn-lg w-100">Ingresar</button>
            </form>

            <div class="text-center mt-3">
                <a href="recuperar.php" class="text-decoration-none text-muted">¿Olvidó su contraseña?</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


