<?php
//Checks to see if a valid star rating is selected
//&errors - points to the array containing all the errors produced by the form
//$field_list - the field list the field name belongs to e.g. ($_POST)
//$field_name - the name of the field being validated
function validate_rating (&$errors, $field_list, $field_name) {
    //check if rating input is of a valid option
    if (!($field_list[$field_name] == "1" || $field_list[$field_name] == "2" ||
        $field_list[$field_name] == "3" || $field_list[$field_name] == "4" ||
        $field_list[$field_name] == "5")) {

        //if not a valid star rating, create error for $field_name
        $errors[$field_name] = 'Review did not submit. Please select a valid rating from the list.';
        return false;
    }
    return true;
}
?>