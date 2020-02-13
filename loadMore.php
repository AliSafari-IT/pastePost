<?php
session_start();
// configuration
include "include/db_connect.php";

$row = $_POST['row'];
$postPerPage = 3;
// selecting posts
$query = 'SELECT * FROM posts limit '.$row.','.$postPerPage;
$result = mysqli_query($Database_con, $query);

$html = '';

while ($row = mysqli_fetch_array($result)) {
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
    echo "==>".$publishedDateTime;

    // Creating HTML structure
    if (!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"]) {
        if ($visibilityType === 'public') {
            $html .= '<div class="post-preview post" id="postID-'.$postID.'>';
            $html .= '<a href=view.php?id=' . $postID . '&postedBy=' . $username . '>';
            $html .= '<h2 class="post-title">';
            $html .= $row['postTitle'];
            $html .= '</h2>';
            $html .= '<h3 class="post-subtitle" style="height: 150px;overflow: hidden">';
            $html .= $row['postContent'];
            $html .= '</h3>';
            $html .= '</a>';
            $html .= '<p class="post-meta">Posted by';
            $html .= '<a href="user.php?id="' . $postID . "&postedBy=" . $username . "><span ";
            $html .= 'class="badge badge-primary p-1"><i class="fa fa-user "';
            $html .= 'aria-hidden="true"></i>' . $username . '></span></a>';
            $html .= 'on ' . $publishedDateTime . '</p>';
            $html .= '<a href="view.php?id="' . $postID . '&postedBy=' . $username . '>Read more...</a>';
            $html .= '</div>';
        }
    } else {
        if ($username === $_SESSION["username"] || $visibilityType === 'public') {
            $html .= '<div class="post-preview post" id="postID-'.$postID.'>';
            $html .= '<a href="view.php?id="' . $postID . '&postedBy=' . $username . '>';
            $html .= '<h2 class="post-title post">';
            $html .= $row['postTitle'];
            $html .= '</h2>';
            $html .= '<h3 class="post-subtitle" style="height: 150px;overflow: hidden">';
            $html .= $row['postContent'];
            $html .= '</h3>';
            $html .= '</a>';
            $html .= '<p class="post-meta">Posted by ';
            $html .= '<a href="user.php?id="'.$postID.'&postedBy='.$username.'><span ';
            $html .= 'class="badge badge-primary p-1"><i class="fa fa-user "';
            $html .= 'aria-hidden="true"></i>'.$username.'></span></a>';
            $html .= 'on ' . $publishedDateTime . '</p>';
            $html .= '<a href="view.php?id="'.$postID.'&postedBy='.$username.' class="more">Read more...</a>';
            $html .= '</div>';
        }
    }
}
echo "<div>$html</div>";
