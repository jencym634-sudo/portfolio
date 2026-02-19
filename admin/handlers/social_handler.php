<?php
/**
 * Social Links Handler — Add, Update, Delete social links.
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
        $platform = trim($_POST['platform'] ?? '');
        $url = trim($_POST['url'] ?? '');
        $icon = trim($_POST['icon'] ?? '');

        if (!empty($platform) && !empty($url)) {
            $stmt = mysqli_prepare($conn, "INSERT INTO social_links (platform, url, icon) VALUES (?, ?, ?)");
            mysqli_stmt_bind_param($stmt, 'sss', $platform, $url, $icon);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            set_flash('success', 'Social link added!');
        }
        break;

    case 'update':
        $platform = trim($_POST['platform'] ?? '');
        $url = trim($_POST['url'] ?? '');
        $icon = trim($_POST['icon'] ?? '');

        if ($id > 0 && !empty($platform) && !empty($url)) {
            $stmt = mysqli_prepare($conn, "UPDATE social_links SET platform=?, url=?, icon=? WHERE id=?");
            mysqli_stmt_bind_param($stmt, 'sssi', $platform, $url, $icon, $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            set_flash('success', 'Social link updated!');
        }
        break;

    case 'delete':
        if ($id > 0) {
            $stmt = mysqli_prepare($conn, "DELETE FROM social_links WHERE id = ?");
            mysqli_stmt_bind_param($stmt, 'i', $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            set_flash('success', 'Social link deleted!');
        }
        break;
}

redirect('../dashboard.php');
