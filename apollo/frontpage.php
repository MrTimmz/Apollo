<!-- Masthead-->

<?php
$headernewsObj = new News();

$excistingHeader = $headernewsObj->getNewsFP();
if ($excistingHeader) {
    foreach ($excistingHeader as $row) {
?>
        <header class="masthead frontpage" style="background-image: linear-gradient(to right, rgba(0, 0, 0, 0.52), rgba(0, 0, 0, 0)), url('uploads/news/<?= $row['news_header_image']; ?>');">
            <div class="container">
                <div class="date-container">
                    <h3><?= $row['day']; ?></h3>
                    <div class="divider"></div>
                    <h3><?= $row['month']; ?></h3>
                </div>

                <div class="headline-container">
                    <h3 class=""><?= $row["news_title"]; ?></h3>
                    <div class="divider"></div>
                    <p><?= $row['limited_content']; ?></p>
                    <a href="index.php?page=news&article=<?= $row['news_id']; ?>" class="btn btn-primary">Read More</a>
                </div>
            </div>
        </header>
<?php
    }
}
?>

<div class="container">
    <div class="section">
        <div class="border"></div>
        <div class="header">
            <h3>Featured</h3>
        </div>
    </div>
</div>

<header class="featured-news">
    <div class="spacer"></div>

    <?php $featuredObj = new News();
    $excistingFeatured = $featuredObj->getNews_Featured();

    if ($excistingFeatured) {
        foreach ($excistingFeatured as $row) {
    ?>
            <div class="news-containter">
                <div class="news-content">
                    <div class="date">
                        <h3><?= $row['day'] ?></h3>
                        <div class="divider"></div>
                        <h3><?= $row['month'] ?></h3>
                    </div>
                    <div class="spacer"></div>
                    <div class="news-content-desc">
                        <div class="border"></div>
                        <h3><?= $row["title"]; ?></h3>
                        <div class="triangle">
                            <a href="index.php?page=news&article=<?= $row['news_id']; ?>" alt="<?= $row['news_title_seo']; ?>">
                                <img src="/apollo/assets/img/Hamburger_icon.svg.png" width="80" alt="<?= $row['news_title_seo']; ?>" />
                            </a>
                        </div>
                    </div>
                </div>
                <div class="news-project-color" style="background-color: <?= $row['project_color']; ?>;"></div>
                <div class="news-image" style="background: url('uploads/news/<?= $row['news_header_image']; ?>');"></div>
            </div>
    <?php
        }
    }

    ?>
</header>


<div class="container">
    <div class="section">
        <div class="header projects ">
            <h3>Chokepoint Games Projects</h3>
        </div>
    </div>
</div>

<header class="masthead projects">
    <?php
    $projectObj = new Projects();
    $excistingProject = $projectObj->getProjects();

    if ($excistingProject) {
    ?>
        <div class="projects-wrapper">
            <?php foreach ($excistingProject as $row) { ?>
                <div class="project-container">
                    <div class="project-color-overlay" style="background-color: <?= $row['project_color']; ?>;">
                    <div class="project-logo" style="background-image: url('uploads/projects/logo/<?= $row['project_logo']; ?>');"></div>
                    </div>
                    <div class="project-image" style="background-image: url('uploads/projects/image/<?= $row['project_image']; ?>');">

                    </div>
                </div>
            <?php } ?>
        </div>


    <?php
    }
    ?>
</header>


<div class="container">
    <div class="section">
        <div class="border"></div>
        <div class="header">
            <h3>Latest Blogs</h3>
        </div>
    </div>
</div>


<header class="featured-news">
    <div class="spacer"></div>
    <?php
    $newsObj = new News();
    $excistingObject = $newsObj->getBlogNews(); // Store the result
    //print_r($excistingObject);

    // Check if there are any blog posts
    if ($excistingObject) {
        foreach ($excistingObject as $row) { ?>
            <div class="blog-container">
                <div class="blog-content-wrapper">

                    <div class="blog-image" style="background-image: url('uploads/news/<?= $row['news_header_image']; ?>');">
                        <div class="project-color-overlay" style="background-color: <?= $row['project_color']; ?>;"></div>
                        <!-- Green Header Section -->
                        <div class="blog-badge">
                            <h4><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-substack" viewBox="0 0 16 16">
                                    <path d="M15 3.604H1v1.891h14v-1.89ZM1 7.208V16l7-3.926L15 16V7.208zM15 0H1v1.89h14z" />
                                </svg> BLOG</h4>
                        </div>

                        <h6 style="z-index: 4;position: absolute; right: 35px; top: 160px;"><?= $row['title']; ?></h6><!-- News Title Section -->
                        <!-- Project Logo Section -->
                        <div class="project-logo-container" style="background-image: url('uploads/projects/logo/<?= $row['project_logo']; ?>');"></div>

                        <!-- Bottom Info Section -->
                        <div class="blog-info-section">
                            <div class="news-title">
                                <div class="spacer sml"></div>
                                <div class="date">
                                    <h3><?= $row['day'] ?></h3>
                                    <div class="divider"></div>
                                    <h3><?= $row['month'] ?></h3>
                                </div>
                            </div>

                            <!-- News Content Section -->
                            <div class="blog-content">
                                <p><?= $row['limited_content']; ?></p>
                            </div>
                        </div>

                        <!-- Spacer -->



                    </div>
                </div>
            </div>

    <?php
        }
    }
    ?>
</header>

<header class="footer">

    <div style="background: url('assets/img/discord-footer.png'); height:744px; width:100%; float:left;"></div>
</header>