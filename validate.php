<?php ob_start();
include_once("db_connection.php");

$currentDir = __DIR__;
$ROOT = $currentDir."/assests/images";
if( count($_FILES) > 0 ){
	foreach($_FILES as $file => $details)
	{   // Move each file from its temp directory to $ROOT
	    $temp = $details['tmp_name'];
	    $target = $details['name'];
	    move_uploaded_file($temp, $ROOT.'/'.$target);
	}
}

if( !empty($_POST) ){
	$validateSql = $conn->query("SELECT * FROM homepage");

	$postedValues = array(
			'header_image'	=>	$_FILES['header_img']['name'],
			'heading_text'	=>	$_POST['heading_text'],
			'top_image'	=>	$_FILES['top_image']['name'],
			'bottom_image'	=>	$_FILES['bottom_image']['name'],
			'bottom_text1'	=>	$_POST['bottom_text1'],
			'bottom_text2'	=>	$_POST['bottom_text2'],
			'rotating_image'	=>	$_FILES['rotating_image']['name']
		);

	$postedValuesStr = "";
	foreach($postedValues as $key => $value){
		if( !empty($value) ){
			$postedValuesStr .= $key.'='.'"'.$value.'"'.', ';
		}
	}
	$postedValuesStr = rtrim($postedValuesStr, ", ");

	$hsql = "";
	if( $validateSql->num_rows <= 0 ){
		$hsql = "INSERT INTO homepage SET ".$postedValuesStr;
	}else{
		$homepageRow = $validateSql->fetch_assoc();
		if( !empty($homepageRow['id']) ){
			$hsql = "UPDATE homepage SET ".$postedValuesStr." WHERE id = ".$homepageRow['id'];	
		}		
	}

	if ($conn->query($hsql) === TRUE) {
	    echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
}

$Message = urlencode("Saved Successfully");
header("Location:auth.php?Message=".$Message);

?>