


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
                <p class="lead mb-5">부천북고 3학년 9반 22번 정바울</p>
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
                            <?php if (!empty($skill['image'])): ?>
                                <img src="/uploads/<?= htmlspecialchars($skill['image']) ?>" alt="" style="max-width:60px;">
                            <?php else: ?>
                                <i class="icon-screen-smartphone"></i>
                            <?php endif; ?>
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


