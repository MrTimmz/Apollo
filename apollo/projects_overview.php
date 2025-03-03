<div class="spacer lrg"></div>

<?php

$overviewProjects = new Projects();
$excistingProjects = $overviewProjects->getProjectsOverview();

if ($excistingProjects) {
    foreach ($excistingProjects as $row) {
?>
        <div class="container">
            <div class="project-container-overview row mb-4">
                <div class="col-md-4 project-hero-image" style="background-image: url('uploads/projects/image/<?= $row['project_image']; ?>');">
                    <div class="project-logo">
                    <img src="uploads/projects/logo/<?= $row['project_logo']; ?>" class="img-fluid rounded" alt="<?= $row['project_name_seo']; ?>">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="news-overview-content">
                        <h5>
                            <a href="index.php?page=projects&projects=<?= $row['project_id']; ?>"><?= $row["project_name"]; ?></a>
                        </h5>
                        <p>
                            <?= $row["desc"]; ?>
                        </p>
                        <a href="index.php?page=projects&projects=<?= $row['project_id']; ?>" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
}
