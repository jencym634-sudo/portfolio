<?php
/**
 * Database Configuration (Template)
 * Copy this file to config.php and fill in your credentials.
 * The CI/CD pipeline generates config.php automatically from GitHub Secrets.
 */

// Production error settings (disable for production, enable for development)
// error_reporting(E_ALL);
// ini_set('display_errors', '1');
error_reporting(0);
ini_set('display_errors', '0');
ini_set('log_errors', '1');

define('DB_HOST', 'your_database_host');
define('DB_USER', 'your_database_user');
define('DB_PASS', 'your_database_password');
define('DB_NAME', 'your_database_name');

// Establish MySQL connection
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if (!$conn) {
    die('Database connection failed: ' . mysqli_connect_error());
}

// Set charset to UTF-8
mysqli_set_charset($conn, 'utf8mb4');

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
