import { initHamburger } from './composables/hamburger.js';
import { initSmoothScroll } from './composables/smoothScroll.js';
import { initScrollSpy, initScrollSpyOnLoad } from './composables/scrollSpy.js';
import { initNavbarScroll } from './composables/navbarScroll.js';
import { initScrollAnimations } from './composables/scrollAnimations.js';
import { initFormValidation } from './composables/formValidation.js';
import { initSuccessModal } from './composables/successModal.js';
import { hideLoader } from './composables/loader.js';

document.addEventListener('DOMContentLoaded', function() {
    initHamburger();
    initSmoothScroll();
    initScrollSpy();
    initScrollSpyOnLoad();
    initScrollAnimations();
    initFormValidation();
    initNavbarScroll();
    initSuccessModal();
    hideLoader();
});
