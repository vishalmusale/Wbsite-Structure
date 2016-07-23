<?php
include 'core/init.php';
include 'includes/overall/header.php';

if(empty($_POST === false)){
	$username = $_POST['username'];
	$password = $_POST['password'];
		
	//echo $username , ' ', $password; 
	if(empty($username) === true || empty($password) === true){
		$errors[] = 'Please Enter Username and Password';
	} 
	else if(user_exists($username) === false){
		$errors[] = 'username does not exist';
	}
	else if(user_active($username) === false){
		$errors[] = 'You have not activated your account';
	}
	else{
		$login = login($username, $password);
		if($login === false){
			$errors[] = 'That username/ password was incorrect.';
		}
		else{
			//	Set user session
			$_SESSION['id'] = $login;
			header('Location: index.php');
			echo 'SUCCESS!!!!!';
		}
	}
	echo output_errors($errors);
}
include 'includes/overall/footer.php';
?>