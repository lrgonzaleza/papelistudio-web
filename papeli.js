
const hamburger = document.getElementById('hamburger');
const nav = document.getElementById('nav');

hamburger.addEventListener('click', () => {
  nav.classList.toggle('open');
  hamburger.classList.toggle('active');
});

const yearEl = document.getElementById('year');
if (yearEl) {
  yearEl.textContent = new Date().getFullYear();
}


const swiper = new Swiper('.mySwiper', {
  // Parameters
  speed: 700,
  loop: true,
  slidesPerView: 1.05,
  spaceBetween: 18,
  centeredSlides: false,
  grabCursor: true,

  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },

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

  autoplay: {
    delay: 4200,
    disableOnInteraction: false,
  }
});

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