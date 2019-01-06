<?php
$hensu = "Hello World";
$filename = "mission_1-2.txt";
$fp = fopen($filename, 'r');  //'r':読み込みモード
$hensu = fgets($fp);
echo $hensu;
?>
