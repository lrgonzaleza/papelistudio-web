<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: Login.html");
    exit();
}

$serverName = "ALEJANDRO\\SQLEXPRESS";
$connectionInfo = array(
    "Database" => "PapeliStudio",
    "UID" => "",
    "PWD" => ""
);

$conn = sqlsrv_connect($serverName, $connectionInfo);
$params = array($_SESSION["email"]);
$sql = "{CALL usp_Vip(?)}";
$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt) {
    $_SESSION["rol"] = 2;
    echo "<script>
            alert('🎉 Felicidades, ya eres VIP!');
            window.location.href='cursos.php';
        </script>";
} else {
    echo "<script>alert('❌ Error al actualizar tu cuenta'); window.location.href='upgrade.php';</script>";
}
?>
