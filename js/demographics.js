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