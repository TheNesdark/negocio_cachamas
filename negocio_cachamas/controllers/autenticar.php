<?php
session_start();
require_once "../config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $password = $_POST["password"];

    // Buscar usuario en la base de datos
    $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE usuario = :usuario");
    

    $stmt->bindParam(":usuario", $usuario);
    $stmt->execute();
    
    // Extraer el primer resultado correctamente
    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $usuarioData = $resultado[0] ?? null; // Accede al primer elemento del array

    // Verificar si el usuario existe antes de validar la contraseña
    if ($usuarioData) {
        if (password_verify($password, $usuarioData["password"])) {
            $_SESSION["usuario_id"] = $usuarioData["id"];
            $_SESSION["usuario"] = $usuarioData["usuario"];
            header("Location: ../index.php");
            exit();
        } else {
            header("Location: ../views/login.php?error=Usuario o Contraseña incorrecto");
            exit();
        }
    } else {
        header("Location: ../views/login.php?error=Usuario o Contraseña incorrecto");
        exit();
    }
}
?>


