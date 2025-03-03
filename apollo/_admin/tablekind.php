<?php include "header.php"; ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <?php $kind_id = isset($_GET['edit']) ? $_GET['edit'] : null;

        if ($kind_id !== null) {
            echo '<h1 class="h3 mb-0 text-gray-800">Update Kind</h1>';
        } else {
            echo '<h1 class="h3 mb-0 text-gray-800">Add new Kind</h1>';
        }
        ?>

    </div>

    <?php $roles = new tableKind();
        $row = null;
        if($roles !== null) {
            $row = $roles->getKindbyId($kind_id);
        }
    ?>
    <form action="includes/tablekind.inc.php" method="post">
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
                                    <input type="text" class="form-control title-input" id="kindof" name="kindof" placeholder="Kind of Table" required pattern="[a-zA-Z0-9\s]+" value="<?=$row['kind_ name']  ?? '' ?> ">

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php if ($kind_id !== null) : ?>
                    <input type="hidden" name="kind_id" value="<?= $kind_id?>">
                <?php endif; ?>
            <div class="row">
                <div class="col-lg-2">
                    <button type="submit" name="<?= $kind_id ? 'update-kind' : 'submit' ?>"
                        class="btn btn-primary btn-block" id="submit-btn" >
                            <?= $kind_id ? 'Update Kind' : 'Add Table Kind' ?>
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