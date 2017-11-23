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
    $query .= "ORDER BY RAND() LIMIT 10;";
    
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
    return $return;
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

function get_specilties() {
    $conn = db_connect();
    $result = mysqli_query($conn, "SELECT `specialty` FROM dentists; ");
    $storeArray = Array();
    while ($row = mysqli_fetch_array($result, true)) {
        if(empty(trim($row['specialty'])))   $row['specialty'] = "General Dentist";
        if(!in_array($row['specialty'], $storeArray)) $storeArray[] = $row['specialty'];
    }
    return $storeArray;
}

function display_search_bar() {
    ?>
<form method="post" action="result.php">
    <table id="source_table">
    <tr>
    <th>
    <div class="group">
      <input type="text"/><span class="highlight"></span><span class="bar"></span>
      <label>Locate Dentist (Address)</label>
    </div>
    </th>
    <th>
    <div class="group">
      <input type="text"/><span class="highlight"></span><span class="bar"></span>
      <label>Your City</label>
    </div>
    </th>
    <th>
    <div class="group">
      <input type="text"/><span class="highlight"></span><span class="bar"></span>
      <label>Specialty</label>
    </div>
    </th>
    <th>
    <div class="group">
      <input type="text"/><span class="highlight"></span><span class="bar"></span>
      <label>Doctor Name</label>
    </div>
    </th>
    </tr>
    <tr>
    <td>
    <div class="group">
     <input type="text" list="browser1"/><span class="highlight"></span><span class="bar"></span>
     <label>Day</label>
        <datalist id="browser1">
                <option value="Not to specify">
 		<option value="Monday">
  		<option value="Tuesday">
 		<option value="Wednesday">
  		<option value="Thursday">
 		<option value="Saturday">
  		<option value="Sunday">
	</datalist>
    </div>
    </td>
    <td>
    <div class="group">
     <input type="text" list="browser0"/><span class="highlight"></span><span class="bar"></span>
     <label>Time Schedule(24h format)</label>
        <datalist id="browser0">
            <option value="Not to specify">
            <option value="00:00">
            <option value="00:30">
            <option value="01:00">
            <option value="01:30">
            <option value="02:00">
            <option value="02:30">
            <option value="03:00">
            <option value="03:30">
            <option value="04:00">
            <option value="04:30">
            <option value="05:00">
            <option value="05:30">
            <option value="06:00">
            <option value="06:30">
            <option value="07:00">
            <option value="07:30">
            <option value="08:00">
            <option value="08:30">
            <option value="09:00">
            <option value="09:30">
            <option value="10:00">
            <option value="10:30">
            <option value="11:00">
            <option value="11:30">
            <option value="12:00">
            <option value="12:30">
            <option value="13:00">
            <option value="13:30">
            <option value="14:00">
            <option value="14:30">
            <option value="15:00">
            <option value="15:30">
            <option value="16:00">
            <option value="16:30">
            <option value="17:00">
            <option value="17:30">
            <option value="18:00">
            <option value="18:30">
            <option value="19:00">
            <option value="19:30">
            <option value="20:00">
            <option value="20:30">
            <option value="21:00">
            <option value="21:30">
            <option value="22:00">
            <option value="22:30">
            <option value="23:00">
            <option value="23:30">
        </datalist>
    </div>
    </td>
    <td>
    <div class="group">
     <input type="text" list="browser2"/><span class="highlight"></span><span class="bar"></span>
     <label>Gender</label>
        <datalist id="browser2">
            <option value="Not to specify">
            <option value="Female">
            <option value="Male">
	</datalist>
    </div>
    </td>
    <td>
    <div class="group">
     <input type="text" list="browser3"/><span class="highlight"></span><span class="bar"></span>
     <label>Photo?</label>
     <input type="checkbox" value="Photo?" />
    </div>
    </td>
    </tr>
    </table>
</form>
<?php
}