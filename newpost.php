<?php
include "include/functions.php";
logincheck();
?>

<!DOCTYPE html>
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

    <title>New Post</title>
</head>

<body>

<?php getNavigation(); ?>
<?php getPostMenuBg(); ?>

<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">

            <h3 class="note-icon-summernote text-success text-center">  Write your new post here</h3>

            <form data-request="newPost" data-url="include/api.php" data-method="POST" id="AddNewPost">
                <button id="SaveNewPostButton" type="submit" name="SaveNewPostButton"
                        style='display:block;float:right;font-size:24px'> Publish Post
                    <i class='fas fa-save' style='font-size:36px;color:red'></i>
                </button>
                <div class="form-group form-check">
                    <label class="form-check-label">
                        <input id="visibilityType" class="form-check-input" type="checkbox" data-data="visibilityType"
                               name="visibilityType"> Private Post
                    </label>
                </div>
                <div id='newPostTitleInDiv' class="input-field"
                     style="display:inline; padding:10px; min-width:10vw;font-size:36px;">Post Title </div>
                <div id="newPostContentInDiv" class="input-field">
                    Post Content place
                </div>
                <div class="form-group" id="newPostTitleGroup2">
                    <label for="newPostTitleEditor">Title</label><textarea id="newPostTitleEditor" placeholder="New Post Title place"></textarea>
                    <label for="newPostTitleInput" style="font-size: 11px">Post Title</label>
                    <input data-data="newPostTitleInput" type="text" class="form-control" id="newPostTitleInput" placeholder="Post Title">
                </div>

                <hr class='mb-5'>

                <button id="previewNewTitleButton" type="button" name="previewNewTitleButton">Preview
                    <i class='fa fa-eye' style='font-size:36px;color:red'></i>
                </button>
                <hr class='mb-5'>

                <div class="form-group" id="newPostContentGroup2">
                    <textarea id="newPostContentEditor" placeholder="New Post Content place"></textarea>
                    <label for="postContent">Post Body</label>
                    <input data-data="newPostContentInput" type="text" class="form-control" id="newPostContentInput" placeholder="Post Content">
                </div>

                <button id="previewNewContentButton" type="button" name="previewNewContentButton">Preview
                    <i class='fa fa-eye' style='font-size:36px;color:red'></i>
                </button>
            </form>

        </div>
    </div>
</div>

<?php getFooter(); ?>
<script>
    $('#newPostTitleEditor').summernote({
        tabsize: 2,
        height: 50,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            // ['para', ['ul', 'ol', 'paragraph']],
            // ['table', ['table']],
            // ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });

    $('#newPostContentEditor').summernote({
        tabsize: 2,
        height: 150,
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