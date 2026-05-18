document.getElementById("year").textContent = new Date().getFullYear();

// Scroll hide/reveal navbar (only on manual scrolling)
const navbar = document.querySelector('.site-header');
let lastScrollY = window.scrollY;
let isManualScroll = false; // Only true right after user input (not programmatic scrolls)
let manualScrollTimeoutId = null; // Clears the manual scroll flag after a short pause

const isMobile = () => window.matchMedia('(max-width: 768px)').matches;

const markManualScroll = () => {
  // Mark this as user-initiated scrolling (wheel)
  isManualScroll = true;

  if (manualScrollTimeoutId) {
    clearTimeout(manualScrollTimeoutId);
  }

  manualScrollTimeoutId = setTimeout(() => {
    // Reset after input stops so smooth scroll won't hide the navbar
    isManualScroll = false;
  }, 200);
};

// Manual scroll signals
window.addEventListener('wheel', markManualScroll);

window.addEventListener('scroll', () => {
  // Keep navbar visible on mobile or when scroll wasn't user-initiated
  if (isMobile() || !isManualScroll) {
    navbar.style.transform = 'translateY(0)';
    return;
  }

  // Hide on downward scroll, show on upward scroll
  if (window.scrollY > lastScrollY) {
    navbar.style.transform = 'translateY(-100%)';
  } else {
    navbar.style.transform = 'translateY(0)';
  }
  navbar.style.transition = 'transform 0.3s';
  lastScrollY = window.scrollY;
});

// Scroll-up indicator: show after leaving the hero section
const scrollUpIndicator = document.querySelector('.scroll-up-indicator');
const heroSection = document.getElementById('home');

if (scrollUpIndicator && heroSection) {
  const heroObserver = new IntersectionObserver(
    (entries) => {
      const entry = entries[0];
      scrollUpIndicator.classList.toggle('is-visible', !entry.isIntersecting);
    },
    { root: null, threshold: 0 }
  );

  heroObserver.observe(heroSection);
}

// Events carousel elements (wrapper holds the cards; buttons scroll it)
const eventsWrapper = document.getElementById('eventsWrapper');
const eventsScrollBtnLeft = document.getElementById('eventsScrollBtnLeft');
const eventsScrollBtnRight = document.getElementById('eventsScrollBtnRight');

if (eventsWrapper && eventsScrollBtnRight && eventsScrollBtnLeft) {
  // Scroll by one card width plus the CSS gap
  const getScrollStep = () => {
    const card = eventsWrapper.querySelector('.event-card') || eventsWrapper.querySelector('a');
    if (!card) {
      return 0;
    }

    const cardWidth = card.getBoundingClientRect().width;
    const styles = getComputedStyle(eventsWrapper);
    const gap = parseFloat(styles.columnGap || styles.gap || 0);

    return cardWidth + gap;
  };

  const scrollByStep = (direction) => {
    const step = getScrollStep();
    if (!step) {
      return;
    }

    eventsWrapper.scrollBy({
      left: step * direction,
      behavior: 'smooth'
    });
  };

  // Right button advances to the next card
  eventsScrollBtnRight.addEventListener('click', () => {
    scrollByStep(1);
  });

  // Left button goes to the previous card
  eventsScrollBtnLeft.addEventListener('click', () => {
    scrollByStep(-1);
  });

  // Hide buttons when you cannot scroll further in that direction
  const updateButtonVisibility = () => {
    const scrollLeft = eventsWrapper.scrollLeft;
    const scrollableWidth = eventsWrapper.scrollWidth - eventsWrapper.clientWidth;
    const edgeEpsilon = 2;
    const canScrollLeft = scrollLeft > edgeEpsilon;
    const canScrollRight = scrollLeft < scrollableWidth - edgeEpsilon;

    // Nothing to scroll: hide both buttons
    if (scrollableWidth <= edgeEpsilon) {
      eventsScrollBtnLeft.classList.add('is-hidden');
      eventsScrollBtnRight.classList.add('is-hidden');
      return;
    }

    eventsScrollBtnLeft.classList.toggle('is-hidden', !canScrollLeft);
    eventsScrollBtnRight.classList.toggle('is-hidden', !canScrollRight);
  };

  // Update buttons on manual scrolls, resize, and first load
  eventsWrapper.addEventListener('scroll', updateButtonVisibility);
  window.addEventListener('resize', updateButtonVisibility);

  updateButtonVisibility();
}

const burger = document.querySelector(".burger-btn");
const nav = document.querySelector(".phone-nav");
const navButtons = document.querySelectorAll(".phone-nav a");

burger.addEventListener("click", () => {
    nav.classList.toggle("active");
}); 

// Iterate over each nav button and attach a click listener that removes the "active" class from nav, closing the menu
navButtons.forEach((link ) => {
  link.addEventListener("click", () => {
    nav.classList.remove("active");
  });
});
