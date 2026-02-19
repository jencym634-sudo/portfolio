/**
 * Jency Portfolio — Main JavaScript
 * Parallax scrolling, fade-in animations, dark/light mode,
 * page loader, scroll progress, contact form.
 */

document.addEventListener('DOMContentLoaded', () => {
    // ===== PAGE LOADER =====
    const loader = document.getElementById('pageLoader');
    if (loader) {
        setTimeout(() => loader.classList.add('hidden'), 800);
    }

    // ===== THEME TOGGLE (Dark/Light) =====
    const themeToggle = document.getElementById('themeToggle');
    const themeIcon = document.getElementById('themeIcon');
    const html = document.documentElement;

    // Check saved theme
    const savedTheme = localStorage.getItem('theme') || 'dark';
    html.setAttribute('data-theme', savedTheme);
    updateThemeIcon(savedTheme);

    if (themeToggle) {
        themeToggle.addEventListener('click', () => {
            const current = html.getAttribute('data-theme');
            const next = current === 'dark' ? 'light' : 'dark';
            html.setAttribute('data-theme', next);
            localStorage.setItem('theme', next);
            updateThemeIcon(next);
        });
    }

    function updateThemeIcon(theme) {
        if (!themeIcon) return;
        themeIcon.className = theme === 'dark' ? 'fas fa-moon' : 'fas fa-sun';
    }

    // ===== SCROLL PROGRESS BAR =====
    const scrollProgress = document.getElementById('scrollProgress');
    function updateScrollProgress() {
        const scrollTop = window.scrollY;
        const docHeight = document.documentElement.scrollHeight - window.innerHeight;
        const progress = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;
        if (scrollProgress) {
            scrollProgress.style.width = progress + '%';
        }
    }

    // ===== NAVBAR SCROLL EFFECT =====
    const navbar = document.getElementById('navbar');
    function handleNavbarScroll() {
        if (!navbar) return;
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    }

    // ===== ACTIVE NAV LINK =====
    const sections = document.querySelectorAll('.section, .hero');
    const navLinks = document.querySelectorAll('.nav-link');

    function updateActiveLink() {
        let current = '';
        sections.forEach(section => {
            const top = section.offsetTop - 120;
            if (window.scrollY >= top) {
                current = section.getAttribute('id');
            }
        });

        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href') === '#' + current) {
                link.classList.add('active');
            }
        });
    }

    // ===== HAMBURGER MENU =====
    const hamburger = document.getElementById('navHamburger');
    const navMenu = document.getElementById('navMenu');

    if (hamburger && navMenu) {
        hamburger.addEventListener('click', () => {
            hamburger.classList.toggle('active');
            navMenu.classList.toggle('active');
        });

        // Close menu on link click
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                hamburger.classList.remove('active');
                navMenu.classList.remove('active');
            });
        });
    }

    // ===== FADE-IN ON SCROLL (Intersection Observer) =====
    const fadeElements = document.querySelectorAll('.fade-in, .fade-in-left, .fade-in-right');
    const fadeObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                fadeObserver.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });

    fadeElements.forEach(el => fadeObserver.observe(el));

    // ===== SKILL BAR ANIMATION =====
    const skillBars = document.querySelectorAll('.skill-progress');
    const skillObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const bar = entry.target;
                const percentage = bar.getAttribute('data-percentage');
                bar.style.width = percentage + '%';
                bar.classList.add('animated');
                skillObserver.unobserve(bar);
            }
        });
    }, { threshold: 0.3 });

    skillBars.forEach(bar => skillObserver.observe(bar));

    // ===== PARALLAX SCROLLING =====
    const parallaxElements = document.querySelectorAll('[data-parallax]');
    const heroOrbs = document.querySelectorAll('.hero-orb');

    function handleParallax() {
        const scrollY = window.scrollY;

        parallaxElements.forEach(el => {
            const speed = parseFloat(el.getAttribute('data-parallax')) || 0.3;
            const offset = scrollY * speed;
            el.style.transform = `translateY(${offset}px)`;
        });

        // Hero orbs parallax
        heroOrbs.forEach((orb, i) => {
            const speed = 0.15 + (i * 0.1);
            orb.style.transform = `translateY(${scrollY * speed}px)`;
        });
    }

    // ===== LAZY LOAD IMAGES =====
    const lazyImages = document.querySelectorAll('img[loading="lazy"]');
    lazyImages.forEach(img => {
        if (img.complete) {
            img.classList.add('loaded');
        } else {
            img.addEventListener('load', () => img.classList.add('loaded'));
        }
    });

    // ===== SCROLL EVENT (optimized with rAF) =====
    let ticking = false;
    window.addEventListener('scroll', () => {
        if (!ticking) {
            requestAnimationFrame(() => {
                updateScrollProgress();
                handleNavbarScroll();
                updateActiveLink();
                handleParallax();
                ticking = false;
            });
            ticking = true;
        }
    });

    // Initial calls
    updateScrollProgress();
    handleNavbarScroll();
    updateActiveLink();

    // ===== CONTACT FORM =====
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const btn = contactForm.querySelector('.btn-submit');
            const msgDiv = document.getElementById('formMessage');
            const originalText = btn.innerHTML;

            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';

            try {
                const formData = new FormData(contactForm);
                const response = await fetch('includes/contact_handler.php', {
                    method: 'POST',
                    body: formData
                });
                const data = await response.json();

                if (msgDiv) {
                    msgDiv.className = 'form-message ' + (data.success ? 'success' : 'error');
                    msgDiv.textContent = data.message;
                    msgDiv.style.display = 'block';
                }

                if (data.success) {
                    contactForm.reset();
                    // Regenerate CSRF token
                    if (data.new_token) {
                        const csrfInput = contactForm.querySelector('input[name="csrf_token"]');
                        if (csrfInput) csrfInput.value = data.new_token;
                    }
                }
            } catch (err) {
                if (msgDiv) {
                    msgDiv.className = 'form-message error';
                    msgDiv.textContent = 'An error occurred. Please try again.';
                    msgDiv.style.display = 'block';
                }
            } finally {
                btn.disabled = false;
                btn.innerHTML = originalText;
                setTimeout(() => {
                    if (msgDiv) msgDiv.style.display = 'none';
                }, 5000);
            }
        });
    }

    // ===== SMOOTH SCROLL FOR ANCHOR LINKS =====
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', (e) => {
            e.preventDefault();
            const target = document.querySelector(anchor.getAttribute('href'));
            if (target) {
                const offset = 80;
                const top = target.getBoundingClientRect().top + window.scrollY - offset;
                window.scrollTo({ top, behavior: 'smooth' });
            }
        });
    });
});
