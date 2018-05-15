<?php
session_start();
include("common.php");
global $errors;
$missingPassword = '<p><strong>Please enter a Password!</strong></p>';
$invalidPassword = '<p><strong>Your password should be at least 6 characters long and inlcude one capital letter ,one lowercase letter and one number or one special characters!</strong></p>';
$differentPassword = '<p><strong>Passwords don\'t match!</strong></p>';
$missingPassword2 = '<p><strong>Please confirm your password</strong></p>';
if(empty($_POST["pwd"])){
    $errors .= $missingPassword;
}elseif(!(strlen($_POST["pwd"])>6
         and preg_match('/[A-Z]/',$_POST["pwd"])
         and preg_match('/[0-9]/',$_POST["pwd"])
        )
       ){
    $errors .= $invalidPassword;
}else{
    $password = filter_var($_POST["pwd"], FILTER_SANITIZE_STRING);
    if(empty($_POST["cpwd"])){
        $errors .= $missingPassword2;
    }else{
        $password2 = filter_var($_POST["cpwd"], FILTER_SANITIZE_STRING);
        if($password !== $password2){
            $errors .= $differentPassword;
        }
    }
}
if($errors)
{
    echo $errors;
}
else
{
    $password=mysqli_real_escape_string($con,$_POST["pwd"]);
    $password = hash('sha256', $password);
    $email=$_SESSION["reset_email"];
    $sql="UPDATE users set password='$password' where email='$email'";
    $result=mysqli_query($con,$sql);
    if(!$result)
    {
        echo "There was an error in running query".mysqli_error($con);
    }
    else
    {
        echo "continue";
    }
}
?>