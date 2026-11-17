<!-- Footer -->
<footer class="footer" id="footer">
    <div class="footer-container">
        <div class="footer-brand">
            <a href="#home" class="footer-logo">
                Jency M<span class="logo-dot"></span>
            </a>
            <p class="footer-tagline">Product Thinking · Software Development · Quality Engineering</p>
        </div>
        <div class="footer-socials">
            <?php
            $social_links = db_fetch_all($conn, "SELECT * FROM social_links ORDER BY id ASC");
            foreach ($social_links as $link):
                ?>
                <a href="<?php echo e($link['url']); ?>" target="_blank" rel="noopener noreferrer"
                    class="social-link" title="<?php echo e($link['platform']); ?>">
                    <i class="<?php echo e($link['icon']); ?>"></i>
                </a>
            <?php endforeach; ?>
        </div>
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> Jency M. All rights reserved.</p>
        </div>
    </div>
</footer>

<!-- Main JavaScript -->
<script src="assets/js/main.js"></script>
</body>

</html>