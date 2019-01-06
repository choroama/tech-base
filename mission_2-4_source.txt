<!DOCTYPE html>
<html>
<head>
	<title>mission2-4</title>
	<meta charset="utf-8">
</head>

<body>

<form action="mission_2-4.php" method="post">
<p>
  名前:<input type="text" name='name'><br>
  コメント:<input type="text" name='comment'><br>
  <input type="submit" value="送信">
</p>

<p>
  投稿履歴削除<br>
  <input type="text" name='delnumber' placeholder="削除対象番号">
  <input type="submit" value="削除">
</p>
</form> <!--mission_2-4.phpに反映するフォームはここまで-->

<form action="mission_2-4_editform.php" method="post">
<p>
  投稿履歴編集<br>
  <input type="text" name='editnumber' placeholder="編集対象番号">
  <input type="submit" value="編集">
</p>

</form>

<?php
$comment = $_POST["comment"];
$name = $_POST["name"];
$delnumber = $_POST["delnumber"];
$editnumber = $_POST["editnumber"];
$editname = $_POST["editname"];
$editcomment = $_POST["editcomment"];
$time = date("Y/m/d H:i:s");
$filename = "mission_2-1_morita.txt";
$del = "<>";
$array = file($filename);
$count = count($array); //行数
$lastrow = explode($del, $array[$count - 1]);//最終行
$number = intval($lastrow[0]) + 1; //最終行の投稿番号 + 1。前の行と分ける


//編集対象番号が入力された場合の処理
if(isset($_POST["editnumber"]) && $_POST["editnumber"] != ""){
  $fp = fopen($filename, 'w');
  for($i=0; $i<$number; $i++){
		$row = explode($del, $array[$i]);
		if($row[0] == $editnumber){
      fwrite($fp, $editnumber.$del.$editname.$del.$editcomment.$del.$time."\n");
    }else{
			fwrite($fp, $array[$i]);
		}
	}
	fclose($fp);
}
//削除対象番号が入力された場合の処理----------------------------------------
//if(isset($delnumber) && $delnumber != ""){//phpチェック用
if(isset($_POST["delnumber"]) && $_POST["delnumber"] != ""){
  $fp = fopen($filename, 'w');
	for($i=0; $i<$number; $i++){
		$row = explode($del, $array[$i]);
		if($row[0] == $delnumber){ //投稿番号と削除対象番号が一致するとき
      continue; //次のループに進む
    }else{
			fwrite($fp, $array[$i]);
		}
	}
	fclose($fp);
}
//コメントと名前を登録する処理------------------------------------------------
if(isset($_POST["comment"]) && $_POST["comment"] != ""){//nan,空文字でない時
  if(file_exists($filename)){
    $fp = fopen($filename, 'a');
    fwrite($fp, $number.$del.$name.$del.$comment.$del.$time."\n");
    fclose($fp);
  }else{
    $fp = fopen($filename, 'a');
    fwrite($fp, "1".$del.$name.$del.$comment.$del.$time."\n");
    fclose($fp);
  }
}//フォームへの入力をブラウザに反映--------------------------------------------
$array = file($filename); //fwriteされた後のarrayを反映する。
for($i=0; $i<$number; $i++){ //txtの行数がiに対応
  $row = explode($del, $array[$i]); //$delを区切りとして要素取得
  foreach($row as $value){//行の要素数分繰り返し
    echo $value." ";
  }
  echo "<br>";
}
?>
</body>
</html>
