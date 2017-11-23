<?php

$aResult = array();
if(isset($_POST['functionName']) && !empty($_POST['functionName'])){
    switch($_POST['functionName']) {
                case 'search2':
                       $aResult['result'] = search2($_POST['arguments'][0], $_POST['arguments'][1], $_POST['arguments'][2], $_POST['arguments'][3]);
                       echo $aResult;
                   break;

                default:
                   $aResult['error'] = 'Not found function '.$_POST['functionName'].'!';
                   break;
            }
}

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

function search($conn, $address, $city, $specialty, $name, $day, $fromto, $photo, $gender) {
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
    foreach(mysqli_fetch_all($results) as $key => $row) {
        $row[9] = json_decode($row[9],true)[0];
        $available = check_hours($day, $fromto, $row[9]);
        if($available)    $return[] = $row;
    }
    return $return;
}

function check_hours($day, $fromto, $hours) {
    $from = strtotime($fromto[0]) ? strtotime($fromto[0]) : strtotime("23:59");
    $to = strtotime($fromto[1]) ? strtotime($fromto[1]) : strtotime("00:00");
    
    if(strcmp($day,"any") == 0) {
        foreach($hours as $value) {
            //echo "Comparing $from with ".$value['open']." And $to with ".$value['close']." = ".($from >= $value['open'] && $to <= $value['close'])."<br />";
            if($from >= strtotime($value['open']) && $to <= strtotime($value['close']))   return true;
        }
    } else {
        //echo "Comparing $from with ".$hours[$day]['open']." And $to with ".$hours[$day]['close'];
        if($from >= strtotime($hours[$day]['open']) && $to <= strtotime($hours[$day]['close']))   return true;
    }
    return false;
}
function search2($address, $city, $specialty, $name) {
    echo '<script language="javascript">alert("en search 2");</script>';

    $conn = db_connect();
    $query = "SELECT * FROM dentists WHERE ";
    $query .= empty($address) ? "" : "CONCAT(address) LIKE  '%$address%';";
    $query .= empty($city) ? "" : "CONCAT(city) LIKE  '%$city%';";
    $query .= empty($specialty) ? "" : "specialty = '$specialty' AND ";
    $query .= empty($name) ? "" : "CONCAT( first_name,  ' ', last_name ) LIKE  '%$name%';";
    $results = mysqli_query($conn, $query);
    $return = array();
    foreach(mysqli_fetch_all($results) as $key => $row) {
        $return[$key] = array();
        foreach($row as $field) {
            $return[$key][] = $field;
        }
    }
    return $return;
}