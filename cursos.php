<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Cursos — Papeli Studio</title>
<meta name="description" content="Cursos y tutoriales de Papeli Studio — Aprende diseño, papelería y personalización de productos.">

<link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" />


<link rel="stylesheet" href="papeli.css" />
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

    <nav class="nav" id="nav">
        <ul>
        <li><a href="index.php#home">Inicio</a></li>
        <li><a href="index.php#about">Quiénes Somos</a></li>
        <li><a href="index.php#products">Productos</a></li>
        <li><a href="curso.php" class="active">Cursos</a></li>
        <li><a href="index.php#contact">Contacto</a></li>
        </ul>
    </nav>

    <div class="nav-actions">
        <?php if (isset($_SESSION['usuario'])): ?>
        <form action="logout.php" method="post" style="display:inline;">
            <button type="submit" class="btn login">Cerrar sesión</button>
        </form>
        <?php else: ?>
        <a class="btn login" href="Login.html">Inicia sesión</a>
        <?php endif; ?>
        <button class="hamburger" id="hamburger" aria-label="Abrir menú">
        <span></span><span></span><span></span>
        </button>
    </div>
    </div>
</header>
<section class="section section-courses">
    <div class="container">
    <h1 class="section-title">Cursos y Tutoriales</h1>
    <p>Aprende paso a paso con nuestros videos exclusivos sobre diseño, papelería y personalización de productos.</p>

    <div class="video-grid">
        <div class="video-card">
        <h3>Curso 1: Introducción a la Papelería Creativa</h3>
        <video controls controlsList="nodownload noremoteplayback" disablePictureInPicture oncontextmenu="return false;">
            <source src="video.php?v=curso1.mp4" type="video/mp4">
            Tu navegador no soporta la reproducción de video.
        </video>

        </div>

        <div class="video-card">
        <h3>Curso 2: Diseño y Personalización de Tazas</h3>
        <video controls controlsList="nodownload noremoteplayback" disablePictureInPicture oncontextmenu="return false;">
            <source src="video.php?v=curso2.mp4" type="video/mp4">
            Tu navegador no soporta la reproducción de video.
        </video>
        </div>
    </div>
    </div>
</section>

<footer class="footer">
    <div class="container footer-grid">
    <div>
        <p class="brand-foot"><strong>Papeli Studio</strong><br>Papelería creativa y corporativa</p>
    </div>
    <div class="footer-links">
        <a href="index.php#products">Productos</a>
        <a href="index.php#about">Quiénes somos</a>
        <a href="index.php#contact">Contacto</a>
    </div>
    <div>
        <p>Síguenos</p>
        <div class="social-row">
        <a href="https://www.instagram.com/papelistudiocl/" target="_blank"><i class="fab fa-instagram"></i></a>
        <a href="https://wa.me/56965929120" target="_blank"><i class="fab fa-whatsapp"></i></a>
        </div>
    </div>
    </div>
    <div class="container copyright">
    © <span id="year"></span> Papeli Studio — Todos los derechos reservados.
    </div>
</footer>
</body>
</html>
