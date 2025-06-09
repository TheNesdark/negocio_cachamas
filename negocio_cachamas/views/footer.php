<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Administrativo - Negocio de Cachamas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-color: #f8f9fa;
        }
        
        main {
            flex: 1;
        }
        
        .admin-footer {
            background-color: #ffffff;
            border-top: 2px solid #e9ecef;
            box-shadow: 0 -1px 3px rgba(0,0,0,0.1);
        }
        
        .footer-link {
            color: #6c757d;
            text-decoration: none;
            transition: color 0.2s ease;
        }
        
        .footer-link:hover {
            color: #0d6efd;
            text-decoration: none;
        }
        
        .status-indicator {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: #28a745;
            display: inline-block;
            margin-right: 5px;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { opacity: 1; }
            50% { opacity: 0.5; }
            100% { opacity: 1; }
        }
        
        .version-info {
            font-size: 0.75rem;
            color: #adb5bd;
        }
    </style>
</head>
<body>



<footer class="admin-footer py-3 mt-auto">
    <div class="container-fluid">
        <div class="row align-items-center">
            
            <div class="col-md-4 text-start">
                <div class="d-flex align-items-center">
                    <span class="status-indicator"></span>
                    <small class="text-muted me-3">Sistema activo</small>
                    <small class="version-info">v2.1.3</small>
                </div>
            </div>
            
            
            <div class="col-md-4 text-center">
            <img src="\negocio_cachamas\assets\img\Picsart_25-06-08_21-37-49-724.png" alt ="logo" width="40" height="40">
                <small class="text-muted">
                    &copy; <?= date("Y"); ?> Sistema Administrativo - Rancho Cachamero
                </small>
            </div>
            
            
            <div class="col-md-4 text-end">
                <div class="d-flex justify-content-end gap-3 flex-wrap">
                    <a href="https://wa.me/573026524273" class="footer-link" title="Ayuda">
                        <i class="fas fa-question-circle me-1"></i>
                        <small>Ayuda</small>
                    </a>
                    <a href="https://wa.me/573026524273" class="footer-link" title="Soporte técnico">
                        <i class="fas fa-headset me-1"></i>
                        <small>Soporte</small>
                    </a>
            
                    <a href="/negocio_cachamas/controllers/logout.php" class="footer-link" title="Cerrar sesión">
                        <i class="fas fa-sign-out-alt me-1"></i>
                        <small>Salir</small>
                    </a>
                </div>
            </div>
        </div>
        
        
        <div class="row d-md-none mt-2">
            <div class="col-12 text-center">
                <div class="d-flex justify-content-center gap-3">
                    <small class="text-muted">
                        <i class="fas fa-user me-1"></i>
                        Admin: Juan Pérez
                    </small>
                    <small class="text-muted">
                        <i class="fas fa-clock me-1"></i>
                        Última sesión: <?= date("d/m/Y H:i"); ?>
                    </small>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

