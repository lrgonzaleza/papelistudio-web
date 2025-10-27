// Archivo: script.js

// NAV hamburger toggle
const hamburger = document.getElementById('hamburger');
const nav = document.getElementById('nav');

hamburger.addEventListener('click', () => {
  nav.classList.toggle('open');
  hamburger.classList.toggle('active');
});

// Set current year in footer
document.getElementById('year').textContent = new Date().getFullYear();

// Inicializar Swiper (carrusel moderno y táctil)
const swiper = new Swiper('.mySwiper', {
  // Parameters
  speed: 700,
  loop: true,
  slidesPerView: 1.05,
  spaceBetween: 18,
  centeredSlides: false,
  grabCursor: true,

  // Pagination and navigation
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },

  // Responsive breakpoints
  breakpoints: {
    640: {
      slidesPerView: 1.2,
      spaceBetween: 16,
    },
    900: {
      slidesPerView: 2,
      spaceBetween: 18,
    },
    1100: {
      slidesPerView: 2.5,
      spaceBetween: 24,
    }
  },

  // Effect optional (fade/slide/creative)
  effect: 'slide',
  // Autoplay (comment out if you prefer no autoplay)
  autoplay: {
    delay: 4200,
    disableOnInteraction: false,
  }
});

// Smooth scroll for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function(e){
    const target = this.getAttribute('href');
    if(target.length > 1){
      e.preventDefault();
      const el = document.querySelector(target);
      if(el) el.scrollIntoView({ behavior: 'smooth', block: 'start' });
      // close mobile nav after clicking
      if(nav.classList.contains('open')) nav.classList.remove('open');
    }
  });
});

