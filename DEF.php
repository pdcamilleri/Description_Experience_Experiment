<?php>
	//Collect all the form data
	$ip = $_SERVER["REMOTE_ADDR"];
	$country = $_POST['Residence'];
	$gender = $_POST['Gender'];
	$age = $_POST['Age'];
	$education = $_POST['Education'];
	$employment = $_POST['Employment'];
	$maritalStatus = $_POST['Marital'];
	$income = $_POST['Income'];
	$demographics = array($ip, $country, $gender, $age, $education, $employment, $maritalStatus, $income); 
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
   <head>
      <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
      <meta http-equiv="Expires" content="0" />
      <meta http-equiv="Cache-Control" content="no-cache" />
      <meta http-equiv="Pragma" content="no-cache" />
      <title>Decision-making Game</title>
      <link rel="stylesheet" type="text/css" media="screen" href="css/jquery.css" />
      <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
      <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
      <link rel="stylesheet" type="text/css" href="css/DEF.css" />
      <script type="text/javascript" src="js/DEF.js"></script>
      <script type="text/javascript">
      	var demographics = <?php echo json_encode($demographics); ?>;
      </script>
   </head>
   <body>
      <div id="container">
      	  <div id="instructions">
	         <p id="gameTitle" class="emphasize">
	            The Ticket Game
	         </p>
	         <p id="overallInstructions">
	            Welcome to the “ticket game”. 
	            The ticket game comprises of many different rounds. 
	            In each round you will be shown a number of different boxes. 
	            Each box contains a huge number of different tickets. 
	            Each ticket is labeled with a number. 
	            The number written on a ticket corresponds to game points. 
	            You goal in this game is to earn the most number of game points. 
	            The current round will be shown on the left of the screen. 
	            At the end of each round you will be presented with a different set of boxes that contain new tickets. 
	            Please do not write anything down during the task or use a calculator. 
	         </p>
	         <p id="descriptionInstructions">
				In order to learn about the types of tickets in each box you should read the description written on each box. 
				When you are satisfied that you have a good idea of what types of tickets are in each box, then click on the box that you would prefer to select a ticket from. 
				One ticket will be randomly selected from the selected box. 
				The number written on the ticket will add to your game points score.
				Once you have made a choice the round will end.
	         </p>
	         <p id="samplingInstructions">
				In order to learn about the types of tickets in each box you should sample. 
				To sample a ticket you should click on a box. 
				When you click on a box one ticket will be randomly selected from the box. 
				The number written on the ticket will be displayed below the box. 
				The number of tickets that you have looked at will be recorded on the right of the screen. 
				When you are satisfied that you have a good idea of what types of tickets are in each box, then please click on “Select a ticket” button. 
				Once you have clicked on this button, you will be asked to click on the box that you would like to select a ticket from. 
				One ticket will be randomly selected from the chosen box. 
				The number written on the ticket that you select will add to your game points score. 
				Once you have made a choice the round will end.
	         </p>
	         <p id="feedbackInstructions">
				In order to learn about the types of tickets in each box you should sample from each box. 
				To sample a ticket you should click on a box. 
				When you click on a box one ticket will be randomly selected from the box. 
				The number written on the ticket will be displayed below the box.
				The number written on the ticket will also add to your game points, which is shown in the middle of the screen.
				The number of tickets that you have looked at will be recorded on the right of the screen.
				Once you have looked at 100 tickets the round will end. 
	         </p>
	         <p id="finalChoiceInstructions">
	            Please click on the box that you would like to select a ticket from.
	            The number written on the ticket that you select will add to your game points score. 
	         </p>
	         <p class="expInfo" id="problemNumber"> Problem: <span class="number"> 1 </span></p>
	         <p class="expInfo"   id="trialNumber"> Trial:   <span class="number"> 0 </span></p>
	      </div>
            
            
          <div id="choice" class="text_line">
         	<table style='width: 100%;'>
	         	<tr>
		            <?php
		            $numOptions = 2;
		
		            // we generate the buttons using PHP because we want the number of buttons to be able to change. 2, 3, or more...
		            $char = 'A';
		            for ($i = 0; $i < $numOptions; $i++) {
		               echo "<td>";
		               echo "<div>";
		               echo "<button type='submit' class='myButton choiceButton' id='button_$i' index='$i' name='Choice $char' onclick='displayButtonValue(this)'>nothing</button>";
		               // note the id is button_$num, where $num is a variable..
		               // because this string is enclosed withing doublequotes "",
		               // $num will be replaced by the value of the variable $num, which is called variable interpolation
		
		               echo "</div>";
		               echo "</td>";
		               // now i want each button to have a different id, so increase the value of the variable $num
		               $char++;
		            }
		               echo "</tr>";
		               echo "<tr>";
		
		            // a row underneath to display the score for each button
		            for ($i = 0; $i < $numOptions; $i++) {
		               echo "<td>";
		               echo "
		                  <p style='min-height: 50px;'>
		                     <span class='score' id='buttonScore_$i'></span>
		                  </p>
		               ";
		               echo "</td>";
		            }
		            ?>
	         	</tr>
         	</table>
         	<p>
	         	<span id="currentScore">0</span>
         	</p>
         	<button type='submit' class='myButton' id='finalAnswer' name="Make final choice" onclick='makeFinalChoice(this)'>Select a ticket</button>
          </div> 
         
         
         <div id="estimation" class="estimate"> 
	         <p id="sliderInstructions">
	            Using your mouse, please adjust the bars below to reflect the probability that you think each of the listed outcomes has of occurring on the very next ticket selected.
	            When you are satisfied with your estimated distribution, the please click on the “Submit estimates” button. 
	            Note that the bars associated with each ticket must total 100% for each box before you can submit your estimates. 
	         </p>

	         <table style="width: 100%;">
	         	<tr>
		            <?php
		               $max = 0;
		               // print a series of sliders for each column
		               for ($j = 0; $j < $numOptions; $j++) {
		                  echo "<td>";
		                  echo "<ul class='sliders' id='sliders_$j' index='$j'>";
		                  $max = 5;
		                  for ($i = 0; $i < $max; $i++) {
		                     echo "<li>
		                              <div class='ui-widget slider-box' >
		                                 <span class='outcomeValues'> ? </span>
		                                 <div class='ui-slider'> </div>
		                              </div>
		                           </li>";
		                     //echo "<div id='slider_$i' class='slider ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all'> </div>";
		                  }
		                  echo "</ul>";
		                  echo "<p>
		                        <span class='sliderScore' id='sliderScore_$j' style='color:red'>0%</span>
		                        </p>";
		         
		                  echo "</td>";
		               }
		            ?>
	         	</tr>
	         </table>
 
	         <button type='submit' class='myButton' id='sliderFinalAnswer' name="Make final choice" onclick='submitSliderChoice(this)'>Submit estimates</button>
		      	      
		      <div id="overlay" class='overlay' style='display: none;'>
		      </div>
	      </div>
	    
	    
		  <div id="farewell" style="display: none;" > 
		      <p class="emphasize">The End</p>
		      <p>This is the end of the game! Thank you for your participation. To complete the HIT, please copy and paste the code below into the mTurk HIT page.</p>
		      <p id="uniqueCode">Gs98n5F</p>
		  </div>
      </div>
   </body>
</html>
