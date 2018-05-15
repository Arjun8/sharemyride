<?php
session_start();
include("common.php");

  $email=$_SESSION["reset_email"];
  $email=mysqli_real_escape_string($con,$email);
  $sql="select * from otp1 where email='$email'";
$result=mysqli_query($con,$sql);
$c=0;
  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
  {
    if($row["otp"]==$_POST["otp"])
    {
      $c++;
    }
  }
  if($c==1)
  {
    echo "continue";
  }
  else if($c==0)
    {
      echo"dcontinue";
    }

?>