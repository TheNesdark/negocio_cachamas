<?php

$host = "localhost";
$usuario = "root";
$contrasena = "";
$baseDatos = "negocio_cachamas";
$puerto = "3307";

try {
    $conexion = new PDO("mysql:host=$host;port=$puerto;dbname=$baseDatos;charset=utf8", $usuario, $contrasena);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>


