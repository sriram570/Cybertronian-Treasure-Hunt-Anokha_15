 
<?php
session_start();
require_once 'connect.php';
if (isset($_POST['submit']))
  {
         function keymaker($id)
        {
                $secretkey='hfaa1h1awhqa3sdoyasw7e2sho3mqeojemdw09jdsklafjp1qwoijedmp03w9eiojdma';
                $key=md5($id.$secretkey);
                return $key;
        }

    $username = $_POST['username'];
	$pas = $_POST['password'];
	#echo $pas."\n";
	$password = keymaker($pas);	

$sql = "SELECT * FROM `users` WHERE username='$username' and pword='$password'";
$result = mysql_query($sql) or die(mysql_error());

$count = mysql_num_rows($result);
if ($count == 1){
    $_SESSION['username'] = $username;
    $row = mysql_fetch_assoc($result);
    $_SESSION['score'] = $row['score'];
    $_SESSION['level_no'] = $row['level_no'];
    header('Location:homepage.php');
}else {
     $msg = "Login failed.! Try again..!";
}
}
?>
<html>
<head>
<link href='http://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>
<title>Cybertronian Hunt</title>
<link rel="stylesheet" type="text/css" href="style.css" />
<style>
@font-face{
 	font-family:'TreasureHunt';
	src:url(batmfa__.ttf);
	}
	h1{
		padding:20 10 0 10px;
		border: 100px 0 0 100px;
		font-family: 'TreasureHunt';
		font-size: 70px;
		text-align: center;
		color: #aaaaaa;
	}
	h2{ 
 		padding:20px 0 10px 0;
		color:#aaa;
	}
	.register-form{
		font-family: 'Play', sans-serif;
		float: left;
		background: rgba(0,0,0,0.5);
		padding: 0 10px 0 20px;
		margin: 40px 40px 0 40px;
		position:absolute;
		width: 350px;
	}
	.signup{
		margin:100px 100px 0 10px;
		font-family: 'Play', sans-serif;
		float: right;
		text-align: center;
		font-size: 40px;
		color: #aaa;
		width:200px;
		height:200px;
		border-radius: 50%;
		border-style: solid;
		border-color:#aaa;
	}
body
{
background: #000;
background-image: url('Hunt.jpg');
background-size: cover;
<!--background-repeat: no-repeat;-->
<!--background-size: 95%;-->
<!--background-attachment:fixed;-->

}
</head>
</style>
<body> 
<h1>Cybertronian Hunt</h1>
<div class="register-form">
<?php
   	if(isset($msg) & !empty($msg))
	{
		echo $msg;
	}
?>
<h2>Login</h2>
<form action="" method="POST">
    <p><label>User Name : </label>
        <input id="username" type="text" name="username" placeholder="username" /></p>

     <p><label>Password&nbsp;&nbsp; : </label>
         <input id="password" type="password" name="password" placeholder="password" /></p>
    <input class="btn register" type="submit" name="submit" value="Login" />
        <a class="btn" href="register.php">Signup</a>
    </form>
</div>
<a href="register.php">
<div class="signup">
	<p>Register</p>
</div>
</a>
</body>
</html>
