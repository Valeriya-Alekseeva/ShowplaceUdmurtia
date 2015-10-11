(function(global, $){
    var testNextButton = $(".test-next-js"),
        testForm = $(".test-form-js"),
        testResultBlock = $(".test-result-js"),
        testEndButton = $(".test-end-js"),
        answers = [1,1,1,1,2,2,2],
        resultTitle = "",
        resultText = "";

    testNextButton.on('click',function(){
        var nextSectionName = $(this).data("section"),
            nextSection = $(".test-section-js[data-section='"+nextSectionName+"']"),
            currentSection = $(this).parent(".test-section-js"),
            currentAnswer = currentSection.find("input[type='radio']:checked");

        if(currentAnswer.length > 0){
            currentSection.removeClass("active");
            nextSection.addClass("active");
        }
    });

    testForm.submit(function(e){
        e.preventDefault();
        return false;
    });

    testEndButton.on('click',function(){
        var testResult = testForm.serializeArray(),
            correctAnswers = 0,
            resultTitleBlock = testResultBlock.find(".test-result__title"),
            resultTextBlock = testResultBlock.find(".test-result__text");

        answers.forEach(function(elem, index){

            if(testResult[index].value == elem){
                correctAnswers += 1;
            }
        });

        if(correctAnswers == 7){
            resultTitle = "Супер-краевед вообще!";
            resultText = "Приятно на все вопросы правильно ответить, да ведь? И нам приятно, что вам приятно."
        }else if(correctAnswers == 6 || correctAnswers == 5){
            resultTitle = "Краевед, чо!";
            resultText = "Вы в шаге от победы. Верной дорогой идёте."
        }else if(correctAnswers == 4 || correctAnswers == 3){
            resultTitle = "Баско, но не вообще.";
            resultText = "Маленько поднажмите. Походите, понаблюдайте, поспрашивайте, поинтересуйтесь, посмотрите и всё у вас получится!"
        }else if(correctAnswers < 3){
            resultTitle = "Спасибо за пройденный тест.";
            resultText = "Мы вам скажем одну вещь, только вы не обижайтесь. Учите матчасть!"
        }

        resultTitleBlock.text(resultTitle);
        resultTextBlock.text(resultText);

        testForm.addClass("hide");
        testResultBlock.addClass("active");


    });


}(window, window.jQuery));