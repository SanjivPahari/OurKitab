<?PHP
//error_reporting(0);
//ini_set('display_errors', 0);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?PHP echo $title; ?></title>

    <meta name="description" content="<?PHP echo $title; ?>">
    <meta name="author" content="Sanjiv Pahai">
<?PHP 
if(!isset($_SESSION)) {
	session_start();
}
if(isset($_GET['theme'])) {
	
	switch($_GET['theme']) {
		
		case 1:
		$theme='';
		break;
		
		case 2:
		case 3:
		case 4:
		case 5:
		case 6:
		case 7:
		case 8:
		case 9:
		$theme=$_GET['theme'];
		break;
		
		default:
		$theme='';
	}
	
}
if(isset($theme)) {
	$_SESSION["theme"]=$theme;
}

if(!isset($_SESSION["theme"])&&!isset($_GET['theme'])) {
	$_SESSION["theme"]='';
} 
?>
    <link href="/css/bootstrap<?PHP echo $_SESSION["theme"]; ?>.css" rel="stylesheet"> 
	
	<style>
.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    right: 0;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown-content a:hover {background-color: #f1f1f1}

.dropdown:hover .dropdown-content {
    display: block;
}

.dropdown:hover .dropbtn {
    background-color: #3e8e41;
}
</style>

  </head>
  
  <body style=" background-color:#F0F8FF; background-position: center; background-repeat: no-repeat;background-size: cover;">
      <div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
		<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="/">E-Learning Nepal</a>

  <div class="collapse navbar-collapse" id="navbarColor01">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/">Home </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/features.php">Features</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/about.php">About</a>
      </li>
    </ul>


	 <form class="form-inline my-2 my-lg-0" action="search.php" method="get">
      <input class="form-control mr-sm-2" type="text" placeholder="Enter Keyword" name="keyword" value="<?PHP if(isset($_GET['keyword'])&&$_GET['keyword']!=='') { echo $search; } ?>">
      <button class="btn btn-danger" type="submit"><img src="/img/search.png" height="20" width="20"> Search</button>
    </form>
	<?PHP
	if(!isset($_SESSION)) {
	session_start();
	}
	if(!isset($_SESSION['username'])) {	
      echo '&nbsp;&nbsp;&nbsp;<a href="/login.php"><button class="btn btn-success"> <img src="/img/login.png" height="20" width="20">  Login</button></a>';
	}
	  else {
		  echo '&nbsp;&nbsp;&nbsp;<a href="/panel.php">  <button class="btn btn-success"> <img src="/img/user.png" height="20" width="20">  Admin Panel</button></a>';
	}
	if(isset($_SESSION['username'])) {	
      echo ' &nbsp;&nbsp;&nbsp; <a href="/upload.php">  <button class="btn btn-warning"> <img src="/img/upload.png" height="20" width="20">  Upload Image</button></a>';
	}
	?>
&nbsp;&nbsp;&nbsp;
<div class="dropdown" style="float:right;">
  <button id="dropbtn" class="btn btn-info">Theme</button>
  <div class="dropdown-content">
    <a href="?theme=1">Default</a>
	 <a href="?theme=2">Litera</a>
	  <a href="?theme=3">Materia</a>
	   <a href="?theme=4">Sketchy</a>
	    <a href="?theme=5">United</a>
		 <a href="?theme=6">Yeti</a>
		  <a href="?theme=7">Spacelab</a>
    <a href="?theme=8">Simplex</a>
	 <a href="?theme=9">Lumen</a>
  </div>
</div>

  </div>
</nav>
