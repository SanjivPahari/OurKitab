<hr>
<h1>Edit Course</h1>
<hr>
<form role="form" method="post" action="/panel.php">

<div class="row">
<div class="col-md-3" >


<div class="form-group" >
<label for="choose_class">
								Choose Class
							</label>
							<select multiple="" class="form-control" id="choose_class" name="choose_class">
							<?PHP
							 $sql2 = "SELECT DISTINCT `Class` FROM `full_book` ORDER BY `class_id` ASC";
$result2 = $connect_book->query($sql2);
echo '<div class="list-group" >';
if ($result2->num_rows > 0) {
    while($row2 = $result2->fetch_assoc()) {
        echo '<option';
		if(isset($_POST['choose_class'])&&$_POST['choose_class']==$row2['Class']) { echo ' selected ';  }
		echo '>';
		echo $row2['Class'];
		echo '</option>';
    }
} else {
    echo "<option>Coming Soon...</option>";
}
echo '</div>'; 
?>
		
      </select>
	  
</div>
</div>

<?PHP
if((isset($_POST['submit_edit'])&&isset($_POST['choose_class']))||isset($_POST['submit_update_edit'])) {
	?>
	<div class="col-md-3" >
	<div class="form-group" >
<label for="choose_subject">
								Choose Subject
							</label>
							<select multiple="" class="form-control" id="choose_subject" name="choose_subject">
							
       <?PHP
	   $class=$_POST['choose_class'];
							 $sql2 = "SELECT DISTINCT `Subject` FROM `full_book` WHERE `Class` = '$class' ORDER BY `subject_id` ASC";
$result2 = $connect_book->query($sql2);
echo '<div class="list-group" >';
if ($result2->num_rows > 0) {
    while($row2 = $result2->fetch_assoc()) {
        echo '<option';
		if(isset($_POST['choose_subject'])&&$_POST['choose_subject']==$row2['Subject']) { echo ' selected ';  }
		echo '>';
		echo $row2['Subject'];
		echo '</option>';
    }
} else {
    echo "<option>Coming Soon...</option>";
} 
echo '</div>';
?>

      </select>
	  
	 </div>
	 </div>
	<?PHP
}
?>



<?PHP
if((isset($_POST['submit_edit'])&&isset($_POST['choose_class'])&&isset($_POST['choose_subject']))||isset($_POST['submit_update_edit'])) {
	?>
	<div class="col-md-3" >
	<div class="form-group" >
<label for="choose_lesson">
								Choose Lesson
							</label>
							<select multiple="" class="form-control" id="choose_lesson" name="choose_lesson">
							
       <?PHP
	   $class=$_POST['choose_class'];
	    $subject=$_POST['choose_subject'];
							 $sql2 = "SELECT DISTINCT `Lesson` FROM `full_book` WHERE `Class` = '$class' AND `Subject` = '$subject' ORDER BY `subject_id` ASC";
$result2 = $connect_book->query($sql2);
echo '<div class="list-group" >';
if ($result2->num_rows > 0) {
    while($row2 = $result2->fetch_assoc()) {
        echo '<option';
		if(isset($_POST['choose_lesson'])&&$_POST['choose_lesson']==$row2['Lesson']) { echo ' selected ';  }
		echo '>';
		echo $row2['Lesson'];
		echo '</option>';
    }
} else {
    echo "<option>Coming Soon...</option>";
} 
echo '</div>';
?>

      </select>
	  
	 </div>
	 </div>
	<?PHP
}
?>



</div>

<div class="form-group" >
<button type="submit" class="btn btn-primary" name="submit_edit" style="width: 100%;">
							Edit
						</button>	
			</div>			
							
</form>


<?PHP
if((isset($_POST['submit_edit'])&&isset($_POST['choose_class'])&&isset($_POST['choose_subject'])&&isset($_POST['choose_lesson']))||isset($_POST['submit_update_edit'])) {

	
	$class=Protect($_POST['choose_class']);
	$Subject=Protect($_POST['choose_subject']);
	$Lesson=Protect($_POST['choose_lesson']);
	$query="SELECT * FROM `full_book` WHERE `Class` = '".$class."' AND `Subject` = '".$Subject."' AND `Lesson` = '".$Lesson."'";
	$result = $connect_book->query($query);
	if ($result->num_rows <= 0) {
    require("error.php");
     goto last;
	}
	 $row = $result->fetch_assoc();
 echo '<div class="card border-warning"><div class="card-body">';
 
 
 

 
		echo '<ul class="nav nav-tabs">  <li class="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#Information"><img src="/img/info.png" height="20" width="20"> Information</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#Note"><img src="/img/note.png" height="20" width="20"> Notes</a>
  </li>
    <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#Exercise"><img src="/img/exercise.png" height="20" width="20"> Exercises</a>
  </li>
    <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#Video"><img src="/img/videos.png" height="20" width="20"> Videos</a>
  </li>&nbsp;&nbsp;&nbsp;
  <a type="danger" target="_blank" class="btn btn-outline-danger" href="class.php?Class='.$class.'&Subject='.$Subject.'&Lesson='.$Lesson.'">Check Out</a>
</ul>';
		echo '<form  method="post" name="myform">';
		
		echo '<input name="choose_class" type="hidden" value="'.$class.'"/>
		<input name="choose_subject" type="hidden" value="'.$Subject.'"/>
		<input name="choose_lesson" type="hidden" value="'.$Lesson.'"/>
		
		';
		
		echo '<div id="myTabContent" class="tab-content">';
		
		
		
		
		echo '<div class="tab-pane fade in active show" id="Information"><br>';
		
	
		        $content=$row['Information'];
				require("editor.php");
		
				echo '</div>';
				
						echo '<div class="tab-pane fade" id="Note"><br>';
						
						echo '    <textarea class="form-control" name="Noteee" id="Noteee" rows="10">';
						echo str_replace("<br />","",UnProtect2(($row["Note"])));
						echo '</textarea><br> <i>Write each notes per line.</i>';
					
						
				echo '</div>';

				#####################################
				
				echo '<div class="tab-pane fade" id="Exercise"><br>';
				
				
						echo '    <textarea class="form-control" name="Exerciseee" id="Exerciseee" rows="10">';
						
						if($row['Exercise']!=='') {
												        $array2 = preg_split('/SPnextSP/', $row['Exercise']);
				$array2 = str_replace('<br />',"\n", $array2);
				$array2 = str_replace('"',"", $array2);
				
						for($i=0;$i<count($array2);($i+=2)) {
							
						if($i==(count($array2)-2)) {
							
							echo UnProtect2($array2[$i])."\n";
				 echo rtrim(UnProtect2($array2[$i+1],"\n"));
							 break;
						} 
						
		        echo UnProtect2($array2[$i])."\n";
				 echo UnProtect2($array2[$i+1])."\n";
				 
						}
						}
						
						
						echo '</textarea><br> <i>Write question followed by answer per line. Give line break after each Q&A.</i>';
				echo '</div>';
				
				####################################
				
				echo '<div class="tab-pane fade" id="Video"><br>';

						echo '    <textarea class="form-control" name="Videoo" id="Videoo" rows="10">';
						
												        $array2 = preg_split('/SPnextSP/', $row['Video']);
				$array2 = str_replace('"',"", $array2);
						for($i=0;$i<count($array2);$i++) {	
						if($i==(count($array2)-1)) {
							 echo ($array2[$i]);
							 break;
						}
		        echo ($array2[$i])."\n";
				
						}
						
						echo '</textarea><br> <i>Write each videos link per line.</i>';
				echo '</div>';
				
				######################################
				
				
			
				
				echo '</div>';
				
				 echo '<center>
					<br>
					<input name="submit_update_edit" hidden />
					<button type="button" onclick="submitform()" class="btn btn-primary" name="submit_update_edit" id="submit_update_edit" style="width: 100%;">
							Update Edit
						</button>	
						
						</center>';
						
					echo '</form>';
                  
				
				
echo '</div></div><br><br>';
}
last:
?>
<script>
 function submitform()
        {
			
        var mysave = $('#editor').html();
        $('#hidden_information').val(mysave);
		document.myform.submit();
	}
	
</script>

