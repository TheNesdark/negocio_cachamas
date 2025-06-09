<?php
session_start();
require_once "../config.php";

if (!isset($_SESSION["usuario_id"])) {
    header("Location: ../views/login.php");
    exit();
}

// Editar usuario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["editar"])) {
    $id = $_POST["id"];
    $usuario = $_POST["usuario"];
    $password = $_POST["password"];

    if (!empty($password)) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conexion->prepare("UPDATE usuarios SET usuario = :usuario, password = :password WHERE id = :id");
        $stmt->bindParam(":password", $passwordHash);
    } else {
        $stmt = $conexion->prepare("UPDATE usuarios SET usuario = :usuario WHERE id = :id");
    }

    $stmt->bindParam(":usuario", $usuario);
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    header("Location: ../views/usuarios.php?mensaje=Usuario actualizado");
    exit();
}

// Eliminar usuario
if (isset($_GET["eliminar"])) {
    $id = $_GET["eliminar"];
    $stmt = $conexion->prepare("DELETE FROM usuarios WHERE id = :id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    header("Location: ../views/usuarios.php?mensaje=Usuario eliminado");
    exit();
}
?>
