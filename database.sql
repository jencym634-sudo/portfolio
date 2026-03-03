-- ============================================
-- Jency Portfolio Database Schema
-- InfinityFree Database: if0_41196563_jency
-- Run this SQL in InfinityFree phpMyAdmin
-- ============================================

-- Admin Users
CREATE TABLE IF NOT EXISTS `admin_users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(50) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Hero Section
CREATE TABLE IF NOT EXISTS `hero` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(255) NOT NULL DEFAULT '',
    `subtitle` TEXT,
    `profile_image` VARCHAR(255) DEFAULT NULL,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- About Section
CREATE TABLE IF NOT EXISTS `about` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `content` TEXT NOT NULL,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Skills
CREATE TABLE IF NOT EXISTS `skills` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `skill_name` VARCHAR(100) NOT NULL,
    `percentage` INT NOT NULL DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Projects
CREATE TABLE IF NOT EXISTS `projects` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(255) NOT NULL,
    `description` TEXT,
    `image` VARCHAR(255) DEFAULT NULL,
    `tech_stack` VARCHAR(255) DEFAULT '',
    `github_link` VARCHAR(500) DEFAULT '',
    `demo_link` VARCHAR(500) DEFAULT '',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Social Links
CREATE TABLE IF NOT EXISTS `social_links` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `platform` VARCHAR(50) NOT NULL,
    `url` VARCHAR(500) NOT NULL,
    `icon` VARCHAR(50) DEFAULT '',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Contact Messages
CREATE TABLE IF NOT EXISTS `messages` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(150) NOT NULL,
    `message` TEXT NOT NULL,
    `is_read` TINYINT(1) DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Blog / Experience (Optional)
CREATE TABLE IF NOT EXISTS `blog` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(255) NOT NULL,
    `content` TEXT NOT NULL,
    `image` VARCHAR(255) DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ============================================
-- SEED DATA
-- ============================================

-- Admin user: admin / admin123
INSERT INTO `admin_users` (`username`, `password`) VALUES
('admin', '$2y$10$ldVVygsfiz7em7e5.fQsbeHp1BAa2ECF9eqPh06bnQDDwYgr0oRiy');

-- Default Hero
INSERT INTO `hero` (`title`, `subtitle`) VALUES
('Hi, I\'m Jency', 'Full-Stack Developer & Creative Designer');

-- Default About
INSERT INTO `about` (`content`) VALUES
('I am a passionate developer who loves building beautiful and functional web applications. With expertise in modern technologies, I create solutions that make a difference.');

-- Sample Skills
INSERT INTO `skills` (`skill_name`, `percentage`) VALUES
('HTML/CSS', 95),
('JavaScript', 88),
('PHP', 85),
('MySQL', 80),
('React', 75),
('Python', 70);

-- Sample Projects
INSERT INTO `projects` (`title`, `description`, `tech_stack`, `github_link`, `demo_link`) VALUES
('Portfolio Website', 'A dynamic portfolio with glassmorphism UI and admin panel', 'PHP, MySQL, HTML, CSS, JS', 'https://github.com/jency/portfolio', 'https://jency.dev'),
('E-Commerce Platform', 'Full-featured online store with payment integration', 'PHP, MySQL, Stripe API', 'https://github.com/jency/ecommerce', 'https://shop.jency.dev'),
('Task Manager', 'An elegant task management application with drag-and-drop', 'JavaScript, Node.js, MongoDB', 'https://github.com/jency/taskmanager', 'https://tasks.jency.dev');

-- Sample Social Links
INSERT INTO `social_links` (`platform`, `url`, `icon`) VALUES
('GitHub', 'https://github.com/jency', 'fa-brands fa-github'),
('LinkedIn', 'https://linkedin.com/in/jency', 'fa-brands fa-linkedin'),
('Twitter', 'https://twitter.com/jency', 'fa-brands fa-twitter');
