$(document).ready(function () {

    // ********************* Add New Post *********************
    let newPostTitleInDiv = $("#newPostTitleInDiv");
    newPostTitleInDiv.hide();

    let newPostTitleEditor = $("#newPostTitleEditor");

    let newPostTitleInput = $("#newPostTitleInput");
    newPostTitleInput.hide();

    let previewNewTitleButton = $("#previewNewTitleButton");

    let SaveNewPostButton = $("#SaveNewPostButton");
    SaveNewPostButton.hide();

    let newPostContentInDiv = $("#newPostContentInDiv");
    newPostContentInDiv.hide();

    let newPostContentEditor = $("#newPostContentEditor");

    let newPostContentInput = $("#newPostContentInput");
    newPostContentInput.hide();

    let previewNewContentButton = $("#previewNewContentButton");

    let newPostTitleGroup2 = $("#newPostTitleGroup2");
    let newPostContentGroup2 = $("#newPostContentGroup2");


    let topOfThePage = $(window);

    previewNewTitleButton.click(function () {
        // previewNewTitleButton.hide();
        const takeNewPostTitleText = newPostTitleEditor.val();
        newPostTitleInput.val(takeNewPostTitleText);
        newPostTitleInDiv.html(takeNewPostTitleText);

        const takeNewPostContentText = newPostContentEditor.val();
        newPostContentInput.val(takeNewPostContentText);
        newPostContentInDiv.html(takeNewPostContentText);

        newPostTitleInDiv.show();
        SaveNewPostButton.show();
        topOfThePage.scrollTop(0);
        console.log("Title of new post: " + takeNewPostTitleText);
    });

    previewNewContentButton.click(function () {
        // previewNewContentButton.hide();
        const takeNewPostContentText = newPostContentEditor.val();
        newPostContentInput.val(takeNewPostContentText);
        newPostContentInDiv.html(takeNewPostContentText);

        const takeNewPostTitleText = newPostTitleEditor.val();
        newPostTitleInput.val(takeNewPostTitleText);
        newPostTitleInDiv.html(takeNewPostTitleText);

        newPostContentInDiv.show();
        SaveNewPostButton.show();
        topOfThePage.scrollTop(0);
        console.log("Content of new post: " + takeNewPostContentText);
    });

    SaveNewPostButton.click(function () {
        previewNewTitleButton.hide();
        previewNewContentButton.hide();
        newPostTitleGroup2.hide();
        newPostContentGroup2.hide();
        topOfThePage.scrollTop(0);
        console.log("Submitting new post!");
    });

    $(document).on('submit', '#AddNewPost', function (e) {
        console.log("Ajax for adding new post from js.js");

        e.preventDefault();
        self = this;
        var request = $(this).data("request");
        var url = $(this).data("url");
        var method = $(this).data("method");
        var data = {};
        // $.each($('input'), function (key, value) {
        // console.log(key + ':' + $(value).val());
        // });
        $(this).find('input').each(function (key, value) {
            // console.log(this);
            if (key == 0 || key == 13 || key == 26) {
                data[$(value).data("data")] = $(value).val();
            }
            ;
        });
        chk = document.getElementById("visibilityType").checked ? 1 : 0;
        data['visibilityType'] = chk;
        console.log(data);

        $.ajax({
            method: method,
            url: url,
            data: {request: request, data: data}
        }).done(function (jsonData) {

            var data = JSON.parse(jsonData);
            // console.log(data);

            if (data['message']) {
                showToast(data['message']);
            }
            if (data['redirect']) {
                window.location.href = data['redirect'];
            }

        });

    });


    // ********************* Edit Post *********************
    let editTitleTextH2 = $("#editTitleText");

    const bgColor = $('html').css("background-color");
    let postTitleGroup = $("#newPostTitleGroup");
    postTitleGroup.hide();

    let thisPostID = $("#postID");
    thisPostID.hide();

    let newPostTitleInEditor = $("#summernoteTitle");

    let newPostTitleInputBox = $("#newPostTitle");

    let updateDB = $("#updateDatabaseButton");
    updateDB.hide();

    let editTitleButton = $("#editPostTitleButton");

    let previewTitleChange = $("#previewTitleChange");
    previewTitleChange.hide();

    let postContentTextDiv = $("#postContentTextDiv");

    let postContentGroup = $("#newPostContentGroup");
    postContentGroup.hide();

    let newPostContentInEditor = $("#summernote");
    let newPostContentInputBox = $("#newPostContent");

    let editContentButton = $("#editContentButton");

    let previewPostChange = $("#previewPostChange");
    previewPostChange.hide();

    let editPostButton = $("#editContentButton");

    editTitleButton.click(function () {
        postTitleGroup.show();
        newPostTitleInputBox.css('background-color', 'yellow');
        newPostTitleInputBox.prop('disabled', true);
        newPostTitleInputBox.hide();
        previewTitleChange.show();
    });

    previewTitleChange.click(function () {
        previewTitleChange.hide();
        const updatedTitle = newPostTitleInEditor.val();
        editTitleTextH2.html(updatedTitle);
        newPostTitleInputBox.val(updatedTitle);

        const updatedPost = newPostContentInEditor.val();
        postContentTextDiv.html(updatedPost);
        newPostContentInputBox.val(updatedPost);

        postTitleGroup.hide();
        updateDB.show();
        console.log("Title updated: " + updatedTitle);
    });

    editContentButton.click(function () {
        postContentGroup.show();
        previewPostChange.show();
        newPostContentInputBox.css('background-color', 'yellow');
        newPostContentInputBox.prop('disabled', true).hide();

    });

    previewPostChange.click(function () {
        previewPostChange.hide();
        const updatedTitle = newPostTitleInEditor.val();
        editTitleTextH2.html(updatedTitle);
        newPostTitleInputBox.val(updatedTitle);

        const updatedPost = newPostContentInEditor.val();
        postContentTextDiv.html(updatedPost);
        newPostContentInputBox.val(updatedPost);

        postContentGroup.hide();
        updateDB.show();
        console.log("Post content updated: " + updatedPost);

    });

    updateDB.click(function () {
        previewTitleChange.hide();
        previewPostChange.hide();
        updateDB.hide();
    });


    $(document).on('submit', '#FormUpdatePost', function (e) {
        console.log("Ajax for the post updating form in editPost.php from js.js");

        e.preventDefault();
        self = this;
        var request = $(this).data("request");
        var url = $(this).data("url");
        var method = $(this).data("method");
        var data = {};
        $.each($('input'), function (key, value) {
            console.log(key + ':' + $(value).val());
        });
        $(this).find('input').each(function (key, value) {
            // console.log(this);
            if (key === 0 || key === 13 || key === 26) {
                data[$(value).data("data")] = $(value).val();
            }
            ;
        });
        console.log(data);

        $.ajax({
            method: method,
            url: url,
            data: {request: request, data: data}
        }).done(function (jsonData) {

            var data = JSON.parse(jsonData);
            // console.log(data);

            if (data['message']) {
                showToast(data['message']);
            }
            if (data['redirect']) {
                window.location.href = data['redirect'];
            }

        });

    });


    $(document).on('submit', '#FormLoginUser', function (e) {
        console.log("Ajax for the User Login form in login.php from js.js");

        e.preventDefault();
        self = this;
        var request = $(this).data("request");
        var url = $(this).data("url");
        var method = $(this).data("method");
        var data = {};
        $.each($('input'), function (key, value) {
            console.log(key + ':' + $(value).val());
        });
        $(this).find('input').each(function (key, value) {
            // if (key == 0 || key == 13 || key==26){
            data[$(value).data("data")] = $(value).val();
            // };
        });
        // console.log(data);

        $.ajax({
            method: method,
            url: url,
            data: {request: request, data: data}
        }).done(function (jsonData) {

            var data = JSON.parse(jsonData);
            // console.log(data);

            if (data['message']) {
                showToast(data['message']);
            }
            if (data['redirect']) {
                window.location.href = data['redirect'];
            }

        });

    });


    $(document).on('submit', '#FormRegisterUser', function (e) {
        console.log("Ajax for the User Registration form in register.php from js.js");

        e.preventDefault();
        self = this;
        var request = $(this).data("request");
        var url = $(this).data("url");
        var method = $(this).data("method");
        var data = {};
        // $.each($('input'), function (key, value) {
        //     console.log(key + ':' + $(value).val());
        // });
        $(this).find('input').each(function (key, value) {
            // if (key == 0 || key == 13 || key==26){
            data[$(value).data("data")] = $(value).val();
            // };
        });
        // console.log(data);

        $.ajax({
            method: method,
            url: url,
            data: {request: request, data: data}
        }).done(function (jsonData) {

            var data = JSON.parse(jsonData);
            // console.log(data);

            if (data['message']) {
                showToast(data['message']);
            }
            if (data['redirect']) {
                window.location.href = data['redirect'];
            }

        });

    });

    $(".hoverable").hover(
        function () {
            $(this).addClass("hoverStyle");
        }, function () {
            $(this).removeClass("hoverStyle");
        }
    );

    $(document).on('submit', '#updateUserDetailsForm', function (e) {
        console.log("Ajax for the User Details Update in userProfileChange.php from js.js");

        e.preventDefault();
        self = this;
        var request = $(this).data("request");
        var url = $(this).data("url");
        var method = $(this).data("method");
        var data = {};
        $.each($('input'), function (key, value) {
            console.log(key + ' --->  ' + $(value).val());
        });
        $(this).find('input').each(function (key, value) {
            data[$(value).data("data")] = $(value).val();
        });
        $.ajax({
            method: method,
            url: url,
            // dataType: 'json',
            data: {request: request, data: data}
        }).done(function (jsonData) {
            var data = JSON.parse(jsonData);

            if (data['message']) {
                showToast(data['message']);
            }
            if (data['redirect']) {
                window.location.href = data['redirect'];
            }
        });

    });

    $(document).on('click', '.post .actionbutton', function () {

        self = this;

        var id_post = $(this).parent().data('id_post');

        var request = $(this).data("request");
        var url = $(this).data("url");
        var method = $(this).data("method");
        var deleteElement = $(this).data("deleteElement");
        var data = {};

        data['id'] = id_post;

        $.ajax({method: "POST", url: url, data: {request: request, data: data}}).done(function (jsonData) {

            var data = JSON.parse(jsonData);

            if (data['message']) {
                showToast(data['message']);
                $(self).parent().parent().remove();
            }
            if (data['redirect']) {
                window.location.href = data['redirect'];
            }

        });

    });
});


function generateTable(data) {

    var table = "<div class='table table-bordered'><table class='table-hover table-bordered'><thead class='thead-dark'><tr>";

    Object.keys(data[0]).forEach(function (key) {
        table += "<th>";
        table += key;
        table += "</th>";
    });

    table += "</tr></thead><tbody>";

    data.forEach(function (row) {

        table += "<tr>";

        Object.keys(row).forEach(function (key) {
            table += "<td>";
            table += row[key];
            table += "</td>";
        });

        table += "</tr>";

    });

    table += "</tbody></table></div>";
    return table;
}


function showToast(message) {

    $(".toast").remove();

    var toastHtml =
        `<div class="toast col padding" style="position:absolute;top:25%;right:5%; border: orangered 2px solid" data-delay="10000">
                            <div class="toast-header">
                                <strong class="mr-auto text-primary font-weight-bold" style="font-size: 18px;">Notification</strong>
                                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
                            </div>
                            <div class="toast-body padding" style="font-size: large; background-color: yellow; color: red">
                                {{message}}
                            </div>
                        </div>`

    toastHtml = toastHtml.replace("{{message}}", message);

    $("html").append(toastHtml);
    $('.toast').toast('show');

}