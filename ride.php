<?php
session_start();
include('common.php');
$missingdestination="Please fill this destination field<br>";
$missingorigin="Please fill this origin field<br>";
$missingpickup="Please enter at least 1 pickup<br>";
$missingtime="Please fill time of the journey<br>";
$missingdate="Please fill date of journey<br>";
$same="Destination and origin can not be same<br>";
$invalidSeats="No of seats should be greater than 0 and minimum 1<br>";
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
    echo "continue";
}
?>