<?php
/**
 * Jency Portfolio — Main User-Facing Page
 * Renders all sections dynamically from the database.
 */
require_once 'config/config.php';
require_once 'includes/functions.php';

// Fetch all data
$hero = db_fetch_one($conn, "SELECT * FROM hero ORDER BY id DESC LIMIT 1");
$about = db_fetch_one($conn, "SELECT * FROM about ORDER BY id DESC LIMIT 1");
$skills = db_fetch_all($conn, "SELECT * FROM skills ORDER BY percentage DESC");
$projects = db_fetch_all($conn, "SELECT * FROM projects ORDER BY created_at DESC");
$social_links = db_fetch_all($conn, "SELECT * FROM social_links ORDER BY id ASC");

$page_title = 'Jency | Full-Stack Developer & Designer';
require_once 'includes/header.php';
?>

<!-- ===== HERO SECTION (APPROVED EDITORIAL DESIGN) ===== -->
<section class="hero" id="home">
    <!-- Organic abstract background shapes -->
    <div class="editorial-shape shape-top-left" aria-hidden="true">
        <svg viewBox="0 0 600 450" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M-80 -40 C140 -20 280 120 230 290 C190 420 70 440 -60 410 Z" fill="#E8EEDC" />
            <path d="M-60 -20 C110 0 220 100 180 230 C150 330 60 360 -40 340 Z" fill="#DFE7CE" opacity="0.6" />
        </svg>
    </div>
    
    <div class="editorial-shape shape-bottom-right" aria-hidden="true">
        <svg viewBox="0 0 650 500" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M380 40 C480 140 640 180 720 290 C800 400 660 520 480 500 C300 480 180 340 260 210 C310 130 330 -10 380 40 Z" fill="#E8EEDC" />
            <path d="M420 120 C490 200 600 220 640 310 C680 400 580 470 450 440 C320 410 250 320 310 220 Z" fill="#DFE7CE" opacity="0.6" />
        </svg>
    </div>

    <div class="hero-container">
        <!-- LEFT COLUMN: Headline & Narrative -->
        <div class="hero-left-col">
            <div class="hero-eyebrow">
                <span class="eyebrow-item">SOFTWARE</span>
                <span class="eyebrow-bullet">·</span>
                <span class="eyebrow-item">PRODUCT THINKING</span>
                <span class="eyebrow-bullet">·</span>
                <span class="eyebrow-item">QUALITY</span>
            </div>

            <h1 class="hero-headline">
                Before building a <span class="dashes-accent dashes-top" aria-hidden="true"></span><br>
                solution, <span class="highlight-pill"><em>I question</em></span><br>
                the problem.
            </h1>

            <p class="hero-intro">
                I'm Jency — a software developer who enjoys understanding problems, exploring possibilities and making technology genuinely useful.
            </p>

            <div class="hero-cta-group">
                <a href="#work" class="btn-editorial btn-primary-olive">
                    <span>Explore My Work</span>
                    <span class="btn-icon">↗</span>
                </a>
                <a href="#about" class="btn-editorial btn-outline-charcoal">
                    <span>More About Me</span>
                    <span class="btn-icon">→</span>
                </a>
            </div>
        </div>

        <!-- RIGHT COLUMN: Portrait Presentation -->
        <div class="hero-right-col">
            <div class="portrait-stage">
                <!-- Olive-green offset tilted backdrop card -->
                <div class="portrait-card-backdrop"></div>

                <!-- Main photo frame with white border and rounded corners -->
                <div class="portrait-frame">
                    <img src="assets/images/jency-portrait.jpg" 
                         alt="Jency M. - Portrait" 
                         class="portrait-img" 
                         loading="eager">
                </div>

                <!-- Floating Badge 1: Top-Left (Software Developer) -->
                <div class="floating-badge badge-developer">
                    <span class="badge-icon" aria-hidden="true">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                            <line x1="1" y1="20" x2="23" y2="20"></line>
                        </svg>
                    </span>
                    <span class="badge-title">Software Developer</span>
                </div>

                <!-- Floating Badge 2: Mid-Right (Product Thinker) -->
                <div class="floating-badge badge-thinker">
                    <span class="badge-icon" aria-hidden="true">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                            <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                            <line x1="12" y1="22.08" x2="12" y2="12"></line>
                        </svg>
                    </span>
                    <span class="badge-title">Product Thinker</span>
                </div>

                <!-- Floating Badge 3: Bottom-Left (Quality Engineer) -->
                <div class="floating-badge badge-quality">
                    <span class="badge-icon" aria-hidden="true">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                            <polyline points="9 12 11 14 15 10"></polyline>
                        </svg>
                    </span>
                    <span class="badge-title">Quality Engineer</span>
                </div>

                <!-- Subtle accent dash marks -->
                <span class="dashes-accent dashes-portrait" aria-hidden="true"></span>
            </div>
        </div>
    </div>

    <!-- ===== SECTION 5: FOUR-STEP THINKING APPROACH ===== -->
    <div class="approach-section">
        <div class="approach-header">
            <span class="approach-rule"></span>
            <span class="approach-tag">MY APPROACH</span>
            <span class="approach-rule"></span>
        </div>

        <!-- Four Individual Cards in a Visually Connected Sequence -->
        <div class="approach-sequence-grid">
            <div class="approach-card card-question">
                <div class="card-step-header">
                    <span class="card-step-badge num-olive">01</span>
                    <span class="card-connector-arrow" aria-hidden="true">→</span>
                </div>
                <h3 class="card-step-title">Question</h3>
                <p class="card-step-desc">Understand the actual problem and why it exists.</p>
            </div>

            <div class="approach-card card-explore">
                <div class="card-step-header">
                    <span class="card-step-badge num-yellow">02</span>
                    <span class="card-connector-arrow" aria-hidden="true">→</span>
                </div>
                <h3 class="card-step-title">Explore</h3>
                <p class="card-step-desc">Investigate existing tools and possible solutions.</p>
            </div>

            <div class="approach-card card-evaluate">
                <div class="card-step-header">
                    <span class="card-step-badge num-coral">03</span>
                    <span class="card-connector-arrow" aria-hidden="true">→</span>
                </div>
                <h3 class="card-step-title">Evaluate</h3>
                <p class="card-step-desc">Determine whether existing solutions work or whether something new is genuinely necessary.</p>
            </div>

            <div class="approach-card card-solve">
                <div class="card-step-header">
                    <span class="card-step-badge num-green">04</span>
                </div>
                <h3 class="card-step-title">Solve</h3>
                <p class="card-step-desc">Recommend or build the solution that addresses the actual problem.</p>
            </div>
        </div>
    </div>
</section>

<!-- ===== SECTION 02: ABOUT ME ===== -->
<section class="about-section" id="about">
    <div class="editorial-shape shape-about-top-right" aria-hidden="true">
        <svg viewBox="0 0 500 400" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M280 20 C360 80 440 140 480 230 C520 320 440 380 340 370 C240 360 180 280 200 180 C210 110 230 -20 280 20 Z" fill="#E8EEDC" opacity="0.6"/>
        </svg>
    </div>
    <div class="editorial-shape shape-about-bottom-left" aria-hidden="true">
        <svg viewBox="0 0 460 380" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M120 40 C220 10 320 60 380 150 C440 240 400 340 300 360 C200 380 100 320 60 220 C20 120 60 60 120 40 Z" fill="#DFE7CE" opacity="0.5"/>
        </svg>
    </div>

    <div class="about-container">
        <!-- A. Section Label -->
        <div class="about-section-header">
            <span class="about-section-tag">02 / ABOUT ME</span>
            <span class="about-section-line"></span>
        </div>

        <!-- B. Introduction – Two Column Layout -->
        <div class="about-intro-grid">
            <div class="about-intro-left">
                <h2 class="about-main-headline">
                    A curious builder who connects people, problems and <span class="highlight-pill"><em>possible solutions</em></span>.
                </h2>
            </div>
            <div class="about-intro-right">
                <p class="about-paragraph">
                    I'm Jency, a BCA graduate and a software developer from Tamil Nadu. I enjoy working at the intersection of technology, people and social impact.
                </p>
                <p class="about-paragraph">
                    I like to explore existing tools, understand their strengths and limitations, and find practical ways to make them useful and accessible for real people and organisations.
                </p>
            </div>
        </div>

        <!-- C. Professional Snapshot Panel -->
        <div class="about-snapshot-panel">
            <div class="snapshot-item">
                <div class="snapshot-icon-circle">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
                        <path d="M6 12v5c3 3 9 3 12 0v-5"/>
                    </svg>
                </div>
                <div class="snapshot-details">
                    <h3 class="snapshot-title">BCA</h3>
                    <p class="snapshot-desc">Bachelor of Computer Applications</p>
                </div>
            </div>

            <div class="snapshot-divider" aria-hidden="true"></div>

            <div class="snapshot-item">
                <div class="snapshot-icon-circle">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </div>
                <div class="snapshot-details">
                    <h3 class="snapshot-title">Tech4Good Community</h3>
                    <p class="snapshot-desc">Fellow | August 2025 – January 2027</p>
                </div>
            </div>

            <div class="snapshot-divider" aria-hidden="true"></div>

            <div class="snapshot-item">
                <div class="snapshot-icon-circle">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                        <circle cx="12" cy="10" r="3"/>
                    </svg>
                </div>
                <div class="snapshot-details">
                    <h3 class="snapshot-title">Bengaluru, India</h3>
                    <p class="snapshot-desc">Currently based here</p>
                </div>
            </div>
        </div>

        <!-- D. Areas of Interest -->
        <div class="areas-section">
            <div class="areas-header">
                <span class="areas-line"></span>
                <h3 class="areas-heading">AREAS OF INTEREST</h3>
                <span class="areas-line"></span>
            </div>

            <div class="areas-grid">
                <div class="interest-card">
                    <div class="interest-icon-circle">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <rect x="2" y="3" width="20" height="14" rx="2" ry="2"/>
                            <line x1="2" y1="20" x2="22" y2="20"/>
                        </svg>
                    </div>
                    <h4 class="interest-title">Web & Application Development</h4>
                </div>

                <div class="interest-card">
                    <div class="interest-icon-circle">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                            <polyline points="9 12 11 14 15 10"/>
                        </svg>
                    </div>
                    <h4 class="interest-title">Quality & Testing</h4>
                </div>

                <div class="interest-card">
                    <div class="interest-icon-circle">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <polygon points="12 2 2 7 12 12 22 7 12 2"/>
                            <polyline points="2 17 12 22 22 17"/>
                            <polyline points="2 12 12 17 22 12"/>
                        </svg>
                    </div>
                    <h4 class="interest-title">Product Thinking</h4>
                </div>

                <div class="interest-card">
                    <div class="interest-icon-circle">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <circle cx="11" cy="11" r="8"/>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                        </svg>
                    </div>
                    <h4 class="interest-title">Tool Exploration & Evaluation</h4>
                </div>

                <div class="interest-card">
                    <div class="interest-icon-circle">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                    </div>
                    <h4 class="interest-title">Community Technology</h4>
                </div>

                <div class="interest-card">
                    <div class="interest-icon-circle">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <polyline points="16 18 22 12 16 6"/>
                            <polyline points="8 6 2 12 8 18"/>
                        </svg>
                    </div>
                    <h4 class="interest-title">Open Source & FOSS</h4>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== SECTION 03: SELECTED WORK ===== -->
<section class="work-section" id="work">
    <!-- Subtle background geometric shape -->
    <div class="editorial-shape shape-work-top-left" aria-hidden="true">
        <svg viewBox="0 0 520 420" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M120 40 C220 10 360 80 440 180 C520 280 460 380 340 390 C220 400 120 320 80 220 C40 120 60 60 120 40 Z" fill="#E8EEDC" opacity="0.55"/>
        </svg>
    </div>

    <div class="work-container">
        <!-- Section Label -->
        <div class="work-section-header">
            <span class="work-section-tag">03 / SELECTED WORK</span>
            <span class="work-section-line"></span>
        </div>

        <!-- Section Title & Subtitle -->
        <div class="work-title-wrap">
            <h2 class="work-main-headline">
                Things I've explored, <span class="highlight-pill"><em>built and improved.</em></span>
            </h2>
            <p class="work-subtitle">
                A selection of my engineering, testing and product work.
            </p>
        </div>

        <!-- Four Project Cards in 2-Column Grid -->
        <div class="work-grid">

            <!-- Project 01: AI App Builder -->
            <article class="project-editorial-card">
                <div class="project-card-media video-preview-wrap" id="videoTriggerAiApp" role="button" tabindex="0" aria-label="Play AI App Builder project demonstration video" onclick="openModal('videoModal', this)">
                    <img src="assets/images/projects/ai_app_builder_thumb.jpg" 
                         alt="AI App Builder project video preview" 
                         class="project-img" 
                         loading="lazy">
                    <div class="video-play-overlay">
                        <span class="play-btn-circle" aria-hidden="true">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor">
                                <polygon points="5 3 19 12 5 21 5 3"></polygon>
                            </svg>
                        </span>
                        <span class="play-label">Watch Demo</span>
                    </div>
                </div>
                <div class="project-card-content">
                    <div class="project-meta-top">
                        <span class="project-category-tag">ENGINEERING</span>
                    </div>
                    <h3 class="project-headline">AI App Builder</h3>
                    <p class="project-summary">Building applications through AI and Frappe.</p>
                    <div class="project-tags">
                        <span class="tech-pill">Python</span>
                        <span class="tech-pill">Frappe</span>
                        <span class="tech-pill">AI</span>
                    </div>
                    <div class="project-action-row">
                        <button type="button" class="btn-project-cta" id="btnWatchAiApp" onclick="openModal('videoModal', this)">
                            <span>Watch Project</span>
                            <span class="cta-icon" aria-hidden="true">▶</span>
                        </button>
                    </div>
                </div>
            </article>

            <!-- Project 02: IdliStack -->
            <article class="project-editorial-card">
                <div class="project-card-media" id="idliMediaTrigger" role="button" tabindex="0" aria-label="Explore IdliStack project details" style="cursor: pointer;" onclick="openModal('idliModal', this)">
                    <img src="assets/images/projects/idlistack_stall_landscape.jpg" 
                         alt="Jency presenting IdliStack at the Tech4Good Community event stall" 
                         class="project-img" 
                         loading="lazy">
                </div>
                <div class="project-card-content">
                    <div class="project-meta-top">
                        <span class="project-category-tag">PRODUCT THINKING</span>
                    </div>
                    <h3 class="project-headline">IdliStack</h3>
                    <p class="project-summary">Exploring open-source tools and improving product experience.</p>
                    <div class="project-tags">
                        <span class="tech-pill">Research</span>
                        <span class="tech-pill">UX</span>
                        <span class="tech-pill">Open Source</span>
                    </div>
                    <div class="project-action-row">
                        <button type="button" class="btn-project-cta" id="btnExploreIdliStack" onclick="openModal('idliModal', this)">
                            <span>Explore Work</span>
                            <span class="cta-icon" aria-hidden="true">→</span>
                        </button>
                    </div>
                </div>
            </article>

            <!-- Project 03: FMS Testing -->
            <article class="project-editorial-card card-text-led">
                <div class="project-card-media fms-visual-card" id="fmsMediaTrigger" role="button" tabindex="0" aria-label="View FMS Testing Case Study" style="cursor: pointer;" onclick="openModal('caseStudyModal', this)">
                    <div class="fms-schematic-wrap">
                        <div class="fms-badge-status">
                            <span class="status-pulse-dot" aria-hidden="true"></span>
                            <span>QUALITY VALIDATION SUITE</span>
                        </div>
                        <div class="fms-architecture-grid">
                            <div class="fms-arch-node">
                                <span class="arch-label">API Endpoints</span>
                                <span class="arch-val">Schema Checks</span>
                            </div>
                            <div class="fms-arch-arrow" aria-hidden="true">→</div>
                            <div class="fms-arch-node node-highlight">
                                <span class="arch-label">Workflow Logic</span>
                                <span class="arch-val">Edge Case Audits</span>
                            </div>
                            <div class="fms-arch-arrow" aria-hidden="true">→</div>
                            <div class="fms-arch-node">
                                <span class="arch-label">Regression</span>
                                <span class="arch-val">Cypress Workflows</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="project-card-content">
                    <div class="project-meta-top">
                        <span class="project-category-tag">QUALITY ENGINEERING</span>
                    </div>
                    <h3 class="project-headline">FMS Testing</h3>
                    <p class="project-summary">Validating workflows and identifying platform issues.</p>
                    <div class="project-tags">
                        <span class="tech-pill">Testing</span>
                        <span class="tech-pill">API</span>
                        <span class="tech-pill">Cypress</span>
                    </div>
                    <div class="project-action-row">
                        <button type="button" class="btn-project-cta" id="btnViewFmsCaseStudy" onclick="openModal('caseStudyModal', this)">
                            <span>View Case Study</span>
                            <span class="cta-icon" aria-hidden="true">→</span>
                        </button>
                    </div>
                </div>
            </article>

            <!-- Project 04: Cypress Automation -->
            <article class="project-editorial-card">
                <a href="https://github.com/jencym634-sudo/idlistack-react-cypress" 
                   target="_blank" 
                   rel="noopener noreferrer" 
                   class="project-card-media cypress-visual-card"
                   aria-label="View Cypress Automation repository on GitHub"
                   style="text-decoration: none; cursor: pointer;">
                    <div class="cypress-preview-box">
                        <div class="cypress-box-header">
                            <span class="terminal-dots" aria-hidden="true">
                                <span></span><span></span><span></span>
                            </span>
                            <span class="terminal-title">idlistack-react-cypress</span>
                            <span class="repo-badge">GitHub</span>
                        </div>
                        <div class="cypress-code-snippet">
                            <span class="code-line"><span class="code-keyword">describe</span>(<span class="code-str">'E2E Test Workflows'</span>, () => {</span>
                            <span class="code-line indent-1"><span class="code-keyword">it</span>(<span class="code-str">'validates user authentication lifecycle'</span>, () => {</span>
                            <span class="code-line indent-2"><span class="code-fn">cy</span>.<span class="code-method">visit</span>(<span class="code-str">'/auth/login'</span>);</span>
                            <span class="code-line indent-2"><span class="code-fn">cy</span>.<span class="code-method">assertWorkflowIntegrity</span>();</span>
                            <span class="code-line indent-1">});</span>
                            <span class="code-line">});</span>
                        </div>
                    </div>
                </a>
                <div class="project-card-content">
                    <div class="project-meta-top">
                        <span class="project-category-tag">AUTOMATION</span>
                    </div>
                    <h3 class="project-headline">Cypress Automation</h3>
                    <p class="project-summary">Developing reusable end-to-end test workflows.</p>
                    <div class="project-tags">
                        <span class="tech-pill">Cypress</span>
                        <span class="tech-pill">JavaScript</span>
                        <span class="tech-pill">CI/CD</span>
                    </div>
                    <div class="project-action-row">
                        <a href="https://github.com/jencym634-sudo/idlistack-react-cypress" 
                           target="_blank" 
                           rel="noopener noreferrer" 
                           class="btn-project-cta">
                            <span>View Repository</span>
                            <span class="cta-icon" aria-hidden="true">↗</span>
                        </a>
                    </div>
                </div>
            </article>

        </div>
    </div>
</section>

<!-- ===== ACCESSIBLE VIDEO MODAL (AI App Builder) ===== -->
<div class="project-modal" id="videoModal" role="dialog" aria-modal="true" aria-labelledby="videoModalTitle" hidden>
    <div class="modal-backdrop" id="videoModalBackdrop" onclick="closeModal(document.getElementById('videoModal'))"></div>
    <div class="modal-dialog video-modal-dialog">
        <div class="modal-header">
            <h3 class="modal-title" id="videoModalTitle">AI App Builder — Project Demonstration</h3>
            <button type="button" class="modal-close-btn" id="closeVideoModal" aria-label="Close video player" onclick="closeModal(document.getElementById('videoModal'))">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
        <div class="modal-body">
            <div class="video-player-container">
                <video id="aiAppVideoPlayer" controls playsinline webkit-playsinline preload="auto" poster="assets/images/projects/ai_app_builder_thumb.jpg">
                    <source src="assets/videos/ai_app_builder.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
            <p class="modal-caption">Building applications through AI and Frappe.</p>
        </div>
    </div>
</div>

<!-- ===== CASE STUDY MODAL (FMS Testing) ===== -->
<div class="project-modal" id="caseStudyModal" role="dialog" aria-modal="true" aria-labelledby="caseStudyModalTitle" hidden>
    <div class="modal-backdrop" id="caseStudyModalBackdrop" onclick="closeModal(document.getElementById('caseStudyModal'))"></div>
    <div class="modal-dialog case-study-modal-dialog">
        <div class="modal-header">
            <div>
                <span class="project-category-tag">QUALITY ENGINEERING</span>
                <h3 class="modal-title" id="caseStudyModalTitle">FMS Testing — Workflow Validation</h3>
            </div>
            <button type="button" class="modal-close-btn" id="closeCaseStudyModal" aria-label="Close case study" onclick="closeModal(document.getElementById('caseStudyModal'))">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
        <div class="modal-body case-study-body">
            <div class="case-study-block">
                <h4 class="case-study-subheading">Project Focus</h4>
                <p>Validating workflows, examining API communication patterns, and uncovering critical edge-case platform issues across core business operations.</p>
            </div>
            <div class="case-study-block">
                <h4 class="case-study-subheading">Key Testing Scope</h4>
                <ul class="case-study-list">
                    <li><strong>API Schema Validation:</strong> Verifying data contracts, payload structures, and response status handling across integration endpoints.</li>
                    <li><strong>Role & Permission Verification:</strong> Testing access boundaries and multi-role data governance to prevent unauthorized data exposure.</li>
                    <li><strong>Workflow Failure Modes:</strong> Simulating network timeouts, interrupted state transactions, and invalid field combinations.</li>
                    <li><strong>Regression Safeguards:</strong> Creating automated Cypress suites to preserve stability during continuous deployments.</li>
                </ul>
            </div>
            <div class="case-study-block">
                <h4 class="case-study-subheading">Tech Stack</h4>
                <div class="project-tags">
                    <span class="tech-pill">Cypress</span>
                    <span class="tech-pill">API Testing</span>
                    <span class="tech-pill">Postman</span>
                    <span class="tech-pill">JavaScript</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ===== EXPLORE MODAL (IdliStack) ===== -->
<div class="project-modal" id="idliModal" role="dialog" aria-modal="true" aria-labelledby="idliModalTitle" hidden>
    <div class="modal-backdrop" id="idliModalBackdrop" onclick="closeModal(document.getElementById('idliModal'))"></div>
    <div class="modal-dialog case-study-modal-dialog">
        <div class="modal-header">
            <div>
                <span class="project-category-tag">PRODUCT THINKING</span>
                <h3 class="modal-title" id="idliModalTitle">IdliStack — Open-Source Exploration</h3>
            </div>
            <button type="button" class="modal-close-btn" id="closeIdliModal" aria-label="Close details" onclick="closeModal(document.getElementById('idliModal'))">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
        <div class="modal-body case-study-body">
            <div class="case-study-photo-wrap">
                <img src="assets/images/projects/idlistack_stall.jpg" alt="IdliStack showcase at Tech4Good Summit stall" class="modal-hero-img">
            </div>
            <div class="case-study-block">
                <h4 class="case-study-subheading">About the Work</h4>
                <p>Exploring open-source digital public goods and FOSS tooling. Designed practical workflows and showcased self-hosted community solutions at the Tech4Good Summit, helping grassroots organisations understand and adopt privacy-respecting technology.</p>
            </div>
            <div class="case-study-block">
                <h4 class="case-study-subheading">Areas Explored</h4>
                <div class="project-tags">
                    <span class="tech-pill">Research</span>
                    <span class="tech-pill">UX Analysis</span>
                    <span class="tech-pill">Open Source</span>
                    <span class="tech-pill">Community Tech</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ===== SECTION 04: EXPERIENCE ===== -->
<section class="experience-section" id="journey">
    <!-- Anchor alias for #experience so both #journey and #experience work -->
    <span id="experience" class="section-anchor" aria-hidden="true"></span>

    <!-- Subtle background geometric shapes -->
    <div class="editorial-shape shape-experience-top-right" aria-hidden="true">
        <svg viewBox="0 0 520 420" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M280 20 C380 60 480 140 500 240 C520 340 440 400 340 390 C240 380 160 300 180 200 C190 120 220 10 280 20 Z" fill="#E8EEDC" opacity="0.6"/>
        </svg>
    </div>
    <div class="editorial-shape shape-experience-bottom-left" aria-hidden="true">
        <svg viewBox="0 0 460 380" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M120 40 C220 10 320 60 380 150 C440 240 400 340 300 360 C200 380 100 320 60 220 C20 120 60 60 120 40 Z" fill="#DFE7CE" opacity="0.5"/>
        </svg>
    </div>

    <div class="experience-container">
        <!-- Section Label -->
        <div class="experience-section-header">
            <span class="experience-section-tag">04 / EXPERIENCE</span>
            <span class="experience-section-line"></span>
        </div>

        <!-- Section Title & Subtitle -->
        <div class="experience-title-wrap">
            <div class="experience-headline-row">
                <h2 class="experience-main-headline">
                    From exploring tools to building <span class="highlight-pill"><em>useful solutions.</em></span>
                </h2>
                <span class="headline-accent-slashes" aria-hidden="true">
                    <svg width="28" height="24" viewBox="0 0 28 24" fill="none">
                        <line x1="6" y1="22" x2="12" y2="2" stroke="#879B55" stroke-width="2.5" stroke-linecap="round"/>
                        <line x1="14" y1="22" x2="20" y2="2" stroke="#879B55" stroke-width="2.5" stroke-linecap="round"/>
                        <line x1="22" y1="22" x2="28" y2="2" stroke="#879B55" stroke-width="2.5" stroke-linecap="round"/>
                    </svg>
                </span>
            </div>
            <p class="experience-subtitle">
                A hands-on experience where I worked across research, engineering, quality and community to make open-source tools more usable.
            </p>
        </div>

        <!-- Fellowship Overview Card -->
        <div class="fellowship-overview-card">
            <!-- Left Area: Tech4Good Community Brand -->
            <div class="fellowship-brand-col">
                <div class="fellowship-brand">
                    <svg class="t4gc-arc-mark" width="40" height="40" viewBox="0 0 38 38" fill="none" aria-hidden="true">
                        <path d="M 28 7 A 14.5 14.5 0 1 0 7 26" fill="none" stroke="#7E9B42" stroke-width="4.2" stroke-linecap="round"/>
                    </svg>
                    <div class="t4gc-brand-text">
                        <span class="t4gc-brand-main">Tech4Good</span>
                        <span class="t4gc-brand-sub">Community</span>
                    </div>
                </div>
            </div>

            <!-- Middle Area: Fellowship Role Details -->
            <div class="fellowship-info-col">
                <div class="fellowship-role-row">
                    <h3 class="fellowship-role-title">Software Engineer Fellow</h3>
                    <span class="fellow-arrow" aria-hidden="true">↗</span>
                </div>
                <div class="fellowship-badge-row">
                    <span class="fellowship-date-badge">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                        <span>August 2025 – January 2027</span>
                    </span>
                </div>
                <p class="fellowship-description">
                    Contributing to product initiatives like IdliStack and FMS across research, development, testing, security and user engagement.
                </p>
            </div>

            <!-- Right Area: Team Stage Photograph -->
            <div class="fellowship-photo-col">
                <div class="fellowship-photo-frame">
                    <img src="assets/images/experience/tech4good_team_stage.jpg" 
                         alt="Tech4Good Community team on stage at IdliStack showcase" 
                         class="fellowship-photo-img">
                </div>
            </div>
        </div>

        <!-- Subheading: My Work Across the Product Journey -->
        <div class="journey-subheading-wrap">
            <h3 class="journey-subheading">My Work Across the Product Journey</h3>
            <span class="journey-subheading-line"></span>
        </div>

        <!-- 4 Activity Cards in 2x2 Grid -->
        <div class="journey-grid">

            <!-- Card 01: Product Research & Discovery -->
            <div class="journey-card">
                <div class="journey-card-icon-wrap" aria-hidden="true">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </div>
                <div class="journey-card-divider" aria-hidden="true"></div>
                <div class="journey-card-content">
                    <h4 class="journey-card-title">Product Research &amp; Discovery</h4>
                    <ul class="journey-bullet-list">
                        <li>Researched and evaluated open-source applications for IdliStack.</li>
                        <li>Prepared research documentation and competitor analysis.</li>
                        <li>Identified relevant tools and feature opportunities.</li>
                    </ul>
                </div>
            </div>

            <!-- Card 02: Engineering & Technical Exploration -->
            <div class="journey-card">
                <div class="journey-card-icon-wrap" aria-hidden="true">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="16 18 22 12 16 6"></polyline>
                        <polyline points="8 6 2 12 8 18"></polyline>
                    </svg>
                </div>
                <div class="journey-card-divider" aria-hidden="true"></div>
                <div class="journey-card-content">
                    <h4 class="journey-card-title">Engineering &amp; Technical Exploration</h4>
                    <ul class="journey-bullet-list">
                        <li>Explored open-source technologies and their capabilities.</li>
                        <li>Understood application workflows and technical aspects.</li>
                        <li>Worked on feature exploration and problem-solving with a product lens.</li>
                    </ul>
                </div>
            </div>

            <!-- Card 03: Quality & Reliability -->
            <div class="journey-card">
                <div class="journey-card-icon-wrap" aria-hidden="true">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                        <polyline points="9 12 11 14 15 10"></polyline>
                    </svg>
                </div>
                <div class="journey-card-divider" aria-hidden="true"></div>
                <div class="journey-card-content">
                    <h4 class="journey-card-title">Quality &amp; Reliability</h4>
                    <ul class="journey-bullet-list">
                        <li>Started with manual testing and validated workflows.</li>
                        <li>Built and maintained Cypress test automation.</li>
                        <li>Conducted API testing.</li>
                        <li>Performed security testing for key application flows.</li>
                    </ul>
                </div>
            </div>

            <!-- Card 04: Product & User Engagement -->
            <div class="journey-card">
                <div class="journey-card-icon-wrap" aria-hidden="true">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </div>
                <div class="journey-card-divider" aria-hidden="true"></div>
                <div class="journey-card-content">
                    <h4 class="journey-card-title">Product &amp; User Engagement</h4>
                    <ul class="journey-bullet-list">
                        <li>Explained IdliStack and its applications at community stalls.</li>
                        <li>Presented FMS demonstrations to users.</li>
                        <li>Collected and evaluated user feedback.</li>
                        <li>Captured feature requests and collaborated on improvements.</li>
                    </ul>
                </div>
            </div>

        </div>

        <!-- Impact & Learning Card -->
        <div class="impact-card">
            <div class="impact-card-left">
                <div class="impact-icon-circle" aria-hidden="true">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <circle cx="12" cy="12" r="6"></circle>
                        <circle cx="12" cy="12" r="2"></circle>
                    </svg>
                </div>
                <h4 class="impact-card-title">Impact &amp; Learning</h4>
            </div>
            <div class="impact-card-divider" aria-hidden="true"></div>
            <div class="impact-card-right">
                <p class="impact-card-desc">
                    Gained end-to-end product exposure — from exploring and evaluating tools to testing, understanding user needs and contributing to product improvements.
                </p>
            </div>
        </div>

    </div>
</section>

<!-- ===== SECTION 05: LET'S CONNECT ===== -->
<section class="contact-section" id="contact">
    <!-- Subtle background geometric shapes -->
    <div class="editorial-shape shape-contact-top-left" aria-hidden="true">
        <svg viewBox="0 0 520 420" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M120 40 C220 10 360 80 440 180 C520 280 460 380 340 390 C220 400 120 320 80 220 C40 120 60 60 120 40 Z" fill="#E8EEDC" opacity="0.6"/>
        </svg>
    </div>
    <div class="editorial-shape shape-contact-bottom-right" aria-hidden="true">
        <svg viewBox="0 0 500 400" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M280 20 C360 80 440 140 480 230 C520 320 440 380 340 370 C240 360 180 280 200 180 C210 110 230 -20 280 20 Z" fill="#DFE7CE" opacity="0.55"/>
        </svg>
    </div>

    <div class="contact-container">
        <!-- Section Label -->
        <div class="contact-section-header">
            <span class="contact-section-tag">05 / LET'S CONNECT</span>
            <span class="contact-section-line"></span>
        </div>

        <!-- Section Title & Subtitle -->
        <div class="contact-title-wrap">
            <div class="contact-headline-row">
                <h2 class="contact-main-headline">
                    Have something <span class="highlight-pill"><em>interesting in mind?</em></span>
                </h2>
                <span class="headline-accent-slashes" aria-hidden="true">
                    <svg width="28" height="24" viewBox="0 0 28 24" fill="none">
                        <line x1="6" y1="22" x2="12" y2="2" stroke="#879B55" stroke-width="2.5" stroke-linecap="round"/>
                        <line x1="14" y1="22" x2="20" y2="2" stroke="#879B55" stroke-width="2.5" stroke-linecap="round"/>
                        <line x1="22" y1="22" x2="28" y2="2" stroke="#879B55" stroke-width="2.5" stroke-linecap="round"/>
                    </svg>
                </span>
            </div>
            <p class="contact-subtitle">
                Whether it's an opportunity, a collaboration, a technical discussion or simply an interesting idea, I'd love to hear from you.
            </p>
        </div>

        <!-- Main Contact Hero Card -->
        <div class="contact-hero-card">
            <div class="contact-primary-block">
                <!-- Prominent Primary Email CTA -->
                <div class="contact-cta-wrap">
                    <a href="mailto:jencym634@gmail.com" class="btn-talk-prominent" aria-label="Send email to Jency (jencym634@gmail.com)">
                        <span class="btn-talk-icon-wrap" aria-hidden="true">
                            <i class="fa-regular fa-envelope"></i>
                        </span>
                        <span class="btn-talk-label">Let's Talk</span>
                        <span class="btn-talk-arrow" aria-hidden="true">↗</span>
                    </a>
                </div>
                <p class="contact-secondary-text">
                    I'm always happy to connect with people who enjoy building useful things.
                </p>
            </div>

            <!-- Divider -->
            <div class="contact-card-divider" aria-hidden="true"></div>

            <!-- Contact Channels Grid (Email, GitHub, LinkedIn, Instagram) -->
            <div class="contact-channels-grid">
                <!-- Channel 1: Email -->
                <a href="mailto:jencym634@gmail.com" class="channel-card" aria-label="Send email to jencym634@gmail.com">
                    <div class="channel-card-top">
                        <div class="channel-icon-wrap" aria-hidden="true">
                            <i class="fa-regular fa-envelope"></i>
                        </div>
                        <span class="channel-arrow" aria-hidden="true">↗</span>
                    </div>
                    <div class="channel-card-body">
                        <span class="channel-label">Email</span>
                        <span class="channel-value">jencym634@gmail.com</span>
                    </div>
                </a>

                <!-- Channel 2: GitHub -->
                <a href="https://github.com/jencym634-sudo" target="_blank" rel="noopener noreferrer" class="channel-card" aria-label="Open GitHub profile in new tab">
                    <div class="channel-card-top">
                        <div class="channel-icon-wrap" aria-hidden="true">
                            <i class="fa-brands fa-github"></i>
                        </div>
                        <span class="channel-arrow" aria-hidden="true">↗</span>
                    </div>
                    <div class="channel-card-body">
                        <span class="channel-label">GitHub</span>
                        <span class="channel-value">jencym634-sudo</span>
                    </div>
                </a>

                <!-- Channel 3: LinkedIn -->
                <a href="https://linkedin.com/in/jency-m-31291735a" target="_blank" rel="noopener noreferrer" class="channel-card" aria-label="Open LinkedIn profile in new tab">
                    <div class="channel-card-top">
                        <div class="channel-icon-wrap" aria-hidden="true">
                            <i class="fa-brands fa-linkedin-in"></i>
                        </div>
                        <span class="channel-arrow" aria-hidden="true">↗</span>
                    </div>
                    <div class="channel-card-body">
                        <span class="channel-label">LinkedIn</span>
                        <span class="channel-value">jency-m-31291735a</span>
                    </div>
                </a>

                <!-- Channel 4: Instagram (Placeholder) -->
                <a href="https://instagram.com/yourusername" target="_blank" rel="noopener noreferrer" class="channel-card" aria-label="Open Instagram profile placeholder in new tab">
                    <div class="channel-card-top">
                        <div class="channel-icon-wrap" aria-hidden="true">
                            <i class="fa-brands fa-instagram"></i>
                        </div>
                        <span class="channel-arrow" aria-hidden="true">↗</span>
                    </div>
                    <div class="channel-card-body">
                        <span class="channel-label">Instagram</span>
                        <span class="channel-value">@yourusername</span>
                    </div>
                </a>
            </div>
        </div>

    </div>
</section>

<?php
/**
 * =========================================================================
 * SUBSEQUENT SECTIONS (Scope Rule: Implement ONLY Hero + Approach + About + Selected Work.
 * Skills, Journey, and Contact will be styled upon approval).
 * =========================================================================
 */
if (false):
?>

<!-- ===== SKILLS SECTION ===== -->
<section class="section" id="skills" style="background: var(--bg-secondary);">
    <div class="section-container">
        <div class="section-header fade-in">
            <span class="section-label">My Skills</span>
            <h2 class="section-title">What I Do Best</h2>
            <p class="section-subtitle">Technologies and tools I work with</p>
        </div>

        <div class="skills-grid">
            <?php foreach ($skills as $i => $skill): ?>
                <div class="skill-item glass-card fade-in" style="transition-delay: <?php echo $i * 0.1; ?>s;">
                    <div class="skill-header">
                        <span class="skill-name">
                            <?php echo e($skill['skill_name']); ?>
                        </span>
                        <span class="skill-percentage">
                            <?php echo (int) $skill['percentage']; ?>%
                        </span>
                    </div>
                    <div class="skill-bar">
                        <div class="skill-progress" data-percentage="<?php echo (int) $skill['percentage']; ?>"></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ===== CONTACT SECTION ===== -->
<section class="section" id="contact" style="background: var(--bg-secondary);">
    <div class="section-container">
        <div class="section-header fade-in">
            <span class="section-label">Contact</span>
            <h2 class="section-title">Get In Touch</h2>
            <p class="section-subtitle">Have a question or want to work together?</p>
        </div>

        <div class="contact-wrapper fade-in">
            <div class="contact-info glass-card">
                <h3>Let's Talk</h3>
                <p>I'm always open to discussing new projects, creative ideas, or opportunities to be part of your
                    vision.</p>

                <div class="contact-detail">
                    <i class="fas fa-envelope"></i>
                    <span>hello@jency.dev</span>
                </div>
                <div class="contact-detail">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>Available Worldwide</span>
                </div>

                <?php if (!empty($social_links)): ?>
                    <div style="margin-top: 24px;">
                        <div class="footer-socials" style="justify-content: flex-start;">
                            <?php foreach ($social_links as $link): ?>
                                <a href="<?php echo e($link['url']); ?>" target="_blank" rel="noopener noreferrer"
                                    class="social-link glass-card-mini" title="<?php echo e($link['platform']); ?>">
                                    <i class="<?php echo e($link['icon']); ?>"></i>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <div class="contact-form-wrapper glass-card">
                <form id="contactForm" method="POST">
                    <?php csrf_field(); ?>
                    <div class="form-group">
                        <label for="contactName">Your Name</label>
                        <input type="text" id="contactName" name="name" class="form-control" placeholder="John Doe"
                            required maxlength="100">
                    </div>
                    <div class="form-group">
                        <label for="contactEmail">Your Email</label>
                        <input type="email" id="contactEmail" name="email" class="form-control"
                            placeholder="john@example.com" required maxlength="150">
                    </div>
                    <div class="form-group">
                        <label for="contactMessage">Message</label>
                        <textarea id="contactMessage" name="message" class="form-control"
                            placeholder="Tell me about your project..." required maxlength="5000"></textarea>
                    </div>
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-paper-plane"></i> Send Message
                    </button>
                    <div id="formMessage" class="form-message"></div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php endif; // End of pending sections ?>

<?php require_once 'includes/footer.php'; ?>