<?php
$errorMSG = "";


/* NAME */
if (empty($_POST["emailUsername"])) {
    $errorMSG = "<li>E-mail or username is required</<li>";
} else {
    $emailUsername = $_POST["emailUsername"];
}

$email = test_input($_POST["email"]);
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $emailErr = "Invalid email format";
}


/* EMAIL */
if (empty($_POST["password"])) {
    $errorMSG .= "<li>Password is required</li>";
} else if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    $errorMSG .= "<li>Invalid email format</li>";
}else {
    $email = $_POST["email"];
}


/* MSG SUBJECT */
if (empty($_POST["msg_subject"])) {
    $errorMSG .= "<li>Subject is required</li>";
} else {
    $msg_subject = $_POST["msg_subject"];
}


/* MESSAGE */
if (empty($_POST["message"])) {
    $errorMSG .= "<li>Message is required</li>";
} else {
    $message = $_POST["message"];
}


if(empty($errorMSG)){
    $msg = "Name: ".$name.", Email: ".$email.", Subject: ".$msg_subject.", Message:".$message;
    echo json_encode(['code'=>200, 'msg'=>$msg]);
    exit;
}


echo json_encode(['code'=>404, 'msg'=>$errorMSG]);


?>

<script type="text/javascript">
    function validateEmail(email){
        var re = /^(([^<>()[]\\.,;:\s@\"]+(\.[^<>()[]\\.,;:\s@\"]+)*)|(\".+\"))@(([[0-9]{1,3}\‌​.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }
</script>
