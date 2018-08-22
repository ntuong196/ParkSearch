<!--Displayed if the user is logged in-->
<div id = "login_successful">
    <!--Let the user know they are logged in successfully -->
    <h1>You are logged in</h1>
    <p>While logged in, you are authorised to leave a review on any park</p>
    <?php
    //import input functions
    include '../fieldInputs.php';

    //link to the logout page
    echo '<a href="logout.php">';

    //input logout button
    input_submit_account('Log Out');
    echo '</a>';
    ?>
</div>