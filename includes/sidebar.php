<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!-- Navigation Sidebar -->
<a class="menu-toggle rounded" href="#"><i class="fas fa-bars"></i></a>
<nav id="sidebar-wrapper">
    <ul class="sidebar-nav">
        <li class="sidebar-brand"><a href="#page-top">sidebar</a></li>
        <li class="sidebar-nav-item"><a href="/index.php">Home</a></li>
        <li class="sidebar-nav-item"><a href="/index.php#about">About</a></li>
        <li class="sidebar-nav-item"><a href="/index.php#skill">Skill</a></li>
        <li class="sidebar-nav-item"><a href="/index.php#portfolio">Portfolio</a></li>
        <li class="sidebar-nav-item"><a href="/Login/Login.php">Login</a></li>
        <li class="sidebar-nav-item"><a href="/Login/join.php">Join</a></li>

        <?php if (isset($_SESSION['user_level']) && $_SESSION['user_level'] == 1): ?>
            <li class="sidebar-nav-item"><a href="/admin/skill/skill.php">skill</a></li>
            <li class="sidebar-nav-item"><a href="/admin/projects/projects.php">Projects</a></li>
        <?php endif; ?>
    </ul>
</nav>
