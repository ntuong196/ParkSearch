<!--User registration form with all inputs to be filled by the user -->
<form id="login" class="registration_and_login" method="post" action="login.php" >
    <h2>Login Form:</h2>
    <?php
    //If errors were found, notify user that form did not submit (did not login)
    if ($errors) {
        echo '<p>Failed to login </p>';
        echo '<p> Click <a href=\'../UserRegistration/registrationPage.php\'>here</a> to register an account.</p>';
    }

    //include file containing input functions (include once to prevent redefining function error)
    include_once "../fieldInputs.php";

    //Create input for username
    input_text($errors, 'username', 'Username/Email:', '.*', 'Please input your email address', 'required');

    //Create input for password
    input_password($errors, 'password', 'Password:', '.*', 'Please input your password');

    //Input the submit button
    input_submit_account('Login');
    ?>

</form>