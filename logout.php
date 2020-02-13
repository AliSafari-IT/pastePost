<?php
include "include/functions.php";
session_start();

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
//if it doesn't display an error message
?>
<html lang="en">
<head>
    <?php getHeader(); ?>
    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote-lite.min.js"></script>
    <title>Logout</title>
</head>
<?php getNavigation(); ?>
<?php getPostMenuBg(); ?>
<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <p class="note-icon-summernote text-warning text-center"
               style="font-family: 'Lalezar', cursive; color: #401603"> You are not logged in!</p>
            <p class="text-center text-info"><a href="index.php">[Homepage]</a></p>
            <p class="text-center text-info"><a href="login.php">[Login]</a></p>
            <p class="text-center text-info"><a href="register.php">[Register]</a></p>
        </div>
    </div>
</div>
<?php
} else {
//if it does continue checking
//destroy all sessions canceling the login session
session_destroy();
?>
<html lang="en">
<head>
    <?php getHeader(); ?>
    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote-lite.min.js"></script>
    <title>Logout</title>
</head>

<body>
<?php getNavigation(); ?>
<?php getPostMenuBg(); ?>
<div class="container">
        <div class="row h3">
            <p style="font-family: 'Lalezar', cursive; color: #401603;text-align: center">You have successfully logged out!</p>
        </div>
        <div class="row my-6">
            <div class="col-md-3 my-2">
                <a href="index.php" class="h5 text-center">
                    Homepage
                    <i class="fas fa-arrow-alt-circle-left" style="font-size:48px;color:#0D0525"></i>
                </a>
            </div>
            <div class="col-md-2 my-2">
                <a href="login.php" class="h5 text-center">
                    Login
                    <i class="fas fa-sign-in-alt" style="font-size:48px;color:#0D0525"></i>
                </a>
            </div>
        </div>
</div>


<?php }
getFooter();
?>

</body>
</html>
