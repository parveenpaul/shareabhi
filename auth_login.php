<?php ob_start(); session_start(); ?>
<?php
	$message = "";
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		
		include_once("db_connection.php"); 

		$uname = $_POST['uname'];
		$pswd = $_POST['psw'];
		$_SESSION['valid_admin_user'] = false;
		$isValidUser = $conn->query("SELECT * FROM `user` WHERE username = '".$uname."' AND password = '".md5($pswd)."' ");
		if( $isValidUser->num_rows > 0 ){			
			$_SESSION['valid_admin_user'] = true;
			$_SESSION['admin_user'] = 'root';
			header("Location:auth.php");
		}else{
			$message = '<div class="alert alert-danger">Please enter valid credentials</div>';
		}
		$conn->close();
	}else{
		session_destroy();
	}
?>
<html>
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="assests/css/admin.css">
	</head>
	<title> Welcome To Admin login </title>
	<body>
		<style>
			/* Bordered form */
			form {
			    border: 3px solid #f1f1f1;
			}

			/* Full-width inputs */
			input[type=text], input[type=password] {
			    width: 100%;
			    padding: 12px 20px;
			    margin: 8px 0;
			    display: inline-block;
			    border: 1px solid #ccc;
			    box-sizing: border-box;
			}

			/* Set a style for all buttons */
			button {
			    background-color: #4CAF50;
			    color: white;
			    padding: 14px 20px;
			    margin: 8px 0;
			    border: none;
			    cursor: pointer;
			    width: 100%;
			}

			/* Add a hover effect for buttons */
			button:hover {
			    opacity: 0.8;
			}

			/* Extra style for the cancel button (red) */
			.cancelbtn {
			    width: auto;
			    padding: 10px 18px;
			    background-color: #f44336;
			}

			/* Center the avatar image inside this container */
			.imgcontainer {
			    text-align: center;
			    margin: 24px 0 12px 0;
			}

			/* Avatar image */
			img.avatar {
			    width: 40%;
			    border-radius: 50%;
			}

			/* Add padding to containers */
			.container {
			    padding: 16px;
			}

			/* The "Forgot password" text */
			span.psw {
			    float: right;
			    padding-top: 16px;
			}

			/* Change styles for span and cancel button on extra small screens */
			@media screen and (max-width: 300px) {
			    span.psw {
			        display: block;
			        float: none;
			    }
			    .cancelbtn {
			        width: 100%;
			    }
			}
		</style>
		<?php echo $message ?>
		<form method="post" name="admin_login_form" action="">
		  <!--<div class="imgcontainer">
		    <img src="img_avatar2.png" alt="Avatar" class="avatar">
		  </div>-->

		  <div class="container">
		    <label for="uname"><b>Username</b></label>
		    <input type="text" placeholder="Enter Username" name="uname" required>

		    <label for="psw"><b>Password</b></label>
		    <input type="password" placeholder="Enter Password" name="psw" required>

		    <button type="submit">Login</button>
		  </div>
		</form>
	</body>
</html>