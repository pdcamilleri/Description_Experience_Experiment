
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
   </head>
   <body>
      <div id="container">
         <p class="emphasize">
         Decision-making Game
         </p>

         <p class="expInfo" id="problem"> Problem: <span class="number"> 1 </span> </p>
         <p class="expInfo"   id="trial"> Trial:   <span class="number"> 1 </span> </p>

         <div id="choiceButtons">

         <table>
         <tbody>
         <tr>


            <?php

            $numOptions = 3;

            // we generate the buttons using PHP because we want the number of buttons to be able to change. 2, 3, or more...
            $num = 0;
            $char = 'A';
            // TODO need to allow this value 2 to be specified somehow to allow for 3 options
            for ($i = 0; $i < $numOptions; $i++) {
               echo "<td>";
               echo "<div>";
               echo "<button type='submit' class='myButton choiceButton' id='button_$num' index='$num' name='Choice $char' onclick='displayButtonValue(this)'>Choice $char</button>";
               // note the id is button_$num, where $num is a variable..
               // because this string is enclosed withing doublequotes "",
               // $num will be replaced by the value of the variable $num, which is called variable interpolation

               echo "</div>";
               echo "</td>";
               // now i want each button to have a different id, so increase the value of the variable $num
               $num++;
               $char++;
            }
               echo "</tr>";
               echo "<tr>";


            // a row underneath to display the score for each button
            for ($i = 0; $i < $numOptions; $i++) {
               echo "<td>";
               echo "
                  <p>
                     <span class='score' id='buttonScore_$i'>???</span>
                  </p>
               ";
               echo "</td>";
            }

            ?>
         </div>


         </tr>
         </tbody>
         </table>
         <p>
            <span id="currentScore">0</span>
         </p>





         <button type='submit' class='myButton' id='finalAnswer' name="Make final choice" onclick='makeFinalChoice(this)'>Make final choice</button>
         <table>
         <tbody>
         <tr>

            <?php

               $max = 0;
               if (($file = fopen("outcomes.csv", "r")) !== FALSE) {
                  // get rid of first line
                  fgetcsv($file, 0, ",");
                  while (($data = fgetcsv($file, 0, ",")) !== FALSE) {
                     // get rid of leading column
                     array_shift($data);
                     $currentLength = count(array_unique($data));
                     if ($max < $currentLength) {
                        $max = $currentLength;
                     } 
                  }
                  fclose($file);
               }

               // print a series of sliders for each column
               for ($j = 0; $j < $numOptions; $j++) {
                  echo "<td>";
                  echo "<ul class='sliders' id='sliders_$j'>";
                  $max = 5;
                  for ($i = 0; $i < $max; $i++) {
                     echo '<li>
                              <div class="ui-slider"></div>
                              <span class="value">0</span>
                           </li>';
                     //echo "<div id='slider_$i' class='slider ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all'> </div>";
                  }
                  echo "</ul>";
                  echo "<p>
                        <span class='sliderScore' id='sliderScore_$j'>0</span>
                        </p>";
         
                  echo "</td>";
               }
            ?>

         </tr>
         </tbody>
         </table>
 
         <button type='submit' class='myButton' id='sliderFinalAnswer' name="Make final choice" onclick='submitSliderChoice(this)'>Submit slider choice</button>
      </div>

      <div id="overlay"></div>

   </body>
</html>
