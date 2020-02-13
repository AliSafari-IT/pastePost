<?php
//Check if there is a request with data attached
if (!isset($_POST['request']) || !isset($_POST['data'])) {
    echo "bad request - variables not set";
    die();
} else {
    $request = $_POST['request'];
    $data = $_POST['data'];
}

include "functions.php";

if ($request == "loginUser") {

    /* E-mail | Username  validation*/
    $emailUsername = $data["emailUsername"];
    $password = $data["password"];
    if (empty($password)) {
        $response['message'] = "Password is required!";

    } elseif (empty($emailUsername)) {
        $response['message'] = "E-mail | Username is required!";
    } elseif (filter_var($emailUsername, FILTER_VALIDATE_EMAIL)) {
        $response['response'] = loginUser($data['emailUsername'], $data['password']);
        if ($response['response']) {
            $response['message'] = "Login successful!";
            $response['redirect'] = "index.php";
        } else {
            $response['message'] = "Error login! Check your email/password combination!";
        }
    } else {
        // check if username only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z0-9]*$/", $emailUsername)) {
            $response['message'] = "Only letters and numbers without space are allowed for a username!";
        }
        $response['response'] = loginUser($data['emailUsername'], $data['password']);
        if ($response['response']) {
            $response['message'] = "Login successful!";
            $response['redirect'] = "index.php";
        } else {
            $response['message'] = "Error login! Check your username/password combination!";
        }
    }

} else if ($request == "registerUser") {
    $firstname = filter_var($data["firstname"], FILTER_SANITIZE_STRING);
    $lastname = filter_var($data["lastname"], FILTER_SANITIZE_STRING);
    $email = $data["email"];
    $iEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
    $username = filter_var($data["username"], FILTER_SANITIZE_STRING);
    $password = filter_var($data["password"], FILTER_SANITIZE_STRING);
    $confPassword = filter_var($data["confPassword"], FILTER_SANITIZE_STRING);
    if (empty($firstname) || empty($lastname)) {    // **** First/Last names validation
        $response['message'] = "First/Last names are required!";
    } else if (!preg_match("/^[a-zA-Z -]*$/", $firstname) || !preg_match("/^[a-zA-Z -]*$/", $lastname)) {
        $response['message'] = "Use only letters for First/Last names!";
    } elseif (!$iEmail) {   // ************************ email validation
        $response['message'] = "$email is not a valid email address!";
    } else if (checkEmailAlreadyTaken($email)) {
        $response['message'] = "< $email > is already used, please register using another email!";
    } elseif (empty($username)) {  // username validation
        $response['message'] = "username is required!";
    } elseif (checkUsernameAlreadyTaken($username)) {
        $response['message'] = "< $username > is already used, please register using another username!";
    } elseif (empty($password)) {  // username validation
        $response['message'] = "Password is required!";
    } elseif (strlen($password)<4) {  // Password validation
        $response['message'] = "Use a minimum password length of 4 or more characters!";
    } elseif (empty($confPassword)) {  // Password confirmation validation
        $response['message'] = "Password confirmation is required!";
    }   elseif ($confPassword !== $password) {  // Password confirmation validation
        $response['message'] = "Passwords do not match!";
    }  else {

        $response['response'] = registerUser(
            $data['firstname'],
            $data['lastname'],
            $data['email'],
            $data['username'],
            $data['password'],
            $data['addressStreet'],
            $data['addressHouseNr'],
            $data['addressCity'],
            $data['addressPostalCode'],
            $data['addressCountry'],
            $data['phoneGsmNr']
        );

        if ($response['response']) {
            $response['message'] = "User Registered Successfully!";
            $response['redirect'] = "login.php";
        } else {
            $response['message'] = "Error: either email or username is already taken!";
        }
    }

} else if ($request == "getUsers") {

    $response['data'] = getUsers();


} else if ($request == "getPosts") {

    $response['data'] = getPosts();

} else if ($request == "getPost") {

    $id = $data['id'];
    $response['data'] = getPost($id);

} else if ($request == "newPost") {

    session_start();
    $response['response'] = newPost($_SESSION['username'], $data['visibilityType'], $data['newPostTitleInput'], $data['newPostContentInput']);

    if ($response['response']) {
        $response['message'] = "Message Posted";
        $response['redirect'] = "index.php";
    } else {
        $response['message'] = "Error Posting Message";
    }

} else if ($request == "deletePost") {

    $id = $data['userID'];
    $response['response'] = deletePost($id);

    if ($response['response']) {
        $response['message'] = "Post Deleted";
    } else {
        $response['message'] = "Error Deleting Message";
    }

} else if ($request == "getUserProfile") {

    $id = $_SESSION['userID'];
//    echo "id".$id;
    $response['data'] = getUser($id);

} else if ($request == "updateUserDetails") {
    session_start();
    $firstname = filter_var($data["firstname"], FILTER_SANITIZE_STRING);
    $lastname = filter_var($data["lastname"], FILTER_SANITIZE_STRING);
    $email = $data["email"];
    $iEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
    $username = filter_var($data["username"], FILTER_SANITIZE_STRING);
    $userType = filter_var($data["userType"], FILTER_SANITIZE_STRING);
    $addressStreet = filter_var($data["addressStreet"], FILTER_SANITIZE_STRING);
    $addressHouseNr = filter_var($data["addressHouseNr"], FILTER_SANITIZE_STRING);
    $addressCity = filter_var($data["addressCity"], FILTER_SANITIZE_STRING);
    $addressPostalCode = filter_var($data["addressPostalCode"], FILTER_SANITIZE_STRING);
    $addressCountry = filter_var($data["addressCountry"], FILTER_SANITIZE_STRING);
    $phoneGsmNr = filter_var($data["phoneGsmNr"], FILTER_SANITIZE_STRING);

    if (empty($firstname) || empty($lastname)) {    // **** First/Last names validation
        $response['message'] = "First/Last names are required!";
    } else if (!preg_match("/^[a-zA-Z -]*$/", $firstname) || !preg_match("/^[a-zA-Z -]*$/", $lastname)) {
        $response['message'] = "Use only letters for First/Last names!";
    } elseif (!$iEmail) {   // ************************ email validation
        $response['message'] = "$email is not a valid email address!";
    } else if ($email !== $_SESSION['email'] && checkEmailAlreadyTaken($email)) {
        $response['message'] = "This email < $email > has already been used, please register using another email!";
    } else {

        $response['response'] = updateUserDetails(
            $firstname,
            $lastname,
            $email,
            $username,
            $userType,
            $addressStreet,
            $addressHouseNr,
            $addressCity,
            $addressPostalCode,
            $addressCountry,
            $phoneGsmNr
        );

        if ($response['response']) {
            $_SESSION["email"] = $email;
            $_SESSION["firstname"] = $firstname;
            $_SESSION["lastname"] = $lastname;
            $_SESSION["userType"] = $userType;
            $_SESSION["addressStreet"] = $addressStreet;
            $_SESSION["addressHouseNr"] = $addressHouseNr;
            $_SESSION["addressCity"] = $addressCity;
            $_SESSION["addressPostalCode"] = $addressPostalCode;
            $_SESSION["addressCountry"] = $addressCountry;
            $_SESSION["phoneGsmNr"] = $phoneGsmNr;

            $response['message'] = "User Details Updated Successfully!";
            $response['redirect'] = 'userProfile.php?username=' . $username;
        } else {
            $response['message'] = "Warning: user details are not saved! Try again!";
        }

}} else if ($request == "updatePost") {
    session_start();

    $id = $data['postID'];
    $postTitle = $data['newPostTitle'];
    $postContent = $data['newPostContent'];
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) {
        $loggedUser = $_SESSION['username'];
    } else {
        $loggedUser = "publicPost";
    }
    $response['response'] = updatePost($id, $postTitle, $postContent);
    if ($response['response']) {
        $response['message'] = "Post Updated";

        $response['redirect'] = "view.php?id=" . $id . "&loggedUser=" . $loggedUser;
    } else {
        $response['message'] = "Error Updating the Post!";
    }
} else {

    echo "bad request - not found";
    die();

}

//Encode response to send back
echo json_encode($response);