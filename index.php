<?php 
include 'core/init.php';
include 'includes/overall/header.php';
?>
  <h1>Home</h1>
  
  <?php
	if(isset($_SESSION['id'])){
		echo 'Logged in :D';
	}
	else{
		echo 'Not Logged in ... :(';
	}

  ?>
<?php include 'includes/overall/footer.php';?>