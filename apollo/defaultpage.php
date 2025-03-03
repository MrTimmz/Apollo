<div class="spacer lrg"></div>


<?php $contentObj = new contentData();

$excistingContent = $contentObj->getContent();

if ($excistingContent) {
    foreach ($excistingContent as $row) {
?>
        <div class="container">
            <div class="content-container">
                <div class="text-left plain-text-content">
                    <h4 class="header-text"><?= $row["menu_page_title"] ?></h4>
                    <p><?= $row['menu_content']; ?></p>
                </div>
            </div>
        </div>

<?php
    }
}
