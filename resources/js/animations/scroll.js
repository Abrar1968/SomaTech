/**
 * Scroll-triggered animations using GSAP ScrollTrigger
 */

import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

// Register ScrollTrigger plugin
gsap.registerPlugin(ScrollTrigger);

/**
 * Initialize all scroll-based animations
 */
export function initScrollAnimations() {
    // Parallax backgrounds
    initParallax();
    
    // Section reveals
    initSectionReveals();
    
    // Progress indicators
    initProgressIndicator();
    
    // Horizontal scroll sections (if any)
    initHorizontalScroll();
}

/**
 * Parallax effect for background elements
 */
function initParallax() {
    gsap.utils.toArray('[data-parallax]').forEach((element) => {
        const speed = parseFloat(element.dataset.parallax) || 0.5;
        
        gsap.to(element, {
            scrollTrigger: {
                trigger: element,
                start: 'top bottom',
                end: 'bottom top',
                scrub: true,
            },
            y: (i, target) => -ScrollTrigger.maxScroll(window) * speed,
            ease: 'none',
        });
    });
}

/**
 * Section reveal animations
 */
function initSectionReveals() {
    // Stagger grid items
    gsap.utils.toArray('.grid[data-stagger]').forEach((grid) => {
        const items = grid.children;
        
        gsap.from(items, {
            scrollTrigger: {
                trigger: grid,
                start: 'top 80%',
                toggleActions: 'play none none reverse',
            },
            y: 60,
            opacity: 0,
            duration: 0.8,
            stagger: {
                amount: 0.6,
                from: 'start',
            },
            ease: 'power3.out',
        });
    });
    
    // Counter animations
    gsap.utils.toArray('[data-counter]').forEach((counter) => {
        const target = parseInt(counter.dataset.counter, 10);
        const suffix = counter.dataset.suffix || '';
        
        ScrollTrigger.create({
            trigger: counter,
            start: 'top 80%',
            once: true,
            onEnter: () => {
                gsap.to({ value: 0 }, {
                    value: target,
                    duration: 2,
                    ease: 'power2.out',
                    onUpdate: function() {
                        counter.textContent = Math.round(this.targets()[0].value) + suffix;
                    },
                });
            },
        });
    });
    
    // Text reveals with split text effect
    gsap.utils.toArray('[data-text-reveal]').forEach((element) => {
        const text = element.textContent;
        element.innerHTML = '';
        
        // Create wrapper for each word
        text.split(' ').forEach((word, i) => {
            const wordSpan = document.createElement('span');
            wordSpan.className = 'inline-block overflow-hidden';
            wordSpan.innerHTML = `<span class="inline-block">${word}&nbsp;</span>`;
            element.appendChild(wordSpan);
        });
        
        const innerSpans = element.querySelectorAll('span span');
        
        gsap.from(innerSpans, {
            scrollTrigger: {
                trigger: element,
                start: 'top 85%',
                toggleActions: 'play none none reverse',
            },
            y: '100%',
            opacity: 0,
            duration: 0.6,
            stagger: 0.03,
            ease: 'power3.out',
        });
    });
}

/**
 * Page progress indicator
 */
function initProgressIndicator() {
    const progressBar = document.querySelector('.scroll-progress');
    if (!progressBar) return;
    
    gsap.to(progressBar, {
        scrollTrigger: {
            trigger: document.body,
            start: 'top top',
            end: 'bottom bottom',
            scrub: 0.3,
        },
        scaleX: 1,
        ease: 'none',
    });
}

/**
 * Horizontal scrolling sections
 */
function initHorizontalScroll() {
    gsap.utils.toArray('[data-horizontal-scroll]').forEach((container) => {
        const sections = container.children;
        const totalWidth = Array.from(sections).reduce((acc, section) => acc + section.offsetWidth, 0);
        
        gsap.to(sections, {
            scrollTrigger: {
                trigger: container,
                start: 'top top',
                end: () => `+=${totalWidth}`,
                pin: true,
                scrub: 1,
            },
            x: () => -(totalWidth - window.innerWidth),
            ease: 'none',
        });
    });
}

/**
 * Magnetic button effect
 */
export function initMagneticButtons() {
    document.querySelectorAll('[data-magnetic]').forEach((button) => {
        button.addEventListener('mousemove', (e) => {
            const rect = button.getBoundingClientRect();
            const x = e.clientX - rect.left - rect.width / 2;
            const y = e.clientY - rect.top - rect.height / 2;
            
            gsap.to(button, {
                x: x * 0.3,
                y: y * 0.3,
                duration: 0.3,
                ease: 'power2.out',
            });
        });
        
        button.addEventListener('mouseleave', () => {
            gsap.to(button, {
                x: 0,
                y: 0,
                duration: 0.5,
                ease: 'elastic.out(1, 0.3)',
            });
        });
    });
}

/**
 * Tilt effect for cards
 */
export function initTiltEffect() {
    document.querySelectorAll('[data-tilt]').forEach((card) => {
        const intensity = parseFloat(card.dataset.tilt) || 10;
        
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            
            const rotateX = ((y - centerY) / centerY) * -intensity;
            const rotateY = ((x - centerX) / centerX) * intensity;
            
            gsap.to(card, {
                rotationX: rotateX,
                rotationY: rotateY,
                duration: 0.3,
                ease: 'power2.out',
                transformPerspective: 1000,
            });
        });
        
        card.addEventListener('mouseleave', () => {
            gsap.to(card, {
                rotationX: 0,
                rotationY: 0,
                duration: 0.5,
                ease: 'power2.out',
            });
        });
    });
}

// Auto-init when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        initScrollAnimations();
        initMagneticButtons();
        initTiltEffect();
    });
} else {
    initScrollAnimations();
    initMagneticButtons();
    initTiltEffect();
}

export default {
    initScrollAnimations,
    initMagneticButtons,
    initTiltEffect,
};
