<?php
$serverName = "ALEJANDRO\\SQLEXPRESS";
$connectionInfo = array(
    "Database" => "PapeliStudio",
    "UID" => "",
    "PWD" => ""
);

$conn = sqlsrv_connect($serverName, $connectionInfo);

if (!$conn) {
    die("❌ Error de conexión: " . print_r(sqlsrv_errors(), true));
}
?>
