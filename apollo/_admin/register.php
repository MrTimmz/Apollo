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
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                                    <img class="img-filter" src="img/logo-3.svg" alt="Logo" />
                                </div>
                                <form action="includes/users.inc.php" method="post">
                                    <div class="row">

                                        <!-- User First Name -->
                                        <div class="col-xl-4 col-md-4 mb-4">
                                            <div class="card border-left-primary shadow h-100 py-2">
                                                <div class="card-body">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col mr-2">
                                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">User First name:</div>
                                                            <input type="text" class="title inputbox long" name="fname" placeholder="First Name" required><br>
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
                                        <div class="col-xl-4 col-md-4 mb-4">
                                            <div class="card border-left-primary shadow h-100 py-2">
                                                <div class="card-body">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col mr-2">
                                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Prefix:</div>
                                                            <input type="text" class="title inputbox long" name="mname" placeholder="Prefix (e.g., Mr., Ms.)"><br>
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

                                        <!-- User Last Name -->
                                        <div class="col-xl-4 col-md-4 mb-4">
                                            <div class="card border-left-primary shadow h-100 py-2">
                                                <div class="card-body">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col mr-2">
                                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">User Last name:</div>
                                                            <input type="text" class="title inputbox long" name="lname" placeholder="Last Name" required><br>
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

                                    </div>

                                    <div class="row">

                                        <!-- User Email -->
                                        <div class="col-xl-4 col-md-4 mb-4">
                                            <div class="card border-left-primary shadow h-100 py-2">
                                                <div class="card-body">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col mr-2">
                                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">User Email:</div>
                                                            <input type="email" class="title inputbox long" name="mail" placeholder="Email" required><br>
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

                                        <!-- Password -->
                                        <div class="col-xl-4 col-md-4 mb-4">
                                            <div class="card border-left-primary shadow h-100 py-2">
                                                <div class="card-body">
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">User password:</div>
                                                    <input type="password" class="inputbox long" name="pass" id="password" required><br>
                                                    <div id="password-requirements" class="password-reqs mt-2" style="display: none;">
                                                        <ul>
                                                            <li id="uppercase" class="text-danger">At least one uppercase letter</li>
                                                            <li id="lowercase" class="text-danger">At least one lowercase letter</li>
                                                            <li id="number" class="text-danger">At least one number</li>
                                                            <li id="special" class="text-danger">At least one special character (e.g., !@#$%^&*)</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Repeat Password -->
                                        <div class="col-xl-4 col-md-4 mb-4">
                                            <div class="card border-left-primary shadow h-100 py-2">
                                                <div class="card-body">
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Repeat password:</div>
                                                    <input type="password" class="inputbox long" name="passrepeat" id="passwordRepeat" required>
                                                    <div class="password-match text-danger mt-2" style="display:none;">Passwords do not match!</div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <button class="btn btn-primary btn-user btn-block" type="submit" name="submit">Register</button>
                                    <div class="text-center mt-4">
                                        <a class="small" href="login.php">Already have an account? Login!</a>
                                    </div>
                                </form>


                                <script>
                                    // Password Validation
                                    const passwordField = document.getElementById('password');
                                    const passwordRequirements = document.getElementById('password-requirements');
                                    const uppercase = document.getElementById('uppercase');
                                    const lowercase = document.getElementById('lowercase');
                                    const number = document.getElementById('number');
                                    const special = document.getElementById('special');

                                    passwordField.addEventListener('input', function() {
                                        passwordRequirements.style.display = 'block';

                                        // Uppercase letter
                                        const uppercasePattern = /[A-Z]/;
                                        if (uppercasePattern.test(passwordField.value)) {
                                            uppercase.classList.remove('text-danger');
                                            uppercase.classList.add('text-success');
                                        } else {
                                            uppercase.classList.remove('text-success');
                                            uppercase.classList.add('text-danger');
                                        }

                                        // Lowercase letter
                                        const lowercasePattern = /[a-z]/;
                                        if (lowercasePattern.test(passwordField.value)) {
                                            lowercase.classList.remove('text-danger');
                                            lowercase.classList.add('text-success');
                                        } else {
                                            lowercase.classList.remove('text-success');
                                            lowercase.classList.add('text-danger');
                                        }

                                        // Number
                                        const numberPattern = /\d/;
                                        if (numberPattern.test(passwordField.value)) {
                                            number.classList.remove('text-danger');
                                            number.classList.add('text-success');
                                        } else {
                                            number.classList.remove('text-success');
                                            number.classList.add('text-danger');
                                        }

                                        // Special character
                                        const specialPattern = /[!@#$%^&*(),.?":{}|<>]/;
                                        if (specialPattern.test(passwordField.value)) {
                                            special.classList.remove('text-danger');
                                            special.classList.add('text-success');
                                        } else {
                                            special.classList.remove('text-success');
                                            special.classList.add('text-danger');
                                        }
                                    });

                                    // Password Match Validation
                                    const passwordRepeatField = document.getElementById('passwordRepeat');
                                    const passwordMatchMessage = document.querySelector('.password-match');

                                    document.querySelector('form').addEventListener('submit', function(e) {
                                        // Check if passwords match
                                        if (passwordField.value !== passwordRepeatField.value) {
                                            e.preventDefault();
                                            passwordMatchMessage.style.display = 'block';
                                        } else {
                                            passwordMatchMessage.style.display = 'none';
                                        }
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?php include "footer.php"; ?>