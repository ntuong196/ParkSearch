<!--User registration form with all inputs to be filled by the user -->
<form id="registration" class="registration_and_login" method="post" onsubmit="return validate(this)" action="registrationPage.php" >
    <h2>Registration Form:</h2>
    <?php

    //If errors were found, notify user that form did not submit
    if ($errors) {
       echo "<h3>Form did not submit correctly. Please fix errors as indicated and try again.</h3>";
    }

    //include file containing input functions (include once to prevent redefining function error)
    include_once "../fieldInputs.php";

    //Create inputs for name
    input_text($errors, 'fName', 'First Name:', "[A-Za-z]{1,40}",
        'Please only input English letters', 'required');
    input_text($errors, 'lName', 'Family Name:', "[A-Za-z]{1,40}",
        'Please only input English letters', 'required');

    //Create input for email address
    input_email($errors, 'emailAddress', 'Email:');

    //Create input for date
    input_date($errors, 'dateOfBirth', 'Date of Birth:');

    //Create input for postcode (accepts a 4 digit input)
    input_text($errors, 'postcode', 'Postcode:', '[0-9]{4,4}', 'Please input a 4-digit postcode', 'required');

    //Create Genders select box with the options "Male", "Female" and "Other"
    $genders = array('Male'=>'Male', 'Female'=>'Female', 'Other'=>'Other');
    input_select($errors, 'gender', 'Gender:', $genders, 'required');

    //Create inputs for User Password and Confirm Password (accepts an input with only letters and numbers and both upper-case and lower-case letters)
    input_password($errors, 'userPw', 'Password:', '(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}',
        'Make sure your password is at least 8 characters with a number and both lowercase and uppercase letters (no special characters)');
    input_password($errors, 'checkPw', 'Confirm Password:', '.*', 'Retype to confirm your password');

    //Input the submit button
    input_submit_account('Create Account');
    ?>

</form>