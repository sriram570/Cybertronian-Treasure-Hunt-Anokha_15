<?php
session_start();
require_once 'connect.php';
if (isset($_SESSION['username']))
{
	$level = $_SESSION['level_no'];
	$image = "question/q".$level.".jpg" ;
	if ( isset( $_POST['Submit1'] ) ) 
	{
		$ans = $_POST['user_answer'];
		$sql = "SELECT * FROM `questions` WHERE level_no='$level' ";
		$result = mysql_query($sql) or die(mysql_error());
		$row = mysql_fetch_assoc($result);
		$level_limit = mysql_query("select count(1) FROM `questions` ");
                $limit = mysql_fetch_array($level_limit);
                $total = $limit[0];
                if ($row['answer'] == $ans && ($_SESSION['level_no'] + 1) <= $total)
		{
			
			$_SESSION['level_no'] = $_SESSION['level_no'] + 1;
			$_SESSION['score'] = $_SESSION['score'] + $row['score'];
			$tscore = $_SESSION['score'];
			$tlevel = $_SESSION['level_no'];
			$tname = $_SESSION['username'];
                        $image = "question\q".$tlevel.".jpg" ;
			$update_sql = "update users set score='$tscore',level_no='$tlevel', date_time = now()  where username='$tname'";
			$returnval = mysql_query($update_sql);
                        header('Location: success.php');

			
		}
		elseif ( $total < ($_SESSION['level_no'] + 1))
                {
                        header('Location: lastpage.php');
                        //echo "\nOOPS!! you are too fast!";
                }

		else
		{
			header('Location: wrong.php');
		}
		
	}
	else 
	{
	}
}
?>
<html>
<head>
<title>Homepage</title>
<link rel="icon" href="anokha-logo.ico" type="image/x-icon">
<link href="homepagestyle.css" rel="stylesheet">
<style>
</style>
</head>
<body>
<header>
<h4>GREETINGS, EARTHLING<span class="greetings">SCORE: <?php echo $_SESSION['score']; ?></span><br><br><a href="lb.php" class="links">LEADERBOARD</a><span style="float:right"><a href="logout.php" class="links">LOGOUT</a></span></h4>
<!--<div class="sample">
 <ul id = "navbar">
                <li><a href = "leaderborad2.php"><div class='sideMenu'>Leaderboard</div></a></li>

        </ul></div>-->
<!--<div class="lo">
<a href="logout.php">
<img src="logout.png" style="height:50px">
</a></div>-->
</header>
<h1>LEVEL : <?php echo $_SESSION['level_no']; ?></h1>
<form action='' method='POST'>
<div class="question" align="center" style:"position:relative">
<img src="<?php echo $image; ?>" style='width:400px;height:400px'>
<br><br><br>
<input id='answer' type='text' name='user_answer' placeholder=' Answer' align='center'/>
<br><br>
<input class='btn register' type='submit' name='Submit1' value='Submit' />
</div> 
<!--<div class="lo">
<a href="logout.php">
<img src="logout.png" style="height:50px">
</a>
</div>-->
</body>
