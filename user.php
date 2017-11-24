<?php
include('functions.php');

if(!isset($_SESSION)) { 
    session_start();
}
var_dump($_POST);
var_dump($_SESSION);

if(isset($_GET['save']) && isset($_SESSION['loggedin'])) {
    $id = $_GET['save'];
    save_dentist($id);
    ?>
<a href="logout.php">Log out</a>    
        <?php   
        show_dentists();
} else {
    if(isset($_POST['signin'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if(sign_in($username, $password)) {
        ?>
        <a href="index.php">Home</a>  
        <a href="logout.php">Log out</a> 
                <?php   
                show_dentists();
            } else {
                $msg = "ERROR! Wrong username or password.";
                show_sign_in($msg);
            }
        } else if (isset($_POST['signup'])){
            //Sign Up
            $username = $_POST['username'];
            $password1 = $_POST['password1'];
            $password2 = $_POST['password2'];
            if(strcmp($password1,$password2) == 0) {
                if (create_account($username,$password1)) {
                    $msg = "Account created sucessfully! Please sign in.";
                    show_sign_in($msg);
                }
            } else {
                $msg = "ERROR! Passwords must be identical.";
                show_sign_in($msg);
            }

        } else {

            if(user_signed_in()) {
                //User has already signed in
                ?>
        <a href="index.php">Home</a>  
        <a href="logout.php">Log out</a>    
                <?php   
                show_dentists();
            } else {
                //show Sign in // Sign up page
                show_sign_in();
            }
        }
}


function show_sign_in($msg = '') {
?>
<html>
    <head>
        <title>Sign in / Sign up - Fix My Teeth</title>
    </head>
    <body>
        <?php
        if(!empty($msg)) {
        ?>
        <!-- Error DIV -->
        <div>
            <?php echo $msg; ?>
        </div>
        <!-- END of Error DIV -->
        <?php } ?>
        <!-- Sign Up DIV -->
        <div>
            <h2>Already have an account? Sign in!</h2>
            <form method="POST">
                <div>
                    <span>Username: </span>
                    <input type="text" name="username" />
                </div>
                <div>
                    <span>Password: </span>
                    <input type="password" name="password" />
                </div>
                <div>
                    <input type="submit" name="signin" value="Sign in" />
                </div>
            </form>
        </div>
        <!-- END of Sign Up DIV -->
        <!-- Sign In DIV -->
        <div>
            <h2>Don't have an account? Sign up!</h2>
            <form method="POST">
                <div>
                    <span>Username: </span>
                    <input type="text" name="username" />
                </div>
                <div>
                    <span>Password: </span>
                    <input type="password" name="password1" />
                </div>
                <div>
                    <span>Repeat Password: </span>
                    <input type="password" name="password2" />
                </div>
                <div>
                    <input type="submit" name="signup" value="Sign up" />
                </div>
            </form>
        </div>
        <!-- END of Sign In DIV -->
    </body>
</html>
<?php }

function show_dentists() { ?>

<html>
    <head>
        <title>Contacted Dentists - Fix My Teeth</title>
        <link rel= "stylesheet" type="text/css" href="results_style.css" />
        <link rel= "stylesheet" type="text/css" href="index_style.css" />
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous" ></script>
    </head>
    <body>
        <!-- Contacted Dentists DIV -->
        <div>
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
            if(!isset($_SESSION['contacted_dentists'])) header('location:logout.php');
            $dentists = get_dentists($_SESSION['contacted_dentists']);
            foreach ($dentists as $dentist) { ?>
			<tr>
				<td><?php echo $dentist[1]; ?></td>
				<td><?php echo $dentist[2]; ?></td>
				<td><?php echo $dentist[3]; ?></td>
				<td><?php echo $dentist[4]; ?></td>
				<td><a target="_blank" href="https://www.google.fr/maps/search/<?php echo urlencode($dentist[5]); ?>"><?php echo $dentist[5]; ?></a></th>
				<td><?php echo $dentist[6]; ?></td>
				<td><?php echo $dentist[7]; ?></td>
				<td><img src="<?php echo $dentist[8]; ?>" /></td>
				<td>
					<?php
                                            $dentist[9] = json_decode($dentist[9],true)[0];
                                            if(is_null($dentist[9])) {
							 echo "Unknown Opening Hours";
						 } else { ?>
							<div id="show_hours" onclick="display_hours(this);">Display Hours</div>
							<div class="hours_table">               
							<table>
								
						<?php
							foreach($dentist[9] as $key => $value2) {
								$open = $value2['open'];
								$close = $value2['close'];
								echo "<tr><td>".ucfirst($key)." : </td><td>$open</td><td>-</td><td>$close</td></tr>";
							} ?>
							</table>
						 </div>
					<?php
						 }
						 ?>   
					
				</td>
				<td><?php echo empty(trim($dentist[10])) ? "General Dentist" : $dentist[10]; ?></td>
			</tr>
			<?php
			}
			?>
			</tbody>
		</table>
        </div>
        <!-- END of Contacted Dentists DIV -->
        <?php get_hours_script(); ?>
    </body>
</html>

<?php }