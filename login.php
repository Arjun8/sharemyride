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
		}
		else
		{
				$_SESSION["user_id"]=$row["id"];
				$_SESSION["email"] = $row["email"];
				$_SESSION["firstname"] = $row["first_name"];
				$_SESSION["lastname"] = $row["last_name"];
				$_SESSION["logout"]=false;
				$_SESSION["phonenumber"]=$row["phonenumber"];
				if(empty($_POST['rememberme'])){
						echo "redirect";
				}else{
					$authentificator1 = bin2hex(openssl_random_pseudo_bytes(10));
					$authentificator2 = openssl_random_pseudo_bytes(20);
					function f1($a, $b){
						$c = $a . "," . bin2hex($b);
						return $c;
					}
					$cookieValue = f1($authentificator1, $authentificator2);
					setcookie(
						"rememberme",
						$cookieValue,
						time() + 1296000
					);
					function f2($a){
						$b = hash('sha256', $a);
						return $b;
					}
					$f2authentificator2 = f2($authentificator2);
					$user_id = $_SESSION['user_id'];
					$expiration = date('Y-m-d H:i:s', time() + 1296000);
					$sql = "INSERT INTO rememberme
					(`authentificator1`, `f2authentificator2`, `user_id`, `expires`)
					VALUES
					('$authentificator1', '$f2authentificator2', '$user_id', '$expiration')";
					$result = mysqli_query($con, $sql);
					if(!$result){
						echo  '<h2 class="mdl-text mdl-color-text--primary">There was an error storing data to remember you next time.</h2>'.mysqli_error($con);
					}else{
						echo "redirect";
					}
				}
			}
	}
?>