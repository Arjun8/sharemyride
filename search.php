<?php
session_start();
include('common.php');
if(isset($_SESSION['user_id'])){
    $h=$_SESSION['user_id'];
}
$missingdeparture = '<p><strong>Please enter your departure!</strong></p>';
$invaliddeparture = '<p><strong>Please enter a valid departure!</strong></p>';
$missingdestination = '<p><strong>Please enter your destination!</strong></p>';
$invaliddestination = '<p><strong>Please enter a valid destination!</strong></p>';
global $errors;
$departure = $_POST["find_from"];
$destination = $_POST["to"];

if(!isset($_POST["find_from_lat"]) or !isset($_POST["find_from_lang"])){
    $errors .= $invaliddeparture;
}else{
    $find_from_lat = $_POST["find_from_lat"];
    $find_from_lang = $_POST["find_from_lang"];
}

if(!isset($_POST["find_to_lat"]) or !isset($_POST["find_to_lang"])){
    $errors .= $invaliddestination;
}else{
    $find_to_lat = $_POST["find_to_lat"];
    $find_to_lang = $_POST["find_to_lang"];
}

//set search radius
$searchRadius = 2;

//min max Departure Longitude
$deltaLongitudeDeparture = $searchRadius*360/(24901*cos(deg2rad(floatval($find_from_lat))));
$minLongitudeDeparture = $find_from_lang - $deltaLongitudeDeparture;
if($minLongitudeDeparture < -180){
    $minLongitudeDeparture += 360;
}
$maxLongitudeDeparture = $find_from_lang + $deltaLongitudeDeparture;
if($maxLongitudeDeparture > 180){
    $maxLongitudeDeparture -= 360;
}

//min max Destination Longitude
$deltaLongitudeDestination = $searchRadius*360/(24901*cos(deg2rad(floatval($find_to_lat))));
$minLongitudeDestination = $find_to_lang - $deltaLongitudeDestination;
if($minLongitudeDestination < -180){
    $minLongitudeDestination += 360;
}
$maxLongitudeDestination = $find_to_lang + $deltaLongitudeDestination;
if($maxLongitudeDestination > 180){
    $maxLongitudeDestination -= 360;
}

//min max Departure Latitude
$deltaLatitudeDeparture = $searchRadius*180/12430;
$minLatitudeDeparture = $find_from_lat - $deltaLatitudeDeparture;
if($minLatitudeDeparture < -90){
    $minLatitudeDeparture = -90;
}
$maxLatitudeDeparture = $find_from_lat + $deltaLatitudeDeparture;
if($maxLatitudeDeparture > 90){
    $maxLatitudeDeparture = 90;
}

//min max Destination Latitude
$deltaLatitudeDestination = $searchRadius*180/12430;
$minLatitudeDestination = $find_to_lat - $deltaLatitudeDestination;
if($minLatitudeDestination < -90){
    $minLatitudeDestination = -90;
}
$maxLatitudeDestination = $find_to_lat + $deltaLatitudeDestination;
if($maxLatitudeDestination > 90){
    $maxLatitudeDestination = 90;
}

//Check departure:
if(!$departure){
    $errors .= $missingdeparture;
}else{
    $departure = filter_var($departure, FILTER_SANITIZE_STRING);
}

//Check destination:
if(!$destination){
    $errors .= $missingdestination;
}else{
    $destination = filter_var($destination, FILTER_SANITIZE_STRING);
}

//if there is an error print error message
if($errors){
    $resultMessage = $errors;
    echo $resultMessage; exit;
}

//get all available trips in the carsharetrips table
$myArray = [$minLongitudeDeparture < $maxLongitudeDeparture, $minLatitudeDeparture < $maxLatitudeDeparture, $minLongitudeDestination < $maxLongitudeDestination, $minLatitudeDestination < $maxLatitudeDestination];

$queryChoice1 = [
    " (from_lang BETWEEN $minLongitudeDeparture AND $maxLongitudeDeparture)",
    " AND (from_lat BETWEEN $minLatitudeDeparture AND $maxLatitudeDeparture)",
    " AND (to_lang BETWEEN $minLongitudeDestination AND $maxLongitudeDestination)",
    " AND (to_lat BETWEEN $minLatitudeDestination AND $maxLatitudeDestination)"
];

$queryChoice2 = [
    " ((from_lang > $minLongitudeDeparture) OR (from_lang < $maxLongitudeDeparture))",
    " AND (from_lat BETWEEN $minLatitudeDeparture AND $maxLatitudeDeparture)",
    " AND ((to_lang > $minLongitudeDestination) OR (to_lang < $maxLongitudeDestination))",
    " AND (to_lat BETWEEN $minLatitudeDestination AND $maxLatitudeDestination)"
];

$queryChoices = [$queryChoice2, $queryChoice1];

$sql = "SELECT * FROM off_ride WHERE ";
for ($value=0; $value<4; $value++) {
    $index = $myArray[$value];
    $sql .= $queryChoices[$index][$value];
}
$sql=$sql." and  user_id!=$h order by j_date desc";
$result = mysqli_query($con, $sql);
if(!$result){
    echo "ERROR: Unable to excecute: $sql. " . mysqli_error($con); exit;
}

if(mysqli_num_rows($result) == 0){
    echo '<div class="mdl-card mdl-shadow--2dp" style="margin-left:35px;margin-top:25px;width:65%"><h3 class="mdl-text mdl-color-text--primary">There are no journeys matching your search!<h3></div>'; exit;
}
echo '<div class="mdl-card mdl-shadow--2dp" style="margin-left:35px;margin-top:25px;width:65%"><div class="mdl-card__title mdl-color--primary mdl-color-text--white"><h2 class="mdl-card__title-text">Available Closest Journeys</h2></div><div class="mdl-card__supporting-text">';
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    //check if the trip date is in the past
    $dateOK = 1;
    $source=$row['j_date'];
    $d=DateTime::createFromFormat("Y-m-d",$source);
    $trip=$_POST["find_date"];
    $trip=str_replace("/","-",$trip);
    $trip_Date=DateTime::createFromFormat("d-m-Y",$trip);
    $dateOK=date_diff($trip_Date,$d)->format('%R%a days');
    //echo gettype($trip_Date)."".gettype($d);
    //echo "I am here";
    $dateOK=intval($dateOK);
 // echo ($dateOK);
   if($trip_Date>=$d){
        //print trip
        //get trip user id
        $person_id = $row['user_id'];
        //run query to get user details
        $sql2="SELECT * FROM users WHERE id='$person_id' and id!='$h'LIMIT 1";
        $result2 = mysqli_query($con, $sql2);
        if($result2){
            //get user details
            $row2 = mysqli_fetch_array($result2);
            //Get phone number:
            if(isset($_SESSION['user_id'])){
             $phonenumber = $row2['phonenumber'];
            }else{
             $phonenumber = "Please sign up! Only members have access to contact information.";
            }
            //get picture
            $picture = $row2['profilepicture'];
            //get firstname
            $firstname = $row2['first_name'];
            //get gender
           // $gender = $row2['gender'];
            $time=$row["j_time"];
            $tripDeparture = $row['from_address'];
            $tripDestination = $row['to_address'];
            $seats=$row["seats"];
            //get trip price
         //   $tripPrice = $row['price'];

            //get seats available in the trip
              echo
            '<div style="display:flex;margin-top:10px;"><div class="mdl-card mdl-shadow--2dp" style="width:150px;height:120px;">
            <img src="'.$picture.'" style="width:120px;height:120px;margin:0 auto;margin-top:25px;"></div><div class="mdl-card mdl-shadow--2dp" style="margin-left:10px;width:80%;"><h6 class="mdl-text mdl-color-text--primary"style="margin-left:10px;margin-top:-1px;">'.$firstname."</br>".$tripDeparture."</br>".
                        $tripDestination."</br>".$source."</br>".
                        $time."</br>".
                        $seats." left "."</br>".$phonenumber."</h6></div></div>";
                        }
    }
    else
    {
        echo "<h2>There are no journeys published for this date</h2>";
    }
}
echo "</div></div>";



















