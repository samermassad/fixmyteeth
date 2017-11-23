<!DOCTYPE html>
<?php
include "functions.php";
?>
<html lang="en">
<head>
    <link rel= "stylesheet" type="text/css" href="index_style.css" />
    <script src="handlers.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous" ></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
</head>
<body>
    <?php
    //    if(isset($_POST['submit'])) {
        display_search_bar();
    ?>

    <div id="results-grid">
        <?php
//                $address = $_POST['address'];
//                $city = $_POST['city'];
//                $specialty = $_POST['specialty'];
//                $name = $_POST['name'];
//                $day = $_POST['day'];
//                $fromto = [$_POST['from'], $_POST['to']];
//                $photo = isset($_POST['photo']) ? $_POST['photo'] : "";
//                $gender = $_POST['gender'];
                $address = "";
                $city = "";
                $specialty = "none";
                $name = "lis";
                $day = "any";
                $fromto = ["", ""];
                $photo = isset($_POST['photo']) ? $_POST['photo'] : "";
                $gender = "";
                
                $results = search($address, $city, $specialty, $name, $day, $fromto, $photo, $gender);
                ?>
        <table id="results_table">
            <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Address</th>
                <th>City</th>
                <th>Phone</th>
                <th>Image</th>
                <th>Hours</th>
                <th>Specialty</th>
            </tr>
            </thead>
            <tbody>
            <?php 
            foreach($results as $key => $value) {
                ?>
            <tr onclick="window.location='profile?id=<?php echo $value[0]; ?>'">
                <th><?php echo $value[1]; ?></th>
                <th><?php echo $value[2]; ?></th>
                <th><?php echo $value[3]; ?></th>
                <th><?php echo $value[4]; ?></th>
                <th><?php echo $value[5]; ?></th>
                <th><?php echo $value[6]; ?></th>
                <th><?php echo $value[7]; ?></th>
                <th><img src="<?php echo $value[8]; ?>" /></th>
                <th><table id="hours_table">
                         <?php 
                            foreach($value[9] as $key => $value2) {
                             $open = $value2['open'];
                             $close = $value2['close'];
                             echo "<tr><td>".ucfirst($key)." : </td><td>$open</td><td>-</td><td>$close</td></tr>";
                         } ?>
                    </table>
                </th>
                <th><?php echo empty(trim($value[10])) ? "General Dentist" : $value[10]; ?></th>
            </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
        <?php
       ///     } else {
       //         header("location:index.php");
        //    }
        ?>
    </div>
</body>
</html>