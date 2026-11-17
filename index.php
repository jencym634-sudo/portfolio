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

<?php
/**
 * =========================================================================
 * SUBSEQUENT SECTIONS (Scope Rule 8: Implement ONLY Hero + Approach first.
 * About, Skills, Projects, Journey, and Contact will be styled upon approval).
 * =========================================================================
 */
if (false):
?>

<!-- ===== ABOUT SECTION ===== -->
<section class="section" id="about">
    <div class="section-container">
        <div class="section-header fade-in">
            <span class="section-label">About Me</span>
            <h2 class="section-title">Who I Am</h2>
            <p class="section-subtitle">Get to know more about my journey and passion</p>
        </div>

        <div class="about-content fade-in">
            <div class="about-card glass-card">
                <div class="about-text">
                    <?php echo nl2br(e($about['content'] ?? 'Welcome to my portfolio!')); ?>
                </div>
            </div>
        </div>
    </div>
</section>

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

<!-- ===== PROJECTS SECTION ===== -->
<section class="section" id="projects">
    <div class="section-container">
        <div class="section-header fade-in">
            <span class="section-label">My Projects</span>
            <h2 class="section-title">Recent Work</h2>
            <p class="section-subtitle">Some of my favorite projects I've worked on</p>
        </div>

        <div class="projects-grid">
            <?php foreach ($projects as $i => $project): ?>
                <div class="project-card glass-card fade-in" style="transition-delay: <?php echo $i * 0.15; ?>s;">
                    <div class="project-image">
                        <?php if (!empty($project['image'])): ?>
                            <img src="<?php echo e($project['image']); ?>" alt="<?php echo e($project['title']); ?>"
                                loading="lazy">
                        <?php else: ?>
                            <div class="project-image-placeholder">
                                <i class="fas fa-code"></i>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="project-body">
                        <h3 class="project-title">
                            <?php echo e($project['title']); ?>
                        </h3>
                        <p class="project-desc">
                            <?php echo e($project['description']); ?>
                        </p>

                        <?php if (!empty($project['tech_stack'])): ?>
                            <div class="project-tech">
                                <?php
                                $techs = explode(',', $project['tech_stack']);
                                foreach ($techs as $tech):
                                    ?>
                                    <span class="tech-tag">
                                        <?php echo e(trim($tech)); ?>
                                    </span>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <div class="project-links">
                            <?php if (!empty($project['github_link'])): ?>
                                <a href="<?php echo e($project['github_link']); ?>" target="_blank" rel="noopener"
                                    class="project-link project-link-github">
                                    <i class="fab fa-github"></i> Code
                                </a>
                            <?php endif; ?>
                            <?php if (!empty($project['demo_link'])): ?>
                                <a href="<?php echo e($project['demo_link']); ?>" target="_blank" rel="noopener"
                                    class="project-link project-link-demo">
                                    <i class="fas fa-external-link-alt"></i> Demo
                                </a>
                            <?php endif; ?>
                        </div>
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