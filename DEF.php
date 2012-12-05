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

         <div id="choiceButtons">
            <?php
            // we generate the buttons using PHP because we want the number of buttons to be able to change. 2, 3, or more...
            $char = 'a';
            // TODO need to allow this value 2 to be specified somehow to allow for 3 options
            for ($i = 0; $i < 2; $i++) {
               // note the id is button_$char, where $char is a variable.
               // because this string is enclosed withing doublequotes "",
               // $char will be replaced by the value of the variable $char, called variable interpolation
               //echo "<button type='submit' class='myButton' id='button_$char'></button>";
               echo "<button type='submit' class='myButton' id='button_$char' onclick='displayStuff(this)'></button>";
               // now i want each button to have a different id, so increase the value of the variable $char
               $char++;
            }
            ?>
            <p>
               <span id="currentScore"></span>
            </p>
         </div>

      </div>
   </body>
</html>
