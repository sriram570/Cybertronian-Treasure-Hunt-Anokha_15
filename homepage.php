
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
			$update_sql = "update users set score='$tscore',level_no='$tlevel'  where username='$tname'";
			$returnval = mysql_query($update_sql);
			$image ="success.jpg";
			
		}
		elseif ( $total < ($_SESSION['level_no'] + 1))
                {
                        header('Location: lastpage.php');
                        //echo "\nOOPS!! you are too fast!";
                }

		else
		{
			//echo "\nTry Again";
		}
		
	}
	else 
	{
	}
}
?>
<html>
<link href="normalize.css" rel="stylesheet">
<title>Home page</title>
<style>
@font-face{
	font-family: 'TreasureHunt';
	src: url(batmfa__.ttf);
	}
	header{ 
		 
		text-align:right;
		background: white;
		color:black;
		border-radius:3px;
		height:20px;
		line-height:20px; 
	}
	h1{ 
		color:white;
		margin:20px 0 0 0;
		text-align: center;
		font-family: 'TreasureHunt';
	}
	.question{
		top:40px;
		position: relative;
	}
			
	.sideMenu{
		position:relative;
		padding: 20px 0 0 0;
		margin:10px 0 10px 10px;
		font-family: sans-serif;
                text-align: center;
                font-size: 15px;
                color: #aaa;
                height: 45px;
                width:150px;
		line-height:25px;
                border-style: solid;
                border-radius: 50px;
                border-color:rgba(255,255,255,0.5);
                -webkit-transition: 0.5s ease;
	        -moz-transition: 0.5s ease;
       	        -ms-transition: 0.5s ease;
       	        -o-transition: 0.5s ease;
 	        transition: 0.5s ease;
		overflow: hidden;	
	}	
	.sideMenu:hover{
		background: white;
		color: black;
		font-size:20px;
		line-height:22px;
		
	}
	
	#navbar{
        position:relative;
        right:0px;
	top:40px;
        z-index:150;
        width:150px;
	}
	.sample{
		position: absolute;
		float:left;

	}
	ul{
		float:left;
	}
	#navbar a, #navbar a:visited{
        color:#c9c9c9;
        text-decoration:none;
	}

	a{ 
		text-decoration:none;
	}
	
	body{ 
		background:url('cosmos.jpg');
		background-size: cover;		
	}
	input[type="text"]{
	 	 border: solid 1px #707070;
 		 box-shadow: 0 0 5px 1px #969696;
 		 line-height: 2em;
        }
	.btn{
		height:40px;
		background:#2f4f4f;
		opacity:0.5;
		color:white;
		border-style:solid;
		border-radius: 5px;
	}	
</style>
<body>
<h1>LEVEL : <?php echo $_SESSION['level_no']; ?></h1>
<div class="sample">
 <ul id = "navbar">
                <li><a href = "homepage.php"><div class='sideMenu'>Homepage</div></a></li>
                <li><a href = "leaderborad2.php"><div class='sideMenu'>Leaderboard</div></a></li>
                <li><a href = "#"><div class='sideMenu'>Rules</div></a></li>
                <li><a href = "logout.php"><div class='sideMenu'>Logout</div></a></li>
        </ul></div>
<form action='' method='POST'>
<div class="question" align="center">
<img src="<?php echo $image; ?>" style='width:400px;height:400px'>
<br><br><br>
<input id='answer' type='text' name='user_answer' placeholder=' Answer' align='center'/>
<br><br>
<input class='btn register' type='submit' name='Submit1' value='Submit' />
</div>
</body>

