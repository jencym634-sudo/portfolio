<?php
/**
 * Blog Handler — Add, Update, Delete blog posts with optional image.
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
        $title = trim($_POST['title'] ?? '');
        $content = trim($_POST['content'] ?? '');

        $image = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $image = upload_image($_FILES['image']);
        }

        if (!empty($title) && !empty($content)) {
            $stmt = mysqli_prepare($conn, "INSERT INTO blog (title, content, image) VALUES (?, ?, ?)");
            mysqli_stmt_bind_param($stmt, 'sss', $title, $content, $image);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            set_flash('success', 'Blog post added!');
        }
        break;

    case 'update':
        $title = trim($_POST['title'] ?? '');
        $content = trim($_POST['content'] ?? '');

        if ($id > 0 && !empty($title) && !empty($content)) {
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $image = upload_image($_FILES['image']);
                if ($image) {
                    $old = db_fetch_one($conn, "SELECT image FROM blog WHERE id = $id");
                    if ($old && $old['image'])
                        delete_upload($old['image']);

                    $stmt = mysqli_prepare($conn, "UPDATE blog SET title=?, content=?, image=? WHERE id=?");
                    mysqli_stmt_bind_param($stmt, 'sssi', $title, $content, $image, $id);
                } else {
                    $stmt = mysqli_prepare($conn, "UPDATE blog SET title=?, content=? WHERE id=?");
                    mysqli_stmt_bind_param($stmt, 'ssi', $title, $content, $id);
                }
            } else {
                $stmt = mysqli_prepare($conn, "UPDATE blog SET title=?, content=? WHERE id=?");
                mysqli_stmt_bind_param($stmt, 'ssi', $title, $content, $id);
            }
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            set_flash('success', 'Blog post updated!');
        }
        break;

    case 'delete':
        if ($id > 0) {
            $post = db_fetch_one($conn, "SELECT image FROM blog WHERE id = $id");
            if ($post && $post['image'])
                delete_upload($post['image']);

            $stmt = mysqli_prepare($conn, "DELETE FROM blog WHERE id = ?");
            mysqli_stmt_bind_param($stmt, 'i', $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            set_flash('success', 'Blog post deleted!');
        }
        break;
}

redirect('../dashboard.php');
