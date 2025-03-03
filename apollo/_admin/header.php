<?php
    session_start();

    // Define pages that should allow access even if the user is not logged in
    $allowedPages = ['login.php', 'register.php', 'verify.php'];

    // If the user is logged in and trying to access the login, register, or verify page, redirect to the dashboard (index.php)
    if (isset($_SESSION["user_fname"]) && in_array(basename($_SERVER['PHP_SELF']), $allowedPages)) {
        header("Location: index.php"); // Or redirect to the home/dashboard page
        exit();
    }

    // If the user is not logged in and tries to access a protected page (but not login, register, or verify), redirect to the login page
    if (!isset($_SESSION["user_fname"]) && !in_array(basename($_SERVER['PHP_SELF']), $allowedPages)) {
        header("Location: login.php");
        exit();
    }

    $userRole = isset($_SESSION["user_role"]) ? $_SESSION["user_role"] : 0;
    include 'includes/class-autoload.inc.php';
    include 'includes/mod_config.php';
    include_once 'functions/functions.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SB Admin 2 - Dashboard</title> <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet"> <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="ckeditor.js"></script>
    <script src="ckeditor.js.map"></script>
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>

<body id="page-top"> <!-- Page Wrapper -->

    <div id="wrapper">
        <?php
        if (isset($_SESSION["user_fname"])) {
        ?>
            <?php include "menu.php"; ?>
            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column"> <!-- Main Content -->
                <div id="content"> <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                        <!-- Sidebar Toggle (Topbar) -->
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto"> <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <?php
                                if (isset($_SESSION["user_fname"])) {
                                ?>
                                    <a class="nav-link dropdown-toggle" style="float:left;" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION["user_fname"]; ?> | <?php echo $_SESSION["user_role"]; ?></span> <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                                    </a>
                                    <button style="margin:14px;" class="btn btn-danger">
                                        <a href="logout.php" class="header-login-a" style="color:white !important; text-decoration:none !important;">Logout</a>
                                    </button>


                                <?php
                                } else {
                                }
                                ?>

                            </li>
                        </ul>
                    </nav> <!-- End of Topbar -->

                <?php
            } else {
            }
                ?>