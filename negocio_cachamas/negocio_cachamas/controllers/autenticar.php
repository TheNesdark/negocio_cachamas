<?php
session_start();
require_once "../config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $password = $_POST["password"];

    // Buscar usuario en la base de datos con su rol
    $stmt = $conexion->prepare("SELECT id, usuario, password, rol_id FROM usuarios WHERE usuario = :usuario");
    $stmt->bindParam(":usuario", $usuario);
    $stmt->execute();
    $usuarioData = $stmt->fetch(PDO::FETCH_ASSOC); // Extrae un solo resultado

    // Verificar si el usuario existe antes de validar la contraseña
    if ($usuarioData && password_verify($password, $usuarioData["password"])) {
        $_SESSION["usuario_id"] = $usuarioData["id"];
        $_SESSION["usuario"] = $usuarioData["usuario"];
        $_SESSION["rol_id"] = $usuarioData["rol_id"]; // Guardamos el rol

        header("Location: ../index.php");
        exit();
    } else {
        header("Location: ../views/login.php?error=Usuario o Contraseña incorrecto");
        exit();
    }
}
?>



