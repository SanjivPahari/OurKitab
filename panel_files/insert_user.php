<?PHP if($_SESSION['Status']=='Admin') { ?>

<hr>
<h1>Insert New User</h1>
<hr>




<div class="card">
  <h3 class="card-header">New User</h3>
  <div class="card-body">
  
<form role="form" method="post" action="/panel.php">

<div class="form-group" >


<label for="Username">
								Username
							</label>
							<input class="form-control" name="Username" placeholder="Username" value="<?PHP if(isset($_POST['Username'])) { echo $_POST['Username']; } ?>">

		</div>
		
		<div class="form-group" >


<label for="Password">
								Password
							</label>
							<input class="form-control" name="Password" placeholder="Password" value="<?PHP if(isset($_POST['Password'])) { echo $_POST['Password']; } ?>">

		</div>
		
		<div class="form-group" >


<label for="Status">
								Status
							</label>
							
							<select name="Status" class="form-control" >
							<option>Teacher</option>
							<option>Admin</option>
							</select>

		</div>
		
<div class="form-group" >
<button type="submit" class="btn btn-primary" name="submit_insert_new_user" style="width: 100%;">
							Insert
						</button>	
			</div>			
							
</form>
</div>
</div>

<?PHP } ?>