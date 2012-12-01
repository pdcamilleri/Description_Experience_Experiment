//TODO need to retain these demographics. stick it in the php session for current user, extract at the end when writing to a file
// http://mrarrowhead.com/index.php?page=php_passing_variables.php
    //Ensure that every question is answered, otherwise alert an error
    function checkAnswers() {
        var DemographicsForm = document.getElementById("DemographicsForm");
        var questions = ['Residence', 'Gender', 'Age', 'Education', 'Employment', 'Marital', 'Income'];
        var errorMessage = ['Please indicate the country where you live.', "Please indicate your gender.", 'Please indicate your age.', "Please indicate your level of education.", "Please indicate your employment status.", "Please indicate your marital status.", "Please indicate your income."];
        for (var i = 0; i < questions.length; i++) {
            var response = window.document.getElementById(questions[i]).value;
            if (response == null || response == "") {
                alert(errorMessage[i]);
                return false;
            }
        }
    }

// NO IDEA WHAT THIS IS USED FOR
/*
    var participant = <?php
$directory = "data/";
if (glob($directory . "*.txt") != false)
    $filecount = count(glob($directory . "*.txt"));
else 
    $filecount = 1;
echo $filecount;

if ($filecount % 2) 
  $goTo = "D.php";
else
  $goTo = "E.php";
?>';


*/
