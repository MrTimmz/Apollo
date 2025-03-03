<?php include "header.php"; ?>

<?php
// Controleren of de 'page' parameter is ingesteld en 'home' is
if (isset($_GET['page']) && $_GET['page'] == 'home') {
    include("frontpage.php");
} else {
    // Als 'page' parameter niet is ingesteld of niet gelijk is aan 'home',
    // laad dan alleen defaultpage.php als de pagina niet 'news' of 'media' is.
    if (!isset($_GET['page'])) {
        include("frontpage.php");
    } else if (isset($_GET['page']) && $_GET['page'] == 'news') {
        if (isset($_GET['article'])) {
            // Als 'article' parameter is ingesteld, laad het gedetailleerde nieuwsartikel
            include("news_detail.php");
        } else {
            // Anders, laad het nieuwsoverzicht
            include("news_overview.php");
        }

    } else if (isset($_GET['page']) && $_GET['page'] == 'projects') {
        if (isset($_GET['projects'])) {
            // Als 'article' parameter is ingesteld, laad het gedetailleerde nieuwsartikel
            include("projects_detail.php");
        } else {
            // Anders, laad het nieuwsoverzicht
            include("projects_overview.php");
        }
    } else if (isset($_GET['page']) && $_GET['page'] == 'media') {
        if (isset($_GET['category'])) {
            // Als 'category' parameter is ingesteld, laad de categorie detail
            include("image_categories_detail.php");
        } else {
            // Anders, laad het overzicht van de beeldcategorieën
            include("image_categories_overview.php");
        }
    } else {
        // Als de pagina geen van de bovenstaande opties is, laad dan niets of een andere pagina
        // Hier kun je ook iets anders inladen als dat nodig is
        include("defaultpage.php");
    }
}
?>

<section class="page-section" id="services">
    <div class="container">
        <div class="row text">
            <!-- Hier komt inhoud van de ingeladen pagina -->
        </div>
    </div>
</section>

<?php include "footer.php"; ?>