<?php
session_start();
require "conexion.php";

if (!isset($_SESSION['usuario_id'])) {
    die("Sesión inválida");
}

$usuario_id = intval($_SESSION["usuario_id"]);
$producto_id = intval($_POST["producto_id"]);
$cantidad = intval($_POST["cantidad"]);
$comentario = $_POST["comentario"];

// Parámetros del SP
$params = array(
    array($usuario_id, SQLSRV_PARAM_IN),
    array($producto_id, SQLSRV_PARAM_IN),
    array($cantidad, SQLSRV_PARAM_IN),
    array($comentario, SQLSRV_PARAM_IN)
);

$sql = "{CALL SP_INSERTAR_PEDIDO (?, ?, ?, ?)}";

$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt === false) {
    die("<pre>" . print_r(sqlsrv_errors(), true) . "</pre>");
}

header("Location: gracias.php");
exit();
