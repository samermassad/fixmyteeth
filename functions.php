<?php
function db_connect() {
    $servername = "localhost";
    $username = "server";
    $password = "fixmyteeth";

    // Create connection
    $conn = new mysqli($servername, $username, $password, "fixmyteeth");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    return $conn;
}

function search($address, $city, $specialty, $name, $day, $fromto, $photo, $gender) {
    $conn = db_connect();
    
    //create the query string
    $query = "SELECT * FROM `dentists` WHERE ";
    $query .= empty($address) ? "`address` LIKE '%' AND " : "CONCAT(`address`) LIKE  '%$address%' AND ";
    $query .= empty($city) ? "`city` LIKE '%' AND " : "CONCAT(`city`) LIKE  '%$city%' AND ";
    $query .= strcmp($specialty,"none") == 0 ? "`specialty` LIKE '%' AND " : "`specialty` = " . (strcmp($specialty,"General Doctor") == 0 ? "'\\r' AND " : "'$specialty' AND ");
    $query .= empty($name) ? "CONCAT( first_name,  ' ', last_name ) LIKE '%' AND " : "CONCAT( first_name,  ' ', last_name ) LIKE  '%$name%' AND ";
    $query .= empty($photo) ? "`image` LIKE '%' AND " : "`image` != ' ' AND ";
    $query .= empty($gender) ? "`gender` LIKE '%'" : "`gender` = '$gender'";
    $query .= ";";
    
    $results = mysqli_query($conn, $query);
    $return = array();
    foreach(mysqli_fetch_all($results) as $row) {
        $available = true;
        $row[9] = json_decode($row[9],true)[0];                                 //JSON decode the opening hours
        if(array_filter($fromto)) {
            echo "Checking availability";
            $available = check_hours($day, $fromto, $row[9]);
        }
        if($available)    $return[] = $row;
    }
    return json_encode($return);
}

function check_hours($day, $fromto, $hours) {
    // check if the dentists is available in the searched period
    // returns true if available
    // returns false if not available
    
    $from = strtotime($fromto[0]) ? strtotime($fromto[0]) : strtotime("23:59"); //check if defined or not and assign the values
    $to = strtotime($fromto[1]) ? strtotime($fromto[1]) : strtotime("00:00");
    
    if(strcmp($day,"any") == 0) {
        //returns true at first match
        foreach($hours as $value) {
            if($from >= strtotime($value['open']) && $to <= strtotime($value['close']))   return true;
        }
    } else {
        //check for a specific day
        if($from >= strtotime($hours[$day]['open']) && $to <= strtotime($hours[$day]['close']))   return true;
    }
    return false;
}