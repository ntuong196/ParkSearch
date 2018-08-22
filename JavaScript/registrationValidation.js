//Validates all of the inputs under the user registration form
function validate(form) {
    //Run each of the validation functions and return value under a variable
    validFirstName = check_first_name(form);
    validLastName = check_last_name(form);
    validEmail = check_email(form);
    validDOB = check_date(form);
    validPostcode = check_postcode(form);
    validGender = check_gender(form);
    validPassword = check_password(form);
    passwordMatch = check_password_match(form);

    //if any of the validation functions returned false, return false. Otherwise return true.
    if (!(  validFirstName
            && validLastName
            && validEmail
            && validDOB
            && validPostcode
            && validGender
            && validPassword
            && passwordMatch)) {
        return false;
    }
    return true;
}

//Checks that the first name field is filled in
function check_first_name(form) {
    var firstName = form.fName.value;
    if (firstName == "") {
        //return error message if not field is not filled in
        document.getElementById("fName").innerHTML = "Please enter your first name <br>";
        //return false if not filled in
        return false;
    }
    return true;
}

//Checks that the last name field is filled in
function check_last_name(form) {
    var lastName = form.lName.value;
    if (lastName == "") {
        //return error message if not field is not filled in
        document.getElementById("lName").innerHTML = "Please enter your family name <br>";
        //return false if not filled in
        return false;
    }
    return true;
}

//Checks that the email address is of a valid format
function check_email(form) {
    var email = form.emailAddress.value;
    var regex = /^([a-zA-Z0-9_\.\-])+\@([a-zA-Z0-9\-])+\.+([a-zA-Z0-9])+/;
    if (!regex.test(email)) {
        //if not valid format create error message
        document.getElementById("emailAddress").innerHTML = "Please enter a valid email address<br>";
        //if not valid format, return false
        return false;
    }
    return true;
}

//Checks that the input date is prior to cthe current date
function check_date(form) {
    var date = new Date(form.dateOfBirth.value);
    var today = new Date();

    if (!(date <= today)) {
        //if not prior to current date create error message
        document.getElementById("dateOfBirth").innerHTML = "Please enter a valid date of birth <br>";
        //if not prior to the current date, return false
        return false;
    }
    return true;
}

//Checks that the postcode is 4 digits
function check_postcode(form) {
    var postcode = form.postcode.value;
    var regex = /^[0-9]{4}$/;
    if (!regex.test(postcode)) {
        //if not 4 digits, create error message
        document.getElementById("postcode").innerHTML = "Please input a 4-digit postcode <br>";
        //if not 4 digits, return false
        return false;
    }
    return true;
}

//checks that the gender select box is of a valid option
function check_gender(form) {
    var gender = form.gender.value;
    if (gender == "") {
        //if no option has been selected, create an error message
        document.getElementById("gender").innerHTML = "Please select a valid option from the list <br>";
        //if no option has been selected, return false
        return false;
    }
    return true;
}

//Checks password matches correct format
function check_password(form) {
    var password = form.userPw.value;
    var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
    if (!regex.test(password)) {
        //if password does not match correct format, create error message
        document.getElementById("userPw").innerHTML = "Your password needs to be 8+ characters, with at least one number and both uppercase and lowercase letters <br>";
        //if password does not match correct format, return false
        return false;
    }
    return true;
}

//check password field matches the confirm password field
function check_password_match(form) {
    var passwordUser = form.userPw.value;
    var passwordCheck = form.checkPw.value;
    if (passwordUser != passwordCheck) {
        //if the password fields don't match, create error message
        document.getElementById("checkPw").innerHTML = "Passwords don't match, please try again <br>";
        //if the password fields don't match, return false
        return false;
    }
    return true;
}

//Removes the error message of a field (called when the input of a field is changed)
function hide_error_message(element){
    document.getElementById(element).innerHTML = "";
}