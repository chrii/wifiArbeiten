"use strict"

    /**
    * id for Textinput answerButton[0-3]
    * 
    */
var renderAnswerField = function() {
    var form = $('<form>').appendTo('#content').attr({method:'post', action:' '});
    var table = $('<table>').appendTo(form).attr('id', 'create').addClass('u-full-width');
    var head = $('<thead>').appendTo(table);
    $('<td>').appendTo(head).html('');
    $('<td>').appendTo(head).html('Fragen:');
    $('<td>').appendTo(head).html('Richtig');
    table = $('<tbody>').appendTo(table);
    $('<tr>').appendTo(table);
    $('<td>').appendTo('tr').html('Frage: ');
    $('<td>').appendTo('tr');
    $('<input>').attr({type:'text', name:"question", id:'question'}).appendTo('tbody td:last-child');
    $('<td>').appendTo('tr');


    for ( let i = 0; i < 4; i++ ) {
        var tr = $('<tr>').appendTo(table);
        var td2 = $('<td>').appendTo(tr).html('Atworten: ' + (i+1) + ':');;
        var td = $('<td>').appendTo(tr);
        var td3 = $('<td>').appendTo(tr);
        $('<input>').attr({type:'text', id:'answerField' + i}).appendTo(td);
        $('<input>').attr({type:'radio', id:'answer' + i, name:'ans', value: i }).appendTo(td3);
    }
    $('<tr>').appendTo(table);
    $('<select>').appendTo('tr:last-child').attr({id:'difficult'});
    $('<option>').appendTo('select').html('Schwierigkeit wählen').attr({value:'null'});
    for (let s = 0; s <= 9; s++) {
        $('<option>').html(s + 1).appendTo('select').attr({value:s});
    }

    $('<tr>').appendTo(table);
    var buttonTd = $('<td>').appendTo('tr:last-child');
    $('<button>').attr({id:'submitAnswer'}).html('Speichern').appendTo(buttonTd).addClass('button button-primary');
    $('<td>').appendTo('tr:last-child').attr('id', 'errorRadio');
}

var deleteQuestion = function(i) {
    $.ajax({
        url: 'http://localhost/javascript-kurs/mein-cms/php/quiz.php',
        method: 'POST',
        data: {requestType:'delete', index: i},
        success:function(response) {
            reloadContent();
        },
        error:function() {
            console.log('nej');
        }
    });
}

var reloadContent = function(){
    $('#ausgabe').empty();
    $('<div class="container lds-ring"><div></div><div></div><div></div><div></div></div>')
    .appendTo('#ausgabe');
    loadTable();
}
var loadTable = function() {
    $.ajax({
        url:'http://localhost/javascript-kurs/mein-cms/php/quiz.php',
        method:'POST',
        data:{requestType:'get'},
        success:function(response){
            var questions = response.fragen;
            $('#ausgabe').empty();
            var table = $('<table>').appendTo('#ausgabe');
            var thead = $('<thead>').appendTo(table);
            $('<td>').appendTo(thead).html('Fragen');
            $('<td>').appendTo(thead);
            var tbody = $('<tbody>').appendTo(table);

            for (let i = 0; i < questions.length; i++ ) {
                var questionQuery = questions[i];
                var tr = $('<tr>').appendTo(tbody);
                var td1 = $('<td>').appendTo(tr);
                var td2 = $('<td>').appendTo(tr);
                var heading = $('<h5>').appendTo(td1);
                heading.html(questions[i].frage);
                td1.on('click', function() {
                    $('ul').slideUp();
                    $('ul' , this).slideDown();
                })
                var qList = $('<ul>').appendTo(td1);
                $('<button>')
                    .appendTo(td2)
                    .html('Löschen')
                    .on('click', function() {
                        deleteQuestion(i);
                    });
                for (let a = 0; a < questionQuery.antworten.length; a++) {
                    var list = $('<li>')
                        .appendTo(qList)
                        .html(questionQuery.antworten[a])
                        .addClass(questionQuery.richtig == a ? 'richtig' : '');
                }
            }
        },
        error:function(){
            console.log('nej');
        }
    });

}
var buttonClicked = false;
$(document).ready(function() {
    renderAnswerField();

    $('#submitAnswer').on('click', function() {
        event.preventDefault();

        if (buttonClicked == true) {
            return;
        }
        
        var fieldFormOk = false;
        var radioFormOk = false;

        $('.error').removeClass();
        $('#errorRadio').empty();

        for (let i = 0; i < 4; i++) {
            var field = $('#answerField' + i);
            var fieldRange = field.val().length;

            if (fieldRange == 0) {
                field.addClass('error');
            } else {
                fieldFormOk = true;

            }
        }

        var radio = $('input:checked').val();
        var diff = $('#difficult');
        var que = $('#question');
        var errorbox = $('#errorRadio');
        if (diff.val() == 'null') {
            diff.addClass('error');
            errorbox.html('Schwierigkeit leer');
        }else {
            radioFormOk = true;
        }
        if (que.val().length == 0) {
            que.addClass('error');
        }else {
            radioFormOk = true;

        }
        if (radio == undefined) {
            errorbox.html('Eine Antwort auswählen');
        } else {
            radioFormOk = true;
        }

        if (radioFormOk == true && $('.error').length == 0) {
            console.log('Request seems fine');
            var request = {
                requestType: 'post',
                frage: $('#question').val(),
                antwort1: $('#answerField0').val(),
                antwort2: $('#answerField1').val(),
                antwort3: $('#answerField2').val(),
                antwort4: $('#answerField3').val(),
                richtig: $('input[name=ans]:checked').val(),
                schwierigkeit: $('#difficult').val()
            };
            buttonClicked = true;
            $.ajax({
                url: 'http://localhost/javascript-kurs/mein-cms/php/quiz.php',
                method: 'POST',
                data: request,
                success:function(response) {
                    if (response.gespeichert) {
                        reloadContent();
                    }
                },
                error:function(response) {
                    
                }
            });
        }
    });

    // Loading Animation CSS + loadTable()
    reloadContent();

});