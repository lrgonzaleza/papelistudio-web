<?php
require_once "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
    $nombres   = trim($_POST["nombres"]);
    $apellidos = trim($_POST["apellidos"]);
    $rut       = trim($_POST["rut"]);
    $email     = trim($_POST["correo"]);
    $fono      = trim($_POST["telefono"]);
    $contrasena = $_POST["contrasena"];
    $contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);
    $sql = "{CALL usp_RegistrarUsuario(?, ?, ?, ?, ?, ?)}";
    $params = array($nombres, $apellidos, $rut, $email, $fono, $contrasena_hash);
    $stmt = sqlsrv_query($conn, $sql, $params);
    if ($stmt) 
    {
        echo "<script>alert('✅ Usuario registrado correctamente'); window.location.href='Login.html';</script>";
    } else {
        echo "<script>alert('❌ Error al registrar usuario');</script>";
        die(print_r(sqlsrv_errors(), true));
    }
}
sqlsrv_close($conn);
?>
