<?php 

// if you want to change this from 100 to something else,
// just change it here, the rest of this code should still work
define("NUM_OUTCOMES_PER_ALTERNATIVE", 100);

// number of options/alternatives on each line in the csv file
define("NUM_OPTIONS", 3);

# the description column + the 10 probability + outcome columns
define("OTHER_CRAP", 11);

//header('Content-Type: application/json');
// this is an array variable. it will hold arrays itself. this makes it a 2d array.
// except that those arrays will also hold arrays, so its a 3d array.
$bigArray = array();
// this will allow us to store the entire csv file in a nice format
// $bigArray[0] will refer to the 1st choice set in the csv file, ie the first row (ignoring the initial row of AlternativeA - OutcomeX stuff)
// $bigArray[0][0] will refer to the distribution of outcomes for AlternativeA for choice set 1
// $bigArray[0][1] will refer ...                                 AlternativeB for choice set 1
// $bigArray[0][2] will refer ...                                 AlternativeC for choice set 1
// and finally
// $bigArray[0][0][0] will refer to Outcome1 for AlternativeA for choice set 1.
// so really its $bigArray[choice set][alternative][outcome]
// its complicated, but by storing everything in this way, it will easily work if you add more choice sets, or a 4th alternative, or whatever.

// create an array with all of the folders we are picking from, so you can easily add more folders in future
$folders = array("k2", "k3", "k4"); 
// choose a random element from the above array
$chosenFolder = $folders[array_rand($folders)];

// gets a number between 1 and 200 inclusive
$minFileNumber = 1;
$maxFileNumber = 200;
$chosenFile = rand($minFileNumber, $maxFileNumber);

// put it all together to pick a single file
$choiceSetFile = "choiceSets/${chosenFolder}/${chosenFolder}-${chosenFile}.csv";

$row = 1;
// open the file "outcomes.csv" for reading (the "r"), we will access the file using the $file variable
// if the file is not present, fopen will return FALSE, and so the loop will not execute
//if (($file = fopen("outcomes.csv", "r")) !== FALSE) {
if (($file = fopen($choiceSetFile, "r")) !== FALSE) {
   // this reads in the first line of the file and discards it, because we dont need it.
   fgetcsv($file, 0, ",");

   $lineNumber = 0; // which line in the file we are on, used for randomising & unrandomising questions

   // read the file in line by line using the fgetcsv function
   // this basically gets a line from the file and stores it in $data
   // $data is an array created by cutting up the values in the csv file. it looks something like this
   // ['choice set', '12', '12', '11', '12', ... ]
   while (($data = fgetcsv($file, 0, ",")) !== FALSE) {
      // the first element of each line is "choice set X", which we dont need, so lets get rid of it. 
      // deleting the first element is called "shifting" the array
      // adding an element to the front is call "unshifting"
      // deleting the element from the end, the last element, is called "popping"
      // and finally, adding on an element at the end is called "pushing"
      array_shift($data);
      $smallArray = array();

     // next element is the numberOfTrials for this particular problem, lets shift that too.
     $numberOfTrials = intval(array_shift($data));

      // so now the array contains only numbers, just what we want.
      // TODO i believe the above line is a lie, should remove the next 11 members, referred to as OTHER_CRAP to make the following slices easier
      // so lets adds this to the end of our big array using push
      for ($i = 0; $i < NUM_OPTIONS; $i++) {
       //array_push($bigArray, array_chunk($data, OTHER_CRAP + (OTHER_CRAP + NUM_OUTCOMES_PER_ALTERNATIVE) * $i) NUM_OUTCOMES_PER_ALTERNATIVE);

       // here we send across the problem data as a big array. 
       // the first value is the number of trials
       // the second value of the array is the description, eg 80% chance of 4, else 0
       // the last are all the outcomes
       $description = array_slice($data, (OTHER_CRAP + NUM_OUTCOMES_PER_ALTERNATIVE) * $i, 1);
       $outcomes = array_slice($data, OTHER_CRAP + (OTHER_CRAP + NUM_OUTCOMES_PER_ALTERNATIVE) * $i, NUM_OUTCOMES_PER_ALTERNATIVE);
       $thing = array_merge(
            $description,
            $outcomes
         );
         // the $i is used to randomised/unrandomise the side that the button is on when presented to the participant
         array_push($smallArray, array($i, $thing));
         //array_push($smallArray, array_slice($data, OTHER_CRAP + (OTHER_CRAP + NUM_OUTCOMES_PER_ALTERNATIVE) * $i, NUM_OUTCOMES_PER_ALTERNATIVE));
      }
      // insert the numberOfTrials at the end of each problem array
      array_push($bigArray, array($lineNumber, $smallArray, $numberOfTrials));
      //array_push($bigArray, $smallArray);
      $lineNumber++;
   }
   // close the file
   fclose($file);
}

// if you want to see what the array looks like uncomment this line and run
// php getproblemdata.php 
// on your macair using the terminal application.
// ask me and ill set you up
//print_r($bigArray);


// we want to know the file that we used to get the choice sets from
array_push($bigArray, $choiceSetFile);

// so we are done, just need to send this array back to the webpage
echo json_encode($bigArray);
//print_r($bigArray);
?>
