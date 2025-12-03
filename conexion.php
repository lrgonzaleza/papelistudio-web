
<?php
$serverName = "LUISG\MSSQLSERVER01";
$connectionInfo = array(
    "Database" => "PAPELISTUDIO-FINAL",
    "UID" => "",
    "PWD" => "",
    "CharacterSet" => "UTF-8" 
    
);

$conn = sqlsrv_connect($serverName, $connectionInfo);

if (!$conn) {
    die("❌ Error de conexión: " . print_r(sqlsrv_errors(), true));
}
?>