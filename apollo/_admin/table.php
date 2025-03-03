<?php include "header.php"; ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <?php $table_id = isset($_GET['edit']) ? $_GET['edit'] : null;

        if ($table_id !== null) {
            echo '<h1 class="h3 mb-0 text-gray-800">Update Table</h1>';
        } else {
            echo '<h1 class="h3 mb-0 text-gray-800">Add New Table</h1>';
        }
        ?>

    </div>

    <?php $roles = new Table();
        $row = null;
        if($roles !== null) {
            $row = $roles->getTableById($table_id);
        }
    ?>
    <form action="includes/table.inc.php" method="post">
            <div class="row">
                <!-- Role Title -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row g-0 align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Table Kind:
                                    </div>
                                    <select name="tablekind">
                                    <option value="">Select Table Kind</option>
                                    <?php $projects = new TableKind();
                                    $allProjects = $projects->getKind();
                                    foreach ($allProjects as $row) {
                                        echo "<option value='{$row['kind_id']}'>{$row['kind_name']}</option>";
                                    } ?>
                                </select>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php if ($table_id !== null) : ?>
                    <input type="hidden" name="table_id" value="<?= $table_id?>">
                <?php endif; ?>
            <div class="row">
                <div class="col-lg-2">
                    <button type="submit" name="<?= $table_id ? 'update-table' : 'submit' ?>"
                        class="btn btn-primary btn-block" id="submit-btn" >
                            <?= $table_id ? 'Update table' : 'Add Table' ?>
                    </button>
                </div>

                <div class="col-lg-2">
                    <a href="index.html" class="btn btn-google btn-block">
                        Cancel
                    </a>
                </div>
            </div>
        </form>
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