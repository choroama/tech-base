<!DOCTYPE html>
<html>
<head>
  <h2>mission2-5</h2>
	<title>mission2-5</title>
	<meta charset="utf-8">
</head>

<body>

<form action="mission_2-5.php" method="post">
<p>
  <input type="text" name='name' placeholder="名前"><br>
  <input type="text" name='comment' placeholder="コメント"><br>
  <input type="password" name="pw_post" placeholder="パスワード">
  <!--type='password'でブラウザ上黒丸で表示(内容自体は暗号化されない)-->
  <input type="submit" value="送信">
</p>

<p>
  投稿履歴削除<br>
  <input type="text" name='delnumber' placeholder="削除対象番号"><br>
  <input type="password" name="pw_delete" placeholder="パスワード">
  <input type="submit" value="削除">
</p>
</form> <!--mission_2-5.phpに反映するフォームはここまで-->

<form action="mission_2-5_editform.php" method="post">
<p>
  投稿履歴編集<br>
  <input type="text" name='editnumber' placeholder="編集対象番号"><br>
  <input type="password" name="pw_edit" placeholder="パスワード">
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
$pw_post = $_POST["pw_post"];
$pw_delete = $_POST["pw_delete"];
$pw_edit = $_POST["pw_edit"];
$pw_column = 5;//パスワードは5番目の要素
$time = date("Y/m/d H:i:s");
$filename = "mission_2-5_morita.txt";
$del = "<>";
$array = file($filename);
$count = count($array); //行数
$lastrow = explode($del, $array[$count - 1]);//最終行
$number = intval($lastrow[0]) + 1; //最終行の投稿番号 + 1。前の行と分ける
$flag = 0;


//投稿処理------------------------------------------------
if(isset($_POST["comment"]) && $_POST["comment"] != ""){//nan,空文字でない時
  if(file_exists($filename)){
    $fp = fopen($filename, 'a');
    fwrite($fp, $number.$del.$name.$del.$comment.$del.$time.$del.$pw_post.$del."\n");
    fclose($fp);
  }else{
    $fp = fopen($filename, 'a');
    fwrite($fp, "1".$del.$name.$del.$comment.$del.$time.$del.$pw_post.$del."\n");
    fclose($fp);
  }
  $flag = 1;//投稿された場合のフラグ
}

//削除処理------------------------------------------------
if(isset($_POST["delnumber"]) && $_POST["delnumber"] != ""){
  $fp = fopen($filename, 'w');
	for($i=0; $i<$number; $i++){
    $row = explode($del,$array[$i]);
    $answer_pw_delete = $row[$pw_column - 1];
		if($row[0] == $delnumber && $pw_delete == $answer_pw_delete){//投稿番号の一致andパスワードの一致
      $flag = 2;//削除が行われた場合のフラグ
      continue; //次のループに進む
    }else{
			fwrite($fp, $array[$i]);
		}
	}
	fclose($fp);
}

//編集処理------------------------------------------------
if(isset($_POST["editnumber"]) && $_POST["editnumber"] != ""){
  $fp = fopen($filename, 'w');
  for($i=0; $i<$number; $i++){
		$row = explode($del, $array[$i]);
    $answer_pw_edit = $row[$pw_column - 1];
		if($row[0] == $editnumber && $pw_edit == $answer_pw_edit){
      $flag = 3;//編集が行われた場合のフラグ
      fwrite($fp, $editnumber.$del.$editname.$del.$editcomment.$del.$time.$del.$pw_edit.$del."\n");
    }else{
			fwrite($fp, $array[$i]);
		}
	}
	fclose($fp);
}

//レスポンス結果出力----------------------------------------
if($flag == 0){//flagが変わらない=エラー
  ?><h3>指定の投稿番号が存在しないか、パスワードが間違っています</h3><?php
}elseif($flag == 1){
  ?><h3>新たな投稿が行われました</h3><?php
}elseif($flag == 2){
  ?><h3>削除が行われました</h3><?php
}elseif($flag == 3){
  ?><h3>編集が行われました</h3><?php
}

//掲示板出力----------------------------------------------
$array = file($filename);
for($i=0; $i<$number; $i++){
  $row = explode($del, $array[$i]);
  $j = 1;
  foreach($row as $value){
    if($pw_column != $j){//パスワード以外echo
      echo $value." ";
    }
    $j++;
  }
  echo "<br>";
}
?>
</body>
</html>
