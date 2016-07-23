<?php 
include 'core/init.php';
include 'includes/overall/header.php';

if(empty($_POST) === false){
	$required_fields = array('username', 'password', 'rewrite_password', 'first_name', 'last_name', 'email');
	foreach($_POST as $key=>$value){
		if(empty($value) && in_array($key, $required_fields) === true){
			$errors[] = 'Please enter data in * field.';
			break 1;
		}
	}
	
	if(empty($errors) === true){
		if(user_exists($_POST['username']) == true){
			$errors[] = 'Username Already Exist Please Use Different Username';
		}
		if(preg_match("/\\s/", $_POST['username']) == true){
			$errors[] = 'Username Contains Space... !';
		}
		if(strlen($_POST['password']) < 8){
			$errors[] = 'Password must be at least 8 characters long.';
		}
		if($_POST['password'] !== $_POST['rewrite_password']){
			$errors[] = 'Password Does Not Match... !';
		}
		if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false){
			$errors[] = 'Enter a Valid Email Address... !';
		}
		if(email_exists($_POST['email']) === true){
			$errors[] = 'Email Already Exist Please Use Different Email Address';
		}
	}
}
?>
  <h1>Sign Up Page</h1>
  
  <?php
	if(isset($_GET['success']) && empty($_GET['success'])){
		echo 'Thank you Signing Up...';
	}
	else {
		if(empty($_POST) === false && empty($errors) === true){
			//	User Regestration
			$signup_data = array(
				'username' => $_POST['username'],
				'password' => $_POST['password'],
				'first_name' => $_POST['first_name'],
				'last_name' => $_POST['last_name'],
				'email' => $_POST['email'],
				'activated' => 1	//	Automatically Activating Everybody...
			);
			signup_user($signup_data);
			header('Location: signup.php?success');
			
			exit();
		}
		else if(empty($errors) === false){
			//	Errors in Signing Up
			echo output_errors($errors);
		}
	
	?>
  
	<form action="" method="post">
		<ul>
			<li>
				Username*:<br>
				<input type="text" name="username">
			</li>
			<li>
				Password*:<br>
				<input type="password" name="password">
			</li>
			<li>
				Rewrite Password*:<br>
				<input type="password" name="rewrite_password">
			</li>
			<li>
				First Name*:<br>
				<input type="text" name="first_name">
			</li>
			<li>
				Last Name*:<br>
				<input type="text" name="last_name">
			</li>
			<li>
				Email*:<br>
				<input type="text" name="email">
			</li>
			<li>
				<input type="submit" value="Sign Up">
			</li>
		</ul>
	</form>
<?php 
	}	// Closing else Stmt.
include 'includes/overall/footer.php';?>