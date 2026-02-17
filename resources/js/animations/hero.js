/**
 * Hero Section Animations
 * 
 * Three.js canvas background with animated particles/mesh
 * GSAP text reveal animations
 */

import { gsap } from 'gsap';

/**
 * Initialize hero text reveal animations
 */
export function initHeroTextAnimations() {
    const heroTitle = document.querySelector('.hero-title');
    const heroSubtitle = document.querySelector('.hero-subtitle');
    const heroCTAs = document.querySelectorAll('.hero-cta');
    const scrollIndicator = document.querySelector('.scroll-indicator');
    
    const tl = gsap.timeline({ defaults: { ease: 'power3.out' } });
    
    // Title animation
    if (heroTitle) {
        tl.from(heroTitle, {
            y: 100,
            opacity: 0,
            duration: 1,
            delay: 0.3,
        });
    }
    
    // Subtitle animation
    if (heroSubtitle) {
        tl.from(heroSubtitle, {
            y: 50,
            opacity: 0,
            duration: 0.8,
        }, '-=0.5');
    }
    
    // CTA buttons stagger
    if (heroCTAs.length > 0) {
        tl.from(heroCTAs, {
            y: 30,
            opacity: 0,
            duration: 0.6,
            stagger: 0.15,
        }, '-=0.4');
    }
    
    // Scroll indicator bounce
    if (scrollIndicator) {
        tl.from(scrollIndicator, {
            opacity: 0,
            duration: 0.6,
        }, '-=0.2');
        
        // Continuous bounce animation
        gsap.to(scrollIndicator, {
            y: 10,
            duration: 1.5,
            ease: 'power1.inOut',
            repeat: -1,
            yoyo: true,
        });
    }
    
    return tl;
}

/**
 * Initialize Three.js hero canvas
 * Placeholder for actual Three.js implementation
 */
export async function initHeroCanvas() {
    const canvas = document.getElementById('hero-canvas');
    if (!canvas) return;
    
    try {
        // Dynamic import Three.js for better code splitting
        const THREE = await import('three');
        
        // Scene setup
        const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
        const renderer = new THREE.WebGLRenderer({ 
            canvas,
            alpha: true,
            antialias: true,
        });
        
        renderer.setSize(window.innerWidth, window.innerHeight);
        renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
        
        // Create particles
        const particlesGeometry = new THREE.BufferGeometry();
        const particleCount = 1500;
        const posArray = new Float32Array(particleCount * 3);
        
        for (let i = 0; i < particleCount * 3; i++) {
            posArray[i] = (Math.random() - 0.5) * 5;
        }
        
        particlesGeometry.setAttribute('position', new THREE.BufferAttribute(posArray, 3));
        
        // Particle material with accent color
        const particlesMaterial = new THREE.PointsMaterial({
            size: 0.005,
            color: 0x6C63FF, // --color-accent
            transparent: true,
            opacity: 0.8,
        });
        
        // Create mesh
        const particlesMesh = new THREE.Points(particlesGeometry, particlesMaterial);
        scene.add(particlesMesh);
        
        camera.position.z = 2;
        
        // Mouse movement tracking
        let mouseX = 0;
        let mouseY = 0;
        
        document.addEventListener('mousemove', (event) => {
            mouseX = (event.clientX / window.innerWidth) * 2 - 1;
            mouseY = -(event.clientY / window.innerHeight) * 2 + 1;
        });
        
        // Animation loop
        const animate = () => {
            requestAnimationFrame(animate);
            
            particlesMesh.rotation.x += 0.001;
            particlesMesh.rotation.y += 0.001;
            
            // Subtle mouse parallax
            particlesMesh.rotation.x += mouseY * 0.0005;
            particlesMesh.rotation.y += mouseX * 0.0005;
            
            renderer.render(scene, camera);
        };
        
        animate();
        
        // Handle resize
        window.addEventListener('resize', () => {
            camera.aspect = window.innerWidth / window.innerHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(window.innerWidth, window.innerHeight);
        });
        
        // Cleanup function
        return () => {
            renderer.dispose();
            particlesGeometry.dispose();
            particlesMaterial.dispose();
        };
        
    } catch (error) {
        console.warn('Three.js not available, hero canvas disabled:', error);
    }
}

/**
 * Initialize all hero animations
 */
export function initHero() {
    initHeroTextAnimations();
    initHeroCanvas();
}

// Auto-init if DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initHero);
} else {
    initHero();
}
