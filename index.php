<?php
session_start();
?>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Papeli Studio</title>
  <meta name="description" content="Papeli Studio — Papelería creativa y corporativa. Diseños, sublimación y regalos personalizados." />
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://unpkg.com/swiper@9/swiper-bundle.min.css"/>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

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
          <li><a href="#home">Inicio</a></li>
          <li><a href="#about">Quiénes Somos</a></li>
          <li><a href="#products">Productos</a></li>
          <li><a href="cursos.php">Cursos</a></li>
          <li><a href="#contact">Contacto</a></li>
        </ul>
      </nav>

      <div class="nav-actions">
        <?php if (isset($_SESSION['usuario'])): ?>
        <div class="user-menu">
        <button class="btn login user-btn">
          <?php echo $_SESSION['usuario']; ?> <i class="fa fa-caret-down"></i>
        </button>

        <div class="user-dropdown">
        <?php if ($_SESSION["rol"] == 1): ?>
            <a href="upgrade.php">✨ Hazte VIP</a>
        <?php endif; ?>

        <form action="logout.php" method="post">
            <button type="submit" class="logout-btn">Cerrar sesión</button>
        </form>
        </div>
        </div>
        <?php else: ?>
        <a class="btn login" href="Login.html">Inicia sesión</a>
        <?php endif; ?>

        <button class="hamburger" id="hamburger" aria-label="Abrir menú">
          <span></span><span></span><span></span>
        </button>
      </div>
    </div>
  </header>

  <section id="home" class="hero">
    <div class="container hero-inner">
      <h1 class="hero-title">¿Qué vamos a crear hoy?</h1>
      <p class="hero-sub">Diseños únicos, regalos personalizados y papelería que cuenta historias.</p>

      <div class="hero-cta">
        <a href="#products" class="btn primary">Ver productos</a>
        <a href="#contact" class="btn outline">Contáctanos</a>
      </div>
    </div>
  </section>

  <section id="products" class="section section-products">
    <div class="container">
      <h2 class="section-title">Productos Destacados</h2>

      <div class="swiper mySwiper">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <figure class="card">
              <img src="cake topper 1.png" alt="Producto 1">
              <figcaption>
                <h3>Cake Topper</h3>
                <p>Diseñamos el cake topper de tu preferencia.</p>
                <div class="price">Desde CLP $5000</div>
              </figcaption>
            </figure>
          </div>

          <div class="swiper-slide">
            <figure class="card">
              <img src="Taza 1.png" alt="Producto 2">
              <figcaption>
                <h3>Tazas Sublimadas</h3>
                <p>Diseños personalizables.</p>
                <div class="price">CLP $6.000</div>
              </figcaption>
            </figure>
          </div>

          <div class="swiper-slide">
            <figure class="card">
              <img src="Invitacion 1.png" alt="Producto 3">
              <figcaption>
                <h3>Invitaciones</h3>
                <p>Diseño y producción</p>
                <div class="price">Desde CLP $2.500</div>
              </figcaption>
            </figure>
          </div>

        </div>

        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
      </div>
    </div>
  </section>

  <section id="about" class="section section-about">
    <div class="container about-grid">
      <div class="about-text">
        <h2 class="section-title">Quiénes Somos</h2>
        <p>
          Papeli Studio es un taller creativo en Temuco que diseña papelería,
          material corporativo y regalos personalizados. Nos encanta transformar ideas en piezas únicas.
        </p>
        <ul class="about-list">
          <li>🧡 Diseño y papelería creativa</li>
          <li>🎁 Regalos personalizados</li>
          <li>🖨️ Sublimación y producción</li>
        </ul>
        <a class="btn primary" href="#contact">Solicitar presupuesto</a>
      </div>

      <div class="about-image">
        <img src="quienes somos.png" alt="Papeli Studio">
      </div>
    </div>
  </section>

  <section id="courses" class="section section-courses">
    <div class="container">
      <h2 class="section-title">Cursos</h2>
      <p>Próximamente abriremos cursos y talleres presenciales y online.</p>
    </div>
  </section>

  <section id="contact" class="section section-contact">
    <div class="container contact-grid">
      <div>
        <h2 class="section-title">Contacto</h2>
        <p>¿Tienes un proyecto? Escríbenos por WhatsApp o síguenos en Instagram.</p>

        <div class="contact-links">
          <a href="https://www.instagram.com/papelistudiocl/" target="_blank" rel="noopener" class="social">
            <i class="fab fa-instagram"></i> Papelistudiocl
          </a>

          <a href="https://wa.me/56965929120" target="_blank" rel="noopener" class="social">
            <i class="fab fa-whatsapp"></i> WhatsApp
          </a>
          
        </div>
      </div>

      <form action="https://formspree.io/f/movpqvoy" method="POST" class="contact-form">
        <label>
          Nombre
          <input type="text" name="name" placeholder="Tu nombre" required>
        </label>
        <label>
          Correo Electrónico
          <input type="email" name="email" placeholder="Email" required>
        </label>
        <label>
          Mensaje
          <textarea name="message" rows="4" placeholder="Cuéntanos tu idea" required></textarea>
        </label>

        <button class="btn primary" type="submit">Enviar</button>
      </form>
    </div>
  </section>

  <footer class="footer">
    <div class="container footer-grid">
      <div>
        <p class="brand-foot"><strong>Papeli Studio</strong><br>Papelería creativa y corporativa</p>
      </div>
      <div class="footer-links">
        <a href="#products">Productos</a>
        <a href="#about">Quiénes somos</a>
        <a href="#contact">Contacto</a>
      </div>
      <div>
        <p>Síguenos</p>
        <div class="social-row">
          <a href="https://www.instagram.com/papelistudiocl/" target="_blank" rel="noopener"><i class="fab fa-instagram"></i></a>
          <a href="https://wa.me/56965929120" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i></a>
        </div>
      </div>
    </div>
    <div class="container copyright">
      © <span id="year"></span> Papeli Studio — Todos los derechos reservados.
    </div>
  </footer>

  <a href="https://wa.me/56965929120" class="whatsapp-float" target="_blank" rel="noopener" aria-label="Contactar por WhatsApp">
    <i class="fab fa-whatsapp"></i>
  </a>

  <script src="https://unpkg.com/swiper@9/swiper-bundle.min.js"></script>

  <script src="papeli.js"></script>
</body>
</html>
