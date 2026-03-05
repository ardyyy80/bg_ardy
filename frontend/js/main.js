document.addEventListener('DOMContentLoaded', function() {
    initHamburger();
    initSmoothScroll();
    initScrollSpy();
    initScrollSpyOnLoad();
    initScrollAnimations();
    initFormValidation();
    initNavbarScroll();
    hideLoader();
});

/* ============================================
   HAMBURGER MENU
   ============================================ */
function initHamburger() {
    const hamburger = document.getElementById('hamburger');
    const navMenu = document.getElementById('navMenu');
    if (!hamburger || !navMenu) return;

    const overlay = document.createElement('div');
    overlay.classList.add('nav-overlay', 'visible');
    document.body.appendChild(overlay);

    function openMenu() {
        hamburger.classList.add('open');
        hamburger.setAttribute('aria-expanded', 'true');
        navMenu.classList.add('open');
        document.body.style.overflow = 'hidden';
        requestAnimationFrame(() => overlay.classList.add('open'));
    }

    function closeMenu() {
        hamburger.classList.remove('open');
        hamburger.setAttribute('aria-expanded', 'false');
        navMenu.classList.remove('open');
        overlay.classList.remove('open');
        document.body.style.overflow = '';
    }

    hamburger.addEventListener('click', () => {
        hamburger.classList.contains('open') ? closeMenu() : openMenu();
    });

    overlay.addEventListener('click', closeMenu);

    navMenu.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', closeMenu);
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeMenu();
    });
}

/* ============================================
   SMOOTH SCROLL
   ============================================ */
function initSmoothScroll() {
    const navLinks = document.querySelectorAll('.nav-menu a[href^="#"]');

    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();

            const targetId = this.getAttribute('href');
            const targetSection = document.querySelector(targetId);

            if (targetSection) {
                const navHeight = document.querySelector('.navbar').offsetHeight;
                const targetPosition = targetSection.offsetTop - navHeight;

                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
}

/* ============================================
   SCROLL SPY — set active on load
   ============================================ */
function initScrollSpyOnLoad() {
    const hash = window.location.hash;
    const navLinks = document.querySelectorAll('.nav-menu a[href^="#"]');

    navLinks.forEach(link => link.classList.remove('active'));

    if (hash) {
        navLinks.forEach(link => {
            if (link.getAttribute('href') === hash) {
                link.classList.add('active');
            }
        });
    } else if (navLinks.length > 0) {
        navLinks[0].classList.add('active');
    }
}

function initScrollSpy() {
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.nav-menu a[href^="#"]');

    window.addEventListener('scroll', () => {
        let current = '';
        const navHeight = document.querySelector('.navbar').offsetHeight;

        sections.forEach(section => {
            const sectionTop = section.offsetTop - navHeight - 100;
            const sectionHeight = section.offsetHeight;

            if (window.pageYOffset >= sectionTop && window.pageYOffset < sectionTop + sectionHeight) {
                current = section.getAttribute('id');
            }
        });

        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href') === '#' + current) {
                link.classList.add('active');
            }
        });
    }, { passive: true });
}

/* ============================================
   NAVBAR SCROLL EFFECT
   ============================================ */
function initNavbarScroll() {
    const navbar = document.querySelector('.navbar');

    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    }, { passive: true });
}

/* ============================================
   SCROLL ANIMATIONS
   ============================================ */
function initScrollAnimations() {
    const animateElements = document.querySelectorAll(
        '.hero-content, .section-title, .profile-card, .game-card, .merch-card, .comment-form, .comment-item'
    );

    const observerOptions = {
        threshold: 0.08,
        rootMargin: '0px 0px -40px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    animateElements.forEach(element => {
        element.classList.add('animate-fade');
        observer.observe(element);
    });
}

/* ============================================
   FORM VALIDATION
   ============================================ */
function initFormValidation() {
    const form = document.querySelector('.comment-form');
    if (!form) return;

    const nameInput = form.querySelector('#nama_penulis');
    const commentInput = form.querySelector('#detail_komen');

    if (nameInput) {
        nameInput.dataset.originalPlaceholder = nameInput.placeholder;

        nameInput.addEventListener('blur', function() {
            validateInput(this, 'Nama harus diisi');
        });

        nameInput.addEventListener('focus', function() {
            if (this.classList.contains('error')) restorePlaceholder(this);
        });

        nameInput.addEventListener('input', function() {
            if (this.value.trim().length > 0) clearError(this);
        });
    }

    if (commentInput) {
        commentInput.dataset.originalPlaceholder = commentInput.placeholder;

        commentInput.addEventListener('blur', function() {
            validateInput(this, 'Komentar harus diisi');
        });

        commentInput.addEventListener('focus', function() {
            if (this.classList.contains('error')) restorePlaceholder(this);
        });

        commentInput.addEventListener('input', function() {
            if (this.value.trim().length > 0) clearError(this);
        });
    }

    form.addEventListener('submit', function(e) {
        let isValid = true;

        if (nameInput && !validateInput(nameInput, 'Nama harus diisi')) isValid = false;
        if (commentInput && !validateInput(commentInput, 'Komentar harus diisi')) isValid = false;

        if (!isValid) {
            e.preventDefault();
            return false;
        }

        showLoader();
    });
}

function validateInput(input, errorMessage) {
    const value = input.value.trim();
    if (value === '') {
        showError(input, errorMessage);
        return false;
    }
    clearError(input);
    return true;
}

function showError(input, message) {
    input.classList.add('error');
    input.placeholder = message;
}

function clearError(input) {
    input.classList.remove('error');
    restorePlaceholder(input);
}

function restorePlaceholder(input) {
    if (input.dataset.originalPlaceholder) {
        input.placeholder = input.dataset.originalPlaceholder;
    }
}

/* ============================================
   PAGE LOADER
   ============================================ */
function showLoader() {
    const loader = document.getElementById('pageLoader');
    if (loader) loader.style.display = 'flex';
}

function hideLoader() {
    const loader = document.getElementById('pageLoader');
    if (loader) {
        setTimeout(() => {
            loader.style.opacity = '0';
            setTimeout(() => {
                loader.style.display = 'none';
            }, 300);
        }, 500);
    }
}

/* ============================================
   SUCCESS MODAL
   ============================================ */
function closeSuccessModal() {
    document.getElementById('successModal').style.display = 'none';
}

window.onclick = function(event) {
    const modal = document.getElementById('successModal');
    if (event.target == modal) closeSuccessModal();
};
