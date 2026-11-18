<!-- Footer -->
<footer class="footer" id="footer">
    <div class="footer-container">
        <div class="footer-brand">
            <a href="#home" class="footer-logo">
                Jency M<span class="logo-dot"></span>
            </a>
            <p class="footer-tagline">Product Thinking · Software Development · Quality Engineering</p>
        </div>

        <!-- Navigation Links -->
        <nav class="footer-nav" aria-label="Footer navigation">
            <a href="#home" class="footer-nav-link">Home</a>
            <a href="#about" class="footer-nav-link">About</a>
            <a href="#work" class="footer-nav-link">Work</a>
            <a href="#journey" class="footer-nav-link">Journey</a>
            <a href="#contact" class="footer-nav-link">Contact</a>
        </nav>

        <!-- Social Channels (GitHub, LinkedIn, Instagram, Email) -->
        <div class="footer-socials">
            <a href="https://github.com/jencym634-sudo" target="_blank" rel="noopener noreferrer"
                class="social-link" title="GitHub" aria-label="GitHub profile">
                <i class="fa-brands fa-github"></i>
            </a>
            <a href="https://linkedin.com/in/jency-m-31291735a" target="_blank" rel="noopener noreferrer"
                class="social-link" title="LinkedIn" aria-label="LinkedIn profile">
                <i class="fa-brands fa-linkedin-in"></i>
            </a>
            <!-- Instagram (replaces Twitter) -->
            <a href="https://instagram.com/yourusername" target="_blank" rel="noopener noreferrer"
                class="social-link" title="Instagram" aria-label="Instagram profile">
                <i class="fa-brands fa-instagram"></i>
            </a>
            <a href="mailto:jencym634@gmail.com" class="social-link" title="Email" aria-label="Send email">
                <i class="fa-regular fa-envelope"></i>
            </a>
        </div>

        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> Designed and built with curiosity by Jency M.</p>
        </div>
    </div>
</footer>

<!-- Main JavaScript (Auto Cache-Busting via filemtime) -->
<script src="assets/js/main.js?v=<?php echo @filemtime('assets/js/main.js') ?: time(); ?>"></script>
</body>

</html>