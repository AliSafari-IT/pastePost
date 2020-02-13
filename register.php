<?php include "include/functions.php"; ?>

<html lang="en">

<head>
    <?php getHeader(); ?>
    <title>Register User</title>
    <style>
        form {
            color: black;
            font-family: 'Loto', sans-serif;
            font-size: 15px;
        }

        em {
            font-family: 'Roboto', sans-serif;

            color: #0d0d0d;
            text-shadow: 0 0 3px #FF0000, 0 0 5px #0d0525;
        }

        .largerCheckbox {
            margin-top: -1px;
        }
    </style>
</head>

<body>

<?php getNavigation(); ?>
<?php getPostMenuBg(); ?>

<!--Main layout-->
<main class="mt-1 pt-1">
    <div class="container  my-2">
        <!--Section: Jumbotron-->
        <section class="card wow fadeIn"
                 style="background-image: url(include/img/bg/postBg.jpg);">

            <!-- Content -->
            <div class="card-body text-white text-center px-3 my-1">

                <h1 class="p-md-3 mb-2">
                    <em>Create an Account to Start Blogging</em>
                </h1>
                <form class="form needs-validation" novalidate data-request="registerUser" data-url="include/api.php"
                      data-method="POST" id="FormRegisterUser" onsubmit="scrollWin()">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="firstname">First name:</label>
                                <input id="firstname" name="firstname" data-data="firstname" type="text"
                                       placeholder="Enter first name"
                                       class="form-control">
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="lastname">Last name:</label>
                                <input id="lastname" name="lastname" data-data="lastname" type="text"
                                       placeholder="Enter last name"
                                       class="form-control">
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="email">E-mail:</label>
                                <input id="email" name="email" data-data="email" type="text" placeholder="Enter E-mail"
                                       class="form-control">
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input id="username" name="username" data-data="username" type="text"
                                       placeholder="Enter username"
                                       class="form-control">
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input id="password" name="password" data-data="password" type="password"
                                       placeholder="Enter password"
                                       class="form-control">
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="confPassword">Repeat password:</label>
                                <input id="confPassword" name="confPassword" data-data="confPassword" type="password"
                                       placeholder="Enter password again"
                                       class="form-control">
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                    </div>
                    <div class="row hr-dark">
                        <hr>
                    </div>
                    <div class="row">
                        <hr>
                        <span class="pr-2 pt-2 h5">Address</span> <i class="fas fa-2x fa-map-marked"
                                                                     style="color: #b2070e"></i>
                        <hr>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="addressStreet">Street:</label>
                                <input id="addressStreet" name="addressStreet" data-data="addressStreet" type="text"
                                       placeholder="Street"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="addressHouseNr">House Nr:</label>
                                <input id="addressHouseNr" name="addressHouseNr" data-data="addressHouseNr" type="text"
                                       placeholder="House Number"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="addressCity">City:</label>
                                <input id="addressCity" name="addressCity" data-data="addressCity" type="text"
                                       placeholder="City"
                                       class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="addressPostalCode">Postal Code:</label>
                                <input id="addressPostalCode" name="addressPostalCode" data-data="addressPostalCode"
                                       type="text"
                                       placeholder="Postal Code"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="addressCountry">Country:</label>
                                <input id="addressCountry" name="addressCountry" data-data="addressCountry" type="text"
                                       placeholder="Country"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="phoneGsmNr">Phone/GSM Nr:</label>
                                <input id="phoneGsmNr" name="phoneGsmNr" data-data="phoneGsmNr" type="text"
                                       placeholder="Phone/GSM Nr"
                                       class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group form-check col-sm-12">
                            <label for="remember form-check-label">
                                <input class="form-check-input largerCheckbox" type="checkbox" name="remember"
                                       required>
                                <span class="ml-3 h6 align-bottom" style="align-items:baseline">
                                    I agree on the terms of use.
                                </span>
                            </label>
                            <div class="invalid-feedback">
                                Check this checkbox to continue.
                            </div>
                        </div>
                        <div class="form-group text-center col-sm-12">
                            <button type="submit" class="btn btn-lg text-black shadow-lg px-5 py-3"
                                    id="submitRegistrationForm">
                                <span class="h3 font-weight-bold">
                                    Register
                                </span>
                                <i class="fas fa-2x fa-user-plus" style="color: #b2070e"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Content -->
        </section>
        <!--Section: Jumbotron-->
    </div>
</main>
<!--Main layout-->
<?php getFooter(); ?>

<script>
    function scrollWin() {
        window.scrollTo(0, 0); //scroll the document window to top of the page
    }

    // Disable form submissions if there are invalid fields
    (function () {
        'use strict';
        window.addEventListener('load', function () {
            // Get the forms we want to add validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
</body>

</html>