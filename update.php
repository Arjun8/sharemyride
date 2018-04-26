<?php
session_start();
include('common.php');
$missingfirstname = '<p><strong>Please enter a First name!</strong></p>';
$missinglastname = '<p><strong>Please enter a Last name!</strong></p>';
$missingEmail = '<p><strong>Please enter your email address!</strong></p>';
$invalidEmail='<p><strong>Please enter a valid email!</strong></p>';
$missingPassword = '<p><strong>Please enter a Password!</strong></p>';
$invalidPassword = '<p><strong>Your password should be at least 6 characters long and inlcude one capital letter and one number!</strong></p>';
$differentPassword = '<p><strong>Passwords don\'t match!</strong></p>';
$missingPassword2 = '<p><strong>Please confirm your password</strong></p>';
$missingPhone = '<p><strong>Please enter your mobile number!</strong></p>';
$invalidPhoneNumber = '<p><strong>Please enter a valid mobile number (10 digits only)!</strong></p>';
global $errors;
if(empty($_POST["firstname"])){
    $errors .= $missingfirstname;
}else{
    $firstname = filter_var($_POST["firstname"], FILTER_SANITIZE_STRING);
}
if(empty($_POST["lastname"])){
    $errors .= $missinglastname;
}else{
    $lastname = filter_var($_POST["lastname"], FILTER_SANITIZE_STRING);
}
if(empty($_POST["gender"]))
{
    $errors=$errors."<p><strong>Please select your gender</strong></p>";
}
/*if(empty($_POST["email"])){
    $errors .= $missingEmail;
}else{
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors .= $invalidEmail;
    }
}
if(empty($_POST["password"])){
    $errors .= $missingPassword;
}elseif(!(strlen($_POST["password"])>6
         and preg_match('/[A-Z]/',$_POST["password"])
         and preg_match('/[0-9]/',$_POST["password"])
        )
       ){
    $errors .= $invalidPassword;
}else{
    $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
    if(empty($_POST["password2"])){
        $errors .= $missingPassword2;
    }else{
        $password2 = filter_var($_POST["password2"], FILTER_SANITIZE_STRING);
        if($password !== $password2){
            $errors .= $differentPassword;
        }
    }
}
if(empty($_POST["phonenumber"])){
    $errors .= $missingPhone;
}elseif(preg_match('/\D/',$_POST["phonenumber"]) || strlen($_POST["phonenumber"])<0||strlen($_POST["phonenumber"])>0){
    $errors .= $invalidPhoneNumber;
}else{
    $phonenumber = filter_var($_POST["phonenumber"], FILTER_SANITIZE_STRING);
}*/

if($errors){
    $resultMessage = $errors;
    echo $resultMessage;
}
else
{
    $id=$_SESSION["user_id"];
	$firstname = mysqli_real_escape_string($con,$_POST['firstname']);
	$lastname = mysqli_real_escape_string($con,$_POST['lastname']);
    $gender=mysqli_real_escape_string($con,$_POST["gender"]);
	$sql = "UPDATE users set `first_name`='$firstname', `last_name`='$lastname', `gender`= '$gender' where id='$id'";
	$result = mysqli_query($con, $sql);
	if(!$result){
		echo '<p>There was an error inserting the users details in the database!</p>';
		exit;
	}
	else
	{
        echo "redirect";
	}
}
?>