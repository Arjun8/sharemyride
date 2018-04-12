<?php
session_start();
include('common.php');
$missingdestination="<h5 class = 'mdl-text mdl-color-text--red'>Please fill the destination field</h2>";
$missingorigin="<h5 class = 'mdl-text mdl-color-text--red'>Please fill the origin field</h2>";
$missingpickup="<h5 class = 'mdl-text mdl-color-text--red'>Please enter at least 1 pickup</h2>";
$missingtime="<h5 class = 'mdl-text mdl-color-text--red'>Please enter time of the journey</h2>";
$missingdate="<h5 class = 'mdl-text mdl-color-text--red'>Please enter date of journey</h2>";
$same="<h5 class = 'mdl-text mdl-color-text--red'>Destination and origin can not be same</h2>";
$invalidSeats="<h5 class = 'mdl-text mdl-color-text--red'>No of seats should be greater than 0 and minimum 1</h2>";
global $errors;
if(empty($_POST["off_from"])){
    $errors .= $missingdestination;
}
else
{
    $off_from=filter_var($_POST["off_from"], FILTER_SANITIZE_STRING);
}
if(empty($_POST["off_to"]))
{
    $errors.= $missingorigin;
}
else
{
    $off_to=filter_var($_POST["off_to"], FILTER_SANITIZE_STRING);
}
$pickup=filter_var($_POST["pickup"], FILTER_SANITIZE_STRING);
if(empty($_POST["seats"]))
{
    $errors .= $invalidSeats;
}
else
{
    $seats=filter_var($_POST["seats"], FILTER_SANITIZE_STRING);
}
if(empty($_POST["off_date"])||$_POST["off_date"]===" ")
{
    $errors .= $missingdate;
}
else
{
    $off_date=filter_var($_POST["off_date"], FILTER_SANITIZE_STRING);

}
if(empty($_POST["off_time"]))
{
    $errors .= $missingtime;
}
else
{
    $off_time=filter_var($_POST["off_time"], FILTER_SANITIZE_STRING);
}
if($errors)
{
echo $errors;
}
else
{
   
    $off_from=mysqli_real_escape_string($con,$_POST["off_from"]);
    $off_to=mysqli_real_escape_string($con,$_POST["off_to"]);
    $off_date=mysqli_real_escape_string($con,$_POST["off_date"]);
    $off_date=str_replace('/', '-', $off_date);
    $d=strtotime($off_date);
    $off_date=date("Y-m-d",$d);
    $off_time=mysqli_real_escape_string($con,$_POST["off_time"]);
    $seats=mysqli_real_escape_string($con,$_POST["seats"]);
    $from_lat=mysqli_real_escape_string($con,$_POST["from_lat"]);
    $from_lang=mysqli_real_escape_string($con,$_POST["from_lang"]);
    $to_lat=mysqli_real_escape_string($con,$_POST["to_lat"]);
    $to_lang=mysqli_real_escape_string($con,$_POST["to_lang"]);
    $user_id=$_SESSION["user_id"];
    $sql="INSERT  INTO off_ride(`from_address`,`from_lat`,`from_lang`,`to_address`,`to_lat`,`to_lang`,`j_date`,`j_time`,`seats`,`user_id`) VALUES ('$off_from','$from_lat','$from_lang','$off_to','$to_lat','$to_lang','$off_date','$off_time','$seats','$user_id')";
    $result=mysqli_query($con,$sql);
    if(!$result)
    {
        echo "Errors in running the query".mysqli_error($con);
    }
    else
    {
        echo 'continue';
    }
}
?>