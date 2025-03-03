<?php include "header.php"; ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <?php $category_id = isset($_GET['edit']) ? $_GET['edit'] : null;

        if ($category_id !== null) {
            echo '<h1 class="h3 mb-0 text-gray-800">Update Image</h1>';
        } else {
            echo '<h1 class="h3 mb-0 text-gray-800">Add New Image(s)</h1>';
        }
        ?>

    </div>


    <?php $category_id = isset($_GET['edit']) ? $_GET['edit'] : null;

    if ($category_id !== null) {
        $page = new Images();
        $page->editForm();
    } else {

        $page = new Images();
        $page->echoForm();
    }
    ?>




</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script>
    ClassicEditor
        .create(document.querySelector('#editor'), {
            // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
        })
        .then(editor => {
            window.editor = editor;
        })
        .catch(err => {
            console.error(err.stack);
        });
</script>

<?php include "footer.php"; ?>