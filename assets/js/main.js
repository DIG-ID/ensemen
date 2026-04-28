// =============================================================================
// Base libraries
// =============================================================================
import './gsap.js';

// =============================================================================
// Optional libraries — uncomment as needed per project
// =============================================================================
// import './swiper.js';
// import './fancybox.js';

// =============================================================================
// Utilities
// =============================================================================
import { debounce, isTouchDevice } from './utils/helpers.js';

// =============================================================================
// Components
// =============================================================================
import { initPrimaryButtons, initHeaderButtons, initReservationButtons, initFooterButtons } from './buttons.js';
import { initAnimations, initParallax, initBannerIntro, initPinnedReveal, initMealsReveal, initPresentationDraw } from './animations.js';

// =============================================================================
// DOM ready
// =============================================================================
document.addEventListener('DOMContentLoaded', () => {

  initPrimaryButtons();
  initHeaderButtons();
  initReservationButtons();
  initFooterButtons();

  initAnimations();
  initParallax();
  initBannerIntro();
  initPinnedReveal();
  initPresentationDraw();
  initMealsReveal();

});
