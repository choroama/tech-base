<?php
$hensu = "Hello World";  
$filename = "misson_1-2.txt";
$fp = fopen($filename, 'w');  //'w':書き込みモード
fwrite($fp, 'test' );
fclose($fp);
?>