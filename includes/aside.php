<aside id="Just_A_Random_ID">
	<?php 
		if(logged_in() === true){
			include 'includes/widgets/loggedin.php';
			echo "<a href= 'logout.php'>Logout</a>";
		}
		else{
			include 'includes/widgets/login.php'; 
		}
	?>
</aside>