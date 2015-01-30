 
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
<link rel="stylesheet" type="text/css" href="style.css" />
<style>
body
{
background: #000;
background-image: url('img/tresure.jpg');
background-repeat: no-repeat;
background-size: 95%;
background-attachment:fixed;

}
</head>
</style>
<body> 
<div class="register-form">
<?php
   	if(isset($msg) & !empty($msg))
	{
		echo $msg;
	}
?>
<h1>Login</h1>
<form action="" method="POST">
    <p><label>User Name : </label>
        <input id="username" type="text" name="username" placeholder="username" /></p>

     <p><label>Password&nbsp;&nbsp; : </label>
         <input id="password" type="password" name="password" placeholder="password" /></p>
    <input class="btn register" type="submit" name="submit" value="Login" />
        <a class="btn" href="register.php">Signup</a>
    </form>
</div>
</body>
</html>
