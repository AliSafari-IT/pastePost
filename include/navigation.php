<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="newpost.php"><i class='fas fa-blog'></i> Start Blogging</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
            Menu <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <?php if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>
                <?php }
                if (isset($_SESSION['loggedin']) && ($_SESSION['userType'] === "admin" || $_SESSION['userType'] === "moderator")){
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="setPostCategory.php" title="As a privileged user, you can set or modify a post category.">Modify Other Posts</a>
                    </li>
                <?php }
                if (isset($_SESSION['loggedin']) && $_SESSION['userType'] === "admin") { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="users.php" title="As admin, you can view the list of members for further actions.">Members List</a>
                    </li>
                <?php }
                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="newpost.php" title="As a registered user, you can add a new post here.">Add New Post</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
                <?php } ?>
            </ul>
            <!-- Right -->
            <ul class="navbar-nav nav-flex-icons right flex-row">
                <li class="nav-item">
                    <a href="https://github.com/AliSafari-IT/blogApplication" class="nav-link waves-effect"
                       target="_blank" title="Simple Blogger GitHub">
                        SB GitHub <i class="fab fa-github mr-2"></i>
                    </a>
                </li>
                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) { ?>
                    <li class="nav-item">
                        <a href=<?php echo 'userProfile.php?username=' . $_SESSION["username"]; ?> class="nav-link waves-effect"
                           title="Account Details">
                             <u>My Account</u> <i class="fas fa-user-cog"></i>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>