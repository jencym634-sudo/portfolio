<?php
/**
 * Admin Dashboard — Main CMS hub with tabbed content management.
 * Manages Hero, About, Skills, Projects, Social Links, Messages, Blog, and Profile.
 */
require_once 'auth_check.php';

// Fetch all data for display
$hero = db_fetch_one($conn, "SELECT * FROM hero ORDER BY id DESC LIMIT 1");
$about = db_fetch_one($conn, "SELECT * FROM about ORDER BY id DESC LIMIT 1");
$skills = db_fetch_all($conn, "SELECT * FROM skills ORDER BY id ASC");
$projects = db_fetch_all($conn, "SELECT * FROM projects ORDER BY created_at DESC");
$social_links = db_fetch_all($conn, "SELECT * FROM social_links ORDER BY id ASC");
$messages = db_fetch_all($conn, "SELECT * FROM messages ORDER BY created_at DESC");
$blog_posts = db_fetch_all($conn, "SELECT * FROM blog ORDER BY created_at DESC");

// Counts
$project_count = count($projects);
$skill_count = count($skills);
$message_count = count($messages);
$unread_count = 0;
foreach ($messages as $m) {
    if ($m['is_read'] == 0)
        $unread_count++;
}

$flash = get_flash();
?>
<!DOCTYPE html>
<html lang="en" data-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Jency Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="assets/css/admin.css">
</head>

<body>
    <div class="admin-layout">

        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <a href="../" class="sidebar-logo">
                    <span class="logo-bracket">&lt;</span>Jency<span class="logo-bracket"> /&gt;</span>
                </a>
                <span class="sidebar-subtitle">Admin Dashboard</span>
            </div>
            <nav class="sidebar-nav">
                <button class="sidebar-link active" data-tab="dashboard"><i class="fas fa-chart-pie"></i>
                    Dashboard</button>
                <button class="sidebar-link" data-tab="hero"><i class="fas fa-home"></i> Hero Section</button>
                <button class="sidebar-link" data-tab="about"><i class="fas fa-user"></i> About</button>
                <button class="sidebar-link" data-tab="skills"><i class="fas fa-code"></i> Skills</button>
                <button class="sidebar-link" data-tab="projects"><i class="fas fa-folder-open"></i> Projects</button>
                <button class="sidebar-link" data-tab="social"><i class="fas fa-share-alt"></i> Social Links</button>
                <button class="sidebar-link" data-tab="messages"><i class="fas fa-envelope"></i> Messages
                    <?php if ($unread_count > 0): ?><span class="badge badge-new" style="margin-left:auto;">
                            <?php echo $unread_count; ?>
                        </span>
                    <?php endif; ?>
                </button>
                <button class="sidebar-link" data-tab="blog"><i class="fas fa-blog"></i> Blog</button>
                <a href="logout.php" class="sidebar-link logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="admin-main">
            <div class="admin-header">
                <div style="display:flex;align-items:center;gap:12px;">
                    <button class="mobile-toggle" id="mobileToggle"><i class="fas fa-bars"></i></button>
                    <h1 id="pageTitle">Dashboard</h1>
                </div>
                <div class="admin-header-info">
                    <i class="fas fa-user-circle"></i>
                    <span>Welcome,
                        <?php echo e($_SESSION['admin_username'] ?? 'Admin'); ?>
                    </span>
                </div>
            </div>

            <?php if ($flash): ?>
                <div class="alert alert-<?php echo $flash['type'] === 'success' ? 'success' : 'error'; ?>">
                    <i
                        class="fas fa-<?php echo $flash['type'] === 'success' ? 'check-circle' : 'exclamation-circle'; ?>"></i>
                    <?php echo e($flash['message']); ?>
                </div>
            <?php endif; ?>

            <!-- ===== DASHBOARD TAB ===== -->
            <div class="tab-panel active" id="panel-dashboard">
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon purple"><i class="fas fa-folder-open"></i></div>
                        <div class="stat-info">
                            <h3>
                                <?php echo $project_count; ?>
                            </h3>
                            <p>Projects</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon blue"><i class="fas fa-code"></i></div>
                        <div class="stat-info">
                            <h3>
                                <?php echo $skill_count; ?>
                            </h3>
                            <p>Skills</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon green"><i class="fas fa-envelope"></i></div>
                        <div class="stat-info">
                            <h3>
                                <?php echo $message_count; ?>
                            </h3>
                            <p>Messages</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon orange"><i class="fas fa-envelope-open"></i></div>
                        <div class="stat-info">
                            <h3>
                                <?php echo $unread_count; ?>
                            </h3>
                            <p>Unread</p>
                        </div>
                    </div>
                </div>

                <div class="content-card">
                    <h2><i class="fas fa-clock"></i> Recent Messages</h2>
                    <?php if (empty($messages)): ?>
                        <p style="color:var(--admin-text-dim);">No messages yet.</p>
                    <?php else: ?>
                        <div class="table-wrapper">
                            <table class="admin-table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Message</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach (array_slice($messages, 0, 5) as $msg): ?>
                                        <tr>
                                            <td>
                                                <?php echo e($msg['name']); ?>
                                            </td>
                                            <td>
                                                <?php echo e($msg['email']); ?>
                                            </td>
                                            <td>
                                                <?php echo e(substr($msg['message'], 0, 60)) . (strlen($msg['message']) > 60 ? '...' : ''); ?>
                                            </td>
                                            <td>
                                                <?php echo date('M d, Y', strtotime($msg['created_at'])); ?>
                                            </td>
                                            <td><span class="badge <?php echo $msg['is_read'] ? 'badge-read' : 'badge-new'; ?>">
                                                    <?php echo $msg['is_read'] ? 'Read' : 'New'; ?>
                                                </span></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- ===== HERO TAB ===== -->
            <div class="tab-panel" id="panel-hero">
                <div class="content-card">
                    <h2><i class="fas fa-home"></i> Hero Section</h2>
                    <form method="POST" action="handlers/hero_handler.php" enctype="multipart/form-data">
                        <?php csrf_field(); ?>
                        <input type="hidden" name="action" value="update">
                        <input type="hidden" name="id" value="<?php echo $hero['id'] ?? ''; ?>">
                        <div class="form-group">
                            <label>Headline Title</label>
                            <input type="text" name="title" class="form-control"
                                value="<?php echo e($hero['title'] ?? ''); ?>" placeholder="Hi, I'm Jency" required>
                        </div>
                        <div class="form-group">
                            <label>Subtitle</label>
                            <textarea name="subtitle" class="form-control"
                                placeholder="Full-Stack Developer & Designer"><?php echo e($hero['subtitle'] ?? ''); ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Profile Image</label>
                            <?php if (!empty($hero['profile_image'])): ?>
                                <div style="margin-bottom:10px;">
                                    <img src="../<?php echo e($hero['profile_image']); ?>"
                                        style="width:80px;height:80px;border-radius:50%;object-fit:cover;">
                                </div>
                            <?php endif; ?>
                            <input type="file" name="profile_image" class="form-control"
                                accept="image/jpeg,image/png,image/webp">
                            <small style="color:var(--admin-text-dim);">JPG, PNG or WebP only. Max 5MB.</small>
                        </div>
                        <button type="submit" class="btn-admin btn-primary"><i class="fas fa-save"></i> Save
                            Changes</button>
                    </form>
                </div>
            </div>

            <!-- ===== ABOUT TAB ===== -->
            <div class="tab-panel" id="panel-about">
                <div class="content-card">
                    <h2><i class="fas fa-user"></i> About Section</h2>
                    <form method="POST" action="handlers/about_handler.php">
                        <?php csrf_field(); ?>
                        <input type="hidden" name="action" value="update">
                        <input type="hidden" name="id" value="<?php echo $about['id'] ?? ''; ?>">
                        <div class="form-group">
                            <label>About Content</label>
                            <textarea name="content" class="form-control" rows="8" placeholder="Tell about yourself..."
                                required><?php echo e($about['content'] ?? ''); ?></textarea>
                        </div>
                        <button type="submit" class="btn-admin btn-primary"><i class="fas fa-save"></i> Save
                            Changes</button>
                    </form>
                </div>
            </div>

            <!-- ===== SKILLS TAB ===== -->
            <div class="tab-panel" id="panel-skills">
                <div class="content-card">
                    <h2><i class="fas fa-code"></i> Skills</h2>
                    <form method="POST" action="handlers/skills_handler.php" style="margin-bottom:24px;">
                        <?php csrf_field(); ?>
                        <input type="hidden" name="action" value="add">
                        <div style="display:flex;gap:12px;flex-wrap:wrap;align-items:flex-end;">
                            <div class="form-group" style="flex:1;min-width:200px;margin-bottom:0;">
                                <label>Skill Name</label>
                                <input type="text" name="skill_name" class="form-control" placeholder="e.g. JavaScript"
                                    required>
                            </div>
                            <div class="form-group" style="width:120px;margin-bottom:0;">
                                <label>Percentage</label>
                                <input type="number" name="percentage" class="form-control" min="0" max="100"
                                    placeholder="85" required>
                            </div>
                            <button type="submit" class="btn-admin btn-primary"><i class="fas fa-plus"></i> Add</button>
                        </div>
                    </form>

                    <?php if (!empty($skills)): ?>
                        <div class="table-wrapper">
                            <table class="admin-table">
                                <thead>
                                    <tr>
                                        <th>Skill</th>
                                        <th>Percentage</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($skills as $skill): ?>
                                        <tr>
                                            <td>
                                                <?php echo e($skill['skill_name']); ?>
                                            </td>
                                            <td>
                                                <?php echo (int) $skill['percentage']; ?>%
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn-admin btn-edit btn-sm"
                                                        onclick="editSkill(<?php echo $skill['id']; ?>, '<?php echo e($skill['skill_name']); ?>', <?php echo (int) $skill['percentage']; ?>)"><i
                                                            class="fas fa-edit"></i></button>
                                                    <form method="POST" action="handlers/skills_handler.php"
                                                        style="display:inline;" onsubmit="return confirm('Delete this skill?')">
                                                        <?php csrf_field(); ?>
                                                        <input type="hidden" name="action" value="delete">
                                                        <input type="hidden" name="id" value="<?php echo $skill['id']; ?>">
                                                        <button type="submit" class="btn-admin btn-danger btn-sm"><i
                                                                class="fas fa-trash"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- ===== PROJECTS TAB ===== -->
            <div class="tab-panel" id="panel-projects">
                <div class="content-card">
                    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;">
                        <h2 style="margin-bottom:0;"><i class="fas fa-folder-open"></i> Projects</h2>
                        <button class="btn-admin btn-primary" onclick="openModal('projectModal')"><i
                                class="fas fa-plus"></i> Add Project</button>
                    </div>

                    <?php if (!empty($projects)): ?>
                        <div class="table-wrapper">
                            <table class="admin-table">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Tech Stack</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($projects as $project): ?>
                                        <tr>
                                            <td>
                                                <?php if (!empty($project['image'])): ?>
                                                    <img src="../<?php echo e($project['image']); ?>" alt="">
                                                <?php else: ?>
                                                    <div
                                                        style="width:50px;height:50px;background:var(--admin-card);border-radius:8px;display:flex;align-items:center;justify-content:center;">
                                                        <i class="fas fa-image" style="color:var(--admin-text-dim);"></i></div>
                                                <?php endif; ?>
                                            </td>
                                            <td><strong>
                                                    <?php echo e($project['title']); ?>
                                                </strong></td>
                                            <td><small style="color:var(--admin-text-dim);">
                                                    <?php echo e($project['tech_stack']); ?>
                                                </small></td>
                                            <td>
                                                <?php echo date('M d, Y', strtotime($project['created_at'])); ?>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn-admin btn-edit btn-sm"
                                                        onclick="editProject(<?php echo htmlspecialchars(json_encode($project), ENT_QUOTES); ?>)"><i
                                                            class="fas fa-edit"></i></button>
                                                    <form method="POST" action="handlers/projects_handler.php"
                                                        style="display:inline;"
                                                        onsubmit="return confirm('Delete this project?')">
                                                        <?php csrf_field(); ?>
                                                        <input type="hidden" name="action" value="delete">
                                                        <input type="hidden" name="id" value="<?php echo $project['id']; ?>">
                                                        <button type="submit" class="btn-admin btn-danger btn-sm"><i
                                                                class="fas fa-trash"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p style="color:var(--admin-text-dim);">No projects added yet.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- ===== SOCIAL LINKS TAB ===== -->
            <div class="tab-panel" id="panel-social">
                <div class="content-card">
                    <h2><i class="fas fa-share-alt"></i> Social Links</h2>
                    <form method="POST" action="handlers/social_handler.php" style="margin-bottom:24px;">
                        <?php csrf_field(); ?>
                        <input type="hidden" name="action" value="add">
                        <div style="display:flex;gap:12px;flex-wrap:wrap;align-items:flex-end;">
                            <div class="form-group" style="flex:1;min-width:150px;margin-bottom:0;">
                                <label>Platform</label>
                                <input type="text" name="platform" class="form-control" placeholder="e.g. GitHub"
                                    required>
                            </div>
                            <div class="form-group" style="flex:2;min-width:200px;margin-bottom:0;">
                                <label>URL</label>
                                <input type="url" name="url" class="form-control"
                                    placeholder="https://github.com/username" required>
                            </div>
                            <div class="form-group" style="width:180px;margin-bottom:0;">
                                <label>Icon Class</label>
                                <input type="text" name="icon" class="form-control" placeholder="fa-brands fa-github">
                            </div>
                            <button type="submit" class="btn-admin btn-primary"><i class="fas fa-plus"></i> Add</button>
                        </div>
                    </form>

                    <?php if (!empty($social_links)): ?>
                        <div class="table-wrapper">
                            <table class="admin-table">
                                <thead>
                                    <tr>
                                        <th>Platform</th>
                                        <th>URL</th>
                                        <th>Icon</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($social_links as $link): ?>
                                        <tr>
                                            <td>
                                                <?php echo e($link['platform']); ?>
                                            </td>
                                            <td><a href="<?php echo e($link['url']); ?>" target="_blank"
                                                    style="color:var(--admin-accent-2);">
                                                    <?php echo e(substr($link['url'], 0, 40)); ?>
                                                </a></td>
                                            <td><i class="<?php echo e($link['icon']); ?>"></i> <small
                                                    style="color:var(--admin-text-dim);">
                                                    <?php echo e($link['icon']); ?>
                                                </small></td>
                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn-admin btn-edit btn-sm"
                                                        onclick="editSocial(<?php echo $link['id']; ?>, '<?php echo e($link['platform']); ?>', '<?php echo e($link['url']); ?>', '<?php echo e($link['icon']); ?>')"><i
                                                            class="fas fa-edit"></i></button>
                                                    <form method="POST" action="handlers/social_handler.php"
                                                        style="display:inline;" onsubmit="return confirm('Delete this link?')">
                                                        <?php csrf_field(); ?>
                                                        <input type="hidden" name="action" value="delete">
                                                        <input type="hidden" name="id" value="<?php echo $link['id']; ?>">
                                                        <button type="submit" class="btn-admin btn-danger btn-sm"><i
                                                                class="fas fa-trash"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- ===== MESSAGES TAB ===== -->
            <div class="tab-panel" id="panel-messages">
                <div class="content-card">
                    <h2><i class="fas fa-envelope"></i> Messages</h2>
                    <?php if (empty($messages)): ?>
                        <p style="color:var(--admin-text-dim);">No messages received yet.</p>
                    <?php else: ?>
                        <div class="table-wrapper">
                            <table class="admin-table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Message</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($messages as $msg): ?>
                                        <tr>
                                            <td><strong>
                                                    <?php echo e($msg['name']); ?>
                                                </strong></td>
                                            <td>
                                                <?php echo e($msg['email']); ?>
                                            </td>
                                            <td>
                                                <?php echo e(substr($msg['message'], 0, 80)) . (strlen($msg['message']) > 80 ? '...' : ''); ?>
                                            </td>
                                            <td>
                                                <?php echo date('M d, Y H:i', strtotime($msg['created_at'])); ?>
                                            </td>
                                            <td><span class="badge <?php echo $msg['is_read'] ? 'badge-read' : 'badge-new'; ?>">
                                                    <?php echo $msg['is_read'] ? 'Read' : 'New'; ?>
                                                </span></td>
                                            <td>
                                                <div class="btn-group">
                                                    <?php if (!$msg['is_read']): ?>
                                                        <form method="POST" action="handlers/messages_handler.php"
                                                            style="display:inline;">
                                                            <?php csrf_field(); ?>
                                                            <input type="hidden" name="action" value="mark_read">
                                                            <input type="hidden" name="id" value="<?php echo $msg['id']; ?>">
                                                            <button type="submit" class="btn-admin btn-edit btn-sm"
                                                                title="Mark as read"><i class="fas fa-check"></i></button>
                                                        </form>
                                                    <?php endif; ?>
                                                    <form method="POST" action="handlers/messages_handler.php"
                                                        style="display:inline;"
                                                        onsubmit="return confirm('Delete this message?')">
                                                        <?php csrf_field(); ?>
                                                        <input type="hidden" name="action" value="delete">
                                                        <input type="hidden" name="id" value="<?php echo $msg['id']; ?>">
                                                        <button type="submit" class="btn-admin btn-danger btn-sm"><i
                                                                class="fas fa-trash"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- ===== BLOG TAB ===== -->
            <div class="tab-panel" id="panel-blog">
                <div class="content-card">
                    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;">
                        <h2 style="margin-bottom:0;"><i class="fas fa-blog"></i> Blog / Experience</h2>
                        <button class="btn-admin btn-primary" onclick="openModal('blogModal')"><i
                                class="fas fa-plus"></i> Add Post</button>
                    </div>

                    <?php if (!empty($blog_posts)): ?>
                        <div class="table-wrapper">
                            <table class="admin-table">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($blog_posts as $post): ?>
                                        <tr>
                                            <td><strong>
                                                    <?php echo e($post['title']); ?>
                                                </strong></td>
                                            <td>
                                                <?php echo date('M d, Y', strtotime($post['created_at'])); ?>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn-admin btn-edit btn-sm"
                                                        onclick="editBlog(<?php echo htmlspecialchars(json_encode($post), ENT_QUOTES); ?>)"><i
                                                            class="fas fa-edit"></i></button>
                                                    <form method="POST" action="handlers/blog_handler.php"
                                                        style="display:inline;" onsubmit="return confirm('Delete this post?')">
                                                        <?php csrf_field(); ?>
                                                        <input type="hidden" name="action" value="delete">
                                                        <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
                                                        <button type="submit" class="btn-admin btn-danger btn-sm"><i
                                                                class="fas fa-trash"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p style="color:var(--admin-text-dim);">No blog posts yet.</p>
                    <?php endif; ?>
                </div>
            </div>

        </main>
    </div>

    <!-- ===== MODALS ===== -->

    <!-- Skill Edit Modal -->
    <div class="modal-overlay" id="skillModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Edit Skill</h2>
                <button class="modal-close" onclick="closeModal('skillModal')">&times;</button>
            </div>
            <form method="POST" action="handlers/skills_handler.php">
                <?php csrf_field(); ?>
                <input type="hidden" name="action" value="update">
                <input type="hidden" name="id" id="editSkillId">
                <div class="form-group">
                    <label>Skill Name</label>
                    <input type="text" name="skill_name" id="editSkillName" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Percentage</label>
                    <input type="number" name="percentage" id="editSkillPercent" class="form-control" min="0" max="100"
                        required>
                </div>
                <button type="submit" class="btn-admin btn-primary"><i class="fas fa-save"></i> Update</button>
            </form>
        </div>
    </div>

    <!-- Project Add/Edit Modal -->
    <div class="modal-overlay" id="projectModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="projectModalTitle">Add Project</h2>
                <button class="modal-close" onclick="closeModal('projectModal')">&times;</button>
            </div>
            <form method="POST" action="handlers/projects_handler.php" enctype="multipart/form-data">
                <?php csrf_field(); ?>
                <input type="hidden" name="action" id="projectAction" value="add">
                <input type="hidden" name="id" id="editProjectId">
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" id="editProjectTitle" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" id="editProjectDesc" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label>Tech Stack (comma-separated)</label>
                    <input type="text" name="tech_stack" id="editProjectTech" class="form-control"
                        placeholder="PHP, MySQL, JavaScript">
                </div>
                <div class="form-group">
                    <label>GitHub Link</label>
                    <input type="url" name="github_link" id="editProjectGithub" class="form-control"
                        placeholder="https://github.com/...">
                </div>
                <div class="form-group">
                    <label>Live Demo Link</label>
                    <input type="url" name="demo_link" id="editProjectDemo" class="form-control"
                        placeholder="https://...">
                </div>
                <div class="form-group">
                    <label>Project Image</label>
                    <input type="file" name="image" class="form-control" accept="image/jpeg,image/png,image/webp">
                    <small style="color:var(--admin-text-dim);">JPG, PNG or WebP. Max 5MB.</small>
                </div>
                <button type="submit" class="btn-admin btn-primary"><i class="fas fa-save"></i> Save Project</button>
            </form>
        </div>
    </div>

    <!-- Social Edit Modal -->
    <div class="modal-overlay" id="socialModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Edit Social Link</h2>
                <button class="modal-close" onclick="closeModal('socialModal')">&times;</button>
            </div>
            <form method="POST" action="handlers/social_handler.php">
                <?php csrf_field(); ?>
                <input type="hidden" name="action" value="update">
                <input type="hidden" name="id" id="editSocialId">
                <div class="form-group">
                    <label>Platform</label>
                    <input type="text" name="platform" id="editSocialPlatform" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>URL</label>
                    <input type="url" name="url" id="editSocialUrl" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Icon Class</label>
                    <input type="text" name="icon" id="editSocialIcon" class="form-control"
                        placeholder="fa-brands fa-github">
                </div>
                <button type="submit" class="btn-admin btn-primary"><i class="fas fa-save"></i> Update</button>
            </form>
        </div>
    </div>

    <!-- Blog Add/Edit Modal -->
    <div class="modal-overlay" id="blogModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="blogModalTitle">Add Blog Post</h2>
                <button class="modal-close" onclick="closeModal('blogModal')">&times;</button>
            </div>
            <form method="POST" action="handlers/blog_handler.php" enctype="multipart/form-data">
                <?php csrf_field(); ?>
                <input type="hidden" name="action" id="blogAction" value="add">
                <input type="hidden" name="id" id="editBlogId">
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" id="editBlogTitle" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Content</label>
                    <textarea name="content" id="editBlogContent" class="form-control" rows="6" required></textarea>
                </div>
                <div class="form-group">
                    <label>Image (optional)</label>
                    <input type="file" name="image" class="form-control" accept="image/jpeg,image/png,image/webp">
                </div>
                <button type="submit" class="btn-admin btn-primary"><i class="fas fa-save"></i> Save Post</button>
            </form>
        </div>
    </div>

    <script src="assets/js/admin.js"></script>
</body>

</html>