<?php include "header.php"; ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 style="float:left;" class="m-0 font-weight-bold text-primary">Menu overview</h6>
            <a href="pages.php" style="float:right;" class="btn btn-success btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-check"></i>
                </span>
                <span class="text">Add new page</span>
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Menu Title</th>
                            <th>Page Title</th>
                            <th>Menu Order</th>
                            <th>Visibility</th>
                            <th>Created</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Menu Title</th>
                            <th>Page Title</th>
                            <th>Menu Order</th>
                            <th>Visibility</th>
                            <th>Created</th>
                            <th>Options</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $pageObj = new Pages();
                        $excistingObject = $pageObj->getPages();

                        if ($excistingObject) {
                            foreach ($excistingObject as $row) {
                        ?>
                                <tr>
                                    <td><?= $row["menu_title"] ?></td>
                                    <td> <?= $row["menu_page_title"] ?></td>
                                    <td><?= $row["menu_order"] ?></td>
                                    <td><?= $row["menu_status"] ?></td>
                                    <td><?= $row["menu_created"] ?></td>
                                    <td>
                                        <a href="pages.php?edit=<?= $row["menu_id"] ?>" class="btn btn-warning btn-block">Edit</a>
                                        <a href="?delete=<?= $row["menu_id"] ?>" class="btn btn-google btn-user btn-block">Delete</a>
                                    </td>
                                </tr>

                        <?php
                            }
                        }


                        if (isset($_GET['delete'])) {
                            $pages = new Pages();
                            $pages->deletePage($_GET['delete']);
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