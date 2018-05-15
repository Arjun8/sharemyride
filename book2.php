<?php
session_start();
include('common.php');
global $errors;
if(empty($_POST["seats"]))
{
    $errors.="<h6>Please Enter number of seats</h6>";
}
else if($_POST["seats"]>$_POST["old_seats"])
{
    $errors.="<h6>Please Enter  number of seats less than or equal to available seats </h6>";
}
else
{
    $seats=$_POST["seats"];
}
if(empty($_POST["id"]))
{
$errors.="<h6>Please Enter number of seats</h6>";
}
else
{
$id=$_POST["id"];
}
if(empty($_POST["price"]))
{
    $errors.="<h6>Please Enter number of seats</h6>";
}
else
{
    $price=$_POST["price"];
}
if($errors)
{
    echo $errors;
}
else
{
    $seats=mysqli_real_escape_string($con,$_POST["seats"]);
    $price=mysqli_real_escape_string($con,$_POST["t_cost"]);
    $ride_id=mysqli_real_escape_string($con,$_POST["id"]);
    $user_id=$_SESSION["user_id"];
    $sql="INSERT into book_ride(`seats`,`price`,`ride_id`,`user_id`) VALUES('$seats','$price','$ride_id',$user_id)";
    $old_seats=mysqli_real_escape_string($con,$_POST["old_seats"]);
    $new_seats=$old_seats-$seats;
    $sql1="UPDATE off_ride set seats=".$new_seats." where id=".$ride_id."";
    $result2=mysqli_query($con,$sql1);
    $result=mysqli_query($con,$sql);
    if(!$result2)
    {
        echo"There was an error in running query".mysqli_error($con);
    }
    if(!$result)
    {
        echo"There was an error in running your  ist query".mysqli_error($con);
    }
    else
    {
        echo"Redirect";
    }
}
?>