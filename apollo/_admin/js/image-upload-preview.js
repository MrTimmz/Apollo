$(document).ready(function() {
    // Check if there's an existing image from PHP
    <?php if ($news_id && !empty($row['news_header_image'])): ?>
        $('#imagePreview').css('background-image', 'url("../uploads/news/<?= $row['news_header_image'] ?>")');
    <?php endif; ?>
});

// Function to update preview when a new image is selected
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

// Attach the event to handle file input change
$("#imageUpload").change(function() {
    readURL(this);
});
