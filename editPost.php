<?php
session_start();
$id = (INT)$_GET['id'];
if ($id < 1) {
    header("location: index.php");
}
include "include/functions.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php getHeader(); ?>
    <script>
        let keepChanges = false;
        let keepContentChanges = false;
    </script>
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

    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote-lite.min.js"></script>

    <title>Edit Post</title>
</head>

<body>

<?php getNavigation(); ?>

<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <div class="panel-info">
            <?php
            include "include/db_connect.php";
            $stmt = $Database_con->prepare("SELECT * FROM posts where postID = '$id'");
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows === 0) { ?>
                <hr class="mb-5">
                <div class="panel">
                    <h1 class="text-danger">Warning!</h1>
                    <hr class="thick">
                    <div class="text-center h5">You are not allowed to modify this post. If you are the author of this
                        post
                        then you most login first.
                    </div>
                </div>
            <?php } else {
                $row = $result->fetch_assoc();
            }
            ?>
            <hr class='mb-5'>
            <div id='editTitleText' class="input-field"
                style="display:inline; padding:10px; min-width:10vw;font-size:36px;"><?php echo $row["postTitle"] ?> </div>
            <form role="form" data-request="updatePost" data-url="include/api.php"
                  data-method="POST" id="FormUpdatePost">

                <div id="newPostTitleGroup">
                    <input class="passData" id="postID" data-data="postID" name="postID"
                           value="<?php echo $row["postID"] ?>" disabled><br>
                    <textarea id="summernoteTitle"
                              name="summernoteTitle"> <?php echo $row["postTitle"] ?></textarea><br>
                    <input class="passData" data-data="newPostTitle" name="newPostTitle" type="text" id="newPostTitle"
                           class="h4"
                           style="color: rgb(255, 0, 0);">
                </div>

                <button id="updateDatabaseButton" type="submit" name="updateDatabaseButton"
                        style='display:block;float:right;font-size:24px'> Save
                    <i class='fas fa-save' style='font-size:36px;color:red'></i>
                </button>

                <button id="editPostTitleButton" type="button" name="editPostTitleButton">
                    Edit Title <i class='fas fa-edit' style='font-size:36px;color:green'></i>
                </button>

                <button id="previewTitleChange" type="button" name="previewTitleChange">Preview
                    <i class='fa fa-eye' style='font-size:36px;color:red'></i>
                </button>

                <hr class='mb-5'>

                <div id="postContentTextDiv" class="input-field">
                    <?php echo $row["postContent"] ?>
                </div>

                <div id="newPostContentGroup">
                    <textarea id="summernote"> <?php echo $row["postContent"] ?></textarea>
                    <input class="passData" id="newPostContent" type="text" data-data="newPostContent"
                           name="newPostContent">
                </div>

                <button id="editContentButton" type="button" name="editContentButton">
                    Edit Post <i class='fas fa-edit' style='font-size:36px;color:green'></i>
                </button>

                <button id="previewPostChange" type="button" name="previewPostChange">Preview
                    <i class='fa fa-eye' style='font-size:36px;color:red'></i>
                </button>
            </form>
            <hr class='mb-5'>
        </div>
    </div>
</div>
<?php getFooter(); ?>
<script>
    $('#summernoteTitle').summernote({
        tabsize: 2,
        height: 100,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });

    $('#summernote').summernote({
        tabsize: 2,
        height: 300,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });

</script>
</body>
</html>