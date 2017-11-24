<!DOCTYPE html>
<?php
include 'functions.php';
?>
<html>
    <head>
    <link rel= "stylesheet" type="text/css" href="index_style.css" />
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
            <div class="bubble">
                <input style="font-size:0.01em;height:25px;width:25px;border:none" type="submit" value="">
            </div>
        </div>
        <div class="container" id="container">
            <?php
                display_search_bar();
            ?>
        </div>
        <a href="user.php" style="text-decoration: none; color: white; position: absolute; top:5%; right:1%;">Check your contacted dentists</a>
    </body>
    <script>
        function submit_form() {
            document.search_form.submit();
        }
    </script>
</html>
