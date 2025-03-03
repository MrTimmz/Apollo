<?php include "header.php"; ?>
<!-- Begin Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 style="float:left;" class="m-0 font-weight-bold text-primary">Menu overview</h6>
            <a href="projects.php" style="float:right;" class="btn btn-success btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-check"></i>
                </span>
                <span class="text">Add New Project</span>
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Project Title</th>
                            <th>Project Logo</th>
                            <th>Project Release Date</th>
                            <th>Project News Articles</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                        <th>Project Title</th>
                            <th>Project Logo</th>
                            <th>Project Release Date</th>
                            <th>Project News Articles</th>
                            <th>Options</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $projectObj = new Projects();
                        $excistingObject = $projectObj->getProjects();

                        if ($excistingObject) {
                            foreach ($excistingObject as $row) {
                        ?>
                                <tr>
                                    <td><?= $row["project_name"] ?></td>
                                    <td style="text-align:center;"><img src="../uploads/projects/logo/<?= $row['project_logo']; ?>" width="150"></td>
                                    <td><?= $row["project_release"] ?></td>
                                    <td></td>
                                    <td>
                                        <a href="projects.php?edit=<?= $row["project_id"] ?>" class="btn btn-warning btn-block">Edit</a>
                                        <a href="?delete=<?= $row["project_id"] ?>" class="btn btn-google btn-user btn-block">Delete</a>
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