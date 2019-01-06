<html>

<head>
	<title>mission2-1</title>
	<meta charset="utf-8">
</head>

<body>


<form action="mission_2-1.php" method="post">
<p>名前:<input type="text" name='name'></p>
<p>コメント:<input type="text" name='comment'></p>
<!--type: text,radio など value:初期値, name:入力値 value:初期入力値-->
<p><input type="submit" value="送信"></p>

</form>

<?php
$comment = $_POST["comment"];
$name = $_POST["name"];
$time = date("Y/m/d H:i:s");
$filename = "mission_2-1_morita.txt";
$del = "<>"; //delimiter(区切り文字)

$array = file($filename);
$count = count($array); //行数
$number = $count + 1; //投稿番号

if(isset($comment) && $comment != ""){//nan,空文字でない時
  if(file_exists($filename)){
    $fp = fopen($filename, 'a');  //'a':追記モード
    fwrite($fp, $number.$del.$name.$del.$comment.$del.$time."\n");
    fclose($fp);
  }else{
    $fp = fopen($filename, 'a');  //'a':追記モード
    fwrite($fp, "1".$del.$name.$del.$comment.$del.$time."\n");
    fclose($fp);
  }
}//フォームへの入力をブラウザに反映
#foreach($array as $value){
#  echo $value."<br>";
#}
//isset:記述があるならTrue,emptyならFalse,この場合空でありNULLではないのに注意

?>

</body>
</html>
