<?php
//Function that creates the label of each input
//$name - the name of the field the label is for
//$label - the text of the label to be displayed on screen
function label($name, $label) {
    echo "<label for = \"$name\">$label</label>";
    echo '<br>';
}

//Function that returns the value sent by the $_POST method
//$name - name of the field the data is being returned for
function posted_value($name) {
    if(isset($_POST[$name])) {
        return htmlspecialchars($_POST[$name]);
    }
}

//Function that creates a span for an error message to be displayed
//$errors - an array of all errors on the form
//$name - the name of the field the error message to be displayed belongs to
function error_label($errors, $name) {
    //create span for the error message to appear (of class 'error_message')
    echo "<br> <span id=\"$name\" class=\"error_message\">";

    //Check if an error has occurred for the field
    if (isset($errors[$name])) {
        //input code of error message if error had occurred for the field
        echo $errors[$name];
    }
    echo '</span>';
}

//Function that creates a text input matching the input parameters
//$errors - an array of all errors produced by the form
//$name - name of the input being created
//$label - text to be displayed as the label of the input
//$pattern - the pattern that the input by the user needs to follow
//$title - the message to be displayed to the user if they don't match the pattern
//$required - determines if the field is required or not (set to '' if not required and 'required' if required)
function input_text($errors, $name, $label, $pattern, $title, $required) {
    //create div belonging to the class 'required_field'
    echo '<div class="required_field">';
    //create the label for the input
    label($name, $label);
    //get the value from previous post
    $value = posted_value($name);
    //create the text input with attributes matching the outlined variables (value from previous post is filled in)
    echo "<input type=\"text\" name=\"$name\" pattern=\"$pattern\"".
        " title=\"$title\" value=\"$value\" onkeypress=\"hide_error_message('$name')\" $required>";
    //create error message span
    error_label($errors, $name);
    //close the div
    echo '</div>';
}

//Function that creates an email input matching the parameters
//$errors - an array of all errors produced by the form
//$name - name of the input being created
//$label - text to be displayed as the label of the input
function input_email($errors, $name, $label) {
    //create div belonging to the class 'required_field'
    echo '<div class = "required_field">';
    //create the label for the input
    label($name, $label);
    //get the value from previous post
    $value = posted_value($name);
    //create the email input with attributes matching the outlined variables (value from previous post is filled in)
    echo "<input type=\"email\" name=\"$name\" value=\"$value\"".
        " placeholder=\"Example@email.com\" onkeypress=\"hide_error_message('$name')\" required>";
    //create error message span
    error_label($errors, $name);
    //close the div
    echo '</div>';
}

//Function that creates a date field matching the parameters and not allowing input beyond the current date
//$errors - an array of all errors produced by the form
//$name - name of the input being created
//$label - text to be displayed as the label of the input
function input_date($errors, $name, $label) {
    //create div belonging to the class 'required_field'
    echo '<div class="required_field">';
    //create the label for the input
    label($name, $label);
    //get the value from previous post
    $value = posted_value($name);
    //store today's date under $today
    $today = date("Y-m-d");
    //create date field matching the parameters and a maximum possible date of $today and minimum date in the year 1900
    echo "<input type=\"Date\" name=\"$name\" value=\"$value\" placeholder='dd/mm/yyyy'".
           " max=\"$today\" min=\"1900-12-12\" onchange=\"hide_error_message('$name')\" required>";
    //create error message span
    error_label($errors, $name);
    //close the div
    echo '</div>';
}

//Function that creates a select box following the provided parameters
//$errors - an array of all errors produced by the form
//$name - name of the select box being created
//$label - text to be displayed as the label of the select box
//$values - an array of values to be displayed as the options of the select box
function input_select($errors, $name, $label, $values, $required) {
    //create div belonging to the class 'required_field'
    echo '<div class="required_field">';
    //create the label for the input
    label($name, $label);
    //get the value from previous post
    $value = posted_value($name);
    //Create select box
    echo "<select name = \"$name\" onchange=\"hide_error_message('$name')\" $required>";
    //input a starting option with the value of ""
    echo "<option value = \"\"> Select an option below...</option>";
    //Loop through the array of $values and create a new option for each
    foreach ($values as $value => $display) {
        //set the option value from previous post
        $selected = ($value==posted_value($name))?'selected="selected"':'';
        //create new option with a value of $value and displaying text of $display
        echo "<option $selected value=\"$value\">$display</option>";
    }
    //close the select box
    echo '</select>';
    //create error message span
    error_label($errors, $name);
    //close the div
    echo '</div>';
}

//Function that creates a password field matching the input parameters
//$errors - an array of all errors produced by the form
//$name - name of the input being created
//$label - text to be displayed as the label of the input
//$pattern - the pattern that the input by the user needs to follow
//$title - the message to be displayed to the user if they don't match the pattern
function input_password($errors, $name, $label, $pattern, $title) {
    //create div belonging to the class 'required_field'
    echo '<div class="required_field">';
    //create the label for the input
    label($name, $label);
    //create the password field with attributes matching the parameters (value from previous post is filled in)
    echo "<input type=\"password\" name=\"$name\" pattern=\"$pattern\"".
        " title=\"$title\" onkeypress=\"hide_error_message('$name')\" required>";
    //create error message span
    error_label($errors, $name);
    //close the div
    echo '</div>';
}

//Function that creates a submit button with text matching the parameter
//$value - the text to be displayed on the submit button and the name of the button
function input_submit_account($value) {
    //create submit button of class 'submit_button_holder'
    echo "<div class=\"submit_button_holder\">";
    echo "<input name=\"$value\" type=\"submit\" class=\"submit_account\" value=\"$value\">";
    echo '</div>';
}

//Function that inputs a textarea where a review is to be written
//$errors - an array of all errors produced by the form
//$name - name of the input being created
function input_review_box ($errors, $name) {
    //get the value from previous post
    $value = posted_value($name);

    echo "<textarea name='$name' placeholder='Enter your review here...'>";

    //check that the previous value wasn't blank
    echo $value;

    echo '</textarea>';
    //create error message span
    error_label($errors, $name);
}

//Function that creates a checkbox matching the input parameters
//$errors - an array of all errors produced by the form
//$name - name of the input being created
//$label - text to be displayed as the label of the input
function input_checkbox($errors, $name, $label, $onclick) {
    echo '<div class="required_field">';
    //create the label for the input
    echo "<label for = \"$name\">$label</label>";
    //Create checkbox
    echo "<input type = \"checkbox\" name=\"$name\" onclick='$onclick'>";
    //create error message span
    error_label($errors, $name);
    //close the div
    echo '</div>';
}

//Function that creates a select box for the reviews form
//$errors - an array of all errors produced by the form
//$name - name of the select box being created
//$label - text to be displayed as the label of the select box
//$values - an array of values to be displayed as the options of the select box
function input_review_select($errors, $name, $label, $values, $required) {
    echo '<span class = "star_rating">';
    //create div belonging to the class 'required_field'
    echo '<div class="required_field">';
    //create the label for the input
    echo "<label for = \"$name\">$label</label>";
    //get the value from previous post
    $value = posted_value($name);
    //Create select box
    echo " <select name = \"$name\" onchange=\"hide_error_message('$name')\" $required>";
    //input a starting option with the value of ""
    echo "<option value = \"\"> Select an option below...</option>";
    //Loop through the array of $values and create a new option for each
    foreach ($values as $value => $display) {
        //set the option value from previous post
        $selected = ($value==posted_value($name))?'selected="selected"':'';
        //create new option with a value of $value and displaying text of $display
        echo "<option $selected value=\"$value\">$display</option>";
    }
    //close the select box
    echo '</select>';
    //create error message span
    error_label($errors, $name);
    //close the div
    echo '</div>';
    echo '</span>';
}
?>