<?php
	function connect(){
		$servername = "localhost";
		$user = "root";
		$password = "";
		$dbname = "revoluli";
		$username = "vishalmusale";
		// Create connection
		$conn = new mysqli($servername, $user, $password, $dbname);
		return $conn;
	}
	
	function signup_user($signup_data){
		//array_walk($signup_data, 'array_sanitize');
		
		$conn = connect();	// Make Connection
		
		$fields = '' . implode(', ', array_keys($signup_data)) . '';
		$data = '\'' . implode('\', \'', $signup_data) . '\'';
		/* fetch associative array */
		mysqli_query($conn, "INSERT INTO users ($fields) VALUES ($data)");
	}
	
	function email_exists($email){
		
		$conn = connect();	// Make Connection
		
		// Return the number of rows in result set
		$result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
		$rowcount=mysqli_num_rows($result);
		
		return $rowcount ===1 ? true : false;
	}
	
	function user_exists($username){
		
		$conn = connect();	// Make Connection
		
		// Return the number of rows in result set
		$result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
		$rowcount=mysqli_num_rows($result);
		
		return $rowcount ===1 ? true : false;
	}
	
	function user_active($username){
		$conn = connect();	//	Make Connection
		
		$result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND activated='1'");
		$rowcount=mysqli_num_rows($result);
		
		return $rowcount ===1 ? true : false;
	}
	
	function user_data($id){
		$data = array();
		$user_id = intval($id);
		
		$func_num_args = func_num_args();
		$func_get_args = func_get_args();
		
		if($func_num_args > 1){
			unset($func_get_args[0]);
			
			$fields = '' . implode(', ', $func_get_args) . '';
			
			$conn = connect();	//	Make Connection
			/* fetch associative array */
			$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT $fields FROM users WHERE id=$user_id"));
			
			return $data;
		}
	}
	
	function logged_in(){	//	to check whether user is already logged in or not
		return (isset($_SESSION['id'])) ? true : false;
	}
	
	function id_from_username($username){
		$conn = connect();	//	Make Connection
		$result = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id FROM users WHERE username='$username'"));
		return $result['id'];
	}
	function login($username, $password){
		$conn = connect();	//	Make Connection
		$id = id_from_username($username);
		//$password = 
		
		$query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
		$rowcount=mysqli_num_rows($query);
		
		return $rowcount ===1 ? $id : false;
	}
?>