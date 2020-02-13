<?php include "include/functions.php";
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <?php getHeader(); ?>
        <title>User Profile</title>
    </head>

    <body>

    <?php getNavigation(); ?>
    <?php getPostMenuBg(); ?>

    <p class="p-5"></p>
    <div class="jumbotron jumbotron-fluid">
        <div class="col-12">

            <h3>User Profile</h3>

            <div class="table-userProfile"></div>

        </div>
    </div>

    <?php getFooter(); ?>
    <script type="text/javascript">
        $(document).ready(function () {
            console.log("Ajax for adding user profile");

            $.ajax({
                method: "post",
                url: 'include/api.php',
                data: {request: 'getUserProfile', data: ''}
            }).done(function (jsonData) {

                var data = JSON.parse(jsonData);
                console.log(data['data']);
                $(".table-users").html(generateTable(data['data']))
            });
        });

    </script>
    </body>

    </html>
    <?php
} else {
    ?>
    <html lang="en">
<head>
    <?php getHeader(); ?>
    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote-lite.min.js"></script>
    <title>User Profile</title>
</head>
<body>
<div style="margin-top: 30vh">
    <p class="note-icon-summernote text-danger text-center px-2">
        You need to be logged in as <b>Member</b> to view
        <u>User Profile</u>!
    </p>
    <p class="p-2"></p>
    <p class="text-center text-info p-1"><a href="index.php">[Homepage]</a></p>
    <p class="text-center text-info p-1"><a href="login.php">[Login]</a></p>
    <p class="text-center text-info p-1"><a href="register.php">[Register]</a></p>
</div>
</body>
    <?php
}
?>