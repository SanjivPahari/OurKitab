<?PHP
$title="E-Learning Nepal | Home";
require("header.php");
require("db-connect.php");
require("functions.php");
?>
<?php
$myfile = file_get_contents("notice.txt");
if(isset($myfile)&&$myfile!=='') {
	Notice('<img src="/img/lightbulb.gif" height="40" width="40"> '.$myfile);
}
?>

<div class="jumbotron">
  <h1 class="display-3">  E-Learning Nepal <img src="/img/learn.png" height="100" width="100"></h1>
  <p>E-Learning Nepal is an online E-Learning site made with purpose of making learning simple, easy and accessible. </p>
 <a class="btn btn-info btn-lg" href="/about.php"><img src="/img/information.png" height="20" width="20"> Learn more</a>
</div>
<h2><img src="/img/courses.png" height="40" width="40"> Courses </h2>
<hr>
<style>
.list-group-item {
    padding: 1px 3px;
}
</style>
<?PHP
	
	$sql = "SELECT DISTINCT Class, class_id FROM `full_book` ORDER BY `class_id` ASC";
$result = $connect_book->query($sql);
$i=0;
echo '<div class="row">';
    while($row = $result->fetch_assoc()) {
		$i=$i+1;
		
        echo '<div class="col-md-4"><div class="card border-success">
  <h4 class="card-header"><img src="/img/book.png" height="20" width="20"> '.$row["Class"].'</h4>';
  
  echo '<div class="card-body">';
  
  /////////////////////////////////////////
  
  $sql2 = "SELECT DISTINCT `Subject` FROM `full_book` WHERE `class_id` = ".$row['class_id']." ORDER BY `subject_id` ASC";
$result2 = $connect_book->query($sql2);
echo '<div class="list-group" >';
if ($result2->num_rows > 0) {
    while($row2 = $result2->fetch_assoc()) {
		if($row2['Subject']!==''&&!preg_match('/Coming Soon/',$row2['Subject'])) {
        echo '<a href="/class.php?Class='.$row['Class'].'&Subject='.$row2['Subject'].'" class="list-group-item list-group-item-action"><h4><img src="/img/tick3.png" height="20" width="20">   <span class="badge badge-primary">'.$row2["Subject"].' </span></h4></a>';
		}
	}
} else {
    echo "Coming Soon...";
}
echo '</div>';
////////////////////////////////////////

  echo '</div></div></div>';
		
		if($i==3) {
			echo '</div><br> <div class="row">';
			$i=0;
		}
    }
	echo '</div>';

?>

<?PHP
require("footer.php");
?>