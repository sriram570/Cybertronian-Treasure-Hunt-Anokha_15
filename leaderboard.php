<?php
session_start();
require_once "connect.php";
$sql ="select * from users order by score desc";
$result = mysql_query($sql);
$count = 1;
echo "<a href='homepage.php'>homepage</a><br><br>";
echo "Rank\t\tName\t\tlevel\t\tscore\n\n<hr>";
while($row = mysql_fetch_assoc($result)) 
{
	echo "$count\t\t".$row['username']."\t\t".$row['level_no']."\t\t".$row['score'];
	$count = $count + 1;
	echo "<br><br>";
}
?>
