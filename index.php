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

<!-- ===== HERO SECTION ===== -->
<section class="hero" id="home">
    <!-- Background orbs -->
    <div class="hero-bg">
        <div class="hero-orb hero-orb-1"></div>
        <div class="hero-orb hero-orb-2"></div>
        <div class="hero-orb hero-orb-3"></div>
    </div>

    <!-- Floating vector shapes -->
    <div class="hero-shapes">
        <div class="hero-shape hero-shape-1"></div>
        <div class="hero-shape hero-shape-2"></div>
        <div class="hero-shape hero-shape-3"></div>
        <div class="hero-shape hero-shape-4"></div>
        <div class="hero-shape hero-shape-5"></div>
    </div>

    <div class="hero-content fade-in">
        <div class="hero-badge">
            <span class="dot"></span>
            Available for work
        </div>

        <?php if ($hero && !empty($hero['profile_image'])): ?>
            <div class="hero-profile">
                <img src="<?php echo e($hero['profile_image']); ?>" alt="Jency Profile" loading="lazy">
            </div>
        <?php endif; ?>

        <h1 class="hero-title">
            <?php if ($hero): ?>
                <?php
                // Split title to highlight the name portion
                $title = e($hero['title']);
                // Try to highlight the name after "I'm " or just use as-is
                if (preg_match("/^(.*?I'm\s+)(.+)$/i", $title, $matches)) {
                    echo $matches[1] . '<span class="highlight">' . $matches[2] . '</span>';
                } else {
                    echo '<span class="highlight">' . $title . '</span>';
                }
                ?>
            <?php else: ?>
                Hi, I'm <span class="highlight">Jency</span>
            <?php endif; ?>
        </h1>

        <p class="hero-subtitle">
            <?php echo e($hero['subtitle'] ?? 'Full-Stack Developer & Creative Designer'); ?>
        </p>

        <div class="hero-cta">
            <a href="#projects" class="btn btn-primary">
                <i class="fas fa-rocket"></i> View My Work
            </a>
            <a href="#contact" class="btn btn-glass">
                <i class="fas fa-envelope"></i> Get In Touch
            </a>
        </div>
    </div>
</section>

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

<?php require_once 'includes/footer.php'; ?>