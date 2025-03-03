<?php include "header.php"; ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 style="float:left;" class="m-0 font-weight-bold text-primary">News Overview</h6>
            <a href="news.php" style="float:right;" class="btn btn-success btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-check"></i>
                </span>
                <span class="text">Add New Article</span>
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>News Title</th>
                            <th>News project</th>
                            <th>News Date</th>
                            <th>News Status</th>
                            <th>News Type</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>News Title</th>
                            <th>News Image</th>
                            <th>News Date</th>
                            <th>News Type</th>
                            <th>News Status</th>
                            <th>Options</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $newsObj = new News();
                        $excistingObject = $newsObj->getDeletedNews();

                        if ($excistingObject) {
                            foreach ($excistingObject as $row) { ?>
                                <tr>
                                    <td><?= $row["news_title"] ?></td>
                                    <td><?= $row["project_name"] ?></td>
                                    <td><?= $row["news_created"] ?></td>
                                    <td><?= $row["news_status"] ?></td>
                                    <td><?= $row["news_type"] ?></td>
                                    <td>
                                        <a href="?return=<?= $row["news_id"] ?>" class="btn btn-warning">Return</a>
                                        <a href="?trash=<?= $row["news_id"] ?>" class="btn btn-danger">Trash</a>
                                    </td>
                                </tr>
                        <?php
                            }
                        }

                        ?>

                        <?php
                        if (isset($_GET['trash'])) {
                            $trashNew = new News();
                            $trashNew->trashNews($_GET['trash']);
                        }

                        if (isset($_GET['return'])) {
                            $returnNew = new News();
                            $returnNew->returnNews($_GET['return']);
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?php include "footer.php"; ?>