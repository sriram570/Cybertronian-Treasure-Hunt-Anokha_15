<?php
require('connect.php');

if (isset($_POST['username']) && isset($_POST['password']))
	{
  function keymaker($id)
        {
                $secretkey='hfaa1h1awhqa3sdoyasw7e2sho3mqeojemdw09jdsklafjp1qwoijedmp03w9eiojdma';
                $key=md5($id.$secretkey);
                return $key;
        }
		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = keymaker($_POST['password']);
	       
		$checkusername = mysql_query("SELECT * FROM `users`  WHERE username= '$username'");
		 if(mysql_num_rows($checkusername))
		    {
		        $msg = "Username already exists.!";
		    }
		else
			
			{  
				$score = 0;
				$level_no = 1;
$query = "INSERT INTO `users` (username,mailid,pword,score,level_no,date_time) VALUES ('$username', '$email', '$password','$score','$level_no', now())";
			        $result = mysql_query($query);
				echo $result;
				echo $query;
			        if($result)
				{
		        	    $msg = "User Created Successfully.";
			        }
				else
				{
				$msg = "registraion failed";}
			}
    	}

    ?>

<script type="text/javascript">
    function validateForm()
	    {
		var name = document.forms[reg]["username"].value;
		var email_id = document.forms[reg]["email"].value;
		if ((name =="" || email_id==""))
		{
			alert("All Field must be filled out.!");
			return false;
		}
		
	     }
</script>
		

<html>
<head>
<title>Online Treasure Hunt</title>
<style>
body 
{
background: #000;
background-image: url('img/tresure.jpg');
background-repeat: no-repeat;
background-size: 95%;
background-attachment:fixed;
}
</style>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<br><br><br><br>
<div class="register-form">
<?php
	if(isset($msg) & !empty($msg)){
		echo $msg;
	}

 ?>

<h1>Register</h1>
<form name="reg"action="" onsubmit="return validateForm()"  method="POST">
    <p><label>User Name : </label>
	<input id="username" type="text" name="username" required placeholder="username" /></p>

    <p><label>E-Mail&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  : </label>
	 <input id="password" type="email" name="email" required placeholder="ravi@gmail.com" /></p>

     <p><label>Password&nbsp;&nbsp; : </label>
	 <input id="password" type="password" name="password" required placeholder="password" /></p>

    <input class="btn register" type="submit" name="submit" value="Register" /> 
    <a class="btn" href="login.php">Login</a>

</form>
</div>
</body>
</html>
