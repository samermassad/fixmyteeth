<!DOCTYPE html>
<?php
include 'functions.php';
?>
<html>
    <head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel= "stylesheet" type="text/css" href="index_style.css" />
    <script src="handlers.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous" ></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
    <body>
        <form method="post" action="results.php">
            <input type="text" name="address">
            <input type="text" name="city">
            <input type="text" name="specialty" value="none">
            <input type="text" name="name">
            <br />
            <input type="text" name="day" value="any">
            <input type="time" name="from">
            <input type="time" name="to">
            <input type="checkbox" value="Photo?" name="photo">
            <input type="text" name="gender">
            <input type="submit" name="submit">
        </form>
    </body>
</html>
