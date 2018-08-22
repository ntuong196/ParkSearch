<?php
    //Functions used to validate the user's account on the server side

    //Checks to see if a email address is of a valid format
    //&errors - points to the array containing all the errors produced by the form
    //$field_list - the field list the field name belongs to e.g. ($_POST)
    //$field_name - the name of the field being validated
    function validate_email(&$errors, $field_list, $field_name) {
        //regex of email address
        $pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/';
        //check if regex matches the input email address
        if (!preg_match($pattern, $field_list[$field_name])) {
            //add an error under the index of the email field if the input doesn't match the regex
            $errors[$field_name] = 'Please input a valid email address e.g. "Example@email.com"';
        }
        //check if the email field is filled in
        validate_required_field($errors, $field_list, $field_name);

        //Check if the email address is already registered
        //setup PDO
        include '../databaseConnection.php';

        //Query the database for users with the same email
        try
        {
            //Query
            $result = $pdo->prepare('SELECT Email '
                .'FROM members '
                .'WHERE Email = :emailAddress');

            //bind email address to query
            $result->bindValue(':emailAddress', $field_list[$field_name]);

            //execute query
            $result->execute();
        }
        catch (PDOException $e)
        {
            echo $e->getMessage();
        }

        //Check if there exists a row matching the email address in the database
        if ($result->rowCount() > 0) {
            //if there exists a row matching email, display error message
            $errors[$field_name] = 'There already exists an account with this email address';
        }
    }

    //Checks to see if a password on the registration form is of a valid format
    //&errors - points to the array containing all the errors produced by the form
    //$field_list - the field list the field name belongs to e.g. ($_POST)
    //$field_name - the name of the field being validated
    function validate_password(&$errors, $field_list, $field_name) {
        //regex password needs to match
        $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/';
        //check if input password matches the regex
        if (!preg_match($pattern, $field_list[$field_name])) {
            //add an error under the index of the password field if input doesn't match the regex
            $errors[$field_name] = 'Your password needs to be at least 8 characters, with at least one number and both uppercase and lowercase letters';
        }
        //check if the password field is filled in
        validate_required_field($errors, $field_list, $field_name);
    }

    //check to see if the password input by the user matches the confirm password input
    //&errors - points to the array containing all the errors produced by the form
    //$field_list - the field list the field name belongs to e.g. ($_POST)
    //$field_name - the name of the field being validated
    //$password - the password being checked
    //$passwordCheck - the input which $password is checked against
    function check_password_match(&$errors, $field_list, $password, $passwordCheck) {
        //check if $password matches $passwordCheck
        if ($field_list[$password] != $field_list[$passwordCheck]) {
            //if they don't match add an error to the index of $passwordCheck
            $errors[$passwordCheck] = 'Passwords don\'t match. Retype your password and try again.';
        }
    }

    //Checks to see if a postcode of a valid format
    //&errors - points to the array containing all the errors produced by the form
    //$field_list - the field list the field name belongs to e.g. ($_POST)
    //$field_name - the name of the field being validated
    function validate_postcode(&$errors, $field_list, $field_name) {
        //regex for a 4-digit postcode
        $pattern = '/^[0-9]{4}$/';
        //Check if input by user matches regex
        if (!preg_match($pattern, $field_list[$field_name])) {
            //if postcode does not match the regex, add an error to the index $field_name
            $errors[$field_name] = 'Please enter a 4-digit postcode';
        }
        //check if the postcode field is filled in
        validate_required_field($errors, $field_list, $field_name);
    }

    //Checks to see if a email address is of a valid format
    //&errors - points to the array containing all the errors produced by the form
    //$field_list - the field list the field name belongs to e.g. ($_POST)
    //$field_name - the name of the field being validated
    function validate_gender (&$errors, $field_list, $field_name) {
        //check if gender input is of a valid option
        if (!($field_list[$field_name] == "Male" || $field_list[$field_name] == "Female" || $field_list[$field_name] == "Other")) {
            //if not a valid gender option, create error under the index $field_name
            $errors[$field_name] = 'Please select a gender from the list';
        }
    }

    //Checks to see if a email address is of a valid format
    //&errors - points to the array containing all the errors produced by the form
    //$field_list - the field list the field name belongs to e.g. ($_POST)
    //$field_name - the name of the field being validated
    function validate_date (&$errors, $field_list, $field_name) {
        //regex for date
        $pattern = '/(\d+)(-|\/)(\d+)(?:-|\/)(?:(\d+)\s+(\d+):(\d+)(?::(\d+))?(?:\.(\d+))?)?/';
        //today's date
        $today = date("Y-m-d");
        //check if input date matches the regex and is prior to the current date and after the year 1900
        if (!preg_match($pattern, $field_list[$field_name]) || !($field_list[$field_name] <= $today)
            || !($field_list[$field_name] >= '1900-12-12')) {

            //if input does not match regex or is after current date or before the year 1900,
            // create error under the index $field_name
            $errors[$field_name] = 'Please input a valid date of birth';
        }
        //check if the date field is filled in
        validate_required_field($errors, $field_list, $field_name);
    }

    function validate_name(&$errors, $field_list, $field_name) {
        //regex for a name starting with a capital letter followed by english letters.
        // Allows an ' in the second position
        $pattern = '/[A-Za-z]{1,40}/';
        if (!preg_match($pattern, $field_list[$field_name])) {
            $errors[$field_name] = 'Please only use English characters';
        }
        //check if the name is filled in
        validate_required_field($errors, $field_list, $field_name);
    }


    //Checks to see if a field has been filled in
    //&errors - points to the array containing all the errors produced by the form
    //$field_list - the field list the field name belongs to e.g. ($_POST)
    //$field_name - the name of the field being validated
    function validate_required_field(&$errors, $field_list, $field_name) {
        //check if $field_name is empty
        if (!isset($field_list[$field_name])|| empty($field_list[$field_name])) {
            //if the field is empty, create an error under the index of $field_name
            $errors[$field_name] = 'Please fill in this field';
        }
    }
?>