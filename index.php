<?php
session_start();
include "include/functions.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php getHeader(); ?>
    <title>Blog Application</title>
</head>
<!-- The scrollable area -->
<body>

<?php getNavigation(); ?>
<?php getPageHeader(); ?>
<script>
    const jsFrame = new JSFrame();
    jsFrame.showToast({
        html: 'This site is not yet operational!', align: 'top', duration: 5000
    });
</script>
<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto appendData">
            <?php
            include "include/db_connect.php";

            $postPerPage = 3;    //show 3 posts per page
            // counting total number of posts
            $totalNr_query = "SELECT count(*) as totalPostNrs FROM posts";
            $totalNr_result = mysqli_query($Database_con, $totalNr_query);
            $totalNr_fetch = mysqli_fetch_array($totalNr_result);
            $totalNr = $totalNr_fetch['totalPostNrs'];

            $stmt = $Database_con->prepare("SELECT * FROM posts order by postID desc limit 0,$postPerPage");
            if (!$stmt) {
                echo "Error!<div class='bg-danger text-center' style='height: 100px'>";
                echo "<p class='pt-3'>Prepare failed: (" . $Database_con->errno . ") " . $Database_con->error . "</p><br>";
                echo "</div>";
                die();
            }
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows === 0) {
                echo '<div class="post-preview border px-5 pb-5 border-danger post">';
                echo '<div class="panel-info my-5">Nothing to display!</div>';
                echo '<div class="text-success text-center"><a href="newpost.php" class="btn btn-lg btn-blue">Add New Post</a></div>';
            } else {
                while ($row = $result->fetch_assoc()) {
                    $postID = htmlentities($row['postID']);
                    $visibilityType = htmlentities($row['visibilityType']);
                    $postTitle = htmlentities($row['postTitle']);
                    if ($postTitle == '') {
                        $row['postTitle'] = "[Post without Title!]";
                    }
                    $postContent = htmlentities($row['postContent']);
                    $username = htmlentities($row['username']);
                    $catID = htmlentities($row['catID']);
                    $publishedDateTime = htmlentities($row['publishedDateTime']);
                    $postViews = htmlentities($row['postViews']);
                    if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
                        if ($visibilityType === 'public') { ?>
                            <div class="post-preview post" id="postID-<?php echo $postID; ?>">
                                <a href=<?php echo 'view.php?id=' . $postID . '&postedBy=' . $username ?>>
                                    <h2 class="post-title">
                                        <?php echo html_entity_decode($postTitle); ?>
                                    </h2>
                                    <h3 class="post-subtitle" style="height: 150px;overflow: hidden">
                                        <?php echo html_entity_decode($postContent); ?>
                                    </h3>
                                </a>
                                <a href=<?php echo 'view.php?id=' . $postID . '&postedBy=' . $username; ?>>
                                    <span class="text-primary">Read more...</span>
                                </a>
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
                        <?php }
                    } else {
                        if ($username === $_SESSION["username"] || $visibilityType === 'public') { ?>
                            <div class="post-preview post" id="postID-<?php echo $postID; ?>">
                                <a href=<?php echo 'view.php?id=' . $postID . '&postedBy=' . $username ?>>
                                    <h2 class="post-title">
                                        <?php echo html_entity_decode($postTitle); ?>
                                    </h2>
                                    <h3 class="post-subtitle" style="height: 150px;overflow: hidden">
                                        <?php echo html_entity_decode($postContent); ?>
                                    </h3>
                                </a>
                                <a href=<?php echo 'view.php?id=' . $postID . '&postedBy=' . $username; ?>>
                                    <span class="text-primary">Read more...</span>
                                </a>
                                <p class="post-meta">Posted by
                                    <a href=<?php echo "user.php?id=" . $postID . "&postedBy=" . $username; ?>>
                                        <span
                                                class="badge badge-primary p-1">
                                            <i class="fa fa-user" aria-hidden="true">

                                            </i> <?php echo $username; ?>
                                        </span>
                                    </a>
                                    on <?php echo $publishedDateTime; ?>
                                </p>
                            </div>
                            <?php
                        }
                    }
                } ?>
                <!-- Pager -->
                <div class="clearfix">
                    <h1 id="loadMore" class="btn btn-primary float-right">
                        Load Previous Posts
                        <i class="fas fa-hand-pointer" style="font-size:28px; "></i>
                    </h1>
                    <input id="row" style="display: none" value="0">
                    <input id="all" style="display: none" value="<?php echo $totalNr; ?>">
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<hr>
<?php getFooter(); ?>

<script type="text/javascript">

    const loadMore = $("#loadMore");
    const showTillThisRowNr = $('#row');
    const allPostNrs = $('#all')

    $(document).ready(function () {
        // Load more data
        loadMore.click(function (e) {
            e.preventDefault();

            let row = Number(showTillThisRowNr.val());
            const totalNr = Number(allPostNrs.val());
            const postPerPage = 3;
            row = row + postPerPage;
            console.log(row);   //--------> for debugging
            if (row <= totalNr) {
                showTillThisRowNr.val(row);
                console.log(showTillThisRowNr);   //--------> for debugging

                $.ajax({
                    url: 'loadMore.php',
                    type: 'post',
                    data: {row: row},
                    beforeSend: function () {
                        loadMore.text("Loading...");
                    },
                    success: function (response) {

                        // Setting little delay while displaying new content
                        setTimeout(function () {
                            // appending posts after last post with class="post"
                            $(".post:last").after(response).show().fadeIn("slow");

                            const rowNr = row + postPerPage;

                            // checking row value is greater than totalNr or not
                            if (rowNr > totalNr) {

                                // Change the text and background
                                loadMore.text("Hide");
                                loadMore.css("background", "darkorchid");
                            } else {
                                loadMore.text("Load more");
                            }
                        }, 2000);

                    }
                });
            } else {
                loadMore.text("Loading...");

                // Setting little delay while removing contents
                setTimeout(function () {

                    // When row is greater than totalNr then remove all class='post' element after 3 element
                    $('.post:nth-child(3)').nextAll('.post').remove();

                    // Reset the value of row
                    $("#row").val(0);

                    // Change the text and background
                    loadMore.text("Load more");
                    loadMore.css("background", "#15a9ce");
                    location.reload();
                }, 2000);

            }

        });
    });
</script>

</body>

</html>
