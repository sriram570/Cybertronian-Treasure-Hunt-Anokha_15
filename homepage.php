<?php
session_start();
require_once 'connect.php';
if (isset($_SESSION['username']))
{

	$level = $_SESSION['level_no'];
	if ( isset( $_POST['Submit1'] ) ) 
	{
		$ans = $_POST['user_answer'];
		#echo $_POST['user_answer'];
		$sql = "SELECT * FROM `questions` WHERE level_no='$level' ";
		$result = mysql_query($sql) or die(mysql_error());
		$row = mysql_fetch_assoc($result);
		#echo $row['answer'];
		if ($row['answer'] == $ans)
		{
			
			$_SESSION['level_no'] = $_SESSION['level_no'] + 1;
			$_SESSION['score'] = $_SESSION['score'] + $row['score'];
			$tscore = $_SESSION['score'];
			$tlevel = $_SESSION['level_no'];
			$tname = $_SESSION['username'];
                        $update_sql = "update users set score='$tscore',level_no='$tlevel'  where username='$tname'";
			$returnval = mysql_query($update_sql);
			if($returnval)
			{
				echo "congrats. go to next lvev";
			}
			else
			{
				echo "connectoin problems";
			}
		}
		else
		{
			echo "\nTry Again";
		}
		
	}
	else 
	{
		echo "\nCummon..Start the Game!!!";
	}

	echo "Hi ".$_SESSION['username']." !!!";
	echo "LEVEL : ".$_SESSION['level_no']."\n";
	echo "\nScore : ".$_SESSION['score'];

	echo "<a href='logout.php'>Logout</a>";
	echo "<form action='' method='POST'>";
	//echo "<img src='question/q1.jpg' alt='image1' style='width:304px;height:228px>";
	echo "<br></br>";
	echo "<input id='answer' type='text' name='user_answer' placeholder=' Answer'/>";
	echo "<input class='btn register' type='submit' name='Submit1' value='Submit' />";
}	
	else
	{
	    header('Location:login.php');
	}
?>
