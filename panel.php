<?PHP
session_start();
if(isset($_GET['logout'])) {
	session_destroy();
	session_start();
}

$title="Admin Panel";
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
<?PHP
						if(isset($_POST['submit_databse_update'])){
							
							$resultx=Update_Full_Database();
						}
						
						elseif(isset($_POST['update_notice'])){
							
							$resultx=update_notice();
						}
						
						elseif(isset($_POST['submit_insert_new_class'])){
							
							$resultx=submit_insert_new_class();
						}
						
						elseif(isset($_POST['submit_insert_new_subject'])){
							
							$resultx=submit_insert_new_subject();
						}
						
							elseif(isset($_POST['submit_insert_new_chapter'])){
							
							$resultx=submit_insert_new_chapter();
						}
						
							elseif(isset($_POST['submit_insert_new_lesson'])){
							
							$resultx=submit_insert_new_lesson();
						}
						
								elseif(isset($_POST['submit_update_edit'])){
							
							$resultx=submit_update_edit();
						}
						
								elseif(isset($_POST['submit_insert_new_user'])){
									
							if($_SESSION['Status']=='Admin') {
							$resultx=submit_insert_new_user();
							}
							 else {
								 $resultx='Something Went Wrong!';
							 }
						}
						
						elseif(isset($_POST['submit_update_user'])){
							
							$resultx=submit_update_user();
						}
							elseif(isset($_GET['del_row'])){
							
							//echo '<script>alert("'.del_row().'"); window.location.href = "/panel.php";</script>';
							$resultx=del_row();
							
						}
							elseif(isset($_GET['del_user'])){
							
						//	echo '<script>alert("'.del_user().'"); window.location.href = "/panel.php";</script>';
							$resultx=del_user();
						}
						?>
						<br>
						<ol class="breadcrumb">
User: <?PHP echo $_SESSION['username']; ?>  &nbsp;&nbsp;&nbsp;    Status:  <?PHP echo $_SESSION['Status']; ?>
</ol>
						<?PHP
						if(isset($resultx)) {
						Notice($resultx);
						}
						?>
						
					<!---------------------------- OPTION TAB ----------------------->
				
<br>
					<ul class="nav">
					
					
  <li class="nav-item">
    <a class="btn btn-outline-success
	   <?PHP
if(isset($_POST['update_notice'])||($_POST==false&&$_GET==false)) {
	echo ' active';
}
	?>
	" data-toggle="tab" href="#update_notice"><img src="/img/update_notice.png" height="20" width="20"> Update Notice</a>
  </li>
  
  
  <li class="nav-item">
   &nbsp;&nbsp;&nbsp; <a class="btn btn-outline-success
   <?PHP
if(isset($_POST['choose_class'])||(isset($_POST['submit_insert_new_subject'])||isset($_POST['submit_insert_new_class'])||isset($_POST['submit_insert_new_lesson'])||isset($_POST['submit_insert_new_chapter']))) {
	if(!isset($_POST['submit_edit'])&&!isset($_POST['submit_update_edit'])) {
	echo ' active';
	}
}
	?>
	" data-toggle="tab" href="#insert_course"><img src="/img/insert_course.png" height="20" width="20"> Insert New Course</a>
  </li>
  
  
    <li class="nav-item">
   &nbsp;&nbsp;&nbsp; <a class="btn btn-outline-success
   <?PHP
if(isset($_POST['submit_edit'])||isset($_POST['submit_update_edit'])) {
	echo ' active';
}
	?>
	" data-toggle="tab" href="#edit_course"><img src="/img/edit_course.png" height="20" width="20"> Edit Course</a>
  </li>
  
  
      <li class="nav-item">
   &nbsp;&nbsp;&nbsp; <a class="btn btn-outline-success
   <?PHP
if(isset($_POST['submit_databse_update'])||(isset($_GET['del_row'])&&$_GET['del_row']!=='')) {
	echo ' active';
}
?>
	
	" data-toggle="tab" href="#database_update"><img src="/img/database_update.png" height="20" width="20"> Database Update</a>
  </li>
  
  <?PHP if($_SESSION['Status']=='Admin') { ?>
  
          <li class="nav-item">
   &nbsp;&nbsp;&nbsp; <a class="btn btn-outline-success
   <?PHP
if(isset($_POST['submit_insert_new_user'])) {
	echo ' active';
}
?>
	" data-toggle="tab" href="#insert_user"><img src="/img/insert_user.png" height="20" width="20"> Insert New User</a>
  </li>
  
  
  
        <li class="nav-item">
   &nbsp;&nbsp;&nbsp; <a class="btn btn-outline-success
   <?PHP
if(isset($_POST['submit_update_user'])||(isset($_GET['del_user'])&&$_GET['del_user']!=='')) {
	echo ' active';
}
?>
	" data-toggle="tab" href="#user_database"><img src="/img/user_database.png" height="20" width="20"> User Database Update</a>
  </li>
  
  
  
  <?PHP } ?>
  
  
  
</ul>

<div id="myTabContent" class="tab-content">


  <div class="tab-pane fade  <?PHP
if(isset($_POST['update_notice'])||($_POST==false&&$_GET==false)) {
	echo ' in active show';
}
	?>
	" id="update_notice">
  <?PHP
require("panel_files/update_notice.php");
?>
  </div>
  
  
  
  <div class="tab-pane fade
  <?PHP
if(isset($_POST['choose_class'])||(isset($_POST['submit_insert_new_subject'])||isset($_POST['submit_insert_new_class'])||isset($_POST['submit_insert_new_lesson'])||isset($_POST['submit_insert_new_chapter']))) {
	if(!isset($_POST['submit_edit'])&&!isset($_POST['submit_update_edit'])) {
	echo ' in active show';
	}
}
	?>
	
	" id="insert_course">
    <?PHP
require("panel_files/insert_course.php");
?>
  </div>
  

  <div class="tab-pane fade
  <?PHP
if(isset($_POST['submit_edit'])||isset($_POST['submit_update_edit'])) {
	echo ' in active show';
}
	?>
	" id="edit_course">
    <?PHP
require("panel_files/edit_course.php");
?>
  </div>
  
  <div class="tab-pane fade
  <?PHP
if(isset($_POST['submit_databse_update'])||(isset($_GET['del_row'])&&$_GET['del_row']!=='')) {
	echo ' in active show';
} 
?>
	
	" id="database_update">
    <?PHP
require("panel_files/database_update.php");
?>
  </div>
  
    <?PHP if($_SESSION['Status']=='Admin') { ?>
	
	
	<div class="tab-pane fade
  <?PHP
if(isset($_POST['submit_insert_new_user'])) {
	echo ' in active show';
} 
?>
	
	" id="insert_user">
    <?PHP
require("panel_files/insert_user.php");
?>
  </div>
  
  
       
   <div class="tab-pane fade
  <?PHP
if(isset($_POST['submit_update_user'])||(isset($_GET['del_user'])&&$_GET['del_user']!=='')) {
	echo ' in active show';
} 
?>
	
	" id="user_database">
    <?PHP
require("panel_files/user_database.php");
?>
  </div>
  
  
  
  
  
  
  <?PHP } ?>
  
</div>



					
					


					



<!---- OPTION TAB --->


					
<hr>


<p class="text-right">
	<button type="button" class="btn btn-outline-danger"><a href="?logout">Logout</a></button>
	</p>
	

<?PHP
require("footer.php");
?>