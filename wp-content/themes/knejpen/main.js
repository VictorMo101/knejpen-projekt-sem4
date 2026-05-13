document.getElementById("year").textContent = new Date().getFullYear();

  // Scroll hide/reveal navbar
  let lastScrollY = window.scrollY;
  const navbar = document.querySelector('.site-header');

  window.addEventListener('scroll', () => {
    if (window.scrollY > lastScrollY) {
      navbar.style.transform = 'translateY(-100%)';
    } else {
      navbar.style.transform = 'translateY(0)';
    }
    navbar.style.transition = 'transform 0.3s';
    lastScrollY = window.scrollY;
  });

