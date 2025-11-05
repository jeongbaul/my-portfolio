<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<link href="/css/styles.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<!-- Navigation Sidebar -->
<a class="menu-toggle rounded" href="javascript:void(0);"><i class="fas fa-bars"></i></a>
<nav id="sidebar-wrapper">
    <ul class="sidebar-nav">
        <li class="sidebar-brand"><a href="#page-top">sidebar</a></li>
        <li class="sidebar-nav-item"><a href="/#">Home</a></li>
        <li class="sidebar-nav-item"><a href="/#about">About</a></li>
        <li class="sidebar-nav-item"><a href="/#skill">Skill</a></li>
        <li class="sidebar-nav-item"><a href="/#portfolio">Portfolio</a></li>
        <li class="sidebar-nav-item"><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Login</a></li>
        <li class="sidebar-nav-item"><a href="/Login/join">Join</a></li>

        <?php if (isset($_SESSION['user_level']) && $_SESSION['user_level'] == 1): ?>
            <li class="sidebar-nav-item"><a href="/admin/skill/list">skill</a></li>
            <li class="sidebar-nav-item"><a href="/admin/projects/list">Projects</a></li>
        <?php endif; ?>
    </ul>
</nav>
