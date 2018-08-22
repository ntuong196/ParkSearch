<form id="searchForm" class="registration_and_login" action="../resultsPage/results.php" method="get">
    <h2>Search for a park:</h2>
    <?php
    //include file containing input functions (include once to prevent redefining function error)
    include_once "../fieldInputs.php";

    input_text($errors, 'parkName', 'Name: ', '.*', 'Input a park\'s name here', '');

    //query the database for all unique suburbs
    include 'queryForSuburbs.php';
    $suburbs = array();

    //loop through results of query and put them in an array
    foreach ($stmt as $suburb) {
        $suburbs[$suburb['Suburb']] = $suburb['Suburb'];
    }

    //create select box of suburbs
    input_select($errors, 'suburb', 'Suburb:', $suburbs, '');

    //loop through 1 to 5 and add each star rating as an option
    $starRatings = array();
    for ($star = 1; $star <= 5; $star++) {
        $starRatings[$star] = "$star Stars";
    }
    //create rating select box with options as $starRatings (1-5 Stars)
    input_select($errors, 'rating', 'Star Rating:', $starRatings, '');

    //create a checkbox for searching by location
    input_checkbox($errors, 'locationSearch', 'Search for parks near you: ', 'getLocation()');

    //Input the submit button
    input_submit_account('Search');
    ?>
    <!--fields that will contain information about the latitude and longitude of the user-->
    <input type="text" id="lat_holder" name="latitude">
    <input type="text" id="long_holder" name="longitude">
</form>