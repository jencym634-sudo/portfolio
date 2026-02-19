<?php
/**
 * Messages Handler — Mark as read, Delete messages.
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

switch ($action) {
    case 'mark_read':
        if ($id > 0) {
            $stmt = mysqli_prepare($conn, "UPDATE messages SET is_read = 1 WHERE id = ?");
            mysqli_stmt_bind_param($stmt, 'i', $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            set_flash('success', 'Message marked as read.');
        }
        break;

    case 'delete':
        if ($id > 0) {
            $stmt = mysqli_prepare($conn, "DELETE FROM messages WHERE id = ?");
            mysqli_stmt_bind_param($stmt, 'i', $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            set_flash('success', 'Message deleted.');
        }
        break;
}

redirect('../dashboard.php');
