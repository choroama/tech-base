
<html>

<head>
	<title>mission_1-3.フォームの送信</title>
	<meta charset="utf-8">
</head>

<body>


<form action="mission_1-4.php" method="post">
<p>
<input type="text" name="name" value="コメント" size="50">
<input type="submit" value="送信">
</p> <!-pは段落区間->
</form>

<?php
$comment = $_POST["name"];
$time = date("Y年/m月/d日 H時間:i分:s秒");
echo "ご入力ありがとうございます。<br>".$time."に".$comment."を受け付けました";
//<br>で改行
?>

</body>

</html>
