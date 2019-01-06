<html>

<head>
	<title>mission_1-7-extra</title>
	<meta charset="utf-8">
</head>

<body>


<form action="http://tt-721.99sv-coco.com/mission_1-7-extra.php" method="post">
<p>
<input type="text" name="name" size="50">
<!-type: text,radio など value:初期値, name:入力値 value:初期入力値->
<input type="submit" value="送信">
</p> <!-pは段落区間->
</form>

<?php
$comment = $_POST["name"];
$time = date("Y/m/d H:i:s");
$filename = "mission_1-7-extra_morita.txt";

if(isset($comment) && $comment != ""){
  //echo "ご入力ありがとうございます。<br>".$time."に".$comment."を受け付けました";
  $fp = fopen($filename, 'a');  //'w':書き込みモード
  fwrite($fp, $comment."\n");
  fclose($fp);
}//isset:記述があるならTrue,emptyならFalse,この場合空でありNULLではないのに注意

$array = file($filename);
$count = count($array); //行数を得る
for($i=0; $i<$count; $i++){
  echo $array[$i]."<br>";
}
?>

</body>

</html>
