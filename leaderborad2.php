<!DOCTYPE html>
<html lang="en" data-placeholder-focus="false">
  <head>
    <link href="/normalize.css" rel="stylesheet">
    <meta charset="UTF-8" />
    <meta name="google" value="notranslate" />
    <meta http-equiv="Content-Language" content="en_US" />
    <title>Leader Board</title>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link type="text/css" rel="stylesheet" href="style2.css" />    
  </head>
  <body>
<?php
session_start();
require_once "connect.php";
$sql ="select * from users order by score desc";
$result = mysql_query($sql);
$count = 1;

?>
<form action="homepage.php">
<input type="image" src="img\BackButton.gif" alt="Submit" width="48" height="48" padd>
</form>
<div class="container" align='center' >
    <div class="row"  align='center' style="margin-top:30px; ">
      <div class="well col-sm-12" align='center' style= "background:rgba(0,0,0,0.5);color:white;">
        <h3 style="margin-top:0px; margin-bottom:20px;">Leader Board</h3>
        <table class="table table-condensed">
          <thead>
            <tr>
              <th><h4>#</h4></th>
              <th><h4>User Name</h4></th>
              <th><h4>Level</h4></th>
              <th><h4>Score</h4></th>
            </tr>
          </thead>
          <tbody>
		<?php 
		while($row = mysql_fetch_assoc($result)) {
		echo"<tr>";
  		echo"<td> $count</td>";
  		echo"<td> ";
		echo $row['username'];
		echo "</td>";
  		echo"<td> ";
		echo $row['level_no'];
		echo "</td>";
		echo"<td> ";
		echo $row['score'];
		echo "</td>";
		$count += 1;
		echo"</tr>";		
		}
		?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  </body>
</html>
