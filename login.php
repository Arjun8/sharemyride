<?php
session_start();
include('common.php');
global $errors;
$missingEmail = '<h2><strong>Please enter your email address!</strong></h2>';
$missingPassword = '<h2><strong>Please enter a Password!</strong></h2>';
$invalidEmail='<h2><strong>Please enter a valid email!</strong></h2>';
$invalidPassword = '<h2><strong>Your password should be at least 6 characters long and inlcude one capital letter and one number!</strong></h2>';
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
		$resultMessage =  $errors;
		echo $resultMessage;
		//alert("hello");
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
		echo"<h2>There was error in executing the query</p>";
		}
		$results = mysqli_num_rows($result);
		if($results!=1)
		{
			echo '<h2 class="mdl-text mdl-color-text--primary">Wrong email or password</h2>';
			//alert("hello");
		}
		else
		{
				//echo '<h2>Hello'.$row["email"].'</p>';
				echo "redirect";
				$_SESSION["user_id"]=$row["id"];
				$_SESSION["email"] = $row["email"];
				$_SESSION["firstname"] = $row["first_name"];
				$_SESSION["lastname"] = $row["last_name"];
				$_SESSION["logout"]=false;
				$_SESSION["phonenumber"]=$row["phonenumber"];

		}
	}
?>