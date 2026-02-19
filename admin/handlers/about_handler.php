<?php
/**
 * About Section Handler — Update about content.
 */
require_once __DIR__ . '/../auth_check.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('../dashboard.php');
}
if (!validate_csrf_token($_POST['csrf_token'] ?? '')) {
    set_flash('error', 'Invalid security token.');
    redirect('../dashboard.php');
}

$action = $_POST['action'] ?? '';
$id = (int) ($_POST['id'] ?? 0);
$content = trim($_POST['content'] ?? '');

if ($action === 'update' && !empty($content)) {
    if ($id > 0) {
        $stmt = mysqli_prepare($conn, "UPDATE about SET content = ? WHERE id = ?");
        mysqli_stmt_bind_param($stmt, 'si', $content, $id);
    } else {
        $stmt = mysqli_prepare($conn, "INSERT INTO about (content) VALUES (?)");
        mysqli_stmt_bind_param($stmt, 's', $content);
    }

    if (mysqli_stmt_execute($stmt)) {
        set_flash('success', 'About section updated!');
    } else {
        set_flash('error', 'Failed to update about section.');
    }
    mysqli_stmt_close($stmt);
}

redirect('../dashboard.php');
