<?php
/**
 * Projects Handler — Add, Update, Delete projects with image upload.
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
        $desc = trim($_POST['description'] ?? '');
        $tech = trim($_POST['tech_stack'] ?? '');
        $github = trim($_POST['github_link'] ?? '');
        $demo = trim($_POST['demo_link'] ?? '');

        $image = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $image = upload_image($_FILES['image']);
        }

        if (!empty($title)) {
            $stmt = mysqli_prepare($conn, "INSERT INTO projects (title, description, image, tech_stack, github_link, demo_link) VALUES (?, ?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($stmt, 'ssssss', $title, $desc, $image, $tech, $github, $demo);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            set_flash('success', 'Project added!');
        }
        break;

    case 'update':
        $title = trim($_POST['title'] ?? '');
        $desc = trim($_POST['description'] ?? '');
        $tech = trim($_POST['tech_stack'] ?? '');
        $github = trim($_POST['github_link'] ?? '');
        $demo = trim($_POST['demo_link'] ?? '');

        if ($id > 0 && !empty($title)) {
            // Check for new image
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $image = upload_image($_FILES['image']);
                if ($image) {
                    // Delete old image
                    $old = db_fetch_one($conn, "SELECT image FROM projects WHERE id = $id");
                    if ($old && $old['image'])
                        delete_upload($old['image']);

                    $stmt = mysqli_prepare($conn, "UPDATE projects SET title=?, description=?, image=?, tech_stack=?, github_link=?, demo_link=? WHERE id=?");
                    mysqli_stmt_bind_param($stmt, 'ssssssi', $title, $desc, $image, $tech, $github, $demo, $id);
                } else {
                    $stmt = mysqli_prepare($conn, "UPDATE projects SET title=?, description=?, tech_stack=?, github_link=?, demo_link=? WHERE id=?");
                    mysqli_stmt_bind_param($stmt, 'sssssi', $title, $desc, $tech, $github, $demo, $id);
                }
            } else {
                $stmt = mysqli_prepare($conn, "UPDATE projects SET title=?, description=?, tech_stack=?, github_link=?, demo_link=? WHERE id=?");
                mysqli_stmt_bind_param($stmt, 'sssssi', $title, $desc, $tech, $github, $demo, $id);
            }
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            set_flash('success', 'Project updated!');
        }
        break;

    case 'delete':
        if ($id > 0) {
            // Delete image file
            $project = db_fetch_one($conn, "SELECT image FROM projects WHERE id = $id");
            if ($project && $project['image'])
                delete_upload($project['image']);

            $stmt = mysqli_prepare($conn, "DELETE FROM projects WHERE id = ?");
            mysqli_stmt_bind_param($stmt, 'i', $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            set_flash('success', 'Project deleted!');
        }
        break;
}

redirect('../dashboard.php');
