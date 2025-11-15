<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: Login.html");
    exit();
}

if ($_SESSION["rol"] == 2) {
    header("Location: cursos.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Hazte VIP — Papeli Studio</title>
<link rel="stylesheet" href="papeli.css">
</head>
<body>

<div class="vip-container">
    <h1>✨ Conviértete en Usuario VIP</h1>
    <p>Accede a todos los cursos exclusivos, tutoriales avanzados y contenido premium.</p>

    <div class="vip-card">
        <h2>Plan VIP</h2>
        <p>Acceso ilimitado a cursos</p>
        <p>Contenido exclusivo</p>
        <p>Actualizaciones semanales</p>
        <h3>$4.990 CLP / mes</h3>

        <a href="pago.php" class="btn vip-btn">Ir al pago</a>
    </div>
</div>

</body>
</html>
