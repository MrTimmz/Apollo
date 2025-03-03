<div class="spacer lrg"></div>

<?php

$overviewNews = new News();
$excistingNews = $overviewNews->getNewsMeta();

if ($excistingNews) {
    foreach ($excistingNews as $row) {
?>
        <div class="container">
            <div class="news-overview-container row mb-4">
                <div class="col-md-4">
                <img src="uploads/news/resize/resized_<?= $row['news_header_image']; ?>" class="img-fluid rounded" alt="<?= $row['news_title_seo']; ?>">

                </div>
                <div class="col-md-8">
                    <div class="news-overview-content">
                        <h5>
                            <a href="index.php?page=news&article=<?= $row['news_id']; ?>"><?= $row["news_title"]; ?></a>
                        </h5>
                        <p>
                            <?= $row["limited_content"]; ?>
                        </p>
                        <a href="index.php?page=news&article=<?= $row['news_id']; ?>" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
}
