<?PHP
session_start();
if(isset($_GET['logout'])) {
	session_destroy();
	session_start();
}

$title="Image Upload";
require("header.php");
require("db-connect.php");
require("functions.php");
?>
<?PHP

if(!$_SESSION['username']) {	
    header("Location: /login.php");
	die();
}
?>
	<hr>
<h1>Image Upload</h1>
<hr>
<?php
if(isset($_GET['del'])) {
$file = $_GET['del'];
if (!unlink($file))
  {
  Error ("Error deleting $file");
  }
else
  {
  Success_Notice ("Deleted $file");
  }
}
?>
<form action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload" >
    <input type="submit" value="Upload Image" name="submit">
</form>
<hr>
<?php


if(isset($_POST["submit"])) {
	
	###################################################
	$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
######################################################
	
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	
    if($check !== false) {
      //  Success_Notice("File is an image - " . $check["mime"] . ".");
        $uploadOk = 1;
    } else {
        Error("File is not an image.");
        $uploadOk = 0;
    }

// Check if file already exists
if (file_exists($target_file)) {
    Error("Sorry, file already exists.");
    $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 2097152) {
    Error("Sorry, your file is too large.");
    $uploadOk = 0;
} 

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    Error("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error

if ($uploadOk == 0) {
    Error("Sorry, your file was not uploaded.");
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        Success_Notice("The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.<br>");
    } else {
        Error("Sorry, there was an error uploading your file.");
    }
}
echo '<hr>';
}
?>
   <div class="row">
<?php
$folder_path = 'uploads/'; //image's folder path

$num_files = glob($folder_path . "*.{JPG,jpg,gif,png,bmp}", GLOB_BRACE);

$folder = opendir($folder_path);
 	$i=0;
if($num_files > 0)
{

 while(false !== ($file = readdir($folder))) 
 {
	
  $file_path = $folder_path.$file;
  $extension = strtolower(pathinfo($file ,PATHINFO_EXTENSION));
  if($extension=='jpg' || $extension =='png' || $extension == 'gif' || $extension == 'bmp') 
  {
	   $i++;
   ?>

   <div class="col-md-4">
            <a href="<?php echo $file_path; ?>"><img src="<?php echo $file_path; ?>" height="300" width="445"/></a>
			<br><br>
			<input  class="form-control-sm" size="45" type="text" id="inputSmall" value="<?php echo '/'.$file_path; ?>">   <a class="btn btn-danger" href="?del=<?php echo $file_path; ?>">
			<img src="/img/delete.png" height="20" width="20"> Delete</a>
			<br>
            </div>
			
			<?php
					if($i==3) {
			echo '</div><hr color="green"> <div class="row">';
			$i=0;
		}
  }
 }
}
else
{
 Error("The folder was empty !");
}
closedir($folder);
?>

</div>
<hr color="green">
<?PHP
require("footer.php");
?>