<!DOCTYPE html>
<?php
include 'functions.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form method="post">
            <input type="text" name="address">
            <input type="text" name="city">
            <input type="text" name="specialty">
            <input type="text" name="name">
            <input type="submit" name="submit">
        </form>
        <?php
            if(isset($_POST['submit'])) {
                $address = $_POST['address'];
                $city = $_POST['city'];
                $specialty = $_POST['specialty'];
                $name = $_POST['name'];
                
                $conn = db_connect();
                
                $results = search($conn, $address, $city, $specialty, $name);
                
                ?>
        <table id="results">
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
            <?php 
            foreach($results as $key => $value) {
                ?>
            <tr>
                <th><?php echo $value[1]; ?></th>
                <th><?php echo $value[2]; ?></th>
                <th><?php echo $value[3]; ?></th>
                <th><?php echo $value[4]; ?></th>
                <th><?php echo $value[5]; ?></th>
                <th><?php echo $value[6]; ?></th>
                <th><?php echo $value[7]; ?></th>
                <th><?php echo $value[8]; ?></th>
                <th><?php echo $value[9]; ?></th>
                <th><?php echo $value[10]; ?></th>
            </tr>
            <?php
            }
            ?>
        </table>
        <?php
            }
        ?>
    </body>
</html>
