<?php

session_start();

$id = (INT)$_GET['id'];
if ($id < 1) {
    header("location: index.php");
}
include "include/functions.php";

if (!isset($_SESSION['loggedin']) && !$_SESSION['loggedin']) {
    ?>
    <script>alert("You must be logged in in order to delete your posts!")</script>
    <?php
    header("location: index.php");
    die();
}
?>


<html lang="en">

<head>
    <?php getHeader(); ?>
    <style>
        * {
            font-family: 'Sarabun', sans-serif;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Fredoka One', cursive;
            color: #122b40;
        }

        button {
            font-family: 'Fredoka One', cursive;
            font-size: 24px;
            color: #761c19;
            border-radius: 8px;
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }

        button:hover {
            background-color: #4CAF50; /* Green */
            color: white;
            box-shadow: 0 12px 16px 0 rgba(0, 0, 0, 0.24), 0 17px 50px 0 rgba(0, 0, 0, 0.19);

        }

        textarea {
            border: 2px solid;
            padding: 20px;
            width: 300px;
            resize: both;
            overflow: auto;
            background-color: #b3ff28
        }
    </style>
</head>

<body>

<?php getNavigation(); ?>

<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <hr class="mb-5">

        <div class="panel-info">
            <?php
            include "include/db_connect.php";
            $stmt = $Database_con->prepare("SELECT * FROM posts where postID = '$id'");
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows === 0) { ?>
                <hr class="mb-5">
                <div class="panel">
                    <h3 class="text-danger">Warning!</h3>
                    <hr class="thick">
                    <h4>Either:</h4>
                    <div class="text-center h5">the post doesn't exist anymore,
                    </div>
                    <h4>Or:</h4>
                    <div class="text-center h5">You are not allowed to modify this post. If you are the author of this
                        post then you must login first.
                    </div>
                    <hr class="thick">
                </div>
                <?php
            } else {
                $row = $result->fetch_assoc();
                ?>
                <hr class="thick">
                <h4 class="text-danger" style="margin-left: 30px;">The post entitled: </h4>
                <hr class="thick">

                <h2 id='editTitleText' class="input-field text-center"
                    style="display:inline; padding:10px; min-width:10vw;">[ <?php echo $row["postTitle"] ?> ]</h2>
                <hr class="thick">
                <?php
                $stmt->close();
                if (deletePost($id)) {
                    ?>
                    <h2 class="text-success text-center">has been successfully deleted!</h2>
                    <?php
                } else {
                    ?>
                    <h2 class="text-success text-center">has NOT been deleted. Try again later!</h2>
                    <?php

                }
            }
            ?>
        </div>
        <hr>
        <div class="text-center ">
            <a href="index.php" class="h2 text-center">
                Homepage
                <i class="fa fa-caret-square-o-left" style="font-size:48px;color:#63ff34"></i>
            </a>
        </div>
    </div>
</div>
</body>
</html>