<?php include_once("visitor_count.php"); ?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
 		<title>Ramadan Mubarak</title>
		<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1"/>
		<meta name="google" value="notranslate">
		<meta property="og:type" content="Wishing surprise" />
		<meta property="og:title" content="Advance Wishes" />
		<meta property="og:url" content="" />
		<meta property="og:site_name" content="Indian Festivals" />
		<meta property="og:image" content="">
		<link type="text/css" rel="stylesheet" href="assests/css/animate.min.css" />  
		<link rel="stylesheet" type="text/css" href="assests/css/style.css">
	 
		<audio controls autoplay loop style="display:none">
			<source src="assests/sounds/digital.mp3" type="audio/mpeg">
			Your browser does not support the audio element.
		</audio>
	</head>

	<body>
		<?php
			include_once("db_connection.php");
			$homepageSql = $conn->query("SELECT * FROM homepage");
			$header_image = "";	$top_image = ""; $bottom_image = ""; $rotating_image = "";
			$heading_text = "";	$bottom_text1 = "";	$bottom_text2 = "";
			$ROOT = "assests/images";
			if( $homepageSql->num_rows > 0 ){
				$homepageRow = $homepageSql->fetch_assoc();
				$heading_text = $homepageRow['heading_text'];
				$bottom_text1 = $homepageRow['bottom_text1'];
				$bottom_text2 = $homepageRow['bottom_text2'];
				$header_image = $ROOT.'/'.$homepageRow['header_image'];
				$top_image = $ROOT.'/'.$homepageRow['top_image'];
				$bottom_image = $ROOT.'/'.$homepageRow['bottom_image'];
				$rotating_image = $ROOT.'/'.$homepageRow['rotating_image'];
			}
			$conn->close();
		?>
		<marquee class="m1" behavior="scroll" direction="up" scrolldelay="8">
			<?php 
			for($i=0; $i<8; $i++){
				echo '<img src="'.$rotating_image.'" height="100px" width="80px" height="50px"/><br><br>';
			}
			?>
		</marquee>
		<marquee class="m2" behavior="scroll" direction="down" scrolldelay="8"><br>
			<?php 
			for($i=0; $i<8; $i++){
				echo '<img src="'.$rotating_image.'" height="100px" width="80px" height="50px" /><br><br>';
			}
			?>
		</marquee>

		<div class="container">
			 <div class="main-greeting">
				<div align="center html2canvas-ignore">
			  		<div style="font-size: 17px; font-weight: 800; color: white;">
						<center><p id="demo"></p></center>

						<div class="main_body">
							<center>
								<figure>
									<h1 class="naming">
									<?php 
									if( !empty($_POST) ){
										echo $_POST['n'];
									}elseif( !empty($_GET) ){
										echo str_replace("-", " ", $_GET['n']);
									}else{
										echo '[YOUR NAME]';
									}
									?>
									</h1>
								</figure>
							</center>

							<div class="vi" style="text-align: center;">
								<img src="<?php echo $header_image; ?>" class="swing1" alt="diwali" style="width: 100%; height:100px;" />
								<h3><p class="hny-txt"><?php echo $heading_text; ?></p></h3>
								<img class="center swing" src="<?php echo $top_image; ?>" width="300px" /><br><br>
								<img class="center swing" src="<?php echo $bottom_image; ?>" width="250px" />
								<!--<img class="center swing" src="assests/images/boy.png" width="150px" height="150px" alt="Happy Republic Day" />-->
								<br>
							</div>
						</div> <!-- main_body end -->
						<br>
						<center>						
							<p class="hny-txt" ><?php echo $bottom_text1; ?></p>
							<p class="hny-txt" ><?php echo $bottom_text2; ?></p>
						</center>
						<br>
						<center><?php 
						if(!empty($_POST)){
							echo '<div class="button">'.$_POST['n'].'</div>';
						}
						if(!empty($_GET)){
							echo '<div class="button">'.$_GET['n'].'</div>';
						} ?>
						</center><br>
						<center>							 
						</center><br><br>
					</div>
				</div>
			</div>
		</div> <!-- container end -->
		<?php 
		if(empty($_POST)){
		?>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
			<div class="enter-name">
				<input class="animated pulse infinite" type="name" required="" maxlength="50" name="n" placeholder="👉 Enter Your Name Here">
				<button class="btn animated shake infinite" type="submit"><span>👉</span> Go</button>
			</div>
		</form>
		<?php }else{ ?>
		<center>
    		<a class="footerbtn" href="whatsapp://send?text=Click <?php echo $heading_text ?> 👉 shareabhi.com/?n=<?php echo (!empty($_POST)) ? str_replace(" ", "-", $_POST['n']) : '' ?>"><img width="25px" height="25px" src="assests/images/whatsapp.png"/><b style="font-size: 15px;"> Click Here to Share on Whatsapp</b> <img width="25px" height="25px" src="assests/images/whatsapp.png"/></a>
 		</center>
 		<?php } ?>
	</body>
</html>