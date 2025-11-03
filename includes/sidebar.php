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
        <li class="sidebar-nav-item"><a href="/#">Home</a></li>
        <li class="sidebar-nav-item"><a href="/#about">About</a></li>
        <li class="sidebar-nav-item"><a href="/#skill">Skill</a></li>
        <li class="sidebar-nav-item"><a href="/#portfolio">Portfolio</a></li>
        <li class="sidebar-nav-item"><a href="/Login/Login">Login</a></li>
        <li class="sidebar-nav-item"><a href="/admin/skill">Join</a></li>

        <?php if (isset($_SESSION['user_level']) && $_SESSION['user_level'] == 1): ?>
            <li class="sidebar-nav-item"><a href="/admin/skill/list">skill</a></li>
            <li class="sidebar-nav-item"><a href="/admin/projects/list">Projects</a></li>
        <?php endif; ?>
    </ul>
</nav>