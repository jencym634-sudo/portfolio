<?php
/**
 * Contact Form Handler
 * Receives AJAX POST, validates, stores in messages table.
 */
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/functions.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

// Validate CSRF
if (!isset($_POST['csrf_token']) || !validate_csrf_token($_POST['csrf_token'])) {
    echo json_encode(['success' => false, 'message' => 'Security token invalid. Please refresh the page.']);
    exit;
}

// Get and validate fields
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$message = trim($_POST['message'] ?? '');

if (empty($name) || empty($email) || empty($message)) {
    echo json_encode(['success' => false, 'message' => 'All fields are required.']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Please enter a valid email address.']);
    exit;
}

if (strlen($name) > 100 || strlen($email) > 150 || strlen($message) > 5000) {
    echo json_encode(['success' => false, 'message' => 'Input exceeds maximum length.']);
    exit;
}

// Insert into database using prepared statement
$stmt = mysqli_prepare($conn, "INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'Server error. Please try again later.']);
    exit;
}

mysqli_stmt_bind_param($stmt, 'sss', $name, $email, $message);

if (mysqli_stmt_execute($stmt)) {
    // Regenerate CSRF token
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    echo json_encode([
        'success' => true,
        'message' => 'Thank you! Your message has been sent successfully.',
        'new_token' => $_SESSION['csrf_token']
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to send message. Please try again.']);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
