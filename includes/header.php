<?php
/**
 * Header include — HTML head, navbar, page loader, scroll progress.
 * Expects $page_title to be set before including.
 */
if (!isset($page_title))
    $page_title = 'Jency | Software Developer & Product Engineer';
?>
<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Jency M. — Product Engineer & Software Developer. Explore my work, product thinking, and journey.">
    <meta name="keywords" content="developer, product engineer, portfolio, software developer, quality engineer">
    <meta name="author" content="Jency M.">
    <title><?php echo e($page_title ?? 'Jency | Software Developer & Product Engineer'); ?></title>

    <!-- Open Graph / Social Media Preview -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo e($page_title ?? 'Jency | Software Developer & Product Engineer'); ?>">
    <meta property="og:description" content="Jency M. — Product Engineer & Software Developer. Explore my work, product thinking, and journey.">
    <meta property="og:image" content="assets/images/jency-portrait.jpg">

    <!-- Twitter / X Preview -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo e($page_title ?? 'Jency | Software Developer & Product Engineer'); ?>">
    <meta name="twitter:description" content="Jency M. — Product Engineer & Software Developer. Explore my work, product thinking, and journey.">
    <meta name="twitter:image" content="assets/images/jency-portrait.jpg">

    <!-- Google Fonts: Playfair Display (Serif) & Plus Jakarta Sans (Sans-serif) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,400;1,600&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Main Stylesheet (Auto Cache-Busting via filemtime) -->
    <link rel="stylesheet" href="assets/css/style.css?v=<?php echo @filemtime('assets/css/style.css') ?: time(); ?>">
</head>

<body>

    <!-- Subtle Scroll Progress Bar -->
    <div class="scroll-progress" id="scrollProgress"></div>

    <!-- Navigation Header -->
    <header class="navbar-wrapper">
        <nav class="navbar" id="navbar">
            <div class="nav-container">
                <!-- Left: Name Logo with Olive Accent Dot -->
                <a href="#home" class="nav-logo">
                    Jency M<span class="logo-dot"></span>
                </a>

                <!-- Center: Primary Nav Links -->
                <ul class="nav-menu" id="navMenu">
                    <li><a href="#home" class="nav-link active">Home</a></li>
                    <li><a href="#about" class="nav-link">About</a></li>
                    <li><a href="#work" class="nav-link">Work</a></li>
                    <li><a href="#journey" class="nav-link">Journey</a></li>
                    <li><a href="#contact" class="nav-link">Contact</a></li>
                </ul>

                <!-- Right: Product Engineer Badge & Mobile Hamburger -->
                <div class="nav-actions">
                    <div class="role-pill">
                        <span class="role-dot"></span>
                        <span class="role-text">Product Engineer</span>
                    </div>
                    <button class="nav-hamburger" id="navHamburger" aria-label="Toggle navigation menu">
                        <span></span><span></span><span></span>
                    </button>
                </div>
            </div>
            <!-- Thin divider beneath navigation -->
            <div class="nav-divider"></div>
        </nav>
    </header>