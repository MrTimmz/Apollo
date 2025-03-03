<?php include "header.php"; ?>

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <?php
            $user_id = isset($_GET['edit']) ? $_GET['edit'] : null;

            if ($user_id !== null) {
                echo '<h1 class="h3 mb-0 text-gray-800">Update User</h1>';
            } else {
                echo '<h1 class="h3 mb-0 text-gray-800">Add new User</h1>';
            }
            ?>
        </div>

        <?php
            $users = new Users();

            $row = null;
            if($user_id !== null) {
                $row = $users->getUsersById($user_id);
            }
        ?>
        <form action="includes/users.inc.php" method="post">
            <div class="row">

                <!-- User First name -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        User First name:</div>
                                    <input type="text" class="title inputbox long" name="name" placeholder="Firstname" required value="<?= $row['user_fname'] ?? '' ?>" ><br>
                                </div>
                                <div class="col-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                    </svg>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- User Prefix -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Prefix:</div>
                                    <input type="text" class="title inputbox long" name="prefix" placeholder="Name Prefix" value="<?= $row['user_prefix'] ?? '' ?>"><br>
                                </div>
                                <div class="col-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                    </svg>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- User Lastname -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        User Last name:</div>
                                    <input type="text" class="title inputbox long" name="lastname" placeholder="Last Name" required value="<?= $row['user_lname'] ?? '' ?>"><br>
                                </div>
                                <div class="col-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                    </svg>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Role Email -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        User Email</div>
                                    <input type="text" class="title inputbox long" name="email" placeholder="Email" value="<?= $row['user_email'] ?? '' ?>"><br>
                                </div>
                                <div class="col-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                                        <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z" />
                                    </svg>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Role password -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        User password:</div>
                                    <input type="password" class="inputbox long" name="password">
                                    <br>
                                    <div class="password-reqs text-success mt-2"><i class="fas fa-check-circle"></i> Password requirements met.</div>

                                </div>
                                <div class="col-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <script>
                    $(document).ready(function() {
                        $('input[name="password"]').on('keyup', function() {
                            var password = $(this).val();
                            var hasUpperCase = /[A-Z]/.test(password);
                            var hasLowerCase = /[a-z]/.test(password);
                            var hasNumbers = /\d/.test(password);
                            var hasSymbols = /[^\w\s]/.test(password);
                            var meetsLengthReq = password.length >= 8;

                            if (meetsLengthReq && hasUpperCase && hasLowerCase && hasNumbers && hasSymbols) {
                                $('.password-reqs').html('Great job! Password meets all requirements.').removeClass('text-danger').addClass('text-success');
                                $('input[name="passwordrpt"]').prop('disabled', false);
                            } else {
                                var reqs = [];
                                if (!hasUpperCase) {
                                    reqs.push('at least one uppercase letter');
                                }
                                if (!hasLowerCase) {
                                    reqs.push('at least one lowercase letter');
                                }
                                if (!hasNumbers) {
                                    reqs.push('at least one number');
                                }
                                if (!hasSymbols) {
                                    reqs.push('at least one symbol');
                                }
                                if (!meetsLengthReq) {
                                    reqs.push('at least 8 characters');
                                }
                                var reqsStr = reqs.join(', ');
                                $('.password-reqs').html('Password must have ' + reqsStr + '.').removeClass('text-success').addClass('text-danger');
                                $('input[name="passwordrpt"]').prop('disabled', true);
                            }
                        });

                        $('input[name="passwordrpt"]').on('keyup', function() {
                            var password = $('input[name="password"]').val();
                            var passwordrpt = $(this).val();

                            if (password === passwordrpt) {
                                $('.password-match').html('Passwords match!').removeClass('text-danger').addClass('text-success');
                            } else {
                                $('.password-match').html('Passwords do not match.').removeClass('text-success').addClass('text-danger');
                            }
                        });
                    });
                </script>



                <!-- password repeat -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        User password repeat:</div>
                                    <input type="password" class=" inputbox long" name="passwordrpt"><br>
                                </div>
                                <div class="col-auto">
                                </div>


                            </div>
                            <div class="valid-password password-match d-none">
                                Passwords match!
                            </div>
                            <div class="invalid-password password-mismatch d-none">
                                Passwords do not match.
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    $(document).ready(function() {
                        $('input[name=passwordrpt]').on('keyup', function() {
                            var password = $('input[name=password]').val();
                            var passwordrpt = $(this).val();
                            if (password === passwordrpt) {
                                $('.password-mismatch').addClass('d-none');
                                $('.password-match').removeClass('d-none');
                            } else {
                                $('.password-match').addClass('d-none');
                                $('.password-mismatch').removeClass('d-none');
                            }
                        });
                    });
                </script>

            </div>

            <?php if ($user_id !== null) : ?>
                    <input type="hidden" name="menu_id" value="<?= $user_id ?>">
                <?php endif; ?>


            <div class="row">
                <div class="col-lg-2">
                <button type="submit" name="<?= $user_id ? 'update-post' : 'submit' ?>" class="btn btn-primary btn-user btn-block">
                            <?= $user_id ? 'Update User' : 'Add User' ?>
                        </button>
                </div>

                <div class="col-lg-2">
                    <a href="index.php" class="btn btn-google btn-user btn-block">
                        Cancel
                    </a>
                </div>
            </div>
        </form>

    </div>

</div>

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