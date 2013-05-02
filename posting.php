<?php 
define("DATA_DIR", "data");
date_default_timezone_set('Australia/Sydney');

// $filename will be something like this "data/2012-12-20.11:56:04.txt"
$filename = date("Y-m-d.H:i:s") . ".txt";

//  DIRECTORY_SEPARATOR will be / or \ depending on OS (linux/mac vs Windows)
$fp = fopen(DATA_DIR.DIRECTORY_SEPARATOR.$filename, 'a') or die("cant open file");

// get all of the paramaters that were posted from the DEF.js file.
$id = $_POST['id'];
$orderingOfProblems = json_decode($_POST['orderingOfProblems']);
$leftRightPresentation = json_decode($_POST['leftRightPresentation']);
$allChoices = json_decode($_POST['allChoices']);
$allOutcomes = json_decode($_POST['allOutcomes']);
$allSliderChoices = json_decode($_POST['allSliderChoices']);
$associatedOutcomes = json_decode($_POST['associatedOutcomes']);
$finalChoices = json_decode($_POST['finalChoices']);

$demographics = str_replace('\"','"',$_POST['demographics']);

$problemDataFile = str_replace('\"','"',$_POST['problemDataFile']);
$probabilityEstimateType = str_replace('\"','"',$_POST['probabilityEstimateType']);
$choiceParadigmType = str_replace('\"','"',$_POST['choiceParadigmType']);
$feedbackType = str_replace('\"','"',$_POST['feedbackType']);


// the outcomes and probabilities pulled from the data file originally used for this problem
$top = array();

// just reopen the file and get the outcome + probability information again
// this is all very similar to getproblemdata.php
if (($file = fopen(substr($problemDataFile, 1, -1), "r")) !== FALSE) {
   fgetcsv($file, 0, ",");
   while (($data = fgetcsv($file, 0, ",")) !== FALSE) {
      array_shift($data);
      $smallOutcomesArray = array();
      for ($z = 0; $z < 3; $z++) { // 3 == NUM_OPTIONS, see getproblemdata.php
         array_push($smallOutcomesArray, array_slice($data, 1 + (11 + 100) * $z, 10));
      }
      array_push($top, $smallOutcomesArray);
   }
   fclose($file);
}

// start writing to the file

fwrite($fp, "$id,\n");
fwrite($fp, "$demographics,\n");
fwrite($fp, "$problemDataFile,\n");
fwrite($fp, "estimate,$probabilityEstimateType,\n");
fwrite($fp, "format,$choiceParadigmType,\n");
fwrite($fp, "feedback type,$feedbackType,\n");

fwrite($fp, "\n");
for ($i = 0; $i < count($allChoices); $i++) {
   $orderOfThisChoiceSet;
   fwrite($fp, "choice set " . ($i + 1)); // $i + 1 so that the choice sets go from 1..5, and not from 0..4
   fwrite($fp, ",\n");
   fwrite($fp, "choice order,");
   for ($j = 0; $j < count($orderingOfProblems); $j++) {
      if ($orderingOfProblems[$j] == $i) {
         fwrite($fp, $j + 1);
         $orderOfThisChoiceSet = $j;
         break;
      }
   }

   fwrite($fp, ",\n");

   
   for ($j = 0; $j < count($leftRightPresentation[$i]); $j++) {
      if ($leftRightPresentation[$orderOfThisChoiceSet][0] == $j) {
         fwrite($fp, "option " . ($j + 1) . " position,");
         fwrite($fp, "right\n");
      } else if ($leftRightPresentation[$orderOfThisChoiceSet][1] == $j) {
         fwrite($fp, "option " . ($j + 1) . " position,");
         fwrite($fp, "left\n");
      }
   }
   
   for ($j = 0; $j < count($leftRightPresentation[$i]); $j++) {

      $sortedProbabilities = array();

      fwrite($fp, "option " . ($j + 1) . " outcomes,");
      for ($k = 0; $k < count($top[$i][$j]); $k = $k + 2) {
         fwrite($fp, $top[$i][$j][$k]);
         fwrite($fp, ",");
      }
      fwrite($fp, "\n");

      for ($k = 0; $k < count($top[$i][$j]); $k = $k + 2) {
         for ($l = 0; $l < count($associatedOutcomes[$i][$j]); $l++) {
            if ($top[$i][$j][$k] ==  $associatedOutcomes[$i][$j][$l]) {
               array_push($sortedProbabilities, $allSliderChoices[$i][$j][$l]);
            }
         }
      }
    
      fwrite($fp, "option " . ($j + 1) . " probabilities,");
      for ($k = 1; $k < count($top[$i][$j]); $k = $k + 2) {
         fwrite($fp, $top[$i][$j][$k]);
         fwrite($fp, ",");
      }
      fwrite($fp, "\n");

      fwrite($fp, "option " . ($j + 1) . " slider estimates,"); 


      for ($k = 0; $k < count($sortedProbabilities); $k++) {
         fwrite($fp, $sortedProbabilities[$k]);
         fwrite($fp, ",");
      }

      /*
      for ($k = 0; $k < count($allSliderChoices[$i][$j]); $k++) {
         fwrite($fp, $allSliderChoices[$i][$j][$k]);
         fwrite($fp, ",");
      }
      */

      // this while loop adds the extra -'s for sliders that are not used
      while ($k++ < 5) {
         fwrite($fp, "-,");
      }
      fwrite($fp, "\n");

      /*
      fwrite($fp, "option " . ($j + 1) . " slider outcomes,"); 
      for ($k = 0; $k < count($associatedOutcomes[$i][$j]); $k++) {
         fwrite($fp, $associatedOutcomes[$i][$j][$k]);
         fwrite($fp, ",");
      }
      // this while loop adds the extra -'s for sliders that are not used
      while ($k++ < 5) {
         fwrite($fp, "-,");
      }
      */

   }
   
   fwrite($fp, "choices,");
   for ($j = 0; $j < 100; $j++) {
      if ($j < count($allChoices[$i])) {
         fwrite($fp, $allChoices[$i][$j]);
      } else {
         fwrite($fp, "-");
      }
      fwrite($fp, ",");
   }


   fwrite($fp, "\noutcomes,");
   for ($j = 0; $j < 100; $j++) {
      if ($j < count($allOutcomes[$i])) {
         fwrite($fp, $allOutcomes[$i][$j]);
      } else {
         fwrite($fp, "-");
      }
      fwrite($fp, ",");
   }
   fwrite($fp, "\nfinal choice, " . ($finalChoices[$orderOfThisChoiceSet]));

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

