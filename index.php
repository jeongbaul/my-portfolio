<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'].'/lib/db.php';

if (!$conn) {
    die("DB 연결 실패: db.php 경로 확인 필요!");
}

// DB에서 skills 가져오기
$skills = [];
$sql_skills = "SELECT * FROM skills ORDER BY id DESC";
$result_skills = mysqli_query($conn, $sql_skills);
if ($result_skills) {
    while ($row = mysqli_fetch_assoc($result_skills)) {
        $skills[] = $row;
    }
}

// DB에서 projects 가져오기
$projects = [];
$sql_projects = "SELECT * FROM projects ORDER BY id DESC";
$result_projects = mysqli_query($conn, $sql_projects);
if ($result_projects) {
    while ($row = mysqli_fetch_assoc($result_projects)) {
        $projects[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<title>Stylish Portfolio - Start Bootstrap Template</title>
<link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
<script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
<link href="css/styles.css" rel="stylesheet" />
</head>
<body id="page-top">

<!-- Navigation (공통 사이드바 include) -->
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/includes/sidebar.php'; ?>

<!-- Header-->
<header class="masthead d-flex align-items-center">
    <div class="container px-4 px-lg-5 text-center">
        <h1 class="mb-1">부천의 사나이 정바울</h1>
        <h3 class="mb-5"><em>그의 오레오와 우유</em></h3>
        <a class="btn btn-primary btn-xl" href="#about">Find Out More</a>
    </div>
</header>

<!-- About Section-->
<section class="content-section bg-light" id="about">
    <div class="container px-4 px-lg-5 text-center">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-lg-10">
                <h2>제 portfolio를 보러 와주셔서 감사합니다</h2>
                <p class="lead mb-5">부천북고 3학년9반 22번 정바울</p>
                <a class="btn btn-dark btn-xl" href="#skill">Portfolio My Skill</a>
            </div>
        </div>
    </div>
</section>

<!-- Skill Section-->
<section class="content-section bg-primary text-white text-center" id="skill">
    <div class="container px-4 px-lg-5">
        <div class="content-section-heading">
            <h3 class="text-secondary mb-0">Skill</h3>
            <h2 class="mb-5">Portfolio My Skills</h2>
        </div>
        <div class="row gx-4 gx-lg-5">
            <?php if (!empty($skills)) : ?>
                <?php foreach ($skills as $skill) : ?>
                    <div class="col-lg-3 col-md-6 mb-5 mb-lg-0">
                        <span class="service-icon rounded-circle mx-auto mb-3">
                            <img src="<?= htmlspecialchars($skill['image']) ?>" alt="<?= htmlspecialchars($skill['title']) ?>" style="max-width:60px;">
                        </span>
                        <h4><strong><?= htmlspecialchars($skill['title']) ?></strong></h4>
                        <p class="text-faded mb-0"><?= htmlspecialchars($skill['description']) ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>등록된 스킬이 없습니다.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Portfolio Section-->
<section class="content-section" id="portfolio">
    <div class="container px-4 px-lg-5">
        <div class="content-section-heading text-center">
            <h3 class="text-secondary mb-0">Project</h3>
            <h2 class="mb-5">Recent Projects</h2>
        </div>
        <div class="row gx-0">
            <?php if (!empty($projects)) : ?>
                <?php foreach ($projects as $project) : ?>
                    <div class="col-lg-6">
                        <a class="portfolio-item" href="<?= htmlspecialchars($project['link'] ?? '#') ?>">
                            <div class="caption">
                                <div class="caption-content">
                                    <div class="h2"><?= htmlspecialchars($project['title']) ?></div>
                                    <p class="mb-0"><?= htmlspecialchars($project['description']) ?></p>
                                </div>
                            </div>
                            <?php if (!empty($project['img'])) : ?>
                                <img class="img-fluid" src="/uploads/<?= htmlspecialchars($project['img']) ?>" alt="<?= htmlspecialchars($project['title']) ?>" />
                            <?php endif; ?>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>등록된 프로젝트가 없습니다.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Footer-->
<footer class="footer text-center">
    <div class="container px-4 px-lg-5">
        <p class="text-muted small mb-0">Copyright &copy; Your Website 2023</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/scripts.js"></script>

</body>
</html>
