<hr>
<h1>Database Update</h1>
<hr>

<form role="form" method="post" action="/panel.php">
<div class="form-group">
<table class="table table-striped table-hover table-bordered ">
  <thead class="thead-dark">
    <tr>
	<?PHP
$sql = "SHOW COLUMNS FROM full_book";
$result = mysqli_query($connect_book,$sql);
while($row = mysqli_fetch_array($result)){
	if($row['Field']=='Information'){
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

	$result2 = mysqli_query($connect_book,'SELECT * FROM full_book ORDER BY `class_id`,`subject_id`,`chapter_id`,`lesson_id`') or die('Error');
	$i=0;
	if(mysqli_num_rows($result2)) {
		while($row2 = mysqli_fetch_row($result2)) {
			$i++;
			echo '<tr>
			';
			foreach($row2 as $key=>$value) {
				
				if($value==''){
					$value='Coming Soon....';
				}
						if($key==9){
							echo $set;
		break;
	}
	if($key==0) {
									$set='<td> <a class="btn btn-danger" href="?del_row='.$value.'"><img src="/img/delete.png" height="20" width="20"> Delete</a></td>';
					echo '<td><span class="text" >',htmlentities($value),'</span><Input value="'.htmlentities($value).'" name="'.$i."_".$key.'" class="" style="display:none"/> </td>
';
	} else {
	
				echo '<td><span class="text" id="'.$i."_".$key.'">',htmlentities($value),'</span><Input value="'.htmlentities($value).'" id="'.$i."_".$key.'_input" name="'.$i."_".$key.'" class="text_input" style="display:none"/> </td>
	
				';
	}
			}
			echo '
			
			</tr>';
		}
		echo '</table><br />';
	}
	
?>
  </tbody>
</table> 
<i>Double Click on Cell for Editing. Press Enter after Editing.</i>
</div>

<button type="submit" class="btn btn-warning btn-lg" name="submit_databse_update">
							Update
						</button>
						
						
</form>