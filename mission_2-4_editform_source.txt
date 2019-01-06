<html>
<head>
	<title>editform</title>
	<meta charset="utf-8">
	<h1>編集用フォーム</h1>
</head>

<body>
<?php
$editnumber = $_POST["editnumber"];
$filename = "mission_2-1_morita.txt";
$del = "<>";
$array = file($filename);
$count = count($array);
if(isset($_POST["editnumber"]) && $_POST["editnumber"] != ""){
	for($i=0; $i<$count; $i++){
		$row = explode($del, $array[$i]);
		if($row[0] == $editnumber){
			$editrow=$row; //該当行抽出
		}
	}
}
?> <!--php内にhtmlの内容(formなど)は含められないのでphpを閉じる-->
<form action="mission_2-4.php" method="post">
<p>
	<input type="hidden" name="editnumber" value="<?php echo $editnumber; ?>">
	<!--hiddenで改めて編集番号を引き継ぐ-->
	編集番号:<?php echo $editnumber;?><br>
  名前:<input type="text" name='editname' value="<?php echo $editrow[1];?>"><br>
  コメント:<input type="text" name='editcomment' value="<?php echo $editrow[2];?>"><br>
  <input type="submit" value="送信">
</p>

</form>


</body>
</html>
