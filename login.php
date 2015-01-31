 
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
     $msg = "Login failed.! Try again..!";
}

}
?>
<html>
<head>
<link href='http://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="normalize.css">
<title>Cybertronian Hunt</title>
<link rel="stylesheet" type="text/css" href="style.css" />
<meta name="veiwport" content="width=device-width">
<style>
@font-face{
 	font-family:'TreasureHunt';
	src:url(batmfa__.ttf);
	}
@font-face{
	font-family:'Hyperspace';
	src:url(hyperspace.ttf);
	}
	#cover{ 
		position:fixed; 
		top:0; left:0; 
		background:rgba(0,0,0,0.6); 
		z-index:5; 
		width:100%; 
		height:100%; 
		display:none; 
	} 
	#loginScreen { 
		height:250px; 
		width:360px; 
		margin:0 auto; 
		position:relative;
		padding:100px 0 0 0;
		z-index:10;
		display: none;
		border:5px solid #cccccc; 
		border-radius:10px;
		font-family: 'Play', sans-serif;
		text-align: center;
                background: rgba(0,0,0,0.6);
		color: #00FF00;
	} 
	#loginScreen:target, #loginScreen:target + #cover{ 
		display:block; 
		opacity:2; 
	} 
	.cancel { 
		display:block; 
		position:absolute; 
		top:3px;
		right:2px; 
		background:rgb(245,245,245); 
		color:black; 
		height:30px; 
		width:35px; 
		font-size:30px; 
		text-decoration:none; 
		text-align:center; 
		font-weight:bold; 
	} 
	#loginScreen .btn{
		background: rgba(0,0,0,0.6);;
		padding: 7px;
		border-radius:5px;
		font-family: 'Play',sans-serif;
		font-weight: bold;
		font-height:50px;
		width: 70px;
		display: inline-block;
		color: #aaa;
	}

	h1{
		
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
		position:relative;
		margin:100px 150px 0 0px;
		font-family: 'Hyperspace';
		float: right;
		text-align: center;
		font-size: 30px;
		color: #aaa;
		vertical-align: middle;
		height: 100px;
		width:200px;
		line-height:32px;
		border-style: solid;
		border-radius: 50px;
		border-color:rgba(0,0,0,0.5);
		-webkit-transition: 0.5s ease;
	        -moz-transition: 0.5s ease;
       	        -ms-transition: 0.5s ease;
    	        -o-transition: 0.5s ease;
       	        transition: 0.5s ease;

	}
	.login{
		position:relative;
		margin:100px 0 0 150px;
                font-family: 'Hyperspace';
                float: left;
                text-align: center;
                font-size: 30px;
                color: #aaa;
                vertical-align: middle;
                height: 100px;
                width:200px;
                line-height:32px;
                border-style: solid;
		border-radius: 50px;
                border-color:rgba(0,0,0,0.5);
                -webkit-transition: 0.5s ease;
                -moz-transition: 0.5s ease;
                -ms-transition: 0.5s ease;
                -o-transition: 0.5s ease;
                transition: 0.5s ease;

	}
	.text{
		text-align:center;
		vertical-align: center;
		float:center;
	}
	.signup:hover{
		margin:50px 150px 0 0;
		height:200px;
		border-color: rgba(0,0,0,0.5);
		border-radius:50%;
		border: 20px dotted rgba(0,0,0,0.7);
		font-weight: bold;
		line-height: 130px;
		
	}
	.login:hover{
		margin:50px 0 0 150px;
		height: 200px;
		border-color: rgba(0,0,0,0.5);
                border-radius:50%;
                border: 20px dotted rgba(0,0,0,0.7);
                font-weight: bold;
		line-height: 130px;
        }

	.reg{
		padding:50px 0 0 0;
	}
	a{ 	
		text-decoration:none;
	}
	
body
{
background: url('Hunt.jpg') no-repeat fixed;
-moz-background-size: cover;
background-size:cover;
background-position: none center; 
<!--background-size: 95%;-->
<!--background-attachment:fixed;-->

}	
</head>
</style>
<body> 
<h1>Cybertronian Hunt</h1>
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
</body>
</html>
