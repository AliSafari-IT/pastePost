<?php
session_start();
$id = (INT)$_GET['id'];
$postedBy = $_GET['postedBy'];

if ($id < 1) {
    header("location: index.php");
}
include "include/functions.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php getHeader(); ?>
    <title>Post <?php echo $id ?>: <?php echo $postedBy ?></title>
</head>

<body>

<?php getNavigation(); ?>
<?php getPostMenuBg(); ?>

<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <?php
            include "include/db_connect.php";
            $updateViewStatement = "UPDATE posts SET postViews = postViews +1 WHERE postID = '$id'";
            mysqli_query($Database_con, $updateViewStatement);

            $stmt = $Database_con->prepare("SELECT * FROM posts where postID = '$id'");
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows === 0) { ?>
                <div class="post-preview">
                    <h1 class="text-danger">Warning!</h1>
                    <div class="text-center h5">You are not allowed to modify this post. If you are the author of this
                        post then you most login first.
                    </div>
                </div>
                <?php
            } else {
                $row = $result->fetch_assoc();
                $postID = htmlentities($row['postID']);
                $visibilityType = htmlentities($row['visibilityType']);
                $postTitle = htmlentities($row['postTitle']);
                $postTitle = htmlentities($row['postTitle']);
                $postContent = htmlentities($row['postContent']);
                $username = htmlentities($row['username']);
                $catID = htmlentities($row['catID']);
                $publishedDateTime = htmlentities($row['publishedDateTime']);
                $postViews = htmlentities($row['postViews']);
                if (!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"]) {
                    if ($visibilityType === 'public') { ?>
                        <div class="post-preview">

                            <h2 class="post-title">
                                <?php echo $row['postTitle'] ?>
                            </h2>
                            <div style="font-family:'Roboto', sans-serif;font-size: 15px;">
                                <?php echo $row['postContent']; ?>
                            </div>
                            <h4 class="text-right">
                                <button onclick="function goBack() {window.history.back();} goBack()"
                                        class="btn btn-blue">
                                    Go Back
                                </button>
                            </h4>
                            <p class="post-meta">Posted by
                                <a href=<?php echo "user.php?id=" . $postID . "&postedBy=" . $username; ?>>
                                    <span class="badge badge-primary p-1">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                        <?php echo $username; ?>
                                    </span>
                                </a>
                                on <?php echo $publishedDateTime; ?>
                            </p>

                        </div>


                        <?php
                    }
                } else {
                    echo "<hr>";
                    if ($username === $_SESSION["username"] || $visibilityType === 'public') {
                        ?>
                        <div class="post-preview">
                            <h2 class="post-title">
                                <?php echo $row['postTitle'] ?>
                            </h2>
                            <div style="font-family:'Roboto', sans-serif;font-size: 15px;">
                                <?php echo $row['postContent']; ?>
                            </div>
                            <h4 class="text-right">
                                <button onclick="function goBack() {window.history.back();} goBack()"
                                        class="btn btn-blue">
                                    Go Back
                                </button>
                            </h4>
                            <p class="post-meta">Posted by
                                <a href=<?php echo "user.php?id=" . $postID . "&postedBy=" . $username; ?>><span
                                            class="badge badge-primary p-1"><i class="fa fa-user"
                                                                               aria-hidden="true"></i> <?php echo $username; ?></span></a>
                                on <?php echo $publishedDateTime; ?></p>

                        </div> <?php
                    }
                }
            }
            ?>
        </div>
    </div>
    <?php
    if (isset($_SESSION['username']) && $postedBy == $_SESSION['username']) {
        ?>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-3 text-center">

                <button style='font-size:24px'>
                    <a href="editPost.php?id=<?php echo $id; ?>">
                        <i class='fas fa-edit' style='font-size:48px;color:green' title="Edit the Post"></i>
                    </a>
                </button>

                <button style='font-size:24px'>
                    <a onclick="return confirm('Are you sure you want to delete this post?');"
                       href="deletePost.php?id=<?php echo $id; ?>">
                        <i class='fas fa-eraser' style='font-size:48px;color:red' title="Delete the Post"></i>
                    </a>
                </button>
            </div>
        </div>
    <?php } else { ?>
        <div>
            <p class="text-center text-info"><a href="index.php">[Homepage]</a></p>
        </div>
    <?php } ?>
</div>
<?php getFooter(); ?>

</body>

</html>
