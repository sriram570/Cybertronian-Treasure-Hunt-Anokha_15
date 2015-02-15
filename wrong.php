<?php
  function keymaker($id)
        {
                $secretkey='hfaa1h1awhqa3sdoyasw7e2sho3mqeojemdw09jdsklafjp1qwoijedmp03w9eiojdma';
                $key=md5($id.$secretkey);
                return $key;
        }
$testurlkey = keymaker($_GET['id']);
if(isset($_GET['id']) && $testurlkey==$_GET['key'])
{

$dir = 'img/answer_wrong/';
$images= scandir($dir);
$i = rand(2,sizeof($images)-1);
$img = 'img/answer_wrong/'.$images[$i];
}
else
{
        header('Location: homepage.php');
}

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

