<hr>
<?PHP if($_SESSION['Status']=='Admin') { ?>
<h1>User Database</h1>
<hr>

<form role="form" method="post" action="/panel.php">
<div class="form-group">
<table class="table table-striped table-hover table-bordered ">
  <thead class="thead-dark">
    <tr>
	<?PHP
$sql = "SHOW COLUMNS FROM userlist";
$result = mysqli_query($connect_user,$sql);
while($row = mysqli_fetch_array($result)){
	if($row['Field']=='Status'){
		echo "<th>".$row['Field']."</th>";
		echo "<th>Action</th>";
		break;
	}
echo "<th>".$row['Field']."</th>";
}
?>
    </tr>
  </thead>
  <tbody >
<?PHP

	$result2 = mysqli_query($connect_user,'SELECT * FROM userlist') or die('Error');
	$i=0;
	if(mysqli_num_rows($result2)) {
		while($row2 = mysqli_fetch_row($result2)) {
			$i++;
			echo '<tr>
			';
			foreach($row2 as $key=>$value) {
				
	if($key==0) {
									$set='<td> <a class="btn btn-danger" href="?del_user='.$value.'"><img src="/img/delete.png" height="20" width="20"> Delete</a></td>';
					echo '<td><span class="text" >',htmlentities($value),'</span><Input value="'.htmlentities($value).'" name="user_'.$i."_".$key.'" class="" style="display:none"/> </td>
';
	} else {
	
				echo '<td><span class="text" id="user_'.$i."_".$key.'">',htmlentities($value),'</span><Input value="'.htmlentities($value).'" id="user_'.$i."_".$key.'_input" name="user_'.$i."_".$key.'" class="text_input" style="display:none"/> </td>
	
				';
	}
	
			}
			echo $set;
			echo '
			
			</tr>';
		}
		echo '</table><br />';
	}
	
?>
  </tbody>
</table> 
<i>Double Cick on Cell for Editing. Press Enter after Editing.</i>
</div>

<button type="submit" class="btn btn-warning btn-lg" name="submit_update_user">
							Update
						</button>
						
						
</form>
<?PHP } ?>