<html>
    <head>
        <meta charset="utf-8">
        <title>Registration</title>
        <!--Link to CSS and Javascript files-->
        <link href="../../CSS/MyStyles.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="../../JavaScript/registrationValidation.js">
        </script>
    </head>
    <body>
        <!-- Header division containing the title of the page and the navigation menu-->
        <div id="header">
            <h1>User Registration</h1>
            <?php
            //include the code for the navigation menu
            include "../menu.php"
            ?>
        </div>

        <?php
            //an array that will include any errors that may occur while posting the form
            $errors = array();

            //check if the form is posting all fields
            if (isset($_POST['fName'])
                && isset($_POST['lName'])
                && isset($_POST['emailAddress'])
                && isset($_POST['userPw'])
                && isset($_POST['checkPw'])
                && isset($_POST['postcode'])
                && isset($_POST['dateOfBirth'])
                && isset($_POST['gender'])) {

                //require file containing validation functions
                require "validateUser.php";

                //Validate first name and last name to ensure they have a capital letter followed by lowercase english
                //characters
                validate_name($errors, $_POST, 'fName');
                validate_name($errors, $_POST, 'lName');

                //validate email address for correct formatting
                validate_email($errors, $_POST, 'emailAddress');

                //validate password for correct formatting
                validate_password($errors, $_POST, 'userPw');

                //check if 'Confirm Password' matches the password in the other password field
                check_password_match($errors, $_POST, 'userPw', 'checkPw');

                //validate postcode for correct formatting
                validate_postcode($errors, $_POST, 'postcode');

                //validate gender to ensure an appropriate option is chosen
                validate_gender($errors, $_POST, 'gender');

                //validate date input to ensure it is before the current date
                validate_date($errors, $_POST, 'dateOfBirth');

                //Check if errors occurred
                if ($errors) {
                    //include the code of the registration form if errors are found while posting
                    include 'registrationForm.php';
                } else {
                    //else include query to register the user
                    include 'userRegistrationQuery.php';
                    header("Location: ../login/login.php");
                    exit();
                }
            } else {
                //include the code of the registration form if not posting
                include 'registrationForm.php';
            }

            //include code for the footer
            include '../footer.php';
        ?>
    </body>
</html>