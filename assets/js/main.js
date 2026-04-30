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
import { initPrimaryButtons, initPrimaryButtonsReversed, initFormButtons, initHeaderButtons, initReservationButtons, initFooterButtons, initStaticBorders } from './buttons.js';
import { initMealsReveal, initPresentationDraw, initWeeklyReveal } from './animations.js';

// =============================================================================
// DOM ready
// =============================================================================
document.addEventListener('DOMContentLoaded', () => {

  initPrimaryButtons();
  initPrimaryButtonsReversed();
  initFormButtons();
  initHeaderButtons();
  initReservationButtons();
  initFooterButtons();
  initStaticBorders();

  initPresentationDraw();
  initWeeklyReveal();
  initMealsReveal();

});
