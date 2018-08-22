<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Parks matching search">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Search Results</title>
        <link href="../../CSS/myStyles.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div id="header">
            <h1>Search Results</h1>
            <?php
                include '../menu.php';
            ?>
        </div>

        <?php
            include 'resultsTable.php';
        ?>
        <?php
            include '../footer.php';

            //create the map with all search results
            include 'initialiseResultsMap.php';
        ?>
    </body>
</html>