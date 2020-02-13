<?php
include "include/functions.php";

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
    header("location: index.php");
    die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php getHeader(); ?>
    <title>Login</title>
</head>

<body>

<?php getNavigation(); ?>
<?php getPostMenuBg(); ?>

<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <section class="card wow fadeIn m-auto"
                     style="background-image: url(include/img/bg/h1.png);">

                <!-- Content -->
                <div class="card-body text-success text-center py-1 px-1 my-4">

                    <div class="col-md-10 m-auto">
                        <h3>
                            <strong>Login using email or username</strong>
                        </h3>
                        <form class="form shake" novalidate data-request="loginUser"
                              data-url="include/api.php" data-toggle="validator"
                              data-method="POST" id="FormLoginUser" autocomplete="on">

                            <div class="form-group left">
                                <label for="emailUsername" class="text-danger">E-mail | username</label>
                                <input data-data="emailUsername" type="text" class="form-control" id="emailUsername"
                                       placeholder="E-mail | username">
                            </div>

                            <div class="form-group left">
                                <label for="password" class="text-danger left">Password</label>
                                <input data-data="password" type="password" class="form-control" id="password"
                                       placeholder="Enter password " autocomplete="on">
                            </div>

                            <button type="submit" class="btn btn-primary" id="submitLogin">Login</button>
                            <div class="alert alert-primary response d-none" role="alert"></div>

                        </form>
                        <div class="alert alert-danger display-error" style="display: none"></div>

                    </div>
                </div>
                <!-- Content -->
            </section>
            <!--Section: Jumbotron-->
        </div>
    </div>
</div>
<!--Main layout-->

<?php getFooter(); ?>

</body>

</html>