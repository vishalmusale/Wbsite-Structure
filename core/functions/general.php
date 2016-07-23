<?php
function sanitize($data){
	return mysqli_real_escape_string($data);
}
/*
function array_sanitize(&$item){
	$item = mysqli_real_escape_string($item);
}
*/

function login_protection(){
	if(logged_in() === false){
		header('Location: login_protection.php');
		exit();
	}
	
}
function output_errors($errors){
	return '<ul><li>' . implode('</li><li>', $errors) . '</li></ul>';
}
?>