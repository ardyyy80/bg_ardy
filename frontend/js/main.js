document.addEventListener('DOMContentLoaded', function() {
    initSmoothScroll();
    initScrollSpy();
    initScrollAnimations();
    initFormValidation();
    hideLoader();
});

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
    });
}

function initScrollAnimations() {
    const animateElements = document.querySelectorAll('.hero-content, .section-title, .profile-card, .game-card, .merch-card, .comment-form, .comment-item');
    
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
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

function initFormValidation() {
    const form = document.querySelector('.comment-form');
    
    if (!form) return;
    
    const nameInput = form.querySelector('#nama_penulis');
    const commentInput = form.querySelector('#detail_komen');
    
    nameInput.addEventListener('blur', function() {
        validateInput(this, 'Nama harus diisi');
    });
    
    nameInput.addEventListener('input', function() {
        if (this.value.trim().length > 0) {
            clearError(this);
        }
    });
    
    commentInput.addEventListener('blur', function() {
        validateInput(this, 'Komentar harus diisi');
    });
    
    commentInput.addEventListener('input', function() {
        if (this.value.trim().length > 0) {
            clearError(this);
        }
    });
    
    form.addEventListener('submit', function(e) {
        let isValid = true;
        
        if (!validateInput(nameInput, 'Nama harus diisi')) {
            isValid = false;
        }
        
        if (!validateInput(commentInput, 'Komentar harus diisi')) {
            isValid = false;
        }
        
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
    const formGroup = input.closest('.form-group');
    
    clearError(input);
    
    input.classList.add('error');
    
    const errorElement = document.createElement('span');
    errorElement.className = 'error-message';
    errorElement.textContent = message;
    
    formGroup.appendChild(errorElement);
}

function clearError(input) {
    const formGroup = input.closest('.form-group');
    const errorMessage = formGroup.querySelector('.error-message');
    
    input.classList.remove('error');
    
    if (errorMessage) {
        errorMessage.remove();
    }
}

function showLoader() {
    const loader = document.getElementById('pageLoader');
    if (loader) {
        loader.style.display = 'flex';
    }
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
