
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
}
?>
<html>

<title>Home page</title>
<style>
@font-face{
	font-family: 'TreasureHunt';
	src: url(batmfa__.ttf);
	}
        p{
                float: right;
        }
	h1{ 
		margin:20px 0 0 0;
		text-align: center;
		font-family: 'TreasureHunt';
	}
	body{ 
		
		background: linear-gradient(bottom, rgba(0,0,0,1), rgba(0,0,0,.4));
  		background: -webkit-linear-gradient(bottom, rgba(0,0,0,1), rgba(0,0,0,.4));
 		background: -moz-linear-gradient(bottom, rgba(0,0,0,1), rgba(0,0,0,.4));
		background-size:black;
		background-repeat: no-repeat;		
	}	
	.question{
		float: center;
	}		
		
</style>
<body>

<p>Hi <?php echo $_SESSION['username'];?></p>
<h1>LEVEL : <?php echo $_SESSION['level_no']; ?></h1>
<p>Score : <?php echo $_SESSION['score']; ?></p>
<a href='logout.php'>Logout</a>;
<a href='leaderboard.php'>Leaderboard</a>;
<form action='' method='POST'>
<div class="question">
<img src='q1.jpg' alt='image1' style='width:304px;height:228px'>;
</div>
<br></br>
<input id='answer' type='text' name='user_answer' placeholder=' Answer'/>;
<input class='btn register' type='submit' name='Submit1' value='Submit' />;
</body>

