<html>
<head>
<link href='http://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>
<script src="modernizr.custom.js"></script>
<title>Cybertronian Hunt</title>
<link rel="icon" href="anokha-logo.ico" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="loginstyle.css">
<meta name="veiwport" content="width=device-width">
</head>
<body>  
<?php
session_start();
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
		case "ok" : try{
				$servername = "localhost";
				$dbname = "treasurehunt";
				 $username =  $result[name];
                            $anokhaid =  $result[anokha_id];

			    $conn = new PDO("mysql:host=$servername;dbname=$dbname",'root','c407@ab123');
			    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			    $stmt = $conn->prepare("select * from users where username = :name
							and anokhaid = :anokhaid");
			    $stmt->bindParam(':name',$username);
		            $stmt->bindParam(':anokhaid',$anokhaid);
			    $stmt->execute();
			    $row = $stmt->fetch();
			    if($row)
				{ 
                                $_SESSION['username'] = $row['username'];
                                $_SESSION['score'] = $row['score'];
                                $_SESSION['level_no'] = $row['level_no'];
                                header('Location:homepage.php');
				}
			else
				{
			$stmt1 = $conn->prepare("insert into users (username,anokhaid,score,level_no,date_time)
					values(:username,:anokhaid,0,1,now())");
                                                      
                            $stmt1->bindParam(':username',$username);
                            $stmt1->bindParam(':anokhaid',$anokhaid);
                  
				if($stmt1->execute())
				{
					$_SESSION['username'] = $username;
                                        $_SESSION['score'] = 0;
                                        $_SESSION['level_no'] = 1;
                                        header('Location:homepage.php');
				}
				}
				}
				catch(PDOException $e)
			    	{    echo "Error: " . $e->getMessage();   }
      			    
					break;
		case "incorrect" : $msg =  "Password Incorrect. Try again";	
				 	break;
		case "not_registered" : $msg = "Oh Oh! It seems you are not registerd with the Autobots yet! That big REGISTER button on your right will help ya!";
					break;
		case "email_not_verified" : $msg = "Hmm... Optimus Prime says your Email has not been verified!";			
						break;
		}
	 }
	else
	{
		echo "curl error: ".curl_error($ch);
	}
}
?>
<h1>Cybertr<span><img src="anokha-logo.ico" class="head-logo" align:"center"></span>nian Hunt</h1>
<a href="https://anokha.amrita.edu/register">
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
    <p><label>Email/Phone : </label>
        <input id="username" type="text" name="login-email-mobile" placeholder="" /></p>

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
                        <h1>Rules</h1>
		<div class="overlay-text" align="center">
		<ul class="the_rules">	
			<li>This is an individual event.</li>
   			<li>Anyone can participate irrespective of their geographical location.</li>
   			<li>Helping others with answers is a violation of the intergalactic law. Suggesting obscure clues and gently nudging them to the answer however is not.</li>
               </ul>
		</div>
                <script src="classie.js"></script>
                <script src="demo1.js"></script>
</div>
</body>
</html>
