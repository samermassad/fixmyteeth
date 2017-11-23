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
        <div id="container">
            <div id="background"><img src="web_elements/background.jpg" /></div>
            <table>
            <tr>
            <th>
            <img src="web_elements/space_ss.jpg" />
            </th>
            <th>
            <div class="group">
              <input id="address" type="text" required/><span class="highlight"></span><span class="bar"></span>
              <label>Locate Dentist (Address)</label>
            </div>
            </th>
            <th>
            <div class="group">
              <input id="city" type="text" required/><span class="highlight"></span><span class="bar"></span>
              <label>Your City</label>
            </div>
            </th>
            <th>
            <div class="group">
              <input id="speciality" type="text" required/><span class="highlight"></span><span class="bar"></span>
              <label>Speciality</label>
            </div>
            </th>
            <th>
            <div class="group">
              <input id="name" type="text" required/><span class="highlight"></span><span class="bar"></span>
              <label>Doctor Name</label>
            </div>
            </th>
             <th>
            <div class="group">
              <input id="date" type="text" required/><span class="highlight"></span><span class="bar"></span>
              <label>Date(DD/MM/YYYY)</label>
            </div>
            </th>
            </tr>
            <tr>
                    <td>
                        <button class="submitButton" onclick="onSearchHandler()">Search</button>
                    </td>
            </tr>
            </table>
        	<img src="web_elements/footbanner.jpg" />
        	</div>

        	<div id="results">

        	</div>

    </body>
</html>
