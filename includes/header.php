<?php
/**
 * Header include — HTML head, navbar, page loader, scroll progress.
 * Expects $page_title to be set before including.
 */
if (!isset($page_title))
    $page_title = 'Jency | Portfolio';
?>
<!DOCTYPE html>
<html lang="en" data-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Jency — Full-Stack Developer & Creative Designer. View my projects, skills, and get in touch.">
    <meta name="keywords" content="developer, portfolio, full-stack, web developer, designer">
    <meta name="author" content="Jency">
    <title>
        <?php echo e($page_title); ?>
    </title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <!-- Page Loader -->
    <div class="page-loader" id="pageLoader">
        <div class="loader-blob"></div>
        <div class="loader-blob loader-blob-2"></div>
        <div class="loader-text">Loading<span class="loader-dots">...</span></div>
    </div>

    <!-- Scroll Progress Bar -->
    <div class="scroll-progress" id="scrollProgress"></div>

    <!-- Navigation -->
    <nav class="navbar" id="navbar">
        <div class="nav-container">
            <a href="#home" class="nav-logo">
                <span class="logo-bracket">&lt;</span>Jency<span class="logo-bracket"> /&gt;</span>
            </a>
            <ul class="nav-menu" id="navMenu">
                <li><a href="#home" class="nav-link active">Home</a></li>
                <li><a href="#about" class="nav-link">About</a></li>
                <li><a href="#skills" class="nav-link">Skills</a></li>
                <li><a href="#projects" class="nav-link">Projects</a></li>
                <li><a href="#contact" class="nav-link">Contact</a></li>
            </ul>
            <div class="nav-actions">
                <button class="theme-toggle" id="themeToggle" aria-label="Toggle dark/light mode">
                    <i class="fas fa-moon" id="themeIcon"></i>
                </button>
                <button class="nav-hamburger" id="navHamburger" aria-label="Toggle menu">
                    <span></span><span></span><span></span>
                </button>
            </div>
        </div>
    </nav>