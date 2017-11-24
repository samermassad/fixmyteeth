<!DOCTYPE html>
<?php
include 'functions.php';
?>
<html>
    <head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel= "stylesheet" type="text/css" href="index_style.css" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
    <body>
        <div class="container" id="container">
<!--            <img src="web_elements/background.jpg" alt="Cougar"/>-->
            <?php
                var_dump(function_exists('mysqli_connect'));
                display_search_bar();
            ?>
        </div>
    </body>
</html>
