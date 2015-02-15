<?php
session_start();
require_once 'connect.php';
if (isset($_SESSION['username']))
{
  function keymaker($id)
        {
                $secretkey='hfaa1h1awhqa3sdoyasw7e2sho3mqeojemdw09jdsklafjp1qwoijedmp03w9eiojdma';
                $key=md5($id.$secretkey);
                return $key;
        }
	$level = $_SESSION['level_no'];
	$image = "question/q".$level.".jpg" ;
	$hintsql = "SELECT * FROM `questions` WHERE level_no='$level' ";
	$hintresult = mysql_query($hintsql) or die(mysql_error());
	$hintrow = mysql_fetch_assoc($hintresult);
	$hint1 = $hintrow['hint'];
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
                        header('Location: success.php?id='.$ans.'&&key='.keymaker($ans).'');

			
		}
		elseif ( $total < ($_SESSION['level_no'] + 1))
                {
                        header('Location: lastpage.php');
                        //echo "\nOOPS!! you are too fast!";
                }

		else
		{
			header('Location: wrong.php?id='.$ans.'&&key='.keymaker($ans).'');
		}
		
	}
	else 
	{
		//header('Location: homepage.php');
	}
}
else
{
	header('Location: login.php');
}

?>
<html>
<head>
<script src="jquery.js" type="text/javascript"></script>
<script src="min.js" type="text/javascript"></script>
    <script>
	var ans = "<?php echo $hint1; ?>";
	jQuery(function($){
   	$("#x").mask(ans);
	});
	 
    </script>
<title>Homepage</title>
<link rel="icon" href="anokha-logo.ico" type="image/x-icon">
<link href="homepagestyle.css" rel="stylesheet">
<style>
</style>
</head>
<body>
<header>
<h4>GREETINGS, EARTHLING<span class="greetings">SCORE: <?php echo $_SESSION['score']; ?></span><br><br><a href="lb.php" class="links">LEADERBOARD</a><span style="float:right"><a href="logout.php" class="links">LOGOUT</a></span></h4>
</header>
<h1>LEVEL : <?php echo $_SESSION['level_no']; ?></h1>
<form action='' method='POST'>
<div class="question" align="center" style:"position:relative">
<img src="<?php echo $image; ?>" style='width:400px;height:400px'>
<br><br><br>
<input id="x" type="text" name='user_answer' placeholder='click here for hint'/>
<br><br>
<input class='btn register' type='submit' name='Submit1' value='Submit' />
</div> 
</body>
