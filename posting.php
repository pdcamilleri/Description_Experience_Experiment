<?php 
echo $_POST["age"]; 

$fp = fopen('postingdata.txt', 'a');
fwrite($fp, $_POST['name']);
fwrite($fp, $_POST['time']);
fclose($fp);


?> 

