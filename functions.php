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

function search($conn, $address, $city, $specialty, $name) {
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

function json($json, $id) {
    $query = "SELECT * FROM dentists WHERE id = $id";
    $conn = db_connect();
    $results = mysqli_query($conn, $query);
    return json_decode(mysqli_fetch_row($results)[9],true);
}