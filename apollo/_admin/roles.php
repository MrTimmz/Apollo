<?php include "header.php"; ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <?php $role_id = isset($_GET['edit']) ? $_GET['edit'] : null;

        if ($role_id !== null) {
            echo '<h1 class="h3 mb-0 text-gray-800">Update Role</h1>';
        } else {
            echo '<h1 class="h3 mb-0 text-gray-800">Add new Role</h1>';
        }
        ?>

    </div>

    <?php $roles = new Roles();
        $row = null;
        if($roles !== null) {
            $row = $roles->getRolesbyId($role_id);
        }
    ?>
    <form action="includes/roles.inc.php" method="post">
            <div class="row">
                <!-- Role Title -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row g-0 align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Role Title:
                                    </div>
                                    <input type="text" class="form-control title-input" id="title" name="title" placeholder="Role Title" required pattern="[a-zA-Z0-9\s]+" value="<?=$row['role_title']  ?? '' ?> " oninput="checkInput(this)">
                                    <span class="input-error text-danger"></span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-2">
                    <button type="submit" name="submit" class="btn btn-primary btn-block" id="submit-btn" disabled>
                        Add Role
                    </button>
                </div>

                <div class="col-lg-2">
                    <a href="index.html" class="btn btn-google btn-block">
                        Cancel
                    </a>
                </div>
            </div>
        </form>
        <script>
            function checkInput(input) {
                var regex = /^[a-zA-Z\s]*$/;
                if (!regex.test(input.value)) {
                    input.classList.remove('is-valid');
                    input.classList.add('is-invalid');
                    document.getElementById("submit-btn").disabled = true;
                } else {
                    input.classList.remove('is-invalid');
                    input.classList.add('is-valid');
                    document.getElementById("submit-btn").disabled = false;
                    // Clear the error message
                    document.getElementById("error-message").innerHTML = "";
                }
            }

            // Add a validateInput function to display the error message
            function validateInput() {
                var input = document.getElementById("title");
                var regex = /^[a-zA-Z\s]*$/;
                if (!regex.test(input.value)) {
                    document.getElementById("error-message").innerHTML = "Role title can only contain alphabets and spaces.";
                } else {
                    document.getElementById("error-message").innerHTML = "";
                }
            }
        </script>
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