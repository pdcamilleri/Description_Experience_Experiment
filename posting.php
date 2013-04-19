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
$associatedOutcomes = json_decode($_POST['associatedOutcomes']);

//$asd = print_r($associatedOutcomes, true);
//fwrite($fp,"zzxc". $asd . "aasdsas");

$demographics = str_replace('\"','"',$_POST['demographics']);

$problemDataFile = str_replace('\"','"',$_POST['problemDataFile']);
$probabilityEstimateType = str_replace('\"','"',$_POST['probabilityEstimateType']);
$choiceParadigmType = str_replace('\"','"',$_POST['choiceParadigmType']);
$feedbackType = str_replace('\"','"',$_POST['feedbackType']);

fwrite($fp, "$demographics\n");
fwrite($fp, "$problemDataFile\n");
fwrite($fp, "$probabilityEstimateType\n");
fwrite($fp, "$choiceParadigmType\n");
fwrite($fp, "$feedbackType\n");

fwrite($fp, "\n");
for ($i = 0; $i < count($allChoices); $i++) {
   fwrite($fp, "choice set $i");
   fwrite($fp, "\nchoices,");
   for ($j = 0; $j < 100; $j++) {
      if ($j < count($allChoices[$i])) {
         fwrite($fp, $allChoices[$i][$j]);
      } else {
         fwrite($fp, '-');
      }
      fwrite($fp, ',');
   }

   fwrite($fp, "\noutcomes,");
   for ($j = 0; $j < 100; $j++) {
      if ($j < count($allOutcomes[$i])) {
         fwrite($fp, $allOutcomes[$i][$j]);
      } else {
         fwrite($fp, '-');
      }
      fwrite($fp, ',');
   
   }
   fwrite($fp, "\nslider choices");
   for ($j = 0; $j < count($allSliderChoices[$i]); $j++) {
      for ($k = 0; $k < count($allSliderChoices[$i][$j]); $k++) {
         fwrite($fp, $allSliderChoices[$i][$j][$k]);
         fwrite($fp, ",");
      }
   }
   fwrite($fp, "\nassociated slider outcomes");
   for ($j = 0; $j < count($associatedOutcomes[$i]); $j++) {
      for ($k = 0; $k < count($associatedOutcomes[$i][$j]); $k++) {
         fwrite($fp, $associatedOutcomes[$i][$j][$k]);
         fwrite($fp, ",");
      }
   }

   fwrite($fp, "\n\n");
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

