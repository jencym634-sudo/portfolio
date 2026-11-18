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

    // Theme Default (Warm Ivory Editorial)
    const savedTheme = localStorage.getItem('theme') || 'light';
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
    const sections = document.querySelectorAll('.section, .hero, .about-section, .work-section, .experience-section, .contact-section');
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
            const href = anchor.getAttribute('href');
            if (!href || href === '#' || href.length < 2) return;
            try {
                const target = document.querySelector(href);
                if (target) {
                    e.preventDefault();
                    const offset = 80;
                    const top = target.getBoundingClientRect().top + window.scrollY - offset;
                    window.scrollTo({ top, behavior: 'smooth' });
                }
            } catch (err) {
                // Ignore invalid selectors
            }
        });
    });

    // ===== SECTION 03: ACCESSIBLE MODALS & VIDEO PLAYER =====
    let activeModal = null;
    let lastActiveTrigger = null;

    function openModal(modalId, triggerElement) {
        const modal = document.getElementById(modalId);
        if (!modal) return;

        lastActiveTrigger = triggerElement || document.activeElement;
        modal.removeAttribute('hidden');
        // Force reflow for smooth CSS transition
        void modal.offsetWidth;
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
        activeModal = modal;

        // If this is the video modal, play video with graceful autoplay fallback
        if (modalId === 'videoModal') {
            const video = document.getElementById('aiAppVideoPlayer');
            if (video) {
                video.currentTime = 0;
                const playPromise = video.play();
                if (playPromise !== undefined) {
                    playPromise.catch((err) => {
                        console.warn('Unmuted autoplay prevented by browser policy; retrying muted:', err);
                        // If browser policy prevents unmuted playback, mute and retry so video plays immediately
                        video.muted = true;
                        video.play().catch((err2) => {
                            console.warn('Video playback requires user gesture on controls:', err2);
                        });
                    });
                }
            }
        }

        // Focus close button
        const closeBtn = modal.querySelector('.modal-close-btn');
        if (closeBtn) {
            closeBtn.focus();
        }
    }

    function closeModal(modal) {
        if (!modal) return;
        modal.classList.remove('active');
        document.body.style.overflow = '';

        // If this is the video modal, pause and reset video immediately
        const video = modal.querySelector('video');
        if (video) {
            video.pause();
            video.currentTime = 0;
        }

        setTimeout(() => {
            modal.setAttribute('hidden', '');
            if (lastActiveTrigger && typeof lastActiveTrigger.focus === 'function') {
                lastActiveTrigger.focus();
            }
            activeModal = null;
        }, 250);
    }

    // Expose globally so inline onclick attributes and external calls work reliably
    window.openModal = openModal;
    window.closeModal = closeModal;

    // Direct event delegation for all modal actions (handles dynamic or early clicks)
    document.addEventListener('click', (e) => {
        // 1. Triggers
        const trigger = e.target.closest('#btnWatchAiApp, #videoTriggerAiApp, #btnExploreIdliStack, #idliMediaTrigger, #btnViewFmsCaseStudy, #fmsMediaTrigger, [data-modal-target]');
        if (trigger) {
            if (trigger.id === 'btnWatchAiApp' || trigger.id === 'videoTriggerAiApp') {
                e.preventDefault();
                openModal('videoModal', trigger);
            } else if (trigger.id === 'btnExploreIdliStack' || trigger.id === 'idliMediaTrigger') {
                e.preventDefault();
                openModal('idliModal', trigger);
            } else if (trigger.id === 'btnViewFmsCaseStudy' || trigger.id === 'fmsMediaTrigger') {
                e.preventDefault();
                openModal('caseStudyModal', trigger);
            } else if (trigger.dataset && trigger.dataset.modalTarget) {
                e.preventDefault();
                openModal(trigger.dataset.modalTarget, trigger);
            }
            return;
        }

        // 2. Close Buttons
        const closeBtn = e.target.closest('.modal-close-btn');
        if (closeBtn) {
            const modal = closeBtn.closest('.project-modal');
            if (modal) {
                e.preventDefault();
                closeModal(modal);
            }
            return;
        }

        // 3. Backdrop Click
        if (e.target.classList && e.target.classList.contains('modal-backdrop')) {
            const modal = e.target.closest('.project-modal');
            if (modal) {
                e.preventDefault();
                closeModal(modal);
            }
        }
    });

    // Keyboard support for video trigger
    const videoTriggerAiApp = document.getElementById('videoTriggerAiApp');
    if (videoTriggerAiApp) {
        videoTriggerAiApp.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                openModal('videoModal', videoTriggerAiApp);
            }
        });
    }

    // Close on Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && activeModal) {
            closeModal(activeModal);
        }
    });
});
