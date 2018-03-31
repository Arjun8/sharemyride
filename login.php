<?php
session_start();
include('common.php');
global $errors;
$missingEmail = '<p><strong>Please enter your email address!</strong></p>';
$missingPassword = '<p><strong>Please enter a Password!</strong></p>';
$invalidEmail='<p><strong>Please enter a valid email!</strong></p>';
$invalidPassword = '<p><strong>Your password should be at least 6 characters long and inlcude one capital letter and one number!</strong></p>';
if(isset($_POST["log_in"]))
{
	if(empty($_POST["email12"])){
		$errors .= $missingEmail;
	}else{
		$email = filter_var($_POST["email12"], FILTER_SANITIZE_EMAIL);
	}
	if(empty($_POST["password3"])){
		$errors .= $missingPassword;
	}else{
		$password = filter_var($_POST["password3"], FILTER_SANITIZE_STRING);
		}
	if($errors)
	{
		$resultMessage = '<div class="alert alert-danger">' . $errors .'</div>';
		echo $resultMessage;
		exit;
	}
	else
	{
		$email = mysqli_real_escape_string($con,$_POST['email12']);
		$password = mysqli_real_escape_string($con,$_POST['password3']);
		$password = hash('sha256', $password);
		$sql = "Select * from users where email='$email' AND password = '$password'";
		$result = mysqli_query($con,$sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		if(!$result)
		{
		echo"<p>There was error in executing the query</p>";
		}
		$results = mysqli_num_rows($result);
		if($results!=1)
		{
			echo"<p>Wrong email or password</p>";
		}
		else
		{
				//echo '<p>Hello'.$row["email"].'</p>';
				$_SESSION["email"] = $row["email"];
				$_SESSION["firstname"] = $row["first_name"];
				$_SESSION["lastname"] = $row["last_name"];
				$_SESSION["logout"]=false;
				$_SESSION["phonenumber"]=$row["phonenumber"];
				header("location: index.php");
		}
	}
}
?>