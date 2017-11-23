<?php
if(isset($_GET['id'])) {
    include 'functions.php';
    $id = $_GET['id'];
    $conn = db_connect();
    
    $query = "SELECT * FROM `dentists` WHERE `id` = $id;";
    $result = mysqli_query($conn, $query);
    $return = array();
    $data = mysqli_fetch_row($result);
    ?>
<html>
    <head>
        <title><?php echo $data[1] . " " . $data[2]; ?> - Fix My Teeth</title>
        
    </head>
    <body>
        <h2><?php echo $data[1] . " " . $data[2]; ?></h2>
        <div id="card">
            
        </div>
    </body>
</html>
<?php
}

