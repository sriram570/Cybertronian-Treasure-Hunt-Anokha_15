<?php
session_start();
if (isset($_SESSION['username']))
{
if ( isset( $_POST['Submit1'] ) ) {
echo " hello ";
 }
else {echo "no boss";}
echo "score:".$_SESSION['score'];
echo "hi ".$_SESSION['username'];
echo "<a href='logout.php'>Logout</a>";
echo "<form action='' method='POST'>";
echo "<img src='question/q1.jpg' alt='image1' style='width:304px;height:228px>";
echo "<input id='answer' type='text' name='answer' />";
echo "<input class='btn register' type='submit' name='Submit1' value='Login' />";
}
else
{
    header('Location:login.php');
}


?>
