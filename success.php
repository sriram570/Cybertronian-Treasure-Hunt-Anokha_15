<?php
$dir = 'img/answer_right/';
$images= scandir($dir);
$i = rand(2,sizeof($images)-1);
$img = 'img/answer_right/'.$images[$i];
?>

<head>
<style>
.question{
	top: 100px;
	position: relative;
	}
.btn{
                height:40px;
                background:#2f4f4f;
                opacity:0.5;
                color:white;
                border-style:solid;
                border-radius: 5px;
        }

body{background:url('cosmos.jpg');}
</style>
</head>
<body>
<div  class='question' align='center'>
<form action='homepage.php' method='POST'>
<img src='<?php echo $img;?>'></img>
<br><br>
<input class='btn' type='submit' name=submit' value='Go ahead'/>
</div>
</body>

