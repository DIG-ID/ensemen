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
import { initPrimaryButtons, initFormButtons, initHeaderButtons, initReservationButtons, initFooterButtons } from './buttons.js';
import { initAnimations, initParallax, initBannerIntro, initPinnedReveal, initMealsReveal, initPresentationDraw, initWeeklyReveal } from './animations.js';

// =============================================================================
// DOM ready
// =============================================================================
document.addEventListener('DOMContentLoaded', () => {

  initPrimaryButtons();
  initFormButtons();
  initHeaderButtons();
  initReservationButtons();
  initFooterButtons();

  initAnimations();
  initParallax();
  initBannerIntro();
  initPinnedReveal();
  initPresentationDraw();
  initWeeklyReveal();
  initMealsReveal();

});
