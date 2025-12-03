<?php

require_once "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST["correo"]);
    $contrasena = $_POST["contrasena"];

    $sql = "{CALL usp_LoginUsuario(?)}";
    $params = array($email);

    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt && sqlsrv_has_rows($stmt)) {
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

        $hashGuardado = $row["Usu_Contrasena"];
        $nombre = $row["Usu_Nombres"];
        $rol=$row["Usu_Rol_Id"];

        if (password_verify($contrasena, $hashGuardado)) {
            // Iniciar sesión
            session_start();
            $_SESSION["usuario"] = $nombre;
            $_SESSION["email"] = $email;
            $_SESSION["rol"] = $rol;

            echo "<script>alert('✅ Bienvenido, $nombre'); window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('❌ Contraseña incorrecta'); window.location.href='Login.html';</script>";
        }

    } else {
        echo "<script>alert('❌ No existe una cuenta con ese correo'); window.location.href='Login.html';</script>";
    }
}

sqlsrv_close($conn);
?>
