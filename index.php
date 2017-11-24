<!DOCTYPE html>
<?php
include 'functions.php';
?>
<html>
    <head>
    <link rel= "stylesheet" type="text/css" href="index_style.css" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="text/javascript">
            function MM_effectSlide(targetElement, duration, from, to, toggle) {
                Spry.Effect.DoSlide(targetElement, {duration: duration, from: from, to: to, toggle: toggle});
            }
    </script>
    <style>
            .container {
                position: relative
            }

            .tables {
                position: absolute;
                left: 100px;
                top: 0px
            }
    </style>
    </head>
    <body>
        <div class="circle"></div>
        <div class="circle2"></div>
        <div class="welcome"><p>Better</p></div>
        <div class="welcome1"><p>4 Search</p></div>
        <div class="welcome2"><p>4 Environment</p></div>
        <div class="arrow-down"></div>
        <div class="teeth"><img src="web_elements/teeth.png" width="100px" height="100px"/></img></div>

        <div class="container" id="container">
            <?php
                display_search_bar();
            ?>
        </div>
    </body>
</html>
