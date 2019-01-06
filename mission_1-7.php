<html>

<head>
	<title>mission_1-7</title>
	<meta charset="utf-8">
</head>

<body>


<form action="mission_1-7.php" method="post">
<p>
<input type="text" name="name" size="50">
<!--type: text,radio など value:初期値, name:入力値 value:初期入力値-->
<input type="submit" value="送信">
</p> <!-pは段落区間->
</form>

<?php
$comment = $_POST["name"];
$time = date("Y/m/d H:i:s");
$filename = "mission_1-7_morita.txt";

if(isset($comment) && $comment != ""){
  //echo "ご入力ありがとうございます。<br>".$time."に".$comment."を受け付けました";
  $fp = fopen($filename, 'a');  //'w':書き込みモード
  fwrite($fp, $comment."\n");
  fclose($fp);
}//isset:記述があるならTrue,emptyならFalse,この場合空でありNULLではないのに注意

$array = file($filename);
foreach($array as $value){
  echo $value."<br>";
}
?>

</body>

</html>
