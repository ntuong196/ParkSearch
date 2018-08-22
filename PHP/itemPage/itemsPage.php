<!DOCType HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Park information">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Park Info</title>
        <link href="../../CSS/MyStyles.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="../../JavaScript/registrationValidation.js"></script>

    </head>

    <?php
    //start a session to allow the use of session variables
    session_start();

    //an array that will include any errors that may occur while posting the form
    $errors = array();

    //check if a review is being posted
    if (isset($_POST['rating'])) {
        //include the functions required to validate the user input on the review
        require "validateReview.php";

        //check that the rating given for the review is valid
        if(validate_rating($errors, $_POST, 'rating')) {

            include 'postReviewQuery.php';

            //refresh the page with the new review posted
            header("Refresh:0");
        }
    }
    ?>


    <body>
        <div id="header">
            <h1>Park Information</h1>

            <?php
            include "../menu.php";
            ?>
        </div>
        <div id="wrapper">
            <div id="left_wrapper">
                <div id="mapIndividual">
                    <!--the map containing the location of the park -->
                </div>

                <!--microdata type as place (metadata to be shown on web browser)-->
                <div id="info" itemscope itemtype="http://schema.org/Place">
                    <h2>About</h2>
                    <div id="details">
                        <?php
                        //check if an id is written in the url
                        if (isset($_GET['id'])) {
                            //Query the database for item info
                            include 'itemInfoQuery.php';

                            //check if item exists in the database, if not redirect to pageNotFound.php page
                            if (!$result->rowCount() > 0) {
                                header("Location: pageNotFound.php");
                                exit();
                            }

                            //loop through the results of PDO
                            foreach ($result as $item) {

                                //the microdata to be displayed on search pages but put in meta tags to hide from the main page
                                echo '<meta itemprop="name" content="'.$item['Name'].'">';
                                //geo coordinates of the item
                                echo '<div itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates">';
                                echo '<meta itemprop="latitude" content="'.$item['Latitude'].'">';
                                echo '<meta itemprop="longitude" content="'.$item['Longitude'].'" />';
                                echo '</div>';

                                //div with class .space is used to format the spacing of the information
                                //write the name of the park
                                echo '<p>Name: ' . $item['Name'] . '</p>';
                                //write the suburb of the park
                                echo '<p>Suburb:  ' . $item['Suburb'] . '</p>';

                                //include the function to find the average rating of the parkID
                                include_once "averageRatingQuery.php";
                                //write the average star rating of the park if it exists, if not write "Not Rated"
                                echo "<p> Rating:  <strong>" . average_rating() . "</strong></p>";
                            }
                        } else {
                            //if not searching for a valid page, navigate the user to say the item wasn't found
                            header("Location: pageNotFound.php");
                            exit();
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div id="right_wrapper">
                <h2>User Reviews</h2>
                <div id="reviews">

                    <?php
                    //query the database for all reviews on the item
                    include 'itemReviewsQuery.php';

                    //check if there is a review written for the park
                    if ($result->rowCount() > 0) {

                        //loop through the reviews written for the park in the database and record the name of the poster,
                        // the date of the post, the rating and the written text of the review
                        foreach ($result as $review) {
                            //microdata for type review to be displayed on search engines
                            echo '<div class="review" itemscope itemtype="http://schema.org/Review">';

                            //meta data containing details of the review
                            echo '<meta itemprop="itemReviewed" content="'.$review['Name'].'">';
                            echo '<meta itemprop="reviewBody" content="'.$review['ReviewText'].'">';
                            echo '<meta itemprop="author" content="'.$review['FirstName'].' '.$review['LastName'].'">';

                            //metadata of the review's rating
                            echo '<div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">';
                            echo '<meta itemprop="worstRating" content = "1">';
                            echo '<meta itemprop="ratingValue" content="'.$review['Rating'].'">';
                            echo '<meta itemprop="bestRating" content="5">';
                            echo '</div>';


                            echo '<h3> Name: '.$review['FirstName'].' '.$review['LastName'].'<br> Date: '.$review['PostDate'].
                                '<br><strong>Rating: '.$review['Rating'].'/5 Stars</strong></h3>';
                            echo '<p>'.$review['ReviewText'].'</p>';
                            echo '</div>';
                        }
                    } else {
                        //if no reviews are written, notify the user
                        echo '<p>No reviews have been written for this item</p>';
                    }
                    ?>
                </div>

                    <?php
                    //check if user is logged in
                    if (isset($_SESSION['loggedIn'])) {
                        include 'reviewForm.php';
                    } else {
                        include 'loginOrRegister.php';
                    }
                    ?>
            </div>
        </div>
        <?php
            include '../footer.php';

            //initialise the google map with a marker on the item
            include 'initialiseMap.php';
        ?>
    </body>
</html>