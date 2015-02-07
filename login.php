 
<?php
session_start();
require_once 'connect.php';
if ($_POST['login-email-mobile'] && $_POST['login-password'])
  {
        $login = urlencode($_POST['login-email-mobile']);
	$password = urlencode($_POST['login-password']);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_URL,"https://anokha.amrita.edu/api/registrations/login/");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,"login-email-mobile=$login&login-password=$password&accessLevel=form");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec ($ch);
	if($result)
	{
		$result = json_decode($result,true);
		$status =  $result[status];
		switch($status)
		{
		case "ok" : echo "login succesfsul";
			    $username =  $result[name];
      			    $anokhaid =  $result[anokha_id];
      			    $sql = "SELECT * FROM `users` where username='$username'";
      			    $result1 = mysql_query($sql) or die(mysql_error());
               	            $count = mysql_num_rows($result1);
			    if ($count == 1)
			    {
			    	$row = mysql_fetch_assoc($result1);
			    	$_SESSION['username'] = $row['username'];
			        $_SESSION['score'] = $row['score'];
    				$_SESSION['level_no'] = $row['level_no'];
				header('Location:homepage.php');
      			    }
				
      			    else
      			    {
				echo "working";
				

				$insertquery = "INSERT INTO `users` (username,anokhaid,score,level_no,date_time) VALUES ('$username', '$anokhaid',0,1, now())";
				$result2 = mysql_query($insertquery) or die(mysql_error());	
				if($result2)
				{
					$_SESSION['username'] = $username;
					$_SESSION['score'] = 0;
					$_SESSION['level_no'] = 1;
					header('Location:homepage.php');
				}
			}
				break;
		case "incorrect" : $msg =  "Try again..!";	
				 	break;
		case "not_registered" : $msg = "plzz register in anokha site";
					break;
		case "email_not_verified" : $msg = "mail not verified..!";			
						break;
		}
	 }
	else
	{
		echo "curl error: ".curl_error($ch);
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
        <input id="username" type="text" name="login-email-mobile" placeholder="username" /></p>

     <p><label>Password&nbsp;&nbsp; : </label>
         <input id="password" type="password" name="login-password" placeholder="password" /></p>
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
