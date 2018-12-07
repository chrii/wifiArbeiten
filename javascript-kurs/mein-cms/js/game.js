"use strict"

var ajaxQuizAPI = 'http://localhost/javascript-kurs/mein-cms/php/quiz.php';

var renderQuestionField = function(quest = '**THIS IS A PLACEHOLDER FOR QUESTIONS**') {
    $('#content').empty();
    var qContainer = $('<div>').appendTo('#content');

    var question = $('<div>').addClass('question').appendTo(qContainer);
    $('<h4>').html(quest).appendTo(question);
    $('<div>').addClass('buttons-game content-middle').appendTo(qContainer);

    $('<form>').attr({method:'post'}).appendTo('.buttons-game');
    var row = $('<div>').addClass('row').appendTo('form');

    for ( let i = 0; i < 2; i++ ) {
        var column = $('<div>').addClass('six columns').appendTo(row);
        $('<button>').appendTo(column).html('**PLACEHOLDER**').attr({name: 'button1' + i});
        $('<button>').appendTo(column).html('**PLACEHOLDER**').attr({name: 'button2' + i});
   /**
    * ^^^^^^^^^^^^^
    *  Created Button Names:
    *  1) button10
    *  2) button20
    *  3) button11
    *  4) button21
    */
    }
}
var renderWelcome = function() {
    $('#content').empty();
    var qContainer = $('<div>').appendTo('#content').addClass('question');
    $('<h4>').html('Klicke Start zum beginnen').appendTo(qContainer);

    $('<div>').addClass('buttons-game content-middle').appendTo(qContainer);

    $('<form>').appendTo('.buttons-game').attr({method:'post'});
    $('<button>').appendTo('form').html('Start').attr({name: 'button1'});

}
var randomFour = function() {

}

var buttonFunc = function( val = 0) {

}

var loadQuest = function(val = 0) {

    $.ajax({
        url: ajaxQuizAPI,
        method: 'POST',
        data: {requestType: 'get'},
        success: function(response) {
            var fragen = response.fragen;
            console.log(val < fragen.length);
            if (val < fragen.length){
                renderQuestionField(fragen[val].frage);
                $('[name=button10]')
                    .empty()
                    .html(fragen[val].antworten[0])
                    .on('click', function() {
                        event.preventDefault();
                        if (val < fragen.length) {
                            //questionCounter++;
                            val++;
                            $('#content').empty();
                            renderQuestionField(fragen[val].frage);
                            loadQuest(val);
                        } else {
                            alert('fin');
                        }
                    });
                $('[name=button20]')
                    .empty()
                    .html(fragen[val].antworten[1])
                    .on('click', function() {
                        event.preventDefault();
                        //questionCounter++;
                        val++;
                        $('#content').empty();
                        renderQuestionField(fragen[val].frage);
                        loadQuest(val);
                });
                $('[name=button11]')
                    .empty()
                    .html(fragen[val].antworten[2])
                    .on('click', function() {
                        event.preventDefault();
                        //questionCounter++;
                        val++;
                        $('#content').empty();
                        renderQuestionField(fragen[val].frage);
                        loadQuest(val);
                });
                $('[name=button21]')
                    .empty()
                    .html(fragen[val].antworten[3])
                    .on('click', function() {
                        event.preventDefault();
                        //questionCounter++;
                        val++;
                        $('#content').empty();
                        renderQuestionField(fragen[val].frage);
                        loadQuest(val);
                });
            } else {
                alert('FIn');
            }
            
        }
    });


}

$(document).ready(function() {

    renderWelcome();
    $('button').on('click', function() {
        event.preventDefault();
        var questionCounter = 0;
        var qObject = {};
        $('content').empty();
        $('<div class="container lds-ring"><div></div><div></div><div></div><div></div></div>')
        .appendTo('#content');
        loadQuest();
    });

});