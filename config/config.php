<?php
/**
 * Database Configuration
 * All database credentials are stored ONLY here.
 * For CI/CD: this file is auto-generated during deployment from GitHub Secrets.
 */

// Production error settings
error_reporting(0);
ini_set('display_errors', '0');
ini_set('log_errors', '1');

define('DB_HOST', 'sql309.infinityfree.com');
define('DB_USER', 'if0_41196563');
define('DB_PASS', 'Dincy123456789');
define('DB_NAME', 'if0_41196563_jency');

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
