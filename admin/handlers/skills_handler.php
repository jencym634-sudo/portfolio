<?php
/**
 * Skills Handler — Add, Update, Delete skills.
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
    case 'add':
        $name = trim($_POST['skill_name'] ?? '');
        $pct = (int) ($_POST['percentage'] ?? 0);
        if (!empty($name) && $pct >= 0 && $pct <= 100) {
            $stmt = mysqli_prepare($conn, "INSERT INTO skills (skill_name, percentage) VALUES (?, ?)");
            mysqli_stmt_bind_param($stmt, 'si', $name, $pct);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            set_flash('success', 'Skill added!');
        }
        break;

    case 'update':
        $name = trim($_POST['skill_name'] ?? '');
        $pct = (int) ($_POST['percentage'] ?? 0);
        if ($id > 0 && !empty($name) && $pct >= 0 && $pct <= 100) {
            $stmt = mysqli_prepare($conn, "UPDATE skills SET skill_name = ?, percentage = ? WHERE id = ?");
            mysqli_stmt_bind_param($stmt, 'sii', $name, $pct, $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            set_flash('success', 'Skill updated!');
        }
        break;

    case 'delete':
        if ($id > 0) {
            $stmt = mysqli_prepare($conn, "DELETE FROM skills WHERE id = ?");
            mysqli_stmt_bind_param($stmt, 'i', $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            set_flash('success', 'Skill deleted!');
        }
        break;
}

redirect('../dashboard.php');
