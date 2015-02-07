<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Leader Board</title>
<link rel="icon" href="anokha-logo.ico" type="image/x-icon">
<link href="lbstyle.css" rel="stylesheet">
<style>
</style>
</head>
<body>
<?php
session_start();
require_once "connect.php";
$imgs = array('img/one.jpg','img/two.jpg','img/three.jpg');
$sql ="select * from users order by score desc, date_time asc";
$result = mysql_query($sql);
$count = 1;
$index = 0;
?>
<form action="homepage.php">
<input type="image" src="img/BackButton.gif" alt="Submit" width="48" height="48" padd>
</form>

<h5 style="margin-top:25px; margin-bottom:25px;">Leaderboard</h5>
<table align="center" id="background-image" summary="Meeting Results">
    <thead>
    	<tr>
	<div id="headings">
            <th>#</th>
            <th>Username</th>
            <th>Level</th>
	    <th>Score</th>
	</div>
        </tr>
    </thead>
    <tfoot>

    </tfoot>
    <tbody>

		<?php 
		while($row = mysql_fetch_assoc($result)) {
		echo"<tr>";

		echo "<td style='font-style: normal; font-size: 16px; border-top-left-radius:1em; border-bottom-left-radius:0.75em;'>";
		if ($index < 3)
		{
	        echo "<img src=$imgs[$index] width=30 height=26 style='border-radius:0.5em;'/>";
		}
		else 
		{
		echo"$count";
		}
		$index = $index + 1;
		echo "</td>";

  		echo"<td>";
		echo strtoupper($row['username']);
		echo "</td>";

  		echo"<td>";
		echo $row['level_no'];
		echo "</td>";

		echo"<td style = 'border-top-right-radius:1em; border-bottom-right-radius:0.75em;'>";
		echo $row['score'];
		echo "</td>";

		$count += 1;
		echo"</tr>";		
		}
		?>
    </tbody>
</table>

</body>
</html>
