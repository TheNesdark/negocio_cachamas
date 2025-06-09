<?php
require_once "../config.php";
require_once "../controllers/verificar_acceso.php";


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conexion->prepare("DELETE FROM lotes WHERE id = :id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    header("Location: lotes.php?mensaje=Lote eliminado");
    exit();
}
?>
