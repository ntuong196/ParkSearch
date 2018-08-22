<!--The form to be displayed if the user is logged in, allows user to submit a review -->
<?php
    echo '<form id="user_review" method="post" action="itemsPage.php?id='.$_GET['id'].'">';
    echo '<h3>Write a Review</h3>';
    //include functions to input form elements
    include '../fieldInputs.php';

    input_review_box ($errors, 'reviewText');
    echo '<div class="char_limit">Max characters: 250</div> <br>';

    //loop through 1 to 5 and add each star rating as an option
    $starRatings = array();
    for ($star = 1; $star <= 5; $star++) {
        $starRatings[$star] = "$star Stars";
    }

    //set span to format the star_rating to the left
    echo '<div class = \'star_rating\'>';
    //create rating select box with options as $starRatings (1-5 Stars) and make it a required field
    input_review_select($errors, 'rating', 'Star Rating:', $starRatings, 'required');
    echo '</div> <br>';

    input_submit_account('Submit Review');

    echo '</form>';
?>
