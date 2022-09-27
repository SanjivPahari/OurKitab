<hr>
<h1>Insert New Course</h1>
<hr>
<div class="row">

<div class="col-md-3">

<div class="card">
  <h3 class="card-header">New Class</h3>
  <div class="card-body">
<form role="form" method="post" action="/panel.php">
<div class="form-group" >
<label for="uniq_id">
								Uniq Id
							</label>
							<input class="form-control" name="uniq_id" placeholder="Unique Id" type="number" value="<?PHP if(isset($_POST['submit_insert_new_class'])) { echo $_POST['uniq_id']; } else { echo rand(99,999999); } ?>">
</div>
<div class="form-group" >
<label for="class_id">
								Class Id
							</label>
							<input class="form-control" name="class_id" placeholder="Class Id" type="number"  value="<?PHP if(isset($_POST['submit_insert_new_class'])) { echo $_POST['class_id']; } ?>">
</div>
<div class="form-group" >
<label for="class_name">
								Class Name
							</label>
							<input class="form-control" name="class_name" placeholder="Class Name" value="<?PHP if(isset($_POST['submit_insert_new_class'])) { echo $_POST['class_name']; } ?>">
</div>
<div class="form-group" >
<button type="submit" class="btn btn-primary" name="submit_insert_new_class" style="width: 100%;">
							Insert
						</button>	
			</div>			
							
</form>
</div>
</div>

</div>





<div class="col-md-3">

<div class="card">
  <h3 class="card-header">New Subject</h3>
  <div class="card-body">
<form role="form" method="post" action="/panel.php">
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

<div class="form-group" >
<label for="subject_id">
								Subject Id
							</label>
							<input class="form-control" name="subject_id" placeholder="Subject Id" type="number"  value="<?PHP if(isset($_POST['submit_insert_new_subject'])) { echo $_POST['subject_id']; } ?>">
</div>


<div class="form-group" >
<label for="subject_name">
								Subject Name
							</label>
							<input class="form-control" name="subject_name" placeholder="Subject Name"  value="<?PHP if(isset($_POST['submit_insert_new_subject'])) { echo $_POST['subject_name']; } ?>">
</div>
<div class="form-group" >
<button type="submit" class="btn btn-primary" name="submit_insert_new_subject" style="width: 100%;">
							Insert
						</button>	
			</div>			
							
</form>
</div>
</div>

</div>




<div class="col-md-3">

<div class="card">
  <h3 class="card-header">New Chapter</h3>
  <div class="card-body">
<form role="form" method="post" action="/panel.php">
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
	  <br>
	  <button type="submit" class="btn btn-outline-primary" name="submit_insert_new_chapter_show_subjects" style="width: 100%;">Show Subjects</button>
</div>

<?PHP
if(isset($_POST['choose_class'])) { 
?>
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
<?PHP }
?>
<div class="form-group" >
<label for="chapter_id">
								Chapter Id
							</label>
							<input class="form-control" name="chapter_id" placeholder="Chapter Id" type="number"  value="<?PHP if(isset($_POST['submit_insert_new_chapter'])) { echo $_POST['chapter_id']; } ?>">
</div>


<div class="form-group" >
<label for="chapter_name">
								Chapter Name
							</label>
							<input class="form-control" name="chapter_name" placeholder="Chapter Name"  value="<?PHP if(isset($_POST['submit_insert_new_chapter'])) { echo $_POST['chapter_name']; } ?>">
</div>
<div class="form-group" >
<button type="submit" class="btn btn-primary" name="submit_insert_new_chapter" style="width: 100%;">
							Insert
						</button>	
			</div>			
							
</form>
</div>
</div>

</div>


<div class="col-md-3">

<div class="card">
  <h3 class="card-header">New Lesson</h3>
  <div class="card-body">
<form role="form" method="post" action="/panel.php">

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
	  <br>
	  	  <button type="submit" class="btn btn-outline-primary" name="submit_insert_new_lesson_show_subjects" style="width: 100%;">Show Subjects</button>

</div>

<?PHP
if(isset($_POST['choose_class'])) { 
?>
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
	   <br>
	  	  <button type="submit" class="btn btn-outline-primary" name="submit_insert_new_lesson_show_chapter" style="width: 100%;">Show Chapters</button>
</div>
<?PHP }
?>


<?PHP
if(isset($_POST['choose_subject'])) { 
?>
<div class="form-group" >
<label for="choose_chapter">
								Choose Chapter
							</label>
							<select multiple="" class="form-control" id="choose_chapter" name="choose_chapter">
							
       <?PHP
	    $class=$_POST['choose_class'];
	   $subject=$_POST['choose_subject'];
							 $sql2 = "SELECT DISTINCT `Chapter` FROM `full_book` WHERE `Class` = '$class' AND `Subject` = '$subject'  ORDER BY `chapter_id` ASC";
$result2 = $connect_book->query($sql2);
echo '<div class="list-group" >';
if ($result2->num_rows > 0) {
    while($row2 = $result2->fetch_assoc()) {
        echo '<option';
		if(isset($_POST['choose_chapter'])&&$_POST['choose_chapter']==$row2['Chapter']) { echo ' selected ';  }
		echo '>';
		echo $row2['Chapter'];
		echo '</option>';
    }
} else {
    echo "<option>Coming Soon...</option>";
} 
echo '</div>';
?>

      </select>
</div>
<?PHP }
?>



<div class="form-group" >
<label for="lesson_id">
								Lesson Id
							</label>
							<input class="form-control" name="lesson_id" placeholder="Lesson Id" type="number"  value="<?PHP if(isset($_POST['submit_insert_new_lesson'])) { echo $_POST['lesson_id']; } ?>">
</div>
<div class="form-group" >
<label for="lesson_name">
								Lesson Name
							</label>
							<input class="form-control" name="lesson_name" placeholder="Lesson Name" value="<?PHP if(isset($_POST['submit_insert_new_lesson'])) { echo $_POST['lesson_name']; } ?>">
</div>
<div class="form-group" >
<button type="submit" class="btn btn-primary" name="submit_insert_new_lesson" style="width: 100%;">
							Insert
						</button>	
			</div>			
							
</form>
</div>
</div>

</div>



</div>