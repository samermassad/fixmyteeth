<?php
include('functions.php');
if(!isset($_SESSION)) { 
    session_start();
}
if(isset($_POST['signin'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if(sign_in($username, $password)) {
        $_SESSION['loggedin'] = true;
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
<a href="logout.php">Log out</a>    
        <?php   
        show_dentists();
    } else {
        //show Sign in // Sign up page
        show_sign_in();
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
                    <input type="submit" name="signup" value="Sign in" />
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
    </head>
    <body>
        <!-- Contacted Dentists DIV -->
        <div>
            <?php 
            $dentists = get_dentists($_SESSION['contacted_dentists']);
            foreach ($dentists as $dentist) {
                echo $dentist[1] . "<br />";
            }?>
        </div>
        <!-- END of Contacted Dentists DIV -->
    </body>
</html>

<?php }