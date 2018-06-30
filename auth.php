<?php ob_start(); session_start(); ?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
 		<title>Shareabhi</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="assests/css/admin.css">
		<script src="assests/js/jquery.min.js"></script>
		<script src="assests/js/bootstrap.min.js"></script>
		<script src="assests/js/script.js"></script>

		<style>
		    /* Remove the navbar's default margin-bottom and rounded borders */ 
		    .navbar {
		      margin-bottom: 0;
		      border-radius: 0;
		    }
		    
		    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
		    .row.content {height: 100%}
		    
		    /* Set gray background color and 100% height */
		    .sidenav {
		      padding-top: 20px;
		      background-color: #f1f1f1;
		      height: 100%;
		    }
		    
		    /* Set black background color, white text and some padding */
		    footer {
		      background-color: #555;
		      color: white;
		      padding: 15px;
		    }
		    
		    /* On small screens, set height to 'auto' for sidenav and grid */
		    @media screen and (max-width: 767px) {
		      .sidenav {
		        height: auto;
		        padding: 15px;
		      }
		      .row.content {height:auto;} 
		    }
		  </style>
	</head>

	<body>
		<?php 
			include_once("db_connection.php"); 
			$homepageSql = $conn->query("SELECT * FROM homepage");

			$heading_text = "";	$bottom_text1 = "";	$bottom_text2 = "";	$header_image = "";	$top_image = ""; $bottom_image = "";
			$rotating_image = ""; $page_title = "";		
			$headerImgReq = ""; $topImgReq = ""; $bottomImgReq = ""; $rotatingImgReq = "";
			$ROOT = "assests/images";
			if( $homepageSql->num_rows > 0 ){
				$homepageRow = $homepageSql->fetch_assoc();
				$page_title = $homepageRow['page_title'];
				$heading_text = $homepageRow['heading_text'];
				$bottom_text1 = $homepageRow['bottom_text1'];
				$bottom_text2 = $homepageRow['bottom_text2'];
				$header_image = $ROOT.'/'.$homepageRow['header_image'];
				$top_image = $ROOT.'/'.$homepageRow['top_image'];
				$bottom_image = $ROOT.'/'.$homepageRow['bottom_image'];
				$rotating_image = $ROOT.'/'.$homepageRow['rotating_image'];
				$headerImgReq = (empty($homepageRow['header_image'])) ? 'required' : ''; 
				$topImgReq = (empty($homepageRow['top_image'])) ? 'required' : '';
				$bottomImgReq = (empty($homepageRow['bottom_image'])) ? 'required' : '';
				$rotatingImgReq = (empty($homepageRow['rotating_image'])) ? 'required' : '';
			}
			$conn->close();
			
			if( empty($_SESSION['valid_admin_user']) ){
				header("Location:auth_login.php");
			}
		?>
		<nav class="navbar navbar-inverse">
		  <div class="container-fluid">
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>                        
		      </button>
		      <a class="navbar-brand" href="#">ShareAbhi</a>

		    </div>
		    <div class="collapse navbar-collapse" id="myNavbar">
		      <!--<ul class="nav navbar-nav">
		        <li class="active"><a href="#">Home</a></li>
		        <li><a href="#">About</a></li>
		        <li><a href="#">Projects</a></li>
		        <li><a href="#">Contact</a></li>
		      </ul>-->
		      <ul class="nav navbar-nav navbar-right">
		        <li><a href="auth_login.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
		      </ul>
		    </div>
		  </div>
		</nav>

		<div class="container-fluid text-center">    
		  <div class="row content">
		    <div class="col-sm-2 sidenav">		      
		      <?php
		      	$counter_name = "counter.txt";
				$f = fopen($counter_name,"r");
				$counterVal = fread($f, filesize($counter_name));
				echo '<h3>Unique Visitor count: '.$counterVal.'</h3>';
				fclose($f);
		      ?>		      
		    </div>
		    <div class="col-sm-8 text-left"> 
		      <h1>Homepage Settings</h1>
		      <?php
				$message = isset($_GET['Message']) ? '<strong>Success!</strong> '.$_GET['Message'] : ''; 
				if( !empty($message) ){
		      ?>
				<div class="alert alert-success"><?php echo $message; ?></div>
				<?php } ?>

		      <form name="homepage_form" method="post" action="validate.php" enctype="multipart/form-data">
		      	<div class="form-group">
			 		<label for="page_title">Page Title</label>
			 		<input type="text" name="page_title" value="<?php echo $page_title; ?>" class="form-control" required />
			 	</div>
			 	<div class="form-group">
			 		<label for="header_img">Header Image</label>
			 		<input type="file" name="header_img" value="" class="form-control-file" onchange="readURL(this, 'HeaderImg');" <?php echo $headerImgReq ?> />
			 		<img id="HeaderImg" src="<?php echo $header_image; ?>" alt="Header Image" class="thumbnaiImg" />
			 	</div>
			 	<div class="form-group">
			 		<label for="heading_text">Heading Text</label>
			 		<input type="text" name="heading_text" value="<?php echo $heading_text; ?>" class="form-control" required />
			 	</div>
			 	<div class="form-group">
			 		<label for="top_image">Top Image</label>
			 		<input type="file" name="top_image" value="" class="form-control-file" onchange="readURL(this, 'TopImg');" <?php echo $topImgReq ?> />
			 		<img id="TopImg" src="<?php echo $top_image; ?>" alt="Top Image" class="thumbnaiImg" />
			 	</div>
			 	<div class="form-group">
			 		<label for="bottom_image">Bottom Image</label>
			 		<input type="file" name="bottom_image" value="" class="form-control-file" onchange="readURL(this, 'BottomImg');" <?php echo $bottomImgReq ?> />
			 		<img id="BottomImg" src="<?php echo $bottom_image; ?>" alt="Bottom Image" class="thumbnaiImg" />
			 	</div>
			 	<div class="form-group">
			 		<label for="bottom_text1">Bottom Text1</label>
			 		<textarea class="form-control" rows="3" name="bottom_text1" required><?php echo $bottom_text1; ?></textarea>
			 	</div>
			 	<div class="form-group">
			 		<label for="bottom_text2">Bottom Text2</label>
			 		<textarea class="form-control" rows="3" name="bottom_text2" required><?php echo $bottom_text2; ?></textarea>
			 	</div>
			 	<div class="form-group">
			 		<label for="rotating_image">Rotating Image</label>
			 		<input type="file" name="rotating_image" value="" class="form-control-file" onchange="readURL(this, 'RotatingImg');" <?php echo $rotatingImgReq ?> />
			 		<img id="RotatingImg" src="<?php echo $rotating_image; ?>" alt="Rotating Image" class="thumbnaiImg" />
			 	</div>
			 	<button type="submit" name="submit_action" >SAVE</button>
			 </form>
		    </div>
		    <div class="col-sm-2 sidenav">
		      
		    </div>
		  </div>
		</div>

		<footer class="container-fluid text-center">
		  <p>ShareAbhi</p>
		</footer>
	</body>
</html>