<?php include "header.php";


include "classes/users.classes.php";
include "classes/users-contr.classes.php";



// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input_email = $_POST['email'];
    $input_code = $_POST['code'];

    // Compare with the stored email and code from the database
    // Assume you have a function to check the verification code in your user class
    $user = new Users(); // Create an instance of your user class
    if ($user->verifyUser($input_email, $input_code)) {
        // Code is valid, complete registration (e.g., mark user as active in the database)
        echo "Registration completed successfully!";

        // Clear session variables or perform other cleanup
    } else {
        echo "Invalid email or code.";
    }
}
?>

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
                                    <h1 class="h4 text-gray-900 mb-4">Verify Your Account!</h1>
                                    <img class="img-filter" src="img/logo-3.svg" alt="..." />
                                </div>
                                <form method="post">
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user" name="email" required placeholder="Enter Your Email Address...">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" name="code" value="" required placeholder="Enter Verification Code...">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Verify
                                    </button>
                                </form>

                                <div class="container mt-4">
                                    <?php if (isset($error_message)) : ?>
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <?php echo $error_message; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <hr>

                                <div class="text-center">
                                    <a class="small" href="index.php">Return to Login</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
