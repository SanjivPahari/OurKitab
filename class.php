<?PHP
$title="E-Learning Nepal | Home";
require("header.php");
require("db-connect.php");
require("functions.php");
?>

<?PHP 
if((!isset($_GET['Class']))||(isset($_GET['Class'])&&$_GET['Class']=='')||(isset($_GET['Subject'])&&$_GET['Subject']=='')||(isset($_GET['Lesson'])&&$_GET['Lesson']=='')) {
	$show='';
	 require("error.php");
	require("footer.php");
	die();
}
if(isset($_GET['Class'])) {
	$class=Protect($_GET['Class']);
	$query="SELECT DISTINCT `Subject`, `Class` FROM `full_book` WHERE `Class` = '".$class."' ORDER BY `subject_id` ASC";
	$result = $connect_book->query($query);
	if ($result->num_rows <= 0) {
    require("error.php");
	require("footer.php");
	die();
}
$show='class';
}

if(isset($_GET['Class'])&&isset($_GET['Subject'])) {
	$class=Protect($_GET['Class']);
	$Subject=Protect($_GET['Subject']);
	$query="SELECT DISTINCT `Subject`, `Class`, `Chapter`  FROM `full_book` WHERE `Class` = '".$class."' AND `Subject` = '".$Subject."' ORDER BY `chapter_id` ASC";
	$result = $connect_book->query($query);
	if ($result->num_rows <= 0) {
    require("error.php");
	require("footer.php");
	die();
}
$show='class_subject';
}

if(isset($_GET['Class'])&&isset($_GET['Subject'])&&isset($_GET['Lesson'])) {
	$class=Protect($_GET['Class']);
	$Subject=Protect($_GET['Subject']);
	$Lesson=Protect($_GET['Lesson']);
	$query="SELECT * FROM `full_book` WHERE `Class` = '".$class."' AND `Subject` = '".$Subject."' AND `Lesson` = '".$Lesson."'";
	$result = $connect_book->query($query);
	if ($result->num_rows <= 0) {
    require("error.php");
	require("footer.php");
	die();
}
$show='class_subject_lesson';
}
?>


<br>
<div class="row">
<div class="col-md-1">
</div>

		<div class="col-md-10">
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="/">Home</a></li>
  
  <?PHP if(isset($_GET['Class'])) {
  echo '<li class="breadcrumb-item"><a href="/class.php?Class='.$_GET['Class'].'">'.$_GET['Class'].'</a></li>';
  }
  ?>
  
   <?PHP if(isset($_GET['Subject'])) {
    echo '<li class="breadcrumb-item"><a href="/class.php?Class='.$_GET['Class'].'&Subject='.$_GET['Subject'].'">'.$_GET['Subject'].'</a></li>';
	 }
  ?>
	    <?PHP if(isset($_GET['Lesson'])) {
    echo '<li class="breadcrumb-item active">'.$_GET['Lesson'].'</li>';
	 }
  ?>
	  
</ol>
</div>

<div class="col-md-1">
</div>
</div>


<div class="row">
<div class="col-md-1">
</div>
<div class="col-md-10">
<?PHP
switch($show) {
	
	case "class":
	echo '<h1> Subjects</h1><hr color="red">';
    while($row = $result->fetch_assoc()) {
		if($row['Subject']!==''&&!preg_match('/Coming Soon/',$row['Subject'])) {
                echo '<a href="/class.php?Class='.$row['Class'].'&Subject='.$row['Subject'].'" class="list-group-item list-group-item-action"><h4><span class="badge badge-pill badge-warning">'.$row["Subject"].'</span></h4></a>';
		}
    }
	break;
	
	##############################
	case "class_subject":
    while($row = $result->fetch_assoc()) {
if(($row['Chapter']!=='')&&!preg_match('/Coming Soon/',$row['Chapter'])) {
	
		echo '<div class="list-group">';
		
        echo '<a href="" class="list-group-item  list-group-item-action active">'.$row['Chapter'].'</a>';		
		
		$query2="SELECT DISTINCT `Lesson` FROM `full_book` WHERE `Class` = '".$class."' AND `Subject` = '".$Subject."' AND `Chapter` = '".$row['Chapter']."' ORDER BY `lesson_id` ASC";
	
	$result2 = $connect_book->query($query2);
 while($row2 = $result2->fetch_assoc()) {
	 
	 		if(($row2['Lesson']!=='')&&!preg_match('/Coming Soon/',$row2['Lesson'])) {
		
		
	  echo '<a href="/class.php?Class='.$_GET['Class'].'&Subject='.$_GET['Subject'].'&Lesson='.$row2['Lesson'].'" class="list-group-item list-group-item-action">'.$row2['Lesson'].'</a>';	
			}
 }
echo '</div><br>';
}
    }
	
	
	break;
	
	
	################################
	case "class_subject_lesson":
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
  </li>';
  
  if(isset($_SESSION['username'])) {
  echo '&nbsp;&nbsp;&nbsp;
 <form action="/panel.php" method="post" target="_blank">
 <input name="choose_class" type="hidden" value="'.$_GET['Class'].'"/>
		<input name="choose_subject" type="hidden" value="'.$_GET['Subject'].'"/>
		<input name="choose_lesson" type="hidden" value="'.$_GET['Lesson'].'"/>
 <input name="submit_edit" type="hidden"/>
 <button type="danger" class="btn btn-outline-danger">Edit</button>
 </form> ';
  }
 
 
echo '</ul>';
		
		echo '<div id="myTabContent" class="tab-content">';
		
		echo '<div class="tab-pane fade in active show" id="Information"><br>';
		
		if($row['Information']!=='') {
		        echo $row['Information'];
		} else {
			echo 'Coming Soon....';
		}
				echo '</div>';
				
						echo '<div class="tab-pane fade" id="Note"><br>';
						
						if($row['Note']!=='') {
							
						$array = explode("<br />", $row['Note']);
						echo '<ul class="list-group">';
						foreach($array as $key) {
							if($key!==''&&$key!=="\n"&&$key!=="<br />"&&$key!=="  "&&strlen($key)>5) {
		        echo ' <li class="list-group-item"> &#9679; '.$key.'</li>';
							}
						}
						
				echo '</ul>';
								
				} else {
			echo 'Coming Soon....';
		}
				echo '</div>';

				#####################################
				
				echo '<div class="tab-pane fade" id="Exercise"><br>';
						if($row['Exercise']!=='') {
		        

		        $array = preg_split('/SPnextSP/', $row['Exercise']);
				$array = str_replace('"',"", $array);
						
						for($i=0;$i<count($array);($i+=2)) {
							echo '<div class="list-group">';
		        echo '  <a href="#" class="list-group-item list-group-item-action" data-toggle="collapse" data-target="#ans_'.$i.'"> &#9632; '.($array[$i]).'</a>';
				echo ' <div class="card border-info" ><div class="collapse" id="ans_'.$i.'" ><div class="card-body"> &#9654; '.($array[$i+1]).'</div></div></div>';
				echo '</div><br>';
						}
						
				
				
						} else {
			echo 'Coming Soon....';
		}
				echo '</div>';
				####################################
				
				echo '<div class="tab-pane fade" id="Video"><br>';
				if($row['Video']!=='') {
						        $array2 = preg_split('/SPnextSP/', $row['Video']);
				$array2 = str_replace('"',"", $array2);
						for($i=0;$i<count($array2);$i++) {	
						
parse_str( parse_url( $array2[$i], PHP_URL_QUERY ), $link );
	if(isset($link['v'])) {
		        echo '<iframe style="overflow:hidden;position:relative;width:100%;height:500px;"  src="https://www.youtube.com/embed/'.$link['v'].'" frameborder="0" gesture="media" allowfullscreen></iframe> <br> <a href="'.$array2[$i].'" target="_blank" class="btn btn-outline-danger">Watch on YouTube</a><hr color="green">';
							}
						}
						} else {
			echo 'Coming Soon....';
		}
						
				echo '</div>';
				
				######################################
				
				
				
				
				echo '</div>';
				
				
				
echo '</div></div>';

		
	
	break;
	
	}

?>

  
  
</div>
<div class="col-md-1">
</div>
</div>


<?PHP
require("footer.php");
?>