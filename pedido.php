<?php
session_start();
require_once "conexion.php";

// 1. Proteger la página: Solo usuarios logueados pueden acceder
if (!isset($_SESSION['usuario']) || !isset($_SESSION['email'])) {
    echo "<script>alert('❌ Debes iniciar sesión para realizar un pedido.'); window.location.href='Login.html';</script>";
    exit();
}

// 2. Obtener el ID del producto desde la URL
$producto_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($producto_id <= 0) {
    echo "<script>alert('❌ Producto no válido'); window.location.href='index.php';</script>";
    exit();
}

// 3. Obtener información del producto usando el SP adaptado
$sql = "{CALL usp_ObtenerProductoSimple(?)}";
$params = array($producto_id);
$stmt = sqlsrv_query($conn, $sql, $params);

if (!$stmt || !sqlsrv_has_rows($stmt)) {
    echo "<script>alert('❌ Producto no encontrado'); window.location.href='index.php';</script>";
    exit();
}

$producto = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
sqlsrv_close($conn);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realizar Pedido — <?php echo htmlspecialchars($producto['PRO_NOM']); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="papeli.css"/>
    <link rel="stylesheet" href="formulariopedido.css"/>
</head>
<body>
    <header class="header">
        <div class="container nav-wrap">
            <div class="brand">
                <img src="FOTO DE PERFIL.jpg" alt="Papeli Studio logo" class="logo"/>
                <div class="brand-text">
                    <span class="brand-name">Papeli<span class="brand-accent">Studio</span></span>
                    <small class="brand-sub">Papelería Creativa y Corporativa</small>
                </div>
            </div>
            
            <div class="nav-actions">
                <a class="btn login" href="index.php">
                    <i class="fa fa-arrow-left"></i> Volver
                </a>
            </div>
        </div>
    </header>

    <div class="pedido-container">
        <h1 style="color: #ff6b9d; margin-bottom: 20px;">
            <i class="fas fa-shopping-cart"></i> Pedido Personalizado
        </h1>
        
        <div class="producto-info">
            <img src="<?php echo htmlspecialchars($producto['PRO_IMG']); ?>" 
                 alt="<?php echo htmlspecialchars($producto['PRO_NOM']); ?>" 
                 class="producto-imagen">
            <div class="producto-detalles">
                <h2><?php echo htmlspecialchars($producto['PRO_NOM']); ?></h2>
                <p><?php echo htmlspecialchars($producto['PRO_DES']); ?></p>
                <div class="precio">
                    Precio: CLP $<?php echo number_format($producto['PRO_PRE'], 0, ',', '.'); ?>
                </div>
            </div>
        </div>

        <form action="procesarpedido.php" method="POST" class="pedido-form">
            <input type="hidden" name="producto_id" value="<?php echo $producto['PRO_ID']; ?>">
            
            <div class="form-group">
                <label for="cantidad">
                    Cantidad <span class="required">*</span>
                </label>
                <input type="number" 
                       id="cantidad" 
                       name="cantidad" 
                       min="1" 
                       value="1" 
                       required>
            </div>
            
            <div class="form-group">
                <label for="comentario">
                    Detalles de Personalización <span class="required">*</span>
                </label>
                <textarea id="comentario" 
                          name="comentario" 
                          required 
                          placeholder="Describe cómo quieres personalizar tu producto: colores, textos, diseños, etc."></textarea>
                <small>Tu pedido se asociará a tu cuenta: **<?php echo htmlspecialchars($_SESSION['usuario']); ?>**</small>
            </div>
            
            <button type="submit" class="btn-submit">
                <i class="fas fa-paper-plane"></i> Enviar Pedido
            </button>
        </form>
    </div>

    <footer class="footer">
        <div class="container copyright">
            © <span id="year"></span> Papeli Studio — Todos los derechos reservados.
        </div>
    </footer>

    <script>
        document.getElementById('year').textContent = new Date().getFullYear();
    </script>
</body>
</html>



