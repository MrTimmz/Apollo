<?php include "header.php"; ?>


<?php
if (isset($_SESSION['success_message'])) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">' . $_SESSION['success_message'] . '
        </div>';
    unset($_SESSION['success_message']);
}
?>


<script>
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000); // time in milliseconds
</script>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Version Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Current Version:</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Apollo 1</div>
                        </div>
                        <div class="col-auto">
                            <i class="navbar-brand"><img src="../assets/img/logo-2.svg" alt="Apollo CMS" width="35em" /></a></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Content Row -->
    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-6 mb-4">

            <!-- Color System -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Development Approach</h6>
                </div>
                <div class="card-body">
                    <p class="mb-0">Apollo CMS is an open-source content management system designed by developers for developers, with a focus on flexibility and freedom.
                        Unlike other popular CMS platforms like WordPress or Joomla, Apollo doesn't restrict designers to pre-made templates.
                        Instead, it offers a customizable platform that encourages designers to let their creativity run wild. With its open-source nature,
                        CMS enables developers to collaborate and develop on top of its framework, creating a robust and versatile platform for content management.
                        Whether you're a designer or developer, Apollo CMS provides a powerful solution for creating dynamic websites and applications.</p>
                </div>
            </div>

            <?php
            // Include your database connection class
            include_once "classes/dbh.classes.php";

            class UserActivityLog extends Dbh
            {

                // Function to fetch user activity data
                public function get_user_activity()
                {
                    // Connect to the database
                    $pdo = $this->connect();

                    // Prepare and execute the query to fetch user activity data
                    $sql = "SELECT * FROM user_activity ORDER BY activity_date DESC";
                    $stmt = $pdo->query($sql);
                    $user_activity = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    return $user_activity;
                }

                // Function to display user activity data
                public function display_user_activity()
                {
                    // Get user activity data
                    $userActivity = $this->get_user_activity();

                    // Echo user activity data
                    if (!empty($userActivity)) {
                        echo "<table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>";
                            echo "<thead><tr><th>User</th><th>Action done</th><th>Go to</th><th>Date</th></tr></thead>";
                            echo "<tfoot><tr><th>User</th><th>Action done</th><th>Go to</th><th>Date</th></tr></tfoot>";
                        echo "<tbody>";
                        foreach ($userActivity as $activity) {
                            echo "<tr>";
                                echo "<td>" . $activity['username'] . "</td>";
                                echo "<td>" . $activity['action'] . "</td>";
                                echo "<td>" . '<a href="' . $activity['link'] . '">Go to</a>' . "</td>";
                                echo "<td>" . $activity['activity_date'] . "</td>";
                            echo "</tr>";
                        }
                        echo "</tbody></table>";
                    } else {
                        echo "No user activity found.";
                    }
                }
            }

            $userActivityLog = new UserActivityLog();
            $userActivityLog->display_user_activity();
            ?>



        </div>

        <div class="col-lg-6 mb-4">

            <!-- Illustrations -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tweets</h6>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="img/undraw_posting_photo.svg" alt="...">
                    </div>
                    <p>Add some quality, svg illustrations to your project courtesy of <a target="_blank" rel="nofollow" href="https://undraw.co/">unDraw</a>, a
                        constantly updated collection of beautiful svg images that you can use
                        completely free and without attribution!</p>
                    <a target="_blank" rel="nofollow" href="https://undraw.co/">Browse Illustrations on
                        unDraw &rarr;</a>
                </div>
            </div>

            <!-- Approach -->


        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?php include "footer.php"; ?>