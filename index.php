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
        <div class="container" id="container">
            <div id="content-slider">
                <div id="slider">  <!-- Slider container -->
                    <div id="mask">  <!-- Mask -->
                        <ul>
                            <li id="first" class="firstanimation">  <!-- ID for tooltip and class for animation -->
                                <img src="web_elements/background.jpg" alt="Cougar"/>
                            </li>
                            <li id="second" class="secondanimation">
                                <img src="web_elements/background_1.jpg" alt="Lions"/>
                            </li>
                            <li id="third" class="thirdanimation">
                                <img src="web_elements/background_2.jpg" alt="Snowalker"/>
                            </li>
                            <li id="third" class="fourthanimation">
                                <img src="web_elements/background_00.jpg" alt="Msg"/>
                            </li>
                        </ul>
                    </div>  <!-- End Mask -->
                    <div class="progress-bar">
                    </div>  <!-- Progress Bar -->
                </div>  <!-- End Slider Container -->
            </div>
            <?php
                display_search_bar();
            ?>
        </div>
    </body>
</html>
