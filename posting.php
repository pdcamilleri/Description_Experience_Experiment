<?php 
define("DATA_DIR", "data");
date_default_timezone_set('Australia/Sydney');

// $filename will be something like this "data/2012-12-20.11:56:04.txt"
$filename = date("Y-m-d.H:i:s") . ".txt";

//  DIRECTORY_SEPARATOR will be / or \ depending on OS (linux/mac vs Windows)
$fp = fopen(DATA_DIR . DIRECTORY_SEPARATOR . $filename, 'a') or die("cant open file");

$allChoices = json_decode($_POST['allChoices']);
$allOutcomes = json_decode($_POST['allOutcomes']);
$allSliderChoices = json_decode($_POST['allSliderChoices']);

$problemDataFile = str_replace('\"','"',$_POST['problemDataFile']);
$demographics = str_replace('\"','"',$_POST['demographics']);
$probabilityEstimateType = str_replace('\"','"',$_POST['probabilityEstimateType']);
$choiceParadigmType = str_replace('\"','"',$_POST['choiceParadigmType']);
$feedbackType = str_replace('\"','"',$_POST['feedbackType']);




fwrite($fp, "all $_POST\n");
fwrite($fp, "problemDateFile $problemDataFile\n");
fwrite($fp, "demographics $demographics\n");
fwrite($fp, "prob est type $probabilityEstimateType\n");
fwrite($fp, "choice type $choiceParadigmType\n");
fwrite($fp, "feedback type $feedbackType\n");

for ($i = 0; $i < count($allChoices); $i++) {
   fwrite($fp, "== $i ==\nchoices\n");
   for ($j = 0; $j < count($allChoices[$i]); $j++) {
      fwrite($fp, $allChoices[$i][$j]);
   }
   fwrite($fp, "\noutcomes\n");
   for ($j = 0; $j < count($allOutcomes[$i]); $j++) {
      fwrite($fp, $allOutcomes[$i][$j]);
   }
   fwrite($fp, "\nslider choices\n");
   for ($j = 0; $j < count($allSliderChoices[$i]); $j++) {
      fwrite($fp, $allSliderChoices[$i][$j]);
   }
   fwrite($fp, "\n");
}

/*
fwrite($fp, "choices\n--");
$var = print_r($allChoices, true);
fwrite($fp, $var);
fwrite($fp, "--outcomes\n--");
$var = print_r($allOutcomes, true);
fwrite($fp, $var);
fwrite($fp, "--sliderchoices\n--");
$var = print_r($allSliderChoices, true);
fwrite($fp, $var);
fwrite($fp, "\n");
*/

/*
fwrite($fp, $choices[0]);
fwrite($fp, $outcomes[0]);
fwrite($fp, 'hello world length of array is next');
fwrite($fp, count($choices));
*/
fclose($fp);


?> 

