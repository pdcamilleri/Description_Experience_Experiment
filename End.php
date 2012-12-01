<?php
//This code checks that the user came via the homepage, and redicts if not
session_start();
seenHomepage();
function seenHomepage() {
    if (!isset($_SESSION['homepage_visit']) || $_SESSION['homepage_visit'] != true) {
        header("http://www.adriancamilleri.net/Exp11a/");
    } else {
        return true;
    }
}

//Collect the data from the experiment
$packed = $_POST['data'];
$myData = explode(",", $packed);
for ($i = 0; ($i < count($myData)); $i++) {
    # Undo what JavaScript's escape() function did
    $myData[$i] = rawurldecode($myData[$i]);
    # Slashes need escaping when they appear in code
    $myData[$i] = str_replace("\\", "\\\\", $myData[$i]);
    # Quotes need escaping too
    $myData[$i] = str_replace("\"", "\\\"", $myData[$i]);
}

//Save the data as a unique file on the server
$pointsWon = end($myData); 
$uniquecode = $myData[0];
$myFile = "data_" . $uniquecode . "__" . $pointsWon . ".txt";
$fh = fopen("data/$myFile", "w") or die("Couldn't open the file");
fwrite($fh, implode(",",$myData));
fclose($fh);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <meta http-equiv="Expires" content="0" />
    <meta http-equiv="Cache-Control" content="no-cache" />
    <meta http-equiv="Pragma" content="no-cache" />
    <title>Decision-making Game</title>
    <link rel="stylesheet" type="text/css" href="css/main.css" />
</head>
<body>
<div id="container">
  <p class="emphasize">The End</p>
  <p>This is the end of the game! Thank you for your participation. To complete the HIT, please copy and paste the code below into the mTurk HIT page.</p>
  <p id="uniqueCode"> </p>
  <p>(Note: Please do not attempt to play this game again because your unique id has been recorded by our system and you will not recieve any credit or payment for playing again).</p>
</div>
<!-- JavaScript -->
<script type="text/javascript">
    //Copy myData from server to client side
    <?php echo 'var myData = new Array("', join($myData,'","'), '");';?>
    
    //Present the unique code and final instructions
    document.getElementById("uniqueCode").innerHTML = myData[0]+"__"+(myData[myData.length-1]);
    
    //function to round numbers
    function roundNumber(num, dec) {  //num = number to be rounded; dec =  number of decimal places
	var result = Math.round(num*Math.pow(10,dec))/Math.pow(10,dec);
	return result;
    }
</script>
</body>
</html>
