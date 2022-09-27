<?PHP
require("functions.php");

require("db-connect.php");

if(isset($_GET['keyword'])&&$_GET['keyword']!=='') {
$search=htmlspecialchars(htmlentities(trim(Protect($_GET['keyword']))));
$title="Search : ".$search;
require("header.php");
?>

<hr>
<h1>Search: <?PHP echo $search; ?></h1>
<hr>
<div class="card border-success">
  <div class="card-body">
  
<ul class="list-group">
  <?PHP
  if(isset($search)) {
  $sql="select * from `full_book` where `Class` like '%$search%' || `Subject` like '%$search%' || `Chapter` like '%$search%' || `Lesson` like '%$search%' || `Information` like '% $search %' || `Note` like '% $search %' || `Exercise` like '% $search %' ORDER BY `class_id`,`subject_id`,`chapter_id`,`lesson_id`";

        $res=$connect_book->query($sql);
echo '<div class="list-group"><font size="5">';
if ($res->num_rows <= 0) {
       	echo 'No Result Found!';
} else {
	 while($row=$res->fetch_assoc()){
		 if(($row['Lesson']!=='')&&!preg_match('/Coming Soon/',$row['Lesson'])) {
			echo '<a href="/class.php?Class='.$row["Class"].'&Subject='.$row["Subject"].'&Lesson='.$row["Lesson"].'" class="list-group-item list-group-item-action">';
            echo '<span class="badge badge-primary">'.$row["Class"].'</span>';
            echo ' /  <span class="badge badge-info">'.$row["Subject"].'</span>';
			   echo ' /  <span class="badge badge-warning">'.$row["Lesson"].'</span>';
			   echo '</a>';
		 }
            }
}

echo '</font></div>';			
  } 
  ?> 
</ul>

  </div>
</div>

<?PHP
}
else {
	$title='Error!';
	require("header.php");
	require("error.php");
	
}
?>
	

<?PHP
require("footer.php");
?>