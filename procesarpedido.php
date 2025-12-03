<?php
session_start();
require_once "conexion.php";

// 1. Proteger la página: Solo usuarios logueados pueden procesar pedidos
if (!isset($_SESSION['usuario']) || !isset($_SESSION['email'])) {
    echo "<script>alert('❌ Debes iniciar sesión para realizar un pedido.'); window.location.href='Login.html';</script>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: index.php");
    exit();
}

// 2. Obtener datos del formulario
$producto_id = intval($_POST['producto_id']);
$cantidad = intval($_POST['cantidad']);
$comentario = trim($_POST['comentario']);
$email_usuario = $_SESSION['email'];

// 3. Validaciones básicas
if ($producto_id <= 0 || $cantidad <= 0 || empty($comentario)) {
    echo "<script>alert('❌ Por favor completa todos los campos requeridos.'); window.history.back();</script>";
    exit();
}

// 4. Obtener el ID del usuario logueado
$sql_user = "{CALL usp_ObtenerUsuarioId(?)}";
$params_user = array($email_usuario);
$stmt_user = sqlsrv_query($conn, $sql_user, $params_user);

if (!$stmt_user || !sqlsrv_has_rows($stmt_user)) {
    echo "<script>alert('❌ Error al obtener tu ID de usuario. Por favor, intenta iniciar sesión de nuevo.'); window.location.href='logout.php';</script>";
    exit();
}

$user_data = sqlsrv_fetch_array($stmt_user, SQLSRV_FETCH_ASSOC);
$usuario_id = $user_data['Usu_Id'];

// 5. Registrar el pedido usando el SP adaptado
$sql = "{CALL usp_RegistrarPedidoSimple(?, ?, ?, ?)}";
$params = array($usuario_id, $producto_id, $cantidad, $comentario);

$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt) {
    // Obtener el ID del pedido recién creado
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    $pedido_id = $row['NuevoPedidoId'];
    
    // Obtener información del producto para el mensaje
    $sql_producto = "{CALL usp_ObtenerProductoSimple(?)}";
    $params_producto = array($producto_id);
    $stmt_producto = sqlsrv_query($conn, $sql_producto, $params_producto);
    
    $producto_nombre = "tu producto";
    if ($stmt_producto && sqlsrv_has_rows($stmt_producto)) {
        $producto_data = sqlsrv_fetch_array($stmt_producto, SQLSRV_FETCH_ASSOC);
        $producto_nombre = $producto_data['PRO_NOM'];
    }
    
    // Mensaje de éxito con información del pedido
    echo "<!DOCTYPE html>
    <html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Pedido Confirmado — Papeli Studio</title>
        <link href='https://fonts.googleapis.com/css2?family=Pacifico&family=Poppins:wght@300;400;600;700&display=swap' rel='stylesheet'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css' crossorigin='anonymous' />
        <link rel='stylesheet' href='papeli.css' />
        <style>
            .confirmacion-container {
                max-width: 700px;
                margin: 100px auto 50px;
                padding: 40px;
                background: white;
                border-radius: 12px;
                box-shadow: 0 4px 20px rgba(0,0,0,0.1);
                text-align: center;
            }
            .icono-exito {
                font-size: 80px;
                color: #4CAF50;
                margin-bottom: 20px;
            }
            .confirmacion-container h1 {
                color: #ff6b9d;
                margin-bottom: 20px;
            }
            .detalle-pedido {
                background: #f9f9f9;
                padding: 20px;
                border-radius: 8px;
                margin: 30px 0;
                text-align: left;
            }
            .detalle-pedido p {
                margin: 10px 0;
                font-size: 1.05em;
            }
            .detalle-pedido strong {
                color: #333;
            }
            .btn-volver {
                display: inline-block;
                margin-top: 20px;
                padding: 15px 40px;
                background: linear-gradient(135deg, #ff6b9d 0%, #c44569 100%);
                color: white;
                text-decoration: none;
                border-radius: 8px;
                font-weight: 600;
                font-size: 1.1em;
            }
            .btn-volver:hover {
                transform: translateY(-2px);
            }
        </style>
    </head>
    <body>
        <header class='header'>
            <div class='container nav-wrap'>
                <div class='brand'>
                    <img src='FOTO DE PERFIL.jpg' alt='Papeli Studio logo' class='logo'/>
                    <div class='brand-text'>
                        <span class='brand-name'>Papeli<span class='brand-accent'>Studio</span></span>
                        <small class='brand-sub'>Papelería Creativa y Corporativa</small>
                    </div>
                </div>
            </div>
        </header>
        
        <div class='confirmacion-container'>
            <div class='icono-exito'>
                <i class='fas fa-check-circle'></i>
            </div>
            <h1>¡Pedido Confirmado!</h1>
            <p>Hemos recibido tu solicitud de pedido personalizado.</p>
            
            <div class='detalle-pedido'>
                <p><strong>Número de Pedido:</strong> #" . str_pad($pedido_id, 6, '0', STR_PAD_LEFT) . "</p>
                <p><strong>Producto:</strong> " . htmlspecialchars($producto_nombre) . "</p>
                <p><strong>Cantidad:</strong> " . $cantidad . " unidad(es)</p>
                <p><strong>Usuario:</strong> " . htmlspecialchars($_SESSION['usuario']) . "</p>
            </div>
            
            <div style='background: #fff3cd; padding: 20px; border-radius: 8px; border-left: 4px solid #ffc107; margin: 20px 0;'>
                <p style='margin: 0; color: #856404;'>
                    <i class='fas fa-info-circle'></i> 
                    <strong>Próximos pasos:</strong><br>
                    Nos pondremos en contacto contigo usando el email y teléfono registrados en tu cuenta para confirmar los detalles y el presupuesto.
                </p>
            </div>
            
            <p style='margin-top: 20px;'>
                También puedes contactarnos directamente por WhatsApp para cualquier consulta.
            </p>
            
            <a href='https://wa.me/56965929120?text=Hola,%20consulta%20sobre%20pedido%20%23" . str_pad($pedido_id, 6, '0', STR_PAD_LEFT) . "' 
               class='btn-volver' 
               target='_blank' 
               style='margin-right: 10px; background: #25D366;'>
                <i class='fab fa-whatsapp'></i> Contactar por WhatsApp
            </a>
            
            <a href='index.php' class='btn-volver'>
                <i class='fas fa-home'></i> Volver al Inicio
            </a>
        </div>
        
        <footer class='footer'>
            <div class='container copyright'>
                © " . date('Y') . " Papeli Studio — Todos los derechos reservados.
            </div>
        </footer>
    </body>
    </html>";
    
} else {
    echo "<script>alert('❌ Error al procesar el pedido. Por favor intenta nuevamente.'); window.location.href='index.php';</script>";
    error_log("Error SQL: " . print_r(sqlsrv_errors(), true));
}

sqlsrv_close($conn);
?>


