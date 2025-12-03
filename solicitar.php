<?php
session_start();
require "conexion.php"; // tu archivo de conexión

// 1. Validar login
if (!isset($_SESSION['usuario_id'])) {
    header("Location: Login.html");
    exit();
}

// 2. Capturar producto seleccionado
if (!isset($_GET["id"])) {
    die("Producto no encontrado");
}

$producto_id = intval($_GET["id"]);

// 3. Obtener información del producto
$sql = "SELECT * FROM PRODUCTOS WHERE PRO_ID = ?";
$params = array($producto_id);

$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

$producto = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);


if (!$producto) {
    die("Producto no encontrado");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Solicitar producto</title>
    <link rel="stylesheet" href="papeli.css">
</head>
<body>

<div class="container">
    <h2>Solicitar: <?php echo $producto["PRO_NOM"]; ?></h2>

    <form action="procesar_pedido.php" method="POST">
        <input type="hidden" name="producto_id" value="<?php echo $producto_id; ?>">

        <label>Cantidad</label>
        <input type="number" name="cantidad" min="1" required>

        <label>Descripción o comentario</label>
        <textarea name="comentario" placeholder="Describe cómo deseas personalizarlo..." required></textarea>

        <button class="btn primary" type="submit">Enviar Pedido</button>
    </form>
</div>

</body>
</html>
