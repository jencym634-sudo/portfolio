/**
 * Admin Dashboard JavaScript
 * Tab switching, sidebar toggle, modals, edit helpers.
 */

document.addEventListener('DOMContentLoaded', () => {
    // ===== TAB SWITCHING =====
    const sidebarLinks = document.querySelectorAll('.sidebar-link[data-tab]');
    const tabPanels = document.querySelectorAll('.tab-panel');
    const pageTitle = document.getElementById('pageTitle');

    const tabTitles = {
        dashboard: 'Dashboard',
        hero: 'Hero Section',
        about: 'About',
        skills: 'Skills',
        projects: 'Projects',
        social: 'Social Links',
        messages: 'Messages',
        blog: 'Blog / Experience'
    };

    sidebarLinks.forEach(link => {
        link.addEventListener('click', () => {
            const tab = link.getAttribute('data-tab');

            // Update active state
            sidebarLinks.forEach(l => l.classList.remove('active'));
            link.classList.add('active');

            // Show correct panel
            tabPanels.forEach(p => p.classList.remove('active'));
            const panel = document.getElementById('panel-' + tab);
            if (panel) panel.classList.add('active');

            // Update page title
            if (pageTitle) pageTitle.textContent = tabTitles[tab] || 'Dashboard';

            // Close mobile sidebar
            const sidebar = document.getElementById('sidebar');
            if (sidebar) sidebar.classList.remove('active');
        });
    });

    // ===== MOBILE SIDEBAR TOGGLE =====
    const mobileToggle = document.getElementById('mobileToggle');
    const sidebar = document.getElementById('sidebar');

    if (mobileToggle && sidebar) {
        mobileToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });
    }
});

// ===== MODAL HELPERS =====
function openModal(id) {
    const modal = document.getElementById(id);
    if (modal) modal.classList.add('active');
}

function closeModal(id) {
    const modal = document.getElementById(id);
    if (modal) modal.classList.remove('active');
}

// Close modal on outside click
document.addEventListener('click', (e) => {
    if (e.target.classList.contains('modal-overlay')) {
        e.target.classList.remove('active');
    }
});

// ===== EDIT HELPERS =====

function editSkill(id, name, percentage) {
    document.getElementById('editSkillId').value = id;
    document.getElementById('editSkillName').value = name;
    document.getElementById('editSkillPercent').value = percentage;
    openModal('skillModal');
}

function editProject(project) {
    document.getElementById('projectModalTitle').textContent = 'Edit Project';
    document.getElementById('projectAction').value = 'update';
    document.getElementById('editProjectId').value = project.id;
    document.getElementById('editProjectTitle').value = project.title || '';
    document.getElementById('editProjectDesc').value = project.description || '';
    document.getElementById('editProjectTech').value = project.tech_stack || '';
    document.getElementById('editProjectGithub').value = project.github_link || '';
    document.getElementById('editProjectDemo').value = project.demo_link || '';
    openModal('projectModal');
}

function editSocial(id, platform, url, icon) {
    document.getElementById('editSocialId').value = id;
    document.getElementById('editSocialPlatform').value = platform;
    document.getElementById('editSocialUrl').value = url;
    document.getElementById('editSocialIcon').value = icon;
    openModal('socialModal');
}

function editBlog(post) {
    document.getElementById('blogModalTitle').textContent = 'Edit Blog Post';
    document.getElementById('blogAction').value = 'update';
    document.getElementById('editBlogId').value = post.id;
    document.getElementById('editBlogTitle').value = post.title || '';
    document.getElementById('editBlogContent').value = post.content || '';
    openModal('blogModal');
}
