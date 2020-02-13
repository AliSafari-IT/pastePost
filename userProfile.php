<?php
session_start();
include "include/functions.php";
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header("location: logout.php");
    die();
}
$userProfile = getUserProfile($_GET['username']);
if (!$userProfile) {
    header("location: login.php");
    die();
}

$username = $userProfile['username'];
$firstname = $userProfile['firstname'];
$lastname = $userProfile['lastname'];
$email = $userProfile['email'];
$userType = $userProfile['userType'];
$phoneGsmNr = $userProfile['phoneGsmNr'];
$addressStreet = $userProfile['addressStreet'];
$addressHouseNr = $userProfile['addressHouseNr'];
$addressPostalCode = $userProfile['addressPostalCode'];
$addressCity = $userProfile['addressCity'];
$addressCountry = $userProfile['addressCountry'];
?>

<!doctype html>
<html lang="en">
<head>
    <?php getHeader(); ?>
    <title><?php echo $username ?></title>
    <style>
        .list-group div {
            font-family: "Open Sans";
            font-size: 14px;
        }

        ul li.w-75 {
            background-color: whitesmoke;
            border-radius: 10px;
        }

        #updateProfile {
            float: left;
        }

        #updateProfile:hover {
            background-color: whitesmoke;
        }

        .hoverStyle {
            border-radius: 15px;
            border-style: groove;
            width: 100%;
            background-color: whitesmoke;
            color: #090ca1;
        }

        label {
            font-size: 14px;
            font-family: SansSerief, serif;
            font-weight: 900;
            color: whitesmoke;
        }

        .postList {
            font-size: 14px;
        }

        .postList:hover {
            font-family: 'Carter One', cursive;
            color: #63ff34;
            font-size: 16px;
            margin-left: 5px;
        }
        .list-group a:hover {
            color: whitesmoke;
        }
    </style>
</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300" id="home-section">
<?php getNavigation(); ?>
<?php getPostMenuBg(); ?>

<section class="" id="contact-section">
    <div class="container">
        <div class="row no-gutters">
            <div class="col-lg-6 bg-primary">
                <form action="#" class="p-3 contact-form">

                    <div class="h1 mb-3 ChewyFont">User profile</div>
                    <div class="row form-group">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="fname">First Name</label>
                            <input type="text" id="fname" class="form-control" value="<?php echo $firstname ?>"
                                   disabled>
                        </div>
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="lname">Last Name</label>
                            <input type="text" id="lname" class="form-control" value="<?php echo $lastname ?>" disabled>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="email">Email</label>
                            <input type="email" id="email" class="form-control" value="<?php echo $email ?>" disabled>
                        </div>
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="username">Username</label>
                            <input type="text" id="username" class="form-control" value="<?php echo $username ?>"
                                   disabled>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="userType">User Type</label>
                            <input type="userType" id="userType" class="form-control" value="<?php echo $userType ?>"
                                   disabled>
                        </div>
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="phoneGsmNr">Phone/GSM number</label>
                            <input type="text" id="phoneGsmNr" class="form-control" value="<?php echo $phoneGsmNr ?>"
                                   disabled>
                        </div>
                    </div>

                    <div class="row list-group">
                        <div class="col-md-12">
                            Address:
                            <?php if (!empty($addressStreet) && !empty($addressHouseNr) && !empty($addressPostalCode) && !empty($addressCity) && !empty($addressCountry)) { ?>
                                <ul>
                                    <li class="col-md-12 pt-1 m-1 w-75"
                                        title="Street and house number"><?php echo $addressStreet ?>
                                        , <?php echo $addressHouseNr ?> </li>
                                    <li class="col-md-12 pt-1 m-1 w-75"
                                        title="Postal code and city name"><?php echo $addressPostalCode ?>
                                        , <?php echo $addressCity ?></li>
                                    <li class="col-md-12 pt-1 m-1 w-75"
                                        title="Country"><?php echo $addressCountry ?></li>
                                </ul>
                            <?php } else { ?>
                                <div>
                                    <p>There is no address details to display.</p>
                                    <p>
                                        <a href="<?php echo 'userProfileChange.php?username=' . $_SESSION["username"]; ?>">
                                            Add address
                                        </a>
                                    </p>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="row col-md-12 mx-auto bg-transparent border-0" style="width: 360px;">
                        <a href="<?php echo 'userProfileChange.php?username=' . $_SESSION["username"]; ?>"
                           class="btn-link col-md-12 w3-bar bg-success hoverStyle growLink">Click Here to Change
                            Details</a>
                    </div>
                </form>


            </div>
            <div class="col-lg-6 bg-secondary">
                <div class="row mx-4 mt-3">
                    <div class="mb-5">
                        <div class="h1 mb-3 ChewyFont">Recent Posts of <u><?php echo $_SESSION["username"] ?></u></div>
                        <?php
                        include "include/db_connect.php";

                        function htmlToPlainText($str)
                        {
                            $str = str_replace('&nbsp;', ' ', $str);
                            $str = html_entity_decode($str, ENT_QUOTES | ENT_COMPAT, 'UTF-8');
                            $str = html_entity_decode($str, ENT_HTML5, 'UTF-8');
                            $str = html_entity_decode($str);
                            $str = htmlspecialchars_decode($str);
                            $str = strip_tags($str);

                            return $str;
                        }

                        $userPosts_query = "SELECT * FROM posts";
                        $userPosts_result = mysqli_query($Database_con, $userPosts_query);
                        $userPosts_fetch = mysqli_fetch_array($userPosts_result);
                        $postsLimit = 0;
                        $stmt = $Database_con->prepare("SELECT * FROM posts order by postID");
                        if (!$stmt) {
                            echo "Error!<div class='bg-danger text-center' style='height: 100px'>";
                            echo "<p class='pt-3'>Prepare failed: (" . $Database_con->errno . ") " . $Database_con->error . "</p><br>";
                            echo "</div>";
                            die();
                        }
                        $stmt->execute();
                        $result = $stmt->get_result();
                        if ($result->num_rows === 0) {
                            echo '<div class="text-center ">';
                            echo '<div class="panel-info my-1">No post to display!</div>';
                            echo '<button class="text-success text-center bg-transparent border-0 m-2"><a href="newpost.php" target="_blank" class="btn-link col-md-12 hoverStyle">Add New Post</a></button></div>';
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
                                if ($username === $_SESSION["username"] && $postsLimit < 5) {
                                    $postsLimit++;
                                    ?>
                                    <div class="LatoFont">
                                        <a href="<?php echo 'view.php?id=' . $postID . '&postedBy=' . $username ?>">
                                            <p class="postList grow">
                                                <?php echo $postsLimit . ". " . html_entity_decode(htmlToPlainText($postTitle)); ?>
                                            </p>
                                        </a>
                                    </div>
                                <?php }
                            }
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php getFooter(); ?>
<script type="text/javascript">
    $(".hoverable").hover(
        function () {
            $(this).addClass("hoverStyle");
        }, function () {
            $(this).removeClass("hoverStyle");
        }
    );
</script>
</body>
</html>
