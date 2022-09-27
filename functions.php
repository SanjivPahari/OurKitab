<?PHP

######################################################

function Login()
{
    if(empty($_POST['Username']))
    {
        Error("UserName is empty!");
        return false;
    }
    
    if(empty($_POST['Password']))
    {
        Error("Password is empty!");
        return false;
    }
    
    $username = trim($_POST['Username']);
    $password = trim($_POST['Password']);
    
    if(!CheckLogin($username,$password))
    {
        return false;
    }
    
    session_start();
    
    $_SESSION['username'] = $username;

	 
    header("Location: /panel.php");
}

######################################################


function CheckLogin($username,$password)
{
          global $connect_user;
    $username = Protect($username);
	$password = Protect($password);
    $sql = "Select Username, Password, Status from userlist ".
        " where Username='$username' and Password='$password' ";
    
    $result = $connect_user->query($sql);
	
  if(!$result || mysqli_num_rows($result) <= 0)
    {
        Error("Username or Password doesn't match.");
        return false;
    }
	$row=$result->fetch_assoc();
    $_SESSION['Status'] = $row['Status'];
    return true;
}


######################################################

function Error($x) {
	echo '<br> <div class="alert alert-dismissible alert-danger">  <button type="button" class="close" data-dismiss="alert">&times;</button> '.$x.'</div>';
}
function Notice($x) {
	echo '<br> <div class="alert alert-dismissible alert-warning"> <button type="button" class="close" data-dismiss="alert">&times;</button> '.$x.'</div>';
}
function Success_Notice($x) {
	echo '<br> <div class="alert alert-dismissible alert-success"> <button type="button" class="close" data-dismiss="alert">&times;</button> '.$x.'</div>';
}

######################################################

function Protect($str)
    {
        if( function_exists( "mysql_real_escape_string" ) )
        {
              $ret_str = mysqli_real_escape_string( $str );
        }
        else
        {
              $ret_str = addslashes( $str );
        }
        return $ret_str;
    }
	
	
	function Protect2($str)
    {
        return htmlspecialchars($str);
    }
	
		function UnProtect2($str)
    {
        return htmlspecialchars_decode($str);
    }
	######################################################
	
	
	
	
	
	function Update_Full_Database() {
	
		
		global $connect_book;
		
		$total_post=count($_POST)-1;
		
		
		$columns=0;
		$sql = "SHOW COLUMNS FROM full_book";
$result = mysqli_query($connect_book,$sql);
while($row = mysqli_fetch_array($result)){
$columns++;
}

 $repeat=$total_post/9;
 



$query="";
for($i=1;$i<=$repeat;$i++) {
	
		$sql = "SHOW COLUMNS FROM full_book";
$result = mysqli_query($connect_book,$sql);
$coutt=0;

while($row = mysqli_fetch_array($result)){
	

if($coutt==8) {
$query=$query.$row['Field'].'="'.Protect($_POST[$i."_".$coutt]).'" ';
break;
} else {
$query=$query.$row['Field'].'="'.Protect($_POST[$i."_".$coutt]).'", ';
}

$coutt++;
	}
	
	
	$query="UPDATE full_book SET ".$query."WHERE uniq_id=".$_POST[$i."_0"];
	//echo $query;
	$result=$connect_book->query($query);
	//echo $result;
	if(!$result) {
	$ok='no';	
	}
	
	$query="";

	
}
	
if(isset($ok)&&$ok=='no') {
	return "Something Went Wrong!";
} else {
return "Update Successful!";
}
	}
	
	######################################################
		
	function submit_update_user() {
	
		
		global $connect_user;
		
		$total_post=count($_POST)-1;
		
		
		$columns=0;
		$sql = "SHOW COLUMNS FROM userlist";
$result = mysqli_query($connect_user,$sql);
while($row = mysqli_fetch_array($result)){
$columns++;
}

 $repeat=$total_post/3;
 
$query="";
for($i=1;$i<=$repeat;$i++) {
	
		$sql = "SHOW COLUMNS FROM userlist";
$result = mysqli_query($connect_user,$sql);
$coutt=0;

while($row = mysqli_fetch_array($result)){
	

if($coutt==2) {
$query=$query.$row['Field'].'="'.Protect($_POST["user_".$i."_".$coutt]).'" ';
break;
} else {
$query=$query.$row['Field'].'="'.Protect($_POST["user_".$i."_".$coutt]).'", ';
}

$coutt++;
	}
	
	
	$query="UPDATE userlist SET ".$query."WHERE `Username`='".$_POST['user_'.$i."_0"]."'";
	//echo $query;
	$result=$connect_user->query($query);
	//echo $result;
	if(!$result) {
	$ok='no';	
	}
	
	$query="";

	
}
	
if(isset($ok)&&$ok=='no') {
	return "Something Went Wrong!";
} else {
return "Update Successful!";
}
	}
		###########################################################################################
		
	function submit_insert_new_user() {
		global $connect_user;
		$Username=Protect($_POST['Username']);
		$Password=Protect($_POST['Password']);
		$Status=Protect($_POST['Status']);
		
	$sql = "INSERT INTO `userlist` (`Username`, `Password`, `Status`)
VALUES ('$Username', '$Password', '$Status')";

	if ($connect_user->query($sql) === TRUE) {
    return "New User created Successfully!";
} else {
    return "Something Went Wrong!";
}
	}
	###########################################################################################
	
	function submit_insert_new_class() {
		
				if(!isset($_POST['uniq_id'])||!isset($_POST['class_id'])||!isset($_POST['class_name'])) {
			return "Informations are Missing!!";
		}
		if($_POST['uniq_id']==''||$_POST['class_id']==''||$_POST['class_name']=='') {
			return "Informations are Missing!";
		}
		
		global $connect_book;
		$uniq_id=Protect($_POST['uniq_id']);
		$class_id=Protect($_POST['class_id']);
		$class_name=Protect($_POST['class_name']);
		
	$sql = "INSERT INTO `full_book` (`uniq_id`, `class_id`, `Class`, `subject_id`,`Subject`,`chapter_id`,`Chapter`,`lesson_id`,`Lesson`,`Information`,`Note`, `Exercise`, `Video`)
VALUES ('$uniq_id', '$class_id', '$class_name', '','','','','','','','','','')";

	if ($connect_book->query($sql) === TRUE) {
    return "New Class created Successfully!";
} else {
    return "Something Went Wrong!";
}
	}
	

	
	######################################################
	
	
		function submit_insert_new_subject() {
		global $connect_book;
		if(!isset($_POST['choose_class'])||!isset($_POST['subject_id'])||!isset($_POST['subject_name'])) {
			return "Informations are Missing!!";
		}
		if($_POST['choose_class']==''||$_POST['subject_id']==''||$_POST['subject_name']=='') {
			return "Informations are Missing!";
		}
		$class_name=Protect($_POST['choose_class']);
		$subject_id=Protect($_POST['subject_id']);
		$subject_name=Protect($_POST['subject_name']);
		$uniq_id=rand(99,99999);
		
		$query="SELECT DISTINCT `class_id` FROM `full_book` WHERE `Class`='$class_name'";
		$result=$connect_book->query($query);
		$result = $result->fetch_assoc();
		$class_id=$result['class_id'];
		
	$sql = "INSERT INTO `full_book` (`uniq_id`, `class_id`, `Class`, `subject_id`,`Subject`,`chapter_id`,`Chapter`,`lesson_id`,`Lesson`,`Information`,`Note`, `Exercise`, `Video`)
VALUES ('$uniq_id', '$class_id', '$class_name', '$subject_id','$subject_name','','','','','','','','')";

	if ($connect_book->query($sql) === TRUE) {
    return "New Subject created Successfully!";
} else {
    return "Something Went Wrong!";
}
	}
	
	
	
	
	######################################################
	
	function submit_insert_new_chapter() {
		global $connect_book;
		if(!isset($_POST['choose_class'])||!isset($_POST['choose_subject'])||!isset($_POST['chapter_id'])||!isset($_POST['chapter_name'])) {
			return "Informations are Missing!!";
		}
		if($_POST['choose_class']==''||$_POST['choose_subject']==''||$_POST['chapter_id']==''||$_POST['chapter_name']=='') {
			return "Informations are Missing!";
		}
		$class_name=Protect($_POST['choose_class']);
		$subject_name=Protect($_POST['choose_subject']);
		$chapter_id=Protect($_POST['chapter_id']);
		$chapter_name=Protect($_POST['chapter_name']);
		
		$uniq_id=rand(99,99999);
		
		$query="SELECT DISTINCT `subject_id`,`class_id` FROM `full_book` WHERE `Class`='$class_name' AND `Subject`='$subject_name'";
		$result=$connect_book->query($query);
		$result = $result->fetch_assoc();
		$class_id=$result['class_id'];
			$subject_id=$result['subject_id'];
			
	$sql = "INSERT INTO `full_book` (`uniq_id`, `class_id`, `Class`, `subject_id`,`Subject`,`chapter_id`,`Chapter`,`lesson_id`,`Lesson`,`Information`,`Note`, `Exercise`, `Video`)
VALUES ('$uniq_id', '$class_id', '$class_name', '$subject_id','$subject_name','$chapter_id','$chapter_name','','','','','','')";

	if ($connect_book->query($sql) === TRUE) {
    return "New Chapter created Successfully!";
} else {
    return "Something Went Wrong!";
}
	}
	
	######################################################
	
	
	function submit_insert_new_lesson() {
		global $connect_book;
		if(!isset($_POST['choose_class'])||!isset($_POST['choose_subject'])||!isset($_POST['choose_chapter'])||!isset($_POST['lesson_id'])||!isset($_POST['lesson_name'])) {
			return "Informations are Missing!!";
		}
		if($_POST['choose_class']==''||$_POST['choose_subject']==''||$_POST['choose_chapter']==''||$_POST['lesson_id']==''||$_POST['lesson_name']=='') {
			return "Informations are Missing!";
		}
		$class_name=Protect($_POST['choose_class']);
		$subject_name=Protect($_POST['choose_subject']);
		$chapter_name=Protect($_POST['choose_chapter']);
		$lesson_id=Protect($_POST['lesson_id']);
		$lesson_name=Protect($_POST['lesson_name']);
		
		$uniq_id=rand(99,99999);
		
		$query="SELECT DISTINCT `subject_id`,`class_id`,`chapter_id` FROM `full_book` WHERE `Class`='$class_name' AND `Subject`='$subject_name' AND `Chapter`='$chapter_name'";
		$result=$connect_book->query($query);
		$result = $result->fetch_assoc();
		
		$class_id=$result['class_id'];
			$subject_id=$result['subject_id'];
			 $chapter_id=$result['chapter_id'];
			
	$sql = "INSERT INTO `full_book` (`uniq_id`, `class_id`, `Class`, `subject_id`,`Subject`,`chapter_id`,`Chapter`,`lesson_id`,`Lesson`,`Information`,`Note`, `Exercise`, `Video`)
VALUES ('$uniq_id', '$class_id', '$class_name', '$subject_id','$subject_name','$chapter_id','$chapter_name','$lesson_id','$lesson_name','','','','')";

	if ($connect_book->query($sql) === TRUE) {
    return "New Lesson created Successfully!";
} else {
    return "Something Went Wrong!";
}
	}
	
	######################################################
	
	function submit_update_edit() {
		global $connect_book;
		if(!isset($_POST['choose_class'])||!isset($_POST['choose_subject'])||!isset($_POST['choose_lesson'])) {
			return "Informations are Missing!!";
		}
		if($_POST['choose_class']==''||$_POST['choose_subject']==''||$_POST['choose_lesson']=='') {
			return "Informations are Missing!";
		}
		
		$class_name=Protect($_POST['choose_class']);
		$subject_name=Protect($_POST['choose_subject']);
		$choose_lesson=Protect($_POST['choose_lesson']);
		
	$Information=Protect($_POST['hidden_information']);
	$Exercise=Protect($_POST['Exerciseee']);
	
		 $Note=Protect(nl2br($_POST["Noteee"]));
		 
		 #####################################################################################
		$Video=str_replace(" ","", Protect2($_POST["Videoo"]));
		 $array2 = preg_split('/\n/', $Video);
		// print_r($array2);
		 $count= count($array2);
		 $Video="";
		 for($i=0;$i<=$count;$i++) {
			 if($i==$count-1) {
				 $Video=$Video.'"'. str_replace(PHP_EOL, '',$array2[$i]).'"';
				 break;
			 }
			 $Video=$Video.'"'.rtrim(ltrim(str_replace(PHP_EOL, '',$array2[$i]))).'"SPnextSP';
			 
		 }
		
		##########################################################################################
		
$exercisearray=preg_split("/(<[^>]*?br[^>]*?>\s*){2,}/i",nl2br($Exercise));

		$FinalExercise="";
		
		$count=count($exercisearray);
		
			$Part_Number=-1;
			
		foreach ($exercisearray as $Part) {
			
			$Part_Number++;
			$Piece=preg_split("/(<[^>]*?br[^>]*?>\s*)/i",$Part);
			
			$Piece_Number=0;
			###########################################
			foreach ($Piece as $Piece_Part) {
				
				if($Piece_Number==0) {
				$FinalExercise=$FinalExercise.'"'.Protect2($Piece_Part).'"SPnextSP"';
				$Piece_Number=1;
				} else {
						$FinalExercise=$FinalExercise.Protect2($Piece_Part).'<br />';
				}		
				
			}
			##########################################################################
			if($Part_Number==($count-1)) {
				$FinalExercise=$FinalExercise.'"';
			} else {
			
				$FinalExercise=$FinalExercise.'"SPnextSP';
			}
		
			
		}
		$FinalExercise=Protect($FinalExercise);
		#####################################################################################
		
		
		$sql="UPDATE `full_book` SET `Information` = '$Information', `Note`= '$Note', `Video`= '$Video', `Exercise`='$FinalExercise' WHERE `Class` = '$class_name' AND `Subject`='$subject_name' AND `Lesson`='$choose_lesson'";

	if ($connect_book->query($sql) === TRUE) {
    return "Course updated Successfully!";
} else {
    return "Something Went Wrong!";
}

//print_r($_POST);
	}
		######################################################
	
	
		function update_notice() {
		global $connect_book;
file_put_contents("notice.txt",$_POST['notice']);
return ("Notice Successfully Updated!");
	}
	
	######################################################
	
	
		function del_row() {
		global $connect_book;
		$row=Protect($_GET['del_row']);
		
	$sql = "DELETE FROM `full_book` WHERE `uniq_id`=$row";

	if ($connect_book->query($sql) === TRUE) {
    return "Row Deleted Successfully!";
} else {
    return "Something Went Wrong!";
}
	}
	
	######################################################
	
	
		function del_user() {
		global $connect_user;
		$row=Protect($_GET['del_user']);
		
	$sql = "DELETE FROM `userlist` WHERE `Username`='$row'";

	if ($connect_user->query($sql) === TRUE) {
    return "User Deleted Successfully!";
} else {
    return "Something Went Wrong!";
}
	}
	
	
	######################################################
	
?>