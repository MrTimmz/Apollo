<?php include "header.php"; ?>

<style>
    body {
        background-color: #4e73df;
        background-image: linear-gradient(180deg, #4e73df 10%, #224abe 100%);
        background-size: cover;
    }
</style>

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    <img class="img-filter" src="img/logo-3.svg" alt="..." />
                                </div>
                                <form class="user" method="POST" action="includes/login.inc.php">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" name="name" aria-describedby="emailHelp" placeholder="Enter Email Address Or Username...">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" name="password" placeholder="Password">
                                    </div>
                                    <button type="submit" name="login" class="btn btn-primary btn-user btn-block" a href="index.php">
                                        Login
                                    </button>
                                </form>

                                <div class="container mt-4">
                                    <?php if (isset($_COOKIE["error_message"])) : ?>
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <?php echo $_COOKIE["error_message"]; ?>
                                        </div>
                                        <?php setcookie("error_message", "", time() - 3600, "/"); ?>
                                    <?php endif; ?>
                                </div>


                                <hr>

                                <div class="text-center">
                                    <a class="small" href="register.php">Create an Account!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>