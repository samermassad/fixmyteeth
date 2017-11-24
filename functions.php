<?php
function db_connect() {
    
    echo "connecting";
    $servername = "localhost";
    $username = "server";
    $password = "fixmyteeth";
    
    try {
         $conn = new mysqli($servername, $username, $password, 'fixmyteeth') ;
    } catch (Exception $e ) {
         echo "Service unavailable";
         echo "message: " . $e->message;   // not in live code obviously...
         exit;
    }
    echo "connection";
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
    $query .= empty(trim($specialty)) ? "`specialty` LIKE '%' AND " : "`specialty` LIKE " . (strcmp($specialty,"General Dentist") == 0 ? "'\\r' AND " : "'%$specialty%' AND ");
    $query .= empty($name) ? "CONCAT( first_name,  ' ', last_name ) LIKE '%' AND " : "CONCAT( first_name,  ' ', last_name ) LIKE  '%$name%' AND ";
    $query .= empty($photo) ? "`image` LIKE '%' AND " : "`image` != ' ' AND ";
    $query .= empty($gender) ? "`gender` LIKE '%' " : "`gender` LIKE '%$gender%' ";
    $query .= "ORDER BY RAND() LIMIT 40;";

    $results = mysqli_query($conn, $query);
    $return = array();
    foreach(mysqli_fetch_all($results) as $row) {
        $available = true;
        $row[9] = json_decode($row[9],true)[0];                                 //JSON decoding the opening hours
        if(array_filter($fromto)) {
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

    if(strcmp($day,"Any") == 0) {
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
    echo "function";
    $conn = db_connect();
    echo "Connected <br />";
    $result = mysqli_query($conn, "SELECT `specialty` FROM dentists; ");
    echo "Queried <br />";
    $storeArray = Array();
    while ($row = mysqli_fetch_array($result, true)) {
        echo "While <br />";
        if(empty(trim($row['specialty'])))   $row['specialty'] = "General Dentist";
        if(!in_array($row['specialty'], $storeArray)) $storeArray[] = $row['specialty'];
    }
    
    return $storeArray;
}

function create_account($username,$password) {
    $conn = db_connect();
    $query = "INSERT INTO `users` ( username, password , contacted_dentists ) VALUES  ( '$username', '$password' , '[1,2]' );";
    $retval = mysqli_query( $conn, $query );
         
    if(! $retval ) {
       die('Could not enter data: ' . mysqli_error());
    } else return true;
}

function sign_in($username, $password) {
    $conn = db_connect();
    $query = "SELECT * FROM `users` WHERE `username` = '$username' AND `password` = '$password' ;";
    $retval = mysqli_query( $conn, $query );
    $val = mysqli_fetch_all($retval);
    if( empty($val) ) {
       return false;
    } else {
        if(!isset($_SESSION)) { 
            session_start();
        }
        $_SESSION['contacted_dentists'] = json_decode($val[0][3]);
        return true;
    }
}

function user_signed_in() {
    if(!isset($_SESSION)) { 
        session_start();
    }
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
        return true;
    } else {
        return false;
    }
}

function get_dentists($ids) {
    $conn = db_connect();
    $query = "select * from dentists WHERE `id` IN (".implode(",",$ids).")";
    $retval = mysqli_query( $conn, $query );
    $val = mysqli_fetch_all($retval);
    if( empty($val) ) {
       return false;
    } else {
        return $val;
    }
}

function get_hours_script() {
    ?>
<script>
    function display_hours($row) {
        $($row).next().animate({
            height: $($row).next().get(0).scrollHeight
        }, 250, function(){
            $(this).height('auto');
        });
        $($row).attr('onclick','hide_hours(this)');
        $($row).html('Hide Hours');
    }
    function hide_hours($row) {
        $($row).next().animate({height:'0'});
        $($row).attr('onclick','display_hours(this)');
        $($row).html('Display Hours');
    }
</script>
<?php
}

function display_search_bar() {
    $specialties = get_specilties();
    ?>
<div class="tables" id="tables">
        <form action="results.php" method="post">
            <table id="higher" align="">
                <tr>
                    <div class="group">
                        <input name="address" type="text"/><span class="highlight"></span><span class="bar"></span>
                        <label>Dentist Address</label>
                    </div>
                </tr>

                <tr>
                    <div class="group">
                        <input name="city" type="text"/><span class="highlight"></span><span class="bar"></span>
                        <label>Your City</label>
                    </div>
                </tr>
                <tr>
                    <div class="group">
                         <input name="specialty" type="text"/><span class="highlight"></span><span class="bar"></span>
                         <label>Speciality</label>
                         <datalist id="browser5">
                             <?php
                             $specialties = get_specilties();
                             foreach($specialties as $specialty) {
                                 echo "<option value='$specialty'>";
                             }
                             ?>
                         </datalist>
                    </div>
                </tr>
            <tr>
                <div class="group">
                    <input name="name" type="text"/><span class="highlight"></span><span class="bar"></span>
                    <label>Doctor Name</label>
                </div>
            </tr>
            <tr>
                <div class="group">
                    <input name="day" type="text" list="browser1"/><span class="highlight"></span><span
                        class="bar"></span>
                    <label>Weekdays</label>
                    <datalist id="browser1">
                        <option value="Monday">
                        <option value="Tuesday">
                        <option value="Wednesday">
                        <option value="Thursday">
                        <option value="Saturday">
                        <option value="Sunday">
                        <option value="Not to specify">
                    </datalist>
                </div>
            </tr>

            <tr>
                <div class="group">
                   <input name="from" type="text" list="browser0" width=100px/><span class="highlight"></span><span
                       class="bar"></span>
                   <label>Time from</label>
                   <datalist id="browser0">
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
                       <option value="Not to specify">
                   </datalist>
               </div>
            </tr>
             <tr>
                 <div class="group">
                     <input name="to" type="text" list="browser0" width=100px/><span class="highlight"></span><span
                         class="bar"></span>
                     <label>Time to</label>
                     <datalist id="browser0">
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
                         <option value="Not to specify">
                     </datalist>
                 </div>
             </tr>
             <tr>
                 <div class="group">
                     <input name="gender" type="text" list="browser2"/><span class="highlight"></span><span
                         class="bar"></span>
                     <label>Gender</label>
                     <datalist id="browser2">
                         <option value="Male">
                         <option value="Female">
                         <option value="Not to specify">
                     </datalist>
                 </div>
             </tr>
             <tr>
                 <div class="group">
                     <input name="photo" type="text" list="browser3"/><span class="highlight"></span><span
                         class="bar"></span>
                     <label>Photo(Yes/No?)</label>
                     <datalist id="browser3">
                         <option value="Yes">
                         <option value="No">
                         <option value="Not to specify">
                     </datalist>
                 </div>
             </tr>
         </table>
         <div class="teeth">
             <input name="submit" type="submit" style="font-size:0.01em; height:100px;width:100px;border: none;">
             </input>
         </div>
    </form>
  </div>
<?php
}