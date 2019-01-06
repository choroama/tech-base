<!DOCTYPE html>
<html>
<head>
	<title>mission2-3</title>
	<meta charset="utf-8">
</head>

<body>

<form action="mission_2-3.php" method="post">
<p>名前:<input type="text" name='name'></p>
<p>コメント:<input type="text" name='comment'></p>
<!--type: text,radio など value:初期値, name:入力値 value:初期入力値-->
<p><input type="submit" value="送信"></p>

<p>投稿履歴削除</p>
<p><input type="text" name='delnumber' placeholder="削除対象番号"></p>
<p><input type="submit" value="削除"></p>

</form>

<?php
//$delnumber = "2"; //phpチェック用
$comment = $_POST["comment"];
$name = $_POST["name"];
$time = date("Y/m/d H:i:s");
$filename = "mission_2-3_morita.txt";
$del = "<>"; //delimiter(区切り文字)
$delnumber = $_POST["delnumber"];

$array = file($filename);
$count = count($array); //行数
//$number = $count + 1; //投稿番号
$lastrow = explode($del, $array[$count - 1]);//最終行
$number = intval($lastrow[0]) + 1; //最終行の投稿番号 + 1。前の行と分ける

//削除対象番号が入力された場合の処理----------------------------------------
//if(isset($delnumber) && $delnumber != ""){//phpチェック用
if(isset($_POST["delnumber"]) && $_POST["delnumber"] != ""){ //削除番号が入力,nan出ない場合
  $fp = fopen($filename, 'w');  //'w':上書きモードに最終的に変える]
	for($i=0; $i<$number; $i++){
		$input = explode($del, $array[$i]);
		if($input[0] == $delnumber){ //投稿番号と削除対象番号が一致するとき
      continue; //次のループに進む
    }else{
			fwrite($fp, $array[$i]);
		}
	}
	fclose($fp);
}
//コメントと名前を登録する処理
if(isset($_POST["comment"]) && $_POST["comment"] != ""){//nan,空文字でない時
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
$array = file($filename); //fwriteされた後のarrayを反映する。
for($i=0; $i<$number; $i++){ //txtの行数がiに対応
  $input = explode($del, $array[$i]); //$delを区切りとして要素取得
  foreach($input as $value){//行の要素数分繰り返し
    echo $value." ";
  }
  echo "<br>";
}
?>
</body>
</html>
