<?php
session_start();
include("common.php");
if(empty($_POST["email12"]))
{
    echo "Please Enter a email";
}
else
{
    $email=mysqli_real_escape_string($con,$_POST["email12"]);
    $sql="select email from users where email='$email'";
    $result=mysqli_query($con,$sql);
    if(!$result)
    {
        echo "There was an error in searchin email in running your query".mysqli_error($con);
    }
    else if(mysqli_num_rows($result)==0)
    {
        echo "There is no such email registered with us";
    }
    else if(mysqli_num_rows($result)==1)
    {
    $curl = curl_init();
    $otp=rand(100000,999999);
    $sql1="INSERT into otp1(`otp`,`email`) VALUES('$otp','$email')";
    $result1=mysqli_query($con,$sql1);
    if(!$result1)
    {
        echo "There was an error in inserting in running the query".mysqli_error($con);
    }
    else
    {
        $template="This email is send to you by ShareMyRide,If you are not resetting your password,please ignore this.Your OTP is";
        curl_setopt_array($curl, array(
          CURLOPT_URL => "http://control.msg91.com/api/sendmailotp.php?otp="."$otp"."&template=".$template."&expiry=5&email="."$email"."&authkey=211672ApsL8C2aCn5adca7b3",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "",
          CURLOPT_SSL_VERIFYHOST => 0,
          CURLOPT_SSL_VERIFYPEER => 0,
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          echo "continue";
          $_SESSION["reset_email"]=$email;
        }
    }
 }}
?>