// defining the different conditions that are possible
var ProbabilityEstimateTypeEnum = {
     NONE  : {value: 0, name: "none",  code: "n"}, 
     ALL   : {value: 1, name: "all",   code: "a"}, 
     FINAL : {value: 2, name: "final", code: "f"}
};

var ChoiceParadigmEnum = {
     DESCRIPTION : {value: 0, name: "description", code: "d"}, 
     SAMPLING    : {value: 1, name: "sampling",    code: "s"}, 
     FEEDBACK    : {value: 2, name: "feedback",    code: "f"}
};

var FeedbackTypeEnum = {
     NONE     : {value: 0, name: "none",     code: "n"}, 
     PARTIAL  : {value: 1, name: "partial",  code: "p"}, 
     COMPLETE : {value: 2, name: "complete", code: "c"}
};


var uuid = createUUID();
var lastSeenOutcome;

// these variables will hold the value of each condition that is being used in the current experiment
//var probabilityEstimateType = ProbabilityEstimateTypeEnum.NONE;
var probabilityEstimateType = (function() {
      if (Math.random() < 0.5) { 
         return ProbabilityEstimateTypeEnum.ALL; // FINAL
      } else { 
         return ProbabilityEstimateTypeEnum.ALL;
      }
})();
var choiceParadigmType = ChoiceParadigmEnum.SAMPLING;
var feedbackType = FeedbackTypeEnum.COMPLETE;

//var TIMEOUT_LENGTH = 2;
// how long the outcome remains in its original position before the animation 
var PRE_MOVE_TIMEOUT_LENGTH = 1;
// during, how long the animation takes
var PER_MOVE_TIMEOUT_LENGTH = 0;
// after, how long to leave the outcome next to the animation
var POST_MOVE_TIMEOUT_LENGTH = 1;

var NUM_OF_CHOICE_PARADIGMS = 1;
var NUM_OF_FEEDBACK_TYPES = 1;

var FINAL_CHOICE_FADE_IN_LENGTH = 3;

// 3d array. will use it to store the 3d array created by getproblemdata.php
// this will contain the results of all buttons, eg 4, 4, 4, 0, 4, 0, 4, 4, ...
var problemData = new Array();
// IMPORTANT NOTE, problem data contains meta information to randomise and unrandomise the problems
// problemData = [ 
//                  [0, [ all the values for ChoiceSet 1] ],
//                  [1, [ all the values for ChoiceSet 2] ],
//                  ..
// The choice sets can then be shuffled to produce a random ordering for the participant, 
// but can just as easily be unshuffled by sorting by that lone numbering element.
// this allows us to easily randomise and unrandomise for each participant

var problemDataFile;
var orderingOfProblems = [];
var leftRightPresentation = [];


// this will contain the descriptions for each problem, eg "80% chance of 4, else 0"
var problemDescriptions = new Array();
// an array to hold a counter variable for each choice set, indicating where we are up to in each distribution.
var counters = [];
var choiceSetCounter = 0; // indicates which choice set we are up to (in other words, which line in the csv file)
var makingFinalChoice = false;
var finalChoices = [];
var sliderChoices = [];
var trialNumber = 1;
var problemNumber = 1;

// will contain which button the participant chooses
var choices = new Array( 
      new Array(),
      new Array(),
      new Array(),
      new Array(),
      new Array()
);
// will contain the outcome from that particular button
var outcomes1 = new Array( 
      new Array(),
      new Array(),
      new Array(),
      new Array(),
      new Array()
);
var outcomes2 = new Array( 
      new Array(),
      new Array(),
      new Array(),
      new Array(),
      new Array()
);
var sliderChoices = new Array( 
      new Array(),
      new Array(),
      new Array(),
      new Array(),
      new Array()
);
var associatedOutcomes = new Array( 
      new Array(),
      new Array(),
      new Array(),
      new Array(),
      new Array()
);



// TODO 1-1 relatonship between the above two, can put into 2d array

// bigger array to hold all choices and outcomes, which will be sent to the server at the end of the experiment
var allOutcomes1 = new Array();
var allOutcomes2 = new Array();
var allChoices = new Array();

// used when animating the outcomes
var centerX = 0;
var centerY = 0;
var startX = 0;
var startY = 0;

// execute this function when the window loads
window.onload = function start() {
	document.getElementById("descriptionInstructions").style.display="none";
	document.getElementById("feedbackInstructions").style.display="none";
	document.getElementById("finalChoiceInstructions").style.visibility="hidden";
	$(".estimate").hide();
	
   // initialise the counters array with 0's depending on how many buttons we are dealing with
   var length = document.getElementsByClassName("myButton").length;
   for(var i = 0; i < length; i++) {
      counters[i] = 0;
   }
   initiateSliders();
   cleanVariables();
   disableMakeFinalChoice();

   var $this = $("#currentScore");
   var offset = $this.offset();
   var width = $this.width();
   var height = $this.height();

   centerX = offset.left + width / 2;
   centerY = (offset.top + height / 2) - 30; 
   /* minus 30 so that the text appears above the current score, not on top of it */

   // hide the total score
   if (choiceParadigmType == ChoiceParadigmEnum.SAMPLING) {
      $("#currentScore").hide();
   } else if (choiceParadigmType == ChoiceParadigmEnum.FEEDBACK) {
      $("#finalAnswer").hide()
   }

   if (choiceParadigmType == ChoiceParadigmEnum.SAMPLING) {
      $("#finalAnswer").hide();
   }

};

function cleanVariables() {
   trialNumber = 1;
   //choices = new Array();
   //outcomes = new Array();

   setSliderColors();
}

Array.prototype.shuffle = function () {
   for (var i = this.length - 1; i > 0; i--) {
      var j = Math.floor(Math.random() * (i + 1));
      var tmp = this[i];
      this[i] = this[j];
      this[j] = tmp;
   }

   return this;
}

// creates three random light colors using the same r, g, b values
// and assigns these colors to the sliders
function setSliderColors() {

   // the base elements to produce the colors from
   letters = "9ABCDE".split('');
   var r = "FF",
       g = letters[Math.floor(Math.random() * letters.length)] + letters[Math.floor(Math.random() * letters.length)],
       b = letters[Math.floor(Math.random() * letters.length)] + letters[Math.floor(Math.random() * letters.length)]
   ;

   // make an array of 3 colors, each composed of the same rgb values, just rotated along
   colors = ["#" + r + g + b, "#" + g + b + r, "#" + b + r + g];
   colors.shuffle();

   // change the slider and associated button to these colors
   $(".sliders").each(function(index) { 
         $(this).find(".slider-box").css("background-color", colors[index]); 
         $("#button_" + index).css("background", "-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #EDEDED), color-stop(1," + colors[index] + ") )")
                              .css("background", "-moz-linear-gradient( center top, #EDEDED 5%, " + colors[index] + " 100% )");

   });
}

// used when generating the "Choice A" that appears on each choice button
var nextLetter = 0;
var alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

function getNextLetter() {
   var ret = alphabet[nextLetter];
   nextLetter++;
   // just cycle around, ...XYZABC...
   if (nextLetter == alphabet.length) {
      nextLetter = 0;
   }
   return ret;
}

// writes "Choice A" in the choice buttons
function createChoiceButtonText() {

   if (choiceParadigmType == ChoiceParadigmEnum.DESCRIPTION) {
      $(".choiceButton").each(function(index) {
         $(this).text(problemDescriptions[choiceSetCounter][index]);
      });
   } else {
      $(".choiceButton").each(function() {
         $(this).text("Box " + getNextLetter());
      });
   }

}
   

// when the page has loaded, go and grab the problem data, stick it in our problemData variable
$(document).ready(function() {
      $.get("getproblemdata.php", function(data, status) {
            problemData = data;
            problemDataFile = problemData.pop();

            for (var i = 0; i < problemData.length; i++) { 
               problemDescriptions[i] = new Array();
               for (var j = 0; j < problemData[i][1][1].length; j++) { 
                  // we remove the description from the problemData array
                  // and put it in its own array
                  problemDescriptions[i].push(problemData[i][1][j][1].shift());
               }  
            }

            // mix up the order in which the choice sets are presented to the participant
            problemData.shuffle();

            // record the order that the problems will be presented in
            for(var i = 0; i < problemData.length; i++) { 
               orderingOfProblems.push(problemData[i][0]);
            }


            // shuffle the side in which a problem appears on, (left or right);
            // TODO this needs to changed if 3 problems are being presented to the user
            for (var i = 0; i < problemData.length; i++) {
               if (Math.random() < 0.5) {
                  // swap the arrays
                  var tempArray = problemData[i][1][0];
                  problemData[i][1][0] = problemData[i][1][1];
                  problemData[i][1][1] = tempArray;

                  // also record that we did this swap
                  // note that right and left are in a different order than they are in the line below
                  leftRightPresentation[i] = new Array(0, 1); // 0 == left, 1 == right

               } else {
                  leftRightPresentation[i] = new Array(1, 0);
               }
                  // TODO
                  // uncomment the line below, and comment the lines above when there are 3 problems per choice set
                  //problemData[i][1].shuffle();
            }

            // TODO
            // find better place to put this
            populateOutcomeValuesInSlider();
            createChoiceButtonText();

            
         }, 
         'json' 
         );

      });

// displays the next outcome, called when a button is pressed
function displayButtonValue(button) {

   disableChoiceButtonsSilently();
 
   // display an outcome value for each button
   $(".choiceButton").each(function() {
         // not sure why I cant do $(this).getAttribute("index")
         var $this = $(this);
         var index = $this.attr("index");

         // get a random element for this particular button and remove it from the array of possible outcomes using the splice()
         //var desiredIndex = Math.floor(Math.random() * problemData[choiceSetCounter][1][index][1].length);
         //var randomElement = problemData[choiceSetCounter][1][index][1].splice(desiredIndex, 1)[0]; 
         var randomElement = problemData[choiceSetCounter][1][index][1].shift();
         // the [0] at the end of this last line is because splice returns an array, but we want the first element of the array, hence the [0]
         // the [1] in problemData[CSC][1], is because of the randomising/unrandomising variable

         // display the random element, but hide it first (we will display it later based on the FeedbackType
         $("#buttonScore_" + index).hide()
                                   .html(randomElement);

         lastSeenOutcome = randomElement;

   });

   // get the particular button the user clicked
   var $this = $("#buttonScore_" + button.getAttribute('index'));

   // TODO make the act of getting a value from the distributions a function so AC can easily change to an iterative version

   // this only gets executed when we are making the final choice
   if (makingFinalChoice) {
      // reset everything ready for the next problem
      makingFinalChoice = false;

      recordFinalChoice(problemData[choiceSetCounter][1][parseInt(button.getAttribute("index"))][0] + 1, parseInt($this.html()));

      // get rid of the overlay, revert the instruction text back to black
      $("#overlay").hide();
      document.getElementById("finalChoiceInstructions").style.visibility="hidden";
      $("#finalChoiceInstructions").css("color", "black");

      // disable the choice buttons while the user does the sliders part of the problem
      disableChoiceButtons();

      // this wasnt a real sample, so exit from the function
      moveToNextPhase();
      return;
   }

   // depending on the feedbackType, display the various outcomes to the user
   if (feedbackType == FeedbackTypeEnum.NONE) {
      // do nothing, no feedback
   } else if (feedbackType == FeedbackTypeEnum.PARTIAL) {
      // only show the current score
      $this.show();
   } else if (feedbackType == FeedbackTypeEnum.COMPLETE) {
      // show all scores
      $(".score").show();
      // TODO make this bold to show the score that was selected
   }

   disableChoiceButtonsSilently();
   disableMakeFinalChoiceSilent();

   // we have disabled the buttons, now cause a timeout
   setTimeout(moveOutcomeToTotalScore, PRE_MOVE_TIMEOUT_LENGTH * 2500, $this.html(), $this);

   // get the index of this button into our various arrays
   var index = button.getAttribute("index");
   counters[index]++;
   if (counters[index] == 3) {
      counters[index] = 0;
   }

   //if (choiceParadigmType == ChoiceParadigmEnum.FEEDBACK && getTrialNumber() == 4) {
   //if (choiceParadigmType == ChoiceParadigmEnum.FEEDBACK && getTrialNumber() == 4) {
      // TODO
      // move to next problem
      //alert("you have sampled 5 times, moving on to the next phase now");
      //disableChoiceButtons();
      //moveToNextPhase();
   //}

   setTrialNumber(getTrialNumber() + 1);

   // problemDate[choiceSetCounter][0] is the choiceSet, one of {0, 1, 2, 3, 4}
   // problemData[choiceSetCounter][1][parseInt(index)][0] is the outcomes, one of {0, 1, 2}, 0 for the first outcome in the csv file,
   // and we add 1 to get one of {1, 2, 3}
   choices[problemData[choiceSetCounter][0]].push(problemData[choiceSetCounter][1][parseInt(index)][0] + 1);
   //outcomes[problemData[choiceSetCounter][0]].push(parseFloat($("#buttonScore_" + index).html()));

   // because we dont want the one they selected anymore, we now want both
   outcomes1[problemData[choiceSetCounter][0]].push(parseFloat($("#buttonScore_0").html()));
   outcomes2[problemData[choiceSetCounter][0]].push(parseFloat($("#buttonScore_1").html()));

   // check if the participant has made 100 samples. If they have, then force them to make a final choice.
   if (getTrialNumber() > getNumberOfWantedTrials()) {
      // we do this by clicking on the "make final choice" button for them.
      setTimeout(function() {
            $("#finalAnswer").click();
      }, 2500);
      // we use setTimeout here to wait for the animation (where the outcomes moves from the box to the total) to complete
   }

}

function setTrialNumber(value) {
   // fix this to use the actual var trialNumber
   $("#trialNumber > .number").html(value);
}

function getTrialNumber() {
   //return trialNumber;
   return parseInt($("#trialNumber > .number").html());
}

// visually update the counter
function moveOutcomeToTotalScore(value, $outcome) {

   // animate the outcome moving to the total score
   startX = $outcome.position().left;
   startY = $outcome.position().top;
   //$outcome.animate({'left': centerX - startX, 'top': centerY - startY}, PER_MOVE_TIMEOUT_LENGTH * 1000);

   // PER + POST since animate() is non blocking
   setTimeout(postAnimateCleanup, PER_MOVE_TIMEOUT_LENGTH * 1000, value, $outcome);
   // the following line has a longer timeout to allow for the animation to complete
   //setTimeout(postAnimateCleanup, (PER_MOVE_TIMEOUT_LENGTH + POST_MOVE_TIMEOUT_LENGTH) * 1000, value, $outcome);

}

function postAnimateCleanup(value, $outcome) {

   // enable buttons
   if (getTrialNumber() <= getNumberOfWantedTrials()) {
     enableChoiceButtons();
   }
   enableMakeFinalChoice();

   // update the score
   // a little hacky since the score is considered to be text and not numerical
   var currentScore = document.getElementById("currentScore");
   currentScore.innerHTML = (parseFloat(currentScore.innerHTML) + parseFloat(value)).toFixed(1);

   // reset all the scores
   $(".score").html("");

   // move the button back to its original position
   // the button contains no text (due to the above line), so this animation is not visible to the user
   $outcome.animate({'left': 0, 'top': 0}, 1);

}

// called when the users click on the "make final choice" button. Sometimes this is hidden and is clicked for the user using JS
function makeFinalChoice(button) {
   disableChoiceButtonsSilently(); // pretty sure this is redundant...

   // first we enable the overlay to darken the page
   $("#overlay").fadeIn(FINAL_CHOICE_FADE_IN_LENGTH * 1000);

   // highlight the instruction text by making it white on the dark overlay backdrop
   //$("#finalChoiceInstructions").css("color", "white");
	document.getElementById("finalChoiceInstructions").style.visibility="visible";
   $("#finalChoiceInstructions").animate({"color": "white"}, FINAL_CHOICE_FADE_IN_LENGTH * 1000);

   setTimeout(enableChoiceButtons, (PRE_MOVE_TIMEOUT_LENGTH + PER_MOVE_TIMEOUT_LENGTH + POST_MOVE_TIMEOUT_LENGTH * 2) * 1000);

   // need to toggle the javascript called by the buttons to now record a final answer
   makingFinalChoice = true;

   // disable the button until we begin the next problem
   disableMakeFinalChoice();

}

function setProblemNumber(value) {
   // TODO
   // change this to merely update the variable
   // then have someother method take this information and update the entire page
   // should do this for more things
   // and have them all in an update()
   $("#problemNumber > .number").html(value);
}

function getProblemNumber() {
   //return problemNumber;
   return parseInt($("#problemNumber > .number").html());
}

function setTrialNumber(value) {
   $("#trialNumber > .number").html(value);
}

function getTrialNumber() {
   return parseInt($("#trialNumber > .number").html());
}

// returns the number of trials that the experimenter wants the participant to make before entering the "choosing" stage
function getNumberOfWantedTrials() {
  if (choiceParadigmType == ChoiceParadigmEnum.SAMPLING) {
    return problemData[choiceSetCounter][2];
  } else {
    return 100; // default number of trials before participant is forced into the choosing phase
    // TODO make this a constant?
  }
}

function recordFinalChoice(choice, value) {
   // record their choice
   finalChoices.push(choice);
   // update their overall score
   // overallScore += parseFloat(value).toFixed(1);
   //alert("You chose " + choice + " which returned a value of " + value);
}

function moveToNextPhase() {
 
   // TODO
   // probably put a load new problem thing in here
   choiceSetCounter++;
   //if (choiceSetCounter == 3) {
   //   choiceSetCounter = 0;
   //}
 
   if (probabilityEstimateType == ProbabilityEstimateTypeEnum.NONE) {
      // check if we are at the end of the experiment
      // this is the exit point for the None probability type only
      if (choiceSetCounter == problemData.length) {
         endExperiment();
         return;
      }
 
      startNextProblem();
      // no slider portion, move direction to the next problem
      // TODO increment some phase thing here
   } else if (probabilityEstimateType == ProbabilityEstimateTypeEnum.FINAL) {
      if (choiceSetCounter == problemData.length) {
         $(".estimate").toggle();
      } else {
         startNextProblem();
      }
   } else if (probabilityEstimateType == ProbabilityEstimateTypeEnum.ALL) {
      // show the estimate phase (the sliders)
      $(".estimate").toggle();
   }

   return;
}


function initiateSliders() {

      disableSliderSubmit();

        var sliders = $(".sliders .ui-slider");
        sliders.slider({ 
			value:0,
			min: 0,
			max: 100,
			step: 1,
			slide: function( event, ui ) {
            // here we set this to the current value of the slider
            // based off http://jsfiddle.net/elijahmanor/dLq5B/
            var slider = $( this ).data().slider;
            slider.element.find( ".ui-slider-handle" ).text( ui.value );



            var total = 0;
            // sums up the total value of each slider that is not the current slider
            // (probably/definately a better way to do this)
            $(this).parent().parent().parent().find(".ui-slider").not(this).each(function() {
               total += $(this).slider("option", "value");
            });

            // Need to do this because apparently jQ UI
            // does not update value until this event completes
            total += ui.value;

            // show the value to the user

            // first get the score associated with this series of sliders
            var sliderScore = $(this).parent().parent().parent().parent().find(".sliderScore");
            sliderScore.html(total + '%');

            // update the color if the sliders total to 100%
            if (total == 100) {
               sliderScore.css('color','green');
               //$("#sliderScore").css('color','#00ff00');
            } else {
               sliderScore.css('color','red');
               //$("#sliderScore").css('color','#ff0000');
            }

            // TODO
            // also fix up styling and make columns of sliders

            // see if we should enable the submit button
            checkSliderTotals();

			}
		}); 

      // set the initial value of the slider to be 0
      $(".ui-slider-handle").text("0");
        
}

function checkSliderTotals() {
   var allSlidersAre100 = true;
   
   // check all the sliders. if just one is off, disable the submit button
   $(".sliderScore").each(function() {
         if ($(this).html() != '100%') {
            allSlidersAre100 = false;
         }
   });

   if (allSlidersAre100) {
      enableSliderSubmit();
   } else {
      disableSliderSubmit();
   }

}

function disableSliderSubmit() {
   document.getElementById("sliderFinalAnswer").disabled = true;
   document.getElementById("sliderFinalAnswer").style.color = 'grey';
}

function enableSliderSubmit() {
   document.getElementById("sliderFinalAnswer").disabled = false;
   document.getElementById("sliderFinalAnswer").style.color = '';
}

function disableMakeFinalChoice() {
   document.getElementById("finalAnswer").disabled = true;
   document.getElementById("finalAnswer").style.color = 'grey';
}

function enableMakeFinalChoice() {
   document.getElementById("finalAnswer").disabled = false;
   document.getElementById("finalAnswer").style.color = '';
}

// disables the final choice button without showing the user this has occurred
function disableMakeFinalChoiceSilent() {
   document.getElementById("finalAnswer").disabled = true;
//   document.getElementById("finalAnswer").style.color = 'red';
}


function enableChoiceButtons() {
   $(".choiceButton").removeAttr('disabled')
                     .css('color', '');
}


function disableChoiceButtons() {
   $(".choiceButton").attr('disabled','disabled')
                     .css('color', 'grey');
}

function disableChoiceButtonsSilently() {
   $(".choiceButton").attr('disabled','disabled')
                     .css('color', 'red');
}

// saves the current value of all the sliders in the main slider array
function submitSliderChoice(button) {

   // the outcomes associated with each slider, eg 25.6 or something from the distribution
   var sliderOutcomes = new Array( 
         new Array(),
         new Array()
   );

   var sliderVals = new Array( 
         new Array(),
         new Array()
   );
   //outcomes[problemData[choiceSetCounter][1]]
   $(".sliders .ui-slider").each(function() {
      // if the value of this slider is "-", then it means we should ignore it because it doesnt contain a useful value
      if ($(this).parent().children("span").html() != "-") {
         // add all of their slider choice values to an array
         sliderOutcomes[parseInt($(this).parent().parent().parent().attr("index"))].push(parseFloat($(this).parent().children("span").html()));
         sliderVals[parseInt($(this).parent().parent().parent().attr("index"))].push($(this).slider("option", "value"));
         //parseInt($(this).parent().parent().parent().attr("index")); // this is the index, either 0, 1, 2, like left, middle, right
      }
   });

   // if this the left-right ordering was reveresed at the start, then we want to swap the slider information
   // so that the correct slider information is in the correct place in the output file
   //if (leftRightPresentation[problemData[choiceSetCounter - 1][0]][0] == 0) {
   if (leftRightPresentation[choiceSetCounter - 1][0] == 0) {
      var temp = sliderOutcomes[0];
      sliderOutcomes[0] = sliderOutcomes[1];
      sliderOutcomes[1] = temp;
      temp = sliderVals[0];
      sliderVals[0] = sliderVals[1];
      sliderVals[1] = temp;
   }

   // add the array containing the slider choices for this particular problem to 
   // a larger array that stores slider choices for all problems in the experiment

   sliderChoices[problemData[choiceSetCounter - 1][0]] = sliderVals;
   associatedOutcomes[problemData[choiceSetCounter - 1][0]] = sliderOutcomes;
   // we are using choiceSetCounter - 1 here as choiceSetCounter is prematurely incremented. need to offset this
   //sliderChoices.push(sliderVals);

   // reset the sliders
   $(".ui-slider").slider("value", 0);
   $(".sliderScore").html("0%").css('color', 'red');
   $(".ui-slider-handle").text("0");
   $(".slider-box span").html("-");

   // hide estimate sliders, show explore phase buttons for next problem
   $(".estimate").toggle();

   // save choice and outcome data
   recordData();

   // check if we are at the end of the experiment
   // this is the exit point for the Final and All Probability Types
   if (choiceSetCounter == problemData.length) {
      endExperiment();
      return;
   }

   startNextProblem();
}

function startNextProblem() {

   // set everything up for the next problem
   populateOutcomeValuesInSlider();
   enableChoiceButtons();
   setProblemNumber(getProblemNumber() + 1);
   setTrialNumber(1);
   cleanVariables();
   createChoiceButtonText();
}   

// TODO
// better name
// this function sets the outcomes for the sliders to correspond to the particular choice set/problem
function populateOutcomeValuesInSlider() {

   // all the values are in problemData[choiceSetCounter][0/1/2][0..end]
   var length = problemData[choiceSetCounter][1].length - 1;
   for (var i = 0; i < length; i++) {

      // unhide all the sliders, in case some were hidden for the previous problem 
      $("#sliders_" + i).children().show();

      // get the unique elements present in the outcomes array and assign these to the sliders
      //var uniqueArray = unique(problemData[choiceSetCounter][1][i][1]);
      var uniqueArray = unique(problemData[choiceSetCounter][1][i][1].slice(0, 20));
      var outcomeValues = $("#sliders_" + i).find(".outcomeValues"); 
      for (var j = 0; j < uniqueArray.length; j++) {
         outcomeValues[j].innerHTML = uniqueArray[j];
      }

      // hide the sliders that are not used
      $("#sliders_" + i).children().slice(uniqueArray.length).hide();

   }

}

// http://stackoverflow.com/a/1890233 
function unique(arr) {
   var hash = {}, result = [];
   for ( var i = 0, l = arr.length; i < l; ++i ) {
      if ( !hash.hasOwnProperty(arr[i]) ) { //it works with objects! in FF, at least
         hash[ arr[i] ] = true;
         result.push(arr[i]);
      }
   }
   return result;
}

function recordData() {
   allChoices.push(choices);
   allOutcomes1.push(outcomes1);
   allOutcomes2.push(outcomes2);
}

function endExperiment() {
   sendDataToServer();
   showEndPage();
}

function showEndPage() {
   $("#farewellText").html(
         "Thank you for playing the game. The number written on the ticket that you selected was "
         + lastSeenOutcome
         + ". This means that you will be given a bonus payment of $" 
         + (lastSeenOutcome / 100).toFixed(2) 
         + ". To complete the HIT please copy the following code back into the AMT website:"
   );
   $("#uniqueCode").html(uuid + "_" + ((lastSeenOutcome / 100).toFixed(2)) * 100);
   $("#container").hide();
   $("#farewell").show()
}

function sendDataToServer() {

   $.post("posting.php", { 
         'id' : uuid, 
         'orderingOfProblems': JSON.stringify(orderingOfProblems),
         'leftRightPresentation': JSON.stringify(leftRightPresentation),
         'allChoices': JSON.stringify(choices), 
         'allOutcomes1': JSON.stringify(outcomes1),
         'allOutcomes2': JSON.stringify(outcomes2),
         'allSliderChoices': JSON.stringify(sliderChoices),
         'associatedOutcomes': JSON.stringify(associatedOutcomes),
         'finalChoices':JSON.stringify(finalChoices),
         'problemDataFile': JSON.stringify(problemDataFile),
         'demographics': unescape(demographics),
         'probabilityEstimateType': JSON.stringify(probabilityEstimateType.name),
         'choiceParadigmType': JSON.stringify(choiceParadigmType.name),
         'feedbackType': JSON.stringify(feedbackType.name)
   } );

}
   
function setProbabilityEstimate(type) {
   probabilityEstimateType = ProbabilityEstimateTypeEnum[type];
}

function setFeedback(type) {
   feedbackType = FeedbackTypeEnum[type];
}

function setChoiceParadigm(type) {
   choiceParadigmType = ChoiceParadigmEnum[type];
   if (choiceParadigmType == ChoiceParadigmEnum.SAMPLING) {
      $("#currentScore").hide();
   } else {
      $("#currentScore").show();
   }
   
}

// from http://stackoverflow.com/questions/105034/how-to-create-a-guid-uuid-in-javascript?lq=1
function createUUID() {
   // http://www.ietf.org/rfc/rfc4122.txt
   var s = [];
   var hexDigits = "0123456789abcdef";
   for (var i = 0; i < 10; i++) {
      s[i] = hexDigits.substr(Math.floor(Math.random() * 0x10), 1);
   }
   // Dont need this extra stuff if we just want 10 character long identifiers

   //s[14] = "4";  // bits 12-15 of the time_hi_and_version field to 0010
   //s[19] = hexDigits.substr((s[19] & 0x3) | 0x8, 1);  // bits 6-7 of the clock_seq_hi_and_reserved to 01
   //s[8] = s[13] = s[18] = s[23] = "-";

   var uuid = s.join("");
   return uuid;
}
