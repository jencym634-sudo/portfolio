<?php
/**
 * Hero Section Handler — Update hero title, subtitle, profile image.
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
$title = trim($_POST['title'] ?? '');
$subtitle = trim($_POST['subtitle'] ?? '');

if ($action === 'update') {
    // Handle profile image upload
    $image_path = null;
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        $image_path = upload_image($_FILES['profile_image']);
        if (!$image_path) {
            set_flash('error', 'Invalid image file. Use JPG, PNG, or WebP under 5MB.');
            redirect('../dashboard.php');
        }
    }

    if ($id > 0) {
        // Update existing
        if ($image_path) {
            // Delete old image
            $old = db_fetch_one($conn, "SELECT profile_image FROM hero WHERE id = $id");
            if ($old && $old['profile_image'])
                delete_upload($old['profile_image']);

            $stmt = mysqli_prepare($conn, "UPDATE hero SET title = ?, subtitle = ?, profile_image = ? WHERE id = ?");
            mysqli_stmt_bind_param($stmt, 'sssi', $title, $subtitle, $image_path, $id);
        } else {
            $stmt = mysqli_prepare($conn, "UPDATE hero SET title = ?, subtitle = ? WHERE id = ?");
            mysqli_stmt_bind_param($stmt, 'ssi', $title, $subtitle, $id);
        }
    } else {
        // Insert new
        $stmt = mysqli_prepare($conn, "INSERT INTO hero (title, subtitle, profile_image) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, 'sss', $title, $subtitle, $image_path);
    }

    if (mysqli_stmt_execute($stmt)) {
        set_flash('success', 'Hero section updated successfully!');
    } else {
        set_flash('error', 'Failed to update hero section.');
    }
    mysqli_stmt_close($stmt);
}

redirect('../dashboard.php');
