 
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
     $msg = "Login failed.! Try ..!";
}

}
?>
<html>
<head>
<link href='http://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>
<!--<link rel="stylesheet" type="text/css" href="normalize1.css" />-->
	<!--<link rel="stylesheet" type="text/css" href="demo.css" />-->
	<!--<link rel="stylesheet" type="text/css" href="style1.css" />-->
  	<script src="modernizr.custom.js"></script>
<title>Cybertronian Hunt</title>
<link rel="icon" href="anokha-logo.ico" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="loginstyle.css">
<meta name="veiwport" content="width=device-width">
<style>
</style>
</head>
<body> 
<h1>Cybertr<span><img src="anokha-logo.ico" class="head-logo" align:"center"></span>nian Hunt</h1>
<?php
   	if(isset($msg) & !empty($msg))
	{
		echo $msg;
	}
?>
<a href="register.php">
<div class="signup">
	<p>Register</p>
</div>
</a>
<a href="#loginScreen">
<div class="login">
	<p>Login</p>
</div>
</a>
<div id="loginScreen">
	<a href="#" class="cancel">&times;</a>
	<?php
        if(isset($msg) & !empty($msg))
        {
                echo $msg;
        }
?>

<form action="" method="POST">
    <p><label>User Name : </label>
        <input id="username" type="text" name="username" placeholder="username" /></p>

     <p><label>Password&nbsp;&nbsp; : </label>
         <input id="password" type="password" name="password" placeholder="password" /></p>
    <input class="btn register" type="submit" name="submit" value="Login" />

    </form>
</div>
<div id="cover">
</div>
<div style="width:100%;bottom:0px;position:fixed;" align="right">
<img src="amrita.png" style="height: 50px; padding:0 10px 0 0;">
</div>
<div style="bottom:20px; position:fixed; width:100%;" align="left">
<button id="trigger-overlay" type="button" class="buttn">RULES</button>
</div>
<div class="overlay overlay-hugeinc">
                        <button type="button" class="overlay-close">Close</button>
                        <!--<nav>
                                <ul>
                                        <li><a href="#">Home</a></li>
                                        <li><a href="#">About</a></li>
                                        <li><a href="#">Work</a></li>
                                        <li><a href="#">Clients</a></li>
                                        <li><a href="#">Contact</a></li>
                                </ul>
                        </nav>-->
                        <h1>Rules</h1>
		<div class="overlay-text" align="center">	
		<p>This is an individual event.</p>
   <p>Anyone can participate irrespective of their geographical location.</p>
   <p>Helping others with answers is a violation of the intergalactic law. Suggesting obscure clues and gently nudging them to the answer however is not.</p>
               
		</div>
                <script src="classie.js"></script>
                <script src="demo1.js"></script>
</div>
</body>
</html>
