<?php 
define("DATA_DIR", "data");
date_default_timezone_set('Australia/Sydney');

// $filename will be something like this "data/2012-12-20.11:56:04.txt"
$filename = date("Y-m-d.H:i:s") . ".txt";

//  DIRECTORY_SEPARATOR will be / or \ depending on OS (linux/mac vs Windows)
$fp = fopen(DATA_DIR . DIRECTORY_SEPARATOR . $filename, 'a') or die("cant open file");

$choices = $_POST['choices'];
$outcomes = $_POST['outcomes'];


fwrite($fp, $choices[0]);
fwrite($fp, $outcomes[0]);
fwrite($fp, 'hello world length of array is next');
fwrite($fp, count($choices));
fclose($fp);


?> 

