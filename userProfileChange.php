<?php
session_start();
include "include/functions.php";
if (!isset($_SESSION['loggedin']) && !$_SESSION['loggedin']) {
    header("location: login.php");
    die();
}
$userProfile = getUserProfile($_SESSION['username']);


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

<!DOCTYPE html>
<html lang="en">
<head>
    <?php getHeader(); ?>
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
            /*background-color: whitesmoke;*/
            color: #090ca1;
        }

        label {
            font-size: 14px;
            font-family: SansSerief;
            font-weight: 900;
            color: whitesmoke;
        }

        input, label {
            margin-top: 7px;
            margin-bottom: 7px;
            color: #000066;
            font-size: 18px;
            padding-right: 7px
        }

        input[type='checkbox'] {
            margin-left: 5px
        }

        .note {
            color: #ff0000
        }

        .success_msg {
            color: #006600
        }
    </style>
    <title>Updating details for <?php echo $username ?></title>

</head>
<body>
<?php getNavigation(); ?>
<?php getPostMenuBg(); ?>
<section class="" id="contact-section">
    <div class="container">
        <div class="row no-gutters">
            <div class="col-lg-12 bg-primary">
                <form class="form shake p-3 contact-form" novalidate data-request="updateUserDetails"
                      data-url="include/api.php" data-toggle="validator"
                      data-method="POST" id="updateUserDetailsForm" autocomplete="on">

                    <h2 class="h1 mb-3 heading ChewyFont">Update user profile </h2>
                    <div class="row form-group">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="firstname">First name:</label>
                            <input type="text" id="firstname" name="firstname" data-data="firstname"
                                   class="form-control" value="<?php echo $firstname ?>">
                        </div>
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="lastname">Last name:</label>
                            <input type="text" id="lastname" name="lastname" data-data="lastname"
                                   class="form-control" value="<?php echo $lastname ?>">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="email">E-mail:</label>
                            <input type="email" id="email" name="email" data-data="email"
                                   class="form-control" value="<?php echo $email ?>">
                        </div>
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" data-data="username"
                                   class="form-control bg-warning text-dark notAllowed" required
                                   value="<?php echo $username ?>" disabled title="You can't change your username!">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-6 mb-3 mb-md-0" id="userTypeInputs">
                            <?php if ($userType != 'admin') { ?>
                                <input type="text" id="userType" name="userType" data-data="userType"
                                       class="form-control bg-warning text-dark notAllowed" required
                                       value="<?php echo $userType ?>" disabled
                                       title="You don't have the privilege to change the user type!">
                            <?php } else { ?>
                                <div class="row text-center">
                                    <div class="w-25 text-center">
                                        Admin
                                    </div>
                                    <div class="w-25 text-center">
                                        Moderator
                                    </div>
                                    <div class="w-25 text-center">
                                        User
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="w-25">
                                        <input type="checkbox" id="userAdmin" name="userType" data-data="userType"
                                               class="form-control"
                                               value="Admin" <?php if ($userType === 'admin') echo "checked" ?>>
                                    </div>
                                    <div class="w-25">
                                        <input type="checkbox" id="userModerator" name="userType" data-data="userType"
                                               class="form-control"
                                               value="Moderator" <?php if ($userType === 'moderator') echo "checked" ?>>
                                    </div>
                                    <div class="w-25">
                                        <input type="checkbox" id="userUser" name="userType" data-data="userType"
                                               class="form-control"
                                               value="User" <?php if ($userType === 'user') echo "checked" ?>>
                                    </div>

                                </div>

                            <?php } ?>
                        </div>
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="phoneGsmNr">Phone/GSM number</label>
                            <input type="text" id="phoneGsmNr" name="phoneGsmNr" data-data="phoneGsmNr"
                                   class="form-control" value="<?php echo $phoneGsmNr ?>">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="addressStreet">Street</label>
                            <input type="text" id="addressStreet" name="addressStreet" data-data="addressStreet"
                                   class="form-control" value="<?php echo $addressStreet ?>">
                        </div>
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="addressHouseNr">House Nr.</label>
                            <input type="text" id="addressHouseNr" name="addressHouseNr" data-data="addressHouseNr"
                                   class="form-control" value="<?php echo $addressHouseNr ?>">
                        </div>
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="addressPostalCode">Postal Code / Zip Code</label>
                            <input type="text" id="addressPostalCode" name="addressPostalCode"
                                   data-data="addressPostalCode" class="form-control"
                                   value="<?php echo $addressPostalCode ?>">
                        </div>
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="addressCity">City</label>
                            <input type="text" id="addressCity" name="addressCity" data-data="addressCity"
                                   class="form-control" value="<?php echo $addressCity ?>">
                        </div>
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="addressCountry">Country</label>
                            <input type="text" id="addressCountry" name="addressCountry" data-data="addressCountry"
                                   class="form-control" value="<?php echo $addressCountry ?>">
                        </div>
                    </div>
                    <div class="row col-md-12 mx-auto bg-transparent border-0" style="width: 360px;">
                        <button type="submit" id="updateUserDetailsSubmit" name="submit"
                                class="btn col-md-12 w3-bar bg-success growLink hoverStyle">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php getFooter(); ?>

</body>
</html>
