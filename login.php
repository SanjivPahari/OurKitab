<?PHP
$title="Login Panel - E-Learning Nepal";
require("header.php");
require("db-connect.php");
require("functions.php");
	if(!isset($_SESSION)) {
session_start();
	}
if(isset($_SESSION['username'])) {	
    header("Location: /panel.php");
	die();
}
?>

    
			<div class="row">
				<div class="col-md-12">
					<h1 class="text-center text-danger">
					<hr>
						Login Panel for Teachers/Administrators
						
						<hr>
					</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
				</div>
				<div class="col-md-4">
				<?PHP
						if(isset($_POST['submit'])) {
							
						Login();
						}
						?>
				<div class="card">
  <h3 class="card-header"> <img src="/img/user.png" height="40" width="40">   Login</h3>
  <div class="card-body">

  <form role="form" method="post" >
						<div class="form-group">
							 
							<label for="Username">
								Username
							</label>
							<input class="form-control" name="Username" placeholder="Enter Username..." value="<?PHP if(isset($_POST['Username'])) { echo $_POST['Username']; } ?>">
						</div>
						<div class="form-group">
							 
							<label for="Password">
								Password
							</label>
							<input type="password" class="form-control" name="Password" placeholder="Enter Password..." value="<?PHP if(isset($_POST['Password'])) { echo $_POST['Password']; } ?>">
						</div>
						
					
						<button type="submit" class="btn btn-primary" name="submit">
							 <img src="/img/enter.png" height="20" width="20"> Submit
						</button>
						
						<button type="button" class="btn btn-outline-info"><a href="/">Back to Home</a></button>
						
						
					</form>
  
  </div>

</div>
					
					
					
				</div>
				<div class="col-md-4">
				</div>
			</div>

<?PHP
require("footer.php");
?>