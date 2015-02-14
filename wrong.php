<?php
$dir = 'img/answer_wrong/';
$images= scandir($dir);
$i = rand(2,sizeof($images)-1);
$img = 'img/answer_wrong/'.$images[$i];
?>
<head>
<style>
.question{
	top: 100px;
	position: relative;
	}
body{background:url('cosmos.jpg');}
</style>
</head>
<body>
<div  class='question' align='center'>
<form action='homepage.php' method='POST'>
<img src='<?php echo $img; ?>'></img>
<br><br>
<input type='submit' name=submit' value='Try again'/>
</div>
</body>

