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

// Events carousel elements
const eventsWrapper = document.getElementById('eventsWrapper');
const eventsScrollBtnLeft = document.getElementById('eventsScrollBtnLeft');
const eventsScrollBtnRight = document.getElementById('eventsScrollBtnRight');

const isMobile = () => window.innerWidth <= 1023;

if (eventsWrapper && eventsScrollBtnRight && eventsScrollBtnLeft) {

  const getScrollStep = () => {
    const card = eventsWrapper.querySelector('.event-card') || eventsWrapper.querySelector('a');
    if (!card) return 0;

    const cardWidth = card.getBoundingClientRect().width;
    const styles = getComputedStyle(eventsWrapper);
    const gap = parseFloat(styles.columnGap || styles.gap || 0);

    return cardWidth + gap;
  };

  const scrollByStep = (direction) => {
    if (isMobile()) return; // disable carousel on very small screens

    const step = getScrollStep();
    if (!step) return;

    eventsWrapper.scrollBy({
      left: step * direction,
      behavior: 'smooth'
    });
  };

  const updateButtonVisibility = () => {
    // mobil
    if (isMobile()) {
      eventsScrollBtnLeft.classList.add('is-hidden');
      eventsScrollBtnRight.classList.add('is-hidden');
      return;
    }

    const scrollLeft = eventsWrapper.scrollLeft;
    const scrollableWidth = eventsWrapper.scrollWidth - eventsWrapper.clientWidth;
    const edgeEpsilon = 2;

    const canScrollLeft = scrollLeft > edgeEpsilon;
    const canScrollRight = scrollLeft < scrollableWidth - edgeEpsilon;

    if (scrollableWidth <= edgeEpsilon) {
      eventsScrollBtnLeft.classList.add('is-hidden');
      eventsScrollBtnRight.classList.add('is-hidden');
      return;
    }

    eventsScrollBtnLeft.classList.toggle('is-hidden', !canScrollLeft);
    eventsScrollBtnRight.classList.toggle('is-hidden', !canScrollRight);
  };

  eventsScrollBtnRight.addEventListener('click', () => scrollByStep(1));
  eventsScrollBtnLeft.addEventListener('click', () => scrollByStep(-1));

  eventsWrapper.addEventListener('scroll', updateButtonVisibility);
  window.addEventListener('resize', updateButtonVisibility);

  updateButtonVisibility();
}

// Burger menu for mobile/tablet
const burger = document.querySelector(".burger-btn");
const nav = document.querySelector(".site-nav");

if (burger && nav) {
  burger.addEventListener("click", () => {
    nav.classList.toggle("active");
  });
}