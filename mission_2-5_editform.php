<html>
<head>
	<title>editform</title>
	<meta charset="utf-8">
	<h1>編集用フォーム</h1>
</head>

<body>
<?php
$editnumber = $_POST["editnumber"];
$pw_edit = $_POST["pw_edit"];
$filename = "mission_2-5_morita.txt";
$del = "<>";
$array = file($filename);
$count = count($array);
$pw_column = 5;//パスワードは5番目の要素

if(isset($_POST["editnumber"]) && $_POST["editnumber"] != ""){
	for($i=0; $i<$count; $i++){
		$row = explode($del, $array[$i]);
    $answer_pw_edit = $row[$pw_column - 1];
		if($row[0] == $editnumber && $answer_pw_edit == $pw_edit){
			$editrow=$row; //該当行抽出
    }
	}
}
if(empty($editrow)){
  ?><h3>指定の投稿番号が存在しないか、パスワードが間違っています。送信しても反映されません。</h3><?php
}
?> <!--php内にhtmlの内容(formなど)は含められないのでphpを閉じる-->
<form action="mission_2-5.php" method="post">
<p>
  <input type="hidden" name="pw_edit" value="<?php echo $pw_edit; ?>">
  <input type="hidden" name="editnumber" value="<?php echo $editnumber; ?>">
	<!--hiddenで改めて編集番号を引き継ぐ-->
	編集番号:<?php echo $editnumber;?><br>
  名前:<input type="text" name='editname' value="<?php echo $editrow[1];?>"><br>
  コメント:<input type="text" name='editcomment' value="<?php echo $editrow[2];?>"><br>
  パスワード:<input type="text" name='pw_edit' value="<?php echo $editrow[$pw_column -1];?>"><br>
  <input type="submit" value="送信">
</p>

</form>

</body>
</html>
