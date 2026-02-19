<?php
/**
 * Shared utility functions for the portfolio.
 * CSRF tokens, sanitization, file upload validation, DB helpers.
 */

// ========== CSRF PROTECTION ==========

/**
 * Generate a CSRF token and store in session.
 */
function generate_csrf_token()
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Validate CSRF token from a form submission.
 */
function validate_csrf_token($token)
{
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Output a hidden CSRF input field.
 */
function csrf_field()
{
    $token = generate_csrf_token();
    echo '<input type="hidden" name="csrf_token" value="' . htmlspecialchars($token) . '">';
}

// ========== SANITIZATION ==========

/**
 * Escape output for HTML (XSS prevention).
 */
function e($string)
{
    return htmlspecialchars($string ?? '', ENT_QUOTES, 'UTF-8');
}

/**
 * Sanitize input string.
 */
function sanitize($string)
{
    return trim(htmlspecialchars(strip_tags($string ?? ''), ENT_QUOTES, 'UTF-8'));
}

// ========== FILE UPLOAD ==========

/**
 * Validate and upload an image file.
 * Returns the relative path on success, or false on failure.
 */
function upload_image($file, $upload_dir = 'uploads/')
{
    $allowed_types = ['image/jpeg', 'image/png', 'image/webp'];
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'webp'];
    $max_size = 5 * 1024 * 1024; // 5MB

    // Validate presence
    if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
        return false;
    }

    // Validate MIME type
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime_type = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);

    if (!in_array($mime_type, $allowed_types)) {
        return false;
    }

    // Validate extension
    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($extension, $allowed_extensions)) {
        return false;
    }

    // Validate size
    if ($file['size'] > $max_size) {
        return false;
    }

    // Generate unique filename
    $filename = uniqid('img_', true) . '.' . $extension;
    $target_path = rtrim($upload_dir, '/') . '/' . $filename;

    // Ensure directory exists
    $full_dir = __DIR__ . '/../' . $upload_dir;
    if (!is_dir($full_dir)) {
        mkdir($full_dir, 0755, true);
    }

    $full_path = __DIR__ . '/../' . $target_path;

    if (move_uploaded_file($file['tmp_name'], $full_path)) {
        return $target_path;
    }

    return false;
}

/**
 * Delete an uploaded file.
 */
function delete_upload($path)
{
    $full_path = __DIR__ . '/../' . $path;
    if ($path && file_exists($full_path)) {
        unlink($full_path);
    }
}

// ========== DATABASE HELPERS ==========

/**
 * Fetch all rows from a query.
 */
function db_fetch_all($conn, $query)
{
    $result = mysqli_query($conn, $query);
    if (!$result)
        return [];
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    mysqli_free_result($result);
    return $rows;
}

/**
 * Fetch a single row.
 */
function db_fetch_one($conn, $query)
{
    $result = mysqli_query($conn, $query);
    if (!$result)
        return null;
    $row = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $row;
}

// ========== REDIRECT ==========

function redirect($url)
{
    header("Location: $url");
    exit;
}

// ========== FLASH MESSAGES ==========

function set_flash($type, $message)
{
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}

function get_flash()
{
    if (isset($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $flash;
    }
    return null;
}
