<?php 
	$conn = mysqli_connect("localhost","root","","shareabhi0299");

	// Check connection
	if (mysqli_connect_errno())
	  {
	  echo "Failed to connect to DB: " . mysqli_connect_error();
	  }
?>