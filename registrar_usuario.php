<?php
// Datos de conexión
$serverName = "ALEJANDRO\\SQLEXPRESS";
$connectionInfo = array(
    "Database" => "PapeliStudio",
    "UID" => "",  // Autenticación de Windows
    "PWD" => ""
);

// Conexión con SQL Server
$conn = sqlsrv_connect($serverName, $connectionInfo);

if (!$conn) {
    die("❌ Error de conexión: " . print_r(sqlsrv_errors(), true));
}

// Verificar si se enviaron datos desde el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Capturar datos del formulario
    $nombres   = trim($_POST["nombres"]);
    $apellidos = trim($_POST["apellidos"]);
    $rut       = trim($_POST["rut"]);
    $email     = trim($_POST["correo"]);
    $fono      = trim($_POST["telefono"]);
    $contrasena = $_POST["contrasena"];

    // Encriptar la contraseña
    $contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);

    // Llamar al procedimiento almacenado (actualízalo para incluir la contraseña)
    // Debe tener este formato: usp_RegistrarUsuario(@Nombres, @Apellidos, @Rut, @Email, @Fono, @Contrasena)
    $sql = "{CALL usp_RegistrarUsuario(?, ?, ?, ?, ?, ?)}";
    $params = array($nombres, $apellidos, $rut, $email, $fono, $contrasena_hash);

    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt) {
        echo "<script>alert('✅ Usuario registrado correctamente'); window.location.href='Login.html';</script>";
    } else {
        echo "<script>alert('❌ Error al registrar usuario');</script>";
        die(print_r(sqlsrv_errors(), true));
    }
}

// Cerrar conexión
sqlsrv_close($conn);
?>
