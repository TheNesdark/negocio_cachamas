<?php
require_once __DIR__ . "/../config.php";

// Verificar si hay sesión activa
if (!isset($_SESSION["usuario_id"])) {
    header("Location: ../views/login.php");
    exit();
}

// Restringir acceso según el rol
$rol = $_SESSION["rol_id"] ?? null;

$pagina_actual = basename($_SERVER["PHP_SELF"]);

$paginas_vendedores = ["clientes.php", "ventas.php"];

if ($rol == 2 && !in_array($pagina_actual, $paginas_vendedores)) {
    header("Location: ../index.php?error=Acceso no autorizado");
    exit();
}
?>
