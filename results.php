<!DOCTYPE html>
<?php
include "functions.php";
?>
<html lang="en">
<head>
    <link rel= "stylesheet" type="text/css" href="index_style.css" />
    <link rel= "stylesheet" type="text/css" href="results_style.css" />
    <script src="handlers.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous" ></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
</head>
<body>
    <?php
        //if(isset($_POST['submit'])) {
    ?>

    <div id="results-grid">
        <?php
                $address = $_POST['address'];
                $city = $_POST['city'];
                $specialty = $_POST['specialty'];
                $name = $_POST['name'];
                $day = $_POST['day'];
                $fromto = [$_POST['from'], $_POST['to']];
                $photo = isset($_POST['photo']) ? $_POST['photo'] : "";
                $gender = $_POST['gender'];
                
                $results = search($address, $city, $specialty, $name, $day, $fromto, $photo, $gender);
        ?>
        
		<table class="results">
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
                                <th>Save</th>
			</tr>
			</thead>
			<tbody>
			<?php 
			foreach($results as $value) {
			?>
			<tr>
				<th><?php echo $value[1]; ?></th>
				<th><?php echo $value[2]; ?></th>
				<th><?php echo $value[3]; ?></th>
				<th><?php echo $value[4]; ?></th>
				<th><a target="_blank" href="https://www.google.fr/maps/search/<?php echo urlencode($value[5]); ?>"><?php echo $value[5]; ?></a></th>
				<th><?php echo $value[6]; ?></th>
				<th><?php echo $value[7]; ?></th>
				<th><img src="<?php echo $value[8]; ?>" /></th>
				<th>
					<?php if(is_null($value[9])) {
							 echo "Unknown Opening Hours";
						 } else { ?>
							<div id="show_hours" onclick="display_hours(this);">Display Hours</div>
							<div class="hours_table">               
							<table>
								
						<?php
							foreach($value[9] as $key => $value2) {
								$open = $value2['open'];
								$close = $value2['close'];
								echo "<tr><td>".ucfirst($key)." : </td><td>$open</td><td>-</td><td>$close</td></tr>";
							} ?>
							</table>
							</div>
					<?php
						 }
						 ?>   
					
				</th>
				<th><?php echo empty(trim($value[10])) ? "General Dentist" : $value[10]; ?></th>
                                <th><a href="user.php?save=<?php echo $value[0]; ?>">Save Dentist</a></th>
			</tr>
			<?php
			}
			?>
			</tbody>
		</table>
        <?php
        get_hours_script();
    //            } else {
    //                header("location:index.php");
    //            }
        ?>
    </div>
</body>
</html>
