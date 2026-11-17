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

// Database Credentials
// Fallback to local development DB if production host is unreachable or running locally
$host = getenv('DB_HOST') ?: (file_exists('/.dockerenv') ? 'portfolio-mysql' : 'localhost');
$user = getenv('DB_USER') ?: (file_exists('/.dockerenv') ? 'root' : 'root');
$pass = getenv('DB_PASS') ?: (file_exists('/.dockerenv') ? 'root' : '');
$name = getenv('DB_NAME') ?: 'jency';

if (!defined('DB_HOST')) define('DB_HOST', $host);
if (!defined('DB_USER')) define('DB_USER', $user);
if (!defined('DB_PASS')) define('DB_PASS', $pass);
if (!defined('DB_NAME')) define('DB_NAME', $name);

// Establish MySQL connection with error suppression for graceful fallback
$conn = @mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// If local container connection failed, try localhost
if (!$conn && file_exists('/.dockerenv')) {
    $conn = @mysqli_connect('127.0.0.1', 'root', 'root', 'jency', 3306);
}

// Set charset to UTF-8
mysqli_set_charset($conn, 'utf8mb4');

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
