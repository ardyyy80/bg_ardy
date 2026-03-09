export function initScrollAnimations() {
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
