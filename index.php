<!DOCTYPE html>
<?php
include 'functions.php';
?>
<html>
    <head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel= "stylesheet" type="text/css" href="index_style.css" />
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous" ></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
            .container {
                position: relative
            }

            .tables {
                position: absolute;
                top: 0px;
                height: 100%;
            }
    </style>
    </head>
    <body>
        <div class="image">
            <div class="circle"></div>
            <div class="circle2"></div>
            <div class="welcome"><p>Better</p></div>
            <div class="welcome1"><p>4 Search</p></div>
            <div class="welcome2"><p>4 Environment</p></div>
    <!--        <div class="arrow-down"></div>-->
            <div class="teeth"><img onclick="submit_form();" src="web_elements/teeth.png" width="100px" height="100px"/></img></div>
        </div>
        <div class="container" id="container">
            <?php
                display_search_bar();
            ?>
        </div>
        <a href="user.php" style="position: absolute; top:5%; right:1%;">Check your contacted dentists</a>
    </body>
    <script>
        function submit_form() {
            $('#search_form').submit();
        }
    </script>
</html>
