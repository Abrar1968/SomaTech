import './bootstrap';

// Alpine.js - Reactive UI Framework
import Alpine from 'alpinejs';
import intersect from '@alpinejs/intersect';
import focus from '@alpinejs/focus';

// Register Alpine Plugins
Alpine.plugin(intersect);
Alpine.plugin(focus);

// Make Alpine available globally
window.Alpine = Alpine;

// Start Alpine
Alpine.start();

// GSAP Animations (async import for performance)
const initGSAP = async () => {
    const { gsap } = await import('gsap');
    const { ScrollTrigger } = await import('gsap/ScrollTrigger');
    
    gsap.registerPlugin(ScrollTrigger);
    
    // Fade-up animations
    gsap.utils.toArray('[data-gsap="fade-up"]').forEach((element) => {
        const delay = element.dataset.gsapDelay || 0;
        gsap.from(element, {
            scrollTrigger: {
                trigger: element,
                start: 'top 90%',
                toggleActions: 'play none none reverse',
            },
            y: 50,
            opacity: 0,
            duration: 0.8,
            delay: parseFloat(delay),
            ease: 'power3.out',
        });
    });
    
    // Fade-in animations
    gsap.utils.toArray('[data-gsap="fade-in"]').forEach((element) => {
        const delay = element.dataset.gsapDelay || 0;
        gsap.from(element, {
            scrollTrigger: {
                trigger: element,
                start: 'top 90%',
                toggleActions: 'play none none reverse',
            },
            opacity: 0,
            duration: 0.8,
            delay: parseFloat(delay),
            ease: 'power2.out',
        });
    });
    
    // Scale animations
    gsap.utils.toArray('[data-gsap="scale"]').forEach((element) => {
        const delay = element.dataset.gsapDelay || 0;
        gsap.from(element, {
            scrollTrigger: {
                trigger: element,
                start: 'top 90%',
                toggleActions: 'play none none reverse',
            },
            scale: 0.8,
            opacity: 0,
            duration: 0.8,
            delay: parseFloat(delay),
            ease: 'back.out(1.7)',
        });
    });
    
    // Stagger children animations
    gsap.utils.toArray('[data-gsap="stagger"]').forEach((container) => {
        const children = container.children;
        gsap.from(children, {
            scrollTrigger: {
                trigger: container,
                start: 'top 90%',
                toggleActions: 'play none none reverse',
            },
            y: 30,
            opacity: 0,
            duration: 0.6,
            stagger: 0.1,
            ease: 'power3.out',
        });
    });
};

// Initialize GSAP when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    // Check if we're on a page that needs animations
    if (document.querySelector('[data-gsap]')) {
        initGSAP();
    }
});

// Smooth scroll for anchor links
document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener('click', function (e) {
        const targetId = this.getAttribute('href');
        if (targetId === '#') return;
        
        const target = document.querySelector(targetId);
        if (target) {
            e.preventDefault();
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start',
            });
        }
    });
});

// Handle navbar background on scroll
const navbar = document.querySelector('nav');
if (navbar) {
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            navbar.classList.add('bg-[var(--color-bg-primary)]/90', 'border-b', 'border-[var(--color-border)]');
        } else {
            navbar.classList.remove('bg-[var(--color-bg-primary)]/90', 'border-b', 'border-[var(--color-border)]');
        }
    });
}

// Page visibility handling for animations
document.addEventListener('visibilitychange', () => {
    if (document.hidden) {
        // Pause heavy animations when tab is hidden
        document.body.classList.add('reduce-motion');
    } else {
        document.body.classList.remove('reduce-motion');
    }
});

// Export for module usage
export { Alpine };
