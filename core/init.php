<?php
session_start();
require 'database/connect.php';
require 'functions/users.php';
require 'functions/general.php';

if(logged_in() === true){
	$session_user_id = $_SESSION['id'];
	$user_data = user_data($session_user_id, 'id', 'username', 'password', 'first_name', 'last_name', 'email');
	//	For some reason User has been deactivated
	//	then that user will not be allowed to use the website
	if(user_active($user_data['username']) === false){
		session_destroy();
		header('Location: index.php');
		exit();
	}
}

$errors = array();
?>