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

//Get the users IP address
if (!empty($_SERVER['HTTP_CLIENT_IP'])) { //check ip from share internet
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) { //to check ip is pass from proxy
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

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
    <link rel="stylesheet" type="text/css" href="css/DE.css" />
    <script type="text/javascript" src="js/DE.js"></script>
</head>
<body>
<div id="container">
		<p class="emphasize">
			 Decision-making Game
		</p>
        
		<div id="Options">
            <p id="instructions_Options1">
				 Consider the following alternative options. Remember: if you see a "-" sign before a number, then this option potentially <i>loses</i> points.
			</p>
			<table id="optionHeadings_x1Choice" class="center">
    			<tr>
    				<td class="">
    					<span class="bold" id="leftOptionTitle"></span>
    				</td>
    				<td class="">
    					<span class="bold" id="rightOptionTitle"></span>
    				</td>
    			</tr>
    			<tr>
    				<td class="box">
    					<span id="leftOption"></span>
    				</td>
    				<td class="box">
    					<span id="rightOption"></span>
    				</td>
    			</tr>
			</table>
        </div>
        
        <div id="x40Choice">
            <p id="instructions_Options2">
				 Choose repeatedly between the two options below with the <b>goal of earning the most, or losing the least, number of points</b> with your dozen or so plays. You can make a selection by moving your mouse cursor over the option and then left-clicking. Although you will not know what the option pay outs are like initially, you will quickly learn. Remember: if you see a "-" sign before a number, then this option potentially <i>loses</i> points. The outcome of the option that you select will add to or subtract from your running points score. NOTE: You will also see what outcome you would have recieved had you selected the other option. 
			</p>
            <p class="emphasize">
                Points: <span id="currentScore"></span>
            </p>
        </div>
             
		<div id="x1Choice">
			<p id="instructions_x1Choice">
                 Please click on the option that you would choose if you were going to receive a <span class="singleOutcomeEmphasize bold">single outcome</span> from <span class="singleOutcomeEmphasize bold">1 single play</span> from one of these options.
			</p>
 		</div>  
            
 		<div id="x100Choice">
			<p id="instructions_x1Choice">
				 Please click on the option that you would choose if you were going to receive the <span class="multipleOutcomeEmphasize bold">combined outcome</span> of <span class="multipleOutcomeEmphasize bold">100 plays</span> from one of these options.
			</p>
 		</div>
            
        <div id="Choices">
			<button type="submit" class="myButton" id="leftButton"></button>
			<button type="submit" class="myButton" id="rightButton"></button>
			<p>
				<span id="currentScore"></span>
			</p>
        </div>

		<div id="sliderBox">
            <p>
                Imagine that you had 100 plays to freely distribute in any way that you liked. Please use the slider to <span class="allocateOutcomeEmphasize bold">allocate the 100 plays</span> between the two options. Click anywhere on the slider bar below to activate it. 
            </p>
            <div id="slider"></div>
            <input type="text" id="sliderAmountLeft" disabled="disabled" class="disabled"  />
            <input type="text" id="sliderAmountRight" disabled="disabled" class="disabled"  />
            <br />
        </div> 
             
   	<form name="data" method="post" action="End.php"> 
		<div id="SoP">
			<p>
				 Please indicate the <span class="bold">strength of your last choice </span> on the following scale:
			</p>
				<table id="SoPHeadings">
				<tr>
					<td width='14.285714285714%' class="LabelContatiner ">
						<span class='LabelWrapper'><label for='SoP1' id="labelSoP1"></label></span>
					</td>
					<td width='14.285714285714%' class="LabelContatiner alt">
						<span class='LabelWrapper'><label for='SoP2' id="labelSoP2"></label></span>
					</td>
					<td width='14.285714285714%' class="LabelContatiner ">
						<span class='LabelWrapper'><label for='SoP3' id="labelSoP3"></label></span>
					</td>
					<td width='14.285714285714%' class="LabelContatiner alt">
						<span class='LabelWrapper'><label for='SoP4' id="labelSoP4"></label></span>
					</td>
					<td width='14.285714285714%' class="LabelContatiner ">
						<span class='LabelWrapper'><label for='SoP5' id="labelSoP5"></label></span>
					</td>
					<td width='14.285714285714%' class="LabelContatiner alt">
						<span class='LabelWrapper'><label for='SoP6' id="labelSoP6"></label></span>
					</td>
					<td width='14.285714285714%' class="LabelContatiner ">
						<span class='LabelWrapper'><label for='SoP7' id="labelSoP7"></label></span>
					</td>
				</tr>
				<tr>
					<td style='width: 14.285714285714%;' class="ControlContainer ">
						<input type="radio" name="SoP" id="SoP1" value="1" />
					</td>
					<td style='width: 14.285714285714%;' class="ControlContainer alt">
						<input type="radio" name="SoP" id="SoP2" value="2" />
					</td>
					<td style='width: 14.285714285714%;' class="ControlContainer ">
						<input type="radio" name="SoP" id="SoP3" value="3" />
					</td>
					<td style='width: 14.285714285714%;' class="ControlContainer alt">
						<input type="radio" name="SoP" id="SoP4" value="4" />
					</td>
					<td style='width: 14.285714285714%;' class="ControlContainer ">
						<input type="radio" name="SoP" id="SoP5" value="5" />
					</td>
					<td style='width: 14.285714285714%;' class="ControlContainer alt">
						<input type="radio" name="SoP" id="SoP6" value="6" />
					</td>
					<td style='width: 14.285714285714%;' class="ControlContainer ">
						<input type="radio" name="SoP" id="SoP7" value="7" />
					</td>
				</tr>
			</table>
		</div>
        
        <div id="continue">
            <input type="button" class="myButton" id="continueButton" value="Continue" />
    		<input type="hidden" name="data" />
        </div>        
	</form>
</div>
</body>
</html>
