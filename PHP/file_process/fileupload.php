<?php 



if(isset($_POST['submit'])){

	$name = $_FILES['myfile']['name'];
	$size = $_FILES['myfile']['size'];
	$type = $_FILES['myfile']['type'];
	$tmp_name = $_FILES['myfile']['tmp_name'];
	
	$error = $_FILES['myfile']['error'];

	echo "File Name: ".$name."<br/>";
	echo "File Size: ".$size."<br/>";
	echo "File Type: ".$type."<br/>";
	echo "Tmp Name: ".$tmp_name."<br/>";
	
	if(!is_dir("newuploads")){
		mkdir("newuploads");
	}
	$location = "uploads/";

    if (move_uploaded_file($_FILES["myfile"]["tmp_name"], $location.$name)) {
        echo "The file ".basename($_FILES["myfile"]["name"])." has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
    
}else{
	echo "No.";
}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>PHP File Upload</title>
		<link rel="stylesheet" href="" type="text/css" />
	</head>
	
	<body>
		<header>
			<h1>PHP File Upload</h1>
		</header>
		<main>
			<form id="uploadbanner" enctype="multipart/form-data" method="post" action="fileupload">
			   <input id="fileupload" name="myfile" type="file" /><br/>
			   <input type="submit" value="submit" name="submit" id="submit" />
			</form>
		</main>
		
		<footer>
			<div>
				Copyright &copy;2015, Jingguo Feng
			</div>
		</footer>
	</body>

</html>
