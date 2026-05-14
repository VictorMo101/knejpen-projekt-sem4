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

  const eventsWrapper = document.getElementById('eventsWrapper');
  const eventsScrollBtnLeft = document.getElementById('eventsScrollBtnLeft');
  const eventsScrollBtnRight = document.getElementById('eventsScrollBtnRight');

  if (eventsWrapper && eventsScrollBtnRight && eventsScrollBtnLeft) {
    const cardWidth = 420; 
    const gap = 20; 
    const scrollDistance = cardWidth + gap; 

    // Get all event cards
    const getEventCards = () => {
      return Array.from(eventsWrapper.querySelectorAll('a'));
    };

    // Get currently centered card index
    const getCenteredCardIndex = () => {
      const cards = getEventCards();
      const scrollCenter = eventsWrapper.scrollLeft + eventsWrapper.clientWidth / 2;
      
      return cards.findIndex(card => {
        const rect = card.getBoundingClientRect();
        const cardCenter = rect.left + rect.width / 2 + eventsWrapper.scrollLeft - eventsWrapper.getBoundingClientRect().left;
        return Math.abs(cardCenter - scrollCenter) < scrollDistance / 2;
      });
    };

    // Scroll to card at index
    const scrollToCard = (index) => {
      const cards = getEventCards();
      if (cards[index]) {
        cards[index].scrollIntoView({
          behavior: 'smooth',
          block: 'nearest',
          inline: 'center'
        });
      }
    };

    eventsScrollBtnRight.addEventListener('click', () => {
      const currentIndex = getCenteredCardIndex();
      scrollToCard(currentIndex + 1);
    });

   
    eventsScrollBtnLeft.addEventListener('click', () => {
      const currentIndex = getCenteredCardIndex();
      scrollToCard(currentIndex - 1);
    });

   
    const updateButtonVisibility = () => {
      const scrollLeft = eventsWrapper.scrollLeft;
      
    
      if (scrollLeft <= 0) {
        eventsScrollBtnLeft.style.display = 'none';
      } else {
        eventsScrollBtnLeft.style.display = 'flex';
      }

    
      const scrollableWidth = eventsWrapper.scrollWidth - eventsWrapper.clientWidth;
      if (scrollLeft >= scrollableWidth) {
        eventsScrollBtnRight.style.display = 'none';
      } else {
        eventsScrollBtnRight.style.display = 'flex';
      }
    };

    eventsWrapper.addEventListener('scroll', updateButtonVisibility);
  
    updateButtonVisibility();
  }


